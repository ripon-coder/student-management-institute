@extends('layouts.app', ['title' => 'Log Activity'])
@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        @if (\Session::has('success'))
            <div class="container">
                <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
            </div>
        @endif
        <div class="app-card-body">
            @if(!$activity->isEmpty())
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">#ID</th>
                            <th class="cell">Name</th>
                            <th class="cell">Email</th>
                            <th class="cell">Model</th>
                            <th class="cell">Properties</th>
                            <th class="cell">Subject 2</th>
                            <th class="cell">Activity</th>
                            <th class="cell">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activity as $activ)
                            <tr>
                                <td class="cell">#{{ $activ->causer->id }}</td>
                                <td class="cell">{{ $activ->causer->name }}</td>
                                <td class="cell">{{ $activ->causer->email }}</td>
                                <td class="cell">{{ $activ->subject_type}}</td>
                                <td class="cell">@isset($activ->subject->title){{ $activ->subject->title }}@endisset</td>
                                <td class="cell">@isset($activ->subject->batchno){{ $activ->subject->batchno }}@endisset</td>
                                <td class="cell">{{ $activ->description }}</td>
                                <td class="cell">{{ $activ->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            Data Not Found!
            @endif
            <!--//table-responsive-->
        </div>
        <!--//app-card-body-->
        <div class="d-flex justify-content-center pt-4">
            <nav class="app-pagination">
                {{$activity->links("pagination::bootstrap-4")}}
            </nav>
        </div>
    </div>
@endsection
