@include('partials.__header')

{{-- modal --}}
<div
    class=" overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">
    <div class="relative flex items-center justify-center p-4 w-full  min-h-screen  bg-black">
        <div class="relative bg-white w-full md:w-1/2 rounded-lg shadow ">
            {{-- admin_stud_events --}}
            <a href=" {{ route('admin_stud_events') }} ">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center ">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </a>
            <div class="p-4 md:p-6 text-center">
                <h3 class="mb-5 text-lg font-bold text-gray-600 ">
                    Confirm Attendance?
                </h3>
                <div class="flex flex-col items-center justify-center text-gray-600">

                    @if ($student)
                        <img class="rounded-full border" src="{{ $student->student_picture ?? '' }}">
                        <h3 class="font-bold mt-2">
                            <span> {{ $student->student_fname ?? '' }} </span>
                            <span> {{ $student->student_lname ?? '' }} </span>
                        </h3>
                        <h4>{{ $student->email ?? '' }}</h4>
                        <h4>{{ $student->course->course_name ?? '' }}</h4>
                    @else
                        <p>No student found</p>
                    @endif
                </div>

                <div class="flex mt-6 gap-4 text-center">
                    <a href="{{ route('admin_event_scanner', ['event_id'=>$event_id]) }}"
                        class="text-red-500 w-1/2 bg-white hover:bg-red-100 focus:ring-4 focus:outline-none focus:ring-red-200 rounded-lg border border-red-200 text-sm font-medium px-5 py-2.5 hover:text-red-900 focus:z-10">
                        DENY
                    </a>
                
                    <form action="{{ route('admin_confirm_attdc') }}" method="POST"
                        class="text-white w-1/2 bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300  font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                        @csrf
                        <input type="text" name="ows_id" hidden value="{{ $student->student_osasid }} ">
                        <input type="text" name="event_id" hidden value="{{ $event_id }}">
                        <input type="text" name="in_out" hidden value="{{ $in_out }}">
                        <button type="submit" class="w-full h-full">
                            CONFIRM
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

@include('partials.__footer')
