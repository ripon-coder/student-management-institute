@extends('layouts.app', ['title' => 'Batch Show'])

@section('content')
    <div class="col-12 col-lg-12">
        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-sliders" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z">
                                </path>
                            </svg>
                        </div>
                        <!--//icon-holder-->

                    </div>
                    <!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">{{ $batch->batchno }}</h4>
                    </div>
                    <!--//col-->
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body px-4 w-100">

                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>ID </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->id }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Course </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->course->title }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>class On Week </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->classOnWeek }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Duration </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->duration }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Start Date </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->startdate }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>End Date </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->enddate }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Class Time </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->classtime }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Expected Student </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->expectedStudent }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Mentor </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $batch->user->name }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>

                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Class On Day </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            @foreach ($batch->classOnDay as $item)
                                <li>{{$item}}</li>
                            @endforeach
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Status</strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            @if($batch->status == 1) <span class="badge bg-info">Active</span>@else <span class="badge bg-danger">Disabled</span> @endif
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
            </div>
            <!--//app-card-body-->
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary" href="{{route('batch.edit',$batch->id)}}">Edit</a>
            </div>
            <!--//app-card-footer-->

        </div>
        <!--//app-card-->
    </div>
    </div>
@endsection
