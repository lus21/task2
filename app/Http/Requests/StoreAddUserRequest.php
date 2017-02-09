<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddUserRequest extends FormRequest
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
            'f_name' => 'required',            
            'email' => 'required|email|unique:users',
            'l_name' => 'required',
            'keywords' => 'required',    
            'password' => 'required|min:6',
            'conf_pass' => 'required|same:password',  
            'fileToUpload' => 'required|mimes:doc,docx,pdf,txt', 
        ];
    }
}
