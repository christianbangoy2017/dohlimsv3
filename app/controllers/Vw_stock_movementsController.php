<?php 
/**
 * Vw_stock_movements Page Controller
 * @category  Controller
 */
class Vw_stock_movementsController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "vw_stock_movements";
	}
}
