<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'        => 'required|max:255',
            'description'  => 'required',
            'budget'       => 'required|integer|min:0',
            'requirement'  => 'required',
            'company_id'   => 'required',
            'category_id'  => 'required',
            'position_id'  => 'required',
            'city_id'      => 'required',
            'deadline'     => 'required|date|after:tomorrow',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Tiêu đề công việc không được phép để trống',
            'description.required'  => 'Mô tả không được phép để trống',
            'budget.required'       => 'Mức lương không được phép để trống',
            'budget.integer'        => 'Mức lương phải là một số',
            'budget.min:0'          => 'Mức lương cần phải lớn hơn 0',
            'requirement.required'  => 'Yêu cầu công việc không được phép để trống',
            'company_id.required'   => 'Tên không được phép để trống',
            'category_id.required'  => 'Tên không được phép để trống',
            'position_id.required'  => 'Tên không được phép để trống',
            'city_id.required'      => 'Tên không được phép để trống',
            'title.required'        => 'Tên không được phép để trống',
            'deadline.required'     => 'Deadline ứng tuyển không được phép để trống',
            'deadline.date'         => 'Tên không được phép để trống',
            'deadline.after:tomorrow'  => 'Deadline ứng tuyển không được kết thúc trước hôm nay',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

}
