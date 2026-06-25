<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class WalletTransactionController extends Controller
{

    public function orderStore(Request $request)
    {
        // dd(env('SMS_SENDER'));

        $user = Auth()->user();
        $cookieUser = getSession('cart'); // the user ID to bind the cart contents
        $cart = \Cart::session($cookieUser)->getContent()->toArray();
        $totalPrice = \Cart::session($cookieUser)->getTotal();

        try {
            $order = $user->orders()->create([
                'total_price' => $totalPrice,
                'status' => 0
            ]);
            $order->orderDetail()->delete();
            $pN = '';
            foreach ($cart as $v) {

                $order->orderDetail()->firstOrCreate([
                    'title' => $v['name'],
                    'price' => $v['price'],
                    'count' => $v['quantity'],
                    'attributes' => $v['attributes']
                ]);
                \Cart::session($cookieUser)->remove($v['id']);

                $pN .= $v['name'];
            }
        }
        catch (Exception $e) {
            dd($e);
        }

        $name = (!is_null($user->customer) && $user->customer['name'] != '') ? $user->customer['name'] . '-' : '';
        $message = "{$name} {$user->mobile} \n {$pN}\nمبلغ: {$order->total_price}";

        // if (env('SMS_PURCHASE', false)) {
        //     @sendSms(['09331181877'], $message);
        // }


        return redirect()->route('customer.order.detail', ['order' => $order]);
    }
    public function walletList()
    {
        $user = Auth::user();
        $customer = $user->customer;
        $wallet = $customer->walletTransactions()->paginate(10);


        return view('auth.customer.walletList', compact('wallet','customer'));
    }
    public function orderDetail(Order $order)
    {
        if (!$order)
            return redirect()->route('customer.order.list')->with('message', __('messages.not found'));
        $user = Auth()->user();
        $orderDetail = $user->orders($order->id)->orderDetail;

        return view('auth.customer.orderDetailList', compact('order', 'orderDetail'));
    }
    public function orderDestroy(Order $order)
    {
        $user = Auth()->user();
        $user->orders($order->id)->delete();

        return redirect()->route('customer.order.list')->with('message', __('messages.deleted'));
    }



    public function productPowerUp(Request $request, Content $content)
    {
        $user = Auth::user();

        return view('auth.customer.powerUp', compact('user', 'content'));
    }

    public function invoiceList()
    {
        $user = Auth::user();
        $transactions = $user->transactions;

        return view('auth.customer.invoiceList', compact('transactions'));
    }

    public function invoice(Transaction $transaction)
    {
        // dd($transaction->transactionable);
        $parentModel = $transaction->transactionable;

        return view('auth.customer.invoice', compact('transaction', 'parentModel'));
    }
    public function invoiceStore(Request $request, Content $content)
    {
        // dd($request->all());
        $user = Auth()->user();

        $totalPrice = \Cart::session($user->id)->getTotal();

        $count = $request->count;



        $user->transactions()->where('transactionable_id', '=', $content->id)->where('transactionable_type', '=', Content::class)->delete();

        $transaction = $user->transactions()->firstOrCreate([
            'title' => $content->title,
            'count' => $count,
            'price' => $totalPrice,
            'description' => '',
            'transactionable_type' => Content::class,
            'transactionable_id' => $content->id,
            'message' => Lang::get('messages.invoice created'),
            'status' => 0
        ]);

        // dd($transaction);

        return redirect()->route('customer.invoice', $transaction->id)->with('success', Lang::get('messages.invoice created'));
    }

    public function uploadBill(Request $request, Order $order)
    {
        $user = Auth()->user();

        // check order and user
        if (!$user->orders()->where('id', '=', $order->id)->select('id')->exists()) {
            return redirect()->back()->with('error', 'Ooops!');
        }

        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'zipcode' => 'required'
        ], [
            'name' => 'نام را وارد نمایید',
            'address' => 'آدرس را وارد نمایید',
            'zipcode' => 'کدپستی را وارد نمایید'
        ]);

        $name = $request->name;
        $address = $request->address;
        $zipcode = $request->zipcode;


        if ($user->customer == null) {

            Customer::create([
                'user_id' => $user->id,
                'mobile' => $user->mobile,
                $name => $name
            ]);

            if (count($user->getRoleNames()) == 0) {
                $user->assignRole('customer');
            }
        }
        // dd($user->customer);
        $user->customer->name = $name;
        $user->customer->address = $address;
        $user->customer->zipcode = $zipcode;
        $user->customer->save();

        $user->name = $name;
        $user->save();


        // get bill
        $bills = $request->file('bill');



        // check file
        if (!$bills)
            return redirect()->back()->with('error', 'لطفا فایل را آپلود نمایید');
        $imagePath = '/upload/images/customer/bill/';
        $fileNames = '';
        foreach ($bills as $bill) {
            // upload file on server

            $uniq = Carbon::now();
            $fileName = $user->id . '(' . $user->mobile . ')-' . $order->id . '-' . $uniq . '.' . $bill->extension();
            $fileNames .= ',' . $imagePath . $fileName;
            $bill->move(public_path($imagePath), $fileName);
        }
        // transaction
        $user->transactions()->firstOrCreate([
            'title' => 'آپلود فیش',
            'price' => $order->total_price,
            'count' => 1,
            'discount_code' => '',
            'status' => 3,
            'message' => "آپلود فیش {$order->price} " . convertGToJ(Carbon::now()),
            'description' => trim($fileNames, ','),
            'transactionable_type' => Order::class,
            'transactionable_id' => $order->id,
        ]);


        // update order status
        $order->status = 2;
        $order->save();


        if (env('SMS_PURCHASE', false)) {
            @sendSms(array('09374599840', '09331181877'), "پرداخت  #{$order->id} - {$name} \n{$order->total_price} تومان");
        }

        return redirect()->route('customer.order.list')->with('success', 'فیش آپلود شد. منتظر تماس از بخش ارسال بمانید.');
    }

    public function sendToBand(Request $request, Transaction $transaction)
    {
        $user = Auth::user();



        // dd($user->transaction());


        // dd($transaction);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'bearer ' . env('PAYPING'),
        ])
            ->post('https://api.payping.ir/v2/pay', [
                'amount' => $transaction->price,
                'returnUrl' => url('/') . '/returnBank',
                'payerIdentity' => $user->mobile,
                'payerName' => $user->name,
                'description' => Lang::get('messages.buy') . $request->count . ' power',
                'clientRefId' => json_encode(['transactionId' => $transaction->id]),
            ]);



        if ($response->status() != 200) {
            if ($response->status() == 400) {
                $transaction->update(['status' => -1, 'message' => $response->json()['Error']]);
                return redirect()->back()->with('error', $response->json()['Error']);
            }

            $transaction->update(['status' => -1, 'message' => $response->body()]);
            return redirect()->back()->with('error', $response->body());
        }


        $transaction->update(['status' => 1, 'message' => '']);
        return redirect('https://api.payping.ir/v2/pay/gotoipg/' . $response->json()['code']);
    }






}
