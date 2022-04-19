@extends('layouts.app', ['title' => 'Settings'])
@section('content')
    <div class="col d-flex justify-content-center">
        <div class="card mt-4" style="width: 60rem;">
            <div class="card-body">
                @if (\Session::has('success'))
                    <div class="alert alert-info">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                <form action="{{route('settings.update')}}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <label for="showHide" class="col-sm-2 form-check-label">Form Hide</label>
                        <div class="col-sm-10 form-check form-switch">
                            <input type="checkbox" @if(auth()->user()->on_off ==0) checked @endif value="0" class="form-check-input" id="showHide" name="formoff">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary text-white">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection
