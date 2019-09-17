@extends('layouts.app')

@section('content')
<h1 class="text-center my-2">{{ isset($category) ? 'Edit Post' : 'Create Post' }}</h1>
<div class="row justify-content-center">
    <div class="col-md-12">
            <div class="card car-default">
                <div class="card-header">
                        {{ isset($post) ? 'Edit Post' : 'Create new Post' }}
                </div>
                <div class="card-body">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item">{{ $error }}</li>
                                @endforeach
                               
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ isset($post) ? route('posts.update',$post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @if (isset($post))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="title" value="{{ isset($post) ? $post->title : '' }}">
                        </div>
                        <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" name="description" id="description" placeholder="description" cols="5" rows="5">{{ isset($post) ? $post->description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                                <label for="content">Content</label>
                                <textarea type="text" class="form-control" name="content" id="content" placeholder="content" cols="5" rows="5">{{ isset($post) ? $post->content : '' }}</textarea>
                        </div>
                        <div class="form-group">
                                <label for="title">Published At</label>
                                <input type="text" class="form-control" name="published_at" id="published_at" placeholder="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
                        </div>
                        <div class="form-group">
                                <label for="title">Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                        </div>

                        <div class="form-group float-right">
                            <button class="btn btn-success" type="submit">
                               {{ isset($post) ? 'Update Post' : 'Create Post' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
    </div>
</div>

@endsection
