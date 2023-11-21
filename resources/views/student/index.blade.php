@include('partials.__header')

@include('partials.__student_sidebar')

{{-- right side section --}}
<div class="md:ml-60">

    {{-- reusable page header --}}
    @include('partials.__student_pageheader')

    {{-- main content --}}
    <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 90vh">
        {{-- navigation container --}}
        <div class="flex items-center  mb-4 rounded ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1 md:space-x-3">
                    <li aria-current="page" class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">dashboard</span>
                            Dashboard
                        </a>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- 3 cols div --}}
        <div class="md:grid grid-cols-3 gap-4 mb-4 md:p-4 p-2 border rounded-lg">
            <div class="p-4 justify-center text-gray-600 align-middle flex flex-col">
                <p class=" text-md">
                    School Year: 2023-2024
                </p>
                <p class=" text-md">
                    Semester: 2nd
                </p>
            </div>
            <div
                class="p-4 items-center flex-column items-center justify-center text-center rounded-xl border-4 border-yellow-200">
                <div class="w-full justify-center flex">
                    @if (Auth::check() && Auth::user()->student_picture)
                        <img src="{{ Auth::user()->student_picture }}" />
                    @else
                        <img src="https://api.dicebear.com/7.x/initials/svg?seed=" />
                    @endif
                </div>

                <div class="text-slate-600 mt-2">
                    @if (Auth::check())
                        <span class="block text-lg font-bold  ">{{ Auth::user()->student_fname }}
                            {{ Auth::user()->student_lname }}</span>
                        <span class="block text-md truncate ">{{ Auth::user()->email }}</span>
                        <p class="text-sm"> {{ Auth::user()->Course->course_name }} </p>
                    @else
                        <p>You are not logged in.</p>
                    @endif

                </div>
            </div>
            <div class="p-4 justify-center items-center flex flex-col">
                {{-- calling dynamic livewire component --}}
                @livewire('dashboard-q-rcode')
            </div>
        </div>

    </div>
</div>
</div>

@include('partials.__footer')
