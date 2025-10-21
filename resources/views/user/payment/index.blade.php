@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center">
          <h4>Stripe Payment</h4>
        </div>
        <div class="card-body">
          @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <form id="payment-form" method="POST" action="{{ route('payment.process') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Card Holder Name</label>
              <input type="text" name="card_holder" id="card-holder-name" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Card Details</label>
              <div id="card-element" class="form-control p-3"></div>
            </div>

            <input type="hidden" name="stripeToken" id="stripeToken">

            <div class="mb-3">
              <label class="form-label">Amount (USD)</label>
              <input type="number" name="amount" value="{{ $total }}" class="form-control" readonly>
            </div>


            <button id="card-button" class="btn btn-success w-100">Pay Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
  const stripe = Stripe("{{ config('services.stripe.key') }}");
  const elements = stripe.elements();
  const card = elements.create('card');
  card.mount('#card-element');

  const form = document.getElementById('payment-form');
  const cardHolderName = document.getElementById('card-holder-name');
  const stripeTokenInput = document.getElementById('stripeToken');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const {
      token,
      error
    } = await stripe.createToken(card, {
      name: cardHolderName.value
    });

    if (error) {
      alert(error.message);
      return;
    }

    stripeTokenInput.value = token.id;
    form.submit();
  });
</script>
@endsection