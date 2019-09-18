@extends('layouts.app')

@section('content')
    <div class="container">
        
    
        <div class="d-flex justify-content-end mb-2">
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card card-default">
            <div class="card-header">
                Posts
                @if (!$trashed)
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right"> Add Post</a>
                @endif
            </div>
            <div class="card-body">
                @if ($posts->count() > 0)
                    <table class="table">
                        <thead class="thead">
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($posts as $post)
                                <tr>
                                    <td><img src="{{ asset('/storage/'.$post->image) }}" width="120px" height="120px" alt=""></td>
                                    <td>{{ $post->title }}</td>

                                    <td>
                                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"  class="btn btn-danger btn-sm float-right">
                                                {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                            </button>
                                        </form>
                                        @if (!$post->trashed())
                                            <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary btn-sm float-right">Edit</a>
                                        @endif
                                        
                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No Posts</h3>
                @endif
                

            </div>
        </div>
    </div>



@endsection