<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Order;
use Illuminate\Http\Request;
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
        $list = Order::orderBy('id', 'desc')->get();
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
            'name'     => 'required',
            'products' => 'required|array|min:1',
        ]);

        $totalPrice = 0;
        foreach ($request->products as $item) {
            $totalPrice += (int)($item['price'] ?? 0) * (int)($item['count'] ?? 1);
        }

        $order = Order::create([
            'user_id'     => null,
            'status'      => $request->status ?? 0,
            'total_price' => $totalPrice,
        ]);

        foreach ($request->products as $item) {
            $product = Content::find((int)$item['product_id']);
            $order->orderDetail()->create([
                'title' => $item['title'],
                'price' => (int)($item['price'] ?? 0),
                'count' => (int)($item['count'] ?? 1),
                'attributes' => [
                    'product_id'       => $item['product_id'],
                    'slug'             => $product->slug ?? '',
                    'image'            => $product ? (($product->images['images'][0] ?? '')) : '',
                    'customer_name'    => $request->name,
                    'customer_mobile'  => $request->mobile,
                    'customer_zipcode' => $request->zipcode,
                    'customer_address' => $request->address,
                ],
            ]);
        }

        return redirect()->route('admin.order.index')->with('success', 'سفارش با موفقیت ثبت شد.');
    }

    public function orderCreate(Request $request, Order $order)
    {

        $products = Content::where('status', '=', '1')
        ->where('type','=',2)
        ->orderBy('id', 'desc')
        ->get();



        // dd($products);

        return view('admin.order.create', compact(
            'products',
            'order'
        ));
    }
    public function orderDestroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', Lang::get('messages.deleted'));
    }
}
