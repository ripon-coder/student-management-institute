<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {!! SEO::generate() !!}
    {!! OpenGraph::generate() !!}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('homeAsset/css/main.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.0/css/lightgallery.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1556817331/lightgallery-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" integrity="sha512-i8+QythOYyQke6XbStjt9T4yQHhhM+9Y9yTY1fOxoDQwsQpKMEpIoSQZ8mVomtnVCf9PBvoQDnKl06gGOOD19Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="{{ asset('homeAsset/img/logo.png') }}" width="280" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="/" class="nav-link">Home</a></li>

                    <li class="nav-item {{ request()->is('courses') ? 'active' : '' }}"><a href="{{ route('courses') }}" class="nav-link">Courses</a></li>
                    <li class="nav-item {{ request()->is('our-team') ? 'active' : '' }}"><a href="{{ route('ourteam') }}" class="nav-link">Our Team</a>
                    </li>
                    <li class="nav-item {{ request()->is('review') ? 'active' : '' }}"><a href="{{ route('review') }}" class="nav-link">Review</a></li>
                    <li class="nav-item {{ request()->is('student-feedback') ? 'active' : '' }}"><a href="{{ route('stFeedback') }}" class="nav-link">Student
                            Feedback</a></li>
                    <li class="nav-item {{ request()->is('blogs') ? 'active' : '' }}"><a href="{{ route('blogs') }}" class="nav-link">Blogs</a></li>

                    <li class="nav-item {{ request()->is('contact-us') ? 'active' : '' }}"><a href="{{route('contactus')}}" class="nav-link">Contact Us</a></li>
                    <li class="nav-item {{ request()->is('about-us') ? 'active' : '' }}"><a href="{{route('aboutus')}}" class="nav-link">About Us</a></li>
                    <li class="nav-item cta"><a href="{{ route('scholarshipForm') }}"
                            class="nav-link"><span>Apply Now!</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <footer class="ftco-footer ftco-bg-dark ftco-section img">
        <div class="overlay"></div>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2><a class="navbar-brand" href="/"><img src="{{ asset('homeAsset/img/logo-white.png') }}"
                                    width="200"></a></h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                            there live the blind texts.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="https://www.facebook.com/candleitinstitute/"><span
                                        class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">OUR COURSES</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Web Design & Freelancing</a></li>
                            <li><a href="#" class="py-2 d-block">Digital Marketing & Freelancing</a></li>
                            <li><a href="#" class="py-2 d-block">Graphics Design & Freelancing</a></li>
                            <li><a href="#" class="py-2 d-block">Data Entry & Freelancing</a></li>

                        </ul>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ftco-footer-widget md-4">
                        <h2 class="ftco-heading-2">IMPORTANT LINKS</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Home</a></li>
                            <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
                            <li><a href="#" class="py-2 d-block">Refund Policy</a></li>
                            <li><a href="#" class="py-2 d-block">Apply for Scholarship</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Satmasjid
                                        Road, Dhanmondi 26, Dhaka 1209,Bangladesh </span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+88
                                            01891 969465</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text"><span class="__cf_email__"
                                                data-cfemail="">candleitinfo@gmail.com</span></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved
                </div>
            </div>
        </div>
    </footer>


    <script
        src="{{ asset('homeAsset/js/jquery-migrate-3.0.1.min.js%2bpopper.min.js%2bbootstrap.min.js%2bjquery.easing.1.3.js.pagespeed.jc.F-6Iqk2B9u.js') }}">
    </script>
    <script>
        eval(mod_pagespeed_yJcZTFCy07);
    </script>
    <script>
        eval(mod_pagespeed_tRhwxd_GDa);
    </script>
    <script>
        eval(mod_pagespeed_C$EFYKfnsx);
    </script>
    <script>
        eval(mod_pagespeed_j$kXc7ZYep);
    </script>
    <script
        src="{{ asset('homeAsset/js/jquery.waypoints.min.js%2bjquery.stellar.min.js%2bowl.carousel.min.js%2bjquery.magnific-popup.min.js.pagespeed.jc.EdjAQjR_6W.js') }}">
    </script>
    <script>
        eval(mod_pagespeed_0aitHLLxbb);
    </script>
    <script>
        eval(mod_pagespeed_Cfilealf9i);
    </script>
    <script>
        eval(mod_pagespeed_1MdMv5ZwHn);
    </script>
    <script>
        eval(mod_pagespeed_RboFAinz$k);
    </script>
    <script
        src="{{ asset('homeAsset/js/aos.js%2bjquery.animateNumber.min.js%2bbootstrap-datepicker.js%2bjquery.timepicker.min.js%2bscrollax.min.js%2bgoogle-map.js.pagespeed.jc.AuCbXK-3zV.js') }}">
    </script>
    <script>
        eval(mod_pagespeed_4PscXD2pde);
    </script>
    <script>
        eval(mod_pagespeed_S63p4FLTx0);
    </script>
    <script>
        eval(mod_pagespeed_0XU20vWMf_);
    </script>
    <script>
        eval(mod_pagespeed_BLFEO5Bu$e);
    </script>
    <script>
        eval(mod_pagespeed_BswWZZVj6j);
    </script>
    <script src="{{ asset('homeAsset/js/main.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="{{ asset('homeAsset/js/ripon.js') }}"></script>


</body>

</html>
