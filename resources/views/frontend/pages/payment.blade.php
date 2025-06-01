<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    @import url('https://fonts.googleapis.com/css?family=Lexend+Deca&display=swap');

    body,
    html,
    button,
    input {
        font-family: Lexend Deca, sans-serif;
        color: #eee;
    }

    body,
    html {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background: rgb(209, 209, 240);
    }

    .checkout-loading {
        overflow: hidden;
        /* text-align: center; */
        width: 400px;
        height: 400px;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        background: #232329;
        border-radius: 12px;
        box-shadow: 0px 4px 13px rgba(0, 0, 0, .2), 0px 3px 3px rgba(0, 0, 0, .3);
    }

    .checkout-head {
        overflow: hidden;
        line-height: 50px;
        width: 100%;
        font-size: 24px;
        box-sizing: border-box;
        height: 110px;
        text-align: right;
        padding: 30px;
        background: linear-gradient(to right, #DA4453, #f80759);
    }

    .shopping-icon {
        height: 170px;
        margin-top: -60px;
        margin-left: -50px;
        transform: rotate(-25deg);
        float: left;
    }

    .price {
        width: 100%;
        height: 30px;
        font-size: 16px;
        line-height: 30px;
        color: rgba(255, 255, 255, .25);
    }

    .payment-method {
        width: 100%;
        height: 50px;
        font-size: 18px;
        border: none;
        background: rgba(255, 255, 255, .05);
        transition: .1s ease;
    }

    .payment-method:hover {
        cursor: pointer;
        background: rgba(255, 255, 255, .1);
    }

    .payment-method:focus {
        outline: none;
    }




    .modal-confirm {
        color: #636363;
        width: 400px;
    }

    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }

    .modal-confirm .modal-header {
        border-bottom: none;
        position: relative;
    }

    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }

    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }

    .modal-confirm .modal-body {
        color: #999;
    }

    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }

    .modal-confirm .modal-footer a {
        color: #999;
    }

    .modal-confirm .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }

    .modal-confirm .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }

    .modal-confirm .btn,
    .modal-confirm .btn:active {
        color: #fff;
        border-radius: 4px;
        background: #60c7c1;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        min-width: 120px;
        border: none;
        min-height: 40px;
        border-radius: 3px;
        margin: 0 5px;
    }

    .modal-confirm .btn-secondary {
        background: #c1c1c1;
    }

    .modal-confirm .btn-secondary:hover,
    .modal-confirm .btn-secondary:focus {
        background: #a8a8a8;
    }

    .modal-confirm .btn-danger {
        background: #f15e5e;
    }

    .modal-confirm .btn-danger:hover,
    .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }

    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }
</style>


<div class="checkout-loading">
    <div class="checkout-head">
        <svg class="shopping-icon" viewBox="0 0 24 24">
            <path fill="#ffffff55" d="M17,18A2,2 0 0,1 19,20A2,2 0 0,1 17,22C15.89,22 15,21.1 15,20C15,18.89 15.89,18 17,18M1,2H4.27L5.21,4H20A1,1 0 0,1 21,5C21,5.17 20.95,5.34 20.88,5.5L17.3,11.97C16.96,12.58 16.3,13 15.55,13H8.1L7.2,14.63L7.17,14.75A0.25,0.25 0 0,0 7.42,15H19V17H7C5.89,17 5,16.1 5,15C5,14.65 5.09,14.32 5.24,14.04L6.6,11.59L3,4H1V2M7,18A2,2 0 0,1 9,20A2,2 0 0,1 7,22C5.89,22 5,21.1 5,20C5,18.89 5.89,18 7,18M16,11L18.78,6H6.14L8.5,11H16Z" />
        </svg>
        Checkout
    </div>
    <center>
        <div class="price">
            <p style="font-size: large;">{{ $data['description'] }}</p>
        </div>
    </center>
    <br>
    <div class="price" style="padding-left: 15px;">Order Amount: ₹{{ number_format($data['amount'] / 100, 2) }}</div>
    <div class="price" style="padding-left: 15px;">Customer: {{ $data['name'] }}</div>
    <div class="price" style="padding-left: 15px;">Email: {{ $data['email'] }}</div>
    <br>

    <form action="{{ route('payment.success') }}" method="POST" class="text-center" style="margin-bottom: 5px;">
        @csrf
        <input type="hidden" name="order_id" value="{{ $data['orderId'] }}">

        <!-- Razorpay Button -->
        <button type="button" id="rzp-button" class="payment-method">
            Pay with Razorpay
        </button>
    </form>

    <a href="#myModal" class="trigger-btn" data-toggle="modal" style="width: 100%; margin: 0;"><button class="payment-method">
            Cancle Payment
        </button></a>
</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Do you really want to cancel your order?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="{{ route('payment.cancel', ['razorpay_order_id' => $data['order_id'] ]) }}"><button type="button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

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
        "handler": function(response) {
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