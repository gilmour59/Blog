@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Category Name
                    </th>
                    <th>
                        Edit
                    </th>
                    <th>
                        Delete
                    </th>
                </thead>
                <tbody>
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-info">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('category.delete', ['id' => $category->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <th colspan="5" class="text-center">No Categories</th>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection