@extends('layouts.app', ['title' => 'Edit Feedback'])
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
            <form action="{{route('video-review.update',$videoReview->id)}}" method="POST" class="settings-form" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" value="{{$videoReview->title}}" name="title" class="form-control" id="title"  required="">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" value="{{old('image')}}" name="image" class="form-control" id="image">
                </div>
                <div class="mb-3">
                    <label for="youtube" class="form-label">Youtube URL*</label>
                    <input type="text" value="{{$videoReview->link}}" name="youtube" class="form-control" id="youtube">
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
