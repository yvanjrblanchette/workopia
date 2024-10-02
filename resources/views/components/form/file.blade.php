@props(['id', 'name', 'label' => null, 'className' => ''])

<div class="{{ $className }}">
    <div class="flex items-center gap-2">
      @if($label)
      <label class="block text-gray-700" for="company_logo">{{ $label }}</label>
      @endif
      @error($name)
        <p class="text-red-600 text-xs animate-pulse flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
      @enderror
    </div>
      <input
          id="{{$id}}"
          type="file"
          name="{{$name}}"
          class="w-full px-4 py-2 border rounded bg-gray-50 focus:outline-none cursor-pointer @error($name) border-red-600 border-dashed @enderror"
      />
  </div>