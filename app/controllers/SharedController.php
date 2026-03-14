<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * batches_item_id_option_list Model Action
     * @return array
     */
	function batches_item_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,item_name AS label FROM items ORDER BY item_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * batches_supplier_id_option_list Model Action
     * @return array
     */
	function batches_supplier_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,supplier_name AS label FROM suppliers ORDER BY supplier_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * items_category_id_option_list Model Action
     * @return array
     */
	function items_category_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM categories ORDER BY name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * items_unit_of_measure_option_list Model Action
     * @return array
     */
	function items_unit_of_measure_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT unit_of_measure AS value,unit_of_measure AS label FROM items ORDER BY unit_of_measure ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * stock_movements_movement_type_option_list Model Action
     * @return array
     */
	function stock_movements_movement_type_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT movement_type AS value,movement_type AS label FROM stock_movements ORDER BY movement_type ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * stock_movements_batch_id_option_list Model Action
     * @return array
     */
	function stock_movements_batch_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT
DISTINCT b.id AS value,
concat(i.item_name,' :', batch_number) AS label
FROM batches b
  INNER JOIN items i on b.item_id=i.id
 ORDER BY received_date DESC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * stock_movements_movement_reason_id_option_list Model Action
     * @return array
     */
	function stock_movements_movement_reason_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,reason_code AS label FROM stock_movements_reasons";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * stock_movements_source_location_id_option_list Model Action
     * @return array
     */
	function stock_movements_source_location_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT location_name AS value,location_name AS label FROM locations ORDER BY location_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * stock_movements_destination_pm_id_option_list Model Action
     * @return array
     */
	function stock_movements_destination_pm_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value, upper(concat(program_name,'-',last_name,' ',first_name)) AS label FROM users WHERE role='PROGRAM_MANAGER'
ORDER BY program_name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * stock_movements_encodedby_id_option_list Model Action
     * @return array
     */
	function stock_movements_encodedby_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,id AS label FROM users";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * users_username_value_exist Model Action
     * @return array
     */
	function users_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * users_email_value_exist Model Action
     * @return array
     */
	function users_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * program_item_usage_issuance_id_option_list Model Action
     * @return array
     */
	function program_item_usage_issuance_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT i.id AS value,
concat(slip_no,'; ', name) AS label
FROM program_issuance_slips i
  inner join clients c on i.client_id =c.id
ORDER BY i.id DESC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_item_usage_usage_date_option_list Model Action
     * @return array
     */
	function program_item_usage_usage_date_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT stock_movement_id AS value , stock_movement_id AS label FROM program_item_usage ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_item_usage_qty_used_option_list Model Action
     * @return array
     */
	function program_item_usage_qty_used_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT stock_movement_id AS value , stock_movement_id AS label FROM program_item_usage ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_item_usage_program_issuance_slips_slip_no_option_list Model Action
     * @return array
     */
	function program_item_usage_program_issuance_slips_slip_no_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT slip_no AS value,slip_no AS label FROM program_issuance_slips ORDER BY slip_no DESC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_item_usage_item_id_option_list Model Action
     * @return array
     */
	function program_item_usage_item_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,item_name AS label FROM items";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_item_usage_batch_id_option_list Model Action
     * @return array
     */
	function program_item_usage_batch_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT s.batch_id AS value, upper(concat(s.item_name,'; ',lpad(s.item_code,10,' '),' QTY: ', b.remainingqty,'; expiry_date: ', s.expiry_date)) label FROM vw_stock_movements_at_program s INNER JOIN batches_remaining b ON s.batch_id=b.batch_id Order By s.item_name";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_item_balance_stock_movement_id_option_list Model Action
     * @return array
     */
	function program_item_balance_stock_movement_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT stock_movement_id AS value , stock_movement_id AS label FROM program_item_usage ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_issuance_slips_section_option_list Model Action
     * @return array
     */
	function program_issuance_slips_section_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT description AS value,description AS label FROM program_sections ORDER BY description ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_issuance_slips_approvedby_id_option_list Model Action
     * @return array
     */
	function program_issuance_slips_approvedby_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value, fullname AS label FROM users ORDER BY fullname ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_issuance_slips_slip_no_option_list Model Action
     * @return array
     */
	function program_issuance_slips_slip_no_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT slip_no AS value,slip_no AS label FROM program_issuance_slips ORDER BY slip_no DESC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * program_issuance_slips_client_id_option_list Model Action
     * @return array
     */
	function program_issuance_slips_client_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM clients ORDER BY name ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_issuanceslips Model Action
     * @return Value
     */
	function getcount_issuanceslips(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM program_issuance_slips";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_clients Model Action
     * @return Value
     */
	function getcount_clients(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM clients";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_items Model Action
     * @return Value
     */
	function getcount_items(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM items";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_batches Model Action
     * @return Value
     */
	function getcount_batches(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM batches";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_suppliers Model Action
     * @return Value
     */
	function getcount_suppliers(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM suppliers";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_users Model Action
     * @return Value
     */
	function getcount_users(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM users";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_itemonhand Model Action
     * @return Value
     */
	function getcount_itemonhand(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM vw_stock_movements_at_program";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_itembalance Model Action
     * @return Value
     */
	function getcount_itembalance(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM program_item_balance";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
