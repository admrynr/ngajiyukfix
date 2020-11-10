<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Seo;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pages = ['homepage','hotel', 'aboutus','investment','csr','gcg','contact','reward'];
        foreach($pages as $key){
            $seo[$key]['title'] = @Seo::where('slug',$key)->where('meta','title')->first()->value;
            $seo[$key]['description'] = @Seo::where('slug',$key)->where('meta','description')->first()->value;
            $seo[$key]['keyword'] = @Seo::where('slug',$key)->where('meta','keyword')->first()->value;
        }
        return view('content::page')->withTitle('Pages')->withSeo($seo);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('content::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('content::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('content::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        //
        $updateseo = Seo::where('slug',$request->page)->count();
        if(!empty($request->slider)){
            $file = $request->file('slider');
            $upload = Storage::disk('localpublic')->put('/slider/'.$request->page.'-slider.jpg', file_get_contents($file));
        }

        if(!empty($request->slider1)){
            $file = $request->file('slider1');
            $upload = Storage::disk('localpublic')->put('/slider/'.$request->page.'-slider1.jpg', file_get_contents($file));
        }

        if(!empty($request->slider2)){
            $file = $request->file('slider2');
            $upload = Storage::disk('localpublic')->put('/slider/'.$request->page.'-slider2.jpg', file_get_contents($file));
        }
        
        if($updateseo == 0){
            $createseo = new Seo;
            $createseo->slug = $request->page;
            $createseo->meta = 'title';
            $createseo->value = $request->title;
            $createseo->save();
            $createseo = new Seo;
            $createseo->slug = $request->page;
            $createseo->meta = 'description';
            $createseo->value = $request->description;
            $createseo->save();
            $createseo = new Seo;
            $createseo->slug = $request->page;
            $createseo->meta = 'keyword';
            $createseo->value = $request->keyword;
            $createseo->save();
        }else{
            $dataseotitle = [
                'slug' => $request->page,
                'meta' => 'title',
                'value' => $request->title
            ];
            $updateseo = Seo::where('slug',$request->page)->where('meta','title')->update($dataseotitle);
            
            $dataseodescription = [
                'slug' => $request->page,
                'meta' => 'description',
                'value' => $request->description
            ];
            $updateseo = Seo::where('slug',$request->page)->where('meta','description')->update($dataseodescription);
            
    
            $dataseokeyword = [
                'slug' => $request->page,
                'meta' => 'keyword',
                'value' => $request->keyword
            ];
            $updateseo = Seo::where('slug',$request->page)->where('meta','keyword')->update($dataseokeyword);
        }

        return redirect()->back()->withErrors(['success' => 'Success update page']);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
