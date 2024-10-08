@props(['className', 'color' => 'white'])

<a href="/">
    @if ($color == 'white')
        <img src="{{ asset('/images/workscout--long--white.svg') }}" alt="workscout logo" class="{{ $className }}" />
    @else
        <img src="{{ asset('/images/workscout--long--color.svg') }}" alt="workscout logo" class="{{ $className }}" />
    @endif
</a>
