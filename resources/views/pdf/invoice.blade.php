<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js"></script>
    <title>{{ $student->name }}</title>
    <style>
        body {
            background:#fffffff5;
            width: 800px;
            margin:auto;

        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        p {
            font-size: 18px;
            margin: 0;
            padding: 0;
        }

        .brand-section {
            background-color: #e7eee9;
            padding: 20px 40px;
            padding-bottom: 85px;
        }

        .logo {
            width: 50%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 45%;
            flex: 0 0 auto;
        }

        .text-dark {
            color: rgb(0, 0, 0);
        }

        .text-white {
            color: #fff;
        }

        .company-details {
            float: right;
        }
        .company-details >p{
            text-align: initial;
        }

        .body-section {
            padding: 16px;
            border: 1px solid rgb(238, 238, 238);
        }

        .heading {
            font-size: 20px;
            margin-bottom: 08px;
        }

        .sub-heading {
            color: #262626;
            margin-bottom: 05px;
        }

        table {
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }

        table thead tr {
            background-color: #f2f2f2;
        }

        table td {
            vertical-align: middle !important;
            text-align: center;
        }

        table th,
        table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }



        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .text-right {
            text-align: end;
        }

        .w-20 {
            width: 16%;
        }

        .float-right {
            float: right;
        }

        .text-center {
            text-align: center;
        }

        .payment_accept>p {
            padding-bottom: 10px;
        }

        .img {
            padding-top: 20px;
            padding-left: 0px;
            margin: 0px;
        }
        .wrapp{
           
            margin-top: 20px;
            margin-bottom: 20px;
        }

    </style>
</head>

<body>

    <div class="container">
        <div style="margin-bottom: 20px;margin-top:10px;text-align:center">
            <button id="screenshot">Take Screenshot</button>
        </div>
        <div class="wrapp" id="wrapfull">
            <div class="brand-section">
                <div class="row">
                    <div class="col-6">
                        <div class="img">
                            <img src="{{ asset('logo.png')}}" height="40">
                        </div>
                    </div>
                    <div class="col-6 float-right">
                        <div class="company-details">
                            <p class="text-dark">Satmasjid Road, Dhanmondi 26</p>
                            <p class="text-dark">Dhaka 1209,Bangladesh</p>
                            <p class="text-dark">Mobile : +88018-91969465</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="body-section">
                <div class="row">
                    <div class="col-6">
                        <h2 class="heading">{{ $student->name }}</h2>
                        <p class="sub-heading">{{ $student->mobile }}</p>
                        <p class="sub-heading">{{ $student->address }}</p>
                        <p class="sub-heading">Date: {{ $student->invoice->created_at }} </p>
                    </div>
                    <div class="company-details">
                        <h2 class="heading">Invoice #{{ $student->invoice->id }}</h2>
                        <p><b>Reg No:</b> {{$student->id}}</p>
                        <p><b>Refer Name:</b> {{$student->referenced->name}}</p>
                        @isset($student->batch)
                        <p><b>Batch No:</b> {{$student->batch->batchno}}</p>
                        @endisset
                        <p><b>Course Name:</b> {{$student->course->title}}</p>
                    </div>
                </div>

            </div>

            <div class="body-section">
                <br>
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th width="30%">Course Name</th>
                            <th class="w-20">Course Fee</th>
                            <th width="7%">qty</th>
                            <th class="w-20">Method</th>
                            <th class="w-20"></th>
                            <th class="w-20">Total (TK)</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{ $student->course->title }} ({{ $student->course->discount }}% OFF)</td>
                            <td>{{ number_format($student->totalAmount + $student->discount_amount, 2) }}</td>
                            <td>1</td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format($student->totalAmount + $student->discount_amount, 2) }}</td>
                        </tr>

                        @foreach ($student->payment as $item)
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><i>{{ $item->method }}</i></td>
                                <td></td>
                                <td>- {{ number_format($item->amount, 2) }}</td>
                            </tr>
                        @endforeach
                        @if($student->discount_amount > 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Discount</td>
                            <td>- {{ number_format($student->discount_amount, 2) }}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total Unpaid</td>
                            <td>{{ number_format($student->totalAmount - $student->payAmount, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total Paid</td>
                            <td>{{ number_format($student->payAmount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>

            <div class="body-section">
                <p>This invoice auto generated. So no need to signature
                </p>
                <br>
                <div class="text-center payment_accept">
                    <p>We Accept</p>
                    <img src="{{ asset('img/we-accept.png')}}" height="35">
                </div>
            </div>
            <div class="text-center">
            </div>

        </div>
    </div>
    <script>
        setUpDownloadPageAsImage();
        var div = document.getElementById("wrapfull");
        var name = 'Invoice [{{$student->name}} - {{$student->id}}]';

        function setUpDownloadPageAsImage() {
            document.getElementById("screenshot").addEventListener("click", function() {
                html2canvas(div, {
                    scrollX: -window.scrollX,
                    scrollY: -window.scrollY,
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
