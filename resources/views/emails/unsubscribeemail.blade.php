<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email | {{config('settings.site_name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style type="text/css">
        a[x-apple-data-detectors] {
            color: inherit !important;
        }
    </style>

</head>

<body style="margin: 0; padding: 0;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">

                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                    <tr>
                        <td align="center" bgcolor="#e2e2e2" style="padding: 40px 0 30px 0;">
                            <img src="{{url('/storage//'.config('settings.site_logo'))}}" alt="{{config('settings.site_name').' Logo'}}" width="200" height="auto" style="display: block;" />
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif;">
                                        <h1 style="font-size: 24px; margin: 0;">From : {{config('settings.site_name')}}</h1>
                                        <p style="margin: 0;"><strong>Email: </strong>{{config('settings.contect_smtp_user')}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                        <p style="margin: 0;"><strong>Subject: </strong> {{$subject}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                        <p style="margin: 0;"><strong>Message: </strong> {!!$mail_message!!}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ee4c50" style="padding: 30px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                        <p style="margin: 0;">&copy; {{config('settings.site_name')}}<span> {{ now()->year }}</span><br/>
                                    </td>
                                    <td align="right">
                                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                            <tr>
                                                <td>
                                                    <a href="{{config('settings.social_facebook')}}">
                                                        <img src="{{asset('/storage/socials/fbicon.png')}}" width="30" height="auto" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{config('settings.social_twitter')}}">
                                                        <img src="{{asset('/storage/socials/twicon.png')}}" width="30" height="auto" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{config('settings.social_instagram')}}">
                                                        <img src="{{asset('/storage/socials/inicon.png')}}" width="30" height="auto" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{config('settings.social_youtube')}}">
                                                        <img src="{{asset('/storage/socials/yticon.png')}}" width="30" height="auto" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>

</html>