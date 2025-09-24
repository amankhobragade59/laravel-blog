@extends('layouts.app')

@section('content')
    <h1>Edit Comment</h1>
    <form action="{{ route('comments.update',$comment) }}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="content" rows="4" required>{{ old('content',$comment->content) }}</textarea>
        <button type="submit" class="btn">Update</button>
    </form>
@endsection
