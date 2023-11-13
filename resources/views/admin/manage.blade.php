@include('partials.__header')

@include('partials.__admin_sidebar')

{{-- right side section --}}
<div class="md:ml-60">
    {{-- right side header --}}
    <div class="flex flex-row items-center px-4 py-2 mx-4 my-2 gap-2 flex justify-end ">
        <a href="">
            {{-- {{ route('qr_scanner2') }} --}}
            <button type="button"
                class="text-gray-900 flex items-center bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm p-2">
                <span class="material-symbols-rounded">
                    qr_code_scanner
                </span>
            </button>
        </a>
        @include('partials.__admin_profile')
    </div>

    {{-- main content --}}
    <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 90vh">
        {{-- navigation container --}}
        <div class="justify-between flex items-center  mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">dashboard</span>
                            Dashboard
                        </a>
                    </li>

                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class=" text-sm font-medium text-gray-700 hover:text-blue-600 ">
                                Admins
                            </p>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="flex">
                <!-- Previous Button -->
                <a href=""
                    class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white  rounded-lg hover:bg-gray-100 hover:text-gray-700 ">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                    back
                </a>
                {{-- next button code --}}
                {{-- <a href="#"
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 ">
                    
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a> --}}
            </div>
        </div>

        {{-- title + button container --}}
        <div class="flex items-center justify-center py-2 mb-4 rounded text-slate-800 ">
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Manage Admins
            </h2>
            {{-- for medium --}}
            {{-- {{ route('admin.create') }} --}}
            <form action="" method="GET" class="block absolute right-8 md:right-10">
                @csrf
                <button type="submit"
                    class="hidden md:inline-flex items-center px-1 py-1 text-sm font-medium text-center bg-gray-200 rounded-lg hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                    <div
                        class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-center text-white ouryellowbg rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </div>
                    <h3 class="px-2">Add Admin</h3>
                </button>
                {{-- for small --}}
                <button type="submit"
                    class="md:hidden  inline-flex items-center px-1 py-1 text-sm font-medium text-center bg-gray-200 rounded-lg hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <div
                        class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-center text-white ouryellowbg rounded-lg focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </div>
                </button>
            </form>
        </div>

        <div class=" flex flex-col lg:flex-row lg:flex-wrap items-center mb-4 rounded ">
            @foreach ($admins as $admin)
                @php $default_profile = "https://api.dicebear.com/7.x/initials/svg?seed=".$admin->admin_fname."" @endphp
                <a href="" {{-- {{ route('admin.profile', ['admin' => $admin->admin_id]) }} --}}
                    class="border-box lg:w-80 truncate w-full m-2 p-2 bg-white border border-gray-300 rounded-lg hover:shadow-lg shadow-sm ">
                    <div class="flex items-center p-2">
                        <img class="mr-2 border-4 h-10 w-10 rounded-full"
                            src="{{ $admin->admin_image ? asset('/storage/admin/thumbnail/' . 'small_' . $admin->admin_image) : "$default_profile" }}">
                        <div>
                            <h5 class=" text-lg font-semibold tracking-tight text-gray-700 ">
                                {{ $admin->admin_fname }} {{ $admin->admin_lname }}
                            </h5>
                            <p class="text-ellipsis font-normal text-sm text-gray-500 ">
                                {{ $admin->email }}
                            </p>
                        </div>
                    </div>
                    <div class="p-1 px-2 pt-0 flex flex-row justify-between text-gray-500">
                        <div class="flex items-center">
                            <span class="text-sm material-symbols-rounded mr-1 text-md">
                                admin_panel_settings
                            </span>
                            <p class=" font-normal text-sm  ">
                                {{ $admin->adminType->admintype_name ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm material-symbols-rounded mr-1">
                                meeting_room
                            </span>
                            <p class=" font-normal text-sm  ">
                                {{ $admin->office->office_name ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>

</div>


@include('partials.__footer')
