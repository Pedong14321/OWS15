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
    <title>CSP Full SSP Grantees</title>
    <style>
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, system-ui, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
        }

        .action-btns:hover {
            color: #630606;
        }

        .fixed-button {
            position: fixed;
            top: 28%;
            right: 5.7rem;
            /* Adjust the value as needed */
            transform: translateY(-50%);
            z-index: 1;
            /* Adjust the z-index to layer it appropriately */
        }

        .fixed-add-button {
            position: fixed;
            top: 25.7%;
            right: 2rem;
            /* Adjust the value as needed */
            transform: translateY(-50%);
            z-index: 1;
            /* Adjust the z-index to layer it appropriately */
        }

        .fixed-header {
            position: sticky;
            top: 0;
            color: white;
            /* Set your header text color */
            z-index: 1;
            /* Ensures the header stays above the table body */
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

        .Filtermodal {
            margin-left: 67%;
            width: 25%;
        }

        @media (max-width: 768px) {
            .tablet-stack {
                display: flex;
                flex-direction: column;
            }
        }
    </style>

    <script>
    {{--Grantee Adding & Cancellation--}}
    let granteeToBeAdded = null; // Grantee to be added

    // after clicking the create button
    function confirmCreation() {
    const lastName = document.getElementById('lastName');
    const firstName = document.getElementById('firstName');
    const middleName = document.getElementById('middleName');
    const program = document.getElementById('program');
    const paymentType = document.getElementById('paymentType');
    const yearLevel = document.getElementById('yearLevel');
    const studentEmail = document.getElementById('studentEmail');
    const studentID = document.getElementById('studentID');
    const contact = document.getElementById('contact');
    const errorDiv = document.getElementById('errorDiv');

    if (lastName.value === '' || firstName.value === '' || middleName.value === '' ||
    program.value === '' || yearLevel.value === '' ||
    studentEmail.value === '' || studentID.value === '' || contact.value === '' || paymentType.value === '') {

    errorDiv.innerText = '';

    lastName.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    firstName.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    middleName.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    program.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    paymentType.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    yearLevel.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    studentEmail.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    studentID.classList.add('border-red-500', 'animate__animated', 'animate__headShake');
    contact.classList.add('border-red-500', 'animate__animated', 'animate__headShake');

    // Remove any previous error message
    errorDiv.innerText = '';

    } else {
    const granteesTable = document.getElementById('table-container');
    const newGrantee = document.createElement('tr');

    newGrantee.classList.add('bg-white', 'border-b', 'dark:bg-gray-800', 'dark:border-gray-700', 'hover:bg-gray-50', 'dark:hover:bg-gray-600');
    newGrantee.innerHTML = `
    <tbody>
        <tr id="table-row" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <input id="checkbox-table-search-2" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-500 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-table-search-2" class="sr-only">checkbox</label>
                </div>
            </td>
            <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <img class="w-10 h-10 rounded-full" src="/images/cristine.jpg" alt="${lastName.value} image">
                <div class="pl-3">
                    <div class="text-base font-semibold">${lastName.value}, ${firstName.value} ${middleName.value}</div>
                    <div class="font-normal text-gray-500">${studentEmail.value}</div>
                </div>
            </th>
            <td class="px-6 py-4 text-center">
                ${paymentType.value}
            </td>
            <td class="px-6 py-4 text-center">
                ${program.value}
            </td>
            <td class="px-6 py-4 text-center">
                ${yearLevel.value}
            </td>
            <td class="px-6 py-4 text-center" style="color: #22c55e;">
                Active
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center gap-2">
                    {{--view grantee--}}
                    <button>
                        <span class="action-btns material-symbols-outlined">visibility</span>
                    </button>
                    {{--edit grantee--}}
                    <button>
                        <span id="editBtn" onclick="editGrantee()" class="action-btns material-symbols-outlined">edit</span>
                    </button>
                    {{--delete grantee--}}
                    <button>
                        <span onclick="deleteScholarship(this)" class="action-btns material-symbols-outlined">delete</span>
                    </button>
                </div>
            </td>
        </tr>
    </tbody>
    `;

    granteesTable.appendChild(newGrantee);

    // Clear the fields
    lastName.value = '';
    firstName.value = '';
    middleName.value = '';
    program.value = '';
    paymentType.value = '';
    yearLevel.value = '';
    studentEmail.value = '';
    studentID.value = '';
    contact.value = '';

    // Display the confirmation modal
    showConfirmationModalForScholarshipCreation();
    }
    }

    function cancelAdd() {
    granteeToBeAdded = null;
    document.getElementById('addGranteeModal').classList.add('hidden');
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
    granteeToBeAdded.classList.add('hidden');
    }

    // Function to show the scholarship to be created
    function showScholarshipToCreate() {
    granteeToBeAdded.classList.remove('hidden');
    }

    // Function to close the confirmation modal
    function closeConfirmationModalForScholarshipCreation() {
    const confirmationModal = document.getElementById('confirmation-modal-for-creation');
    const createModal = document.getElementById('addGranteeModal');
    // scholarshipToCreate.remove();
    // scholarshipToCreate = null;
    confirmationModal.classList.add('hidden');
    createModal.classList.add('hidden');
    }


    {{--gi delete si injil joy--}}
    let scholarshipToDelete = null; // Scholarship to be deleted

    function deleteScholarship(deleteButton) {
    const scholarshipDiv = deleteButton.closest('tr');
    if (scholarshipDiv) {
    scholarshipToDelete = scholarshipDiv;
    document.getElementById('deleteModal').classList.remove('hidden');
    }
    }

    function confirmDelete() {
    const passwordConfirmation = document.getElementById('passwordConfirmation');
    const passwordValue = passwordConfirmation.value;
    const passwordField = document.getElementById('passwordConfirmation');
    const errorDiv = document.getElementById('errorDiv'); // New div for error message

    // Password validation logic here
    const correctPassword = 'yourpassword';

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
    <div class="sm:ml-64">
        <div class="px-4 py-6 m-4 flex justify-end">
            @include('partials.__admin_profile') {{--admin profile at the end part--}}
        </div>
        <div class="p-4 m-4 shadow-lg bg-white border-gray-200 rounded-lg dark:border-gray-700 " style="overflow-x: auto;">
            <div class="flex items-center py-2 mb-4 rounded bg-white dark:bg-gray-800">
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
            <div class="flex items-center justify-center  py-2 mb-4 rounded">
                <ol class="inline-flex items space-x-1 md:space-x-3">
                    <li aria-current="page" class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-400">
                        <span class="flex-1 ml-3 whitespace-nowrap text-2xl">CHED Scholarship Program</span>
                    </li>
                </ol>
            </div>
            <br>
            {{--table div--}}
            <div class="relative overflow-x-auto overflow-y-auto shadow-md sm:rounded-lg border-2" style="height: 68vh;">
                <div class="tablet-stack fixed-button flex pb-4 items-end justify-between">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg h-9 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                    </div>
                    <div class="absolute top-0 right-0 flex items-center justify-center">
                        <button type="button" id="addBtn" onclick="filter()" class="px-3 text-base font-medium h-9 w-fit text-white rounded-lg border focus:ring-4 focus:outline-none" style="background-color: #7f7f7f">
                            <div class="flex items-center">

                                <span class="material-symbols-outlined">tune</span>
                                <span class="ml-2 text-center" style="font-size: 18px;">Filter</span>
                            </div>
                        </button>
                    </div>
                </div>

                {{--add granteeBtn--}}
                <form method="POST" action="scholarships-grantees">

                    <div class="fixed-add-button flex pb-4 items-end justify-end">
                        <div class="absolute top-0 right-0 flex items-center justify-center">
                            <button type="button" id="addBtn" onclick="addGrantee()" class="px-3 text-base font-medium h-9 w-fit text-white rounded-lg border focus:ring-4 focus:outline-none" style="border-color: #630606; background-color: #630606">
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="8" fill="transparent" stroke="currentColor" stroke-width="2" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6v8m0-4h4m-4 0H6" />
                                </svg>
                            </button>
                        </div>
                </form>
            </div>
            {{--table--}}
            <table id="table-container" class="grantees-table table w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="fixed-header text-xs uppercase" style="background-color: #630606; color: white;">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2" style="background-color: #630606; border: 1px solid white">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Program
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Year
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @for($x = 0; $x < $cnter; $x++) <tr id="table-row" class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-3" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-500 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-3" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="/images/sydney.jpg" alt="Jese image">
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{$lname[$x]}}, {{$fname[$x]}} {{$Mname[$x]}}</div>
                                <div class="font-normal text-gray-500">
                                    {{$studentEmail[$x]}}
                                </div>
                            </div>
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{$type[$x]}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{$program[$x]}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{$Yrlevel[$x]}}
                        </td>
                        <td class="px-6 py-4 text-center" style="color: red;">
                            {{$status[$x]}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                {{--view grantee--}}
                                <button>
                                    <span class="action-btns material-symbols-outlined">visibility</span>
                                </button>
                                {{--edit grantee--}}
                                <form action="{{ route('admin.EditGrants') }}" method="POST">
                                    <a href="EditGrant?id={{$id[$x]}}">
                                        <button>
                                            <span id="editBtn" onclick="editGrantee()" class="action-btns material-symbols-outlined">edit</span>
                                        </button></a>
                                </form>
                                {{--delete grantee--}}
                                <a href="deletegrant?id={{$id[$x]}}">
                                    <button>
                                        <span class="action-btns material-symbols-outlined">delete</span>
                                    </button> </a>
                            </div>
                        </td>
                        </tr>

                        @endfor

                </tbody>
            </table>
        </div>
    </div>
    </div>

    {{--add grantees--}}
    <div data-aos="flip-up" id="addGranteeModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
        {{--white div--}}
        <div class="relative p-8 bg-white mt-4 rounded-3xl w-auto">
            <h1 style="font-size: 34px; color: #630606; font-weight: bold;">Add New CSP Full SSP Grantee</h1>
            <hr style="border: 1px solid black;">
            <div id="errorDiv" class="text-red-500"></div>
            <br>
            <form action="savesgrant" method="POST">
                @csrf
                {{--row 1--}}
                <div class="grid grid-cols-3 gap-8 mb-4" style="grid-template-columns: 3fr 3fr 3fr;">
                    <div class="flex flex-col">
                        <label for="lastName" class="text-gray-500 font-semibold">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="lastName" class="rounded-lg uppercase">
                    </div>
                    <div class="flex flex-col">
                        <label for="firstName" class="text-gray-500 font-semibold">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="firstName" class="rounded-lg">
                    </div>
                    <div class="flex flex-col">
                        <label for="middleName" class="text-gray-500 font-semibold">
                            Middle Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="middleName" class="rounded-lg">
                    </div>
                </div>
                <hr>
                <br>
                {{--row 2--}}
                <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 3fr 3fr 3fr;">
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <label for="program" class="text-gray-500 font-semibold">Program <span class="text-red-500">*</span>
                            </label>
                            <select name="program" class="rounded-lg p-1 h-10">
                                <option value="BSABE">BSABE
                                </option>
                                <option value="BSIT">BSIT
                                </option>
                                <option value="BTVTeD">BTVTeD
                                </option>
                                <option value="SOM">SOM
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="paymentType" class="text-gray-500 font-semibold">Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" class="rounded-lg p-1 h-10">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="paymentType" class="text-gray-500 font-semibold">Type <span class="text-red-500">*</span>
                        </label>
                        <select name="paymentType" class="rounded-lg p-1 h-10">
                            <option value="Check">Check</option>
                            <option value="ATM">ATM</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                </div>
                {{--row 3--}}
                <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 7fr 3fr;">
                    <div class="flex flex-col">
                        <label for="studentEmail" class="text-gray-500 font-semibold">Student Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="studentEmail" class="rounded-lg">
                    </div>
                    <div class="flex flex-col">
                        <label for="yearLevel" class="text-gray-500 font-semibold">Year Level <span class="text-red-500">*</span>
                        </label>
                        <select name="Yrlevel" class="rounded-lg p-1 h-10">
                            <option value="First Year">First Year</option>
                            <option value="Second Year">Second Year</option>
                            <option value="Third Year">Third Year</option>
                            <option value="Fourth year">Fourth Year</option>
                            <option value="Fifth Year">Fifth Year</option>
                        </select>
                    </div>
                </div>
                {{--row 4--}}
                <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 7fr 3fr;">
                    <div class="flex flex-col">
                        <label for="studentID" class="text-gray-500 font-semibold">Student ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="studentID" class="rounded-lg">
                    </div>
                    <div class="flex flex-col">
                        <label for="contact" class="text-gray-500 font-semibold">Contact <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="contact" class="rounded-lg" required oninput="this.value = this.value.replace(/[^0-9]/g, '').substr(0, 11);">
                    </div>
                </div>
                {{--buttons--}}
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="cancelAdd()" class="btn-del p-1.5 rounded-2xl w-1/2">
                        Cancel
                    </button>
                    <button id="createButton" type="submit" class="btn p-1.5 rounded-2xl w-1/2" style="background-color: #630606; color: white">
                        Create
                    </button>
                </div>
            </form>

        </div>
    </div>
    <!-- Edit Modal  <form action="" method="POST">
<div data-aos="flip-up" id="editGranteeModal"
     class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
    {{--white div--}}
    <div class="relative p-8 bg-white mt-4 rounded-3xl w-auto">
        <h1 style="font-size: 34px; color: #630606; font-weight: bold;">Edit CSP Full SSP Grantee</h1>
        <hr style="border: 1px solid black;">
        <div id="errorDiv" class="text-red-500"></div>
        <br>
        <form action="" method="POST">
        @csrf
      
            {{--row 1--}}
            <div class="grid grid-cols-3 gap-8 mb-4" style="grid-template-columns: 3fr 3fr 3fr;">
                <div class="flex flex-col">
                    <label for="lastName" class="text-gray-500 font-semibold">
                        Last Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="lastName" class="rounded-lg uppercase">
                </div>
                <div class="flex flex-col">
                    <label for="firstName" class="text-gray-500 font-semibold">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="firstName" class="rounded-lg">
                </div>
                <div class="flex flex-col">
                    <label for="middleName" class="text-gray-500 font-semibold">
                        Middle Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="middleName" class="rounded-lg">
                </div>
            </div>
            <hr>
            <br>
            
            {{--row 2--}}
            
            <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 3fr 3fr 3fr;">
                <div class="flex flex-col">
                <label for="program" class="text-gray-500 font-semibold">Program <span
                                        class="text-red-500">*</span>
                            </label>
                            <select id="program" name="type" class="rounded-lg p-1 h-10">
                                <option value="BSABE">BSABE
                                </option>
                                <option value="BSIT">BSIT
                                </option>
                                <option value="BTVTeD">BTVTeD
                                </option>
                                <option value="SOM">SOM
                                </option>
                            </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="yearLevel" class="text-gray-500 font-semibold">Year Level <span
                                    class="text-red-500">*</span>
                        </label>
                        <select id="yearLevel" name="type" class="rounded-lg p-1 h-10">
                            <option value="First Year">First Year</option>
                            <option value="Second Year">Second Year</option>
                            <option value="Third Year">Third Year</option>
                            <option value="Fourth year">Fourth Year</option>
                            <option value="Fifth Year">Fifth Year</option>
                        </select>
                    
                    </div>
                    <div class="flex flex-col">
                    <label for="paymentType" class="text-gray-500 font-semibold">Type <span
                                    class="text-red-500">*</span>
                        </label>
                        <select id="paymentType" name="type" class="rounded-lg p-1 h-10">
                            <option value="Check">Check</option>
                            <option value="ATM">ATM</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                </div>
                
            {{--row 3--}}
            <div class="grid grid-cols-2 gap-4 mb-4 " style="grid-template-columns: 7fr 3fr;">
                    <div class="flex flex-col">
                    <label for="studentEmail" class="text-gray-500 font-semibold">Student Email <span
                                class="text-red-500">*</span>
                    </label>
                    <input type="email" id="studentEmail" class="rounded-lg">
                    </div>
                    <div class="flex flex-col">
                            <label for="paymentType" class="text-gray-500 font-semibold">Status <span
                                        class="text-red-500">*</span>
                            </label>
                            <select id="paymentType" name="type" class="rounded-lg p-1 h-10">
                                <option value="Check">Active</option>
                                <option value="ATM">Inactive</option>
                            </select>
                     </div>
                </div>
            {{--row 4--}}
            <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 7fr 3fr;">
                <div class="flex flex-col">
                    <label for="studentID" class="text-gray-500 font-semibold">Student ID <span
                                class="text-red-500">*</span>
                    </label>
                    <input type="text" id="studentID" class="rounded-lg">
                </div>
                <div class="flex flex-col">
                    <label for="contact" class="text-gray-500 font-semibold">Contact <span
                                class="text-red-500">*</span>
                    </label>
                    <input type="text" id="contact" class="rounded-lg">
                </div>
            </div>
            {{--buttons--}}
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="cancel()" class="btn-del p-1.5 rounded-2xl w-1/2">
                    Cancel
                </button>
                <button id="createButton" type="button" onclick="confirm()"
                        class="btn p-1.5 rounded-2xl w-1/2"
                        style="background-color: #630606; color: white">
                   Save
                </button>
            </div> 
        </form>
    </div>
</div> -->

    <script>
        function addGrantee() {
            document.getElementById('addGranteeModal').classList.remove('hidden')
        }



        function editGrantee() {
            document.getElementById('editGranteeModal').classList.remove('hidden');
        }

        function cancel() {
            document.getElementById('editGranteeModal').classList.add('hidden');
        }

        function confirm() {
            //  creation logic
        }
    </script>

    {{--filter--}}
    <div id="filterModal" data-aos="flip-up" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
        {{--white div--}}
        <div class="Filtermodal relative p-5 bg-white   rounded-3xl h-auto ">
            <h1 style="font-size: 20px; font-weight: bold;">Filter Data</h1>
            <div class="border-2 border-gray-400 p-2 mb-4 rounded-lg">

                <div class="grid grid-cols-2 gap-6 mb-4" style="grid-template-columns: 7fr 7fr;">
                    <div class="flex flex-col">
                        <div class="flex flex-col">
                            <select id="gender" name="gender" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <select id="program" name="course" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="BSABE">BSABE
                            </option>
                            <option value="BSIT">BSIT
                            </option>
                            <option value="BTVTeD">BTVTeD
                            </option>
                            <option value="SOM">SOM
                            </option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 7fr 7fr;">
                    <div class="flex flex-col">
                        <select id="payment" name="payment" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Check">Check</option>
                            <option value="ATM">ATM</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <select id="yearLevel" name="yearLevel" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="First Year">First Year</option>
                            <option value="Second Year">Second Year</option>
                            <option value="Third Year">Third Year</option>
                            <option value="Fourth year">Fourth Year</option>
                            <option value="Fifth Year">Fifth Year</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-2">

                <button onclick="closeModal()" class="btn-del p-1.5 rounded-2xl w-1/2">Cancel</button>
                <button onclick="applyFilter()" class="btn p-1.5 rounded-2xl w-1/2" style="background-color: #630606; color: white"> Apply Filter</button>
            </div>
        </div>
    </div>
    <script>
        function filter() {
            document.getElementById('filterModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('filterModal').classList.add('hidden');
        }

        function applyFilter() {
            // Logic to apply filter

            console.log("Filter applied");
        }
    </script>
    {{--visibility--}}
    <div data-aos="flip-up" id="visibilityModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
        {{--white div--}}
        <div class="relative p-5 bg-white mt-4 rounded-3xl w-auto">
            <h1 style="font-size: 34px; color: #630606; font-weight: bold;">PROFILE INFORMATION</h1>
            <hr style="border: 1px solid black;">
            <div class="grid grid-cols-2 gap-2 mx-5 " style="grid-template-columns: 2fr 2fr;">
                <div class="flex flex-col">
                    <div class="rounded-lg h-auto w-auto mt-2" style="border: 1px solid black ">

                        <div class="mx-16">

                        </div>

                    </div>
                </div>
            </div>
            <script>
                function view() {
                    document.getElementById('visibilityModal').classList.remove('hidden');
                }

                function cancel() {
                    document.getElementById('visibilityModal').classList.add('hidden');
                }
            </script>
            {{--delete--}}
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
                                <div class="text-2xl mb-4 text-center font-bold ">Delete Grantee(s)??</div>
                                <div class="text-lg mb-4 text-center">You'll permanently lose your:</div>
                                <div class="text-lg mb-4 text-center">- CHED-TDP grantee information(s)</div>
                                <hr style="border: 1px solid black;">
                                <div class="text-lg mb-4 text-center">Enter your password for confirmation</div>
                                <div id="errorDiv" class="text-red-500"></div>
                                <input type="password" id="passwordConfirmation" class="border p-2 mb-4 w-full items-center text-center rounded-lg" placeholder="Enter your password">

                                <div class="flex justify-end space-x-2">
                                    <button onclick="cancelDelete()" class="btn-del p-1.5 rounded-2xl w-1/2">Cancel</button>
                                    <button id="deleteButton" onclick="confirmDelete()" class="btn p-1.5 rounded-2xl w-1/2" style="background-color: #630606; color: white">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmation Modal for Deletion -->
            <div id="confirmation-modal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                <div class="modal-box p-8 bg-white shadow-lg rounded-lg">
                    <p class="text-lg mb-4">TDP Grantee(s) has been deleted.</p>
                    <div class="flex justify-end">
                        <button onclick="undoDelete()" class="btn btn-secondary p-1.5 rounded-2xl w-1/2">Undo</button>
                        <button onclick="closeConfirmationModal()" class="btn btn-primary ml-2 p-1.5 rounded-2xl w-1/2" style="background-color: #630606; color: white">Close
                        </button>
                    </div>
                </div>
            </div>

            <!-- Confirmation Modal for Creation -->
            <div id="confirmation-modal-for-creation" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                <div class="modal-box p-8 bg-white shadow-lg rounded-lg">
                    <p class="text-lg mb-4">Grantee added successfully.</p>
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