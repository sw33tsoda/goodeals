<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Review;

class SearchController extends Controller
{
	public function index() {
    	return view('admin.panel.searchResults');
    }
    
    public function search(Request $request) {
    	$search = $request->search_input;
    	$getUsers = DB::table('users')
    		->where('name','like','%'.$search.'%')
    		->orWhere('role','like','%'.$search.'%')
    		->orWhere('email','like','%'.$search.'%')
            ->orderBy('created_at','desc')
    		->paginate(10,['*'],'users_page');
    	$getProducts = DB::table('products')
            ->join('product_categories','product_categories.id','=','products.platform_id')
            ->select('products.*','product_categories.platform_name')
    		->where('name','like','%'.$search.'%')
    		->orWhere('developer','like','%'.$search.'%')
    		->orWhere('publisher','like','%'.$search.'%')
    		->orWhere('platform_name','like','%'.$search.'%')
            ->orderBy('created_at','desc')
    		->paginate(10,['*'],'products_page');
        $getPosts = DB::table('posts')
            ->where('author','like','%'.$search.'%')
            ->orWhere('title','like','%'.$search.'%')
            ->orWhere('content','like','%'.$search.'%')
            ->orderBy('created_at','desc')
            ->paginate(10,['*'],'posts_page');
        $getRating = Review::select('rate','product_id')->get();
        $reviewsList = Review::join('users','users.id','=','reviews.user_id')
        ->select('users.name','users.avatar','users.role','reviews.id','reviews.product_id','reviews.review','reviews.rate','reviews.created_at')
        ->take(5)
        ->get();
    	return view('admin.panel.searchResults')
    		->with('usersResults',$getUsers)
    		->with('productsResults',$getProducts)
            ->with('postsResults',$getPosts)
            ->with('getRating',$getRating)
            ->with('reviewsList',$reviewsList);
    }
}
