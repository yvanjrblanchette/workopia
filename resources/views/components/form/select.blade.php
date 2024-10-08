@props(['id', 'name', 'options' => [], 'label' => null, 'className' => '', 'value' => '', 'required' => false])

<div class="{{ $className }}">
    <div class="flex items-center gap-2">
        @if ($label)
            <label class="block text-gray-700" for="{{ $id }}">
                {{ $label }}
                @if ($required)
                    <span class="text-red-600 text-sm"> *</span>
                @endif
            </label>
        @endif

        @error($name)
            <p class="text-red-600 text-xs animate-pulse flex items-center gap-1"><i class="fas fa-exclamation-circle"></i>
                {{ $message }}</p>
        @enderror
    </div>
    <select id="{{ $id }}" name="{{ $name }}"
        class="w-full px-4 py-2 border rounded bg-gray-50 focus:outline-none @error($name) border-red-600 border-dashed @enderror"
        {{ $required ? 'required' : '' }}>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
</div>
