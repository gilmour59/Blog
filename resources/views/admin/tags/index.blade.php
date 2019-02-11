@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Tag Name
                    </th>
                    <th>
                        Edit
                    </th>
                    <th>
                        Delete
                    </th>
                </thead>
                <tbody>
                    @if($tags->count() > 0)
                        @foreach($tags as $tag)
                            <tr>
                                <td>
                                    {{ $tag->tag }}
                                </td>
                                <td>
                                    <a href="{{ route('tag.edit', ['id' => $tag->id]) }}" class="btn btn-sm btn-info">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('tag.delete', ['id' => $tag->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete"/>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <th colspan="5" class="text-center">No Tags</th>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection