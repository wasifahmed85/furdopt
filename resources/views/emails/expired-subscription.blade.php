<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $setting->site_name }}</title>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0"
        style="font-family: 'Segoe UI', sans-serif; background-color: #fefefe; padding: 30px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden;">
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 30px 40px; text-align: center;">
                            <h1 style="margin: 0; font-size: 28px; color: #4e3f30;">🐾 Welcome to FurDopt!</h1>
                            <p style="font-size: 16px; color: #6c757d;">Where your pet’s safety and happiness come
                                first.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 40px; background-color: #ffffff;">
                            <p style="font-size: 16px; color: #333;">Hi
                                <strong>{{ $subscription->user->name }}</strong>,
                            </p>
                            <p style="font-size: 16px; color: #333;">We’re thrilled to welcome you to
                                <strong>FurDopt</strong> — your go-to place for smart pet safety solutions and peace
                                of mind. Whether you're here to protect your furry friend or explore helpful tools,
                                you're in the right place.
                            </p>
                            <p style="font-size: 16px; color: #333;">
                                <strong>Your Subscription plan {{ $subscription->plan->name }} Expires. Your
                                    plan expired in
                                    {{ \Carbon\Carbon::parse($subscription->end_date)->format('F j, Y') }}
                                </strong>
                            </p>
                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ route('f.subscription') }}"
                                    style="padding: 12px 25px; background-color: #ff6f61; color: #fff; text-decoration: none; font-size: 16px; border-radius: 5px;">Renew
                                    Now</a>
                            </div>
                            <ul style="padding-left: 20px; color: #333; font-size: 16px;">
                                <li>✅ <strong>Explore Our Products</strong> – Find QR-tagged pet safety gear</li>
                                <li>✅ <strong>Set Up Your Pet’s Profile</strong> – Keep info ready for emergencies</li>
                                <li>✅ <strong>Track Orders Easily</strong> – Stay updated at every step</li>
                                <li>✅ <strong>Reach Out Anytime</strong> – We’re here for you and your pet</li>
                            </ul>

                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ route('f.subscription') }}"
                                    style="padding: 12px 25px; background-color: #ff6f61; color: #fff; text-decoration: none; font-size: 16px; border-radius: 5px;">Renew
                                    Now</a>
                            </div>
                            for exclusive member perks.</p>
                            <div style="margin: 30px 0; text-align: center;">
                                <a href="https://FurDopt.com"
                                    style="padding: 12px 25px; background-color: #ff6f61; color: #fff; text-decoration: none; font-size: 16px; border-radius: 5px;">Visit
                                    FurDopt</a>
                            </div>
                            <p style="font-size: 14px; color: #777;">If you ever need help, reply to this email or
                                contact our team at <a href="mailto:admin@furdopt.com"
                                    style="color: #ff6f61;">admin@furdopt.com</a>.</p>
                            <p style="font-size: 14px; color: #333;">With love,<br><strong>The FurDopt Team
                                    🐶🐾</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: #f8f9fa; text-align: center; padding: 20px; font-size: 12px; color: #999;">
                            &copy; 2025 FurDopt. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
    </table>
</body>

</html>
