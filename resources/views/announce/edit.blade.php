@extends('layouts.app', ['title' => 'Edit Blog'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Update Announce</h1>
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
            <form action="{{route('announce.update',$announce->id)}}" method="POST" class="settings-form">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" value="{{$announce->title}}" name="title" class="form-control" id="title"  required="">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Description*</label>
                    <textarea id="summernote" name="description" class="form-control">{{$announce->announce}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option @if($announce->status==1) selected @endif value="1">Active</option>
                        <option @if($announce->status==0) selected @endif value="0">Disable</option>
                      </select>
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
