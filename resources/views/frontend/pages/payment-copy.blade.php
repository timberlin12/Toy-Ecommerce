@extends('frontend.layouts.master')

@section('main-content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8">
        <!-- Header -->
        {{-- @dd($data); --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Complete Your Payment</h2>
            <p class="mt-2 text-sm text-gray-600">{{ $data['description'] }}</p>
        </div>

        <!-- Order Summary -->
        <div class="border-t border-b border-gray-200 py-4 mb-6">
            <div class="flex justify-between text-gray-700">
                <span class="font-medium">Order Amount:</span>
                <span>₹{{ number_format($data['amount'] / 100, 2) }}</span>
            </div>
            <div class="flex justify-between text-gray-700 mt-2">
                <span class="font-medium">Customer:</span>
                <span>{{ $data['name'] }}</span>
            </div>
            <div class="flex justify-between text-gray-700 mt-2">
                <span class="font-medium">Email:</span>
                <span>{{ $data['email'] }}</span>
            </div>
        </div>

        <!-- Payment Form -->
        <form action="{{ route('payment.success') }}" method="POST" class="text-center">
            @csrf
            <input type="hidden" name="order_id" value="{{ $data['orderId'] }}">

            <!-- Razorpay Button -->
            <button type="button" id="rzp-button" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700 transition duration-300">
                Pay with Razorpay
            </button>
        </form>

        <!-- Razorpay Script -->
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            var options = {
                "key": "{{ $data['key'] }}",
                "amount": "{{ $data['amount'] }}",
                "currency": "INR",
                "name": "One Toys",
                "description": "{{ $data['description'] }}",
                "image": "{{ asset('logo.png') }}",
                "order_id": "{{ $data['order_id'] }}",
                "prefill": {
                    "name": "{{ $data['name'] }}",
                    "email": "{{ $data['email'] }}",
                    "contact": "{{ $data['contact'] }}"
                },
                "handler": function (response) {
                    // Automatically submit the form with payment details
                    var form = document.querySelector('form');
                    var inputPaymentId = document.createElement('input');
                    inputPaymentId.type = 'hidden';
                    inputPaymentId.name = 'razorpay_payment_id';
                    inputPaymentId.value = response.razorpay_payment_id;
                    form.appendChild(inputPaymentId);

                    var inputOrderId = document.createElement('input');
                    inputOrderId.type = 'hidden';
                    inputOrderId.name = 'razorpay_order_id';
                    inputOrderId.value = response.razorpay_order_id;
                    form.appendChild(inputOrderId);

                    var inputSignature = document.createElement('input');
                    inputSignature.type = 'hidden';
                    inputSignature.name = 'razorpay_signature';
                    inputSignature.value = response.razorpay_signature;
                    form.appendChild(inputSignature);

                    form.submit();
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            document.getElementById('rzp-button').onclick = function(e) {
                rzp1.open();
                e.preventDefault();
            };
        </script>
    </div>
</div>
@endsection