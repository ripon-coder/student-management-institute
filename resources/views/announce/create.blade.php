@extends('layouts.app', ['title' => 'Add New Blog'])
@section('content')
    <div class="app-card app-card-settings shadow-sm p-4">
        <h1 class="app-page-title text-center">Create Announce</h1>
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
            <form action="{{route('announce.store')}}" method="POST" class="settings-form">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" value="{{old('title')}}" name="title" class="form-control" id="title"  required="">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description*</label>
                    <textarea id="summernote" name="description" class="form-control">{{old('description')}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="1">Active</option>
                        <option value="0">Disable</option>
                      </select>
                </div>
                <button type="submit" class="btn app-btn-primary">Save Changes</button>
            </form>
        </div>
        <!--//app-card-body-->

    </div>
@endsection
