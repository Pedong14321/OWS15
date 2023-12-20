@include('partials.__header', ['$title']) {{-- $title is for title about the browser tab --}}

@include('partials.__admin_sidebar')

{{-- right side of sidebar --}}
<div class=" md:ml-60 pb-4">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main white containter --}}
    <div class="md:p-4 p-2 md:mx-4 mx-2 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 85vh">

        {{-- navigation container --}}
        <div class=" justify-between flex items-center mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="" aria-label="Breadcrumb">
                <ol class=" items-center flex space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_stud_events') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-500 md:text-gray-400 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">how_to_reg</span>
                            Student Events
                        </a>
                    </li>
                    <li aria-current="page" class="hidden md:inline-flex items-center ">
                        <div class="flex items-center">
                            <svg class="md:inline-flex hidden w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class=" text-sm font-medium text-gray-700 hover:text-blue-600 ">
                                {{ $event->event_name }}
                            </p>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex">
                <!-- Previous Button -->
                <a href=" {{ route('admin_stud_events') }}"
                    class="flex items-center justify-center px-3 h-8  text-sm font-medium text-gray-500 bg-white  rounded-lg hover:bg-gray-100 hover:text-gray-700 ">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                    back
                </a>
            </div>
        </div>

        {{-- title + button container --}}
        <div class="flex items-center justify-center py-2 mb-4 rounded text-slate-800 ">
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Event Details
            </h2>
        </div>

        {{-- main content --}}
        <div class="md:flex gap-4">
            {{-- details --}}
            <div
                class="bg--100 relative  border-box truncate w-full p-2 bg-white border border-gray-300 rounded-lg shadow-sm">
                {{-- first row --}}
                <div class="flex justify-between w-full">
                    <div class="flex items-center bg--300">
                        <h3 class="text-lg font-medium">
                            {{ $event->event_name }}
                        </h3>
                    </div>
                    <div class="flex gap-1">
                        <button class="bg-gray-200 hover:bg-yellow-300 rounded-full flex items-center p-1">
                            <span class="material-symbols-rounded" style="font-size: 20px">edit</span>
                        </button>
                        <button class="bg-gray-200 hover:bg-yellow-300 rounded-full flex items-center p-1">
                            <span class="material-symbols-rounded" style="font-size: 20px">archive</span>
                        </button>
                    </div>
                </div>
                {{-- second row --}}
                <div class="mt-2 flex gap-1">
                    <p class="text-xs text-gray-700 bg-yellow-300 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                        <span class="material-symbols-rounded" style="font-size: 15px">
                            event
                        </span>
                        {{ $event->event_date }}
                    </p>
                    <p class="text-xs text-gray-700 bg-gray-100 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                        in
                        {{ \Carbon\Carbon::parse($event->event_time_in)->format('g:iA') }}-{{ \Carbon\Carbon::parse($event->event_time_in)->addHours(1)->format('g:iA') }}
                    </p>
                    <p class="text-xs text-gray-700 bg-gray-100 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                        out
                        {{ \Carbon\Carbon::parse($event->event_time_out)->format('g:iA') }}-{{ \Carbon\Carbon::parse($event->event_time_out)->addHours(1)->format('g:iA') }}
                    </p>
                </div>
                {{-- third row --}}
                <div
                    class="bg--100 text-xs mt-2 relative  border-box truncate w-full p-2 bg-yellow-100 rounded-md shadow-sm">
                    {{ $event->event_desc }}
                </div>
            </div>
            {{-- stats --}}
            <div
                class="bg--100 md:mt-0 mt-2 relative  border-box truncate w-full p-2 border border-gray-300 rounded-lg shadow-sm">
                {{-- first row --}}
                <div class=" w-full">
                    <h3 class="text-center font-medium">
                        Quick Stats
                    </h3>
                </div>
                {{-- second row --}}
                <div class="mt-2 flex gap-1">
                    charts will be put here
                </div>
            </div>
        </div>
        {{-- Attendance section --}}
        <div class="bg--300  p-2 mt-2 justify-between w-full border border-gray-200 rounded-lg">
            {{-- header --}}
            <div class="flex w-full relative bg--300 h-8">
                <div class="w-full flex items-center bg--300">
                    <h3 class="text-center w-full font-medium">
                        Attendance Records
                    </h3>
                </div>
                <div class="flex gap-1 absolute right-0">
                    <button class="bg-gray-200 hover:bg-yellow-300 rounded-full flex items-center p-1">
                        <span class="material-symbols-rounded" style="font-size: 20px">search</span>
                    </button>
                </div>
            </div>
            {{-- records --}}
            <div class="mt-2 min-w-full bg--400">
                @foreach ($records as $record)
                    @if ($record->student->student_lname == '')
                        <div class="bg--300 truncate">
                            <h4 class="text-center">No attendance records yet! </h4>
                        </div>
                    @endif
                    <div class="bg-gray-100 p-1 py-2 mt-2 rounded-md flex flex-row gap-2 justify-between">
                        <div class="bg--300 truncate flex gap-2">
                            <h4>{{ $loop->iteration }}.</h4>
                            <h4>{{ $record->student->student_lname }}, {{ $record->student->student_fname }} </h4>
                        </div>
                        <div class="bg--300 truncate hidden md:block">
                            <h4>{{ $record->student->course->course_name }} </h4>
                        </div>
                        <div class="flex gap-1">
                            @if ($record->time_in)
                                <p
                                    class="text-xs text-gray-700 bg-green-300 w-fit rounded-full px-1 py-1 flex items-center gap-1">
                                    in
                                    {{ \Carbon\Carbon::parse($record->time_in)->format('g:iA') }}
                                </p>
                            @else
                                <p
                                    class="text-xs text-gray-700 bg-red-300 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                                    in
                                    --:--
                                </p>
                            @endif
                            @if ($record->time_out)
                                <p
                                    class="text-xs text-gray-700 bg-green-300 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                                    out
                                    {{ \Carbon\Carbon::parse($record->time_out)->format('g:iA') }}
                                </p>
                            @else
                                <p
                                    class="text-xs text-gray-700 bg-red-300 w-fit rounded-full px-2 py-1 flex items-center gap-1">
                                    out
                                    --:--
                                </p>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>


@include('partials.__footer')
