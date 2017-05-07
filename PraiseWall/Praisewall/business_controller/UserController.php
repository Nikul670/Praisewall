<?php 

include_once 'model_extension/class.UserModelExtension.php';
include_once 'business_controller/BaseController.php';

/** 
 * The User Controller will handle the 
 * creatiion of users
 * password change
 * and other user level functionalities
 * Username/password creation 
 * 
 * @author nikul
 */
class UserController extends BaseController{
	
	private $type;
	private $UserModel;
		
	public function __construct(){

		parent::__construct();
		
		$this->type  = 'WEB_USER';
		$this->UserModel = new UserModelExtension();
	}

	/**
	 * returns the user id of newly created users
	 */
	public function getUserId(){
		
		return $this->UserModel->getUserId();
	}
	
	/**
	 * returns the user id of newly created users
	 */
	public function load($user_id){
		
		$this->UserModel->load($user_id);
		return $this->UserModel->getHash();
	}
	
	/**
	 * @TODO Implementation pending
	 */
	public function addUser( array $user_details ){		
		extract( $user_details );
	}
	
	
	/**
	 * @TODO Implementation pending
	 */
	public function updateUser( $user_id, array $user_details ){
		
		extract( $user_details );
	}	
}
?>
