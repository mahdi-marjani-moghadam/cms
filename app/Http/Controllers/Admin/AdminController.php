<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Content;
use App\Models\Order;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Services\ImageResizeService;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;



class AdminController extends Controller
{
    protected ImageResizeService $imageResizeService;

    public function __construct(ImageResizeService $imageResizeService)
    {
        $this->imageResizeService = $imageResizeService;
    }
    protected function uploadImages($file)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $imagePath = "/upload/images/{$year}/{$month}/";

        // ORIGINAL NAME
        $originalName = $file->getClientOriginalName();

        // SAFE filename
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = strtolower($file->getClientOriginalExtension());

        // sanitize filename
        $fileName = Str::slug($name);

        // final stored name
        $finalFileName = "{$fileName}.{$extension}";

        // move file
        $file->move(public_path($imagePath), $finalFileName);

        // full path for intervention
        $fullPath = public_path($imagePath . $finalFileName);

        // resize
        $url['images'] = $this->imageResizeService->resize(
            fullPath: $fullPath,
            type: 'content',
            outputDir: $imagePath,
            fileName: $fileName,
            extension: $extension,
            quality: 80
        );

        return $url;
    }



    public function index()
    {

        $data['articlesCount'] = Content::where('type', '=', '2')
            ->where('attr_type', '=', 'article')
            ->count();

        $data['productsCount'] = Content::where('type', '=', '2')
            ->where('attr_type', '=', 'product')
            ->count();

        $data['commentsCount'] = Comment::count();

        $data['companiesCount'] = Company::count();

        $data['customersCount'] = Role::where('name', '=', 'customer')->first()->users->count();

        $start = Jalalian::fromFormat('Y-m-d', '1405-01-01')->toCarbon()->startOfDay();
        $end = Jalalian::fromFormat('Y-m-d', '1405-01-01')->addYears(1)->toCarbon()->startOfDay();

        $orders = Order::with('orderDetail')
            ->where('status', 3)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $monthNames = [
            '01' => 'فروردین', '02' => 'اردیبهشت', '03' => 'خرداد',
            '04' => 'تیر',     '05' => 'مرداد',    '06' => 'شهریور',
            '07' => 'مهر',     '08' => 'آبان',     '09' => 'آذر',
            '10' => 'دی',      '11' => 'بهمن',     '12' => 'اسفند',
        ];

        $monthly = [];
        foreach ($orders as $order) {
            $month = Jalalian::fromCarbon($order->created_at)->format('m');
            if (!isset($monthly[$month])) {
                $monthly[$month] = ['name' => $monthNames[$month] ?? $month, 'sales' => 0, 'profit' => 0, 'count' => 0];
            }
            $monthly[$month]['sales'] += $order->total_price;
            $monthly[$month]['count']++;

            foreach ($order->orderDetail as $detail) {
                $attr = $detail->attributes;
                $monthly[$month]['profit'] += (int)($attr['profit'] ?? 0) * $detail->count;
            }
        }

        $data['monthlyProfits'] = $monthly;


        return view('admin.index', compact('data'));
    }


}
