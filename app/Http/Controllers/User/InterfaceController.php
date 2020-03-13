<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Post;
use App\PostCategory;
use App\Comment;
use App\User;
use App\ProductCategory;
use App\Review;
use DB;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\ReviewsRequest;
use App\Order;

class InterfaceController extends Controller
{
    public function search(Request $request) {
        $keywords = strtolower($request->search);
        $sql_query = "LOWER(name) LIKE '%$keywords%' OR LOWER(publisher) LIKE '%$keywords%' OR LOWER(developer) LIKE '%$keywords%'";
        $result = DB::table('products')->whereRaw($sql_query)->get();
        return view('user.searchResult')->with('result',$result);
    }


    public function showStore(Request $request) 
    {
        $getProducts = Product::orderBy('created_at','desc')->paginate(18);
        $getCategories = ProductCategory::all();
    	return view('user.store.store',['getProducts'=>$getProducts,'getCategories'=>$getCategories]);
    }

    public function storeCategories(Request $request) {
        $explode = explode("-", $request->id);
        $platform_id = (int)$explode[count($explode) - 1];
        $getProducts = Product::where('platform_id',$platform_id)->paginate(18);
        $getCategories = ProductCategory::all();
        return view('user.store.store',['getProducts'=>$getProducts,'getCategories'=>$getCategories]);
    }

    public function showPost() 
    {
    	$getPosts = Post::orderBy('created_at','desc')->paginate(6);
    	$getComments = Comment::all();
    	$getCategories = PostCategory::all();
    	return view('user.post.post',[
            'getPosts'=>$getPosts,
            'getCategories'=>$getCategories,
            'getComments'=>$getComments
        ]);
    }

    public function postCategories(Request $request) 
    {
        $byCategory = Post::where('category_id',$request->id)->orderBy('created_at','desc')->paginate(6);
        $getComments = Comment::all();
        $getCategories = PostCategory::all();
        return view('user.post.post',[
            'getPosts'=>$byCategory,
            'getCategories'=>$getCategories,
            'getComments'=>$getComments,
        ]); 
    }

    public function thePost(Request $request) 
    {
    	$getId = explode("-", $request->id);
        $getThisPost = Post::find((int)$getId[count($getId)-1]);
     	return view('user.post.thePost',['thisPost'=>$getThisPost]);
    }

    public function theProduct(Request $request) 
    {
        $getThisProduct = Product::find($request->id);
        $getProductPlatform = ProductCategory::find($getThisProduct->platform_id);
        $getThisProduct->platform_id = $getProductPlatform->platform_name;
        $getReviews = Review::where('product_id',$request->id)->orderBy('created_at','desc')->get();
        return view('user.store.theProduct',['thisProduct'=>$getThisProduct,'getReviews'=>$getReviews,'getUsers'=>User::all()]);
    }

    public function addReview(ReviewsRequest $request) {
        $data = array(
            'product_id'=>$request->product_id,
            'user_id'=>Auth::user()->id,
            'review'=>$request->review,
            'rate'=>$request->rate,
            'created_at'=>Carbon::now(),
        );
        $insertData = Review::insert($data);
        return redirect()->back();
    }

}
