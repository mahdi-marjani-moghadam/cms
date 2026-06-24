<?php

namespace App\Console\Commands;

use App\Models\Content;
use App\Models\OrderDetail;
use Illuminate\Console\Command;

class UpdateOrderDetailsGoldData extends Command
{
    protected $signature = 'orders:update-gold-data';

    protected $description = 'Recalculate weight, ojrat, and sood in order_details attributes';

    public function handle(): int
    {
        $updated = 0;

        OrderDetail::query()
            ->whereNotNull('attributes')
            ->chunkById(500, function ($details) use (&$updated) {

                $productIds = [];

                foreach ($details as $detail) {

                    $attr = is_array($detail->attributes)
                        ? $detail->attributes
                        : json_decode($detail->attributes, true);

                    if (!is_array($attr)) {
                        continue;
                    }

                    if (!empty($attr['product_id'])) {
                        $productIds[] = $attr['product_id'];
                    }
                }

                $products = Content::query()
                    ->whereIn('id', array_unique($productIds))
                    ->get()
                    ->keyBy('id');

                foreach ($details as $detail) {

                    $attr = is_array($detail->attributes)
                        ? $detail->attributes
                        : json_decode($detail->attributes, true);

                    if (!is_array($attr)) {
                        continue;
                    }

                    $productId = $attr['product_id'] ?? null;

                    if (!$productId) {
                        continue;
                    }

                    $product = $products->get($productId);

                    if (!$product) {
                        continue;
                    }

                    $productAttr = $product->attr;

                    if (!is_array($productAttr)) {
                        continue;
                    }

                    // جلوگیری از دوباره‌کاری
                    // if (isset($attr['weight'], $attr['ojrat'], $attr['sood'])) {
                    //     continue;
                    // }

                    $weight = (float) ($productAttr['weight'] ?? 0);
                    $ojratPercent = (float) ($productAttr['ojrat'] ?? 0);

                    $goldPrice = (float) ($attr['gold_price'] ?? getGoldPrice()['priceToman']);

                    if ($weight <= 0 || $goldPrice <= 0) {
                        continue;
                    }

                    $basePrice = $weight * $goldPrice;

                    // اجرت (ریالی)
                    $ojrat = ($basePrice * $ojratPercent) / 100;

                    // سود ثابت 7 درصد
                    $sood = ($basePrice + $ojrat) * 0.07;

                    $attr['weight'] = $weight;
                    $attr['ojrat'] = round($ojrat);
                    $attr['sood'] = round($sood);
                    $attr['gold_price'] = $goldPrice;


                    $detail->attributes = $attr;
                    $detail->saveQuietly();

                    $updated++;
                }

                $this->info("Updated so far: {$updated}");
            });

        $this->info("DONE. Total updated: {$updated}");

        return self::SUCCESS;
    }
}
