@extends('layouts.app')

@section('content')
<h1 class="text-center my-2">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h1>
<div class="row justify-content-center">
    <div class="col-md-12">
            <div class="card car-default">
                <div class="card-header">
                        {{ isset($category) ? 'Edit Category' : 'Create new Category' }}
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
