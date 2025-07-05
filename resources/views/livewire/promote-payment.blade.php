<div class="payment-container">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .payment-container {
            min-height: 100vh;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        @media (min-width: 640px) {
            .payment-container {
                padding: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .payment-container {
                padding: 2rem;
            }
        }

        .payment-card {
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            width: 100%;
            max-width: 40rem;
        }

        .card-header-gradient {
            background: rgb(25, 18, 80);
            padding: 1.5rem;
            color: #ffffff;
            text-align: center;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }

        .card-header-gradient h2 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            margin-top: 0;
            color: #f8f2f2e5;
        }

        .card-header-gradient p {
            font-size: 0.875rem;
            opacity: 0.9;
            margin: 0;
        }

        .card-body-content {
            padding: 1.5rem;
        }

        @media (min-width: 640px) {
            .card-body-content {
                padding: 2rem;
            }
        }

        .payment-details {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .payment-details p {
            color: #4b5563;
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
            margin-top: 0;
        }

        .payment-details .font-semibold {
            font-weight: 600;
        }

        .payment-amount {
            color: #111827;
            font-size: 3rem;
            font-weight: 800;
            margin: 0;
        }

        .payment-type {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            margin-bottom: 0;
        }

        .payment-method-selection {
            margin-bottom: 1.5rem;
        }

        .payment-method-selection h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.75rem;
            margin-top: 0;
        }

        .payment-method-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .payment-method-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem 1.25rem;
            border: 1px solid;
            border-radius: 0.5rem;
            font-size: 1.125rem;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }

        .payment-method-button svg {
            width: 1.5rem;
            height: 1.5rem;
            margin-right: 0.75rem;
        }

        .payment-method-button.stripe-inactive {
            background-color: #ffffff;
            color: #4b5563;
            border-color: #d1d5db;
        }

        .payment-method-button.stripe-inactive:hover {
            border-color: rgb(25, 18, 80);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .payment-method-button.stripe-active {
            background-color: rgb(25, 18, 80);
            color: #ffffff;
            border-color: rgb(25, 18, 80);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: scale(1.05);
        }

        .payment-method-button.paypal-inactive {
            background-color: #ffffff;
            color: #4b5563;
            border-color: #d1d5db;
        }

        .payment-method-button.paypal-inactive:hover {
            border-color: rgb(25, 18, 80);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .payment-method-button.paypal-active {
            background-color: rgb(25, 18, 80);
            color: #ffffff;
            border-color: rgb(25, 18, 80);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: scale(1.05);
        }

        .warning-box {
            background-color: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
            padding: 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
        }

        .warning-box svg {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .warning-box p {
            margin: 0;
        }

        .warning-box .font-semibold {
            font-weight: 600;
        }

        .message-box {
            background-color: #dbeafe;
            border: 1px solid #93c5fd;
            color: #1d4ed8;
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            position: relative;
            margin-bottom: 1.5rem;
        }

        .message-box strong {
            font-weight: 700;
        }

        .message-box span {
            display: block;
        }

        @media (min-width: 640px) {
            .message-box span {
                display: inline;
            }
        }

        .pay-now-button {
            width: 100%;
            padding: 1rem;
            border-radius: 0.5rem;
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: 700;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            border: none;
        }

        .pay-now-button.enabled {
            background-color: #16a34a;
        }

        .pay-now-button.enabled:hover {
            background-color: rgb(255, 255, 0);
            transform: scale(1.05);
            color: #020202;
        }

        .pay-now-button.disabled {
            background-color: #9ca3af;
            cursor: not-allowed;
        }
    </style>

    <div class="payment-card">

        <div class="card-header-gradient">
            <h2>Promote Your Pet</h2>
            <p>Secure Payment Gateway</p>
        </div>

        <div class="card-body-content">
            <div class="payment-details">
                <p>You are promoting <span class="font-semibold">{{ $petName }}</span>.</p>
                <p class="payment-amount">
                    £{{ $paymentAmount }}
                </p>
                <p class="payment-type">One-time payment</p>
            </div>

            <div class="payment-method-selection">
                <h3>Choose Payment Method:</h3>
                <div class="payment-method-buttons">
                    <button wire:click="selectPaymentMethod('stripe')"
                        class="payment-method-button
                        @if ($selectedPaymentMethod === 'stripe') stripe-active
                        @else
                            stripe-inactive @endif
                        ">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22c-5.514 0-10-4.486-10-10S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10zm-1.5-12.5a.5.5 0 01.5-.5h2a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-2a.5.5 0 01-.5-.5v-1zm0 4a.5.5 0 01.5-.5h2a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-2a.5.5 0 01-.5-.5v-1zM12 7a.5.5 0 01.5-.5h2a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-2a.5.5 0 01-.5-.5V7zm0 4a.5.5 0 01.5-.5h2a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-2a.5.5 0 01-.5-.5v-1zM12 15a.5.5 0 01.5-.5h2a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-2a.5.5 0 01-.5-.5v-1zM12 19a.5.5 0 01.5-.5h2a.5.5 0 01.5.5v1a.5.5 0 01-.5.5h-2a.5.5 0 01-.5-.5v-1z" />
                        </svg>
                        Pay with Stripe
                    </button>
                    <button wire:click="selectPaymentMethod('paypal')"
                        class="payment-method-button
                        @if ($selectedPaymentMethod === 'paypal') paypal-active
                        @else
                            paypal-inactive @endif
                        ">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M10.707 17.293l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L8.414 12l3.707 3.707a1 1 0 01-1.414 1.414zM12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z" />
                        </svg>
                        Pay with PayPal
                    </button>
                </div>
            </div>

            {{-- Display validation errors here --}}
            @if ($errors->any())
                <div class="message-box" role="alert"
                    style="background-color: #fee2e2; border-color: #fca5a5; color: #dc2626;">
                    <strong>Validation Error!</strong>
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            @endif

            <div class="warning-box">
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path fillRule="evenodd"
                        d="M8.257 3.099c.765-1.542 2.705-1.542 3.47 0l3.051 6.137 6.467.94c1.7.247 2.37 2.27 1.143 3.52l-4.685 4.564 1.107 6.442c.294 1.707-1.47 3.003-2.971 2.249L10 18.257l-5.756 3.024c-1.501.754-3.265-.542-2.971-2.249l1.107-6.442L.678 13.696c-1.227-1.25-.557-3.273 1.143-3.52l6.467-.94L8.257 3.099z"
                        clipRule="evenodd" />
                </svg>
                <div>
                    <p class="font-semibold">Important Notice:</p>
                    <p>All payments are non-refundable. Please ensure your details are correct before proceeding.</p>
                </div>
            </div>

            @if ($message)
                <div class="message-box" role="alert">
                    <strong>Info!</strong>
                    <span>{{ $message }}</span>
                </div>
            @endif

            <button wire:click="payNow" wire:loading.attr="disabled" @if (!$selectedPaymentMethod) disabled @endif
                class="pay-now-button
                @if ($selectedPaymentMethod) enabled
                @else
                    disabled @endif
                ">
                <span wire:loading.remove wire:target="payNow">Pay Now</span>
                <span wire:loading wire:target="payNow">Processing...</span>
            </button>
        </div>
    </div>
</div>
