<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Post;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PostsPanelRequest;
use App\Comment;
use App\PostCategory;


class PostsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $postsList = Post::orderBy('created_at','desc')->paginate(10);
        return view('admin.panel.postsList')->with('postsList',$postsList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $showCategories = PostCategory::all();
        return view('admin.panel.addPosts',['showCategories' => $showCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsPanelRequest $request) {
        $arrayWithExcludes = array(
            'user_id' => Auth::user()->id,
            'image' => 'to_be_uploaded',
        );
        $enableMessage = true;
        $arrayFinal = $arrayWithExcludes;
        $message = "Đã thêm.";
        $alert = "success";
        if (Input::has('image')) {
            $thisLegit = parent::getLegitExtension();
            if (in_array(Input::file('image')->getClientOriginalExtension(),$thisLegit) == 1) {
                $fileName = uniqid().'.'.Input::file('image')->getClientOriginalExtension();
                $fileDir = storage_path().'/uploads/post_images/';
                $moveFile = Input::file('image')->move($fileDir,$fileName);
                $thisImage = array('image' => $fileName);
                $arrayFinal = array_merge($arrayWithExcludes,$thisImage);
            } else {
                $message = "Sai định dạng cho phép , nên chỉ thêm được nội dung";
                $alert = "warning";
            }
        }

        ///////////////////////////////// KHÔNG DÙNG /////////////////////////////////////////
        // $saveImage = parent::saveImage(Input::has('image'),Input::file('image'),'avatar',$arrayWithExcludes,'/uploads/post_images');
        // $arrayFinal     = $saveImage['arrayFinal'];
        // $alert          = $saveImage['alert'];
        // $message        = $saveImage['message'];
        // $requestExcept  = $request->except('_token','image');
        //////////////////////////////////////////////////////////////////////////////////////

        $requestExcept = $request->except('_token','image'); 
        $forInsert = array_merge($requestExcept,$arrayFinal,array('created_at' => Carbon::now()));
        Post::insert($forInsert);
        return redirect()->route('postsList_view')
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
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $postInfo = Post::find($id);
        $postCategories = PostCategory::all();
        $postCategoriesById = PostCategory::find($postInfo->category_id);
        return view('admin.panel.editPosts')->with('postInfo',$postInfo)->with('showCategories',$postCategories)->with('postCategoriesById',$postCategoriesById);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsPanelRequest $request, $id) {
        $arrayWithExcludes = array(
            'user_id' => Auth::user()->id,
        );
        $enableMessage = true;
        $arrayFinal = $arrayWithExcludes;
        $message = "Đã thêm.";
        $alert = "success";
        if (Input::has('image'))  {
            $thisLegit = parent::getLegitExtension();
            if (in_array(Input::file('image')->getClientOriginalExtension(),$thisLegit) == 1) {
                $fileName = uniqid().'.'.Input::file('image')->getClientOriginalExtension();
                $fileDir = storage_path().'/uploads/post_images/';
                $moveFile = Input::file('image')->move($fileDir,$fileName);
                $thisImage = array('image' => $fileName);
                $arrayFinal = array_merge($arrayWithExcludes,$thisImage);
            } else {
                $message = 'Vì sai định dạng file cho phép , nên chỉ cập nhật được nội dung';
                $alert = 'warning';
            }
        }

        ///////////////////////////////// KHÔNG DÙNG /////////////////////////////////////////
        // $saveImage = parent::saveImage(Input::has('image'),Input::file('image'),'avatar',$arrayWithExcludes,'/uploads/post_images');
        // $arrayFinal     = $saveImage['arrayFinal'];
        // $alert          = $saveImage['alert'];
        // $message        = $saveImage['message'];
        // $requestExcept  = $request->except('_token','image');
        //////////////////////////////////////////////////////////////////////////////////////

        $requestExcept = $request->except('_token','image');
        $forUpdate = array_merge($requestExcept,$arrayFinal);
        Post::where('id',$id)->update($forUpdate);
        return redirect()->route('postsList_view')
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
    public function destroy($id) {
        $enableMessage = true;
        try {
            if (is_numeric($id)) {
                $result = Post::where('id',$id)->delete();
                $alert = 'success';
                $message = 'Đã xóa';
                if (!$result) {
                    throw new Exception('Không hợp lệ');
                }
            } else {
                throw new Exception('Không hợp lệ');
            }
        } catch (Exception $e) {
            $alert = 'danger';
            $message = $e->getMessage();
        }
        return redirect()->back()
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }
}
