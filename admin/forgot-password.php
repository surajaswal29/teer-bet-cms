<?php
include "function.inc.php";

// Define recipient email
$to = "teerresultshillong1980@gmail.com";

// Validate email to prevent header injection attacks
if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

// Email subject
$subject = "Password Reset";

// https://shillongteeresult.in => day
// https://morning.shillongteeresult.in => morning
// https://night.shillongteeresult.in => night

// Email message (HTML) https://shillongteeresult.in
$message = "
<html>
    <head>
        <title>Password Reset</title>
    </head>
    <body>
        <h4>Click on this link to reset your admin password:</h4>
        <p><a href='https://shillongteeresult.in/admin/set-new-password.php' target='_blank' style='color:blue; text-decoration:underline;'>Reset Password</a></p>
        <p>If you didn't request this, please ignore this email.</p>
    </body>
</html>";

// Email headers
$headers = "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-Type: text/html; charset=UTF-8" . PHP_EOL;
$headers .= "From: support@shillongteeresult.in" . PHP_EOL;
$headers .= "Reply-To: support@shillongteeresult.in" . PHP_EOL;
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email and check for errors
if (mail($to, $subject, $message, $headers)) {
    redirect('index.php');
} else {
    $error = error_get_last();
    echo "Error sending email: " . ($error['message'] ?? "Unknown error");
}
?>