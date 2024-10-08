@props(['type', 'message', 'timeout' => 5000])

@if (session()->has($type))
    @if ($type === 'success')
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{ $timeout }})" x-show="show"
            class="fixed z-50 bottom-2 right-6 w-fit h-14 mb-4 text-sm p-4 flex justify-center items-center gap-2  bg-green-700 backdrop-blur-sm rounded-t-3xl rounded-bl-3xl shadow-xl font-semibold text-white animate-pulse">
            <i class="fa-solid fa-circle-check text-xl"></i>
            <span class="animate-pulse">{{ $message }}</span>
        </div>
    @elseif ($type === 'error')
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{ $timeout }})" x-show="show"
            class="fixed z-50 bottom-2 right-6 w-fit h-14 mb-4 text-sm p-4 flex justify-center items-center gap-2  bg-red-600 backdrop-blur-sm rounded-t-3xl rounded-bl-3xl shadow-xl font-semibold text-white animate-pulse">
            <i class="fa-solid fa-circle-xmark text-xl"></i>
            <span class="animate-pulse">{{ $message }}</span>
        </div>
    @elseif ($type === 'warning')
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{ $timeout }})" x-show="show"
            class="fixed z-50 bottom-2 right-6 w-fit h-14 mb-4 text-sm p-4 flex justify-center items-center gap-2  bg-pumpkin-550 backdrop-blur-sm rounded-t-3xl rounded-bl-3xl shadow-xl font-semibold text-white animate-pulse">
            <i class="fa-solid fa-circle-exclamation text-xl"></i>
            <span class="animate-pulse">{{ $message }}</span>
        </div>
    @endif
@endif
