@extends('layouts.app', ['title' => 'Staff Report Details By CRO'])
@section('content')
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <h5 class="p-1">{{$user->name}} | This Month Data</h5>
            <div class="table-responsive">
                <table class="table table-bordered app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">DATE</th>
                            <th class="cell">Admission</th>
                            <th class="cell">Form</th>
                            <th class="cell">Collection</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="cell">{{$item->date}}</td>
                                <td class="cell">{{ $item->admission }}</td>
                                <td class="cell">{{ $item->form }}</td>
                                <td class="cell">{{ number_format($item->collection, 2) }} Tk</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!--//table-responsive-->

        </div>
        <!--//app-card-body-->
    </div>
@endsection
