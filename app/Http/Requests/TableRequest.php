<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
                'table_id_from' => 'required|numeric',
                'table_name_to' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'Vui lòng nhập :attribute ',
            'numeric'=>':attribute không đúng định dạng',
        ];
    }
    public function attributes(){
        return [
            'table_name_to'=>'Số bàn',
        ];
    }
}
