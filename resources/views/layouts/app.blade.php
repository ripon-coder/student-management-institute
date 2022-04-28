<!DOCTYPE html>
<html lang="en">

<head>

    <title>
        @isset($title)
            {{ $title }} | 
        @endisset
        Candle IT Dashboard
        </title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Candle IT Dashboard">
    <meta name="author" content="Candle IT Institute">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <script defer src="{{ asset('js/app.js') }}"></script>
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    <!-- Charts JS -->
    <script src="{{ asset('assets/plugins/chart.js/chart.min.js') }}" defer></script>
    <!-- App CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link id="theme-style" rel="stylesheet" href="{{ asset('css/vuetify.css') }}">
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link  rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.min.css') }}">
    <script defer src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
    <script defer src="{{ asset('assets/js/scripts.js') }}"></script>
    <script defer src="{{ asset('assets/js/app.js') }}"></script>


    <script defer src="{{ asset('assets/js/jquery.responsiveTabs.js') }}"></script>
    <script defer src="{{ asset('assets/js/custom.js') }}"></script>
    <link rel="stylesheet"  href="{{ asset('assets/css/responsive-tabs.css') }}">

</head>

<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
        var windowHeight = $(window).height();
        var headerHeight = $("header").height();
        var footerHeight = $("footer").outerHeight();
        var pageMinHeight = windowHeight - footerHeight;
        $(".page-min-height").css({"min-height": pageMinHeight,"padding-top": headerHeight + 40});
        $(window).on("load resize",function(){
            var windowHeight = $(window).height();
            var headerHeight = $("header").height();
            var footerHeight = $("footer").outerHeight();
            var pageMinHeight = windowHeight - footerHeight;
            $(".page-min-height").css({"min-height": pageMinHeight,"padding-top": headerHeight + 40});
        });
        $('.startButton').hover(
           function(){ $(this).addClass('btn-outline-primary') },
           function(){ $(this).removeClass('btn-primary') }
           )

        $(window).on('load resize', function(){
            var headerHeight = $('header').height();
            $('.banner_content .col-lg-7, .banner_content .col-lg-5').css({'padding-top': headerHeight});
            $(window).scroll(function(){
                if($(document).scrollTop() > 100){
                    $('.header_content').addClass('small_header');
                }
                else{
                    $('.header_content').removeClass('small_header');
                }
            });
        });
        $('.nav_toggle_btn').click(function(){
            $('.header_menu').addClass('open');
            $('body').addClass('menu_open');
        });
        $('.close_menu_in_mobile > a').click(function(){
            $('.header_menu').removeClass('open');
            $('body').removeClass('menu_open');
        });
        $(".back_to_top").click(function(event) {
            event.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
        $(window).scroll(function(){
            if ($(window).scrollTop() > 100) {
                $('.back_to_top').fadeIn();
            } else {
                $('.back_to_top').fadeOut();
            }
        });
    });
</script>







