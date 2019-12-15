@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end my-2">
    <a href="{{ route('tags.create') }}" class="btn btn-success">Add tag</a>
</div>
<div class="card card-default">
    <div class="card-header">Tags</div>
    <div class="card-body">
        @if($tags->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Post Count</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->posts->count() }}</td>
                        <td>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="handelDelete({{ $tag->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <form action="" method="POST" id="deletetagForm">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="cmsDeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModal">Delete tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-bold"> 
                                Are you Sure? You want to delete this tag. 
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <h3 class="text-center">No tags yet</h3>
        @endif

    </div>
</div>
@endsection

@section('scripts')
    <script>
        function handelDelete(id){
            var form = document.getElementById('deletetagForm');
            form.action = '/tags/' + id;
            $('#cmsDeleteModal').modal('show');
        }
    </script>
@endsection