@extends('layouts.app', ['title' => 'Overview'])
@section('content')
    <div class="">
        <div class="row g-4 mb-4">

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Today Collection</h4>
                        <div class="stats-figure">৳{{ number_format($data['todayCollection'], 2, '.', ',')}}</div>
                    </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Monthly Collection</h4>
                        <div class="stats-figure">৳{{ number_format($data['monthlyCollection'], 2, '.', ',')}}</div>
                    </div>
                    <a class="app-card-link-mask" href="{{route('monthstatement')}}"></a>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Total Collection</h4>
                        <div class="stats-figure">৳{{ number_format($data['totalCollection'], 2, '.', ',')}}</div>
                    </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Monthly Expense</h4>
                        <div class="stats-figure">৳{{ number_format($data['monthlyExpense'], 2, '.', ',')}}</div>
                    </div>
                   <a class="app-card-link-mask" href="{{route('monthstatement')}}"></a>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Net Collection ({{Date('M')}})</h4>
                        <div class="stats-figure">৳{{ number_format($data['monthlyCollection']-$data['monthlyExpense'], 2, '.', ',')}}</div>
                    </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Due Payment</h4>
                        <div class="stats-figure">৳{{ number_format($data['duePayment'], 2, '.', ',')}}</div>
                    </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Total Expense</h4>
                        <div class="stats-figure">৳{{ number_format($data['totalExpense'], 2, '.', ',')}}</div>
                    </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Total Discount</h4>
                        <div class="stats-figure">৳{{ number_format($data['totalDiscount'], 2, '.', ',')}}</div>
                    </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1">Net Total Accounts</h4>
                        <div class="stats-figure">৳{{ number_format($data['totalCollection']-$data['totalExpense'], 2, '.', ',')}}</div>
                    </div>
                    <a class="app-card-link-mask" href="#"></a>
                </div>
            </div>



        </div>
    </div>
@endsection
