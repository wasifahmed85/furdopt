<div>
    <h2>Your Cart</h2>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Pet</th>
                <th>Promotion Type</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->pet->name ?? 'N/A' }}</td>
                    <td>{{ $item->promotion_type }}</td>
                    <td>${{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price * $item->quantity }}</td>
                    <td>
                        <button wire:click="removeItem({{ $item->id }})"
                            class="bg-red-500 text-white px-2 py-1">Remove</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <h3>Total: ${{ $total }}</h3>
        <button wire:click="checkout" class="bg-green-500 text-white px-4 py-2">Checkout</button>
    </div>
</div>
