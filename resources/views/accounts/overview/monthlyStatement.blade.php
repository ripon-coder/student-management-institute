@extends('layouts.app', ['title' => 'Monthly Statement'])
@section('content')
<h3>Year - {{Date('Y')}}</h3>
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
                                <th class="cell">Month Name</th>
                                <th class="cell">Collection(TK)</th>
                                <th class="cell">Expense(TK)</th>
                                <th class="cell">Net Collection(TK)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maindata as $key=>$data)
                                <tr>
                                    <td class="cell">{{$monthname[$key]}}</td>
                                    <td class="cell">{{ number_format($data[1], 2, '.', ',')}}</td>
                                    <td class="cell">{{ number_format($data[0], 2, '.', ',')}}</td> 
                                    <td class="cell">{{ number_format($data[1]-$data[0], 2, '.', ',')}}</td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <!--//table-responsive-->
        </div>
    </div>
@endsection
