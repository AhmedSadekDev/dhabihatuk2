<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($status)
    {
        $orders = Order::where('status', $status)->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function detials($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.detials', compact('order'));
    }
    public function changeStatus(Request $request) {
        $order = Order::find($request->order_id);
        $order->update([
            'status' => $request->status,
        ]);
        return back()->with('message', __('messages.changeStatus'));
    }
    public function cancel(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->update([
            'status' => 3,
            'deleteReason' => $request->desc_ar
        ]);
        return back()->with('message', __('messages.CancelOrder'));
    }
}
