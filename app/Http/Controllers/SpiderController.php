<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\SpiderService;
use Carbon\Carbon;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;
use GuzzleHttp;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use App\Support\Image;
use Illuminate\Http\JsonResponse;

class SpiderController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        //Auth::loginUsingId(1);
        //$this->middleware('auth');
    }


    public function index()
    {
        return view('admin.index');
    }

    public function tolidatScraping(SpiderService $sp, $page) : JsonResponse {
        $sp->tolidat($page);
        return response()->json('Hello, World!');
    }

    public function spider(SpiderService $sp)
    {
        $sp::dorsam();
    }
    public function reload(SpiderService $sp)
    {
        return $sp::reload();
    }
    public function addToCms(SpiderService $sp, Request $request)
    {
        return $sp::addToCms($request);
    }
    public function instagram($id, $count)
    {


        // $r = $this->getCategories("***مسابقه شرکت کنید دستبند برنده بشید*** شرایط شرکت تو مسابقه این هست که شما پست ما رو لایک و سیو کنید و ۵ نفر از دوستانتون رو زیر این پست تگ کنید. *یادتون باشه هر تگ در یک کامنت باشه. *زمان مسابقه از امروز تا اخر شب فردا هست. یعنی ساعت ۱۲ شب روز ولنتاین *جایزه این مسابقه یک دستبند طلا هست. قرعه کشی انجام میشه و نتیجه مسابقه اول اسفند تو پیج گذاشته میشه. #مسابقه #مسابقه_اینستاگرامی #مسابقه_اینستاگرام دستبند  گزدنبند گوشواره طلا #مسابقه_لایک #گالری_طلا #گالری_طلا_ایدن #طلا #طلاسازی");
        // dd($r->first()->id);


        // $instagram = Instagram::withCredentials(new \GuzzleHttp\Client(), 'marjani.mahdi', '66008190', new Psr16Adapter('Files'));
        // $instagram->login();

        // $account = $instagram->getAccountById(3);
        // echo $account->getUsername();
        // dd(1);

        // $instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
        // $nonPrivateAccountMedias = $instagram->getMedias('eden.gold.gallery');
        // echo $nonPrivateAccountMedias[0]->getLink();
        // dd(1);

        $instagram  = Instagram::withCredentials(new \GuzzleHttp\Client(), 'marjani.mahdi', '66008190', new Psr16Adapter('Files'));
        $instagram->login();
        $instagram->saveSession();
        // dd($instagram->getAccountById(3));
        $medias = $instagram->getMedias($id, $count);
        // $medias = $instagram->getMediasByTag('دستبند', $count);
        $i = 0;
        foreach ($medias as $k => $post) {

            // dd($post);
            $item['id'] = $post->getId();
            $item['instatype'] = $post->getType();
            $item['imageStandardResolutionUrl'] = $post->getImageHighResolutionUrl();
            $item['caption'] = $post->getCaption();
            $item['video'] = $post->getVideoStandardResolutionUrl();
            $item['squareImages'] = $post->getSquareImages();


            $item['caption'] = preg_replace("/\r|\n/", " ", $item['caption']);

            if ($id == 'eden.gold.gallery')
                $item['caption'] = Str::replace(array('✅', '❤️', '🌸', '❍', '◍', '֍', '✷', '*', '●', '✤', '⍟', '✲', '◆', '◕', '↠', 'فروخته شد', '    ', '   ', '  '), ' ', clearHtml($item['caption']));

            // dd($item['caption']);

            $item['title'] = Str::replace('...', '', readMore($item['caption'], 75));

            echo '<span dir="rtl">' . $item['title'] . '</span>';


            $item['description'] = $item['caption'];
            $item['brief_description'] = readMore($item['caption'], 100);
            $item['meta_description'] = readMore($item['caption'], 100);
            $item['meta_title'] = $item['title'] . ' | ایدن ';
            $item['type'] = 2;
            $item['attr_type'] = 'product';
            $item['status'] = 1;
            $item['attr'] = '{"brand":null,"price":"0","offer_price":null,"alternate_name":null,"rate":null}';
            $item['publish_date'] = date('Y-m-d');



            if (Content::where('title', '=', $item['title'])->first() == null) {

                //category
                $categories =  $this->getCategories($item['caption']);
                // dd($categories->first()->id);

                $item['parent_id'] = $categories->first()->id;
                // $item['parent_id'] = 3;

                $item['slug'] = uniqueSlug(Content::class, $item['title']);

                $content = new Content($item);


                // dd($content);
                $content->save();
                $i++;

                echo  "✅";

                // $sizes = array('small','medium','large','org');
                $year = Carbon::now()->year;
                $imagePath = "/upload/images/{$year}/";

                $imageContent = file_get_contents($item['squareImages'][4]);
                file_put_contents(public_path($imagePath) . $item['id'] . '.jpg', $imageContent);
                $url['images'] = $this->resize($imagePath . $item['id'] . '.jpg', 'product', $imagePath, $item['id'] . '.jpg', $item['id'], 'jpg');


                $content->images = $url;
                $content->save();

                $content->categories()->attach($categories);
            }

            echo "<br>";
        }


        dd('Finished, added ' . $i . ' Product');
    }

    private function resize($path, $type, $imagePath, $fileNameAndType, $fileName, $fileType)
    {

        $sizes = array(
            "small" => env(Str::upper($type) . '_SMALL_W'),
            'medium' => env(Str::upper($type) . '_MEDIUM_W'),
            'large' => env(Str::upper($type) . '_LARGE_W')
        );
        // dd($sizes);
        $images['crop'] = $imagePath . $fileNameAndType;
        foreach ($sizes as $name => $size) {
            $images[$name] = $imagePath  . $fileName . "-{$name}." . $fileType;

            // dd($path);
            $img = Image::make(public_path($path));
            // dd($path);
            $img->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($images[$name]), 60, 'jpg');

            // echo "<img src='".url($images[$name])."'>";

        }

        // dd(1);
        return $images;
    }

    private function getCategories($caption)
    {
        $categories = Category::where('type', '=', 1)->select('title', 'id')->get()->filter(function ($value, $key) use ($caption) {
            // echo ($value->title).'<br>';
            // echo (Str::contains($caption,$value->title));
            // return $value->title == 'گوشواره';
            return Str::contains($caption, $value->title);
        });


        if ($categories->count() == 0)  $categories = new Collection(array(Category::where('type', '=', 1)->Where('title', '=', 'محصولات')->first()));

        // dd(new Category(array('title'=>3)));
        // dd($categories);

        return $categories;
    }
}
