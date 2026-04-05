<?php 
/**
 * Vw_print_issuance_slip_1header Page Controller
 * @category  Controller
 */
class Vw_print_issuance_slip_1headerController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "vw_print_issuance_slip_1header";
	}
}
