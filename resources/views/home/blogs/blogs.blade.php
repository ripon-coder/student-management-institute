@extends('layoutshome.master', ['title' => 'Blogs'])
@section('content')
<div class="text-center titlecandle">
    <h3>Blogs</h3>
</div>
    <div class="container">
        <div class="row d-flex">
            @foreach ($blogs as $item)
                <div class="col-md-4 d-flex ftco-animate fadeInUp ftco-animated">
                    <div class="blog-entry align-self-stretch">
                        <a href="{{ route('blog.single', $item->slug) }}" class="block-20"
                            style="background-image:url({{ url(Storage::url('blogs/' . $item->image)) }})">
                        </a>
                        <div class="text p-4 d-block">
                            <div class="meta mb-3">
                                <div>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</div>
                            </div>
                            <h3 class="heading mt-3 "><a
                                    href="{{ route('blog.single', $item->slug) }}">{{ $item->title }}</a></h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 250, $end = '...') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {!! $blogs->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@endsection
