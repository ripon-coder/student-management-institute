@extends('layouts.app', ['title' => 'Batch Managament'])

@section('content')
    <div class="pb-2">
        <a href="{{ route('batch.create') }}"><button type="button" class="btn app-btn-primary ">Add New
                Batch</button></a>
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        @if (\Session::has('success'))
            <div class="container">
                <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
            </div>
        @endif
        <div class="app-card-body">
            @if (!$batchs->isEmpty())
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">#ID</th>
                                <th class="cell">Batch No</th>
                                <th class="cell">Course Name</th>
                                <th class="cell">Duration</th>
                                <th class="cell">Start Date</th>
                                <th class="cell">End Date</th>
                                <th class="cell">Mentor</th>
                                <th class="cell">Ex-St</th>
                                <th class="cell">Report</th>
                                <th class="cell">Status</th>
                                <th class="cell">Edit</th>
                                <th class="cell">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batchs as $batch)
                                <tr>
                                    <td class="cell">#{{ $batch->id }}</td>
                                    <td class="cell">{{ $batch->batchno }}</td>
                                    <td class="cell">{{ $batch->course->title }}</td>
                                    <td class="cell">{{ $batch->duration }}</td>
                                    <td class="cell">{{ $batch->startdate }}</td>
                                    <td class="cell">{{ $batch->enddate }}</td>
                                    <td class="cell">{{ $batch->user->name }}</td>
                                    <td class="cell">{{ $batch->expectedStudent }}</td>
                                    <td class="cell">
                                        <a class="btn-sm bg-success text-white" href="{{route('fullypaidbatch',$batch->id )}}">Fully-Paid ( {{ $batch->fullPaid }} ) </a><br>
                                        <a class="btn-sm bg-secondary text-white" href="{{route('duepaidbatch',$batch->id )}}">Due-Paid ( {{ $batch->duePaid }} ) </a><br>
                                        <a class="btn-sm bg-danger text-white" href="{{route('unpaidbatch',$batch->id )}}">Un-Paid ( {{ $batch->unpaid }} ) </a>
                                    </td>
                                    <td class="cell">@if($batch->status == 1) <span class="badge bg-info">Active</span>@else <span class="badge bg-danger">Disabled</span> @endif</td>
                                    <td class="cell"><a class="btn-sm app-btn-primary"
                                            href="{{ route('batch.edit', $batch->id) }}">Edit</a></td>
                                    <td class="cell">
                                        <a class="btn-sm app-btn-secondary"
                                            href="{{ route('batch.show', $batch->id) }}">View</a>
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
                {{ $batchs->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
