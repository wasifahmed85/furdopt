<x-mail::message>
    # Pet Promotion Successful!

    Dear {{ $user->name ?? 'User' }},

    Your payment for promoting **{{ $petName }}** has been successfully processed!

    **Amount Paid:** ${{ $amount }}
    **Promotion Active Until:** {{ $promotedUntil }}

    Your pet will now receive increased visibility on our platform until the specified date.

    Thank you for choosing our service!

    <x-mail::button :url="route('f.dashboard')">
        View Your Dashboard
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
