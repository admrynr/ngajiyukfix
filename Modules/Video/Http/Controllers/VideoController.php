<?php

namespace Modules\Video\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Video;
use Yajra\Datatables\Datatables;



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

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('video::create');
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
        return view('video::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('video::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $video = Video::where('id', $id);

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
}
