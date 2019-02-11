@extends('layouts.app')
@section('content')
@include('admin.includes.errors')
    <div class="card">
        <div class="card-header">
            Create Tag
        </div>
        <div class="card-body">
            <form action="{{ route('tag.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tag">Name</label>
                    <input type="text" class="form-control" name="tag" value="{{ old('tag') }}">
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