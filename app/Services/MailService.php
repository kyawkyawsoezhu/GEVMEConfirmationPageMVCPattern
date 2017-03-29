<?php
namespace App\Services;

use Mailgun\Mailgun;

class MailService
{
	private $key;
	private $domain;
	private $html;

	public function __construct()
	{
		$this->key = config('mail.mailgun.key');
		$this->domain = config('mail.mailgun.domain');
		$this->from = config('mail.mailgun.from');
	}

	public function send($to, $subject)
	{
		$mail_client = new Mailgun($this->key);
		$mail_params = [
			'to'      => $to,
			'subject' => $subject,
			'from'    => $this->from,
		];
		if($this->html != false){
			$mail_params['html'] = $this->html;
		}
		
		try{
   			$result = $mail_client->sendMessage($this->domain,$mail_params);
		}catch(Exception $e){
			throw new Exception($e->getMessage(), 1);
		}
		return $this;
	}

	public function html($file,$vars = [])
	{
		$file = "app.Views.".$file;
		$file = str_replace('.', '/', $file);
		$file = rtrim($file,'.php').'.php';

		$this->html = $this->bufferingOutPut($file,$vars);
		return $this;
	}

	private function bufferingOutPut($file,$vars)
	{
		if(!empty($vars)) extract($vars);

		ob_start();
		include($file);
		$content = ob_get_contents();
		ob_end_clean(); 
		return $content;
	}
}