@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
           
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    tags
                    <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sm float-right">NEW</a>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($tags as $tag)
                        <li class="list-group-item">
                            <h3><span class="badge badge-primary">{{ $tag->posts->count() }}</span></h3>
                            {{ $tag->name }}
                            <button class="btn btn-danger btn-sm float-right" onclick="handleDelete({{ $tag->id }})">Delete</button>
                            <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-success btn-sm float-right">Edit</a>

                        </li>

                        @endforeach
                    </ul>


                    {{-- @if ($tags->count() > 0)
                    <ul class="list-group">
                        @foreach ($tags as $tag)
                            <li class="list-group-item">
                                    <h3><span class="badge badge-primary">{{ $tag->posts->count() }}</span></h3>
                                    {{ $tag->name }}
                                    @if ($tag->posts()->count() > 0)
                                        <button class="btn btn-danger btn-sm float-right" disabled>Disabled</button>
                                    @else
                                        <button class="btn btn-danger btn-sm float-right" onclick="handleDelete({{ $tag->id }})">Delete</button>
                                    @endif
                                <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-success btn-sm float-right">Edit</a>
                            </li>
                        @endforeach
                    </ul>
                    @else
                        <h3 class="text-center">No tag</h3>
                    @endif --}}
                    
                    <form action="" method="POST" id="deleteTagForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Do you want to delete this tag?
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
            var form = document.getElementById('deleteTagForm')
            form.action = '/tags/' + id
            // console.log(form);
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
