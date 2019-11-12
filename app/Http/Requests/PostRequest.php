<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            /*
            'name' => 'required|string:posts,name',
            'email' => 'required|string:posts,email',
            'content' => 'required|text:posts,content',
            'status' => 'required|integer|min:0|max:2'
            */
        ];

        return  $rules;

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'id' => 'required|integer|exists:posts,id'
                    ] + $rules; // и берем все остальные правила
            // case 'PATCH':
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:posts,id'
                ];
        }
    }
}
