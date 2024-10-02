@props(['type', 'message', 'timeout' => 5000])

@if(session()->has($type))
    @if ($type === "success")
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{$timeout}})" x-show="show" class="fixed z-50 bottom-2 right-6 w-fit h-14 mb-4 text-sm p-4 flex justify-center items-center gap-2  bg-white/80 rounded-t-3xl rounded-bl-3xl shadow-xl font-semibold text-green-700 border-2 border-green-700">
        <i class="fa-solid fa-circle-check text-xl animate-pulse"></i>
        <span class="animate-pulse">{{$message}}</span>
    </div>

    @elseif ($type === "error")
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{$timeout}})" x-show="show" class="fixed z-50 bottom-2 right-6 w-fit h-14 mb-4 text-sm p-4 flex justify-center items-center gap-2 rounded-t-3xl rounded-bl-3xl shadow-xl font-semibold bg-white/80 text-red-600 border-2 border-red-600">
        <i class="fa-solid fa-circle-xmark text-xl animate-pulse"></i>
        <span class="animate-pulse">{{$message}}</span>
    </div>

    @elseif ($type === "warning")
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{$timeout}})" x-show="show" class="fixed z-50 bottom-2 right-6 w-fit h-14 mb-4 text-sm p-4 flex justify-center items-center gap-2 rounded-t-3xl rounded-bl-3xl shadow-xl font-semibold bg-white/80 text-pumpkin-550 border-2 border-pumpkin-550">
        <i class="fa-solid fa-circle-exclamation text-xl animate-pulse"></i>
        <span class="animate-pulse">{{$message}}</span>
    </div>
    @endif
@endif
