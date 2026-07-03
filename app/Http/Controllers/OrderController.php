<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Customer;
use App\Models\GoldDebt;
use App\Models\GoldDebtPayment;
use App\Models\Order;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class OrderController extends Controller
{

    // front route
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'comment' => 'required'
        ]);

        Order::create($request->all());

        return redirect()->back()->with('success', __('messages.Contact-send-success'));
    }




    // admin panel
    public function orderList()
    {
        $list = Order::orderBy('id', 'desc')->paginate(5);
        return view('admin.order.index', compact('list'));
    }
    public function orderDetail(Order $order)
    {
        $order->load('goldDebt.payments');
        $list = $order->orderDetail;
        $transactions = $order->transactions;
        $goldDebt = $order->goldDebt;
        return view('admin.order.detail', compact('list', 'order', 'transactions', 'goldDebt'));
    }
    public function orderEdit(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        $orderDetail = $order->orderDetail;
        foreach ($orderDetail as $detail) {
            $product = (new Content)->find((int) $detail->attributes['product_id']);
            if ($product instanceof Content && $request->status == 1) {
                $attr = $product->attr;
                $attr['in-stock'] = '0';
                $product->update(['attr' => $attr]);
            }
        }
        return redirect()->back()->with('success', Lang::get('messages.updated'));
    }

    public function orderStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'products' => 'required|array|min:1',
        ]);

        $user = User::where('mobile', $request->mobile)->first();
        if (!$user) {
            $user = User::create([
                'mobile' => $request->mobile,
                'name' => $request->name,
                'password' => bcrypt(\Illuminate\Support\Str::random(10)),
            ]);
        }

        Customer::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'zipcode' => $request->zipcode,
            ]
        );

        $totalPrice = (int) $request->total_price;
        if ($totalPrice <= 0) {
            $totalPrice = 0;
            foreach ($request->products as $item) {
                $totalPrice += (int) ($item['price'] ?? 0) * (int) ($item['count'] ?? 1);
            }
        }

        $order = Order::create([
            'user_id' => $user->id,
            // 'status' => $request->status ?? 0,
            'total_price' => $totalPrice,
        ]);

        foreach ($request->products as $item) {
            // dd($item);

            $product = Content::find((int) $item['product_id']);
            $order->orderDetail()->create([
                'title' => $item['title'],
                'price' => (int) ($item['price'] ?? 0),
                'count' => (int) ($item['count'] ?? 1),
                'attributes' => [
                    'product_id' => $item['product_id'],
                    'slug' => $product->slug ?? '',
                    'image' => $product ? (($product->images['images']['small'] ?? '')) : '',
                    'customer_name' => $request->name,
                    'customer_mobile' => $request->mobile,
                    'customer_zipcode' => $request->zipcode,
                    'customer_address' => $request->address,
                    'sood' => (int) ($item['sood'] ?? 0),
                    'weight' => $item['weight'] ?? 0,
                    'ojrat' => (int) ($item['ojrat'] ?? 0),
                    'tax' => (int) ($item['tax'] ?? 0),
                    'additional_price' => (int) ($item['additional_price'] ?? 0),
                    'gold_price' => getGoldPrice()['priceToman'],
                ],
            ]);
        }

        // observer
        $order->update(['status' => $request->status ?? 0]);



        return redirect()->route('admin.order.index')->with('success', 'سفارش با موفقیت ثبت شد.');
    }

    public function orderCreate(Request $request, Order $order)
    {

        $products = Content::where('status', '=', '1')
            ->where('type', '=', 2)
            ->where('attr->in-stock', '=', 1)
            ->orderBy('id', 'desc')
            ->get();



        // dd($products);

        return view('admin.order.create', compact(
            'products',
            'order'
        ));
    }
    public function orderPayFromGoldFund(Request $request, Order $order)
    {
        $customer = $order->user?->customer;
        if (!$customer) {
            return redirect()->back()->with('error', 'کاربر دارای مشتری نیست');
        }

        if ($order->status == 3) {
            return redirect()->back()->with('error', 'این سفارش قبلاً پرداخت شده است');
        }

        $balance = $customer->getWalletBalances();

        DB::beginTransaction();
        try {
            $goldDebt = $order->goldDebt;
            if ($goldDebt) {
                $remainingDebt = $goldDebt->remaining_debt;
                if ($remainingDebt <= 0) {
                    return redirect()->back()->with('error', 'بدهی طلا تسویه شده است');
                }

                if ($balance['gold'] < $remainingDebt) {
                    return redirect()->back()->with('error', 'موجودی صندوق طلا ناکافی است');
                }

                $currentGp = (int) (getGoldPrice()['priceToman'] ?? 0);
                if ($currentGp <= 0) {
                    return redirect()->back()->with('error', 'قیمت طلا نامعتبر است');
                }

                $customer->walletTransactions()->create([
                    'wallet_type' => 'gold',
                    'operation' => 'withdraw',
                    'amount' => $remainingDebt,
                    'asset_price' => $currentGp,
                    'reference_type' => Order::class,
                    'reference_id' => $order->id,
                    'description' => "پرداخت بدهی طلا سفارش #{$order->id} از صندوق طلا",
                ]);

                GoldDebtPayment::create([
                    'gold_debt_id' => $goldDebt->id,
                    'amount' => (int) round($remainingDebt * $currentGp),
                    'gold_price' => $currentGp,
                    'gold_weight' => $remainingDebt,
                    'payment_method' => 'fund',
                    'description' => 'پرداخت از صندوق طلا توسط ادمین',
                ]);

                $goldDebt->update(['status' => GoldDebt::PAID]);
            } else {
                $gp = (int) ($order->orderDetail->first()->attributes['gold_price'] ?? 0);
                if ($gp <= 0) {
                    return redirect()->back()->with('error', 'قیمت طلا نامعتبر است');
                }

                $totalGoldWeight = $order->total_price / $gp;

                if ($balance['gold'] < $totalGoldWeight) {
                    return redirect()->back()->with('error', 'موجودی صندوق طلا ناکافی است');
                }

                $customer->walletTransactions()->create([
                    'wallet_type' => 'gold',
                    'operation' => 'withdraw',
                    'amount' => $totalGoldWeight,
                    'asset_price' => $gp,
                    'reference_type' => Order::class,
                    'reference_id' => $order->id,
                    'description' => "پرداخت سفارش #{$order->id} از صندوق طلا",
                ]);
            }

            $order->user->transactions()->create([
                'title' => 'پرداخت از صندوق طلا',
                'price' => $order->total_price,
                'count' => 1,
                'status' => 2,
                'message' => "پرداخت سفارش #{$order->id} از صندوق طلا توسط ادمین",
                'description' => "پرداخت از صندوق طلا",
                'transactionable_type' => Order::class,
                'transactionable_id' => $order->id,
            ]);

            $order->update(['status' => 3]);

            DB::commit();
            return redirect()->back()->with('success', 'سفارش با موفقیت از صندوق طلا پرداخت شد');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'خطا در پرداخت: ' . $e->getMessage());
        }
    }

    public function orderCreateGoldDebt(Order $order)
    {
        if ($order->goldDebt) {
            return redirect()->back()->with('error', 'برای این سفارش قبلاً بدهی طلا ثبت شده است');
        }

        $customer = $order->user?->customer;
        if (!$customer) {
            return redirect()->back()->with('error', 'این سفارش مشتری ندارد');
        }

        $gp = (int) ($order->orderDetail->first()->attributes['gold_price'] ?? 0);
        if ($gp <= 0) {
            return redirect()->back()->with('error', 'قیمت طلا نامعتبر است');
        }

        try {
            GoldDebt::create([
                'order_id' => $order->id,
                'customer_id' => $customer->id,
                'gold_price_at_order' => $gp,
                'total_gold' => $order->total_price / $gp,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطا در ثبت بدهی طلا: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'بدهی طلا با موفقیت ثبت شد');
    }

    public function orderGoldDebtPayment(Request $request, Order $order)
    {
        $goldDebt = $order->goldDebt;
        if (!$goldDebt) {
            return redirect()->back()->with('error', 'برای این سفارش بدهی طلا ثبت نشده است');
        }

        $customer = $order->user?->customer;
        if (!$customer) {
            return redirect()->back()->with('error', 'کاربر دارای مشتری نیست');
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'gold_price' => 'required|numeric|min:1',
            'payment_method' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            $remainingDebt = $goldDebt->remaining_debt;
            $goldWeight = $request->amount / $request->gold_price;

            DB::beginTransaction();

            if ($goldWeight >= $remainingDebt) {
                $excessGold = $goldWeight - $remainingDebt;

                GoldDebtPayment::create([
                    'gold_debt_id' => $goldDebt->id,
                    'amount' => (int) round($remainingDebt * $request->gold_price),
                    'gold_price' => $request->gold_price,
                    'gold_weight' => $remainingDebt,
                    'payment_method' => $request->payment_method ?: null,
                    'description' => $request->description ?: null,
                ]);

                $goldDebt->update(['status' => GoldDebt::PAID]);
                $order->update(['status' => 3]);

                if ($excessGold > 0) {
                    $customer->walletTransactions()->create([
                        'wallet_type' => 'gold',
                        'operation' => 'deposit',
                        'amount' => $excessGold,
                        'asset_price' => $request->gold_price,
                        'description' => "بازگشت مازاد پرداخت بدهی سفارش #{$order->id} به صندوق طلا",
                        'reference_type' => Order::class,
                        'reference_id' => $order->id,
                    ]);

                    $customer->trades()->create([
                        'type' => 'debt_excess',
                        'gold_amount' => $excessGold,
                        'gold_price' => $request->gold_price,
                        'total_price' => (int) round($request->gold_price * $excessGold),
                        'fee' => 0,
                        'status' => 'completed',
                        'description' => "بازگشت مازاد پرداخت بدهی سفارش #{$order->id} به صندوق طلا",
                    ]);
                }
            } else {
                GoldDebtPayment::create([
                    'gold_debt_id' => $goldDebt->id,
                    'amount' => $request->amount,
                    'gold_price' => $request->gold_price,
                    'gold_weight' => $goldWeight,
                    'payment_method' => $request->payment_method ?: null,
                    'description' => $request->description ?: null,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'پرداخت با موفقیت ثبت شد');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'خطا در ثبت پرداخت: ' . $e->getMessage());
        }
    }

    public function orderDestroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', Lang::get('messages.deleted'));
    }
}
