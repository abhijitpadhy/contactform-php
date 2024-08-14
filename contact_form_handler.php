<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['msg'])) {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $msg = htmlspecialchars($_POST['msg']);

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'johnpadhy@gmail.com';
        $mail->Password   = 'mfxhptbujzyydykp';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('johnpadhy@gmail.com', 'Contact Form');
        $mail->addAddress('abhijitpadhy2000@gmail.com', 'Abhijit Padhy');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "<h3>You have a new message from your contact form</h3>
                          <p><strong>Name:</strong> {$name}</p>
                          <p><strong>Email:</strong> {$email}</p>
                          <p><strong>Message:</strong> {$msg}</p>";
        $mail->AltBody = "You have a new message from your contact form\n\n" .
                         "Name: {$name}\n" .
                         "Email: {$email}\n" .
                         "Message: {$msg}";

        $mail->send();
        $message = 'Message has been sent successfully!';
        $message_class = 'success';
    } catch (Exception $e) {
        $message = "Message could not be sent. Error: {$mail->ErrorInfo}";
        $message_class = 'error';
    }
} else {
    $message = 'Please fill all the fields.';
    $message_class = 'error';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            padding: 20px;
            text-align: center;
        }
        .card h1 {
            margin: 0;
            font-size: 24px;
        }
        .card p {
            margin: 10px 0;
            font-size: 16px;
        }
        .card .logo {
            width: 50px;
            height: auto;
            margin-bottom: 20px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<div class="card <?php echo $message_class; ?>">
    <img src="logo.png" alt="Logo" class="logo">
    <h1><?php echo $message_class === 'success' ? 'Thank You!' : 'Oops!'; ?></h1>
    <p><?php echo $message; ?></p>
    <?php if ($message_class === 'success'): ?>
        <button onclick="window.location.href='index.html'">Return to Homepage</button>
    <?php endif; ?>
</div>

</body>
</html>
