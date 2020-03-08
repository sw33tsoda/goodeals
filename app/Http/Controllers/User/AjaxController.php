<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Post;
use App\PostCategory;
use App\Comment;
use App\User;
use Carbon\Carbon;
use Auth;


class AjaxController extends Controller
{
	public function theComment(Request $request) {
        $getCommentsOnThisPost = Comment::where('post_id',$request->id)->orderBy('created_at','desc')->get();
        $getUsersInfo = User::all();
        return view('user.post.theComment',['comments'=>$getCommentsOnThisPost,'users'=>$getUsersInfo]);
    }

    public function addComment(Request $request) {
    	if (Auth::check()) {
    		$userId = Auth::user()->id;
    	} else {
    		$userId = NULL;
    	}
    	$addComment = Comment::insert([
    		'post_id'=>$request->post_id,
    		'user_id'=>$userId,
    		'comment'=>$request->comment,
    		'created_at'=>Carbon::now(),
    	]);
    }

    public function deleteComment(Request $request) {
    	$deleteThisComment = Comment::where('id',$request->id)->delete();
    }

    public function clearComments() { // UNUSED
    	$clearComments = Comment::all()->delete();
    }
}
