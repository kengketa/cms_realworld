@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
            <div class="card car-default">
                <div class="card-header">
                        {{ isset($category) ? 'Edit Category' : 'Create new Category' }}
                </div>
                <div class="card-body">
                    
                    @include('partials.errors')
                    
                    <form action="{{ isset($category) ? route('categories.update',$category->id) : route('categories.store')}}" method="POST">
                        @csrf
                        
                        @if (isset($category))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="name" value="{{ isset($category) ? $category->name : '' }}">
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-success" type="submit">
                               {{ isset($category) ? 'Update Category' : 'Create Category' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

@endsection
