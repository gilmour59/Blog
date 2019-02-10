@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Image
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Edit
                    </th>
                    <th>
                        Delete
                    </th>
                </thead>
                <tbody>
                    @if($posts->count() > 0)
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <img src="{{ $post->featured }}" alt="{{ $post->title }}" width="80px" height="50px">
                                </td>
                                <td>
                                    {{  $post->title }}
                                </td>
                                <td>
                                    <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-sm btn-info">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <th colspan="5" class="text-center">No Posts</th>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection