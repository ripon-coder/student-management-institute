@extends('layouts.app', ['title' => 'Add New Staff'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Create Staff</h1>
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
            <form action="{{route('users.store')}}" method="POST" class="settings-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name*</label>
                    <input type="text" value="{{old('name')}}" name="name" class="form-control" id="name"  required="">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile*</label>
                    <input type="text" value="{{old('mobile')}}" name="mobile" class="form-control" id="mobile">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control" cols="30" rows="10">{{old('address')}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" value="{{old('facebook')}}" name="facebook" class="form-control" id="facebook">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email*</label>
                    <input type="email" value="{{old('email')}}" name="email" class="form-control" id="email" required="">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password*</label>
                    <input type="text" value="{{old('password')}}" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role*</label>
                    <select name="role" class="form-select" id="role">
                        <option value="0" selected>---Select---</option>
                        @foreach ($AllRole as $role)
                         <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" name="croShow" checked value="1" id="croshow">
                    <label class="form-check-label" for="croshow">
                       CRO-SHOW
                      </label>
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
