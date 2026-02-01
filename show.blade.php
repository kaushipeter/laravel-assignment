<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }} Details</h2>
                    <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-900">Back to List</a>
                </div>

                <div class="mb-8 grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Order Info</h3>
                        <p><strong>Date:</strong> {{ $order->ordered_date }}</p>
                        <p><strong>Status:</strong> <span class="uppercase font-bold">{{ $order->status }}</span></p>
                        <p><strong>Total:</strong> LKR {{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-700 mb-4">Order Items (Vulnerable Fetch)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orderItems as $item)
                            <tr>
                                <td class="px-6 py-4">{{ $item->id }}</td>
                                <td class="px-6 py-4">{{ $item->product_id }}</td>
                                <td class="px-6 py-4">{{ $item->quantity }}</td>
                                <td class="px-6 py-4">LKR {{ number_format($item->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
