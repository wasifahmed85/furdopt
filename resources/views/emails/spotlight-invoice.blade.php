<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice - Spotlight Purchase</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px;">
    <div style="max-width: 600px; background: #fff; margin: auto; padding: 30px; border-radius: 8px; border: 1px solid #ddd;">
        <h2 style="color: #2c3e50;">Spotlight Purchase Receipt</h2>

        <p>Hi {{ $user->name }},</p>

        <p>Thank you for your purchase! Below are the details of your spotlight order:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <td><strong>Invoice Date:</strong></td>
                <td>{{ \Carbon\Carbon::now()->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td><strong>Spotlight Package:</strong></td>
                <td>{{ $SubscriptionPlan->name }}</td>
            </tr>
            <tr>
                <td><strong>Amount Paid:</strong></td>
                <td>{{ number_format($payment->amount, 2) }} </td>
            </tr>
            <tr>
                <td><strong>Transaction ID:</strong></td>
                <td>{{ $payment->transaction_id }}</td>
            </tr>


        </table>

        <p style="margin-top: 30px;">If you have any questions or need support, feel free to contact our team.</p>


    </div>
</body>
</html>
