<html dir="ltr" lang="en" style="" class="">

<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="author" content="ThemeMascot">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js"></script>
    <!-- Page Title -->
    <title>Student form Candle IT Institute</title>

    <style>
        body {
            width: 900px;
            margin: auto;
        }

        .main-content {
            background: white;
        }

        .wrapper {
            padding: 19px
        }

        .ntfdot {
            background: #e23000;
            padding: 1px 7px;
            font-size: 13px;
            border-radius: 30px;
            line-height: 13px;
        }

        .ntfdotnew {
            position: absolute;
            bottom: 0;
            right: 10px;
            color: white;
            padding: 2px 8px;
            background: #fd6e13;
        }

        button {

            color: ;
            background: green;
            color: white;
            padding: 5px;
        }

    </style>


</head>

<body>


    <div class="wrapper" id="wrapper">
        <!-- Header -->


        <style>
            .invoice tr td {
                color: black;
            }

            .invoice (color:black !important; ) .table tr th (color:black; ) .name {
                float: left;
                width: 30%;
            }

            .f_table {
                font-size: 18px;
                color: black !important;
                width: 850px;
            }

            .f_table tr td {
                padding: 10px;
            }

        </style>
        <!-- Start main-content -->
        <div style="margin-bottom: 20px;text-align:center">
            <button id="screenshot">Take Screenshot</button>
        </div>

        <div class="main-content" id="main">
            <!-- Section: About -->
            <div class="container">
                <div class="border-1px p-30 mb-0">
                    <div class="row">
                        <img src="{{ asset('img/form_header.jpg') }}" width="850">
                        <hr width="850">
                        <table width="100%" class="f_table">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Registraton Number:</td>
                                    <td style="border-bottom:1px dashed black;"><b>{{ $student->id }}</b> </td>
                                </tr>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Full Name:</td>
                                    <td style="border-bottom:1px dashed black;">{{ $student->name }} </td>
                                </tr>
                                <tr>
                                    <td style="background:#b6e5a2; padding:5px; ">Father's Name:</td>
                                    <td style="border-bottom:1px dashed black;">{{ $student->fathername }} </td>
                                </tr>
                                <tr>
                                    <td style="background:#b6e5a2; padding:5px; ">Mother's Name:</td>
                                    <td style="border-bottom:1px dashed black;">{{ $student->mothername }} </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="f_table">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Mobile Number:</td>
                                    <td style="border-bottom:1px dashed black;  font-family:Lucida Console;" width="">
                                        {{ $student->mobile }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="f_table">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Date Of Birth:</td>
                                    <td style="border-bottom:1px dashed black;" width="300">
                                        {{ $student->dateofbirth }}</td>
                                    <td width="80">Gender:</td>
                                    <td style="border-bottom:1px dashed black;" width="">
                                        {{ $student->gender }}</td>

                                </tr>
                            </tbody>
                        </table>

                        <table width="100%" class="f_table">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Present Address:</td>
                                    <td style="border-bottom:1px dashed black;">{{ $student->address }}</td>
                                </tr>


                            </tbody>
                        </table>

                        <table class="f_table" border="0">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Academic Qualification:
                                    </td>
                                    <td style="border-bottom:1px dashed black;">
                                        {{ $student->education }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="f_table">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Course Name:</td>
                                    <td style="border-bottom:1px dashed black;">
                                        {{ $student->course->title }}
                                        {{ number_format($student->course->discount_price, 2) }}TK
                                        ({{ round($student->course->discount, 2) }}% OFFER)</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="f_table">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Course Fee:</td>
                                    <td style="border-bottom:1px dashed black;  font-family:Lucida Console;" width="">
                                        {{ number_format($student->course->discount_price, 2) }}TK

                                    </td>
                                    <td width="30">Date:</td>
                                    <td style="border-bottom:1px dashed black;" width="250">
                                        <i>{{ $student->created_at }}</i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="f_table">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Scholarship:</td>
                                    <td style="border-bottom:1px dashed black;" width="">
                                       Yes
                                    </td>
                                    <td width="200" align="right">Batch No:</td>
                                    <td style="border-bottom:1px dashed black;" width="130">
                                        @isset($student->batch)
                                                {{ $student->batch->batchno }}
                                        @endisset
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="f_table">
                            <tbody>
                                <tr>
                                    <td width="230" style="background:#b6e5a2; padding:5px; ">Reference:</td>
                                    <td style="border-bottom:1px dashed black;">
                                        {{ $student->referenced->name }}
                                    </td>
                                    <td width="200" align="right">Course Duration:</td>
                                    <td style="border-bottom:1px dashed black;" width="130">
                                            @isset($student->batch)
                                                {{ $student->batch->duration }}
                                            @endisset
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <br><br>

                        <img src="{{ asset('img/form_footer.jpg') }}" width="850">
                    </div>




                </div>
            </div>
            <br>
        </div>
        <!-- end main-content -->
    </div>
    <!-- end wrapper -->

    <script>
        setUpDownloadPageAsImage();
        var div = document.getElementById("main");
        var name = 'Form [{{$student->name}} - {{$student->id}}]';

        function setUpDownloadPageAsImage() {
            document.getElementById("screenshot").addEventListener("click", function() {
                html2canvas(div, {
                    scrollX: -window.scrollX,
                    scrollY: -window.scrollY,
                    windowWidth: document.documentElement.offsetWidth,
                    windowHeight: document.documentElement.offsetHeight
                }).then(function(canvas) {
                    simulateDownloadImageClick(canvas.toDataURL(), name+'.png');
                });
            });
        }

        function simulateDownloadImageClick(uri, filename) {
            var link = document.createElement('a');
            if (typeof link.download !== 'string') {
                window.open(uri);
            } else {
                link.href = uri;
                link.download = filename;
                accountForFirefox(clickLink, link);
            }
        }

        function clickLink(link) {
            link.click();
        }

        function accountForFirefox(click) { // wrapper function
            let link = arguments[1];
            document.body.appendChild(link);
            click(link);
            document.body.removeChild(link);
        }
    </script>


</body>

</html>
