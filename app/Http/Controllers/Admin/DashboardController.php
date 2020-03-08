<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Post;
use App\Comment;
use App\Review;
use Input;
use DB;

class DashboardController extends Controller
{
    public function statistics() {
    	$productsStats = Product::all()->count();
    	$usersStats = User::where('role','user')->count();
        $adminsStats = User::where('role','admin')->count();
        $postsStats = Post::all()->count();
        $commentsStats = Comment::all()->count();
        $reviewsStats = Review::all()->count();
     	//$getProductsStatsPercents = ($productsStats/200)*100; // Hiện tại chưa dùng đến
    	//$getUsersStatsPercents = ($usersStats/500)*100; // Hiện tại chưa dùng đến
    	$toArray = [
    		'usersStats' => $usersStats,
            'adminsStats' => $adminsStats,
    		'productsStats' => $productsStats,
            'postsStats' => $postsStats,
            'commentsStats' => $commentsStats,
            'reviewsStats' => $reviewsStats,
      //       'getUsersStatsPercents' => $getUsersStatsPercents,
    		// 'getProductsStatsPercents' => $getProductsStatsPercents
    	];
    	return view('admin.panel.dashBoard')->with('array',$toArray);
    }

    public function test(Request $request) {
        $data = DB::table('users')->get();
        return response()->json($data);
    }

    public function test_view(Request $request) {
        return view('test');
    }
}
