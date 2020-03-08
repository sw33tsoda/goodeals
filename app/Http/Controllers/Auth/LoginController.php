<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo() 
    {
        if (Auth::user()->role == 'admin') {
            return '/admin/index';
        } else if (Auth::user()->role == 'user') {
            return '/user/index';
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('login_view');
    }
    
        /**
     * Get a validator for an incoming auth* request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = array(
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
        );
        $messages = array(
            'required' => 'Không được bỏ trống chổ này',
            'min' => 'Tối thiểu 8 chữ',
            'max' => 'Tối đa 255 chữ',
        );
        return Validator::make($data,$rules,$messages);
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
