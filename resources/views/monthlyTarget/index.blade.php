@extends('layouts.app', ['title' => 'Monthly Target'])
@section('content')
    <div class="pb-2">
        <a href="{{ route('target.create') }}"><button type="button" class="btn app-btn-primary ">Add New</button></a>
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        @if (\Session::has('success'))
            <div class="container">
                <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
            </div>
        @endif
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">#ID</th>
                            <th class="cell">Title</th>
                            <th class="cell">Required Amount</th>
                            <th class="cell">Target Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($targated as $item)
                            <tr>
                                <td class="cell">#{{ $item->id }}</td>
                                <td class="cell">{{ $item->title }}</td>
                                <td class="cell">{{ $item->requiredAmount }} TK</td>
                                <td class="cell">{{ $item->targetmonth }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--//table-responsive-->
        </div>
        <!--//app-card-body-->
        <div class="d-flex justify-content-center pt-4">
            <nav class="app-pagination">
                {{$targated->links("pagination::bootstrap-4")}}
            </nav>
        </div>
    </div>
@endsection
