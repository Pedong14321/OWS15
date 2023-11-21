@include('partials.__header')

@include('partials.__admin_sidebar')

{{-- right side section --}}
<div class="md:ml-60">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

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

        {{-- 1st, 3 col --}}
        <div class="grid grid-cols-3 gap-4 mb-4">
            <a href=" {{ route('admin_manage') }} ">
                <div class="flex flex-col items-center justify-center h-24 rounded border">
                    <span class="material-symbols-rounded">manage_accounts</span>
                    <p class="text-sm">Manage Admins</p>
                </div>
            </a>
        </div>

    </div>
</div>
</div>

@include('partials.__footer')
