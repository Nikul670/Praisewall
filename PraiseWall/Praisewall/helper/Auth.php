<?php

define(ERR_USER_DO_NOT_EXISTS, -1);
define(ERR_USER_NAME_PASSWORD_DO_NOT_MATCH, -2);

$GLOBALS["login_error_responses"] = 
array(
		ERR_USER_DO_NOT_EXISTS => 'Incorrect Username/Password entered',
		ERR_USER_NAME_PASSWORD_DO_NOT_MATCH => 'Incorrect Username/Password entered'
);	

$GLOBALS["login_error_keys"] = 
array (
		ERR_USER_DO_NOT_EXISTS => 'ERR_USER_DO_NOT_EXISTS',
		ERR_USER_NAME_PASSWORD_DO_NOT_MATCH => 'ERR_USER_NAME_PASSWORD_DO_NOT_MATCH'
);

/**
 * Handles registration and login of users.
 ***
 */
class Auth {

	public $logged_in = false;
	public $username = 'Guest';
	public $email = 'sample_email';
	public $userid = '-1';
	
	private $can_proceed = true;
	
	private $db;
	private $type;
	private static $instance;

	private $logged_in_id;

	private $logger;
	
	public static function getInstance(){
		
		if (!Auth::$instance) {
			Auth::$instance = new Auth();
		}
		
		return Auth::$instance;
	}

	public static function destroy(){

		Auth::$instance = null;
	}

	/**
	 * CONSTRUCTOR
	 */
	public function __construct() {
		
		global $urlParser, $logger;
		
		$this->db = new Dbase('pwall');
		$this->logger = &$logger;
		
		$this->postLoginSetup();	
	}
	
	/**
	 * tells that it can continue execution
	 * @return boolean
	 */
	public function canProceed(){

		return $this->can_proceed;
	}
	
	/**
	 * Loads the user info in session
	 * 
	 * @param unknown_type $user_id
	 * @param unknown_type $username
	 * @param unknown_type $email
	 */
	private function setUserDetails( $user_id, $username, $email ){

		$this->logged_in = true;
		$this->email = $email;
		$this->userid = $user_id;
		$this->username = $username;
			
		$this->loadLoggedInId();
		$this->getUserDataByID();
	}

	public function postLoginSetup(){

		$email = $user_id = $username = null;
		
		if( isset( $_SESSION['logged_in'] ) ){
			
			$this->logger->debug( "Auth: USING SESSION" );
			
			$email = $_SESSION['email']; 
			$user_id = $_SESSION['userid'];
			$username = $_SESSION['username']; 
		}
		
		$this->logger->debug( "Auth: SESSION".print_r($_SESSION,true));
				
		if( $user_id )
			$this->setUserDetails( $user_id, $username, $email );
	}

	/**
	 * @param unknown_type $user_id
	 * @param unknown_type $username
	 * @param unknown_type $email
	 */
	private function reloadSessionValues( $user_id, $username, $email ){
		
		$_SESSION['logged_in'] = true;
		$_SESSION['email'] = $email; 
		$_SESSION['userid'] = $user_id;
		$_SESSION['username'] = $username; 
		$_SESSION['logged_in_id'] = $this->logged_in_id;
	}
	
	/**
	 * loads the loggable user id
	 */
	private function loadLoggedInId(){
		
	}

	private function clearSessionValues(){
		
		$this->logged_in = false;
		$_SESSION['logged_in'] = false;
		$this->username = null;
		$_SESSION['username'] = null;
		$this->userid = null;
		$_SESSION['userid'] = null;
		$this->id = null;
		$_SESSION['logged_in_id'] = null;
	} 
	
	/**
	 * Returns the message attached to the code
	 * @param unknown_type $err_code
	 */
	public function getResponseErrorMessage( $err_code ) {
		
		global $login_error_responses;
		
		if ($err_code > 0) 
			return "Login Successfully";
			
		return $login_error_responses[$err_code];
	}
	
	/**
	 * Returns the key for the error
	 * 
	 * @param unknown_type $err_code
	 */
	public function getResponseErrorKey($err_code) {
		
		global $login_error_keys;
		
		if ($err_code > 0) 
			$err_code = LOGIN_SUCCESS;
			
		return $login_error_keys[$err_code];
	}
	
	/**
	 * Enable login through username and password
	 * 
	 * We will be allowing login by an email
	 * 
	 */
	function login( $username, $password ) {
		
		$md5 = md5($password);
		return $this->loginPwdHash($username, $md5);
	}
	
	public function loginPwdHash( $username, $passwordHash){
		
		try{
			
			if(trim($username) === "") return ERR_USER_DO_NOT_EXISTS;
			
			global $urlParser;
			
			$this->logger->debug("Trying to log in the system: $username ");
			
			// @TODO: Implementation
				
		}catch( Exception $e ){
			
			$this->logger->error( " Message thrown ".$e->getMessage() );
			return ERR_USER_DO_NOT_EXISTS;
		}
	}
	
	/**
	 * check if user id logged in or not.
	 */
	public function isLoggedIn(){
		return $this->logged_in;
	}
}
?>
