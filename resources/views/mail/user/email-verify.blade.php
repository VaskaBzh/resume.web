<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ app()->getLocale() }}"><head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="format-detection" content="telephone=no">

    <!-- Responsive Email Template by MakeMail.ru 2017  -->



    <!-- MESSAGE SUBJECT -->
    <title>{{ config('app.name') }}</title>

    <style>body {
            margin: 0; padding: 0; min-width: 100%; width: 100% !important; height: 100% !important;
        }
        body {
            -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;
        }
        .ReadMsgBody {
            width: 100%;
        }
        .ExternalClass {
            width: 100%;
        }
        .ExternalClass {
            line-height: 100%;
        }
        a:hover {
            color: #127DB3;
        }
        .footer a:hover {
            color: #999999;
        }
        @media all and (max-width: 600px) {
            .floater {
                width: 320px;
            }
        }
    </style></head>

<!-- BODY -->
<!-- Set message background color (twice) and text color (twice) -->
<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; width: 100% !important; height: 100% !important; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; background-color: #FFFFFF; color: #000000; min-width: 100%; margin: 0; padding: 0;" bgcolor="#FFFFFF" text="#000000">

<!-- SECTION / BACKGROUND -->
<!-- Set section background color -->
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse !important; border-spacing: 0; width: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0;" class="background"><tbody><tr><td align="center" valign="top" style="border-collapse: collapse !important; border-spacing: 0; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0;" bgcolor="#FFFFFF">

            <!-- WRAPPER -->
            <!-- Set wrapper width (twice) -->
            <table border="0" cellpadding="0" cellspacing="0" align="center" width="600" style="border-collapse: collapse !important; border-spacing: 0; width: inherit; max-width: 600px; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0;" class="wrapper" bgcolor="#edf2f7">

                <tbody><tr>
                    <td valign="top" style="border-collapse: collapse !important; border-spacing: 0; width: 87.5%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 56px 56px 0;">
                        <a target="_blank" style="text-decoration: none; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; color: #127DB3;" href="#"><img src="https://app.makemail.ru/content/a956eea4b931b1af0392989a891ef755.png" alt="logo-vertical.png" style="line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: 0;"></a>

                    </td>
                </tr>

                <!-- HEADER -->
                <!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
                <tr>
                    <td valign="top" style="border-collapse: collapse !important; border-spacing: 0; color: #1D2939; font-feature-settings: 'dlig' on, 'ss01' on, 'salt' on, 'ss02' on; font-family: Verdana; font-size: 28px; font-style: normal; font-weight: 700; line-height: normal; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 40px 56px 0;" class="header">
                        @if (! empty($greeting))
                            {{ $greeting }}
                        @else
                            @if ($level === 'error')
                                @lang('Whoops!')
                            @else
                                @lang('Hello!')
                            @endif
                        @endif
                    </td>
                </tr>

                <!-- SUBHEADER -->
                <!-- Set text color and font family ("sans-serif" or "Georgia, serif") -->
                <tr>
                    @foreach ($introLines as $line)
                        <td valign="top" style="border-collapse: collapse !important; border-spacing: 0; color: #1D2939; font-family: Verdana; font-size: 18px; font-style: normal; font-weight: 400; line-height: normal; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 5px 56px 24px;" class="subheader">
                            {{ $line }}
                        </td>
                    @endforeach
                </tr>
                <!-- HERO IMAGE -->
                <tr>

                    <td valign="top" height="46" style="border-collapse: collapse !important; border-spacing: 0; text-decoration: none; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 20px 0 0 56px;" class="hero"><a style="text-decoration: none; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; color: #ffffff;" href="{{ $actionUrl }}" target="_blank">
                            <table border="0" cellpadding="0" cellspacing="0" style="max-width: 240px; min-width: 120px; border-collapse: collapse !important; border-spacing: 0; text-decoration: none; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0;"><tbody><tr><td valign="middle" style="border-collapse: collapse !important; border-spacing: 0; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -khtml-border-radius: 8px; text-decoration: none; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 135%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 12px 24px;" bgcolor="#2E90FA"><a target="_blank" style="-webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; color: #ffffff; font-size: 16px; font-weight: 700; text-decoration: none;" href="{{ $actionUrl }}">
                                            {{ $actionText }}
                                        </a>
                                    </td></tr></tbody></table></a>
                    </td></tr>

                <!-- PARAGRAPH -->
                <!-- Set text color and font family ("sans-serif" or "Georgia, serif"). Duplicate all text styles in links, including line-height -->
                <tr>
                    @foreach ($outroLines as $line)
                        <td valign="top" style="border-collapse: collapse !important; border-spacing: 0; font-family: Verdana; font-size: 18px; font-style: normal; font-weight: 400; line-height: normal; color: #1D2939; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 24px 56px;" class="paragraph">
                                {{ $line }}
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td valign="top" style="border-collapse: collapse !important; border-spacing: 0; font-family: Verdana; font-size: 18px; font-style: normal; font-weight: 400; line-height: normal; color: #2E90FA; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0 56px 74px;" class="paragraph">
                        <a target="_blank" style="-webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; color: #2E90FA; font-size: 18px; word-break: break-all;" title="{{ $actionUrl }}" href="{{ $actionUrl }}">
                            {{ $actionUrl }}
                        </a>
                    </td>
                </tr>

                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse !important; border-spacing: 0; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0 56px 32px;" class="button">
                        <a target="_blank" style="text-decoration: none; color: #98A2B3; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;" href="mailto:support@all-btc.com">
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse !important; border-spacing: 0; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0;"><tbody><tr><td valign="middle" style="padding-right: 8px; border-collapse: collapse !important; border-spacing: 0; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0;">
                                        <img align="center" src="https://app.makemail.ru/content/ec87f50ac6decb255b2e4b667c127ec4.png" alt="mail.png" style="line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: 0;">
                                    </td>
                                    <td valign="middle" style="-webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; color: #98A2B3; font-size: 14px; font-weight: 400; text-align: center; font-family: Verdana;" align="center"> support@all-btc.com </td></tr></tbody></table>
                        </a>

                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="border-collapse: collapse !important; border-spacing: 0; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0 56px 32px;" class="button">
                        <a target="_blank" style="text-decoration: none; color: #98A2B3; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;" href="#">
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse !important; border-spacing: 0; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0;"><tbody><tr><td valign="middle" style="padding-right: 8px; border-collapse: collapse !important; border-spacing: 0; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0;">
                                        <img align="center" src="https://app.makemail.ru/content/b0d54270fbbcf499a3e1ca6c4a2c3230.png" alt="location.png" style="line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: 0;">
                                    </td>
                                    <td valign="middle" style="-webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; color: #98A2B3; font-size: 14px; font-weight: 400; text-align: center; font-family: Verdana;" align="center"> ВDubai Silicon Oasis, DDP, Building A2,<br>
                                        Dubai, United Arab Emirates</td></tr></tbody></table>
                        </a>

                    </td>
                </tr>

                <!-- End of WRAPPER -->
                </tbody></table>

            <!-- SECTION / BACKGROUND -->
            <!-- Set section background color -->
        </td></tr>
    <!-- End of WRAPPER -->
    </tbody></table>
<!-- End of SECTION / BACKGROUND -->



</body></html>
