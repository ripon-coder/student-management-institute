@extends('layouts.app', ['title' => 'Create Payment'])
@section('content')
    <div class="container-fluid">
        @role('Admin')
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">{{ $student->name }} [Discount Amount]</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <div style="width: 50rem">
                                    <div class="card-body">
                                        {{ Form::open(['url' => URL::Route('discountAmountCreate', $student->id),'method' => 'POST','name' => 'Discount Add']) }}
                                        <div class="input-group">
                                            <input type="number" name="discount" placeholder="Enter Discount Amount"
                                                class="form-control" id="discountamount">
                                            <button type="submit"
                                                class="btn btn-primary btn-sm input-group-text text-white">Apply</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                            @if ($student->discount_amount > 0)
                                <div class="d-flex justify-content-center">
                                    <div style="width: 50rem">
                                        <div class="card-body">
                                            <table class="table table-bordered border-primary">
                                                <tbody>
                                                    <tr>
                                                        <td>Applied Discount</td>
                                                        <td>{{ $student->discount_amount }} TK</td>
                                                        <td>
                                                            {{ Form::open(['url' => URL::Route('discountAmountDelete', $student->id),'method' => 'DELETE','name' => 'delete']) }}
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm text-white">Delete</button>
                                                            {{ Form::close() }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endrole






        <div class="pt-4  bg-white">
            @if (\Session::has('success'))
                <div>
                    <li class="alert alert-success list-unstyled">{!! \Session::get('success') !!}</li>
                </div>
            @endif
            <div class="text-center">
                @isset($student->invoice)
                    <a class="text-white btn-sm app-btn-primary" target="_blank"
                        href="{{ route('invoice', $student->id) }}">Download-Invoice</a>
                @endisset
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div style="width: 30rem">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td>{{ $student->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Registraion Number</th>
                                        <td>{{ $student->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Course</th>
                                        <td>{{ $student->course->title }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Batch</th>
                                        <td colspan="2">
                                            @if (!empty($student->batch))
                                                {{ $student->batch->batchno }}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="" style="width: 30rem">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Invoice No.</th>
                                        <td>
                                            @if (isset($student->invoice))
                                                {{ $student->invoice->id }}
                                            @else
                                                {{ Form::open(['url' => URL::Route('invoicecreate', $student->id), 'method' => 'POST', 'name' => 'create']) }}
                                                <button type="submit" class="text-white btn-sm app-btn-primary">Create
                                                    Invoice</button>
                                                {{ Form::close() }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Course Fee</th>
                                        <td>{{ number_format($student->totalAmount + $student->discount_amount, 2) }} Tk
                                        </td>
                                    </tr>
                                    @role('Admin')
                                        <tr>
                                            <th scope="row">Discount Amount</th>
                                            <td>
                                                @if ($student->discount_amount > 0)
                                                    {{ $student->discount_amount }} Tk <a
                                                        class="text-white btn-sm app-btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop" href="#">Edit</a>
                                                @else
                                                    <a class="text-white btn-sm app-btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop" href="#">Create</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th scope="row">Discount Amount</th>
                                            <td>
                                                @if ($student->discount_amount > 0)
                                                    {{ $student->discount_amount }} Tk
                                                @else
                                                    ---
                                                @endif
                                            </td>
                                        </tr>
                                    @endrole
                                    <tr>
                                        <th scope="row">Paid</th>
                                        <td>
                                            {{ number_format($student->payAmount, 2) }} TK
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">UnPaid</th>
                                        <td>
                                            <mark>{{ number_format($student->totalAmount - $student->payAmount, 2) }} TK
                                            </mark>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @isset($student->invoice)
                <div class="d-flex justify-content-center">
                    <div class="card" style="width: 40rem">
                        <form action="{{ route('createPayemnt') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted text-center">
                                    Create Payment
                                </h6>
                                <input type="hidden" name="studentid" value="{{ $student->id }}">
                                <input type="hidden" name="invoiceid" value="{{ $student->invoice->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Amount*</label>
                                    <input type="text" name="amount" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Method*</label>
                                    <select name="method" class="form-select">
                                        <option value="Bkash">Bkash</option>
                                        <option value="Nagad">Nagad</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Note</label>
                                    <textarea class="form-control" name="note" cols="30" rows="10"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm text-white">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endisset
            <div class="container">
                @if (!$student->payment->isEmpty())
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Note</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student->payment as $pay)
                                    <tr>
                                        <th scope="row">{{ $pay->id }}</th>
                                        <td>{{ $pay->amount }} &#2547;</td>
                                        <td>{{ $pay->method }} </td>
                                        <td>{{ $pay->created_at }}</td>
                                        <td>{{ $pay->note }}</td>



                                        @role('Admin')
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm text-white"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#paymentEdit{{ $pay->id }}">Edit</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="paymentEdit{{ $pay->id }}"
                                                    data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            {{ Form::open(['url' => URL::Route('editPayemnt', $pay->id), 'method' => 'PUT', 'name' => 'update']) }}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Payment Edit
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="studentid" value="{{$student->id}}">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Amount*</label>
                                                                    <input type="text" name="amount"
                                                                        value="{{ $pay->amount }}" class="form-control" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Note</label>
                                                                    <textarea class="form-control" name="note" cols="30" rows="10">{{ $pay->note }}</textarea>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary text-white">Save
                                                                    changes</button>
                                                            </div>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Modal End --}}
                                            </td>
                                            <td>

                                                {{ Form::open(['url' => URL::Route('deletepayment', $pay->id), 'method' => 'DELETE', 'name' => 'delete']) }}
                                                <button type="submit" class="btn btn-danger btn-sm text-white">Del</button>
                                                {{ Form::close() }}
                                            </td>
                                        @endrole


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
            </div>

        </div>
    </div>


@endsection
