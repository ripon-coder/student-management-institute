@extends('layouts.app', ['title' => 'Staff Report'])
@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table table-bordered app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">Name</th>
                            <th class="cell">Total Admission</th>
                            <th class="cell bg-success text-white">{{ date('M') }}(Admission)</th>
                            <th class="cell bg-success text-white">{{ date('M') }}(Form)</th>
                            <th class="cell bg-success text-white">{{ date('M') }}(Success Ratio)</th>
                            <th class="cell">Today Admission</th>
                            <th class="cell">Today Form</th>
                            <th class="cell">{{ date('M') }} (Collection)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="cell"><a href="{{route('staffRepostDetails',$item->id)}}">{{ $item->name }}</a></td>
                                <td class="cell">{{ $item->totaladmission }}</td>
                                <td class="cell">{{ $item->thismonthAdmission }}</td>
                                <td class="cell">{{ $item->thismonthForm }}</td>
                                <td class="cell">
                                    @if($item->thismonthAdmission != 0)
                                        {{ round(($item->thismonthAdmission / $item->thismonthForm) * 100,2) }} %
                                    @endif
                                    
                                </td>
                                <td class="cell">{{ $item->todayAdmission }}</td>
                                <td class="cell">{{ $item->todayForm }}</td>
                                <td class="cell">{{ number_format($item->student_sum_pay_amount, 2) }} Tk</td>
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
            {!! $data->links('pagination::bootstrap-4') !!}
        </nav>
    </div>
@endsection
