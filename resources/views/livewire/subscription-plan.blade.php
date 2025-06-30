<div>
    <ul>
        @foreach ($subscriptionsplans as $plan)
            <li wire:click="processPayment({{ $plan->id }})">{{ $plan->name }}</li>
            <form action="{{ route('checkout') }}" method="post">
                @csrf

                <input type="text" name="plan_id" value="{{ $plan->id }}">
                <input type="text" name="payment_method" value="stripe">
                <button type="submit">Checkout</button>
            </form>
        @endforeach

    </ul>
</div>
