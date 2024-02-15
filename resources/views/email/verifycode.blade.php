<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>

    <p>Thank you for registering with our website. To verify your email address, please use the following verification code:</p>

    <h2> Your Verification code is : {{ $verificationCode }}</h2>

    <p>Please enter this verification code on the verification page to complete the registration process.</p>

    <p>If you did not register on our website, please disregard this email.</p>

    <p>Regards,<br>
    Sab-Concept Team</p>
</body>
</html>
