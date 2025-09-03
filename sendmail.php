<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $zip     = htmlspecialchars($_POST['zip']);
    $country = htmlspecialchars($_POST['country']);

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your-email@gmail.com'; 
        $mail->Password   = 'your-app-password'; // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Approach Landing Page');
        $mail->addAddress('your-email@gmail.com', 'Admin');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Product Sample Request';
        $mail->Body    = "
            <h3>New Request for Free Sample</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Zip Code:</strong> $zip</p>
            <p><strong>Country:</strong> $country</p>
        ";

        $mail->send();

        // Redirect to Thank You page
        header("Location: thankyou.html");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}else{
    throw new Exception("Error Processing Request", 500);
}
?>
