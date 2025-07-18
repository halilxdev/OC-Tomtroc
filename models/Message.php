<?php

class Message extends AbstractEntity 
{
	private Object $from_user;
	private Object $to_user;
	private string $content = "";
	private string $status = "";
	private ?DateTime $sent_at = null;

	
	public function setFromUser(int $from_user) : void 
	{
		$userManager = new UserManager();
		$this->from_user = $userManager->getUserById($from_user);
	}
	public function getFromUser() : Object 
	{
		return $this->from_user;
	}
	
	public function setToUser(int $to_user) : void 
	{
		$userManager = new UserManager();
		$this->to_user = $userManager->getUserById($to_user);
	}
	public function getToUser() : Object 
	{
		return $this->to_user;
	}

	public function setContent(string $content) : void 
	{
		$this->content = $content;
	}
	public function getContent() : string 
	{
		return $this->content;
	}

	public function setStatus(string $status) : void 
	{
		$this->status = $status;
	}
	public function getStatus() : string 
	{
		return $this->status;
	}

	public function setSentAt(string|DateTime $sent_at, string $format = 'Y-m-d H:i:s') : void 
	{
	    if (is_string($sent_at)) {
	        $sent_at = DateTime::createFromFormat($format, $sent_at);
	    }
	    $this->sent_at = $sent_at;
	}
	public function getSentAt() : DateTime 
	{
	    return $this->sent_at;
	}

}