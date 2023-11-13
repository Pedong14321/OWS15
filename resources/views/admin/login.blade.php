@include('partials.__header')

<x-messages /> {{-- for our custom alert messages --}}

<div class="min-h-screen min-w-full flex flex-col md:flex-row  ">
    <!--left-->
    <div class="bg-white shadow-lg rounded-lg md:w-1/2 sm:w-full min-h-full m-5 md:mr-0  ">
        <div class="m-3 p-3 md:p-8 rounded-lg flex flex-col relative usep_background"style=" height:96%; ">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-white">Welcome OSAS System Admin</h1>
                <p class="mt-4 text-white text-xl">To get started, please provide the following information to create
                    your admin account.</p>
            </div>
            <div class="hidden md:block inset-0 flex items-center justify-center">
                <!-- Image at the very center -->
                <img src="/img/Ellips.png" alt="" class="mt-12 mx-auto w-80 ">
            </div>
            <div class="flex justify-center mt-auto">
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
        <div>
            <form action="{{ route('admin_processlogin') }}" method="POST" class=" flex flex-col">
                @csrf
                <h1 class="text-2xl font-bold text-gray-900">Admin Login</h1>
                <div class="mt-4">
                    <label for="email" class="block text-gray-600 font-bold text-sm">Email </label>
                    <input type="email" name="email" id="email" required
                        class="h-10 mt-1 px-4 py-2 w-full rounded-full border border-gray-300 focus:outline-none focus:border-yellow-400">
                    @include('partials.__input_error', ['fieldName' => 'email'])
                </div>
                <div class="mt-4">
                    <label for="password" class="block text-gray-600 text-sm font-bold">Password</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 h-10 px-4 py-2 w-full rounded-full border
                        border-gray-300 focus:outline-none focus:border-yellow-400">
                    @include('partials.__input_error', ['fieldName' => 'password'])
                </div>
                <div class="mt-6">
                    <input type="submit"
                        class="block w-full bg-red-800 hover:bg-red-900 text-white font-medium py-2 rounded-full text-center transition duration-300"
                        value="Login">
                </div>
                <a href="#" class="ml-2 mt-4 text-blue-500 text-sm  hover:text-blue-400">Forgot Password?</a>
            </form>

        </div>

        {{-- terms and conditions and privacy policy --}}
        <div class="lg:mt-auto mt-4 text-gray-700 text-base">
            <p>By signing up, you agree to our <a href="{{ route('terms_conditions') }}" target="_blank"
                    class="ouryellow font-bold">Terms of Service</a> and <a href="{{ route('data_privacy') }}"
                    target="_blank" class="ouryellow font-bold">Privacy Policy</a>.</p>
        </div>

    </div>
</div>
@include('partials.__footer')
