@extends('layoutshome.master', ['title' => 'Our Team'])
@section('content')
<div class="text-center titlecandle">
    <h3>Our Team</h3>
</div>
    <div class="container-fluid">
        <div class="">
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 pb-3">
                @foreach ($ourteams as $item)
                <div class="col">
                    <img loading="lazy" src="{{ url(Storage::url('team/' . $item->image)) }}" width="100%" alt="image small">
                    <div class="text-center p-1 teamcolor">
                        <p><span class="text-success">{{$item->name}}</span> <br>{{$item->designation}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {!!$ourteams->links("pagination::bootstrap-4")!!}
        </div>

    </div>
@endsection
