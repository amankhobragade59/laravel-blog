<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize() { return auth()->check(); }
    public function rules() {
        return [
            'title'=>'required|string|max:255',
            'body'=>'required|string'
        ];
    }
}

