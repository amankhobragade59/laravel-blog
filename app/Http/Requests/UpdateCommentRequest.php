<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    public function authorize() {
        $comment=$this->route('comment');
        return $comment && auth()->check() && $comment->user_id===auth()->id();
    }
    public function rules() { return ['content'=>'required|string']; }
}

