<?php
	
	$emailenvio = "sergio@tresdedos.es";
	
		require ("class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->Encoding = 'base64'; //modif
		require ("class.configemail.php");
		 
		$mail->From = $emailenvio;
		$mail->FromName = "PSCOVER";
		$mail->Subject = "Presupuesto número YYY";
		$mail->AddAddress($emailenvio, "PSCOVER");
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";
		$headers .= "Content-Transfer-Encoding: base64\r\n\r\n"; //modif
		$headers .= "From: PSCOVER <$emailenvio>\n";
		$headers .= "Reply-To: $emailenvio\n";
		
		$mensaje  = "<html>";
		$mensaje .= "<head>";
		$mensaje .= "<style>";
		$mensaje .= ".normal{font-family: verdana,arial;color: black;font-size: 12px;}";
		$mensaje .= "A.enlace{color: #002C9C;font-size: 12px;text-decoration: none;font-weight: bold;}";
		$mensaje .= "A.enlace:hover{color: #5276D9;font-size: 12px;text-decoration: underline;font-weight: bold;}";
		$mensaje .= "</style>";
		$mensaje .= "</head>";
		$mensaje .= "<body>";
		
		$mensaje .= $_POST["HTML"];

		$mensaje .= "</body>";
		$mensaje .= "</html>";
	
		$mail->Body = $mensaje;
		
		$enviadoemail = $mail->Send();


		if ($enviadoemail){
			$arr_rpta=array("OK"=>"1"); 
		} else {
			$arr_rpta=array("OK"=>"0");
		}

echo json_encode($arr_rpta);
?>
    