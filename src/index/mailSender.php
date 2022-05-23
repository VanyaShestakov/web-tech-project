<?php

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

require_once 'features.php';

$mail = new PHPMailer\PHPMailer\PHPMailer(true);                   
try {
    $mail->setLanguage('ru', 'vendor/phpmailer/phpmailer/language/');
    $email = $_POST['email'];
    $desc = $_POST['desc'];
    $pattern = "#(?:https?|ftp)://[^\s\,]+#i";
    $result = preg_replace($pattern, "<a style='color:red' href='$0'>$0</a>", $desc);
   
    $mail->SMTPDebug = 1;                                 

    $mail->isSMTP();                                      
   
    $mail->SMTPAuth = true;                               
                             
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;                                    
   
    $mail->Host = 'smtp.gmail.com';                      
    $mail->Username = 'employee.management.service1@gmail.com';               
    $mail->Password = 'employee123';                         

    $mail->setFrom('employee.management.service1@gmail.com', 'EMS');
    $mail->addAddress($email);              

    $mail->isHTML(true);                                 
    $mail->Subject = 'Employee Management Service';
    $mail->Body  = $result;
    $mail->send();
    echo $main_template;
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

