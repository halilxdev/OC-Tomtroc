<?php

/**
 * Entité Book, un livre est défini par les champs
 * id, title, author, description, created_at, status, cover_image
 */
class Book extends AbstractEntity 
{
	private string $title = "";
	private string $description = "";
	private string $author = "";
	private string $image = "";
	private ?DateTime $creation_date = null;

	
	public function setTitle(string $title) : void 
	{
		$this->title = $title;
	}
	public function getTitle() : string 
	{
		return $this->title;
	}

	public function setAuthor(string $author) : void 
	{
		$this->author = $author;
	}
	public function getAuthor() : string 
	{
		return $this->author;
	}

	public function setCoverImage(string $image) : void 
	{
		$this->image = $image;
	}
	public function getCoverImage() : string 
	{
		return $this->image;
	}

	public function setDescription(string $description) : void 
	{
	    $this->description = $description;
	}
	public function getDescription(int $length = -1) : string 
	{
	    if ($length > 0) {
	        $description = mb_substr($this->description, 0, $length);
	        if (strlen($this->description) > $length) {
	            $description .= "...";
	        }
	        return $description;
	    }
	    return $this->description;
	}


	
	public function setCreatedAt(string|DateTime $creation_date, string $format = 'Y-m-d H:i:s') : void 
	{
	    if (is_string($creation_date)) {
	        $creation_date = DateTime::createFromFormat($format, $creation_date);
	    }
	    $this->creation_date = $creation_date;
	}
	public function getCreatedAt() : DateTime 
	{
	    return $this->creation_date;
	}
}