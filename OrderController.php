<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // FOR TESTING: Simulate Admin if unthenticated
        if (!$user) {
            $user = new \stdClass();
            $user->role = 1; // Simulate Admin
            $user->id = 1;
        }

        if ($user->role == 1) {
            // Admin: All orders with search
            if ($request->has('search')) {
                $search = $request->get('search');
 
                $orders = DB::select("SELECT * FROM orders WHERE id = '$search' OR total_amount LIKE '%$search%'");
            } else {
                $orders = Order::with('user')->latest('ordered_date')->get();
            }
            return view('admin.orders.index', compact('orders'));
        } else {
            // Customer: Dashboard (Recent Orders + Stats)
            $orders = Order::where('user_id', $user->id)->latest('ordered_date')->get();
            $totalOrders = $orders->count();
            $totalSpent = $orders->sum('total_amount');
            $recentOrders = $orders->take(5);
            return view('customer.dashboard', compact('totalOrders', 'totalSpent', 'recentOrders'));
        }
    }

    /**
     * 🔴 VULNERABLE SHOW METHOD (Order Items)
     */
    public function show($id)
    {
        // Vulnerable implementation for Order Items
        // This allows injection into the order_items table via the ID parameter if it's not strictly integer-checked by routing (it's not).
        $order = Order::findOrFail($id); // Keep this to get the order details securely or insecurely? securely for the header.
        
       
        $orderItems = DB::select("SELECT * FROM order_items WHERE order_id = $id");
        
        return view('admin.orders.show', compact('order', 'orderItems'));
    }

    public function myOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->latest('ordered_date')->get();
        $totalOrders = $orders->count();
        return view('customer.orders', compact('orders', 'totalOrders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Checkout logic (from Cart)
        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        $totalAmount = 0;
        foreach($cart as $id => $details) {
            $totalAmount += $details['price'] * $details['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'ordered_date' => now(),
        ]);

        foreach($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }
        
        // Clear cart
        session()->forget('cart');

        return redirect()->route('dashboard')->with('success', 'Order placed successfully!');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        // Admin updates status
        if (Auth::user()->role == 1) {
            $request->validate([
                'status' => 'required|in:pending,cancelled,completed'
            ]);
            $order->update(['status' => $request->status]);
            return redirect()->back()->with('success', 'Order status updated.');
        } 
        
        // Customer updates details (Address/Phone) if Pending
        if (Auth::user()->id == $order->user_id && $order->status == 'pending') {
            $request->validate([
                'delivery_address' => 'required|string',
                'phone' => 'required|regex:/^0[0-9]{9}$/',
            ]);
            
            $user = Auth::user();
            $user->update([
                'address' => $request->delivery_address, 
                'phone' => $request->phone
            ]);
            
            return redirect()->back()->with('success', 'Order details updated.');
        }

        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Ensure the order belongs to the authenticated user
        if (Auth::id() !== $order->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        // Ensure the order status is pending
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'You cannot delete an order that is not pending.');
        }

        // Delete order items
        DB::table('order_items')->where('order_id', $order->id)->delete();

        // Delete the order
        $order->delete();

        return redirect()->route('dashboard')->with('success', 'Order deleted successfully.');
    }
}
