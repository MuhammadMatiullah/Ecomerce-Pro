@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow-lg border-0 rounded-3 p-4">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-x-circle text-danger display-3"></i>
                    </div>
                    <h3 class="text-danger mb-3">Payment Failed</h3>
                    <p class="text-muted mb-4">
                        Unfortunately, your payment was not successful. Please check your card details
                        or try another payment method.
                    </p>
                    <a href="{{ route('payment.index') }}" class="btn btn-outline-danger">
                        <i class="bi bi-arrow-left-circle"></i> Try Again
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
