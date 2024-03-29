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
                    
                    @include('partials.errors')
                    
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
                                {{-- <textarea type="text" class="form-control" name="content" id="content" placeholder="content" cols="5" rows="5">{{ isset($post) ? $post->content : '' }}</textarea> --}}
                                <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                                <trix-editor input="content"></trix-editor>
                                
                        </div>
                        <div class="form-group">
                                <label for="title">Published At</label>
                                <input type="text" class="form-control" name="published_at" id="published_at" placeholder="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
                        </div>
                        @if (isset($post))
                            <div class="form-group">
                                <img src="{{ asset('/storage/'.$post->image) }}" alt="" style="width:100%">
                            </div>  
                        @endif
                        <div class="form-group">
                                <label for="title">Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group">
                                <label for="title">Category</label>
                                <select name="category" id="category" class="form-control">
                                    @foreach ($categories as $category)
                                       <option value="{{ $category->id }}"
                                        @if (isset($post))
                                            @if ($category->id == $post->category_id)
                                                selected
                                            @endif
                                        @endif
                                        
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                        @if ($tags->count() > 0)
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select id="tags" class="form-control tags-selector" name="tags[]" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                        @if (isset($post))
                                            @if($post->hasTag($tag->id))
                                                selected
                                            @endif
                                        @endif
                                        >

                                        {{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        

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


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    @endsection
    
    @section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at',{
            enableTime:true
        });
    </script>
    <script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.tags-selector').select2();
    });
    </script>
@endsection

