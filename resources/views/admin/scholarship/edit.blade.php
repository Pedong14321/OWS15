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
                        <a href="{{ route('admin_scholarship_details', $scholarship->id) }}" class="flex items-center">
                            <svg class="md:inline-flex hidden w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class=" text-sm font-medium w-28 truncate text-gray-500 hover:text-blue-600 ">
                                {{ $scholarship->name }}
                            </p>
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
                                Edit
                            </p>
                        </div>
                    </li>
                </ol>
            </nav>
            <!-- Previous Button -->
            <div class="flex">
                <a href=" {{ route('admin_scholarship_details', $scholarship->id) }}"
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
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Edit Scholarship
            </h2>
        </div>

        {{-- main content --}}
        <div class="block bg--600 flex-row mt-2 mb-4 gap-4 w-full relative">
            <div class="flex mt-4 mb-4 gap-4">
                <span class=" text-red-500 text-xs font-small py-0.5 rounded-full ">
                    * Required
                </span>
            </div>
            <form action="{{ route('admin_update_scholarship', ['id' => $scholarship->id]) }}" method="POST"
                class="w-full bg--600 grid md:grid-cols-2 gap-4 ">
                @csrf
                {{-- first column --}}
                <div>
                    <div class="mb-5 bg--200">
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 ">Scholarship
                            name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-full focus:ring-yellow-500 focus:border-gray-100 focus:ring focus:outline-yellow-300 block w-full p-2.5 "
                            value="{{ $scholarship->name }}">
                    </div>
                    <div class="mb-5 bg--200">
                        <label for="provider" class="block mb-1 text-sm font-medium text-gray-900 ">Scholarship
                            provider <span class="text-red-500">*</span></label>
                        <input type="text" id="provider" name="provider"
                            class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-full focus:ring-yellow-500 focus:border-gray-100 focus:ring focus:outline-yellow-300 block w-full p-2.5 "
                            value="{{ $scholarship->provider }}">
                    </div>
                    <div class="mb-5 bg--400">
                        <label for="description"
                            class="block mb-1 text-sm font-medium text-gray-900 ">Descripition</label>
                        <textarea id="description" name="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:ring focus:border-gray-100 focus:outline-yellow-300 block w-full p-2.5"
                            rows="5">{{ $scholarship->description }}</textarea>
                    </div>
                    <div class="mb-5 bg--400">
                        <label for="requirements"
                            class="block mb-1 text-sm font-medium text-gray-900 ">Requirements</label>
                        <textarea id="requirements" name="requirements"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:ring focus:border-gray-100 focus:outline-yellow-300 block w-full p-2.5"
                            rows="5">{{ $scholarship->requirements }}</textarea>
                    </div>
                </div>
                {{-- second column --}}
                <div>
                    <div class="mb-5 bg--400">
                        <label for="qualifications"
                            class="block mb-1 text-sm font-medium text-gray-900 ">Qualifications</label>
                        <textarea id="qualifications" name="qualifications"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:ring focus:border-gray-100 focus:outline-yellow-300 block w-full p-2.5"
                            rows="5">{{ $scholarship->qualifications }}</textarea>
                    </div>
                    <div class="mb-5 bg--400">
                        <label for="benefits" class="block mb-1 text-sm font-medium text-gray-900 ">Benefits</label>
                        <textarea id="benefits" name="benefits"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:ring focus:border-gray-100 focus:outline-yellow-300 block w-full p-2.5"
                            rows="5">{{ $scholarship->benefits }}</textarea>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin_scholarship_details', $scholarship->id) }}"
                            class="w-2/3 focus:outline-none border-2 border-red-800 text-gray-700  bg-gray-200 focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-md px-5 py-2.5 ">
                            <button type="button" class="w-full">
                                Cancel
                            </button>
                        </a>
                        <button type="submit"
                            class="w-full focus:outline-none text-white  bg-red-800 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-full text-md px-5 py-2.5 ">
                            Edit Scholarship
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


@include('partials.__footer')
