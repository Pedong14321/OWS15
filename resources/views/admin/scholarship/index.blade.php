<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Font1:style1,style2|Font2:style1,style2&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.js">
    @include('partials.__header')
    @include('partials.__admin_sidebar')
    <title>Scholarships</title>
    <style>
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, system-ui, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
        }

        .error-border {
            border: 1px solid red !important;
        }

        .containers {
            color: dimgray;
            border: 2px solid lightgray;
            transition: box-shadow 0.3s ease;
            /* Add a smooth transition for the box shadow */

            /* Initial box shadow (no shadow) */
            box-shadow: 0 0 0 rgba(0, 0, 0, 0);
        }

        .containers:hover {
            /* Add box shadow on hover */
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }

        .del-icon {
            font-size: xx-large;
        }

        .del-icon:hover {
            color: #630606;
        }

        .btn {
            color: white;
            background-color: #630606;
            border: 1px solid black;

        }

        .btn:hover {
            background-color: #630606;
        }

        .btn-del {
            color: black;
            border: 1px solid black;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .btn-del:hover {
            background-color: #630606;
            color: white;
        }

        @media (max-width: 768px) {
            .tablet-stack {
                display: flex;
                flex-direction: column;
            }
        }
    </style>
    <script>
    {{--Scholarship Creation & Cancel Creation Process--}}
    let scholarshipToCreate = null; // Scholarship to be added

    function createScholarship() {
    document.getElementById('createModal').classList.remove('hidden')
    }

    function confirmCreation() {
    const scholarshipName = document.getElementById('scholarshipName');
    const scholarshipType = document.getElementById('scholarshipType');
    const scholarshipDescription = document.getElementById('scholarshipDescription');
    const applicationProcess = document.getElementById('scholarshipApplicationProcess');
    const email = document.getElementById('scholarshipEmail');
    const contact = document.getElementById('scholarshipContact');
    const errorDiv = document.getElementById('errorDiv');

    if (scholarshipName.value === '' || scholarshipType.value === '' || scholarshipDescription.value === '' ||
    applicationProcess.value === '' || email.value === '' || contact.value === '') {
    errorDiv.innerText = 'The field(s) are required.';

    scholarshipName.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    scholarshipType.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    scholarshipDescription.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    applicationProcess.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    email.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    contact.classList.add('border-red-500', 'animate__animated', 'animate__headShake');

    // Remove any previous error message
    errorDiv.innerText = '';

    } else {
    const scholarshipContainer = document.getElementById('scholarship-container');
    const newScholarshipDiv = document.createElement('div');

    newScholarshipDiv.classList.add('containers', 'flex', 'flex-col', 'items-start', 'justify-start', 'h-auto', 'p-4', 'rounded-lg');
    newScholarshipDiv.innerHTML = `
    <form action="scholarships-grantees" method="GET">
        <div class="flex items-end justify-end w-full">
            <button onclick="deleteScholarship(this)">
                <span class="del-icon material-symbols-outlined">delete</span>
            </button>
        </div>
        <p style="font-weight: bolder; font-size: x-large;">${scholarshipName.value}</p>
        <br>
        <div class="tablet-stack flex flex-col md:flex-row md:space-x-2 items-end justify-end w-full mt-2.5 gap-2">
            // <a href="{{route('admin.grantees')}}">
                <button class="btn-del text-base sm:text-xl text-white px-4 py-1.5 focus:ring-4 focus:outline-none rounded-full w-full md:w-auto text-center md:text-left">
                    Grantees
                </button>
            </a>
            <button class="btn text-base sm:text-xl text-white px-6 py-1.5 focus:ring-4 focus:outline-none rounded-full w-full md:w-auto text-center md:text-left" style="background-color: #630606; color: white;">
                Details
            </button>
        </div>
    </form>
    `;

    scholarshipContainer.appendChild(newScholarshipDiv);

    // Clear the fields
    scholarshipName.value = '';
    scholarshipType.value = '';
    scholarshipDescription.value = '';
    applicationProcess.value = '';
    email.value = '';
    contact.value = '';

    // Display the confirmation modal
    showConfirmationModalForScholarshipCreation();
    }
    }

    function cancelCreation() {
    scholarshipToCreate = null;
    document.getElementById('createModal').classList.add('hidden');
    }

    // Function to show the confirmation modal for Scholarship Creation
    function showConfirmationModalForScholarshipCreation() {
    const confirmationModal = document.getElementById('confirmation-modal-for-creation');
    confirmationModal.classList.remove('hidden');

    setTimeout(() => {
    closeConfirmationModalForScholarshipCreation();
    }, 2000);
    }

    // Function to hide the scholarship to be created
    function hideScholarshipToCreate() {
    scholarshipToCreate.classList.add('hidden');
    }

    // Function to show the scholarship to be created
    function showScholarshipToCreate() {
    scholarshipToCreate.classList.remove('hidden');
    }

    // Function to close the confirmation modal
    function closeConfirmationModalForScholarshipCreation() {
    const confirmationModal = document.getElementById('confirmation-modal-for-creation');
    const createModal = document.getElementById('createModal');
    // scholarshipToCreate.remove();
    // scholarshipToCreate = null;
    confirmationModal.classList.add('hidden');
    createModal.classList.add('hidden');
    }





    {{--Scholarship Deletion & Cancel Deletion Process--}}

    let scholarshipToDelete = null; // Scholarship to be deleted

    function deleteScholarship(deleteButton) {
    const scholarshipDiv = deleteButton.closest('.containers');
    if (scholarshipDiv) {
    scholarshipToDelete = scholarshipDiv;
    document.getElementById('deleteModal').classList.remove('hidden')
    }
    }

    function confirmDelete() {
    const passwordConfirmation = document.getElementById('passwordConfirmation');
    const passwordValue = passwordConfirmation.value;
    const passwordField = document.getElementById('passwordConfirmation');
    const errorDiv = document.getElementById('errorDiv'); // New div for error message

    // Password validation logic here
    const correctPassword = '1234567890';

    if (passwordValue === correctPassword) {
    if (scholarshipToDelete) {
    showConfirmationModal();
    }
    } else if (passwordValue === '') {
    // Indicate that the password field is required
    passwordField.classList.add('border-red-500'); // Add a red border
    passwordField.classList.add('animate__animated', 'animate__headShake'); // Add a shaking animation

    // Remove any previous error message
    errorDiv.innerText = '';

    // Clear the password field
    passwordConfirmation.value = '';
    } else {
    // Display error message
    errorDiv.innerText = 'Incorrect password. Deletion canceled.';

    // Clear the previous styles for the password field
    passwordField.classList.remove('border-red-500', 'animate__animated', 'animate__headShake');
    }
    }

    function cancelDelete() {
    scholarshipToDelete = null;
    document.getElementById('deleteModal').classList.add('hidden');
    }


    // Function to show the confirmation modal
    function showConfirmationModal() {
    const confirmationModal = document.getElementById('confirmation-modal');
    hideScholarshipToDelete();
    confirmationModal.classList.remove('hidden');
    }

    // Function to hide the scholarship to be deleted
    function hideScholarshipToDelete() {
    scholarshipToDelete.classList.add('hidden');
    }

    // Function to show the scholarship to be deleted
    function showScholarshipToDelete() {
    scholarshipToDelete.classList.remove('hidden');
    }

    // Function to close the confirmation modal
    function closeConfirmationModal() {
    const confirmationModal = document.getElementById('confirmation-modal');
    const deleteModal = document.getElementById('deleteModal');
    scholarshipToDelete.remove();
    scholarshipToDelete = null;
    confirmationModal.classList.add('hidden');
    deleteModal.classList.add('hidden');
    }

    // Function to undo the deletion (for the "Undo" button)
    function undoDelete() {
    const undoModal = document.getElementById('confirmation-modal');
    showScholarshipToDelete();
    cancelDelete();
    undoModal.classList.add('hidden');
    }
    </script>
</head>

<body>
    <div class=" sm:ml-64">
        <div class=" px-4 py-6 m-4 flex justify-end">
            @include('partials.__admin_profile') {{--admin profile at the end part--}}
        </div>
        <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg dark:border-gray-700">
            <div class=" flex items-center py-2 mb-4 rounded bg-gray-50 dark:bg-gray-800">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items space-x-1 md:space-x-3">
                        <li aria-current="page" class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                <span class="material-symbols-rounded">school</span>
                                <span class="flex-1 ml-3 whitespace-nowrap">Scholarship</span>
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
            {{--page title--}}
            <div class="flex items-center justify-center py-2 mb-4 rounded">
                <ol class="inline-flex items space-x-1 md:space-x-3">
                    <li aria-current="page" class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-400">
                        <span class="flex-1 ml-3 whitespace-nowrap text-2xl">SCHOLARSHIP</span>
                    </li>
                </ol>
            </div>

            {{--search bar--}}
            <div class="flex">
                <div class="relative h-10 w-96 rounded-lg pl-11 mb-10 items-center">
                    <!-- <form action="  search" method="post"> -->
                    <!-- @csrf -->
                    <input type="text" id="search-dropdown" name="skey" class="rounded-lg block p-2.5 h-10 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search..." style="border-color: #630606">
                    <!-- 
                    <a href="{{('') }}" > 

                 -->
                    <button type="submit" id="searchBtn" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white rounded-r-lg border focus:ring-4 focus:outline-none dark:bg-blue-600" style="border-color: #630606; background-color: #630606">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                    <!-- </a>  -->
                    <!-- </form> -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#searchBtn').on('click', function() {
                                var searchTerm = $('#search-dropdown').val();

                                // Send an AJAX request to your Laravel route
                                $.ajax({
                                    url: "{{ ('') }}", // Use the named route
                                    method: 'GET',
                                    data: {
                                        searchTerm: searchTerm
                                    },
                                    success: function(response) {
                                        // Update the scholarship container with search results
                                        var scholarshipContainer = $('#scholarship-container');
                                        scholarshipContainer.html(response);
                                    }
                                });
                            });
                        });
                    </script>
                </div>
                <div class="relative h-10 w-12 rounded-lg pl-11 mb-10 items-start">
                    <button type="button" id="addBtn" onclick="createScholarship()" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white rounded-lg border focus:ring-4 focus:outline-none" style="border-color: #630606; background-color: #630606">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="8" fill="transparent" stroke="currentColor" stroke-width="2" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6v8m0-4h4m-4 0H6" />
                        </svg>
                    </button>
                </div>
            </div>




            {{--scholarships container--}}
            <div id="scholarship-container" class="grid grid-cols-2 gap-4 mb-4 pl-11">
                @for($x = 0; $x < $cnter; $x++) {{--TES Scholarship Program--}} <div class="containers flex flex-col items-start justify-start h-auto p-4 rounded-lg">
                    {{--delete icon for scholarship deletion--}}
                    <div class="flex items-end justify-end w-full">
                        <button onclick="deleteScholarship(this)">
                            <script>
                                function deleteScholarship(deleteButton) {
                                    const scholarshipDiv = deleteButton.closest('.containers');
                                    if (scholarshipDiv) {
                                        scholarshipToDelete = scholarshipDiv;
                                        document.getElementById('deleteModal').classList.remove('hidden')
                                    }
                                }
                            </script>
                            <!--                 
                        <a href="delete?id={{$id[$x]}}"> <button> -->
                            <span class="del-icon material-symbols-outlined">delete</span>
                        </button>
                        <!-- </a> -->
                    </div>
                    <p style="font-weight: bolder; font-size: x-large;">
                        {{ $name[$x] }} scholarship program
                    </p>

                    <p style="font-weight: bolder; font-size: x-large;">
                        Scholarship ID- {{$sid[$x]}}
                    </p>


                    <br>
                    <div class="tablet-stack flex flex-col md:flex-row md:space-x-2 items-end justify-end w-full mt-2.5 gap-2">
                        <form action="{{ route('admin.grantees') }}" method="GET">
                            <a href="{{ route('admin.grantees') }}">
                                <button class="btn-del text-base sm:text-xl text-white px-4 py-1.5 focus:ring-4 focus:outline-none rounded-full w-full md:w-auto text-center md:text-left">
                                    Grantees
                                </button>
                            </a>
                        </form>
                        <button class="btn text-base sm:text-xl text-white px-6 py-1.5 focus:ring-4 focus:outline-none rounded-full w-full md:w-auto text-center md:text-left" style="background-color: #630606; color: white;">
                            Details
                        </button>
                    </div>
            </div>
            @endfor


        </div>

    </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
        <div class="relative flex flex-col items-center justify-center w-auto rounded-3xl">
            {{-- maroon div--}}
            <div class="relative flex items-center justify-center w-auto rounded-3xl" style="background-color: #630606">
                {{-- white div--}}
                <div class="relative p-8 bg-white max-w-2xl mt-4 rounded-3xl text-center">
                    {{-- delete icon--}}
                    <div class="flex justify-center items-center h-20 w-20 rounded-full" style="margin-top: -70px; margin-left: 40%; background-color: #630606;">
                        <span class="material-symbols-outlined" style="font-size: 45px; color: white;">delete</span>
                    </div>
                    <div class="sm:px-16">
                        <div class="text-2xl mb-4 text-center font-bold ">Delete Scholarship?</div>
                        <div class="text-lg mb-4 text-center">You'll permanently lose your:</div>
                        <div class="text-lg mb-4 text-center">- TDP Scholarship Program</div>
                        <div class="text-lg mb-4 text-center">- TDP Grantee(s) Information</div>
                        <hr style="border: 1px solid black;">
                        <div class="text-lg mb-4 text-center">Enter your Scholarship ID to confirm"</div>
                        <div id="errorDiv" class="text-red-500"></div>
                        <form method="POST" action="delete">
                            @csrf

                            <input type="text" name="schoid" class="border p-2 mb-4 w-full items-center text-center rounded-lg" placeholder="Enter your Scholarship ID to confirm">
                            <div class="flex justify-end space-x-2">
                                <button type="reset" onclick="cancelDelete()" class="btn-del p-1.5 rounded-2xl w-1/2">Cancel</button>
                                <button name="deleteButton" type="submit" class="btn p-1.5 rounded-2xl w-1/2" style="background-color: #630606; color: white">
                                    Delete
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Confirmation Modal for Deletion -->
    <div id="confirmation-modal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
        <div class="modal-box p-8 bg-white shadow-lg rounded-lg">
            <p class="text-lg mb-4">TDP Scholarship Program has been deleted.</p>
            <div class="flex justify-end">
                <button onclick="undoDelete()" class="btn btn-secondary p-1.5 rounded-2xl w-1/2">Undo</button>
                <button onclick="closeConfirmationModal()" class="btn btn-primary ml-2 p-1.5 rounded-2xl w-1/2" style="background-color: #630606; color: white">Close
                </button>
            </div>
        </div>
    </div>

    {{--add scholarship modal--}}
    <div data-aos="flip-up" id="createModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
        {{--white div--}}
        <div class="relative p-6 bg-white mt-4 rounded-3xl w-1/2">
            <h1 style="font-size: 34px; color: #630606; font-weight: bold;">CREATE NEW SCHOLARSHIP</h1>
            <hr style="border: 1px solid black;">
            <div id="errorDiv" class="text-red-500"></div>
            <br>
            <form method="POST" action="{{ route('admin_savescholar_index') }} ">
                @csrf
                {{--row 1--}}
                <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 3fr 1fr;">
                    <div class="flex flex-col">
                        <label for="scholarshipName" class="text-gray-500 font-semibold">
                            Scholarship Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="scholarshipName" class="rounded-lg">
                    </div>
                    <div class="flex flex-col">
                        <label for="scholarshipType" class="text-gray-500 font-semibold">Type <span class="text-red-500">*</span>
                        </label>
                        <select id="scholarshipType" name="type" class="rounded-lg p-1 h-10">
                            <option value="Check">Check</option>
                            <option value="ATM">ATM</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                </div>
                <hr>
                <br>
                {{--row 2--}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="flex flex-col">
                        <label for="scholarshipDescription" class="text-gray-500 font-semibold">
                            Scholarship Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="scholarshipDescription" rows="5" class="rounded-lg" style="resize: vertical; min-height: 50px;"></textarea>
                        <script>
                            function autoResize(textarea) {
                                textarea.style.height = 'auto';
                                textarea.style.height = textarea.scrollHeight + 'px';
                            }
                        </script>
                    </div>
                    <div class="flex flex-col">
                        <label for="scholarshipApplicationProcess" class="text-gray-500 font-semibold">
                            Application Process <span class="text-red-500">*</span>
                        </label>
                        <textarea name="scholarshipApplicationProcess" rows="5" class="rounded-lg" style="resize: vertical; min-height: 50px;"></textarea>
                        <script>
                            autoResize();
                        </script>
                    </div>
                </div>
                {{--row 3--}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label for="scholarshipEmail" class="text-gray-500 font-semibold">Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="scholarshipEmail" class="rounded-lg">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="scholarshipContact" class="text-gray-500 font-semibold">Contact <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="contact" class="rounded-lg" required oninput="this.value = this.value.replace(/[^0-9]/g, '').substr(0, 11);">

                    </div>
                </div>
                {{--buttons--}}
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="cancelCreation()" class="btn-del p-1.5 rounded-2xl w-1/2">
                        Cancel
                    </button>
                    <button type="submit" id="createButton" class="btn p-1.5 rounded-2xl w-1/2" style="background-color: #630606; color: white">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal for Creation -->
    <div id="confirmation-modal-for-creation" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
        <div class="modal-box p-8 bg-white shadow-lg rounded-lg">
            <p class="text-lg mb-4">Scholarship added successfully.</p>
            {{-- <div class="flex justify-end">--}}
            {{-- <button onclick="closeConfirmationModalForScholarshipCreation()"--}}
            {{-- class="btn btn-primary ml-2 p-1.5 rounded-2xl w-1/2"--}}
            {{-- style="background-color: #630606; color: white">Close--}}
            {{-- </button>--}}
            {{-- </div>--}}
        </div>
    </div>
    @include('partials.__footer')
</body>

</html>