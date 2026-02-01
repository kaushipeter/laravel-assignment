<x-public-layout>
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <!-- Image -->
                <div class="bg-gray-50 overflow-hidden shadow-2xl p-4">
                    <img src="{{ Str::startsWith($product->image, 'products/') ? asset('storage/' . $product->image) : asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover border border-gray-100">
                </div>

                <!-- Details -->
                <div class="flex flex-col justify-center">
                    <div class="mb-8">
                        <span class="text-gold-600 uppercase tracking-[0.3em] text-sm font-black">Exquisite Collection</span>
                        <h1 class="text-5xl md:text-6xl font-serif font-black text-charcoal-900 mt-4 mb-6 leading-tight">{{ $product->name }}</h1>
                        <p class="text-4xl font-black text-gold-600">LKR {{ number_format($product->price, 2) }}</p>
                    </div>
                    
                    <div class="prose prose-xl text-gray-700 mb-10 border-t-2 border-b-2 border-gold-100 py-8 leading-relaxed italic">
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('add.to.cart', $product->id) }}" class="inline-block bg-gold-500 text-white px-10 py-3 text-sm uppercase tracking-widest font-bold hover:bg-charcoal-900 hover:text-white transition duration-300 shadow-lg text-center rounded-sm">
                            Add to Cart
                        </a>
                    </div>
                    
                    <div class="mt-8 flex items-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center"><svg class="w-5 h-5 mr-2 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Authentic</div>
                        <div class="flex items-center"><svg class="w-5 h-5 mr-2 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Long Lasting</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
