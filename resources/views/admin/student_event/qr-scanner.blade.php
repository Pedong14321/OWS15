@include('partials.__header')

{{-- external script for reading the qr code
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> --}}
{{-- <script type="text/javascript" src="{{ asset('js/my-script.js') }}"></script> --}}

{{-- container for scanner preview --}}
<div class="relative flex items-center justify-center w-full bg-black min-h-screen min-w-screen">
    <a href=" {{ route('admin_stud_events') }} " class="z-50">
        <button type="button"
            class="absolute top-6 end-6 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center ">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </a>
    <div class=" w-10/12 z-50 absolute top-5 left-1/2 transform -translate-x-1/2 ">
        <div class="mt-6 flex items-center w-full justify-center">
            <p class="text-white  text-xs pr-1">Event:</p>
            <h3 class="text-white ">{{ $event->event_name }}</h3>
        </div>
    </div>
    <div
        class=" border-2 border-white w-7/12 h-2/6 md:w-5/12 lg:h-3/6 z-50 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        {{--  --}}
    </div>

    <video class=" min-h-screen min-w-screen bg--400" id="preview" ></video>

    <div class="border h-14 w-8/12 z-50 absolute bottom-8 left-1/2 transform -translate-x-1/2 rounded-lg">
    </div>
</div>


{{-- for passing data --}}
<form action="{{ route('admin_procesqr') }}" id="scanner_form">
    @csrf
    <input type="text" id="scanner" name="scanner" hidden>
    <input type="text" name="event_id" hidden value="{{ $event->event_id }}">
    <input type="text" name="in_out" hidden value="{{ $in_out }}">
</form>

<script type="text/javascript" src="/js/instascan.min.js"></script>

{{-- script for qr code scanner --}}
<script type="text/javascript">
    // for broadcasting the video
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        mirror: true,
    });
    // for getting the camera
    Instascan.Camera.getCameras()
        .then(function(cameras) {

            let frontcam = 0;
            let rearcam = 1;

            if (cameras.length > 0) {

                scanner.start(cameras[rearcam]);

            } else {
                alert('no cameras found!');
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
