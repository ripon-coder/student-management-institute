@extends('layouts.app', ['title' => 'Payment Activities'])
@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="p-3">
                <div class="row ">
                    <div class="col-md-6">
                     <form action="{{route('payment.date')}}" method="GET">
                        <div class="input-group p-1">
                            <input type="date" class="form-control" name="date" required>
                            <button type="submit" class="btn btn-primary text-white input-group-text">Search</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                      <form action="{{route('payment.month')}}" method="GET">
                        <div class="input-group p-1">
                            <input type="month" name="month" class="form-control">
                            <button type="submit" class="btn btn-primary text-white input-group-text">Search</button>
                        </div>
                     </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">REG NO</th>
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
                                                                <td class="cell">{{ $item->method }} <br>
                                    <a class="text-white btn-sm bg-info"href="{{route('payment',$item->student->id)}}">Edit</a>
                                    
                                </td>
                                <td class="cell">{{ $item->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
