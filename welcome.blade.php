<x-public-layout>
    <!-- Hero Section -->
    <div class="relative bg-charcoal-900 h-[500px] overflow-hidden">
        <img src="{{ asset('images/hero.jpg') }}" alt="Hero" class="w-full h-full object-cover opacity-50 scale-105"> 
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white p-4 bg-black/40">
            <h1 class="text-5xl md:text-6xl font-serif font-black tracking-tighter mb-4 text-gold-100 drop-shadow-[0_10px_10px_rgba(0,0,0,0.8)]">AURA</h1>
            <h2 class="text-4xl md:text-5xl font-bold tracking-widest mb-6 text-gold-400 drop-shadow-md">Essence of Elegance</h2>
            <p class="text-xl md:text-2xl mb-10 font-bold text-gray-100 max-w-2xl drop-shadow-sm">Discover our exclusive collection of hand-crafted perfumes</p>
            <a href="{{ route('shop') }}" class="bg-gold-500 text-charcoal-900 px-12 py-5 uppercase tracking-[0.2em] font-black hover:bg-white hover:text-charcoal-900 transition duration-500 transform hover:scale-110 shadow-2xl border-2 border-gold-400 rounded-full">
                Shop Collection
            </a>
        </div>
    </div>

    <!-- Featured Collections -->
    <div class="py-24 bg-soft-white border-t border-gold-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-20">
                <h2 class="text-5xl md:text-6xl font-serif font-bold text-gold-600 mt-4 mb-8">Featured Collections</h2>
                <div class="w-32 h-1.5 bg-gold-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach($featuredProducts as $product)
                <div class="group relative cursor-pointer">
                    {{-- Main card link --}}
                    <a href="{{ route('shop.show', $product->id) }}" class="absolute inset-0 z-10"></a>
                    
                    <div class="relative overflow-hidden aspect-[3/4] mb-4 shadow-lg rounded-lg">
                        <img src="{{ Str::startsWith($product->image, 'products/') ? asset('storage/' . $product->image) : asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        
                        {{-- Overlay with View Details Button (Always Visible) --}}
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                             <a href="{{ route('shop.show', $product->id) }}" class="pointer-events-auto relative z-20 bg-white text-charcoal-900 px-6 py-3 uppercase tracking-widest text-sm font-bold hover:bg-gold-500 hover:text-white transition rounded-full shadow-lg">
                                View Details
                            </a>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-serif text-charcoal-900 group-hover:text-gold-600 transition">{{ $product->name }}</h3>
                        <p class="text-gold-600 font-bold mt-1 text-base">LKR {{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-public-layout>

