<?php 
/**
 * Program_item_balance Page Controller
 * @category  Controller
 */
class Program_item_balanceController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "program_item_balance";
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("stock_movement_id","initialqty","total_used","remainingqty");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'stock_movement_id' => 'required',
				'initialqty' => 'required|numeric',
				'total_used' => 'required|numeric',
				'remainingqty' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'stock_movement_id' => 'sanitize_string',
				'initialqty' => 'sanitize_string',
				'total_used' => 'sanitize_string',
				'remainingqty' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("program_item_balance.stock_movement_id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
}
