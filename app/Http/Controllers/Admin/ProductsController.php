<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Product;
use Exception;
use App\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ProductsPanelRequest;
use App\ProductCategory;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsList = DB::table('products')
        ->join('product_categories','product_categories.id','=','products.platform_id')
        ->select('products.*','platform_name')
        ->orderBy('created_at','desc')
        ->paginate(15);
        $reviewsList = Review::join('users','users.id','=','reviews.user_id')
        ->select('users.name','users.avatar','users.role','reviews.id','reviews.product_id','reviews.review','reviews.rate','reviews.created_at')
        ->take(5)
        ->get();
        $getRating = Review::select('rate','product_id')->get();
        return view('admin.panel.productsList')
            ->with('productsList',$productsList)
            ->with('reviewsList',$reviewsList)
            ->with('getRating',$getRating);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $showCategories = ProductCategory::all();
        return view('admin.panel.addProducts')->with('showCategories',$showCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsPanelRequest $request)
    {
        $arrayWithExcludes = array(
            'image' => 'to_be_uploaded',
        );
        $enableMessage = true;
        if (Input::has('image'))
        {
            $thisLegit = array(
                'jpg','png',
            );
            if (in_array(Input::file('image')->getClientOriginalExtension(),$thisLegit) == 1)
            {
                $fileName = uniqid().'.'.Input::file('image')->getClientOriginalExtension();
                $fileDir = storage_path().'/uploads/product_images/';
                $moveFile = Input::file('image')->move($fileDir,$fileName);
                $thisImage = array('image' => $fileName);
                $arrayFinal = array_merge($arrayWithExcludes,$thisImage);
                $message = "Đã thêm.";
                $alert = "success";
            } 
            else 
            {
                $arrayFinal = $arrayWithExcludes;
                $message = "Sai định dạng cho phép , nên chỉ thêm được thông tin";
                $alert = "warning";
            }
        }
        else
        {
            $arrayFinal = $arrayWithExcludes;
            $message = "Đã thêm.";
            $alert = "success";
        }
        $requestExcept = $request->except('_token','image'); 
        $forInsert = array_merge($requestExcept,$arrayFinal,array('created_at' => Carbon::now()));
        Product::insert($forInsert);
        return redirect()->route('productsList_view')
            ->with('enableMessage',$enableMessage)
            ->with('alert',$alert)
            ->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Session::get('enableMessage');
        // Session::get('message');
        // Session::get('alert');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productInfo = DB::table('products')->find($id);
        $productCategories = ProductCategory::all();
        $productCategoriesById = ProductCategory::find($productInfo->platform_id);
        return view('admin.panel.editProducts')
            ->with('productInfo',$productInfo)
            ->with('productCategories',$productCategories)
            ->with('productCategoriesById',$productCategoriesById);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsPanelRequest $request, $id)
    {
        $arrayWithExcludes = array();
        $enableMessage = true;
        if (Input::has('image')) 
        {
            $thisLegit = array(
                'jpg','png',
            );
            if (in_array(Input::file('image')->getClientOriginalExtension(),$thisLegit) == 1)
            {
                $fileName = uniqid().'.'.Input::file('image')->getClientOriginalExtension();
                $fileDir = storage_path().'/uploads/product_images/';
                $moveFile = Input::file('image')->move($fileDir,$fileName);
                $thisImage = array('image' => $fileName);
                $arrayFinal = array_merge($arrayWithExcludes,$thisImage);
                $message = 'Sửa thành công';
                $alert = 'success';
            } 
            else
            {
                $arrayFinal = $arrayWithExcludes;
                $message = 'Vì sai định dạng file cho phép , nên chỉ cập nhật được thông tin';
                $alert = 'warning';
            }
        } 
        else
        {
            $arrayFinal = $arrayWithExcludes;
            $message = 'Sửa thành công';
            $alert = 'success';
        }
        $requestExcept = $request->except('_token','image');
        $forUpdate = array_merge($requestExcept,$arrayFinal);
        Product::where('id',$id)->update($forUpdate);
        return redirect()->route('productsList_view')
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enableMessage = true;
        try 
        {
            if (is_numeric($id)) 
            {
                $result = Product::where('id',$id)->delete();
                $alert = 'success';
                $message = 'Đã xóa';
                if (!$result)
                {
                    throw new Exception('Không hợp lệ');
                }
            }
            else
            {
                throw new Exception('Không hợp lệ');
            }
        }
        catch (Exception $e)
        {
            $alert = 'danger';
            $message = $e->getMessage();
        }
        return redirect()->back()
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }
}
