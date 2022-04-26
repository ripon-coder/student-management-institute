@extends('layouts.app', ['title' => 'Payment Activities'])
@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        @if(!$history->isEmpty())
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table table-bordered app-table-hover mb-0 text-left">
                    <thead>
                            <th class="cell">Pay-By</th>
                            <th class="cell">Date</th>
                            <th class="cell">Amount</th>
                            <th class="cell">Method</th>
                            <th class="cell">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $item)
                            <tr>
                                <td colspan="5" class="cell text-center bg-secondary text-white">{{$item->id}} - {{$item->name}}</td>
                            </tr>
                            @foreach ($item->payment as $his)
                            <tr>
                                <td class="cell">{{$his->reference->name}}</td>
                                <td class="cell">{{$his->created_at}}</td>
                                <td class="cell">{{number_format($his->amount,2)}} ৳</td>
                                <td class="cell">{{$his->method}}</td>
                                <td class="cell">{{$his->note}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--//table-responsive-->

        </div>
        <!--//app-card-body-->
        @else
        <p>Data Not Found!</p>
        @endif
    </div>

    <div class="d-flex justify-content-center">
        <nav class="app-pagination">
            {!! $history->links('pagination::bootstrap-4') !!}
        </nav>
    </div>
@endsection
