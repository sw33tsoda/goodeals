<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProductsPanelRequest extends FormRequest
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
            'name' => 'required',
            'developer' => 'required',
            'publisher' => 'required',
            'platform_id' => 'required',
            'price' => 'required|numeric',
            'desc' => 'required',
            'image' => 'file|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    public function messages() {
        return [
            'required' => 'Phần này không được bỏ trống',
            'numberic' => 'Chỉ số',
            'image.mimes' => 'Sai định dạng cho phép (Chỉ : JPEG , PNG)',
            'image.max' => 'Tối đa 2mb',
        ];
    } 
}
