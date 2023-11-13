{{-- @include('partials.__header') --}}

<!-- testing github -->
<!-- test 2 -->

{{-- <div class="flex flex-col justify-center items-center ">
    <img src="{{ asset('images/osaslogo.png') }}" class="h-10 mt-20 sm:h-40" />
    <p class="text-dark text-5xl font-medium mt-4">OSAS</p>
    <p class="text-dark text-3xl font-medium">Web Services</p>
    <a href="{{ route('student_showlogin') }}">
        <button type="button"
            class="mt-20 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
            GET STARTED
        </button>
    </a>
</div>

@include('partials.__footer') --}}

@include('partials.__header')

    <x-messages />
    <div class="min-h-screen min-w-full flex flex-col md:flex-row  ">
        <!--left-->
        {{-- <div class="bg-white rounded-lg md:w-1/2 sm:w-full min-h-full m-5 md:mr-0  ">
            <div class="m-3 p-3 md:p-8 rounded-lg flex flex-col relative usep_background"style=" height:96%; ">
                <div class="hidden md:block inset-0 flex flex-col">
                    <!-- Image at the very center -->
                    <img src="/images/student/get-started-img.png" alt="usep-students-talking">
                </div>
            </div>
        </div> --}}
        <div class="bg-white rounded-lg md:w-1/2 sm:w-full min-h-full m-5 md:mr-0  ">
            <div class="m-3 p-3 md:p-8 rounded-lg flex flex-col relative usep_background"style=" height:96%; ">
                <div class="flex justify-center mt-auto">
                    <!-- Image at the very center -->
                    <img src="/images/student/get-started-img.png" alt="" class="mt-12 mx-auto  ">
                </div>
            </div>
        </div>
    <!--right-->
        <div class="p-8 bg-white rounded-lg min-h-full m-5 mt-0 md:w-1/2 min-h-full flex flex-col sm:w-full md:mt-5">
            <form action="/admin/login/process" method="POST" class="h-full flex flex-col">
                @csrf
                <h1 class="text-xl font-bold text-gray-900">Admin Login</h1>
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" class="mt-2 px-2 py-1 w-full rounded-full border
                    border-gray-300 focus:outline-none focus:border-yellow-400" value="">
                </div>
                <div class="mt-2">
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="Last Name" class="mt-2 px-2 py-1 w-full rounded-full border border-gray-300 focus:outline-none focus:border-yellow-400">

                </div>
                <a href="#" class="ml-2 mt-4 text-blue-500 text-sm  hover:text-blue-400">Forgot Password</a>

                <div class="mt-6">
                    <input type="submit" class="block w-full bg-red-800 hover:bg-red-900 text-white font-medium py-2 rounded-full text-center transition duration-300" value="Login">
                </div>
                <div class="lg:mt-auto mt-4 text-gray-700 text-base">
                    <p>By signing up, you agree to our <span class="ouryellow font-bold">Terms of Service</span> and <span class="ouryellow font-bold">Privacy Policy</span>.</p>
                </div>
            </form>
        </div>
    </div>
@include('partials.__footer')
