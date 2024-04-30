<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                    <tr>
                        <td bgcolor="#f0f0f0" style="padding: 40px; text-align: center;">
                            <h1>Welcome to Our Company!</h1>
                            <p>Dear {{ $data['name']}},</p>
                            <p>Thank you for joining our platform. Your ID is: xyz{{ $data['id']}}.</p>
                            <p>Feel free to explore our features and start enjoying all the benefits.</p>
                            <p>If you have any questions or need assistance, don't hesitate to contact us.</p>
                            <p>Best regards,<br> The Our Platform Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
