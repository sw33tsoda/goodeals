<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{
	public function index() {
    	return view('admin.panel.searchResults');
    }
    
    public function search(Request $request) {
    	$search = $request->search_input;
    	$returnUsers = DB::table('users')
    		->where('name','like','%'.$search.'%')
    		->orWhere('role','like','%'.$search.'%')
    		->orWhere('email','like','%'.$search.'%')
            ->orderBy('created_at','desc')
    		->paginate(10,['*'],'users_page');
    	$returnProducts = DB::table('products')
            ->join('product_categories','product_categories.id','=','products.platform_id')
            ->select('products.*','product_categories.platform_name')
    		->where('name','like','%'.$search.'%')
    		->orWhere('developer','like','%'.$search.'%')
    		->orWhere('publisher','like','%'.$search.'%')
    		->orWhere('platform_name','like','%'.$search.'%')
            ->orderBy('created_at','desc')
    		->paginate(10,['*'],'products_page');
        $returnPosts = DB::table('posts')
            ->where('author','like','%'.$search.'%')
            ->orWhere('title','like','%'.$search.'%')
            ->orWhere('content','like','%'.$search.'%')
            ->orderBy('created_at','desc')
            ->paginate(10,['*'],'posts_page');
    	return view('admin.panel.searchResults')
    		->with('usersResults',$returnUsers)
    		->with('productsResults',$returnProducts)
            ->with('postsResults',$returnPosts);
    }
}
