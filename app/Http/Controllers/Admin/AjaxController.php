<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use App\User;

class AjaxController extends Controller
{
    public function autoRefreshComments(Request $request) {
        $post_id = $request->id;
        $getComments = Comment::orderBy('created_at','desc')
        ->join('users','users.id','=','comments.user_id')
        ->select('users.name','users.avatar','users.role','comments.id','comments.post_id','comments.comment','comments.created_at')
        ->where('post_id',$post_id)
        ->take(10)
        ->get();
        return view('admin.panel.commentsAutoRefresh')->with('getComments',$getComments);
    }

    public function deleteComments(Request $request) {
        $comment_id = $request->id;
        Comment::where('id',$comment_id)->delete();
    }
}
