<?php
namespace Devtee\Tlyt\Components;

use \Swift_SmtpTransport;
use \Swift_Mailer;
use \Swift_Message;
use \Swift_Image;
use \Swift_Attachment;

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
	
	public function subject($str) {
		if (!$str) error('Enter subject!', 'Xender error!');
		
		$this->_mail->setSubject($str);
		return $this;
	}
	
	public function sendTo($user) {
		if (!$user) error('Add a recipient, its important!', 'Xender error!');
		
		if (is_array($user)) $this->_mail->setTo($user);
		else $this->_mail->setTo([$user]);
			
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
		if (!$d) $this->_error = 'No description';
		else $this->_mail->addPart($d);
			
		return $this;
	}
	
	public function template ($path, $variable) {
		$GLOBALS['view'] = $variable;
	  ob_start();
		includeView($path);
		$ob = ob_get_clean();
		$this->_mail->setBody($ob, 'text/html');
		return $this;
	}
	
	public function send ($f = '') {
		// this set the from and send mail
		$this->_mail->setFrom([config('mail/from') => $f]);
		$this->_swift->send($this->_mail);
		
		return $this->_swift;
	}

	public function error() {
		return $this->_error;
	}
}