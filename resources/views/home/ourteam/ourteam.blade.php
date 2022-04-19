@extends('layoutshome.master', ['title' => 'Our Team'])
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mb-2">
            <div class="col-md-7 heading-section ftco-animate text-center fadeInUp ftco-animated">
                <h2 class="mb-4 myfont fs48">Our Team</h2>
            </div>
        </div>
        <div class="">
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 pb-3">
                <div class="col">
                    <img src="{{ asset('img/sakil.jpg') }}" width="100%" alt="image small">
                    <div class="text-center p-1 teamcolor">
                        <p><span class="text-success">Shakil</span> <br>Computer Engineer</p>
                    </div>
                </div>
                <div class="col">
                    <img src="{{ asset('img/sakil.jpg') }}" width="100%" alt="image small">
                    <div class="text-center p-1 teamcolor">
                        <p><span class="text-success">Shakil</span> <br>Computer Engineer</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
