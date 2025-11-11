<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Payment Meathod</th>
            <th>Description</th>
            <th>Comment</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        @foreach($order->products as $product)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $order->payment_method }}</td>
            <td>
                {{ Str::limit($product->description, 40) ?? 'N/A' }}
                @if(strlen($product->description) > 40)
                <button class="btn btn-link p-0 text-primary view-description-btn"
                    data-description="{{ $product->description }}">
                    View more
                </button>
                @endif
            </td>

            <td>
                {{ Str::limit($order->comment, 40) ?? 'N/A' }}
                @if(strlen($order->comment) > 40)
                <button class="btn btn-link p-0 text-primary view-comment-btn"
                    data-comment="{{ $order->comment }}">
                    View more
                </button>
                @endif
            </td>

            <td>{{ $product->pivot->quantity ?? 'N/A' }}</td>
            <td>Rs. {{ number_format($order->total, 2) }}</td>
            <td>{{ ucfirst($order->status) }}</td>
        </tr>
        @endforeach
        @endforeach
    </tbody>
</table>