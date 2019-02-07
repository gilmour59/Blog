@extends('layouts.app')
@section('content')
@include('admin.includes.errors')
    <div class="card">
        <div class="card-header">
            Create Post
        </div>
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="featured">Featured Image</label>
                    <input type="file" class="form-control" name="featured">
                </div>
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="5" rows="5" class="form-control">{{ old('content') }}</textarea>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection