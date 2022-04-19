@extends('layouts.app', ['title' => 'Add New Expense'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Update Expense</h1>
        <div class="app-card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="list-unstyled">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('expense.update', $expense->id) }}" method="POST" class="settings-form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="course" class="form-label">Title*</label>
                    <input type="text" value="{{ $expense->title }}" name="title" class="form-control" id="course">
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Expense Type</label>
                    <select class="form-select" name="expenseType">
                        <option value="0">--Select--</option>
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
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">User To*</label>
                    <select class="form-select" name="toUser">
                        <option value="">--Select--</option>
                        @foreach ($users as $item)
                            <option @if($expense->userId == $item->id) selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount*</label>
                    <input type="number" value="{{ $expense->amount }}" name="amount" class="form-control" id="amount">
                </div>
                <div class="mb-3" x-show="show">
                    <label for="amount" class="form-label">Custom Date(you can skip it)</label>
                    <input type="date" value="{{ $expense->created_at }}" name="customdate" class="form-control">
                </div>

                <button type="submit" class="btn app-btn-primary"> Save</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
