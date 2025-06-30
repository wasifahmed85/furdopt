<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $setting->site_name }}</title>
</head>
<body>
    <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Segoe UI', sans-serif; background-color: #fefefe; padding: 30px;">
        <tr>
          <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="border: 1px solid #ddd; border-radius: 10px; overflow: hidden;">
              <tr>
                <td style="background-color: #f8f9fa; padding: 30px 40px; text-align: center;">
                  <h1 style="margin: 0; font-size: 28px; color: #4e3f30;">🐾 Welcome to FurDopt!</h1>
                  <p style="font-size: 16px; color: #6c757d;">Where your pet’s safety and happiness come first.</p>
                </td>
              </tr>
              <tr>
                <td style="padding: 30px 40px; background-color: #ffffff;">
                  <p style="font-size: 16px; color: #333;">Hi <strong>{{$user ?? ''}}</strong>,</p>
                  <p style="font-size: 16px; color: #333;">Thank you for submitting your pet's details for rehoming. We know this is never an easy decision, and we truly appreciate the care you're taking to find them a loving new home.  <br>

Your listing has been received and will go live once we officially launch. At that point, it will be publicly visible to potential adopters.<br>

                 </p>
                  
                 
                  <div style="margin: 30px 0; text-align: center;">
                    <a href="https://FurDopt.com" style="padding: 12px 25px; background-color: #ff6f61; color: #fff; text-decoration: none; font-size: 16px; border-radius: 5px;">Visit FurDopt</a>
                  </div>
                  <p style="font-size: 14px; color: #777;">In the meantime, if you need to make any changes you can log back into your account. You can also message us on our Instagram page.<a href="www.instragram.com/furdopt" style="color: #ff6f61" >FurDopt</a></p> <br>
                  <p style="font-size: 14px; color: #333;">With love,<br><strong>The FurDopt Team 🐶🐾</strong></p>
                </td>
              </tr>
              <tr>
                <td style="background-color: #f8f9fa; text-align: center; padding: 20px; font-size: 12px; color: #999;">
                  &copy; 2025 FurDopt. All rights reserved.
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
</body>
</html>