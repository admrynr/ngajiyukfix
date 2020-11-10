<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Helpers\Guzzle;
use Yajra\Datatables\Datatables;
use App\Http\Models\Product;
use App\Http\Models\Categories;
use App\Http\Models\ProductMedia;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $title = 'Product Management';

        $category = Categories::all();

        return view('product::index', ['categories' => $category])->withTitle($title);
    }

    public function create()
    {
        $title = 'Create Product';
        $category = Categories::get();

        return view('product::create')->withTitle($title)->withCategory($category);
    }

    //get data for Edit
    public function edit($id, Request $request)
    {
        $title = 'Edit Product';
        $data = Product::where('id', $id)->first();
        $productalbum = ProductMedia::where('product_id',$id)->get();
        $category = Categories::get();

        return view('product::edit')->withTitle($title)->withCategory($category)->withProduct($data)->withProductalbum($productalbum);
    }

    //update data
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->weight = $request->weight;
        $product->categories_id = $request->categories_id;
        $product->base_price = (int)str_replace(".","",str_replace("Rp. ","",$request->base_price));
        $product->final_price = (int)str_replace(".","",str_replace("Rp. ","",$request->final_price));
        $product->stock = $request->stock;
        $product->sku_code = $request->sku_code;
        $product->brand = $request->brand;
        $product->is_verified = 1;
        if(!empty($request->foto)){
        $image = Storage::disk('localpublic')->put('product', $request->file('foto'));
        $product->image = $image;
        }else if($request->resetfoto == 1){
            $image = 'default.jpg';
            $product->image = '';
        }
        // if ($request->bid_type != null && $request->max_price != null && $request->min_price != null && $request->scale != null && $request->fixed_price != null){
        //     $product->bid_type = $request->bid_type;
        //     $product->max_price = (int)str_replace(".","",str_replace("Rp. ","",$request->max_price));
        //     $product->min_price = (int)str_replace(".","",str_replace("Rp. ","",$request->min_price));
        //     $product->scale = $request->scale;
        //     $product->fixed_price = (int)str_replace(".","",str_replace("Rp. ","",$request->fixed_price));
        // }
        $product->update();

        if(!empty($request->album)){
            foreach($request->album as $key => $val){
                // dd($val, $request->file('foto'));
                $image = Storage::disk('localpublic')->put('product', $request->file('album')[$key]);
                $productimage = new ProductMedia;
                $productimage->product_id = $id;
                $productimage->src = $image;
                $productimage->save();
            }
        }

        return redirect()->route('product.index');

        // $image = Storage::disk('localpublic')->put('product', $request->file('foto'));
        // $product = Product::findOrFail($id);
        // $product->product_name = $request->name;
        // $product->product_type = $request->type;
        // $product->categories_id = $request->category;
        // $product->base_price = (int)str_replace(".","",str_replace("Rp. ","",$request->base));
        // $product->final_price = (int)str_replace(".","",str_replace("Rp. ","",$request->final));
        // $product->stock = $request->stock;
        // $product->image = $image;
        // if ($request->bid_type != null && $request->max != null && $request->min != null && $request->scale != null && $request->fixed != null){
        //     $product->bid_type = $request->bid_type;
        //     $product->max_price = (int)str_replace(".","",str_replace("Rp. ","",$request->max));
        //     $product->min_price = (int)str_replace(".","",str_replace("Rp. ","",$request->min));
        //     $product->scale = $request->scale;
        //     $product->fixed_price = (int)str_replace(".","",str_replace("Rp. ","",$request->fixed));
        // }

        // if(!$product->update()){
        //     $data = [
        //         'status' => 2,
        //         'message' => 'Fail Update Data'
        //     ];
        // }else{
        //     $data = [
        //         'status' => 1,
        //         'message' => 'Success Update Data'
        //     ];
        // }


        // return json_encode($data);

    }

    //approve data
    public function approve($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $product->is_verified = 1;

        if(!$product->update()){
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
        $product = Product::findOrFail($id);
        $product->is_verified = 0;

        if(!$product->update()){
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
        $product = Product::where('id', $id);

        if(!$product->delete()){
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

    //delete album
    public function albumdelete($id, Request $request)
    {
        $product = ProductMedia::where('id', $id)->delete();

        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    //restore data
    public function restore($id, Request $request)
    {
        $product = Product::withTrashed()->where('id', $id)->restore();

            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];

        return json_encode($data);
    }

    //forcedelete data
    public function forcedelete($id, Request $request)
    {
        //delete foto product
        $product = Product::withTrashed()->where('id',$id)->first();
        $productimage = ProductMedia::where('product_id',$id)->get();
        if($productimage->count() != 0){
            foreach($productimage as $keys){
                $exist = Storage::disk('localpublic')->exists($keys->src);

                if($exist){
                    Storage::disk('localpublic')->delete($keys->src);
                }
            }
        }
        $productimage = ProductMedia::where('product_id',$id)->delete();

        $exists = Storage::disk('localpublic')->exists($product->image);
        if($exists){
            $deleteproductimage = Storage::disk('localpublic')->delete($product->image);
        }

        $product = Product::withTrashed()->where('id', $id)->forcedelete();

        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all(), $request->file('foto'), $request->file('album')[0]);

        if(!empty($request->foto))
        $image = Storage::disk('localpublic')->put('product', $request->file('foto'));
        else
        $image = 'default.jpg';

        $product = new Product;

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->weight = $request->weight;
        $product->categories_id = $request->categories_id;
        $product->base_price = (int)str_replace(".","",str_replace("Rp. ","",$request->base_price));
        $product->final_price = (int)str_replace(".","",str_replace("Rp. ","",$request->final_price));
        $product->stock = $request->stock;
        $product->brand = $request->brand;
        $product->sku_code = $request->sku_code;
        $product->is_verified = 1;
        $product->image = $image;
        // if ($request->bid_type != null && $request->max_price != null && $request->min_price != null && $request->scale != null && $request->fixed_price != null){
        //     $product->bid_type = $request->bid_type;
        //     $product->max_price = (int)str_replace(".","",str_replace("Rp. ","",$request->max_price));
        //     $product->min_price = (int)str_replace(".","",str_replace("Rp. ","",$request->min_price));
        //     $product->scale = $request->scale;
        //     $product->fixed_price = (int)str_replace(".","",str_replace("Rp. ","",$request->fixed_price));
        // }
        $product->save();

        if(!empty($request->album)){
            foreach($request->album as $key => $val){
                // dd($val, $request->file('foto'));
                $image = Storage::disk('localpublic')->put('product', $request->file('album')[$key]);
                $productimage = new ProductMedia;
                $productimage->product_id = $product->id;
                $productimage->src = $image;
                $productimage->save();
            }
        }

        return redirect()->route('product.index');

    }

    public function data(Request $request)
    {
        $categories = Categories::all();
        if ($request->filter == 'all')
        $product = Product::with('categories')->get();
        else if($request->filter == 'active')
        $product = Product::where('is_verified',1)->get();
        else if($request->filter == 'deactive')
        $product = Product::where('is_verified',0)->get();
        else if($request->filter == 'totalcats')
        $product = Product::with('categories')->get();
        else if($request->filter == 'trashed')
        $product = Product::onlyTrashed()->get();
        else {
            foreach($categories as $c){
                if($request->filter == $c->name){
                    $product = Product::with('categories')->where('categories_id',$c->id)->get();
                }
            }
        }

        return datatables::of($product)->make(true);
    }

    //bulk data
    public function bulk($data, Request $request)
    {
        $categories = Categories::all();
        $datas = explode(',',$request->id);
        foreach($datas as $key){
            if($data == 'trash')
            $bulk = Product::where('id',$key)->delete();
            else if($data == 'activate')
            $bulk = Product::where('id',$key)->update(['is_verified'=>1]);
            else if($data == 'deactivate')
            $bulk = Product::where('id',$key)->update(['is_verified' => 0]);
            else if($data == 'restore')
            $bulk = Product::where('id',$key)->restore();
            else if($data == 'delete'){
                //delete foto product
                $product = Product::withTrashed()->where('id',$key)->first();
                $productimage = ProductMedia::where('product_id',$key)->get();
                if($productimage->count() != 0){
                    foreach($productimage as $keys){
                        $exist = Storage::disk('localpublic')->exists($keys->src);

                        if($exist){
                            Storage::disk('localpublic')->delete($keys->src);
                        }
                    }
                }
                $productimage = ProductMedia::where('product_id',$key)->delete();

                $exists = Storage::disk('localpublic')->exists($product->image);
                if($exists){
                    $deleteproductimage = Storage::disk('localpublic')->delete($product->image);
                }

                $bulk = Product::withTrashed()->where('id',$key)->forcedelete();
            }
            else {
                foreach($categories as $c){
                    if($data == $c->name){
                    $bulk = Product::where('id',$key)->update(['categories_id' => $c->id]);
                    }
                }
            }

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
        $model = Product::with('categories')->get();
        $category = Categories::all();

        $active = Product::where('is_verified',1)->count();
        $deactive = Product::where('is_verified',0)->count();;
        $total = $model->count();
        $trashed = Product::onlyTrashed()->count();


        $info = [
            'total' => $total,
            'active' => $active,
            'deactive' => $deactive,
            'trashed' => $trashed,
            'totalcats' => $total
        ];

    foreach($category as $c){
        $info[$c->name] = Product::with('categories')->where('categories_id',$c->id)->count();
    }

        return json_encode($info);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('product::show');
    }

}
