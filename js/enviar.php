&lt;?php
date_default_timezone_set('America/Sao_Paulo');

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if((isset($_POST['email']) &amp;&amp; !empty(trim($_POST['email']))) &amp;&amp; (isset($_POST['mensagem']) &amp;&amp; !empty(trim($_POST['mensagem'])))) {

	$nome = !empty($_POST['nome']) ? $_POST['nome'] : 'Não informado';
	$email = $_POST['email'];
	$assunto = !empty($_POST['assunto']) ? utf8_decode($_POST['assunto']) : 'Não informado';
	$mensagem = $_POST['mensagem'];
	$data = date('d/m/Y H:i:s');

	$mail = new PHPMailer();
	$mail-&gt;isSMTP();
	$mail-&gt;Host = 'smtp.gmail.com';
	$mail-&gt;SMTPAuth = true;
	$mail-&gt;Username = 'seuemail@gmail.com';
	$mail-&gt;Password = 'senhadoemail';
	$mail-&gt;Port = 587;
 
	$mail-&gt;setFrom('seuemail@gmail.com');
	$mail-&gt;addAddress('endereco1@provedor.com.br');

	$mail-&gt;isHTML(true);
	$mail-&gt;Subject = $assunto;
	$mail-&gt;Body = "Nome: {$nome}&lt;br&gt;
				   Email: {$email}&lt;br&gt;
				   Mensagem: {$mensagem}&lt;br&gt;
				   Data/hora: {$data}";

	if($mail-&gt;send()) {
		echo 'Email enviado com sucesso.';
	} else {
		echo 'Email não enviado.';
	}
} else {
	echo 'Não enviado: informar o email e a mensagem.';
}