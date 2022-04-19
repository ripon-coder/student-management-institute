@extends('layouts.app', ['title' => 'Student Managament'])

@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Student Management</h1>
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                @if (\Session::has('success'))
                    <div>
                        <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
                    </div>
                @endif
                @if (!$students->isEmpty())
                    <div>
                        <form action="{{ route('student_search_cro') }}" method="GET">
                            <div class="input-group">
                                <input type="text" value="{{ old('registration_number') }}" class="form-control"
                                    name="registration_number" placeholder="Registration Number">
                                <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number">
                                <input type="text" class="form-control" name="student_name" placeholder="Student Name">
                                
                                    <button type="submit" class="btn btn-primary text-white input-group-text">Search</button>
                               
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table  mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">Reg.No</th>
                                    <th class="cell">Name</th>
                                    <th class="cell">Mobile Number</th>
                                    <th class="cell">Batch</th>
                                    <th class="cell">Course</th>
                                    <th class="cell">Amount</th>
                                    <th class="cell">Payment Status</th>
                                    <th class="cell">Payment</th>
                                    <th class="cell">Reminder</th>
                                    <th class="cell">Edit</th>
                                    <th class="cell">View</th>
                                </tr>
                            </thead>


                            <tbody class="duepayment">
                                @foreach ($duepayment as $item)
                                    <tr>
                                        <td class="cell">{{ $item->id }}</td>
                                        <td class="cell">{{ $item->name }}</td>
                                        <td class="cell">{{ $item->mobile }}</td>
                                        <td class="cell">
                                            @if (isset($item->batch))
                                                {{ $item->batch->batchno }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td class="cell">{{ $item->course->title }}</td>


                                        <td class="cell">
                                            <mark>{{ $item->course->discount_price }}</mark> Tk <br />
                                            Discount: {{ round($item->course->discount,2) }}%
                                        </td>
                                        @if ($item->payAmount >= $item->totalAmount)
                                            <td class="cell"><a class=" text-white btn-sm app-btn-primary"
                                                    href="#">Fully Paid</a></td>
                                        @elseif($item->payAmount >= 1)
                                            <td class="cell"><a class=" btn-sm app-btn bg-warning text-white"
                                                    href="#">Due</a><br>
                                                {{ $item->totalAmount - $item->payAmount }} TK
                                            </td>
                                        @else
                                            <td class="cell"><a class=" btn-sm app-btn bg-danger text-white"
                                                    href="#">Un-Paid</a>
                                            </td>
                                        @endif

                                        <td class="cell">
                                            <a class="btn-sm app-btn-secondary"
                                                href="{{ route('payment', $item->id) }}">Payment</a>
                                            <a class="btn-sm text-white bg-info" target="_blank"
                                                href="{{ route('downloadForm', $item->id) }}">Form</a>
                                        </td>

                                        <td class="cell">
                                            <a class="text-white btn-sm @if(isset($item->note)) app-btn-primary @else bg-secondary @endif" data-bs-toggle="collapse"
                                                data-bs-target="#collapsedue{{ $item->id }}" aria-expanded="false"
                                                aria-controls="collapsedue">Reminder</a><br>
                                        </td>
                                        <td class="cell">
                                            <a class="text-white btn-sm app-btn-primary"
                                                href="{{ route('studentedit', $item->id) }}">Edit</a>
                                        </td>

                                        <td class="cell">
                                            <button type="button" class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $item->id }}">View</button>
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ $item->name }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body view-dialog">
                                                            <div class="text-center">
                                                                @if ($item->gender == 'Female')
                                                                    <img src="{{ asset('img/girl.png') }}"
                                                                        class="rounded-circle" width="100">
                                                                @else
                                                                    <img src="{{ asset('img/men.png') }}"
                                                                        class="rounded-circle" width="100">
                                                                @endif
                                                            </div>
                                                            <div class="row view-student">
                                                                <div class="col-md-6"><b>Name :</b>
                                                                    {{ $item->name }}</div>

                                                                <div class="col-md-6"><b>REG NO :</b>
                                                                    {{ $item->id }}</div>

                                                            </div>
                                                            <div class="row view-student">
                                                                <div class="col-md-6 "><b>Course :</b>
                                                                    {{ $item->course->title }}</div>
                                                                <div class="col-md-6"><b>Mobile No :</b>
                                                                    {{ $item->mobile }}
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span>
                                                @if ($item->payAmount <= 0)
                                                    <span>
                                                        {{ Form::open(['url' => URL::Route('studentdelete', $item->id), 'method' => 'DELETE', 'name' => 'delete']) }}
                                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger btn-sm text-white">Del</button>
                                                        {{ Form::close() }}
                                                    </span>
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" class="cell p-0 bg-white"><div id="collapsedue{{$item->id}}" class="accordian-body collapse">
                                            <div class="p-2">
                                                {{ Form::open(['url' => URL::Route('noteadd', $item->id), 'method' => 'POST', 'name' => 'note add']) }}
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="note" @isset($item->note) value="{{$item->note}}" @endisset placeholder="Write Note About {{$item->name}}">
                                                        <input type="date" value="{{$item->reminder_time}}" name="reminderTime" class="form-control">
                                                        <button type="submit" class="btn btn-primary text-white btn-sm input-group-text">Submit</button>
                                                    </div>
                                                  {{ Form::close() }}
                                            </div>
                                        </div></td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tbody>
                                @foreach ($students as $item)
                                    <tr>
                                        <td class="cell">{{ $item->id }}</td>
                                        <td class="cell">{{ $item->name }}</td>
                                        <td class="cell">{{ $item->mobile }}</td>
                                        <td class="cell">
                                            @if (isset($item->batch))
                                                {{ $item->batch->batchno }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td class="cell">{{ $item->course->title }}</td>

                                        <td class="cell">
                                            <mark>{{ $item->course->discount_price }}</mark> Tk <br />
                                            Discount: {{ round($item->course->discount,2) }}%
                                        </td>
                                        @if ($item->payAmount >= $item->totalAmount)
                                            <td class="cell"><a class=" text-white btn-sm app-btn-primary"
                                                    href="#">Fully Paid</a></td>
                                        @elseif($item->payAmount >= 1)
                                            <td class="cell"><a class=" btn-sm app-btn bg-warning text-white"
                                                    href="#">Due</a>
                                            </td>
                                        @else
                                            <td class="cell"><a class=" btn-sm app-btn bg-danger text-white"
                                                    href="#">Un-Paid</a>
                                            </td>
                                        @endif

                                        <td class="cell">
                                            <a class="btn-sm app-btn-secondary"
                                                href="{{ route('payment', $item->id) }}">Payment</a>
                                            <a class="btn-sm text-white bg-info" target="_blank"
                                                href="{{ route('downloadForm', $item->id) }}">Form</a>
                                        </td>
                                        <td class="cell">
                                            
                                            @if($item->payAmount<=0)
                                                <span class="btn-sm app-btn-secondary">{{$item->hwpay}}</span><br>
                                            @endif
                                            <a class="text-white btn-sm @if(isset($item->note)) app-btn-primary @else bg-secondary @endif" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExample{{ $item->id }}" aria-expanded="false"
                                            aria-controls="collapseExample">Reminder</a><br>
                                        </td>
                                        <td class="cell">
                                            <a class="text-white btn-sm app-btn-primary"
                                                href="{{ route('studentedit', $item->id) }}">Edit</a>
                                        </td>
                                        <td class="cell">
                                            <button type="button" class="btn-sm app-btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $item->id }}">View</button>
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ $item->name }}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body view-dialog">
                                                            <div class="text-center">
                                                                @if ($item->gender == 'Female')
                                                                    <img src="{{ asset('img/girl.png') }}"
                                                                        class="rounded-circle" width="100">
                                                                @else
                                                                    <img src="{{ asset('img/men.png') }}"
                                                                        class="rounded-circle" width="100">
                                                                @endif
                                                            </div>
                                                            <div class="row view-student">
                                                                <div class="col-md-6"><b>Name :</b>
                                                                    {{ $item->name }}</div>

                                                                <div class="col-md-6"><b>REG NO :</b>
                                                                    {{ $item->id }}</div>

                                                            </div>
                                                            <div class="row view-student">
                                                                <div class="col-md-6 "><b>Course :</b>
                                                                    {{ $item->course->title }}</div>
                                                                <div class="col-md-6"><b>Mobile No :</b>
                                                                    {{ $item->mobile }}
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span>
                                                @if ($item->payAmount <= 0)
                                                    <span>
                                                        {{ Form::open(['url' => URL::Route('studentdelete', $item->id), 'method' => 'DELETE', 'name' => 'delete']) }}
                                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger btn-sm text-white">Del</button>
                                                        {{ Form::close() }}
                                                    </span>
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" class="cell p-0 bg-white"><div id="collapseExample{{$item->id}}" class="accordian-body collapse">
                                            <div class="p-2">
                                                {{ Form::open(['url' => URL::Route('noteadd', $item->id), 'method' => 'POST', 'name' => 'note add']) }}
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="note" @isset($item->note) value="{{$item->note}}" @endisset placeholder="Write Note About {{$item->name}}">
                                                        <input type="date" value="{{$item->reminder_time}}" name="reminderTime" class="form-control">
                                                        <button type="submit" class="btn btn-primary text-white btn-sm input-group-text">Submit</button>
                                                    </div>
                                                  {{ Form::close() }}
                                            </div>
                                        </div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pt-2">
                        {!! $students->links('pagination::bootstrap-5') !!}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        Student Not Found!
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
