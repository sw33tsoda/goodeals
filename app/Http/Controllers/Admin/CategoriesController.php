<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PostCategory;
use Carbon\Carbon;
use Session;
use App\ProductCategory;


class CategoriesController extends Controller
{
    public function __construct() 
    {
        Session::get('enableMessage');
        Session::get('message');
        Session::get('alert');
    }

    public function showAllCategories () 
    {
    	$postCategories = PostCategory::all();
        $productCategories = ProductCategory::all();
        return view('admin.panel.categoriesList',['postCategories' => $postCategories , 'productCategories' => $productCategories]);
    }

    public function create_postCategories() 
    { 
        return view('admin.panel.addPostCategories'); 
    }
    public function store_postCategories(Request $request) 
    {
    	$enableMessage = true;
        $insert = PostCategory::insert(['category_name' => $request->category_name , 'created_at' => Carbon::now()]);
        if ($insert == 1)
        {
            $alert = 'success';
            $message = "Đã thêm <strong>$request->category_name</strong> vào thể loại bài viêt";
        }
        else
        {  
            $alert = 'danger';
            $message = "Thêm <strong>$request->category_name</strong> thất bại";
        }
    	return redirect()->route('showAllCategories_view')
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }
    public function edit_postCategories(Request $request) 
    {
        $categoryInfo = PostCategory::find($request->id);
        return view('admin.panel.editPostCategories',['categoryInfo'=>$categoryInfo]); 
    }
    public function update_postCategories(Request $request)
    {
        $enableMessage = true;
        $update = PostCategory::where('id',$request->id)->update($request->except('_token'));
        if ($update == 1)
        {
            $alert = 'success';
            $message = "Đã sửa <strong>$request->category_name</strong>";
        }
        else
        {  
            $alert = 'danger';
            $message = "Sửa <strong>$request->category_name</strong> thất bại";
        }
        return redirect()->route('showAllCategories_view')
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }
    public function delete_postCategories(Request $request)
    {
    	$enableMessage = true;
        try 
        {
            if (is_numeric($request->get('id'))) 
            {
                $getName = PostCategory::find($request->get('id'));
                $result = PostCategory::where('id',$request->get('id'))->delete();
                $alert = 'success';
                $message = "Đã <strong>$getName->category_name</strong> xóa";
                if (!$result)
                {
                    throw new Exception('Lại mò nữa rồi');
                }
            }
            else
            {
                throw new Exception('Lại mò nữa rồi');
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




    public function create_productCategories() {
        return view('admin.panel.addProductCategories');
    }

    public function store_productCategories(Request $request) 
    {
        $enableMessage = true;
        $insert = ProductCategory::insert(['platform_name' => $request->platform_name , 'created_at' => Carbon::now()]);
        if ($insert == 1)
        {
            $alert = 'success';
            $message = "Đã thêm <strong>$request->platform_name</strong> vào thể loại bài viêt";
        }
        else
        {  
            $alert = 'danger';
            $message = "Thêm <strong>$request->platform_name</strong> thất bại";
        }
        return redirect()->route('showAllCategories_view')
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }

    public function edit_productCategories(Request $request) 
    {
        $categoryInfo = ProductCategory::find($request->id);
        return view('admin.panel.editProductCategories',['categoryInfo'=>$categoryInfo]); 
    }
    public function update_productCategories(Request $request)
    {
        $enableMessage = true;
        $update = ProductCategory::where('id',$request->id)->update($request->except('_token'));
        if ($update == 1)
        {
            $alert = 'success';
            $message = "Đã sửa <strong>$request->platform_name</strong>";
        }
        else
        {  
            $alert = 'danger';
            $message = "Sửa <strong>$request->platform_name</strong> thất bại";
        }
        return redirect()->route('showAllCategories_view')
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }
    public function delete_productCategories(Request $request)
    {
        $enableMessage = true;
        try 
        {
            if (is_numeric($request->get('id'))) 
            {
                $getName = ProductCategory::find($request->get('id'));
                $result = ProductCategory::where('id',$request->get('id'))->delete();
                $alert = 'success';
                $message = "Đã <strong>$getName->platform_name</strong> xóa";
                if (!$result)
                {
                    throw new Exception('Lại mò nữa rồi');
                }
            }
            else
            {
                throw new Exception('Lại mò nữa rồi');
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
