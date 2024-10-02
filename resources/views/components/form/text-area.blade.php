@props(['id', 'name', 'value' => '', 'label' => null, 'className' => '', 'placeholder' => '', 'rows' => 7, 'cols' => 30, 'required' => false])

<div class="{{ $className }}">
    <div class="flex items-center gap-2">
        @if($label)
      <label class="block text-gray-700" for="{{$name}}">
        {{ $label }}
        @if($required)
         <span class="text-red-600 text-sm"> *</span>
        @endif
      </label>
        @endif
      @error($name)
        <p class="text-red-600 text-xs animate-pulse flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
      @enderror
    </div>
    <textarea cols="{{ $cols }}" rows="{{ $rows }}" id="{{$id}}" name="{{$name}}" class="w-full px-4 py-2 border bg-gray-50 rounded focus:outline-none @error($name) border-red-600 border-dashed @enderror" placeholder="{{ $placeholder }}">{{old($name, $value)}}</textarea>
    
</div>