<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RazorpayPayment;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\Cart;

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

        $attributes = [
            'razorpay_order_id' => $input['razorpay_order_id'],
            'razorpay_payment_id' => $input['razorpay_payment_id'],
            'razorpay_signature' => $input['razorpay_signature']
        ];

        try {
            // Verify signature
            $api->utility->verifyPaymentSignature($attributes);

            // Find order by razorpay_order_id
            $order = Order::where('razorpay_order_id', $input['razorpay_order_id'])->first();

            if ($order) {
                // Update order payment status
                $order->payment_status = 'paid';
                $order->save();

                // Save payment details
                RazorpayPayment::create([
                    'order_id' => $order->id,
                    'razorpay_order_id' => $input['razorpay_order_id'],
                    'razorpay_payment_id' => $input['razorpay_payment_id'],
                    'razorpay_signature' => $input['razorpay_signature'],
                    'payment_status' => 'success',
                    'response_payload' => json_encode($input),
                ]);

                // Clear sessions
                session()->forget('cart');
                session()->forget('coupon');

                Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);

                return redirect()->route('user.order.index')->with('success', 'Payment successful');
            } else {
                return redirect()->route('cart')->with('error', 'Order not found!');
            }
        } catch (\Exception $e) {
            // Optional: log the error

            // Try to find and save failed payment
            if (isset($input['razorpay_order_id'])) {
                $order = Order::where('razorpay_order_id', $input['razorpay_order_id'])->first();
                if ($order) {
                    RazorpayPayment::create([
                        'order_id' => $order->id,
                        'razorpay_order_id' => $input['razorpay_order_id'],
                        'razorpay_payment_id' => $input['razorpay_payment_id'] ?? '',
                        'razorpay_signature' => $input['razorpay_signature'] ?? '',
                        'payment_status' => 'failed',
                        'response_payload' => json_encode($input),
                    ]);
                }
            }

            return redirect()->route('cart')->with('error', 'Payment verification failed!');
        }
    }



    public function cancel(Request $request)
    {
        // You can optionally pass the order ID via query params or session
        $razorpayOrderId = $request->input('razorpay_order_id');

        if ($razorpayOrderId) {
            $order = Order::where('razorpay_order_id', $razorpayOrderId)->first();

            if ($order) {
                // Update order status
                $order->payment_status = 'cancelled';
                $order->save();

                // Log the cancelled payment attempt
                RazorpayPayment::create([
                    'order_id' => $order->id,
                    'razorpay_order_id' => $razorpayOrderId,
                    'razorpay_payment_id' => null,
                    'razorpay_signature' => null,
                    'payment_status' => 'cancelled',
                    'response_payload' => json_encode([
                        'reason' => 'User cancelled payment'
                    ]),
                ]);
            }
        }

        return redirect()->route('cart')->with('error', 'Payment cancelled by user.');
    }


    public function createOrder($id)
    {
        // dd($id);
        $order = Order::findOrFail($id);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $orderData = [
            'receipt' => 'TS_' . time(),
            'amount' => (int)($order->total_amount * 100), // amount in paise
            'currency' => 'INR'
        ];

        $razorpayOrder = $api->order->create($orderData);

        $order->razorpay_order_id = $razorpayOrder['id'];
        $order->save();

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
