<?php

/**
 * Description of EmailSender
 *
 * @author kuba
 */
class EmailSender
{

	public function send($from, $to, $subject, $content, $alias = '')
	{
		require_once('./vendors/PHPMailer/class.phpmailer.php');

		$mailer = new PHPMailer(true);

		$mailer->Sender = $from;
		$mailer->AddReplyTo($from);
		if ($alias) {
			$mailer->SetFrom($from, $alias);
		}

		$mailer->AddAddress($to);
		$mailer->Subject = $subject;
		$mailer->MsgHTML($content);
		$mailer->CharSet = 'UTF-8';

		$config = SimpleConfig::getInstance();
		
		// Set up our connection information.
		$mailer->IsSMTP();
		$mailer->SMTPAuth = true;
		$mailer->SMTPSecure = $config['smtp_secure'];
		$mailer->Port = $config['smtp_port'];
		$mailer->Host = $config['smtp_host'];
		$mailer->Username = $from;
		$mailer->Password = $config['smtp_password'];

		$mailer->Send();
	}

}

?>
