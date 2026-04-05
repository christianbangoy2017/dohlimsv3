<?php 
/**
 * Vw_print_issuance_slip_no Page Controller
 * @category  Controller
 */
class Vw_print_issuance_slip_noController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "vw_print_issuance_slip_no";
	}
}
