<?php

    require('../partials/pdf.php');
    $file_name = 'results' . '.pdf';
    ob_start();
    include "./results-pdf.php";
    $html = ob_get_clean();

    echo  $html;
    $pdf = new Pdf();

    $pdf->loadHtml($html);
    $pdf->render();
    $file = $pdf->output();

    file_put_contents($file_name, $file);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';

    $mail = new PHPMailer;
    
    $mail->IsSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';
    $mail->Username = 'andres.dafg@gmail.com';
    $mail->Password = 'Diegoandres1601';
    $mail->Subject  = "Resultados";
    $mail->Body = "Resultados en pdf:";
    $mail->setFrom('andres.dafg@gmail.com');
    $mail->addAddress($patient['email']);       

    $mail->AddAttachment($file_name);

    if($mail->Send()){
        echo 'Enviado';
    } else {
        echo "No Enviado" . $mail->ErrorInfo;;
    }

    $mail->smtpClose();
    unlink($file_name);
    header('Location: /laboratorio/');
?>