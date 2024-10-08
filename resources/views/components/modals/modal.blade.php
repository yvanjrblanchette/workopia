@props(['buttonClass', 'buttonLabel', 'buttonIcon'])
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


<div x-data="{ modelOpen: false }" x-init="$watch('modelOpen', value => document.body.classList.toggle('overflow-hidden', value))">
    <button @click="modelOpen = !modelOpen" class="mx-auto flex items-center justify-center gap-2 rounded-full px-8 py-2 tracking-wide text-white capitalize focus:outline-none {{ $buttonClass }}">
        <i class="{{ $buttonIcon }}"></i>
        {{ $buttonLabel }}
    </button>

    <div x-cloak x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            {{-- Modal overlay --}}
            <div x-cloak @click="modelOpen = false" x-show="modelOpen" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-black bg-opacity-60 backdrop-blur" aria-hidden="true"
            ></div>

            {{-- Modal content --}}
            <div x-cloak x-show="modelOpen" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                >
                {{-- Modal close button --}}
                <button @click="modelOpen = false" class="absolute top-2 right-2 p-2 text-gray-600 focus:outline-none hover:text-gray-700">
                  <i class="fa-solid fa-xmark text-2xl"></i>
                </button>
                <div>
                  {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
