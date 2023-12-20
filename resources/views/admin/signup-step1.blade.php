@include('partials.__header') {{-- using partials "DRY - don't repeat yourself" --}}

<x-messages /> {{-- for our custom alert messages --}}

<div class="min-h-screen min-w-full flex flex-col md:flex-row">
    {{-- left card --}}
    <div class="bg-white rounded-lg md:w-1/2 sm:w-full min-h-full m-5 md:mr-0 shadow-lg ">
        <div class="usep_background m-3 p-3 md:p-8 rounded-lg flex flex-col relative" style=" height:96%;">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-white">Welcome OSAS System Super Admin</h1>
                <p class="mt-4 text-white">To get started, please provide the following information to create your admin
                    account.</p>
            </div>
            <div class="hidden md:block inset-0 flex items-center justify-center">
                <!-- Image at the very center -->
                <img src="/images/Ellips.png" alt="" class="mt-10 mx-auto w-40">
            </div>
            <div class="flex justify-center mt-auto">
                {{-- Email icon --}}
                <div class="w-10 h-10 rounded-full ouryellowbg flex items-center justify-center">
                    <i class='bx bxl-gmail' style='color:#ffffff; font-size: 30px;'></i>
                </div>
                {{-- Website icon --}}
                <div class="w-10 h-10 rounded-full ouryellowbg flex items-center justify-center ml-4">
                    <i class='bx bx-world' style="color:#ffffff; font-size: 30px;"></i>
                </div>
                {{-- Facebook icon --}}
                <div class="w-10 h-10 rounded-full ouryellowbg flex items-center justify-center ml-4">
                    <i class='bx bxl-facebook-square' style='color:#ffffff; font-size: 30px;'></i>
                </div>
            </div>
        </div>
    </div>

    {{-- right card --}}
    <div
        class="p-8 bg-white rounded-lg min-h-full m-5 mt-0 md:w-1/2 min-h-full flex flex-col sm:w-full md:mt-5  shadow-lg">
        <form action="{{ route('admin_signup1store') }}" method="POST" class=" flex flex-col m-0">
            @csrf
            <div class="flex justify-between items-center font-bold">
                <h1 class="text-2xl  text-gray-800">Create Super Admin account</h1>
                <h3 class="text-gray-700">Step 1</h3>
            </div>
            <div class="flex mt-4 gap-4">
                <span
                    class=" text-red-500 text-xs font-small py-0.5 rounded-full ">
                    * Required
                </span>
                <span
                    class=" text-gray-500 text-xs font-small py-0.5 rounded-full ">
                    Put N/A to Not Applicable fields
                </span>
            </div>


            {{-- create account inputs --}}
            <div class="lg:grid grid-cols-2 gap-6 ">
                {{-- first column --}}
                <div class="col">
                    {{-- Input Lastname --}}
                    <div class="mt-4">
                        <label for="admin_lname" class="block text-gray-600 font-bold text-sm">Last Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="admin_lname" id="admin_lname" required
                            class="mt-1 h-10 px-4 py-2 w-full rounded-full border border-gray-300 focus:outline-none focus:border-yellow-400"
                            value="{{ old('admin_lname') }}">
                        @include('partials.__input_error', ['fieldName' => 'admin_lname'])
                    </div>
                    {{-- Input firstname --}}
                    <div class="mt-4">
                        <label for="admin_fname" class="block text-gray-600 font-bold text-sm">First Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="admin_fname" id="admin_fname" required
                            class=" mt-1 h-10 px-4 py-2 w-full rounded-full border
                            border-gray-300 focus:outline-none focus:border-yellow-400"
                            value="{{ old('admin_fname') }}">
                        @include('partials.__input_error', ['fieldName' => 'admin_fname'])
                    </div>
                    {{-- Input MI --}}
                    <div class="mt-4">
                        <label for="admin_mi" class="block text-gray-600 font-bold text-sm">Middle Initial <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="admin_mi" id="admin_mi" required
                            class="mt-1 h-10 px-4 py-2 w-full rounded-full border
                            border-gray-300 focus:outline-none focus:border-yellow-400"
                            value="{{ old('admin_mi') }}">
                        @include('partials.__input_error', ['fieldName' => 'admin_mi'])
                    </div>

                </div>
                {{-- second column --}}
                <div class="col">
                    <div class="mt-4">
                        <label for="email" class="block text-gray-600 font-bold text-sm">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" required
                            class="h-10 mt-1 px-4 py-2 w-full rounded-full border border-gray-300 focus:outline-none focus:border-yellow-400"
                            value="{{ old('email') }}">
                        @include('partials.__input_error', ['fieldName' => 'email'])
                    </div>
                    <div class="mt-4">
                        <label for="admin_contact" class="block text-gray-600 font-bold text-sm">Contact Number</label>
                        <input type="text" name="admin_contact" id="admin_contact"
                            class="text-base h-10 mt-1 px-4 py-2 w-full rounded-full border border-gray-300 focus:outline-none focus:border-yellow-400"
                            value="{{ old('admin_contact') }}">
                        @include('partials.__input_error', ['fieldName' => 'admin_contact'])
                    </div>
                </div>
            </div>

            {{-- Password Prompts --}}
            <div id="password-error"
                class="hidden text-xs mt-4 bg-red-200 max-w-content text-red-600 px-2 py-1 rounded">
                Password must be at least 8 characters long and contain one uppercase letter, one lowercase letter, one
                special character, and one number.
            </div>

            {{-- password div --}}
            <div class="lg:grid mt-4 grid-cols-2 gap-6">
                {{-- Input password --}}
                <div class="mt-4">
                    <label for="password" class="block text-gray-600 text-sm font-bold">Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 h-10 px-4 py-2 w-full rounded-full border
                        border-gray-300 focus:outline-none focus:border-yellow-400"
                        value="{{ old('password') }}">
                    @include('partials.__input_error', ['fieldName' => 'password'])
                </div>
                {{-- Input password_confirmation --}}
                <div class="mt-4">
                    <label for="password_confirmation" class="block text-gray-600 text-sm font-bold">Confirm Password
                        <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="mt-1 h-10 px-4 py-2 w-full rounded-full border border-gray-300 focus:outline-none focus:border-yellow-400"
                        value="{{ old('password_confirmation') }}">
                    @include('partials.__input_error', ['fieldName' => 'password_confirmation'])
                </div>
            </div>
            {{-- submit button --}}
            <div class="mt-6">
                <input type="submit"
                    class="block w-full h-10 hover:bg-red-900 text-white font-medium py-2 rounded-full text-center transition duration-300 ourmaroonbg"
                    value="Create Super Admin account">
            </div>
        </form>

        {{-- terms and conditions and privacy policy --}}
        <div class="lg:mt-8 mt-4 text-gray-700 text-base">
            <p>By signing up, you agree to our <a href="{{ route('terms_conditions') }}" target="_blank"
                    class="ouryellow font-bold">Terms of Service</a> and <a href="{{ route('data_privacy') }}"
                    target="_blank" class="ouryellow font-bold">Privacy Policy</a>.</p>
        </div>
    </div>
</div>

@include('partials.__footer')
