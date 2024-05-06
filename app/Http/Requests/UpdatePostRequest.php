<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'user_id'       => 'required',  
            'title'         => 'required',  
            'image'         => 'nullable|image|file|mimes:png,jpg,jpeg,webp|max:3076', 
            'desc'          => 'required',    
            'status'        => 'required',  
            'publish_date'  => 'required'
        ];
    }
}
