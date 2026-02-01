<x-public-layout>
    <div class="py-16 bg-soft-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-5xl md:text-6xl font-serif font-bold mb-10 text-charcoal-900 border-b border-gold-200 pb-4">Shopping Cart</h1>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="bg-white shadow-xl overflow-hidden sm:rounded-none border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gold-500 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Product</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Price</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Subtotal</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}" class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-16 shadow-md border border-gray-100">
                                                <img class="h-16 w-16 object-cover" src="{{ Str::startsWith($details['image'], 'products/') ? asset('storage/' . $details['image']) : asset('images/' . $details['image']) }}" alt="{{ $details['name'] }}">
                                            </div>
                                            <div class="ml-6">
                                                <div class="text-lg font-serif font-medium text-charcoal-900">{{ $details['name'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-700">LKR {{ number_format($details['price'], 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="number" value="{{ $details['quantity'] }}" class="w-16 border-gray-300 focus:border-gold-500 focus:ring-gold-500 rounded-none text-center update-cart" min="1">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gold-600">LKR {{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                         <form action="{{ route('remove.from.cart') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="text-gray-400 hover:text-red-600 transition duration-300 p-2 rounded-full hover:bg-red-50" title="Remove Item">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="p-8 bg-gray-50 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="text-2xl font-serif text-charcoal-900">Total: <span class="font-bold text-gold-600">LKR {{ number_format($total, 2) }}</span></div>
                        <div>
                            @auth
                                <form action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-gold-500 text-white px-10 py-4 hover:bg-charcoal-900 hover:text-white font-bold uppercase tracking-widest transition duration-300 shadow-lg">
                                        Proceed to Checkout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="bg-gray-800 text-white px-10 py-4 hover:bg-gold-500 hover:text-white font-bold uppercase tracking-widest transition duration-300 shadow-lg inline-block">
                                    Login to Checkout
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-24 bg-white shadow-lg border border-gray-100">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <p class="text-charcoal-900 text-xl font-serif mb-6">Your shopping cart is currently empty.</p>
                    <a href="{{ route('shop') }}" class="inline-block bg-gold-500 text-white px-8 py-3 uppercase tracking-widest font-bold hover:bg-charcoal-900 transition duration-300 shadow-md">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Script to update cart via AJAX or simple reload logic (optional but better UX) -->
    <script>
        // Simple script to handle 'update-cart' logic could be added here
        // For simplicity, assumed button or 'change' event submits or we rely on page refreshes for quantity?
        // Current 'update-cart' input doesn't trigger anything. I'll add simple JS.
        document.querySelectorAll('.update-cart').forEach(input => {
            input.addEventListener('change', function() {
                const id = this.closest('tr').getAttribute('data-id');
                const quantity = this.value;
                
                fetch('{{ route('update.cart') }}', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: id, quantity: quantity })
                }).then(response => window.location.reload());
            });
        });
    </script>
</x-public-layout>
