<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use App\Http\Models\Blog;
use App\Http\Models\Seo;
use App\Http\Models\Categories;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    //view page
    public function index()
    {
        $title = 'Blog';
        return view('blog::index')->withTitle($title);
    }

    public function create()
    {
        $title = 'Create Blog';
        $category = Categories::get();

        return view('blog::create')->withTitle($title)->withCategory($category);
    }

    public function uploadfile(Request $request)
    {
       $image = Storage::disk('localpublic')->put('blog', $request->file('file'));
       
       return json_encode(['location' => env('APP_URL').'/images/'.$image]);
    }

    //get data fot DataTable
    public function data(Request $request)
    {
        if ($request->filter == 'all')
        $data = Blog::where('category_id','!=',2)->with('user')->get();
        else if($request->filter == 'active')
        $data = Blog::where('category_id','!=',2)->with('user')->where('active',1)->get();
        else if($request->filter == 'deactive')
        $data = Blog::where('category_id','!=',2)->with('user')->where('active',0)->get();
        else
        $data = Blog::where('category_id','!=',2)->with('user')->onlyTrashed()->get();

        return datatables::of($data)->make(true);
    }

    //store data
    public function store(Request $request)
    {
       
        $slug = Self::slugify($request->title);
        // dd($slug, $request->all());
        // cek slug
        $cekslug = Blog::where('slug',$slug)->count();
        if($cekslug)
        $slug = $slug.date('ymdhis',strtotime('now'));

        if(!empty($request->foto))
        $image = Storage::disk('localpublic')->put('csr', $request->file('foto'));
        else
        $image = 'default.png';

        $datas = new Blog();
        $datas->title = $request->title;
        $datas->user_id = Auth::user()->id;
        $datas->category_id = $request->category;
        $datas->date = date('Y-m-d',strtotime('now'));
        $datas->slug = $slug;
        $datas->content = $request->area;
        $datas->thumbnail = $image;
        $datas->active = 1;

        $datas->save();

        //seo
        $dataseo = new Seo();
        $dataseo->slug = $slug;
        $dataseo->meta = 'title';
        $dataseo->value = $request->seo_title;

        $dataseo->save();

        $dataseo = new Seo();
        $dataseo->slug = $slug;
        $dataseo->meta = 'description';
        $dataseo->value = $request->seo_description;

        $dataseo->save();

        $dataseo = new Seo();
        $dataseo->slug = $slug;
        $dataseo->meta = 'keyword';
        $dataseo->value = $request->seo_keyword;

        $dataseo->save();

        return redirect()->route('blog.index')->withErrors(['success' => 'Success create Blog']);
    }

    //get data for Edit
    public function edit(Request $request)
    {
        $id = $request->id;

        $blog = Blog::where('id', $id)->first();
        $seo = Seo::where('slug',$blog->slug)->get();
        foreach($seo as $key){
            $dataseo[$key->meta] = $key->value;
        }

        $category = Categories::where('id', '!=', 2)->get();

        return view('blog::edit')->withBlog($blog)->withSeo($dataseo)->withTitle('Edit Blog')->withCategory($category);
    }

    //update data
    public function update(Request $request)
    {
        $id = $request->id;
        $datablog = Blog::where('id',$id)->first();
        if($datablog->title != $request->title)
        $slug = Self::slugify($request->title);
        else
        $slug = $datablog->slug;
        // dd($slug, $request->all());
        // cek slug
        if($datablog->title != $request->title){
        $cekslug = Blog::where('slug',$slug)->count();
        if($cekslug)
        $slug = $slug.date('ymdhis',strtotime('now'));
        }

        if(!empty($request->resetfoto))
        $image = 'default.png';
        else if(!empty($request->foto))
        $image = Storage::disk('localpublic')->put('csr', $request->file('foto'));
        else
        $image = $datablog->thumbnail;

        $datas = [
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'date' => date('Y-m-d',strtotime('now')),
            'slug' => $slug,
            'content' => $request->area,
            'thumbnail' => $image,
            'active' => 1,
        ];
        
        $updateblog = Blog::where('id',$id)->update($datas);
        
        //seo
        $dataseotitle = [
            'slug' => $slug,
            'meta' => 'title',
            'value' => $request->seo_title
        ];
        $updateseo = Seo::where('slug',$datablog->slug)->where('meta','title')->update($dataseotitle);
        
        $dataseodescription = [
            'slug' => $slug,
            'meta' => 'description',
            'value' => $request->seo_description
        ];
        $updateseo = Seo::where('slug',$datablog->slug)->where('meta','description')->update($dataseodescription);
        

        $dataseokeyword = [
            'slug' => $slug,
            'meta' => 'keyword',
            'value' => $request->seo_keyword
        ];
        $updateseo = Seo::where('slug',$datablog->slug)->where('meta','keyword')->update($dataseokeyword);
        
        
        return redirect()->route('blog.index')->withErrors(['success' => 'Success update CSR']);

    }

    //approve data
    public function approve($id, Request $request)
    {
        $model = Blog::findOrFail($id);
        $model->active = 1;

        if(!$model->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Approve Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Approve Data'
            ];
        }

        return json_encode($data);
    }

    //decline data
    public function decline($id, Request $request)
    {
        $model = Blog::findOrFail($id);
        $model->active = 0;

        if(!$model->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    //delete data
    public function destroy($id, Request $request)
    {
        $user = Blog::where('id', $id);

        if(!$user->delete()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    //force delete data
    public function forcedestroy($id, Request $request)
    {
        $user = Blog::where('id', $id);

        if(!$user->forcedelete()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    //restore data
    public function restore($id, Request $request)
    {
        $user = Blog::where('id', $id);

        if(!$user->restore()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    //bulk data
    public function bulk($data, Request $request)
    {
        $datas = explode(',',$request->id);
        foreach($datas as $key){
            if($data == 'trash')
            $bulk = Blog::where('id',$key)->delete();
            else if($data == 'activate')
            $bulk = Blog::where('id',$key)->update(['active'=>1]);
            else if($data == 'deactivate')
            $bulk = Blog::where('id',$key)->update(['active' => 0]);
            else if($data == 'restore')
            $bulk = Blog::where('id',$key)->restore();
            else 
            $bulk = Blog::where('id',$key)->forcedelete();
        }
        
        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    //get info data
    public function info(Request $request)
    {
        $model = Blog::where('category_id','!=',2)->get();

        $active = Blog::where('category_id','!=',2)->where('active',1)->count();
        $deactive = Blog::where('category_id','!=',2)->where('active',0)->count();;
        $total = $model->count();
        $trashed = Blog::where('category_id','!=',2)->onlyTrashed()->count();

        $info = [
            'total' => $total,
            'active' => $active,
            'deactive' => $deactive,
            'trashed' => $trashed
        ];

        return json_encode($info);
    }

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
