@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
            <div class="card car-default">
                <div class="card-header">
                        {{ isset($tag) ? 'Edit tag' : 'Create new Tag' }}
                </div>
                <div class="card-body">
                    
                    @include('partials.errors')
                    
                    <form action="{{ isset($tag) ? route('tags.update',$tag->id) : route('tags.store')}}" method="POST">
                        @csrf
                        
                        @if (isset($tag))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="name" value="{{ isset($tag) ? $tag->name : '' }}">
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-success" type="submit">
                               {{ isset($tag) ? 'Update Tag' : 'Create Tag' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

@endsection
