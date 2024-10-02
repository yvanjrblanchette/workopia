@props(['id', 'name', 'value' => '', 'label' => null, 'type' => 'text', 'className' => '', 'placeholder' => '', 'required' => false])

<div class="{{ $className }}">
    <div class="flex items-center gap-2">
        @if($label)
            <label class="block text-gray-700" for="{{ $name }}">
                {{ $label }}
                @if($required)
                    <span class="text-red-600 text-sm"> *</span>
                @endif
            </label>
        @endif
        @error($name)
            <p class="text-red-600 text-xs animate-pulse flex items-center gap-1">
                <i class="fas fa-exclamation-circle"></i> {{ $message }}
            </p>
        @enderror
    </div>
    <input
        id="{{ $id }}"
        type="{{ $type }}"
        name="{{ $name }}"
        class="w-full px-4 py-2 border rounded bg-gray-50 focus:outline-none @error($name) border-red-600 border-dashed @enderror"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
    />
</div>
