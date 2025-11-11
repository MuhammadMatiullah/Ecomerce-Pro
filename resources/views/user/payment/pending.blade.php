@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow-lg border-0 rounded-3 p-4">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="bi bi-hourglass-split text-warning display-3"></i>
                    </div>
                    <h3 class="text-warning mb-3">Payment Processing</h3>
                    <p class="text-muted mb-4">
                        Your payment is currently being processed. Please wait a few minutes.
                        If it doesn’t complete automatically, you can try again.
                    </p>
                    <a href="{{ route('payment.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left-circle"></i> Go Back to Payment Page
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
