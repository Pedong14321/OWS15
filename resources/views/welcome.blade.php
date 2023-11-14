@include('partials.__header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
    <style>
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, system-ui, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
        }
    </style>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</head>
<body>
    <x-messages />
    <div class="min-h-screen min-w-full flex flex-col md:flex-row">
        <div class="bg-white rounded-lg md:w-1/2 sm:w-full min-h-full m-5 md:mr-0  ">
            <div class="m-3 p-3 md:p-8 rounded-lg flex flex-col relative usep_background"style=" height:96%; ">
                <div class="flex justify-center mt-auto">
                    <!-- Image at the very center -->
                    <img src="/images/student/get-started-img.png" alt="" class="mt-12 mx-auto  ">
                </div>
            </div>
        </div>
    <!--right-->
        <div class="p-8 bg-white rounded-lg min-h-full m-5 mt-0 md:w-1/2 flex flex-col sm:w-full md:mt-5">
            <div class="flex flex-col h-auto justify-center items-center">
                <img src="images/student/osas-logo.png" alt="OSAS Logo" style="height: 70%;">
                <p style="font-weight: 800; letter-spacing: 5px; font-size: 48px;">OSAS WEB SERVICES</p>
                <p style="font-weight: 700; letter-spacing: 3px;">OFFICE OF STUDENT AFFAIRS AND SERVICES</p>
            </div>
            <br>
            <div class="mt-6 flex flex-col h-auto justify-center items-center">
                <a href="{{ route('student_showlogin') }}">
                    <button class="block w-auto px-14 py-2 rounded-full text-center transition duration-300" style="background-color: #fec24a; color: black; font-size: 20px; font-weight: 700; letter-spacing: 1px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.5)">GET STARTED</button>
                </a>
            </div>
        </div>
    </div>
</body>
</html> 
@include('partials.__footer')
