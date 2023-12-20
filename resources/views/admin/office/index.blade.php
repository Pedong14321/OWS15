@include('partials.__header')

@include('partials.__admin_sidebar')

{{-- right side section --}}
<div class="md:ml-60">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main content --}}
    <div class="md:p-4 p-2 md:mx-4 mx-2 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 90vh">
        {{-- navigation container --}}
        <div class="flex items-center  mb-4 rounded ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1 md:space-x-3">
                    <li aria-current="page" class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded " style="font-size:20px">
                                meeting_room
                            </span>
                            Offices
                        </a>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- title --}}
        <div class="flex flex-col items-center justify-center py-2 rounded text-slate-800 ">
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Offices
            </h2>
        </div>

        {{-- buttons --}}
        <div class="mt-2 mb-4 bg--300 gap-4 flex justify-end">
            {{-- for lg --}}
            <span class="flex gap-1 bg--400">
                <span
                    class="bg-gray-100 justify-center p-1 md:gap-1 flex items-center rounded-full hover:shadow-md transition-all">
                    <div class="bg-white relative p-0 flex items-center rounded-full">
                        <input type="text"
                            class="lg:flex m-0 text-sm hidden rounded-full  max-h-full p-1.5 focus:outline-none border-none focus:ring-none">
                    </div>
                    <a href="" class="flex items-center ">
                        <span class="material-symbols-rounded p-1 ouryellowbg text-white rounded-full"
                            style="font-size: 20px">search</span>
                        <button
                            class="px-2 lg:flex hidden font-medium text-gray-600 text-sm rounded-full">Search</button>
                    </a>
                </span>
                <a href="{{ route('admin_create_scholarship') }}"
                    class="bg-gray-100 justify-center max-h-fit text-md p-1 flex items-center rounded-full hover:shadow-md transition-all">
                    <button class="flex items-center  focus:outline-none rounded-full ">
                        <span class="material-symbols-rounded p-1 ouryellowbg text-white  rounded-full"
                            style="font-size: 20px">add</span>
                        <span class="lg:flex hidden font-medium text-gray-600 text-sm px-2 rounded-full">
                            Add Office
                        </span>
                    </button>
                </a>
                <a href="{{ route('admin_archived_scholarships') }}"
                    class="bg-gray-100 justify-center max-h-fit text-md p-1 flex items-center rounded-full hover:shadow-md transition-all">
                    <button class="flex items-center focus:outline-none rounded-full ">
                        <span class="material-symbols-rounded p-1 bg-gray-500 text-white  rounded-full"
                            style="font-size: 20px">archive</span>
                        <span class="lg:flex hidden font-medium text-gray-600 text-sm px-2 rounded-full">
                            Archive
                        </span>
                    </button>
                </a>
            </span>
        </div>

        {{-- main content --}}
        <div class="bg--300 mt-2 mb-4 grid lg:grid-cols-3 md:grid-cols-2 gap-2 ">
            @foreach ($offices as $office)
                <div class="bg--300 border text-gray-600 rounded-lg p-2 hover:shadow-md transition-all">
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-rounded" style="font-size: 20px">meeting_room</span>
                        <h4 class="truncate font-medium">{{ $office->office_name }}</h4>
                    </div>
                    <div class="flex mt-2 font-medium justify-end gap-1">
                        <a href=""
                            class="bg-gray-100  justify-center text-sm p-1 flex items-center rounded-full">
                            <button class="justify-center flex items-center">
                                <span class="material-symbols-rounded p-1 bg-red-800 text-white rounded-full"
                                    style="font-size: 16px">read_more</span>
                                <span class="  px-1 rounded-full">Details</span>
                            </button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>

@include('partials.__footer')
