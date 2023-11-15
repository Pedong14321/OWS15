@include('partials.__header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!-- Include additional stylesheets or scripts if needed -->
    <title>Your Dashboard</title>
</head>
<style>
    body{
        margin: 0;
        padding: 0;
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, system-ui, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
    }
    .click:hover{
        background-color: maroon;
        color: white;
    }
    .text:hover{
        font-weight: bold;
    }

    .containers{
        border: 1px solid lightgray;
        cursor: pointer;
    }

    .containers:hover{
        border: 1px solid;
        box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.3);
    }
</style>
<body class="bg-gray-200 font-sans p-0 m-0">
    <!-- Main Content -->
    <div class="container mx-auto bg-red-900 p-4 rounded-tl-md rounded-tr-md shadow-md mt-4 h-full">
        <!-- Main content of the red container goes here -->
    </div>
    <div class="container mx-auto bg-white rounded-b-md shadow-md border border-black h-full" style="height: 92vh;">
        <div class="bg-white shadow-md w-auto border-b mt-2 ">
            <div class="flex items-center mb-4">
                <img src="/images/student/usep-logo-small.png" alt="Mini Logo" class="ml-12 h-10">
                <div class="border-l border-gray-400 h-10 mx-4"></div><!-- Vertical line -->
                <div>
                    <p class="font-semibold">OSAS Web Services</p>
                    <p>Student Space</p>
                </div>
                <div class="ml-auto mx-4 ">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                        </svg>
                    </div>
                </div>
                <div class="relative group">
                    <img src="/images/student/sydney-id.jpg" alt="Profile Picture" class="mr-10 h-10 rounded-full cursor-pointer" onclick="toggleProfile()" loading="lazy">
                    <div id="myModal" class="hidden w-80 border h-auto group-hover:block absolute right-6 top-0 mt-10 p-4 bg-white rounded shadow-md">
                        <div class="flex items-center flex-col">
                            <img src="/images/student/sydney-id.jpg" alt="Profile Picture" class="mb-4 h-20 rounded-full" loading="lazy">
                            <h3 class="text-lg font-semibold text-red-900">2021-00019</h3>
                            <p class="text-md font-semibold">sapelino00202@usep.edu.ph</p>
                            <p class="text-lg font-semibold">PELINO, SYDNEY A. </p>
                            <p class="text-sm" >Bachelor of Science in Information Technology <br> <span class="mx-12">Major in Information Security</span> </p>
                        </div>
                        <div class="mt-4 flex flex-col">
                            <button onclick="openModal()" class="bg-gray-200 w-full h-10 mb-2 flex items-center click">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 mx-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="border-t border-gray-400"></span> <p class="mx-10">Profile</p>
                            </button>
                            <button onclick="logout()" class="bg-gray-200 w-full h-10 flex items-center click">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 mx-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                <span class="border-t border-gray-400"></span> <p class="mx-10">Logout</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <!--basta dashboard-->
        <div class="container p-4">
            <div class="grid grid-cols-6 gap-2 p-5">              
                <div class="click bg-gray-200 p-1 rounded-3xl shadow-md">
                    <h2 class="click text-lg mx-12">Dashboard</h2>
                </div>
                <div class="click p-1 rounded-3xl shadow-md" style="background-color: #7f1d1d;">
                    <h2 class="text-lg mx-8 text-white">Accountabilities</h2>
                </div>
                <div class="click bg-gray-200 p-1 rounded-3xl shadow-md">
                    <h2 class="text-lg mx-16">Events</h2>
                </div>
                <div class="click bg-gray-200 p-1 rounded-3xl shadow-md">
                    <h2 class="text-lg mx-14">Clearance</h2>
                </div>
                <div class="click bg-gray-200 p-1 rounded-3xl shadow-md">
                    <h2 class="text-lg mx-12">Scholarship</h2>
                </div> 
                <div class="click bg-gray-200 p-1 rounded-3xl shadow-md">
                    <h2 class="text-lg mx-12">Profile</h2>
                </div>     
            </div>
            <hr>
            <br>
            <div class="container flex" style="justify-content: space-between;">
                <div>
                    <h1 style="font-size: 30px; padding-left: 25px; font-weight: 700;">Accountabilities</h1>
                </div>
                <div>
                    <button class="h-12 w-44 text-white px-6" style="background-color: #189625; font-size: 20px; font-weight: 600; display: flex; align-items: center; justify-content: center; border-radius: 30px; background-color 0.3s ease;"><span class="material-symbols-outlined" style="font-size: 30px;">refresh</span>&nbsp;Refresh</button>                      
                </div>
            </div>
            <br>
            <br>
            <!--Accountabilities more details-->
            <div id="scholarship-container" class="grid grid-cols-1 gap-4 mb-4 pl-11 pr-11">
                {{--Clinic Office--}}
                <div class="containers grid grid-cols-3 gap-1 pl-7 items-center justify-center pt-1 rounded-lg" style="grid-template-columns: .2fr 2fr .5fr; height: 80px;">
                    <div>
                        <img src="/images/student/osas-logo.png" alt="" style="height: 70px; width: 70px;">
                    </div>
                    <div>
                        <p style="font-weight: bolder; font-size: x-large;">
                            <strong>Lacking of Medical Result</strong>
                        </p>
                        <p style="font-size: large; color: gray;">
                            OFFICE: Clinic
                        </p>
                    </div>
                </div>
            </div>
            <div id="scholarship-container" class="grid grid-cols-1 gap-4 mb-4 pl-11 pr-11">
                {{--Date Issued--}}
                <div class="containers grid grid-cols-2 gap-80 pl-7 items-center justify-center pt-1 rounded-lg" style="height: 40px;">
                    <div class="items-center justify-center">
                        <p style="font-size: large; color: gray;">
                            <span class="material-symbols-outlined items-center justify-center" style="font-size: 35px;">calendar_clock</span>&nbsp;&nbsp;&nbsp;ISSUED: September 13, 2023
                        </p>
                    </div>
                    <div>
                        <p style="font-size: large; color: gray;">
                            <span class="material-symbols-outlined items-center justify-center" style="font-size: 35px;">warning</span>DUE: November 20, 2023
                        </p>
                    </div>
                </div>
            </div>
        </div>   
    </div>

    <!--basta dashboard-->
    <script>
        var modal = document.getElementById("myModal");

        function openModal() {
            modal.style.display = "block";
        }
        function closeModal() {
            modal.style.display = "none";
        }
        function toggleProfile() {
            console.log("Toggle Profile");
            modal.style.display = modal.style.display === "none" ? "block" : "none";
        }
    </script>

    <!--profile modal-->
    <div id="Modal" class="modal fixed inset-0 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container p-2 bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto ">
                <div class="modal-content pt-4 text-left px-6">
                    <div class="mb-4">
                        <p class="text-2xl ">Update Profile Picture</p> <br>
                        <p><span class="text-yellow-400 font-semibold text-md">FIRST STEP! </span>Upload your most recent, colored, professional digital photo with white background.</p><br>
                        <p><span class="text-red-900 font-semibold  text-md">IMPORTANT!</span> If you are using your phone's camera, you may need to go to your camera's settings and set the picture quality to 'Standard' or 'Low' to fit the file size limit.</p>
                    </div>
                    <div class="border border-gray-500 p-10 rounded-xl items-center flex flex-col justify-center text-center">
                        <label for="fileInput" class="text text-black text-lg px-6 py-2 rounded-xl focus:outline-none focus:shadow-outline">Drag file here</label>
                        <input type="file" id="fileInput" class="hidden">
                        <br>
                        <span class="mx-2 text-gray-500">or</span>
                        <br>
                        <label for="fileInput" class="click bg-red-900  px-6 py-2 rounded-xl focus:outline-none focus:shadow-outline">browse</label>
                        <input type="file" id="fileInput" class="hidden">
                        <span class="mx-2 mt-2 text-gray-500 text-sm">File format must be in JPEG or PNG. Filesize must not exceed 2 MB.</span>
                    </div>
                    <div class="mt-4" style="margin-left: 70%;">
                        <button onclick="closeModal()" class="bg-yellow-500  text-black px-5 py-1 rounded-2xl  focus:outline-none focus:shadow-outline">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("Modal").classList.remove("hidden");
        }
        function closeModal() {
            document.getElementById("Modal").classList.add("hidden");
        }
    </script>

    <!--logout modal-->
    <div id="logoutmodal" class="modal fixed inset-0 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div class="modal-container p-2 bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
                <div class="modal-content pt-4 text-left px-6">
                    <div class="mx-5">
                        <h1 class=" " style="font-size: 20px;" >Do you want to quit and log out now?</h1>
                        <p class="mx-3">If so, enter your password for confirmation</p>       
                    </div>
                    <div class="my-3 mx-5">
                        <label for="password" class="block text-gray-700 text-md mb-2">Enter Password:</label>
                        <input type="password" id="password" name="password" class=" border border-gray-500 rounded py-1 shadow  text-gray-700" style="width: 100%;">
                    </div>
                    <div class="ml-48">
                        <button onclick="closelogout()" class="bg-red-900  click text-black px-5 py-1 rounded-2xl  focus:outline-none focus:shadow-outline">Close</button>
                        <button onclick="" class="border border-gray-500 click  text-black px-5 py-1 rounded-2xl  focus:outline-none focus:shadow-outline">Logout</button>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <script>
        function logout() {
            document.getElementById("logoutmodal").classList.remove("hidden");
        }
        function closelogout() {
            document.getElementById("logoutmodal").classList.add("hidden");
        }
    </script>
</div>
</body>
</html>
@include('partials.__footer')