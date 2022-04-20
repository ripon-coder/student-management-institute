@extends('layoutshome.master', ['title' => 'Student Review'])
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mb-2">
            <div class="col-md-7 heading-section ftco-animate text-center fadeInUp ftco-animated">
                <h2 class="mb-4 myfont fs48">Review </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 p-1 m-0">
                <div class="sa_ft_box">
                    <a data-fancybox="video-gallery" href="https://www.youtube.com/watch?v=-RvfbmmFayQ">
                        <img style="width: 100%;" src="https://thumbs.dreamstime.com/b/purple-flower-2212075.jpg"
                            class="img-thumbnail" />
                            <i class="fa fa-youtube-play fa-4x ic_hov"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-4 p-1 m-0">
                <div class="sa_ft_box">
                    <a data-fancybox="video-gallery" href="https://www.youtube.com/watch?v=-RvfbmmFayQ">
                        <img style="width: 100%;" src="http://i3.ytimg.com/vi/-RvfbmmFayQ/mqdefault.jpg"
                            class="img-thumbnail" />
                            <i class="fa fa-youtube-play fa-4x ic_hov"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
