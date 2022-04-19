@extends('layouts.app', ['title' => 'Course Managament'])

@section('content')
    <div class="pb-2">
        <a href="{{ route('course.create') }}"><button type="button" class="btn app-btn-primary ">Add New
                Course</button></a>
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        @if (\Session::has('success'))
            <div class="container">
                <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
            </div>
        @endif
        <div class="app-card-body">
            @if (!$cousers->isEmpty())
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">#ID</th>
                                <th class="cell">Course Name</th>
                                <th class="cell">Regular Amount(TK)</th>
                                <th class="cell">Discount Amount (Tk)</th>
                                <th class="cell">Discount</th>
                                <th class="cell">Created Date</th>
                                <th class="cell">Status</th>
                                <th class="cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cousers as $course)
                                <tr>
                                    <td class="cell">#{{ $course->id }}</td>
                                    <td class="cell">{{ $course->title }}</td>
                                    <td class="cell">{{ $course->price }}</td>
                                    <td class="cell">{{ $course->discount_price }}</td>
                                    <td class="cell">{{ round($course->discount,2) }}%</td>
                                    <td class="cell">{{ $course->created_at }}</td>
                                    <td class="cell">
                                        @if ($course->status == 1)
                                            <span class="badge bg-info">Active</span>
                                        @else
                                            <span class="badge bg-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td class="cell"><a class="btn-sm app-btn-primary"
                                            href="{{ route('course.edit', $course->id) }}">Edit</a></td>
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
                {{ $cousers->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
