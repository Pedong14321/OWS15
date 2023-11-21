{{-- right side header --}}
<div class="flex flex-row items-center px-4 py-2 mx-4 my-2 gap-2 flex justify-end ">
    <a href=" {{ route('admin_qrscanner') }} ">
        <button type="button"
            class="text-gray-900 flex items-center bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm p-2">
            <span class="material-symbols-rounded">
                qr_code_scanner
            </span>
        </button>
    </a>

    {{-- profile button --}}
    <button type="button"
        class="z-40  flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 "
        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        @php
            $default_profile = 'https://api.dicebear.com/7.x/initials/svg?seed=';
            if (Auth::check() && Auth::user()->admin_fname) {
                $default_profile .= Auth::user()->admin_fname;
            } else {
                // Handle the case where the user is not logged in or admin_fname is null
                $default_profile .= 'default_seed'; // You can replace "default_seed" with a default value or handle it as needed
            }
        @endphp
        <img class="h-10 w-10 rounded-full border-4"
            src="{{ Auth::check() && Auth::user()->admin_image ? asset('/storage/admin/thumbnail/' . 'small_' . Auth::user()->admin_image) : $default_profile }}"
            alt="user photo">
    </button>

    <!-- menu after profile button click -->
    <div class="absolute right-8 top-12 z-40 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow "
        id="user-dropdown">
        <div class="px-4 py-3">
            @if (Auth::check())
                <span class="block text-sm text-gray-900 ">{{ Auth::user()->admin_fname }}
                    {{ Auth::user()->admin_lname }}</span>
                <span class="block text-sm  text-gray-500 truncate ">{{ Auth::user()->email }}</span>
            @else
                <p>You are not logged in.</p>
            @endif
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
                <form action=" {{ route('admin_processlogout') }} " method="POST" class="block w-full">
                    @csrf
                    <input type="submit" value="Logout"
                        class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 " />
                </form>
            </li>
        </ul>
    </div>

</div>
