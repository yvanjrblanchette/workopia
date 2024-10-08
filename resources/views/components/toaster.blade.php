    {{-- Display toast message --}}
    @if (session('success'))
        <x-toast type="success" message="{{ session('success') }}" timeout="5000" />
    @elseif (session('error'))
        <x-toast type="error" message="{{ session('error') }}" timeout="5000" />
    @elseif (session('warning'))
        <x-toast type="warning" message="{{ session('warning') }}" timeout="5000" />
    @endif
