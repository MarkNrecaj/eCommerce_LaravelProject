@extends('layouts.app')
@section('extra-css')

    <!-- Styles -->
    <style>
        /**
        * The CSS shown here will not be introduced in the Quickstart guide, but shows
        * how you can use CSS to style your Element's container.
        */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            /*border: 1px solid gray;*/
            /*border-radius: 4px;*/
            /*background-color: white;*/

            display: block;
            width: 100%;
            height: calc(1.6em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

            /*box-shadow: 0 1px 3px 0 #e6ebf1;*/
            /*-webkit-transition: box-shadow 150ms ease;*/
            /*transition: box-shadow 150ms ease;*/
        }

        .StripeElement--focus {
            color: #495057;
            background-color: #fff;
            border-color: #a1cbef;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors{
            font-size: 80%;
            color: #e3342f;
        }

        /*.form-control::placeholder {*/
        /*    color: #6c757d;*/
        /*    opacity: 1;*/
        /*}*/
    </style>
@endsection


@section('extra-js')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        (function () {
            // Create a Stripe client.
            var stripe = Stripe('pk_test_51H0mlKK5oDGBuQ7KdvveET0SjGj3zPj0dPaaUafGmmyY2oyIM2DFUk1J3FJRXmnrWP6xjkxCSbLbopxuM2HsiEDo00lFidXQ4f');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                var options = {
                    name: document.getElementById('cardholder_name').value,
                    address_line1: document.getElementById('address').value,
                    address_city: document.getElementById('city').value,
                    address_state: document.getElementById('state').value
                }

                //Disable the submit button to prevent repeated clicks
                document.getElementById('complete-order').disabled = true;


                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;

                        // Enable the submit button
                        document.getElementById('complete-order').disabled = false;

                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        })();
    </script>
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Checkout</div>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">

                            <h3>Billing Details</h3>
                            <div class="card-body">
                                <form  id="payment-form" action="{{route('checkout.store')}}" method="POST">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name *') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name Lastname" required autocomplete="given-name">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address *') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="example@email.com" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State *') }}</label>

                                        <div class="col-md-6">
                                            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state"  value="{{ old('state') }}" placeholder="State" required autocomplete="state" >

                                            @error('state')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City *') }}</label>

                                        <div class="col-md-6">
                                            <input id="city" type="text" class="form-control @error('city') eshte jo valide @enderror" name="city"  value="{{ old('city') }}" placeholder="City" required autocomplete="city" >

                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control @error('address') eshte jo valide @enderror" name="address" placeholder="Street Address" value="{{ old('address') }}" autocomplete="off">

                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <h3>Payment Details</h3>

                                    <div class="form-group row">
                                        <label for="cardholder_name" class="col-md-4 col-form-label text-md-right">{{ __('Cardholder Name *') }}</label>

                                        <div class="col-md-6">
                                            <input id="cardholder_name" type="text" class="form-control @error('cardholder_name') is-invalid @enderror" name="cardholder_name"  placeholder="Cardholder Name" required autocomplete="off">

                                            @error('cardholder_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="card-element" class="col-md-4 col-form-label text-md-right">
                                            Credit or debit card *
                                        </label>
                                        <div class="col-md-6">
                                            <div id="card-element" >
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                        </div>


                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                    </div>


                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" id="complete-order" class="btn btn-primary">
                                                {{ __('Submit Payment') }}
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
