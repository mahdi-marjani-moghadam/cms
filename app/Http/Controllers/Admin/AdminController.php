<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Content;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Services\ImageResizeService;



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


        return view('admin.index', compact('data'));
    }


}
