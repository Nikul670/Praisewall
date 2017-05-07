<?php

/*
*
* -------------------------------------------------------
* CLASSNAME:        User
* FOR MYSQL DB:     pwall
*
*/

//**********************
// CLASS DECLARATION
//**********************

class UserModel
{


	// **********************
	// ATTRIBUTE DECLARATION
	// **********************

	protected $user_id;   // KEY ATTR. WITH AUTOINCREMENT

	protected $username;
	protected $email;
	protected $password;
	protected $user_source;
	protected $user_source_uid;
	protected $role;
	protected $is_active;
	protected $created_on;
	protected $last_modified_on;

	protected $database; // Instance of class database

	protected $table = 'users';

	protected $logger;
	
	//**********************
	// CONSTRUCTOR METHOD
	//**********************

	function UserModel()
	{	
		global $logger;
		
		$this->logger = $logger;
		$this->database = new Dbase('pwall');
	}


	// **********************
	// GETTER METHODS
	// **********************


	function getUserId()
	{	
		return $this->user_id;
	}

	function getUserName()
	{	
		return $this->username;
	}

	function getEmail()
	{	
		return $this->email;
	}

	function getPassword()
	{	
		return $this->password;
	}

	function getUserSource()
	{	
		return $this->user_source;
	}

	function getUserSourceUid()
	{	
		return $this->user_source_uid;
	}

	function getRole()
	{	
		return $this->role;
	}

	function getIsActive()
	{	
		return $this->is_active;
	}

	function getCreatedOn()
	{	
		return $this->created_on;
	}

	function getLastModifiedOn()
	{	
		return $this->last_updated_on;
	}
	
	// **********************
	// SETTER METHODS
	// **********************

	function setUserId( $id )
	{
		$this->user_id =  $id;
	}

	function setUserName($username)
	{	
		$this->username = $username;
	}

	function setEmail($email)
	{	
		$this->email = $email;
	}

	function setPassword($password)
	{	
		$this->password = $password;
	}

	function setUserSource($user_source)
	{	
		$this->user_source = $user_source;
	}

	function setUserSourceUid($user_source_uid)
	{	
		$this->user_source_uid = $user_source_uid;
	}

	function setRole($role)
	{	
		$this->role = $role;
	}

	function setIsActive($is_active)
	{	
		$this->is_active = $is_active;
	}

	function setCreatedOn($created_on)
	{	
		$this->created_on = $created_on;
	}

	function setLastModifiedOn($last_modified_on)
	{	
		$this->last_modified_on = $last_modified_on;
	}

	// **********************
	// SELECT METHOD / LOAD
	// **********************

	function load( $id )
	{
		$sql =  "SELECT * FROM users WHERE user_id = $id";
		$row =  $this->database->query_firstrow( $sql );
		
		$this->user_id = $row['user_id'];
		$this->username = $row['username'];
		$this->email = $row['email'];
		$this->password = $row['password'];
		$this->user_source = $row['user_source'];
		$this->user_source_uid = $row['user_source_uid'];
		$this->role = $row['role'];
		$this->is_active = $row['is_active'];
		$this->created_on = $row['created_on'];
		$this->last_modified_on = $row['last_modified_on'];
	}

	// **********************
	// INSERT
	// **********************

	function insert()
	{

		$this->user_id = ""; // clear key for autoincrement

		$sql =  "

			INSERT INTO users 
			( 
				username,
				email,
				password,
				user_source,
				user_source_uid,
				role,
				is_active,
				created_on,
			) 
			VALUES 
			( 
				'$this->user_id',
				'$this->username',
				'$this->email',
				'$this->password',
				'$this->user_source',
				'$this->user_source_uid',
				'$this->role',
				'$this->is_active',
				'$this->created_on'
			)";
		
		$this->user_id = $this->database->insert( $sql );
		 
		return $this->user_id;
	}
	
	/**
	*
	*@param $id
	*/
	function update( $id )
	{
		$sql = " 
			UPDATE users 
			SET  
				username = '$this->username',
				email = '$this->email',
				password = '$this->password',
				user_source = '$this->user_source',
				user_source_uid = '$this->user_source_uid',
				role = '$this->role',
				is_active = '$this->is_active'
			WHERE user_id = $id";

		$result = $this->database->update($sql);
		
		return $result;
	}
	
	/**
	*
	*Returns the hash array for the object
	*
	*/
	function getHash(){

		$hash = array();
 
		$hash['user_id'] = $this->user_id;
		$hash['username'] = $this->username;
		$hash['password'] = $this->password;
		$hash['email'] = $this->email;
		$hash['user_source'] = $this->user_source;
		$hash['user_source_uid'] = $this->user_source_uid;
		$hash['role'] = $this->role;
		$hash['is_active'] = $this->is_active;
		$hash['created_on'] = $this->created_on;
		$hash['last_modified_on'] = $this->last_modified_on;

		return $hash;
	}
}
?>
