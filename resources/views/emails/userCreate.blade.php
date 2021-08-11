<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New payment received</title>
    <style>
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        html, body {
            background: #eeeeee;
            font-family: 'Open Sans', sans-serif, Helvetica, Arial;
        }

        img {
            max-width: 100%;
        }

        /* This is what it makes reponsive. Double check before you use it! */
        @media only screen and (max-width: 480px) {
            table tr td {
                width: 100% !important;
                float: left;
            }
        }
    </style>
</head>

<body style="background: #eeeeee; padding: 10px; font-family: 'Open Sans', sans-serif, Helvetica, Arial;">
<!-- ** Table begins here
----------------------------------->
<!-- Set table width to fixed width for Outlook(Outlook does not support max-width) -->
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="FFFFFF"
       style="background: #ffffff; max-width: 600px !important; margin: 0 auto; background: #ffffff;">
    <tr>
        <td style="padding: 20px; text-align: center; background: #76ce3e;">
            <h1 style="color: #ffffff">{{ $title }}</h1>
        </td>
    </tr>


    <tr>
        <td style="padding: 20px; text-align: center;">
            <!-- ** 100% width
            ----------------------------------->
            <p>Dear {{ $name }},</p>
            <p>Please use {{ $email }} email as username and password to login to our system</p>
            <p style="border-radius: 40px; -moz-border-radius: 40px; padding: 15px 20px; margin: 10px auto; background: #76ce3e; display: inline-block;">
                <a href="tel:8888888888" style="color: #fff; text-decoration: none;">Call Us (888) 888-8888</a>
            </p>
        </td>
    </tr>

    <tr>
        <td style="padding: 20px; background: #2B2E34;">

            <!-- ** 50% and 50%
            ----------------------------------->
            <table border="0" cellpadding="0" cellspacing="0" a>
                <tr>
                    <td width="50%" style="width: 50%; padding: 10px; color: #ffffff; text-align: left;"
                        valign="top">
                        <h2>About us</h2>
                        <p style="font-size: 14px;">we are online payment handling company</p>
                    </td>
                    <td width="50%" style="width: 50%; padding: 10px; color: #ffffff; text-align: left;"
                        valign="top">
                        <h2>Contact us</h2>
                        <!-- ** Footer contact
                        ----------------------------------->
                        <table border="0" style="font-size: 14px;">
                            <tr>
                                <td>Call: (888) 888-8888</td>
                            </tr>
                            <tr>
                                <td>email: sample@email.com</td>
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
