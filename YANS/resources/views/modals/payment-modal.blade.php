<div class="modal fade preview-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Purchase</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <form action="{{ route('posts.purchase.process', ['id' => $post->id]) }}" method="POST" id="payment-form">
                            <span class="payment-errors"></span>
                            
                            {{ csrf_field() }}
                            
                            <div class='form-row'>
                                <div class='col-xs-12 form-group card required'>
                                    <label class='control-label'>Card Number</label>
                                    <input autocomplete="off" data-stripe="number" class="form-control card-number" size="20" type="text">
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='col-xs-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label>
                                    <input autocomplete="off" class="form-control card-cvc"  size="4" type="text" data-stripe="cvc">
                                </div>
                                <div class='col-xs-4 form-group expiration required'>
                                    <label class='control-label'>Expiration</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' data-stripe="exp_month">
                                </div>
                                <div class='col-xs-4 form-group expiration required'>
                                    <label class='control-label'> </label>
                                    <input class='form-control card-expiry-year' placeholder='YY' size='2' type='text' data-stripe="exp_year">
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='col-md-12'>
                                    <div class='form-control total btn btn-info'>
                                        Total:
                                        <span class='amount'> ${{ $post->price }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='col-md-12 form-group'>
                                    <button class='form-control btn btn-default submit-button' style="margin-top: 16px;" type='submit'>Pay</button>
                                </div>
                            </div>
                            <div class='form-row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>
                                        Please correct the errors and try again.
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

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