@extends('layout')

@section('content')
<div class="w3-container w3-light-grey" style="padding:128px 16px">
  <h3 class="w3-center">Confirm Payment</h3>

  @if (session()->has('success'))
    <p><strong>{{ session()->get('success') }}</strong></p>
  @endif

  <form method="POST" action="{{ route('checkout.credit-card') }}" id="payment-form">
    @csrf

    <h4>Enter your credit card information</h4>
    
    <p>Card Number:</p>
    <div id="card-number-element"></div>

    <p>Expiry date:</p>
    <div id="card-expiry-element"></div>

    <p>CVC:</p>
    <div id="card-cvc-element"></div>

    <!-- Used to display form errors -->
    <div id="card-errors"></div>

    <input type="hidden" name="plan" value="">
    <p><button class="w3-button w3-black" id="card-button" type="submit" data-secret="{{ $intent }}">Submit</button></p>
  </form>
</div>
@endsection

@section('js-asset')
    <!-- Always load Stripe.js from js.stripe.com to remain compliant. Do not include the script in a bundle or host it yourself -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var style = {
            base: {
                color: '#303238',
                fontSize: '16px',
                fontFamily: '"Open Sans", sans-serif',
                fontSmoothing: 'antialiased',
                '::placeholder': {
                    color: '#CFD7DF',
                },
            },
            invalid: {
                color: '#e5424d',
                ':focus': {
                    color: '#303238',
                },
            },
        };

        var stripe = Stripe('pk_test_51HPDInKqixIUBKnL9RnpGQffLAkLVDjwQG0j5Ii19Emq9gcs5LcPh2rew9sKaTneG2eSDE7vvzdBteNO3yUEbPQf00ABpeXPjK', { locale: 'en' }); // Create a Stripe client.
        var elements = stripe.elements(); // Create an instance of Elements.

        var cardNumberElement = elements.create('cardNumber', { style: style });
        cardNumberElement.mount('#card-number-element');
        var cardExpiryElement = elements.create('cardExpiry', { style: style });
        cardExpiryElement.mount('#card-expiry-element');
        var cardCvcElement = elements.create('cardCvc', { style: style });
        cardCvcElement.mount('#card-cvc-element');

        var cardButton = document.getElementById('card-button');
        var clientSecret = cardButton.dataset.secret;

        // Handle real-time validation errors from the card Element.
        cardNumberElement.addEventListener('change', function(event) {
            errorMessage(event);
        });

        cardExpiryElement.addEventListener('change', function(event) {
            errorMessage(event);
        });

        cardCvcElement.addEventListener('change', function(event) {
            errorMessage(event);
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Complete payment when the submit button is clicked
            payWithCard(stripe, cardNumberElement, clientSecret);
        });

        // Calls stripe.confirmCardPayment
        var payWithCard = function(stripe, card, clientSecret) {
            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card
                }
            })
            .then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    console.log('Error!');
                } else {
                    console.log(result);
                    form.submit();
                }
            });
        };

        // Handles error message
        var errorMessage = function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        };
    </script>
@endsection