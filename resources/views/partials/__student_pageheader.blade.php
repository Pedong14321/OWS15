{{-- right side header --}}
<div class="flex flex-row items-center px-4 py-2 mx-4 my-2 gap-2 justify-end ">

    {{-- <div class="flex w-full h-full items-center "> 
        <h3 class=" inline-flex items-center text-lg font-medium text-gray-700 ">Student Space</h3>
    </div> --}}

    <div class="relative">
        {{-- profile button --}}
        <button type="button"
            class="z-40  flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 "
            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
            data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>

            <img class="h-10 w-10 rounded-full border-4"
                @if (Auth::user()->student_picture) {{-- if user uploaded a photo --}}
            src="{{ Auth::user()->student_picture }}"
        @else
        {{-- Provide a default image or leave it empty --}}
        src="https://api.dicebear.com/7.x/initials/svg?seed=" @endif>
        </button>

        <!-- menu after profile button click -->
        <div class="absolute left-0 top-12 z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow "
            id="user-dropdown">
            <div class="px-4 py-3">
                @if (Auth::check())
                    <span class="block text-md font-bold text-slate-700 ">{{ Auth::user()->student_fname }}
                        {{ Auth::user()->student_lname }}</span>
                    <span class="block text-sm  text-gray-500 truncate ">{{ Auth::user()->email }}</span>
                @else
                    <p>You are not logged in.</p>
                @endif
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
                <li class="text-center">
                    <a href="" class="block w-full">
                        <p class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">
                            My Profile
                        </p>
                    </a>
                </li>
                <li>
                    <form action=" {{ route('student_processlogout') }} " method="POST" class="block w-full">
                        @csrf
                        <input type="submit" value="Logout"
                            class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 " />
                    </form>
                </li>
            </ul>
        </div>
    </div>

</div>
