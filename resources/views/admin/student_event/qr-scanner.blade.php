@include('partials.__header')

{{-- external script for reading the qr code --}}
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

@include('partials.__admin_sidebar')

{{-- right side of sidebar --}}
<div class="md:ml-60 pb-4">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main white containter --}}
    <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg dark:border-gray-700" style="min-height: 90vh">

        {{-- navigation container --}}
        <div class="flex items-center  mb-4 rounded ">
            {{-- breadcrumb nav container --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items space-x-1 md:space-x-3">
                    <li aria-current="page" class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">qr_code_scanner</span>
                            QR Code Scanner
                        </a>
                    </li>
                </ol>
            </nav>
        </div>

        {{-- title + button container --}}
        <div class="flex items-center justify-center py-2 mb-4 rounded text-slate-800 ">
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Attendance Scanner
            </h2>
        </div>

        {{-- main content --}}
        <div class="flex flex-row mt-2 mb-4 gap-4">
            {{-- left --}}
            <div class="w-1/2 hidden min-h-full md:flex justify-center rounded-lg ">
                {{-- container for scanner preview --}}
                <div class="w-full border">
                    <video class="w-full max-h-96" id="preview"></video>
                </div>
            </div>

            {{-- right - create new admin form --}}
            <div
                class="md:w-1/2 w-full min-h-screen px-6 py-6 lg:px-8 relative bg-white rounded-lg overflow-y-auto border border-yellow-500 ">
                <div>
                    <input type="text" name="text" readonly id="text" placeholder="qr value">
                </div>
            </div>
        </div>


    </div>

</div>


<script type="text/javascript">
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });

    Instascan.Camera.getCameras()
        .then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }
        })
        .catch(function(e) {
            console.error(e);
        });

    scanner.addListener('scan', function(c) {
        document.getElementById('text').value = c;
    });
</script>

@include('partials.__footer')
