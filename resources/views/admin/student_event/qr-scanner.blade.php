@include('partials.__header')

{{-- external script for reading the qr code --}}
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

@include('partials.__admin_sidebar')

{{-- right side of sidebar --}}
<div class="md:ml-60 pb-4">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main white containter --}}
    <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg" style="min-height: 90vh">

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
        <div class="flex items-center justify-center mt-2 mb-4 gap-4">
            {{-- left --}}
            <div class="min-h-full md:flex justify-center rounded-lg ">
                {{-- container for scanner preview --}}
                <div class="w-full border">
                    <video class="w-full max-h-96" id="preview"></video>
                </div>
            </div>
            {{-- for passing data --}}
            <form action="{{ route('admin_procesqr') }}" method="POST" id="scanner_form">
                @csrf
                <input type="text" id="scanner" name="scanner" hidden>
            </form>
        </div>

    </div>
</div>

{{-- script for qr code scanner --}}
<script type="text/javascript">
    // for broadcasting the video
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    // for getting the camera
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
    // getting the value of qr code
    scanner.addListener('scan', function(c) {
        if (c) { // if value detected

            var regex = /^OWS-/;
            if (regex.test(c)) {
                var numericPart = parseInt(c.replace(/^OWS-/, ''), 10);
                document.getElementById('scanner').value = numericPart;
                document.getElementById('scanner_form').submit();
            } else {
                alert("Invalid OWS QR Code!");
            }
        }
    });
</script>

{{-- for handling the modal --}}
<script>
    window.onload = function() {
        // showModal();
    };

    function showModal() {
        // Get the modal element
        var modal = document.getElementById('popup-modal');
        // Display the modal
        modal.classList.remove('hidden');
    }
    // Add a function to hide the modal
    function hideModal() {
        // Get the modal element
        var modal = document.getElementById('popup-modal');
        // Hide the modal
        modal.classList.add('hidden');
    }
    // Add a click event listener to the modal close button
    var closeButton = document.querySelector('[data-modal-hide="popup-modal"]');
    if (closeButton) {
        closeButton.addEventListener('click', hideModal);
    }
</script>

@include('partials.__footer')
