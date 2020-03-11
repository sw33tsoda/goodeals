<?php

namespace App\Http\Controllers\Admin;

use DB;
use Hash;
use App\User;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UsersPanelRequest;
use Illuminate\Support\Facades\URL;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $usersList = User::orderBy('created_at','desc')->paginate(10);
        return view('admin.panel.usersList')->with('usersList',$usersList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.panel.addUsers');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UsersPanelRequest $request) {
        $arrayWithExcludes = array(
            'avatar' => 'to_be_uploaded',
            'password' => Hash::make($request->password),
        );
        $enableMessage = true;
        if (Input::has('avatar')) {
            $thisLegit = parent::getLegitExtension();
            if (in_array(Input::file('avatar')->getClientOriginalExtension(),$thisLegit) == 1) {
                $fileName = uniqid().'.'.Input::file('avatar')->getClientOriginalExtension();
                $fileDir = storage_path().'/uploads/avatar_images/';
                $moveFile = Input::file('avatar')->move($fileDir,$fileName);
                $thisImage = array('avatar' => $fileName);
                $arrayFinal = array_merge($arrayWithExcludes,$thisImage);
                $message = "Đã thêm.";
                $alert = "success";
            } else {
                $arrayFinal = $arrayWithExcludes;
                $message = "Sai định dạng cho phép , nên không thể thêm ảnh đại diện";
                $alert = "warning";
            }
        } else {
            $arrayFinal = $arrayWithExcludes;
            $message = "Đã thêm.";
            $alert = "success";
        }
        $requestExcept = $request->except('_token','avatar','password'); 
        $forInsert = array_merge($requestExcept,$arrayFinal,array('created_at' => Carbon::now()));
        User::insert($forInsert);
        return redirect()->route('usersList_view')
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
        $userInfo = DB::table('users')->find($id);
        return view('admin.panel.editUsers')->with('userInfo',$userInfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersPanelRequest $request, $id) {
        $arrayWithExcludes = array(
            'password' => Hash::make($request->password),
        );
        $enableMessage = true;
        if (Input::has('avatar')) {
            $thisLegit = parent::getLegitExtension();
            if (in_array(Input::file('avatar')->getClientOriginalExtension(),$thisLegit) == 1) {
                $fileName = uniqid().'.'.Input::file('avatar')->getClientOriginalExtension();
                $fileDir = storage_path().'/uploads/avatar_images/';
                $moveFile = Input::file('avatar')->move($fileDir,$fileName);
                $thisImage = array('avatar' => $fileName);
                $arrayFinal = array_merge($arrayWithExcludes,$thisImage); 
                $message = "Đã sửa.";
                $alert = "success";
            } else {
                $arrayFinal = $arrayWithExcludes;
                $message = "Sai định dạng cho phép , nên không thể sửa ảnh đại diện";
                $alert = "warning";
            }
        } else {
            $arrayFinal = $arrayWithExcludes;
            $message = "Đã sửa.";
            $alert = "success";
        }
        $requestExcept = $request->except('_token','password','avatar'); 
        $forUpdate = array_merge($requestExcept,$arrayFinal,array('updated_at' => Carbon::now()));
        User::where('id',$id)->update($forUpdate);
        return redirect()->route('usersList_view')
            ->with('enableMessage',$enableMessage)
            ->with('alert',$alert)
            ->with('message',$message);
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
                $result = User::where('id',$id)->delete();
                $alert = 'success';
                $message = 'Đã xóa';
                if (!$result) {
                    throw new Exception ('Lại mò nữa rồi');
                }
            } else {
                throw new Exception ('Lại mò nữa rồi');
            }
        }
        catch (Exceptin $e) {
            $alert = 'danger';
            $message = $e->getMessage();
        }
        return redirect()->back()
            ->with('enableMessage',$enableMessage)
            ->with('message',$message)
            ->with('alert',$alert);
    }
}
