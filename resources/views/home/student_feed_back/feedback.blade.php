@extends('layoutshome.master', ['title' => 'Student Feedback'])
@section('content')
    <div class="container-fluid p-2">
        <div class="row justify-content-center mb-2">
            <div class="col-md-7 heading-section ftco-animate text-center fadeInUp ftco-animated">
                <h2 class="mb-4 myfont fs48">Student Feedback</h2>
            </div>
        </div>
        @if (!$feedback->isEmpty())
            <div id="lightgallery" class="lightGallery">
                @foreach ($feedback as $item)
                    <a href="{{ url(Storage::url('feedback/' . $item->image)) }}" class="image-tile" data-abc="true">
                        <img src="{{ url(Storage::url('feedback/' . $item->image)) }}" height="241px" alt="{{$item->title}}">
                    </a>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {!!$feedback->links("pagination::bootstrap-4")!!}
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Student feedback no found!
            </div>
        @endif

    </div>
@endsection
