@extends('layouts.app', ['title' => 'Expense Manage'])
@section('content')
    <div class="pb-2">
        <a href="{{ route('expense.create') }}"><button type="button" class="btn app-btn-primary ">Add New
                Expense</button></a>
    </div>
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        @if (\Session::has('success'))
            <div class="container">
                <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
            </div>
        @endif

        <div class="app-card-body">
            <div class="p-3">
                <p><b>Total Amount: {{ $expense->sum('amount') }} Tk</b></p>
                <div class="row ">
                    <div class="col-md-12">
                        <form action="{{ route('datewiseSearch') }}" method="GET">
                            <div class="input-group p-1">
                                <select class="form-select" name="toUser">
                                    <option value="">--Select User--</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <select class="form-select" name="expenseType">
                                    <option value="">--Select Expense Type--</option>
                                    <option>Salary</option>
                                    <option>Transport</option>
                                    <option>Snacks</option>
                                    <option>Purchase</option>
                                    <option>Utlities</option>
                                    <option>House rent</option>
                                    <option>Mobile cost</option>
                                    <option>Boosting cost</option>
                                    <option>Stationary cost</option>
                                    <option>Office Expense</option>
                                    <option>Computer Accessories</option>
                                    <option>Loan Repayment cost</option>
                                    <option>Dividend Shares</option>
                                    <option>Entertainment</option>
                                    <option>Internet Cost</option>
                                    <option>Bonus</option>
                                    <option>Gift Money</option>
                                    <option>Leadership Incentive</option>
                                </select>
                                <input type="date" class="form-control" name="date">
                                <button type="submit" class="btn btn-primary text-white input-group-text">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <form action="{{ route('monthwiseSearch') }}" method="GET">
                            <div class="input-group p-1">
                                <select class="form-select" name="toUser">
                                    <option value="">--Select User--</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <select class="form-select" name="expenseType">
                                    <option value="">--Select Expense Type--</option>
                                    <option>Salary</option>
                                    <option>Transport</option>
                                    <option>Snacks</option>
                                    <option>Purchase</option>
                                    <option>Utlities</option>
                                    <option>House rent</option>
                                    <option>Mobile cost</option>
                                    <option>Boosting cost</option>
                                    <option>Stationary cost</option>
                                    <option>Office Expense</option>
                                    <option>Computer Accessories</option>
                                    <option>Loan Repayment cost</option>
                                    <option>Dividend Shares</option>
                                    <option>Entertainment</option>
                                    <option>Internet Cost</option>
                                    <option>Bonus</option>
                                    <option>Gift Money</option>
                                    <option>Leadership Incentive</option>
                                </select>
                                <input type="month" name="month" class="form-control">
                                <button type="submit" class="btn btn-primary text-white input-group-text">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                                    <td class="cell">{{ round($item->amount, 2) }} Tk </td>
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
