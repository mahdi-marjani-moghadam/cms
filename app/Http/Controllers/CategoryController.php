<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use PDF;
use Illuminate\Support\Str;
use App\Models\RedirectUrl;
use Illuminate\Support\Facades\DB;
use App\SiteMap;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public $categoryCombo = [];
    public array $listCat;
    public $level = 0;

    public function index(Request $request): View
    {

        $contents = Category::where('type', '=', value: 1);

        if (isset($request->qtitle)) {
            $contents = $contents->where('title', 'like', '%' . $request->qtitle . '%');
        }

        if (isset($request->qslug)) {
            $contents = $contents->where('slug', 'like', '%' . $request->qslug . '%');
        }

        if (isset($request->qsort)) {
            $sort = explode(',', $request->qsort);
            $contents = $contents->orderBy($sort[0], $sort[1]);
        }

        $contents = $contents->paginate(10);

        // $contents = $this->tree_set();
        // $contents = $this->convertTemplateTable1($contents);

        return view('admin.category.List', compact('contents'));
    }


    protected function uploadImages(Request $request, $type = 'category') : array
    {

        $file = $request->imageJson;
        $fileOrg = $request->file('images');
        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";
        $filenameOrg = $fileOrg->getClientOriginalName();

        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $fileName = str_replace(' ', '-', $request->title) ?? $filenameOrg;
        $fileName = str_replace('/', '-', $fileName);
        $fileType = ($image_type == 'jpeg') ? 'jpg' : $image_type;
        $fileNameAndType = $fileName . '.' . $fileType;

        $file = $fileOrg->move(public_path($imagePath), $fileName . '-org.' . $fileType); // original
        file_put_contents(public_path() . $imagePath . $fileNameAndType, $image_base64); // croped

        // $file = $file->move(public_path($imagePath), $filename);

        // $url['images'] = $this->resize($file->getRealPath(), $type, $imagePath, $filename);

        // $url['thumb'] = $url['images']['small'];

        $url['images'] = $this->resize($imagePath . $fileNameAndType, $type, $imagePath, $fileNameAndType, $fileName, $fileType);
        // $url['thumb'] = $url['images']['small'];
        $url['images']['org'] = $imagePath . $fileName . '-org.' . $fileType;

        return $url;
    }

    private function resize(string $path, string $type, string $imagePath, string $fileNameAndType, string $fileName, string $fileType)
    {
        $sizes = [
            "small" => env(Str::upper($type) . '_SMALL_W'),
            'medium' => env(Str::upper($type) . '_MEDIUM_W'),
            'large' => env(Str::upper($type) . '_LARGE_W')
        ];

        $images['crop'] = "{$imagePath}{$fileNameAndType}";

        $manager = new ImageManager(new Driver());

        foreach ($sizes as $name => $size) {

            $images[$name] = $imagePath . $fileName . "-{$name}." . $fileType;

            $img = $manager->read(public_path($path));
            $img->scale(width: (int) $size)
                ->toJpeg(90)
                ->save(public_path($images[$name]));

        }

        return $images;
    }



    public function create(Request $request)
    {
        $result = $this->tree_set();
        $attr_type = $request->type;
        $category = $this->convertTemplateSelect1($result);
        return view('admin.category.CreateOrEdit', compact(['category', 'attr_type']));
    }

    public function convertTemplateSelect1(array $listCat, $_input = [], $start = '|-', $befor = '', $after = '', $level = 0)
    {
        static $mainMenu = array();
        if (!count($_input) and count($listCat)) {
            $_input = $listCat[0];
        }
        foreach ($_input as $key => $val) {
            if (in_array($val->slug, ['تماس-با-ما', 'درباره-ما', 'وبلاگ', 'تعرفه-تبلیغات']))
                continue;
            $newStart = str_repeat($befor, $level) . $start;
            $val->level = $level;
            $val->symbol = $newStart;
            $mainMenu[$val->id] = $val;
            ++$level;
            if (isset($listCat[$val['id']])) {
                $this->convertTemplateSelect1($listCat, $listCat[$val['id']], $start, '&nbsp;&nbsp;&nbsp;', $after, $level);
            }
            --$level;
        }

        return $mainMenu;
    }

    public function convertTemplateTable1(array $listCat, $_input = [], $start = '|-', $befor = '', $after = '', $level = 0)
    {
        static $mainMenu = [];
        //echo $this->level;
        if (!count($_input) and count($listCat)) {
            $_input = $listCat[0];
        }
        foreach ($_input as $key => $val) {
            $newStart = str_repeat($befor, $level) . $start;

            $val->level = $level;
            $val->symbol = $newStart;
            $mainMenu[$val->id] = $val;
            //$start =  $befor.$start.$after ;
            ++$level;
            //++$this->level;
            if (isset($listCat[$val->id])) {
                $this->convertTemplateTable1($listCat, $listCat[$val->id], $start, '&nbsp;&nbsp;&nbsp;', $after, $level);
            }
            // --$this->level;
            --$level;
            //$len = strlen($space);
            //  $temp = substr($temp, 0, -($len));
        }
        return $mainMenu;
    }


    public function tree_set($searchmap = []): array
    {
        $categories = Category::where('type', '=', value: 1);
        foreach ($searchmap as $condition) {
            $categories = $categories->where($condition[0], $condition[1], $condition[2]);
        }
        $categories = $categories->orderBy('parent_id', 'desc')->get();

        $list = [];

        foreach ($categories as $item) {
            $list[$item->parent_id][] = $item;
        }

        return $list;
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:250',
            //'description' => 'required',
            //'body' => 'required',
            //'images' => 'required|mimes:jpeg,png,bmp',
        ]);


        $data = $request->all();
        $data['publish_date'] = convertJToG($data['publish_date']);
        $data['parent_id'] = $request->parent_id;
        $data['type'] = '1';
        $data['images'] = '';

        $cat = $this->categoryStoreService($data);


        if ($request->file('images')) {
            $imagesUrl = $this->uploadImages($request, 'category');
            $cat->images = $imagesUrl;
            $cat->save();
        }
        return redirect('admin/category')->with('success', 'Greate! Content created successfully.');
    }

    public function categoryStoreService(array $data): Category
    {
        $data['slug'] = uniqueSlug(Content::class, (($data['slug'] ?? '') != '') ? $data['slug'] : $data['title']);
        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));
        return Category::create($data);
    }


    public function show($id)
    {
        //
    }


    public function edit(int $id)
    {
        $attr_type = 'CATEGORY';
        $where = ['id' => $id];
        $content = Category::where($where)->first();


        /*$searchmap = [
            ['parent_id', '<>', $id],
            ['id', '<>', $id]

        ];*/
        $searchmap = [];
        $result = $this->tree_set($searchmap);

        $category = $this->convertTemplateSelect1($result);
        $filter[$id] = '';
        foreach ($category as $catid => $obj) {
            if (isset($filter[$catid])) {
                unset($category[$catid]);
            }
            if (isset($filter[$obj->parent_id])) {
                $filter[$catid] = '';
                unset($category[$catid]);
            }
        }
        $content->prefix = (strpos($content->slug, 'category/') !== false) ? 'category/' : '';

        $content->slug = str_replace('category/', '', $content->slug);

        return view('admin.category.CreateOrEdit', compact(['content', 'category', 'attr_type']));
    }


    public function update(Request $request, int $id)
    {

        /* $this->validate($request, [
             'title' => 'required|title',
             'brief_description' => 'required|brief_description',
             'description' => 'required|description',
             'status' => 'required|status',
             'publish_date' => 'required|publish_date',
         ]);
       /*$request->validate([
             'title' => 'required',
             'product_code' => 'required',
             'description' => 'required',
         ]);
        */
        /*$update = ['title' => $request->title, 'brief_description' => $request->brief_description
            , 'description' => $request->description
            , 'status' => $request->status
            , 'publish_date' => $request->publish_date];
        Content->where('id',$id)->update($update);

        return Redirect::to('contents')
            ->with('success','Great! Product updated successfully');*/

        /*$crud = Content::find($id);
        $crud->title = $request->get('title');
        $crud->brief_description = $request->get('brief_description');
        $crud->description = $request->get('description');
        $crud->publish_date = $request->get('publish_date');
        $crud->status = $request->get('status');
        $crud->save();*/


        $crud = Category::find($id);

        $data = $request->all();

        $data['attr_type'] = 'category';

        $date = $data['publish_date'];

        $data['publish_date'] = convertJToG($date);

        $file = $request->file('images');
        //$inputs = $request->all();

        if ($file) {
            $images = $this->uploadImages($request, 'category');
        } else {
            $images = $crud->images;
            // if ($images != '') {
            //     $images['thumb'] = $request->get('imagesThumb');
            // }
        }
        $data['images'] = $images;


        $data['slug'] = uniqueSlug(Category::class, $crud, ($data['slug'] != '') ? $data['slug'] : $data['title']);
        $data['slug'] = (isset($data['prefix']) && $data['prefix'] != '') ? 'category/' . $data['slug'] : $data['slug'];
        // dd($data);
        // Redirect when change category
        (new RedirectUrl)->createIfChange($crud->slug, $data['slug']);


        $crud->update($data);

        $this->sitemap();

        return redirect('admin/category')->with('success', 'Update! Content created successfully.');
    }


    public function destroy(int $id)
    {
        $crud = Category::find($id);
        $images = $crud->images['images'] ?? '';
        $attr_type = $crud->attr_type;
        $crud->delete();

        if (is_array($images)) {
            $images = array_map(function ($item) {
                return trim($item, '/');
            }, array_values($images));

            File::delete($images);
        }


        return redirect("admin/category?type={$attr_type}");
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class);
    }

    public function uploadImageSubject(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            //$response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            //return "<script>window.parent.CKEDITOR.tools.callFunction(1,'{$url}','')</script>";

            //@header('Content-type: text/html; charset=utf-8');
            //echo $response;
            echo '{
        "uploaded": true,
        "url": "' . $url . '"}';
        }
    }

    public function uploadImageSubject1(Request $request)
    {
        //print_r($request);
        $this->validate(request(), [
            'upload' => 'required|mimes:jpeg,png,bmp',
        ]);

        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";

        $file = request()->file('upload');
        $filename = $file->getClientOriginalName();

        if (file_exists(public_path($imagePath) . $filename)) {
            $filename = Carbon::now()->timestamp . $filename;
        }

        $file->move(public_path($imagePath), $filename);
        $url = $imagePath . $filename;

        return "<script>window.parent.CKEDITOR.tools.callFunction(1,'{$url}','')</script>";
    }

    public function categoryTree($parent_id = 0, $sub_mark = '')
    {
        $query = Category::where('type', '=', 1)
            ->where('parent_id', '=', $parent_id)
            ->orderBy('parent_id', 'asc')->get();

        if ($query->count() > 0) {
            foreach ($query as $k => $row) {
                echo $this->categoryCombo[] = '<option value="' . $row->id . '">' . $sub_mark . $row->title . '</option>';
                $this->categoryTree($row->id, $sub_mark . '---');
            }
        }
    }

    public function categoryList()
    {
        $items = category::all();

        $tree = [];
        foreach ($items as $item) {
            $fields['parent_id'] = $item->parent_id;
            $fields['id'] = $item->id;
            $fields['title'] = $item->title;
            $tree[$item->parent_id][] = $fields;


            /*// Create or add child information to the parent node
            if (isset($tree[$pid])) {
                // a node for the parent exists
                // add another child id to this parent
                $tree[$pid]["children"][] = $id;
            } else {
                // create the first child to this parent
                $tree[$pid] = array("children" => array($id));
            }

            // Create or add name information for current node
            if (isset($tree[$id])) {
                // a node for the id exists:
                // set the name of current node
                $tree[$id]["title"] = $title;
            } else {
                // create the current node and give it a name
                $tree[$id] = array("title" => $title);
            }*/
        }

        return $tree;
    }

    public function toUL1(array $array)
    {

        //dd($array);

        $html = '-' . PHP_EOL;
        foreach ($array as $value) {
            //die('dfdfgdf');
            if (!isset($value['title'])) {
                $html .= '-' . 'no parent';
            } else {
                $html .= '-' . $value['title'];
            }

            if (!empty($value['children'])) {
                $html .= $this->toUL($value['children']);
            }
            $html .= '-' . PHP_EOL;
        }

        $html .= '-' . PHP_EOL;
        return $html;
    }

    public function toUL(array $arr, $pass = 0)
    {
        $html = '<ul>' . PHP_EOL;
        foreach ($arr as $v) {
            $html .= '<li>';
            $html .= str_repeat("--", $pass); // use the $pass value to create the --

            if (!isset($v['title'])) {

                // $html .=  '</li>' . PHP_EOL;
            } else {
                $html .= $v['title'] . '</li>' . PHP_EOL;
            }
            //echo '<pre/>';print_r($v);die();

            if (isset($v['children'])) {

                //if (array_key_exists('children', $v)) {
                $html .= $this->toUL($v['children'], $pass + 1);
            }
        }

        //$html .= '</ul>' . PHP_EOL;
        $html .= '</ul>' . PHP_EOL;
        return $html;
    }

    public function toUL2(array $array)
    {
        $html = '<ul>' . PHP_EOL;

        foreach ($array as $value) {
            if (!isset($value['title'])) {
                $html .= '<li>';
            } else {
                $html .= '<li>' . $value['title'];
            }


            if (!empty($value['children'])) {
                $html .= $this->toUL($value['children']);
            }
            $html .= '</li>' . PHP_EOL;
        }

        $html .= '</ul>' . PHP_EOL;

        return $html;
    }

    public function sitemap()
    {
        $category = Content::where('publish_date', '<=', DB::raw('now()'))
            ->where('type', '=', '1')->get();

        $post = Content::where('publish_date', '<=', DB::raw('now()'))
            ->where('type', '=', '2')
            ->where('attr_type', '=', 'article')->get();
        $product = Content::where('publish_date', '<=', DB::raw('now()'))
            ->where('type', '=', '2')
            ->where('attr_type', '=', 'product')->get();

        // $sitemap = SiteMap::createIndex()
        //     ->add()->setLoc('post.xml')
        //     ->add()->setLoc('category.xml')
        //     ->add()->setLoc('product.xml')
        //     ->writeToFile('sitemap.xml');

        $sitemap = SiteMap::create()
            ->add()
            ->setPriority('1')
            ->setLoc('/')

            ->setLastMod('2024')
            ->setChangefreq('daily')
            ->setLocFieldName('slug')
            ->setLastModFieldName('updated_at')

            ->setDefultPriority('1')
            ->setDefultChangefreq('weekly')
            ->addByCollection($category)

            ->setDefultPriority('0.9')
            ->setDefultChangefreq('weekly')
            ->addByCollection($post)

            ->setDefultPriority('0.6')
            ->setDefultChangefreq('weekly')
            ->addByCollection($product)

            ->writeToFile('sitemap.xml');

        /*  ->add(array(
              'loc'=>'decor/4',
              'lastmod'=>'11-1-90',
              'changefreq'=>'weekly',
              'priority'=>'0.2',))*/
        // ->add()->setPriority('0.1')->setLoc('decor/1')->setLastMod('11-1-90')
        // ->add()->setLoc('decor/2')->setLastMod('11-12-99');
        return true;
    }
}
