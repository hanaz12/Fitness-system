{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="{{url('css/payment.css')}}">
</head>
<body>

    <div class="modal">
        <form class="form" action="{{ route('payment.store') }}" method="POST">
            @csrf
      <div class="payment--options">
        <input type="hidden" name="trainee_id" value="{{ $trainee->id }}">
        <input type="hidden" name="package_price" value="{{ $package->price }}">

        <input type="radio" id="paybal" name="method" value="paybal" class="radio">
        <label for="paybal"></label>

        </label>
      </div>
      <div class="separator">
        <hr class="line">
        <p>or pay using credit card</p>
        <hr class="line">
      </div>
      <div class="credit-card-info--form">
        <div class="input_container">
          <label for="password_field" class="input_label">Card Number</label>
          <input id="password_field" class="input_field" type="number" name="input-name" title="Inpit title" placeholder="0000 0000 0000 0000">
        </div>
        <div class="input_container">
          <label for="password_field" class="input_label">Expiry Date / CVV</label>
          <div class="split">
          <input id="password_field" class="input_field" type="date" name="input-name" title="Expiry Date" placeholder="01/23">
          <input id="password_field" class="input_field" type="number" name="cvv" title="CVV" placeholder="CVV">
        </div>
        </div>
      </div>
        <button class="purchase--btn">Checkout</button>
    </form>
    </div>


            </body>
            </html>

 --}}
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="{{url('css/payment.css')}}">
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <div class="modal">
        <form class="form" action="{{ route('payment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="trainee_id" value="{{ $trainee->id }}">
            <input type="hidden" id="payment-method" name="method" value="credit_card">
            <input type="hidden" id="amount" name="amount" value="{{ $package->price }}">
            <input type="hidden" id="amount" name="package_id" value="{{ $package->id }}">

            <!-- PayPal Button -->
            <button type="button" class="btn-paypal"  onclick="document.getElementById('payment-method').value = 'paypal';"></button>

            <div class="separator">
                <hr class="line">
                <p>or pay using credit card</p>
                <hr class="line">
            </div>

            <!-- Credit Card Info Form (Initially visible) -->
            <div id="credit-card-info">
                <div class="credit-card-info--form">
                    <div class="input_container">
                        <label for="card_number" class="input_label">Card Number</label>
                        <input id="card_number" class="input_field" type="number" name="payNumber" title="Card Number" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="input_container">
                        <label for="expiry_date" class="input_label">Expiry Date / CVV</label>
                        <div class="split">
                            <input id="expiry_date" class="input_field" type="date" name="expiry_date" title="Expiry Date" placeholder="01/23">
                            <input id="cvv" class="input_field" type="number" name="cvv" title="CVV" placeholder="CVV">
                        </div>
                    </div>
                </div>
            </div>

            <button class="purchase--btn">Checkout</button>
        </form>
    </div>

</body>
</html>
