@extends('layouts.app', ['title' => 'Profile'])
@section('content')
<div class="col d-flex justify-content-center">
    <div class="card mt-4" style="width: 50rem;">
        <div class="card-body">
            @if (\Session::has('image'))
                <div class="alert alert-success">
                    {!! \Session::get('image') !!}
                </div>
            @endif
            <form action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Profile Photo</label>
                    <input type="file" name="avatar" class="form-control" id="name">
                    @error('avatar')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary text-white">Profile Update</button>
            </form>
        </div>
    </div>
</div>
<div class="col d-flex justify-content-center">
    <div class="card mt-4" style="width: 50rem;">
        <div class="card-body">
            @if (\Session::has('success'))
                <div class="alert alert-info">
                    {!! \Session::get('success') !!}
                </div>
            @endif
            <form action="{{route('profile.update',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" disabled value="{{auth()->user()->email}}" class="form-control">
                    @error('name')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="currentPassword" class="form-control">
                    @error('currentPassword')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="newPassword" class="form-control">
                    @error('newPassword')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary text-white">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection