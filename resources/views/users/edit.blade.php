@extends('layouts.app', ['title' => 'Staff Edit'])
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
            <form action="{{route('users.update',$user->id)}}" method="POST" class="settings-form">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="{{$user->name}}" name="name" class="form-control" id="name"  required="">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile*</label>
                    <input type="text" value="{{$user->mobile}}" name="mobile" class="form-control" id="mobile">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control" cols="30" rows="10">{{$user->address}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" value="{{$user->facebook}}" name="facebook" class="form-control" id="facebook">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" readonly value="{{$user->email}}" name="email" class="form-control" id="email" required="">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" class="form-select" id="role" @if($user->id == auth()->user()->id) disabled @endif>
                        <option value="0" selected>---Select---</option>
                        @foreach ($AllRole as $item)
                         <option @if(!empty($user->roles[0]->name == $item->name)) selected @endif value="@isset($item->name){{$item->name}}@endisset">@isset($item->name){{$item->name}}@endisset</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" id="status" @if($user->id == auth()->user()->id) disabled @endif>
                        <option @if($user->status ==1) selected @endif value="1">Active</option>
                        <option @if($user->status ==0) selected @endif value="0">Disabled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" name="croShow" @if($user->cro_show === 1) checked @endif value="1" id="croshow">
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
