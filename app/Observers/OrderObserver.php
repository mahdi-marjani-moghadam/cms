<?php
namespace App\Observers;

use App\Models\Content;
use App\Models\Order;

class OrderObserver
{
    public function created(Order $order): void
    {
        if ($order->status == 3) {
            $this->updateProductStock($order);
        }
    }

    public function updated(Order $order): void
    {
        if ($order->wasChanged('status') && $order->status == 3) {
            $this->updateProductStock($order);
        }
    }

    private function updateProductStock(Order $order): void
    {
        $productIds = $order->orderDetail
            ->pluck('attributes.product_id')
            ->filter()
            ->unique();

        Content::whereIn('id', $productIds)
            ->update([
                'attr->in-stock' => 0,
            ]);
    }
}
