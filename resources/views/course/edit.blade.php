@extends('layouts.app', ['title' => 'Edit Course'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">

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
            <form action="{{route('course.update',$course->id)}}" method="POST" class="settings-form">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Course Name</label>
                    <input type="text" value="{{$course->title}}" name="course" class="form-control" id="name"  required="">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Regular Amount</label>
                    <input type="text"  value="{{$course->price}}" name="amount" class="form-control" id="amount" required="">
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount Amount</label>
                    <input type="text" name="discountamount" value="{{$course->discount_price}}" class="form-control" id="discount">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" id="status">
                        <option @if($course->status ==1) selected @endif value="1">Active</option>
                        <option @if($course->status ==0) selected @endif value="0">Disabled</option>
                    </select>
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
