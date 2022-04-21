@extends('layoutshome.master', ['title' => 'Student Feedback'])
@section('content')
    <div class="text-center titlecandle">
        <h3>Student Feedback</h3>
    </div>
    <div class="container-fluid p-2">
        @if (!$feedback->isEmpty())
            <div id="lightgallery" class="lightGallery">
                @foreach ($feedback as $item)
                    <a href="{{ url(Storage::url('feedback/' . $item->image)) }}" class="image-tile" data-abc="true">
                        <img loading="lazy" src="{{ url(Storage::url('feedback/' . $item->image)) }}" class="imgborder" height="241px"
                            alt="{{ $item->title }}">
                    </a>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {!! $feedback->links('pagination::bootstrap-4') !!}
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Student feedback no found!
            </div>
        @endif

    </div>
@endsection
