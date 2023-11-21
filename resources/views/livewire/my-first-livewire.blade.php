{{-- If your happiness depends on money, you will never be happy with yourself. --}}


<div wire:poll.1000ms> {{-- dynamically fetching data every 1sec --}}
    <h1>Present Admins</h1>

    <ul>
        @foreach ($admins as $admin)
            <li>{{ $admin->admin_fname }}</li>
        @endforeach
    </ul>

</div>
