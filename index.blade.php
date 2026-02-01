<x-public-layout>
    <div class="py-16 bg-soft-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header removed to be handled dynamically in the Livewire component --}}

            {{-- 
                Livewire Volt Component: 
                This handles real-time searching and dynamic product grid rendering.
                It uses Laravel Livewire to provide a smooth, app-like experience.
            --}}
            <livewire:product-search />
        </div>
    </div>
</x-public-layout>

