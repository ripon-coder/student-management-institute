@extends('layouts.app', ['title' => 'Payment Activities Search'])
@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">

                    <div class="p-2">
                        <p><b>DATE: {{ $date }} | Total Amount: {{ $paymentmodels->sum('amount') }} Tk</b></p>
                    </div>

                @if (!$paymentmodels->isEmpty())
                    <table class="table table-bordered app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                
                                <th class="cell">Registration No</th>
                                <th class="cell">Name</th>
                                <th class="cell">Course</th>
                                <th class="cell">Date</th>
                                <th class="cell">Ref</th>
                                <th class="cell">PayBy</th>
                                <th class="cell">Amount</th>
                                <th class="cell">Method</th>
                                <th class="cell">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentmodels as $item)
                                <tr>
                                    <td class="cell">{{ $item->student->id }}</td>
                                    <td class="cell">{{ $item->student->name }}</td>
                                     <td class="cell">{{ $item->student->course->title }}</td>
                                    <td class="cell">{{ $item->created_at }}</td>
                                    <td class="cell">{{ $item->student->referenced->name}}</td>
                                    <td class="cell">{{ $item->reference->name }}</td>
                                    <td class="cell">{{ number_format($item->amount, 2) }} TK</td>
                                    <td class="cell">{{ $item->method }}</td>
                                    <td class="cell">{{ $item->note }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger" role="alert">
                        DATA NOT FOUND!
                    </div>
                @endif
            </div>
            <!--//table-responsive-->

        </div>
        <!--//app-card-body-->
    </div>

    <div class="d-flex justify-content-center">
        <nav class="app-pagination">
            {!! $paymentmodels->links('pagination::bootstrap-4') !!}
        </nav>
    </div>
@endsection
