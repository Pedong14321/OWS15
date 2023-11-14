<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="/css/style.css">
    @include('partials.__header')
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
    <div class="min-h-screen min-w-full flex flex-col md:flex-row  ">
        <!--left-->
        <div class="bg-white rounded-lg md:w-1/2 sm:w-full min-h-full md:mr-0">
            <div class="m-3 p-3 md:p-8 rounded-lg flex flex-col relative usep_background" style=" height: 96%; ">
                <div class="flex flex-col justify-center items-center">
                    <h1 class="text-3xl font-bold text-white">Welcome to OSAS WEB SERVICES!</h1>
                    <p class="mt-4 text-white text-xl" style="text-align: justify;">Here we are, we are the dreamer. We'll make it happen, is you're a believer.</p>
                </div>
                <div class="hidden md:block inset-0 flex items-center justify-center">
                    <!-- Image at the very center -->
                    <img src="/images/student/log-in-page.png" alt="" class="mx-auto w-90" style="margin-top: -50px">
                </div>
                <div class="flex justify-center mt-auto">
                    <div class="w-12 h-12 rounded-full ouryellowbg flex items-center justify-center">
                        <i class='bx bxl-facebook-square' style='color:#ffffff; font-size: 30px;'   ></i>
                    </div>
                    <div class="w-12 h-12 rounded-full ouryellowbg flex items-center justify-center ml-4">
                        <i class='bx bx-world' style="color:#ffffff; font-size: 30px;"></i>
                    </div>
                    <div class="w-12 h-12 rounded-full ouryellowbg flex items-center justify-center ml-4">
                        <i class='bx bxl-gmail' style='color:#ffffff; font-size: 30px;' ></i>
                    </div>
                </div>
            </div>
        </div>
        <!--right-->
        <div class="shadow-lg p-8 bg-white rounded-lg min-h-full m-5 mt-0 md:w-1/2 flex flex-col sm:w-full md:mt-5">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Student Login</h1>
                <div class="my-9 mx-3 flex flex-col">
                    <form action="/admin/login/process" method="POST" class="h-full flex flex-col">
                        @csrf
                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" class="mt-2 px-2 py-1 h-10 w-full rounded-full border
                            border-gray-300 focus:outline-none focus:border-yellow-400" value="">
                        </div>
                        <div class="mt-2">
                            <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="Last Name" class="mt-2 px-2 py-1 h-10 w-full rounded-full border border-gray-300 focus:outline-none focus:border-yellow-400">
                        </div>
                        <div class="mt-6">
                            <input type="submit" class="block w-full bg-red-800 hover:bg-red-900 text-white font-medium py-2 rounded-full text-center transition duration-300" style="cursor: pointer;" value="Login">
                        </div>
                        <a href="#" class="ml-2 mt-4 text-blue-500 text-sm  hover:text-blue-400">Forgot Password?</a>
                        <br>
                        <hr>
                        <div class="mt-6">
                            {{-- google_redirect --}}
                            <a href="{{ route('google_redirect') }}">
                                <button type="button" class="text-white w-full bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-full text-sm px-4 py-2.5 text-center inline-flex justify-center items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 18 19">
                                        <path fill-rule="evenodd"
                                            d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Login using your&nbsp;<strong>USeP</strong>&nbsp;email instead
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
    
            {{-- terms and conditions and privacy policy --}}
       
            <div class="lg:mt-auto mt-4 text-gray-700 text-base">
                <p>By signing up, you agree to our <a href="{{ route('terms_conditions') }}" target="_blank" class="ouryellow font-bold">Terms of Service</a> and <a href="{{ route('data_privacy') }}" target="_blank" class="ouryellow font-bold">Privacy Policy</a>.</p>
            </div>
        </div>
    </div>
</body>
</html>
@include('partials.__footer')
