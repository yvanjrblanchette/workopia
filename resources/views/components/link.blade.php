@props(['url' => '#', 'icon' => null, 'className' => '', 'label' => ''])
<a href={{ $url }} type="{{ $type }}"
    class="w-full bg-marine-700 hover:bg-pumpkin-550 transition text-white font-medium px-4 py-2 my-3 rounded-full focus:outline-none flex items-center gap-2 justify-center {{ $className }}">
    @if ($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $label }}
</a>
