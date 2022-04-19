@extends('layouts.app', ['title' => 'Dashboard'])
@section('content')
@if(!$data['ranking']->isEmpty())
<section class="our-webcoderskull padding-lg">
    <div class="container">
     <div class="alert alert-success" role="alert">
        Top Emplyee Ranking:  {{ \Carbon\Carbon::now()->format('F') }} - {{ \Carbon\Carbon::now()->format('Y') }}
    </div>
      <ul class="row">
        <?php $rank = 1; ?>
        @foreach ($data['ranking'] as $item)

            <li class="col-12 col-md-3 col-lg-3 @if($loop->first)block @endif">
                <div class="cnt-block equal-hight" style="height: 349px;">
                <figure>
                    @if(isset($item->image))
                        <img src="{{ url(Storage::url('users/' . $item->id.'/'.$item->image)) }}" class="img-responsive" alt="{{$item->name}}">
                    @else 
                        <img src="{{ asset('img/default_avatar.jpg') }}" class="img-responsive" alt="{{$item->name}}">
                    @endif
                    </figure>
                <h3><a href="#">{{$item->name}}</a></h3>
                <div class="rank">
                    <div class="bg_rank">
                        <center><h3 class="rankNumber" title="Ranking Positon">Rank -{{ $rank }}</h3></center>
                    </div>
                </div>
                <ul class="follow-us clearfix">
                    <li title="Total Form">Form: <b>{{ $item->formCount }}</b></li>
                    <li title="Total Admission">Admission: <b>{{ $item->student_count }}</b></li>
                </ul>
                </div>
            </li>
        <?php $rank += 1; ?>
        @endforeach

      </ul>
    </div>
  </section>
@endif
    @role('Admin')
        <div class="row g-4 mb-4">
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100 bg-success">
                    <div class="app-card-body p-3 p-lg-4 ">
                        <h4 class="stats-type mb-1 text-white">Today Collection</h4>
                        <div class="stats-figure text-white">৳{{ number_format($data['todayCollection'], 2) }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Monthly Collection</h4>
                        <div class="stats-figure">৳{{ number_format($data['monthlyCollection'], 2) }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            @isset($data['targetedCollection']->requiredAmount)
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Targated Collection</h4>
                        <div class="stats-figure">৳{{ number_format($data['targetedCollection']->requiredAmount, 2) }}</div>
                        <p>Required : {{round($data['required'],2)}} Tk <br>@if($data['average'] > $data['required'])<span class="text-success">Average : {{round( $data['average'] ,2)}} Tk</span> @else <span class="text-danger">Average: {{round( $data['average'] ,2)}} Tk</span> @endif</p>
                    </div>

                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            @endisset
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100 bg-danger">
                    <div class="app-card-body p-3 p-lg-4  ">
                        <h4 class="stats-type mb-1 text-white">Due Payment</h4>
                        <div class="stats-figure text-white">৳{{ number_format($data['amountTotal'] - $data['duePayment'], 2) }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Today Admission</h4>
                        <div class="stats-figure">{{$data['todayAdmission']}}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Today Form</h4>
                        <div class="stats-figure">{{$data['todayForm']}}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Monthly Admission</h4>
                        <div class="stats-figure">{{$data['monthlyAdmission']}}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>

            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Monthly Form</h4>
                        <div class="stats-figure">{{$data['monthlyForm']}}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>

            @if(!$data['reminderAdmin']->isEmpty())
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-12">
                    <div class="bg-warning">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Reference</th>
                                    <th scope="col">REG NO</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['reminderAdmin'] as $reminder)
                                    <tr>
                                        <td>{{$reminder->referenced->name}}</td>
                                        <th scope="row">{{$reminder->id}}</th>
                                        <td><a href="{{ route('student_search','registration_number='.$reminder->id) }}">{{$reminder->name}}</a></td>
                                        <td>{{$reminder->mobile}}</td>
                                        <td>{{$reminder->note}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="bg-white">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Forms</th>
                                    <th scope="col">Admission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rank = 1; ?>
                                @foreach ($data['ranking'] as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td><span class="badge bg-success">{{ $rank }}</span></td>
                                        <td><span class="badge bg-info">{{ $item->student->count() }}</span></td>
                                        <td><span
                                                class="badge bg-secondary">{{ $item->student->where('payAmount', '>=', 1)->count() }}</span>
                                        </td>
                                    </tr>
                                    <?php $rank += 1; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-header p-3 border-0">
                            <h4 class="app-card-title">This Month</h4>
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-4">
                            <div class="chart-container">
                                <canvas id="chart-pie"></canvas>
                            </div>
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
            </div>
        </div>
    @endrole

    @role('CRO')
    @if(!$data['reminderCro']->isEmpty())
        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-12">
                <div class="bg-warning">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">REG NO</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['reminderCro'] as $reminder)
                                <tr>
                                    <th scope="row">{{$reminder->id}}</th>
                                    <td><a href="{{ route('student_search_cro','registration_number='.$reminder->id) }}">{{$reminder->name}}</a></td>
                                    <td>{{$reminder->mobile}}</td>
                                    <td>{{$reminder->note}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <div class="row g-4 mb-4 mt-1">
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Today Admission</h4>
                        <div class="stats-figure">{{ $data['todayAdmission'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Today Form</h4>
                        <div class="stats-figure">{{ $data['todayForm'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Monthly Admission</h4>
                        <div class="stats-figure">{{ $data['monthlyAdmission'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total Admission</h4>
                        <div class="stats-figure">{{ $data['totalAdmission'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Pending Admission</h4>
                        <div class="stats-figure">{{ $data['pendingAdmission'] }}</div>
                    </div>
                    <!--//app-card-body-->
                    <a class="app-card-link-mask" href="#"></a>
                </div>
                <!--//app-card-->
            </div>
        </div>
        <div class="row">


            <div class="col-12 col-md-12">
                <div class="app-card app-card-chart h-10 shadow-sm">
                    <div class="app-card-header p-3 border-0">
                        <h4 class="app-card-title">Student Chart</h4>
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body p-4">
                        <div class="chart-container">
                            <canvas id="chart-bar"></canvas>
                        </div>
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
        </div>
    @endrole
@endsection
