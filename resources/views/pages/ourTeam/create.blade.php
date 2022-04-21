@extends('layouts.app', ['title' => 'Add New Team'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Create Team Member</h1>
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
            <form action="{{route('admin-team.store')}}" method="POST" class="settings-form" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name*</label>
                    <input type="text" value="{{old('name')}}" name="name" class="form-control" id="name"  required="">
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation*</label>
                    <input type="text" value="{{old('designation')}}" name="designation" class="form-control" id="designation"  required="">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image*</label>
                    <input type="file" value="{{old('image')}}" name="image" class="form-control" id="image" required="">
                    <div  class="form-text">Image size should be height: 339px and width: 358px</div>
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
