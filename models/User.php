<?php

class User extends AbstractEntity 
{
	private string $username = "";
	private string $email = "";
	private string $profile_picture = "";
	private ?DateTime $created_at = null;

	
	public function setUsername(string $username) : void 
	{
		$this->username = $username;
	}
	public function getUsername() : string 
	{
		return $this->username;
	}

	public function setEmail(string $email) : void 
	{
		$this->email = $email;
	}
	public function getEmail() : string 
	{
		return $this->email;
	}

	public function setProfilePicture(string $profile_picture) : void 
	{
		$this->profile_picture = $profile_picture;
	}
	public function getProfilePicture() : string 
	{
		return $this->profile_picture;
	}
	
	public function setCreatedAt(string|DateTime $created_at, string $format = 'Y-m-d H:i:s') : void 
	{
	    if (is_string($created_at)) {
	        $created_at = DateTime::createFromFormat($format, $created_at);
	    }
	    $this->created_at = $created_at;
	}
	public function getCreatedAt() : DateTime 
	{
	    return $this->created_at;
	}

}