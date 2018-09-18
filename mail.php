<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Content-Type: application/json; charset=UTF-8");


    require("./vendor/phpmailer/phpmailer/src/PHPMailer.php");
    require("./vendor/phpmailer/phpmailer/src/SMTP.php");
     
    $errors = '';
     
    if(empty($errors))
    {
     
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
     
        $from_email = $request->email;
        $message = $request->message;
        $from_name = $request->name;
        $telefono = $request->telefono;
        $direccion = $request->direccion;
     
        // Correo de destino
        $to_email = "opticadelrey@hispavista.com";
     
        //Información del contacto
        $contact = "<p><strong>Nombre:</strong> $from_name</p>
                    <p><strong>Email:</strong> $from_email</p>
                    <p><strong>Telefono:</strong> $telefono</p>
                    <p><strong>Direccion:</strong> $direccion</p>";
        
        
        $content = "<p>$message</p>";
     
      
     
        $email_body = '<html><body>';
        $email_body .= "$contact $content";
        $email_body .= '</body></html>';
     
        // $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "From: $from_email\r\n";
        // $headers .= "Reply-To: $from_email";
     
        // mail($to_email,$email_subject,"mensaje",$headers);
        mail($to_email,$email_subject,$email_body,$headers);

        $mail = new PHPMailer\PHPMailer\PHPMailer();
      $mail->IsSMTP(); // enable SMTP

      $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; // or 587
      $mail->IsHTML(true);
      $mail->Username = "kevinmontoya64@gmail.com";
      $mail->Password = "Bravia_4000";
      $mail->SetFrom($from_email);
      $mail->Subject = "Consulta web de " . $from_name;
      $mail->Body = $email_body;
      $mail->AddAddress($to_email);

       if(!$mail->Send()) {
           echo "Mailer Error: " . $mail->ErrorInfo;
       } else {
           echo "Message has been sent";
       }
     
        $response_array['status'] = 'success';
        $response_array['from'] = $from_email;
        echo json_encode($response_array);
        echo json_encode($from_email);
        header($response_array);
        return $from_email;
    } else {
        $response_array['status'] = 'error';
        echo json_encode($response_array);
        // header('Location: /error.html');
    }

?>