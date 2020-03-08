<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ReviewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) return true;
        else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rate' => 'required|numeric|max:5'
        ];
    }

    public function messages()
    {
        return [
            'rate.required' => 'Vui lòng cho biết điểm số',
            'rate.max' => 'Điểm tối đa bạn có thể cho là 5 điểm.',
            'rate.numeric' => 'Điểm đánh giá chỉ cho phép bằng số.',
        ];
    }
}
