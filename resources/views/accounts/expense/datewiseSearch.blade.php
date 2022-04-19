@extends('layouts.app', ['title' => 'Expense'])
@section('content')
<div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="p-2">
                <p>@isset($date)<b>DATE: {{ $date }} |@endisset Total Amount: {{ $expense->sum('amount') }} Tk</b></p>
            </div>
            @if (!$expense->isEmpty())
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">#ID</th>
                                <th class="cell">User</th>
                                <th class="cell">Title</th>
                                <th class="cell">Expense Type</th>
                                <th class="cell">Amount</th>
                                <th class="cell">Date</th>
                                <th class="cell">Edit</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expense as $item)
                                <tr>
                                    <td class="cell">{{ $item->id }}</td>
                                    <td class="cell">{{ $item->user->name }}</td>
                                    <td class="cell">{{ $item->title }}</td>
                                    <td class="cell">{{ $item->expensetype }}</td>
                                    <td class="cell">৳ {{ round($item->amount,2) }} </td>
                                    <td class="cell">{{ $item->created_at }}</td>
                                    <td class="cell"><a class="btn-sm app-btn-primary"
                                        href="{{ route('expense.edit', $item->id) }}">Edit</a></td>
                                    <td class="cell">
                                        {{ Form::open(['url' => URL::Route('expense.destroy', $item->id), 'method' => 'DELETE', 'name' => 'delete']) }}
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-danger btn-sm text-white">Delete</button>
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
                {{ $expense->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection
