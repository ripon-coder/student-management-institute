@extends('layouts.app', ['title' => 'Add New Monthly Target'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Create Monthly Target</h1>
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
            <form action="{{route('target.store')}}" method="POST" class="settings-form">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" value="{{old('title')}}" name="title" class="form-control" id="title" >
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Target Amount*</label>
                    <input type="number" value="{{old('amount')}}" name="amount" class="form-control" id="amount">
                </div>
                <div class="mb-3">
                    <label for="month" class="form-label">Target Month*</label>
                    <input type="month" name="month"  class="form-control" id="month">
                </div>

                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
