<?php
header('Content-Type: text/plain');

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['conName'] ?? '';
    $email = $_POST['conEmail'] ?? '';
    $message = $_POST['conMessage'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        echo "N";
        exit;
    }

    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'maaz@itayna.com';
        $mail->Password = 'Maaz123+-';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        //Recipients
        $mail->setFrom('maaz@itayna.com', 'AG Shipping');
        $mail->addAddress('agsoftwaredeveloper24@gmail.com', 'AG Shipping');

        //Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission - AG Shipping";
        
        $htmlBody = "
        <!DOCTYPE html>
        <html>
        <head>
            <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
            </style>
        </head>
        <body>
            <h2>New Contact Form Submission - AG Shipping</h2>
            <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Client Name</td>
                <td>$name</td>
            </tr>
            <tr>
                <td>Client Email</td>
                <td>$email</td>
            </tr>
            <tr>
                <td>Message</td>
                <td>$message</td>
            </tr>
            </table>
        </body>
        </html>
        ";
        
        $mail->Body = $htmlBody;

        $mail->send();
        echo "Y";
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        echo "N";
    }
} else {
    echo "N";
}
?> 