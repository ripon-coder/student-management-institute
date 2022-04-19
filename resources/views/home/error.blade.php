<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Congratulations</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        body {
            width: 100%;
            height: 100%;

        }

        h1 {
            width: 100%
        }

        .contain {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #ffffff, #2f8198);
            background-image: linear-gradient(to bottom right, #02b3e4, #02ccba);
        }

        .done {
            width: 100px;
            height: 100px;
            position: relative;
            left: 0;
            right: 0;
            top: -20px;
            margin: auto;
        }

        .contain h1 {
            font-family: 'Julius Sans One', sans-serif;
            font-size: 1.4em;
            color: #e72828;
        }

        .congrats {
            position: relative;
            left: 50%;
            top: 50%;
            max-width: 800px;
            transform: translate(-50%, -50%);
            width: 80%;
            min-height: 300px;
            max-height: 900px;
            border: 2px solid white;
            border-radius: 5px;
            box-shadow: 12px 15px 20px 0 rgba(46, 61, 73, .3);
            background-image: linear-gradient(to bottom right, #02b3e4, #02ccba);
            background: #fff;
            text-align: center;
            font-size: 2em;
            color: #2b1e1e;
        }

        .text {
            position: relative;
            font-weight: normal;
            left: 0;
            right: 0;
            margin: auto;
            width: 80%;
            max-width: 800px;

            font-family: 'Lato', sans-serif;
            font-size: 0.6em;

        }


        .circ {
            opacity: 0;
            stroke-dasharray: 130;
            stroke-dashoffset: 130;
            -webkit-transition: all 1s;
            -moz-transition: all 1s;
            -ms-transition: all 1s;
            -o-transition: all 1s;
            transition: all 1s;
        }

        .tick {
            stroke-dasharray: 50;
            stroke-dashoffset: 50;
            -webkit-transition: stroke-dashoffset 1s 0.5s ease-out;
            -moz-transition: stroke-dashoffset 1s 0.5s ease-out;
            -ms-transition: stroke-dashoffset 1s 0.5s ease-out;
            -o-transition: stroke-dashoffset 1s 0.5s ease-out;
            transition: stroke-dashoffset 1s 0.5s ease-out;
        }

        .drawn svg .path {
            opacity: 1;
            stroke-dashoffset: 0;
        }

        .regards {
            font-size: .7em;
        }


        @media (max-width:600px) {
            .congrats h1 {
                font-size: 1.2em;
            }

            .done {
                top: -10px;
                width: 80px;
                height: 80px;
            }

            .text {
                font-size: 0.5em;
            }

            .regards {
                font-size: 0.6em;
            }
        }

        @media (max-width:500px) {
            .congrats h1 {
                font-size: 1em;
            }

            .done {
                top: -10px;
                width: 70px;
                height: 70px;
            }

        }

        @media (max-width:410px) {
            .congrats h1 {
                font-size: 1em;
            }

            .congrats .hide {
                display: none;
            }

            .congrats {
                width: 100%;
            }

            .done {
                top: -10px;
                width: 50px;
                height: 50px;
            }

            .regards {
                font-size: 0.55em;
            }

        }

    </style>
</head>

<body>
    <div class="contain">
        <div class="congrats">
            <h1>দুঃখিত!</h1>
            <div class="done">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                    style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <path style="fill:#CCCCCC;" d="M255.832,32.021c123.697,0.096,223.907,100.45,223.811,224.147s-100.45,223.907-224.147,223.811
                        C131.863,479.883,31.685,379.633,31.685,256C31.869,132.311,132.143,32.117,255.832,32.021 M255.832,0
                        C114.443,0.096-0.096,114.779,0,256.168S114.779,512.096,256.168,512C397.485,511.904,512,397.317,512,256
                        C511.952,114.571,397.261-0.048,255.832,0z" />
                    <g>
                        <rect x="227.863" y="113.103"
                            transform="matrix(0.7071 -0.7071 0.7071 0.7071 -106.0971 255.9227)" style="fill:#E21B1B;"
                            width="56.028" height="285.857" />

                        <rect x="112.943" y="227.962"
                            transform="matrix(0.7071 -0.7071 0.7071 0.7071 -106.0594 255.9024)" style="fill:#E21B1B;"
                            width="285.857" height="56.028" />

                </svg>
            </div>
            <div class="text">
                <p>
                    এই অফারের ২০ টি সিট বুকিং হয়ে গেছে।<br>
                    অনুগ্রহ করে পরবর্তি স্কলারশিপ প্রোগ্রাম এর জন্য অপেক্ষা করুন।<br>

                    @if (Session::get('refmobile'))
                        বিস্তারিত জানতেঃ {{ Session::get('refmobile') }}
                    @endif
                </p>
            </div>
            <p class="regards">Candle IT Institute</p>
        </div>
    </div>
    <script>
        $(window).on("load", function() {
            setTimeout(function() {
                $('.done').addClass("drawn");
            }, 500)
        });
    </script>
</body>

</html>
