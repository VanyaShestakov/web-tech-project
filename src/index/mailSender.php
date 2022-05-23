<?php

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

require_once 'features.php';

$mail = new PHPMailer\PHPMailer\PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->setLanguage('ru', 'vendor/phpmailer/phpmailer/language/'); // Перевод на русский язык
    $email = $_POST['email'];
   
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
   
    $mail->SMTPAuth = true;                               // Enable SMTP authentication

    //$mail->SMTPSecure = 'ssl';                          // secure transfer enabled REQUIRED for Gmail
    //$mail->Port = 465;                                  // TCP port to connect to
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
   
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->Username = 'employee.management.service1@gmail.com';               // SMTP username
    $mail->Password = 'employee123';                         // SMTP password

    //Recipients
    $mail->setFrom('employee.management.service1@gmail.com', 'EMS');
    $mail->addAddress($email);              // Name is optional

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Employee Management Service';
    $mail->Body    = 'We are glad that you want to become a part of our team. Wait for further action from us!';
    $mail->send();
    echo $main_template;
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

