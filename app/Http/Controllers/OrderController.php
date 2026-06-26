<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Customer;
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
        $list = $order->orderDetail;
        $transactions = $order->transactions;
        return view('admin.order.detail', compact('list', 'order', 'transactions'));
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

        $gp = (int) ($order->orderDetail->first()->attributes['gold_price'] ?? 0);
        $totalGoldWeight = $order->total_price / $gp;



        if ($balance['gold'] < $totalGoldWeight) {
            return redirect()->back()->with('error', 'موجودی صندوق طلا ناکافی است');
        }

        DB::beginTransaction();
        try {
            $customer->walletTransactions()->create([
                'wallet_type' => 'gold',
                'operation' => 'withdraw',
                'amount' => $totalGoldWeight,
                'asset_price' => $gp,
                'reference_type' => Order::class,
                'reference_id' => $order->id,
                'description' => "پرداخت سفارش #{$order->id} از صندوق طلا",
            ]);



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

    public function orderDestroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', Lang::get('messages.deleted'));
    }
}
