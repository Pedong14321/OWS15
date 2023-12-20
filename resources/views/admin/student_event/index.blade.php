@include('partials.__header')

@include('partials.__admin_sidebar')

{{-- right side section --}}
<div class="md:ml-60">


    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main content --}}
    <div class="md:p-4 p-2 md:mx-4 mx-2 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 90vh">
        {{-- navigation container --}}
        <div class="justify-between flex items-center  mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">local_activity</span>
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
                <div
                    class="bg--100 relative flex justify-start border-box truncate w-full mb-2 p-2 bg-white border border-gray-300 rounded-lg hover:shadow-lg shadow-sm">
                    {{-- first column --}}
                    <div class="hidden md:flex bg--100 w-30 text-gray-400 min-h-full items-center    whitespace-normal">
                        <h4 class="h-full items-center flex text-5xl text-yellow-400 ">
                            {{ $event->days_left }} </h4>
                        <h4 class="font-wrap text-sm leading-3">days to go</h4>
                    </div>
                    {{-- second column --}}
                    <div class="w-full bg--100 md:items-center flex flex-col mr-2 truncate">
                        <div class=" h-full items-center flex">
                            <a href=" {{ route('admin_event_details', ['event_id' => $event->event_id]) }}">
                                <h4 class="text-md text-gray-700 truncate">{{ $event->event_name }}</h4>
                            </a>
                        </div>
                        <div class="flex overflow-x-auto h-full gap-1 mt-2">
                            <p
                                class="text-xs text-gray-700 bg-yellow-300 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                                <span class="material-symbols-rounded" style="font-size: 15px">
                                    event
                                </span>
                                {{ $event->event_date }}
                            </p>
                            <p
                                class="text-xs text-gray-700 bg-gray-100 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                                in
                                {{ \Carbon\Carbon::parse($event->event_time_in)->format('g:iA') }}-{{ \Carbon\Carbon::parse($event->event_time_in)->addHours(1)->format('g:iA') }}
                            </p>
                            <p
                                class="text-xs text-gray-700 bg-gray-100 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                                out
                                {{ \Carbon\Carbon::parse($event->event_time_out)->format('g:iA') }}-{{ \Carbon\Carbon::parse($event->event_time_out)->addHours(1)->format('g:iA') }}
                            </p>
                        </div>
                    </div>
                    {{-- third column --}}
                    <div class="flex bg--100 gap-2 items-center">
                        {{-- qr button --}}
                        <a href=" {{ route('admin_event_scanner', ['event_id' => $event->event_id]) }}"
                            class="w-full py-2 bg-green-300 flex items-center justify-center rounded-md">
                            <button type="submit"
                                class="h-6 md:w-32 flex gap-1 items-center justify-center font-medium rounded-full p-2 ">
                                <span class="material-symbols-rounded" style="font-size: 20px">
                                    qr_code_scanner
                                </span>
                                <p class="text-sm text-gray-700 hidden md:block">
                                    Scan
                                </p>
                            </button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@include('partials.__footer')
