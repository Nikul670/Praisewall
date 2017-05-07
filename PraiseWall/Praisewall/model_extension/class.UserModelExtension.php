<?php
include_once 'base_model/class.UserModel.php';
/**
 *
 * @author nikul
 *
 *This class extends the User Model.
 * 
 * In this class user level extra db queries will be included
 */
class UserModelExtension extends UserModel{
	
	/**
	 * CONSTRUCTOR
	 */
	public function __construct( ){

		parent::UserModel();
	}
}
?>
