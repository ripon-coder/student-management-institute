@extends('layoutshome.master', ['title' => 'Student Review'])
@section('content')
    <div class="text-center titlecandle">
        <h3>Review</h3>
    </div>
    <div class="container-fluid">
        <div class="row">
          @foreach ($videoReview as $item)
            <div class="col-md-4 p-1 m-0">
                <div class="sa_ft_box">
                    <a data-fancybox="video-gallery" href="{{$item->link}}">
                        <img style="width: 100%;" src="{{ url(Storage::url('review/' . $item->thumbnail)) }}"
                            class="img-thumbnail" />
                        <i class="fa fa-youtube-play fa-4x ic_hov"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {!!$videoReview->links("pagination::bootstrap-4")!!}
        </div>
    </div>
@endsection
