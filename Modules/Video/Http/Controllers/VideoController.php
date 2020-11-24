<?php

namespace Modules\Video\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Video;
use Yajra\Datatables\Datatables;
use App\Http\Models\Categories;
use Illuminate\Support\Facades\Auth;



class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $title = 'Video Management';

        $video = Video::all();

        return view('video::index', ['videos' => $video])->withTitle($title);
    }

    public function data(Request $request )
    {
        if ($request->filter == 'all')
        $video = Video::all();
        else
        $video = Video::onlyTrashed()->get();
        //dd($request->filter);

        return datatables::of($video)->make(true);
    }

     //get info data
    public function info(Request $request)
    {
        $video = Video::all();
        $trashed = Video::onlyTrashed()->count();


        $info = [
            'total' => $video->count(),
            'trashed' => $trashed,
        ];

        return json_encode($info);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $title = 'Create Video';
        $category = Categories::get();

        return view('video::create')->withTitle($title)->withCategory($category);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $thumbnail = 'http://img.youtube.com/vi/' . $request->thumbnail . '/mqdefault.jpg';
        //dd($thumbnail);
        $datas = new Video();
        $datas->video_title = $request->title;
        $datas->user_id = Auth::user()->id;
        $datas->id_category = $request->category;
        $datas->video_url = $request->urlnew;
        $datas->content = $request->area;
        $datas->key = $request->thumbnail;
        $datas->thumbnail = $thumbnail;

        $datas->save();

        return redirect()->route('video.index')->withErrors(['success' => 'Success create Video']);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('video::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $title = 'Video Management';

        $video = Video::where('id_video', $id)->first();

        $category = Categories::all();

        return view('video::edit')->withVideo($video)->withCategory($category)->withTitle($title);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $thumbnail = 'http://img.youtube.com/vi/' . $request->thumbnail . '/mqdefault.jpg';

        $datas = [
            'video_title' => $request->title,
            'user_id' => Auth::user()->id,
            'id_category' => $request->category,
            'video_url' => $request->urlnew,
            'content' => $request->area,
            'key' => $request->thumbnail,
            'thumbnail' => $thumbnail,
        ];
        
        $updatevideo = Video::where('id_video',$id)->update($datas);

        return redirect()->route('video.index')->withErrors(['success' => 'Success update Video']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $video = Video::where('id_video', $id);
        //dd($video);

        if(!$video->delete()){
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
        $product = Video::withTrashed()->where('id_video', $id)->restore();

            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];

        return json_encode($data);
    }

     //force delete data
    public function forcedelete($id, Request $request)
    {
        $user = Video::where('id_video', $id);

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

    //bulk data
    public function bulk($data, Request $request)
    {
        $datas = explode(',',$request->id);
        foreach($datas as $key){
            if($data == 'trash')
            $bulk = Video::where('id_video',$key)->delete();
            else if($data == 'restore')
            $bulk = Video::where('id_video',$key)->restore();
            else 
            $bulk = Video::where('id_video',$key)->forcedelete();
        }
        
        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }
}
