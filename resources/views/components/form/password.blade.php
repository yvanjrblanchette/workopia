@props(['id', 'name', 'value' => '', 'label' => null, 'className' => '', 'placeholder' => '', 'required' => false])

<div x-data="{ show: false }" class="{{ $className }}">
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
            <p class="text-red-600 text-xs animate-pulse flex items-center gap-1">
                <i class="fas fa-exclamation-circle"></i> {{ $message }}
            </p>
        @enderror
    </div>
    <div class="relative">
        <input id="{{ $id }}" :type="show ? 'text' : 'password'" name="{{ $name }}"
            class="w-full px-4 py-2 border rounded bg-gray-50 focus:outline-none @error($name) border-red-600 border-dashed @enderror"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" autocomplete="true"
            {{ $required ? 'required' : '' }} />
        <button type="button"
            class="text-xl text-gray-500 hover:text-gray-600 absolute right-4 top-1/2 -translate-y-1/2"
            @click="show = !show">
            <i :class="show ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
        </button>
    </div>
</div>
