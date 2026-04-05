<?php 
/**
 * Vw_users_program Page Controller
 * @category  Controller
 */
class Vw_users_programController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "vw_users_program";
	}
}
