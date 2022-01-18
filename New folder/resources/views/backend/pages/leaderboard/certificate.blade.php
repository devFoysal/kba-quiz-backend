{{-- @extends('backend.master') --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{asset('js/dom-to-image.min.js')}}"></script>
    

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');


        * {
            margin: 0;
            padding: 0;
        }

        html,
        body {
            padding: 0;
            margin: 0;
            font-family: 'Oswald', sans-serif;
        }

        .certificate {
            text-align: center;
            /* transform: scale(0.7); */
            position: relative;
        }

        #downloadBtn {
            margin: 15px;
            border: none;
            background-color: #49b697;
            padding: 10px 20px;
            border-radius: 4px;
            color: #ffffff;
            font-weight: 700;
            cursor: pointer;
        }


        .certificate-card {
            width: 600px;
            /* height: 800px; */
            /* margin: 0 auto; */
            padding: 30px;
            padding-bottom: 0;
            position: relative;
            overflow: hidden;
        }

        .certificate-card .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: -1;
            height: 100%;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .seel {
            text-align: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .seel img {
            width: 200px;
        }

        .footer {
            position: relative;
            bottom: -4px;
        }

        .footer img {
            max-width: 100%;
            height: auto;
        }

        .content {
            text-align: center;
        }

        #downloadBtn {
            position: fixed;
            left: 50%;
            top: 50%;
        }

        @media screen and (max-width:767px) {
            #downloadBtn {
                position: fixed;
                left: 50%;
                transform: translateX(-50%);
                top: 90%;
            }
        }

        @page {
            size: A4 portrait;
            /* width: 21cm;
            height: 29.7cm; */
            margin: 0;
            margin-top: 90px;
        }

        @media print {
            body {
                margin: 0;
                box-shadow: 0;
            }

            #downloadBtn {
                display: none;
            }
        }
    </style>
</head>

<body>
    {{-- <button type="button" id="print">Print &
        Download Certificate</button> --}}



    <div class="certificate" id="certificate">
        {{-- <button type="button" onclick="window.print()" id="downloadBtn">Print &
            Download Certificate</button> --}}

        <button type="button" id="downloadBtn">Print & Download Certificate</button>
        {{-- style="background-image:url({{asset('images/certificate/bg.png')}})" --}}
        <div class="certificate-card" id="certificateCard" style="font-family: 'Oswald', sans-serif;">

            <img class="bg-image" src="{{asset('images/bg.png')}}" alt="">
            <div class="logo">
                <img src="{{asset('images/client-logo.png')}}" alt="">
            </div>

            <div class="seel">
                <img width="200" src="{{asset('images/seel.png')}}" alt="">
            </div>

            <div class="content">
                <h1 style="color:#1b5027;">CERTIFICATE OF ACHIEVEMENT</h1>
                <h3 style="padding:10px;"><strong>This certificate for Shera Quizbuz is awarded to</strong></h3>


                <div style="width:450px; margin:auto;">
                    <div style="padding-top:40px; padding-bottom:40px;">
                        <h1
                            style="border-bottom: 3px dashed #000; padding-bottom: 10px; font-family: 'Oswald', sans-serif;">
                            {{$participant->fullName}}
                        </h1>
                    </div>

                    <div style="padding-top:0px; padding-bottom:40px;">
                        <div style="border-bottom: 3px dashed #000; padding-bottom: 10px; margin-bottom:20px;">
                            <img width="100" src="{{asset('images/signature.png')}}" alt="">
                        </div>

                        <h3><strong>Dana Olds</strong></h3>
                        <p style="padding-top:8px; padding-bottom:8px;">Chief of Party</p>
                        <p>Democracy International</p>
                    </div>
                </div>
            </div>

            <div class="footer">
                <img src="{{asset('images/people.png')}}" alt="">
            </div>
        </div>
    </div>
</body>

</html>

<script>
    const printBtn = document.getElementById('downloadBtn');

printBtn.addEventListener('click',function(){
    domtoimage.toJpeg(document.getElementById('certificateCard'), { quality: 0.95 })
    .then(function (dataUrl) {
        var link = document.createElement('a');
        link.download = "certificate.jpeg";
        link.href = dataUrl;
        link.click();
    });
})
</script>