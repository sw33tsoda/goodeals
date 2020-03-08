<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Comment;
use App\Review;
use App\Http\Requests\UsersPanelRequest;
use Illuminate\Support\Facades\Input;
use DB;

class SettingsController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }

    public function showSettings(Request $request) 
    {
        $getUserInfo = User::find($request->id);
        return view('user.userSettings.settings',['userInfo'=>$getUserInfo]);
    }

    public function showUserInformation() {
        return view('user.userSettings.userInformation');
    }

    public function editProfile(UsersPanelRequest $request) 
    {
        if (Auth::user()->id == $request->id) {
            $getUserInfo = User::find($request->id);
            if ($getUserInfo) {
                $getUserInfo->name = $request->name;
                $getUserInfo->email = $request->email;
                $getUserInfo->password = Hash::make($request->password);
                $getUserInfo->save();
            }
        }
        $msg = ($getUserInfo->save() ? "Đã sửa thành công" : "Thất bại");
        return redirect()->back()->with('msg',$msg);
    }

    public function editAvatar(Request $request)
    {
        return view('user.userSettings.avatarUpdate');
    }

    public function uploadAvatar(Request $request) {
        if (Auth::user()->id == $request->id) {
            $fileName = uniqid().'.'.$request->avatar->getClientOriginalName();
            $getInfo = User::where('id',Auth::user()->id)->update(array('avatar'=>$fileName));
            if ($request->hasFile('avatar')) {
                $fileDir = storage_path().'/uploads/avatar_images/';
                $moveFile = $request->avatar->move($fileDir,$fileName);
            }
        }
        //$msg = ($moveFile ? "Đã sửa thành công" : "Thất bại"); //unused
        return redirect()->back(); //unused
    }

    public function deleteYourCart()
    {
        DB::table('cart')->where('user_id',Auth::user()->id)->delete();
    }

    public function showYourComments(Request $request)
    {
    	$day = Carbon::now()->day;
    	$month = Carbon::now()->month;
    	$year = Carbon::now()->year;
    	$dateOnly = Carbon::now()->toDateString();
    	$countAllComments = Comment::where('user_id',Auth::user()->id)->count();
    	$countCommentsToday = Comment::where('user_id',Auth::user()->id)->where('created_at','LIKE',$dateOnly.'%')->count();
    	$getCommentsToday = Comment::orderBy('created_at','desc')->where('user_id',Auth::user()->id)->where('created_at','LIKE',$dateOnly.'%')->get();
    	$excludeToday = $countAllComments - $getCommentsToday->count();
    	$skipExcludeToday = $countAllComments - $excludeToday;
    	$getAllComments = Comment::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->skip($skipExcludeToday)->take($excludeToday)->get();
    	return view('user.userSettings.yourComments',['comments'=>$getAllComments,'todayComments'=>$getCommentsToday]);
    }

    public function deleteComment(Request $request, $id) {
		Comment::where('id',$id)->delete();
		return redirect()->back();
    }

    public function deleteAllComments()
    {
    	Comment::where('user_id',Auth::user()->id)->delete();
    	return redirect()->back();
    }

    public function showYourReviews(Request $request) {
    	$getAllReviews = Review::where('user_id',Auth::user()->id)->get();
    	return view('user.userSettings.yourReviews',['reviews'=>$getAllReviews]);
    }

    public function deleteReview(Request $request) { //unused
    	Review::where('id',$request->id)->delete();
    	return redirect()->back();
    }

    public function deleteAllReviews() {
        review::where('user_id',Auth::user()->id)->delete();
        return redirect()->back();
    }

    public function setDefault(Request $request)
    {
        $this->deleteAllComments();
        $this->deleteYourCart();
        $this->deleteAllReviews();
    	return redirect()->back();
    }

    public function deleteAccount(Request $request)
    {
    	$getUser = User::find($request->id);
    	$getUser->delete();
    	return route('logout');

    	// Chưa thử
    }
}
