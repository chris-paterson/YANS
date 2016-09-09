@extends('layouts.app')

@section('title')
    Purchase
@endsection

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form action="{{ route('posts.purchase.process', ['id' => $post->id]) }}" method="POST" id="payment-form">
                <span class="payment-errors"></span>
                
                {{ csrf_field() }}

                <div class="form-row">
                    <label>
                        <span>Card Number</span>
                        <input type="text" size="20" data-stripe="number">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Expiration (MM/YY)</span>
                        <input type="text" size="2" data-stripe="exp_month">
                    </label>
                    <span> / </span>
                    <input type="text" size="2" data-stripe="exp_year">
                </div>

                <div class="form-row">
                    <label>
                        <span>CVC</span>
                        <input type="text" size="4" data-stripe="cvc">
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span>Billing Zip</span>
                        <input type="text" size="6" data-stripe="address_zip">
                    </label>
                </div>

                <input type="submit" class="submit" value="Submit Payment">
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        Stripe.setPublishableKey('pk_test_tSwemV593zzExBuE2BnuiMUe');

        $(function() {
          var $form = $('#payment-form');
          $form.submit(function(event) {
            // Disable the submit button to prevent repeated clicks:
            $form.find('.submit').prop('disabled', true);

            // Request a token from Stripe:
            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from being submitted:
            return false;
          });
        });

        function stripeResponseHandler(status, response) {
          // Grab the form:
          var $form = $('#payment-form');

          if (response.error) { // Problem!

            // Show the errors on the form:
            $form.find('.payment-errors').text(response.error.message);
            $form.find('.submit').prop('disabled', false); // Re-enable submission

          } else { // Token was created!

            // Get the token ID:
            var token = response.id;

            // Insert the token ID into the form so it gets submitted to the server:
            $form.append($('<input type="hidden" name="stripeToken">').val(token));

            // Submit the form:
            $form.get(0).submit();
          }
        };
    </script>
@endsection