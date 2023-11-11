{{-- this error will show below the field --}}
@error($fieldName)
    <span x-data="{ show: true }" x-show="show" x-init="() => { setTimeout(() => { show = false; }, 10000); }"
        class="text-red-500 text-xs font-small mr-2 py-0.5 rounded-full">
        {{ $message }}
    </span>
@enderror

