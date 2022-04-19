@extends('layouts.app', ['title' => 'Add New Course'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Create Course</h1>
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
            <form action="{{route('course.store')}}" method="POST" class="settings-form">
                @csrf
                <div class="mb-3">
                    <label for="course" class="form-label">Course Name</label>
                    <input type="text" value="{{old('course')}}" name="course" class="form-control" id="course"  required="">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Regular Amount</label>
                    <input type="text" value="{{old('amount')}}" name="amount" class="form-control" id="amount" required="">
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount Amount</label>
                    <input type="text" value="{{old('discountamount')}}" name="discountamount" class="form-control" id="discount">
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
