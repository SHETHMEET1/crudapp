<!DOCTYPE html>
<html>
<head>
    <title>Account Verification</title>
</head>
<body>
    <h2>Verify Your Email</h2>
    <p>Thank you for registering. Please click the following link to verify your email:</p>
    <a href="{{ route('verify', $user->verification_token) }}">Verify Email</a>
</body>
</html>
