@props(['icon' => null, 'url' => '#', 'className' => ''])

<a href="{{$url}}" class="{{$className}}">
    @if($icon)
        <i class="{{$icon}}"></i>
    @endif
    {{$slot}}
</a>