<?php

class Notify{

	public function mail($destinatario, $assunto, $msgConteudo){
		require_once '/var/www/phpmailer/class.phpmailer.php';
		require_once '/var/www/config.php';
		// Inicia a classe PHPMailer
		$mail = new PHPMailer();

		// Define os dados do servidor e tipo de conexão
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = HOST_SMTP; // Endereço do servidor SMTP
		$mail->SMTPAuth = AUTENT_SMTP; // Usa autenticação SMTP? (opcional)
		$mail->Username = USER_SMTP; // Usuário do servidor SMTP
		$mail->Password = SENHA_SMTP; // Senha do servidor SMTP

		// Define o remetente
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->From = USER_SMTP; // Seu e-mail
		$mail->FromName = "InovarSat"; // Seu nome

		// Define os destinatário(s)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->AddAddress($destinatario);
		$mail->AddAddress('jesaias@mmconsulting.com.br');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

		// Define os dados técnicos da Mensagem
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
		$mail->setLanguage('br', '/var/www/phpmailer/language/');

		// Define a mensagem (Texto e Assunto)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->Subject  = $assunto; // Assunto da mensagem
		$mail->Body = $msgConteudo;
		$mail->AltBody = strip_tags($msgConteudo);

		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

		// Envia o e-mail
		$enviado = $mail->Send();

		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();
		return $enviado;
	}

	public static function sms($contato, $mensagem, $remetente){
		$cnx = mysql_connect("cloudservice.cgejdsdl842e.sa-east-1.rds.amazonaws.com", "gpstracker", "d1$1793689")
			or die("Could not connect: " . mysql_error());
		mysql_select_db('tracker', $cnx);
		$res = mysql_query("select valor from preferencias where nome = 'url_sms'", $cnx);
		$data = mysql_fetch_assoc($res);
		$url = $data['valor'];

		$res = mysql_query("select valor from preferencias where nome = 'usuario_sms'", $cnx);
		$data = mysql_fetch_assoc($res);
		$usuario = $data['valor'];

		$res = mysql_query("select valor from preferencias where nome = 'senha_sms'", $cnx);
		$data = mysql_fetch_assoc($res);
		$senha = $data['valor'];

		$res = mysql_query("select valor from preferencias where nome = 'de_sms'", $cnx);
		$data = mysql_fetch_assoc($res);
		$de = $data['valor'];
		file_get_contents($url . "usr=" . $usuario . "&pwd=" . $senha . "&number=55" . $contato . "&sender=" . $de . "&msg=$mensagem");
	}

	public static function db($imei, $mensagem){
		$cnx = mysql_connect("cloudservice.cgejdsdl842e.sa-east-1.rds.amazonaws.com", "gpstracker", "d1$1793689") or die("Could not connect: " . mysql_error());
		mysql_select_db('tracker', $cnx);
		$res = mysql_query("SELECT message, DATE_FORMAT(date, '%d/%m/%Y') AS data FROM message WHERE imei = $imei AND viewed = 'N' ", $cnx);

		if (mysql_num_rows($res) > 0) {
			$data = date("d/m/Y");
			while ($alerta = mysql_fetch_array($res)) {
				if ($alerta['data'] == $data && (stripos($mensagem, $alerta['message']) !== false)) return true;
			}
		} else return false;
	}
}