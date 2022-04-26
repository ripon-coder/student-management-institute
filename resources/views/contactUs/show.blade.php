@extends('layouts.app', ['title' => 'Message'])

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
                </div>
                <!--//row-->
            </div>
            <!--//app-card-header-->
            <div class="app-card-body px-4 w-100">

                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Name </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $contact->name }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>
                <!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Mobile Number </strong></div>
                        </div>
                        <!--//col-->
                        <div class="col text-end">
                            {{ $contact->mobile }}
                        </div>
                        <!--//col-->
                    </div>
                    <!--//row-->
                </div>

                <div class="py-3">
                    <div class="col text-end text-center">
                        {{ $contact->message }}
                    </div>
                </div>
                <!--//item-->
            </div>

        </div>
        <!--//app-card-->
    </div>
    </div>
@endsection
