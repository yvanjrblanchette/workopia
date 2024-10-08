@props(['className'])

<div x-data="{}" class="mb-3">
    <button class="btn btn-primary scroll-lock {{$className}}" @click="$dispatch('modal-ex')">
        {{ $slot }}
    </button>
</div>