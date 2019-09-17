@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Posts
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right">NEW POST</a>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <ul class="list-group">
                        @foreach ($posts as $post)
                            <li class="list-group-item">
                                {{ $post->title }}
                                <button class="btn btn-danger btn-sm float-right" onclick="handleDelete({{ $post->id }})">Delete</button>
                                <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-success btn-sm float-right">Edit</a>
                            </li>
                        @endforeach
                    </ul>
                    <form action="" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Close</button>
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function handleDelete(id){
            var form = document.getElementById('deleteCategoryForm')
            form.action = '/categories/' + id
            // console.log(form);
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
