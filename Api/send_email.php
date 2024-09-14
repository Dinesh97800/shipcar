<?php
error_reporting(0);

// Include the Composer autoload file
include(__DIR__ . '/../vendor/autoload.php');  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function otpemail($email, $uname,$password) {
    $msg = '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
      <div style="border-bottom:1px solid #eee">
        <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">credbnk.in</a>
      </div>
      <p style="font-size:1.1em">Hi, ' . $uname . '</p>
      <p>Your account has been created successfully on credbnk.in. Below are your login details:</p>
      <p><strong>Email:</strong> ' . $email . '</p>
      <p><strong>Password:</strong> ' . $password . '</p>
      <p style="font-size:0.9em;">If you did not create this account, please contact our support team immediately.</p>
      <hr style="border:none;border-top:1px solid #eee" />
      <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
        <p>credbnk.in</p>
      </div>
    </div>
  </div>';


    $to = $email;
    $subject = 'CredBnk - Generated password';

    $mail = new PHPMailer(false); // Passing `true` enables exceptions
    print_r($mail);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = "sharmasabb728@gmail.com";
        $mail->Password = "gswl jnxb oklu wrlr";
        $mail->setFrom("sharmasabb728@gmail.com", "Dinesh Kumar");
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->addAddress($to);

        $mail->send();
        echo "Message has been sent successfully.";
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>
