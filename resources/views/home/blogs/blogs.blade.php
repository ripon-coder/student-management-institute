@extends('layoutshome.master', ['title' => 'Student Review'])
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-md-7 heading-section ftco-animate text-center fadeInUp ftco-animated">
                <h2 class="mb-4 myfont fs48">Blogs</h2>
            </div>
        </div>
        <div class="row d-flex">
            @foreach ($blogs as $item)
            <div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated">
                <div class="blog-entry align-self-stretch">
                    <a href="blog-single.html" class="block-20"
                        style="background-image:url({{ url(Storage::url('blogs/' . $item->image)) }})">
                    </a>
                    <div class="text p-4 d-block">
                        <div class="meta mb-3">
                            <div><a href="#">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</a></div>
                        </div>
                        <h3 class="heading mt-3 "><a href="#">{{$item->title}}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 250, $end='...') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {!!$blogs->links("pagination::bootstrap-4")!!}
        </div>
    </div>
@endsection
