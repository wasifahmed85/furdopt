<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FurDopt</title>
</head>

<body bgcolor="#0f3462" style="margin-top:20px;margin-bottom:20px">
    <!-- Main table -->
    <table border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="white" width="650">
        <tr>
            <td>
                <!-- Child table -->
                <table border="0" cellspacing="0" cellpadding="0" style="color:#0f3462; font-family: sans-serif;">
                    <tr>
                        <td>
                            <h2 style="text-align:center; margin: 0px; padding-bottom: 25px; margin-top: 25px;">
                                <span style="color:lightcoral">FurDopt</span>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('images') }}/{{ $setting->site_logo }}" height="50px"
                                style="display:block; margin:auto;padding-bottom: 25px; ">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <h1 style="margin: 0px;padding-bottom: 25px; text-transform: uppercase;">Payment Success to
                                subscription for {{ $plan->name }}.
                            </h1>
                            <h2 style="margin: 0px;padding-bottom: 25px;font-size:22px;">Please try again!</h2>
                            <a href="https://furdopt.com/">Click Here</a>

                            <!--<h2 style="margin: 0px; padding-bottom: 25px;">Expire: 05 November</h2>-->
                        </td>
                    </tr>
                    <!--<tr>-->
                    <!--  <td>-->
                    <!--    <button type="button" style="background-color:#36b445; color:white; padding:15px 97px; outline: none; display: block; margin: auto; border-radius: 31px;-->
          <!--                      font-weight: bold; margin-top: 25px; margin-bottom: 25px; border: none; text-transform:uppercase; ">Renew</button>-->
                    <!--  </td>-->
                    <!--</tr>-->
                    <tr>
                        <td style="text-align:center;">
                            <h2 style="padding-top: 25px; line-height: 1; margin:0px;">Need Help?</h2>
                            <div style="margin-bottom: 25px; font-size: 15px;margin-top:7px;">
                                <a href="https://furdopt.com/contactUs">Click Here</a>

                            </div>
                        </td>
                    </tr>
                </table>
                <!-- /Child table -->
            </td>
        </tr>
    </table>
    <!-- / Main table -->
</body>

</html>
