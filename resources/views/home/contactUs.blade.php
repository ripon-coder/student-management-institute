@extends('layoutshome.master')
@section('content')
    <div class="container-fluid">
        <div class="text-center titlecandle">
            <h3>Contact Us</h3>
        </div>
        <div class="row px-2 formMsg">
            <div class="col-md-6 pad">
                <div class="text-center pt-2">
                    <p class="text-secondary">Fill up the form and our Team will get back to you within in 24 hours</p>
                </div>
                <div class="links" id="bordering">

                    <a href="#" class="btn rounded p-3">
                        <div class="text-center">
                        <i class="fa fa-phone icon text-primary pr-3"></i> +88
                        01891-969465</a> <a href="#" class="btn rounded p-3"><i
                            class="fa fa-envelope icon text-primary pr-3"></i>
                        candleitinfo@gmail.com</a>
                        </div>
                    <div class="text-center">
                        <a href="#" class="btn rounded p-3"><i class="fa fa-map-marker icon text-primary pr-3"></i>
                            Satmasjid Road ,Dhanmondi 26, <br> Dhaka
                            1209,Bangladesh</a>
                    </div>
                    <div class="text-center">
                        <img width="30%" src="{{asset('img/frame.png')}}" alt="">
                    </div>
                </div>

            </div>
            <div class="col-md-6 pad">
                @if (\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                <form class="rounded msg-form" action="{{ route('contactSubmit') }}" method="POST">
                    @csrf
                    <div class="form-group"> <label for="name" class="h6">Your Name</label>
                        <div class="input-group border rounded">
                            <div class="input-group-addon px-2 pt-1">
                                <p class="fa fa-user-o text-primary"></p>
                            </div>
                            <input type="text" value="{{ old('name') }}" name="name" class="form-control border-0"
                                required>
                        </div>
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="input-group mb-3">
                        <label for="name" class="h6">Your Mobile</label>
                        <div class="input-group border rounded">
                            <span class="input-group-text" id="basic-addon1">+88</span>
                            <input type="text" value="{{ old('mobile') }}" name="mobile" class="form-control border-0"
                                placeholder="01xxxxxxxxx" required>
                        </div>
                    </div>
                    @error('mobile')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <div class="form-group"> <label for="msg" class="h6">Message</label>
                        <textarea name="message" id="msgus" cols="10" rows="5" class="form-control bg-light" placeholder="Message"
                            required>{{ old('message') }}</textarea>
                    </div>
                    @error('message')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <div class="form-group d-flex justify-content-end"> <input type="submit"
                            class="btn btn-primary text-white" value="Send Message"> </div>

                </form>
            </div>
        </div>
    </div>
@endsection
