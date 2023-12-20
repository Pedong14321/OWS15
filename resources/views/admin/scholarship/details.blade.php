@include('partials.__header', ['$title']) {{-- $title is for title about the browser tab --}}

@include('partials.__admin_sidebar')

{{-- right side of sidebar --}}
<div class="md:ml-60 pb-4">

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
                        <a href="{{ route('admin_scholarship') }}"
                            class="inline-flex items-center text-sm font-medium md:text-gray-500 text-gray-500 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">school</span>
                            <p class="max-w-28 truncate inline">Scholarship</p>
                        </a>
                    </li>
                    <li aria-current="page" class="hidden md:inline-flex items-center ">
                        <div class="flex items-center">
                            <svg class="md:inline-flex hidden w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class=" text-sm font-medium w-28 truncate text-gray-700 hover:text-blue-600 ">
                                {{ $scholarship->name }}
                            </p>
                        </div>
                    </li>
                </ol>
            </nav>
            <!-- Previous Button -->
            <div class="flex">
                <a href=" {{ route('admin_scholarship') }}"
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
        <div class="flex flex-col items-center justify-center py-2 rounded text-slate-800 ">
            <div>
                <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                    Scholarship Details
                </h2>
            </div>
        </div>

        {{-- main content --}}
        <div class="block bg--600 flex-row mt-4 mb-4 gap-4 w-full relative">
            <div class="bg--500 grid max-w-full gap-2 mb-6 md:grid-cols-2">
                <div class="bg--500 border p-2 justify-between rounded-lg flex">
                    <div class="flex bg--300 truncate items-center gap-1">
                        <div>
                            <div class="flex gap-1 bg--300 min-w-full items-center">
                                <span class="material-symbols-rounded text-red-800" style="font-size: 20px">school</span>
                                <h4 class="font-medium truncate text-gray-600">{{ $scholarship->name }}</h4>
                            </div>
                            <p class="text-xs text-left w-full text-gray-700 bg--500">Provider: {{ $scholarship->provider }}</p>
                        </div>
                    </div>
                    <div class="bg--500 gap-1 flex flex-col">
                        <a href="{{ route('admin_scholarship_editpage', ['id' => $scholarship->id]) }}"
                            class="bg-gray-100 hover:shadow-md justify-between text-sm p-1 flex items-center rounded-full">
                            <button class="justify-between bg--300 w-full relative flex items-center">
                                <span class="material-symbols-rounded p-1 bg-red-800 text-white rounded-full"
                                    style="font-size: 16px">edit</span>
                                <span class="text-center hidden md:block w-full font-medium bg--400 px-1 rounded-full">Edit</span>
                            </button>
                        </a>
                        <a href="{{ route('admin_archive_scholarship', ['id' => $scholarship->id]) }}"
                            class="bg-gray-100 hover:shadow-md  justify-between text-sm p-1 flex items-center rounded-full">
                            <button class="justify-between bg--300 w-full relative flex items-center">
                                <span class="material-symbols-rounded p-1 bg-red-800 text-white rounded-full"
                                    style="font-size: 16px">archive</span>
                                <span class="text-center hidden md:block w-full bg--400 font-medium px-1 rounded-full">Archive</span>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="bg--500 p-2 border rounded-lg">
                    charts here
                </div>
            </div>
            {{-- accordion for details --}}
            <div id="accordion-color" data-accordion="collapse"
                data-active-classes="bg-yellow-100 dark:bg-gray-800 text-yellow-600 dark:text-white">
                {{-- description --}}
                <h2 id="description-heading">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl  gap-3"
                        data-accordion-target="#description-body" aria-expanded="true" aria-controls="description-body">
                        <span>Description</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="description-body" class="hidden" aria-labelledby="description-heading">
                    <div class="p-5 border border-b-0 border-gray-200">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">
                            {{ $scholarship->description }}
                        </p>
                    </div>
                </div>
                {{-- requirements --}}
                <h2 id="requirements-heading">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 gap-3"
                        data-accordion-target="#requirements-body" aria-expanded="true"
                        aria-controls="requirements-body">
                        <span>Requirements</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="requirements-body" class="hidden" aria-labelledby="requirements-heading">
                    <div class="p-5 border border-b-0 border-gray-200">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">
                            {{ $scholarship->requirements }}
                        </p>
                    </div>
                </div>
                {{-- qualifications --}}
                <h2 id="qualifications-heading">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 gap-3"
                        data-accordion-target="#qualifications-body" aria-expanded="true"
                        aria-controls="qualifications-body">
                        <span>Qualifications</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="qualifications-body" class="hidden" aria-labelledby="qualifications-heading">
                    <div class="p-5 border border-b-0 border-gray-200">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">
                            {{ $scholarship->qualifications }}
                        </p>
                    </div>
                </div>
                {{-- benefits --}}
                <h2 id="benefits-heading">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b border-gray-200 gap-3"
                        data-accordion-target="#benefits-body" aria-expanded="true" aria-controls="benefits-body">
                        <span>Benefits</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="benefits-body" class="hidden" aria-labelledby="benefits-heading">
                    <div class="p-5 border border-b-0 border-gray-200">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">
                            {{ $scholarship->benefits }}
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>


@include('partials.__footer')