<body class="app">
    @include('sweetalert::alert')
    <header class="app-header fixed-top">
        <div class="app-header-inner">
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                                    role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                        stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        <!--//col-->
                        <div class="search-mobile-trigger d-sm-none col">
                            <i class="search-mobile-trigger-icon fas fa-search"></i>
                        </div>
                        <!--//col-->
                        <div class="app-search-box col">
                            <form class="app-search-form">
                                <input type="text" placeholder="Search..." name="search"
                                    class="form-control search-input">
                                <button type="submit" class="btn search-btn btn-primary" value="Search"><i
                                        class="fas fa-search"></i></button>
                            </form>
                        </div>
                        <!--//app-search-box-->
                        <div class="app-utilities col-auto">
                            <!--//app-utility-item-->
                            <div class="app-utility-item">
                                @if(isset(auth()->user()->image))
                                <img width="45" title="Your Profile Photo" class="rounded-circle" src="{{ url(Storage::url('users/' . auth()->user()->id.'/'.auth()->user()->image)) }}" alt="Profile Photo">
                                @else 
                                <img width="45" title="Default Profile Photo" class="rounded-circle" src="{{ asset('img/default_avatar.jpg') }}" alt="Profile Photo">
                                @endif
                            </div>
                            <!--//app-utility-item-->

                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false">{{ auth()->user()->name }}</a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                    <li><a class="dropdown-item" href="settings.html">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        {{ Form::open(['url' => URL::Route('logout'), 'method' => 'POST', 'name' => 'logout']) }}
                                        <button type="submit" style="width: 100%"
                                            class="btn btn-light btn-sm">Logout</button>
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                            </div>
                            <!--//app-user-dropdown-->
                        </div>
                        <!--//app-utilities-->
                    </div>
                    <!--//row-->
                </div>
                <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
        </div>
        <!--//app-header-inner-->
        @include('layouts.sidebar')
        <!--//app-sidepanel-->
    </header>
    <!--//app-header-->


    <div id="app" class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>
    </div>
    @if (request()->routeIs('dashboard'))
        <script>
            'use strict';

            /* Chart.js docs: https://www.chartjs.org/ */

            window.chartColors = {
                green: '#75c181', // rgba(117,193,129, 1)
                blue: '#5b99ea', // rgba(91,153,234, 1)
                gray: '#a9b5c9',
                text: '#252930',
                border: '#e7e9ed'
            };




            //Bar Student For CRO
            var url = "{{ url('dashboard/cro-chart') }}";
            var Months = new Array();
            var Admission = new Array();
            var Form = new Array();

            function getdata() {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        response.forEach(function(data) {
                            Months.push(data.month_name);
                            Admission.push(data.admissionCount);
                            Form.push(data.formCount);

                        });


                        var barChartConfig = {
                            type: 'bar',

                            data: {
                                labels: Months,
                                datasets: [{
                                        label: 'Admission',
                                        backgroundColor: "rgba(117,193,129,0.8)",
                                        hoverBackgroundColor: "rgba(117,193,129,1)",


                                        data: Admission
                                    },
                                    {
                                        label: 'Form',
                                        backgroundColor: "rgba(91,153,234,0.8)",
                                        hoverBackgroundColor: "rgba(91,153,234,1)",


                                        data: Form
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    position: 'bottom',
                                    align: 'end',
                                },

                                tooltips: {
                                    mode: 'index',
                                    intersect: false,
                                    titleMarginBottom: 10,
                                    bodySpacing: 10,
                                    xPadding: 16,
                                    yPadding: 16,
                                    borderColor: window.chartColors.border,
                                    borderWidth: 1,
                                    backgroundColor: '#fff',
                                    bodyFontColor: window.chartColors.text,
                                    titleFontColor: window.chartColors.text,
                                    callbacks: {
                                        label: function(tooltipItem, data) {
                                            return tooltipItem.value;
                                        }
                                    },


                                },
                                scales: {
                                    xAxes: [{
                                        display: true,
                                        gridLines: {
                                            drawBorder: false,
                                            color: window.chartColors.border,
                                        },

                                    }],
                                    yAxes: [{
                                        display: true,
                                        gridLines: {
                                            drawBorder: false,
                                            color: window.chartColors.borders,
                                        },
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
                                                return value;
                                            }
                                        },


                                    }]
                                }

                            }
                        };



                        var barChart = document.getElementById('chart-bar').getContext('2d');
                        window.myBar = new Chart(barChart, barChartConfig);




                    }
                });
            }

            // CRO Section End

            // Admin All Student

            var url = "{{ url('dashboard/all-student-chart') }}";
            var Months = new Array();
            var Admission = new Array();
            var Form = new Array();

            function getallstudent() {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        response.forEach(function(data) {
                            Months.push(data.month_name);
                            Admission.push(data.admissionCount);
                            Form.push(data.formCount);

                        });


                        var barChartConfig = {
                            type: 'bar',

                            data: {
                                labels: Months,
                                datasets: [{
                                        label: 'Admission',
                                        backgroundColor: "rgba(117,193,129,0.8)",
                                        hoverBackgroundColor: "rgba(117,193,129,1)",


                                        data: Admission
                                    },
                                    {
                                        label: 'Form',
                                        backgroundColor: "rgba(91,153,234,0.8)",
                                        hoverBackgroundColor: "rgba(91,153,234,1)",


                                        data: Form
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    position: 'bottom',
                                    align: 'end',
                                },

                                tooltips: {
                                    mode: 'index',
                                    intersect: false,
                                    titleMarginBottom: 10,
                                    bodySpacing: 10,
                                    xPadding: 16,
                                    yPadding: 16,
                                    borderColor: window.chartColors.border,
                                    borderWidth: 1,
                                    backgroundColor: '#fff',
                                    bodyFontColor: window.chartColors.text,
                                    titleFontColor: window.chartColors.text,
                                    callbacks: {
                                        label: function(tooltipItem, data) {
                                            return tooltipItem.value;
                                        }
                                    },


                                },
                                scales: {
                                    xAxes: [{
                                        display: true,
                                        gridLines: {
                                            drawBorder: false,
                                            color: window.chartColors.border,
                                        },

                                    }],
                                    yAxes: [{
                                        display: true,
                                        gridLines: {
                                            drawBorder: false,
                                            color: window.chartColors.borders,
                                        },
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(value, index, values) {
                                                return value;
                                            }
                                        },


                                    }]
                                }

                            }
                        };



                        var barChart = document.getElementById('chart-all-student').getContext('2d');
                        window.myBar = new Chart(barChart, barChartConfig);




                    }
                });
            }

            // Admin All Student End








            var pieChartConfig = {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            {{ $data['monthlyhoice'] }},
                            {{ $data['monthlyhowarkotha'] - $data['monthlyhoice'] }},
                            {{ $data['monthlyhowarkotha'] }},
                        ],
                        backgroundColor: [
                            window.chartColors.green,
                            window.chartColors.blue,
                            window.chartColors.gray,

                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'Collect Amount',
                        'Due Amount',
                        'Expect Amount',
                    ]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom',
                        align: 'center',
                    },

                    tooltips: {
                        titleMarginBottom: 10,
                        bodySpacing: 10,
                        xPadding: 16,
                        yPadding: 16,
                        borderColor: window.chartColors.border,
                        borderWidth: 1,
                        backgroundColor: '#fff',
                        bodyFontColor: window.chartColors.text,
                        titleFontColor: window.chartColors.text,

                        /* Display % in tooltip - https://stackoverflow.com/questions/37257034/chart-js-2-0-doughnut-tooltip-percentages */
                        callbacks: {
                            label: function(tooltipItem, data) {
                                //get the concerned dataset
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                //calculate the total of this data set
                                var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex,
                                    array) {
                                    return previousValue + currentValue;
                                });
                                //get the current items value
                                var currentValue = dataset.data[tooltipItem.index];
                                //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                                var percentage = Math.floor(((currentValue / total) * 100) + 0.5);

                                return percentage + "%";
                            },
                        },


                    },
                }
            };


            // Generate charts on load
            window.addEventListener('load', function() {
                @role('Admin')
                    var pieChart = document.getElementById('chart-pie').getContext('2d');
                    window.myPie = new Chart(pieChart, pieChartConfig);
                    getallstudent();
                @else
                    getdata();
                @endrole

            });
        </script>
    @endif

</body>

</html>
