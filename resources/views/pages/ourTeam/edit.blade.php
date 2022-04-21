@extends('layouts.app', ['title' => 'Edit Team'])
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
            <form action="{{route('admin-team.update',$team->id)}}" method="POST" class="settings-form" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name*</label>
                    <input type="text" value="{{$team->name}}" name="name" class="form-control" id="name"  required="">
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation*</label>
                    <input type="text" value="{{$team->designation}}" name="designation" class="form-control" id="designation"  required="">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" value="{{old('image')}}" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
