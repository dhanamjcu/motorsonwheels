<?php

    $mail->SMTPDebug = false;
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   =  true;                                   // Enable SMTP authentication
    $mail->Username   = 'Motoronwheelsproject@gmail.com';                     // SMTP username
    $mail->Password   = 'motorsonwheels123!';                               // SMTP password
    $mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       =  587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above 


?>