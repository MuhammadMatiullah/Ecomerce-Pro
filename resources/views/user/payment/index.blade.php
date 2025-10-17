@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center">
          <h4>Online Payment</h4>
        </div>
        <div class="card-body">
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          <form method="POST" action="{{ route('payment.process') }}">
            @csrf

            <div class="mb-3">
              <label class="form-label">Card Holder Name</label>
              <input type="text" name="card_holder" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Card Number</label>
              <input type="text" name="card_number" maxlength="16" class="form-control" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Expiry Date</label>
                <input type="month" name="expiry" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">CVV</label>
                <input type="text" name="cvv" maxlength="4" class="form-control" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Amount</label>
              <input type="number" name="amount" class="form-control" value="1000" readonly>
            </div>

            <button type="submit" class="btn btn-success w-100">Pay Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
