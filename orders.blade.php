<x-customer-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <h2 class="text-2xl font-bold mb-6">All Orders ({{ $totalOrders }})</h2>

            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">
                     <!-- Header -->
                    <div class="flex justify-between items-center mb-4 border-b pb-2">
                        <div>
                             <span class="text-lg font-bold">Order #{{ $order->id }}</span>
                             <span class="ml-4 px-2 py-0.5 text-sm rounded bg-gray-100 text-gray-800">
                                {{ ucfirst($order->status) }}
                             </span>
                        </div>
                        <div class="text-gray-500 text-sm">
                            Order Date: {{ $order->ordered_date->format('d M Y, h:i A') }}
                        </div>
                    </div>
                    
                    <!-- Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold">Customer Details:</p>
                            <p>Name: {{ $order->user->name }}</p>
                            <p>Email: {{ $order->user->email }}</p>
                            <!-- Note: User object has Phone and Address. But we allow editing below if pending -->
                            <p>Phone: {{ $order->user->phone }}</p>
                            <p>Delivery Address: {{ $order->user->address }}</p>
                        </div>
                        <div class="text-right">
                             <p class="text-lg font-bold mt-4">Total: LKR {{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>

                    <!-- Edit Form (Only if Pending) -->
                    @if($order->status == 'pending')
                    <div class="mt-6 border-t pt-4">
                        <h4 class="font-medium mb-3 text-yellow-700">Update Delivery Details</h4>
                        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @csrf
                            @method('PUT')
                             <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" name="phone" value="{{ $order->user->phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            </div>
                            <div>
                                <label for="delivery_address" class="block text-sm font-medium text-gray-700">Delivery Address</label>
                                <input type="text" name="delivery_address" value="{{ $order->user->address }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            </div>
                            <div class="md:col-span-2 text-right flex justify-between items-center">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update Details</button>
                            </div>
                        </form>
                         <div class="mt-4 flex justify-end">
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete Order</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="mt-6 border-t pt-4">
                        <p class="text-sm text-gray-500 italic">The shop will be placing your order, can't delete the order now.</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-customer-layout>
