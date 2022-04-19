@extends('layoutshome.master', ['title' => 'Student Feedback'])
@section('content')
    <div class="container-fluid p-2">
        <div class="row justify-content-center mb-2">
            <div class="col-md-7 heading-section ftco-animate text-center fadeInUp ftco-animated">
                <h2 class="mb-4 myfont fs48">Student Feedback</h2>
            </div>
        </div>
        <div id="lightgallery" class="lightGallery">
            <a href="{{ asset('img/sakil.jpg') }}" class="image-tile" data-abc="true">
                <img src="{{ asset('img/sakil.jpg') }}" height="241px" alt="image small">
            </a>
            <a href="{{ asset('img/sakil.jpg') }}" class="image-tile" data-abc="true">
                <img src="{{ asset('img/sakil.jpg') }}" height="241px" alt="image small">
            </a>
            <a href="{{ asset('img/men.png') }}" class="image-tile" data-abc="true">
                <img src="{{ asset('img/men.png') }}" height="241px" alt="image small">
            </a>
            <a href="{{ asset('img/men.png') }}" class="image-tile" data-abc="true">
                <img src="{{ asset('img/men.png') }}" height="241px" alt="image small">
            </a>
        </div>

    </div>
@endsection
