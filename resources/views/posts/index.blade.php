@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end my-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
</div>
@endsection