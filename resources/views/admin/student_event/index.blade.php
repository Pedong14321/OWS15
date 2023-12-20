@include('partials.__header')

@include('partials.__admin_sidebar')

{{-- right side section --}}
<div class="md:ml-60">


    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main content --}}
    <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 90vh">
        {{-- navigation container --}}
        <div class="justify-between flex items-center  mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">how_to_reg</span>
                            Student Events
                        </a>
                    </li>

                </ol>
            </nav>

        </div>

        {{-- title + button container --}}
        <div class="flex items-center justify-center py-2 mb-4 rounded text-slate-800 ">
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Student Events
            </h2>
            {{-- for medium screens and up --}}
            <a href=" {{ route('admin_create_event') }} " class="block absolute right-8 md:right-10">
                <button type="submit"
                    class="hidden md:inline-flex items-center px-1 py-1 text-sm font-medium text-center bg-gray-200 rounded-lg hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 ">
                    <div
                        class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-center text-white ouryellowbg rounded-lg focus:ring-4 focus:outline-none focus:ring-red-300 ">
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </div>
                    <h3 class="px-2">Add Event</h3>
                </button>
                {{-- for small screens --}}
                <button type="submit"
                    class="md:hidden  inline-flex items-center px-1 py-1 text-sm font-medium text-center bg-gray-200 rounded-lg hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300">
                    <div
                        class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-center text-white ouryellowbg rounded-lg focus:ring-4 focus:outline-none focus:ring-red-300 ">
                        <span class="material-symbols-rounded">
                            add
                        </span>
                    </div>
                </button>
            </a>
        </div>

        {{-- main content here --}}
        <div class=" mb-4 rounded ">

            @foreach ($student_events as $event)
                <a href="your_link_here"
                    class=" relative flex justify-start border-box truncate h-20 w-full mb-2 p-2 px-4 bg-white border border-gray-300 rounded-lg hover:shadow-lg shadow-sm">
                    <div class="mr-4 w-20 text-gray-400 h-full items-center flex flex-row  whitespace-normal">
                        <h4 class="h-full items-center flex  text-4xl ">3</h4>
                        <h4 class="font-wrap text-sm leading-3">days to go</h4>
                    </div>

                    <div class="w-full flex items-center ">
                        <h4 class="text-lg font-bold text-gray-700">{{ $event->event_name }}</h4>
                    </div>

                    <div class="absolute px-2 bg-white right-0 top-1/2  transform  -translate-y-1/2">
                        <form action="">
                            <button type="submit"
                                class="h-12 w-12 flex items-center justify-center bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm p-2">
                                <span class="material-symbols-rounded">
                                    qr_code_scanner
                                </span>
                            </button>
                        </form>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>


@include('partials.__footer')
