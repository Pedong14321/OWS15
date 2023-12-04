@include('partials.__header')
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
    @include('partials.__sidebar')
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

    <div data-aos="flip-up" id="editGranteeModal" class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
        {{--white div--}}
        <div class="relative p-8 bg-white mt-4 rounded-3xl w-auto">
            <h1 style="font-size: 34px; color: #630606; font-weight: bold;">Edit CSP Full SSP Grantee</h1>
            <hr style="border: 1px solid black;">
            <div id="errorDiv" class="text-red-500"></div>
            <br>
            <form action="EditGrants" method="POST">
                @csrf


                {{--row 1--}}
                <div class="grid grid-cols-3 gap-8 mb-4" style="grid-template-columns: 3fr 3fr 3fr;">
                    <div class="flex flex-col">
                        <label for="lastName" class="text-gray-500 font-semibold">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="lastName" class="rounded-lg uppercase" value="{{$lname[0]}}">
                        <input type="text" name="id" class="rounded-lg uppercase" value="{{$id[0]}}" hidden>
                    </div>
                    <div class="flex flex-col">
                        <label for="firstName" class="text-gray-500 font-semibold">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="firstName" class="rounded-lg" value="{{$fname[0]}}">
                    </div>
                    <div class="flex flex-col">
                        <label for="middleName" class="text-gray-500 font-semibold">
                            Middle Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="middleName" class="rounded-lg" value="{{$Mname[0]}}">
                    </div>
                </div>
                <hr>
                <br>

                {{--row 2--}}

                <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 3fr 3fr 3fr;">
                    <div class="flex flex-col">
                        <label for="program" class="text-gray-500 font-semibold">Program <span class="text-red-500">*</span>
                        </label>
                        <select name="program" name="type" class="rounded-lg p-1 h-10">
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
                        <label for="yearLevel" class="text-gray-500 font-semibold">Year Level <span class="text-red-500">*</span>
                        </label>
                        <select name="Yrlevel" name="type" class="rounded-lg p-1 h-10">
                            <option value="First Year">First Year</option>
                            <option value="Second Year">Second Year</option>
                            <option value="Third Year">Third Year</option>
                            <option value="Fourth year">Fourth Year</option>
                            <option value="Fifth Year">Fifth Year</option>
                        </select>

                    </div>
                    <div class="flex flex-col">
                        <label for="paymentType" class="text-gray-500 font-semibold">Type <span class="text-red-500">*</span>
                        </label>
                        <select name="paymentType" name="type" class="rounded-lg p-1 h-10">
                            <option value="Check">Check</option>
                            <option value="ATM">ATM</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                </div>

                {{--row 3--}}
                <div class="grid grid-cols-2 gap-4 mb-4 " style="grid-template-columns: 7fr 3fr;">
                    <div class="flex flex-col">
                        <label for="studentEmail" class="text-gray-500 font-semibold">Student Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="studentEmail" class="rounded-lg" value="{{$studentEmail[0]}}">
                    </div>
                    <div class="flex flex-col">
                        <label for="paymentType" class="text-gray-500 font-semibold">Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" class="rounded-lg p-1 h-10">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                {{--row 4--}}
                <div class="grid grid-cols-2 gap-4 mb-4" style="grid-template-columns: 7fr 3fr;">
                    <div class="flex flex-col">
                        <label for="studentID" class="text-gray-500 font-semibold">Student ID <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="studentID" class="rounded-lg" value="{{$studentID[0]}}">
                    </div>
                    <div class="flex flex-col">
                        <label for="contact" class="text-gray-500 font-semibold">Contact <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="contact" class="rounded-lg" value="{{$contact[0]}}">
                    </div>
                </div>
                {{--buttons--}}
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="cancel()" class="btn-del p-1.5 rounded-2xl w-1/2">
                        Cancel
                    </button>
                    <button id="createButton" type="submit" class="btn p-1.5 rounded-2xl w-1/2" style="background-color: #630606; color: white">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

@include('partials.__footer')