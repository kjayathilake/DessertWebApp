<?php

class User 
{
	public $id;
	public $username;
	public $password;

	public static function getBySql($sql) 
	{
		// Instantiate database object
		$database = new Database();
		
		// Execute database query
		return $database->executeSql($sql);
	}

	public static function getById($id) 
	{
		// Sanitize user input
		$id = (int)$id;
		
		// Build database query
		$sql = sprintf("select * from users where id = %d limit 1", $id);
		
		// Execute database query
		return self::getBySql($sql);					
	}

	public static function getAll() 
	{
		// Build database query
		$sql = 'select * from users';

		// Execute database query
		return self::getBySql($sql);
	}

	public function insert() 
	{
		// Open database connection
		$database = new Database();

		// Sanitize user input
		$username = $database->sanitizeInput($this->username);
		$password = $database->sanitizeInput($this->password);	

		// Build database query
		$dml = sprintf("insert into users (username, password) values ('%s', '%s')", $username, $password);	

		// Execute statement
		return $database->executeDml($dml);
	}

	public function update() 
	{
		// Open database connection
		$database = new Database();

		// Sanitize user input
		$id = (int)$this->id;
		$username = $database->sanitizeInput($this->username);
		$password = $database->sanitizeInput($this->password);
	
		// Build database query	
		$dml = sprintf("update users set username = '%s', password = '%s' where id = %d", $username, $password, $id);

		// Execute data manipulation
		return $database->executeDml($dml);
	}

	public function delete() 
	{
		// Open database connection
		$database = new Database();

		// Sanitize user input
		$id = (int)$this->id;
		
		// Build database query
		$dml = sprintf("delete from users where id = %d limit 1", $id);

		// Execute data manipulation
		return $database->executeDml($dml);
	}
	
	public function save() 
	{
		// Check object for id
		if (isset($this->id)) 
		{	
			// Return update when id exists
			return $this->update();
			
		} 
		else 
		{
			// Return insert when id does not exists
			return $this->insert();
		}
	}
	
	public function authenticate()
	{

		$sql = sprintf("select * from users where username = '%s' and password = PASSWORD('%s') limit 1", $this->username, $this->password);
		// Execute database query
		$obj = self::getBySql($sql);
		
		return $obj;

	}
}