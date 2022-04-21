@extends('layoutshome.master', ['title' => $blog->title])
@section('content')
<div class="text-center titlecandle">
    <h3>{{$blog->title}}</h3>
</div>
    <div class="container">
        <div class="row d-flex">

            <div class="col-md-12 d-flex ftco-animate fadeInUp ftco-animated">
                <div class="blog-entry align-self-stretch">
                    <div class="d-flex justify-content-center">
                        <img width="100%" src="{{ url(Storage::url('blogs/' . $blog->image)) }}" alt="">
                    </div>
                    <div class="text p-4 d-block">
                        <div class="meta mb-3">
                            <div>{{ \Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</div>
                        </div>
                        <p>{!! $blog->description !!}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
