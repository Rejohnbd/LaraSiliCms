@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end my-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
</div>
<div class="card card-default">
    <div class="card-header">Posts</div>
    <div class="card-body">
        @if($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td><img src="{{ asset('storage/'.$post->image) }}" width="120px" height="60px" alt=""></td>
                        <td>{{$post->title}}</td>
                        @if(!$post->trashed()) 
                        <td>
                            <a href="" class="btn btn-info btn-sm">Edit</a>
                        </td>
                        @endif
                        <td>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE') 
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <!-- trashed_method Represent it is has been trash -->
                                    {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center">No Posts yet</h3>
        @endif
    </div>
</div>
@endsection