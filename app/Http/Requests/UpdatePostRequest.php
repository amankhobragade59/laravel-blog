<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize() {
        $post = $this->route('post');
        return $post && auth()->check() && $post->user_id===auth()->id();
    }
    public function rules() {
        return [
            'title'=>'required|string|max:255',
            'body'=>'required|string'
        ];
    }
}

