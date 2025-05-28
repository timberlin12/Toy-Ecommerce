<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;

class RazorpayPaymentController extends Controller
{
    public function payment()
    {
        return view('payment'); 
    }

    public function success(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        // dd($input);
        $attributes = [
            'razorpay_order_id' => $input['razorpay_order_id'],
            'razorpay_payment_id' => $input['razorpay_payment_id'],
            'razorpay_signature' => $input['razorpay_signature']
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);

            // Update order status to paid
            $order = Order::where('order_number', $input['razorpay_order_id'])->first();
            dd($attributes);
            if ($order) {
                $order->payment_status = 'paid';
                $order->save();
            }

            session()->forget('cart');
            session()->forget('coupon');

            return redirect()->route('home')->with('success', 'Payment successful');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Payment verification failed!');
        }
    }



    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Payment cancelled');
    }

    public function createOrder($id)
    {
        // dd($id);
        $order = Order::findOrFail($id);
        
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
        $orderData = [
            'receipt' => 'TS_' . time(),
            'amount' => $order->total_amount * 100, // amount in paise
            'currency' => 'INR'
        ];
        
        $razorpayOrder = $api->order->create($orderData);

        $data = [
            "order_id" => $razorpayOrder['id'],
            "amount" => $orderData['amount'],
            "key" => env('RAZORPAY_KEY'),
            "name" => auth()->user()->name,
            "email" => auth()->user()->email,
            "contact" => $order->phone,
            "description" => "Order #" . $order->order_number,
            "orderId" => $order->id,
        ];
        // dd($data);s
        return view('frontend.pages.payment', compact('data'));
    }

}
