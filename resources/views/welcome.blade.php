@include('partials.__header')

<!-- testing github -->
<!-- test 2 -->

<div class="min-h-screen min-w-full flex flex-col md:flex-row  ">
    <!--left-->
    <div class="bg-white ouryellowbg shadow-lg rounded-lg md:w-1/2 sm:w-full min-h-full m-5 md:mr-0  ">
        <div class="m-3 p-3 md:p-8 md:pb-2 rounded-lg flex flex-col relative"style=" height:96%; ">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-white">Discover OSAS Web Services</h1>
                <p class="mt-4 text-white text-xl">
                    Your ultimate destination for exceptional student services support.
                </p>
            </div>
            <div class="hidden w-full mt-4 align-bottom md:block flex items-center justify-center">
                <!-- Image at the very center -->
                <img src="/images/student/welcome_vector.png" alt="" class="m-auto w-96 ">
            </div>
            <div class="flex items-center  w-full relative justify-center mt-auto">
                <div class="w-12 h-12 rounded-full ouryellowbg flex items-center justify-center">
                    <i class='bx bxl-facebook-square' style='color:#ffffff; font-size: 30px;'></i>
                </div>
                <div class="w-12 h-12 rounded-full ouryellowbg flex items-center justify-center ml-4">
                    <i class='bx bx-world' style="color:#ffffff; font-size: 30px;"></i>
                </div>
                <div class="w-12 h-12 rounded-full ouryellowbg flex items-center justify-center ml-4">
                    <i class='bx bxl-gmail' style='color:#ffffff; font-size: 30px;'></i>
                </div>
            </div>
        </div>
    </div>
    <!--right-->
    <div
        class="shadow-lg p-8 bg-white rounded-lg min-h-full m-5 mt-0 md:w-1/2 min-h-full flex flex-col sm:w-full md:mt-5">
        <div class="flex flex-col justify-center items-center ">
            <img src="{{ asset('images/ows_logo.png') }}" class="h-10 mt-20 sm:h-48" />
            <div>
                <p class="mt-8 text-sm text-gray-500">Brought to you by:</p>
                <h3 class="text-xl font-bold text-gray-700 ">Office of Student Affairs and Services</h3>
                <p class=" text-sm font-bold text-gray-500 text-right">Tagum Unit</p>
            </div>
            <a href="{{ route('student_login') }}">
                <button type="button"
                    class="mt-14 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    GET STARTED
                </button>
            </a>
        </div>
    </div>
</div>



@include('partials.__footer')
