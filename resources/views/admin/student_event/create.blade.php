@include('partials.__header', ['$title']) {{-- $title is for title about the browser tab --}}

@include('partials.__admin_sidebar')

{{-- right side of sidebar --}}
<div class=" md:ml-64 pb-4">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main white containter --}}
    <div class="p-4 mx-4 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 85vh">

        {{-- navigation container --}}
        <div class="justify-between flex items-center  mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">how_to_reg</span>
                            Student Events
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
                                Create
                            </p>
                        </div>
                    </li>

                </ol>
            </nav>
            <div class="flex">
                <!-- Previous Button -->
                <a href=" {{ route('admin_stud_events') }}"
                    class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white  rounded-lg hover:bg-gray-100 hover:text-gray-700 ">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                    back
                </a>
            </div>
        </div>

        {{-- main content --}}
        <div class="flex flex-row mt-2 mb-4 gap-4">

            {{-- left --}}
            <div class="w-1/3 hidden min-h-full md:flex items-center justify-center rounded-lg bg-gray-50 ">
                <img src="{{ asset('images/amin/cre.png') }}" class="h-max" />
            </div>

            {{-- right - create new admin form --}}
            <div
                class="md:w-2/3 w-full px-6 py-6 lg:px-8 relative bg-white rounded-lg overflow-y-auto border border-yellow-500 ">
                <form action=" {{ route('admin_store_event') }} " method="POST" class=" flex flex-col m-0" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                        Create New Event
                    </h2>
                    <div class="flex mt-4 gap-4">
                        <span class=" text-red-500 text-xs font-small py-0.5 rounded-full ">
                            * Required
                        </span>
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Input Name --}}
                        <div>
                            <label for="event_name" class="block text-gray-600 font-bold text-sm">
                                Event Name
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="event_name" id="event_name" required
                                class="mt-1 h-10 px-4 py-2 w-full border-b border-gray-300 focus:outline-none focus:border-yellow-400"
                                value="{{ old('event_name') }}">
                            @include('partials.__input_error', ['fieldName' => 'event_name'])
                        </div>

                        {{-- Input Event Date --}}
                        <div>
                            <label for="event_date" class="block text-gray-600 font-bold text-sm">
                                Event Date
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="event_date" id="event_date" required
                                class="mt-1 h-10 px-4 py-2 w-full border-b border-gray-300 focus:outline-none focus:border-yellow-400"
                                value="{{ old('event_date') }}">
                            @include('partials.__input_error', ['fieldName' => 'event_date'])
                        </div>

                        {{-- Input Event Time In --}}
                        <div>
                            <label for="event_time_in" class="block text-gray-600 font-bold text-sm">
                                Event Time In
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="event_time_in" id="event_time_in" required
                                class="mt-1 h-10 px-4 py-2 w-full border-b border-gray-300 focus:outline-none focus:border-yellow-400"
                                value="{{ old('event_time_in') }}">
                            @include('partials.__input_error', ['fieldName' => 'event_time_in'])
                        </div>

                        {{-- Input Event Time Out --}}
                        <div>
                            <label for="event_time_out" class="block text-gray-600 font-bold text-sm">
                                Event Time Out
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="event_time_out" id="event_time_out" required
                                class="mt-1 h-10 px-4 py-2 w-full border-b border-gray-300 focus:outline-none focus:border-yellow-400"
                                value="{{ old('event_time_out') }}">
                            @include('partials.__input_error', ['fieldName' => 'event_time_out'])
                        </div>

                    </div>

                    {{-- Input Description --}}
                    <div class="mt-4">
                        <label for="event_desc" class="block text-gray-600 font-bold text-sm">
                            Event Description
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea name="event_desc" id="event_desc" required rows="2"
                            class="mt-1 px-4 py-2 w-full border-b border-gray-300 resize-col focus:outline-none focus:border-yellow-400">{{ old('event_desc') }}</textarea>
                        @include('partials.__input_error', ['fieldName' => 'event_desc'])
                    </div>


                    {{-- submit button --}}
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full focus:outline-none text-white  bg-red-800 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-full text-md px-5 py-2.5 ">
                            Create Event
                        </button>
                    </div>
                </form>
            </div>

        </div>


    </div>

</div>


@include('partials.__footer')
