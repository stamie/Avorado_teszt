
    <!-- Admin user Begin -->
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
            <div>{{ __('Munkák kezelése') }}</div>
            <div class="ms-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('works.index')">
            {{ __('Munkák listázása') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('works.create')">
            {{ __('Munka létrehozása') }}
        </x-dropdown-link>
    </x-slot>
</x-dropdown>
<!-- Admin user End   -->
<!-- Carrier user Begin -->
<!-- Carrier user End   -->
