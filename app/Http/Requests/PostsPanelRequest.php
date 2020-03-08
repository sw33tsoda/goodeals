<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PostsPanelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->role == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required|max:32000',
            'image' => 'file|mimes:jpeg,jpg,png|max:2048',
            'author' => 'required',
        ];
    }

    public function messages() {
        return [
            'required' => 'Phần này không được để trống',
            'max' => 'Tối đa 32000 chữ',
            'image.mimes' => 'Sai định dạng cho phép (Chỉ : JPEG , PNG)',
            'image.max' => 'Tối đa 2mb',
        ];
    }
}
