@extends('layouts.app', ['title' => 'Add New Feedback'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Create Feedback</h1>
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
            <form action="{{route('feedback.store')}}" method="POST" class="settings-form" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" value="{{old('title')}}" name="title" class="form-control" id="title"  required="">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image*</label>
                    <input type="file" value="{{old('image')}}" name="image" class="form-control" id="image" required="">
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
