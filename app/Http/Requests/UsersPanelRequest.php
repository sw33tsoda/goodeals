<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UsersPanelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if (Auth::user()->role == 'admin') {
        //     return true;
        // } else {
        //     return false;
        // }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'avatar' => 'file|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Phần này không được để trống',
            'password.min' => 'Mật khẩu quá ngắn , tối thiểu 8 ký tự',
            'email' => 'Sai định dạng Email',
            // 'unique' => 'Địa chỉ Email này đã tồn tại',
            'avatar.mimes' => 'Sai định dạng cho phép (Chỉ : JPEG , PNG)',
            'avatar.max' => 'Tối đa 2mb',
        ];
    }
}
