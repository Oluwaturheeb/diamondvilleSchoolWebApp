<?php

class Xender {
	private $_error, $_mail, $_active = false, $_swift;
	
	public function __construct () {
		try {
			$transport = (new Swift_SmtpTransport(config('mail/host'), config('mail/port'), config('mail/enc')))
			->setUsername(config('mail/user'))
			->setPassword(config('mail/pwd'));
	  
			$this->_swift = new Swift_Mailer($transport);
			
			$this->_mail = new Swift_Message();
		} catch (Exception $e) {
			$this->_error = $e->getMessage();
		}
		return $this;
	}
	
	public function sub($str) {
		if (!$str) error('Enter subject!', 'Xender error!');
		
		$this->_mail->setSubject($str);
		return $this;
	}
	
	public function sendTo($user) {
		if (!$user) error('Add a recipient, its important!', 'Xender error!');
		else
			if (is_array($user))
				$this->_mail->setTo($user);
			else
				$this->_mail->setTo([$user]);
			
		return $this;
	}
	
	public static function asset ($file) {
		if (file_exists($file)) error('File does not exist!', 'Xender error!');
		return (new Swift_Message())->embed(Swift_Image::fromPath($file));
	}
	
	public function attachment ($f, $n = '') {
		$this->_mail->attach(Swift_Attachment::fromPath($f)->filename($n));
		return $this;
	}

	public function desc ($d) {
		if (!$d)
			$this->_error = 'No description';
		else
			$this->_mail->addPart($d);
			
		return $this;
	}
	
	public function body ($body) {
		
		return $this;
	}
	
	public function send ($tmp = '', $f = '') {
		// this load the mail template 
		if (!$tmp) $tmp = __DIR__.'/template/mail.php';

		$this->_mail->setBody(self::processTemplate($tmp), 'text/html');

		// this set the from and send mail
		if (!$f) $f = 'test';
		$this->_mail->setFrom([config('mail/from') => $f]);
		$this->_swift->send($this->_mail);
		
		return $this->_swift;
	}

	public static function processTemplate ($path) {
		if (!file_exists($path)) error('The specified file can not be found!'. $path, 'File not found!', 404);

		ob_start();
		include($path); 
		return ob_get_clean();
	}

	
	public function error() {
		return $this->_error;
	}
}