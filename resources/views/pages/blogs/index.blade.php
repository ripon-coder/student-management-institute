@extends('layouts.app', ['title' => 'Student Feedback'])

@section('content')
    <div class="pb-2">
        <a href="{{ route('blogs-admin.create') }}"><button type="button" class="btn app-btn-primary ">Add New
                Blog</button></a>
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        @if (\Session::has('success'))
            <div class="container">
                <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
            </div>
        @endif
        <div class="app-card-body">
            @if (!$blogs->isEmpty())
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">#ID</th>
                                <th class="cell">Title</th>
                                <th class="cell">Image</th>
                                <th class="cell">Created Date</th>
                                <th class="cell">Edit</th>
                                <th class="cell">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $item)
                                <tr>
                                    <td class="cell">#{{ $item->id }}</td>
                                    <td class="cell">{{ $item->title }}</td>
                                    <td class="cell"><a
                                            href="{{ url(Storage::url('blogs/' . $item->image)) }}"><img width="60"
                                                src="{{ url(Storage::url('blogs/' . $item->image)) }}"></a></td>
                                    <td class="cell">{{ $item->created_at }}</td>
                                    <td class="cell"><a class="btn-sm app-btn-primary"
                                            href="{{ route('blogs-admin.edit', $item->id) }}">Edit</a></td>
                                    <td class="cell">
                                        {{Form::open(['url' => URL::Route('blogs-admin.destroy', $item->id), 'method' => 'DELETE', 'name' => 'delete']) }}
                                            <button onclick="return confirm('Are you sure want to delete?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Data Not Found!
                </div>
            @endif
            <!--//table-responsive-->
        </div>
        <!--//app-card-body-->
        <div class="d-flex justify-content-center pt-4">
            <nav class="app-pagination">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
