<?php 
/**
 * Program_item_usage Page Controller
 * @category  Controller
 */
class Program_item_usageController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "program_item_usage";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("program_item_usage.id", 
			"program_item_usage.issuance_id", 
			"program_item_usage.usage_date", 
			"items.item_name AS items_item_name", 
			"items.generic_name AS items_generic_name", 
			"program_item_usage.qty_used", 
			"program_item_usage.remarks", 
			"program_issuance_slips.slip_no AS program_issuance_slips_slip_no", 
			"clients.name AS clients_name", 
			"program_issuance_slips.purpose AS program_issuance_slips_purpose", 
			"batches.expiry_date AS batches_expiry_date");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				program_item_usage.id LIKE ? OR 
				program_item_usage.issuance_id LIKE ? OR 
				program_item_usage.usage_date LIKE ? OR 
				program_item_usage.program_manager_id LIKE ? OR 
				program_item_usage.item_id LIKE ? OR 
				items.item_name LIKE ? OR 
				items.generic_name LIKE ? OR 
				program_item_usage.batch_id LIKE ? OR 
				program_item_usage.qty_used LIKE ? OR 
				program_item_usage.remarks LIKE ? OR 
				program_item_usage.stock_movement_id LIKE ? OR 
				program_item_usage.created_at LIKE ? OR 
				program_item_usage.updated_at LIKE ? OR 
				program_item_usage.encodedby_id LIKE ? OR 
				items.id LIKE ? OR 
				items.item_code LIKE ? OR 
				items.category_id LIKE ? OR 
				items.unit_of_measure LIKE ? OR 
				items.min_stock_level LIKE ? OR 
				items.is_active LIKE ? OR 
				items.created_at LIKE ? OR 
				items.updated_at LIKE ? OR 
				items.deleted_at LIKE ? OR 
				items.is_deleted LIKE ? OR 
				items.encodedby_id LIKE ? OR 
				items.itemname_generic LIKE ? OR 
				batches.id LIKE ? OR 
				batches.item_id LIKE ? OR 
				program_issuance_slips.slip_no LIKE ? OR 
				clients.name LIKE ? OR 
				program_issuance_slips.purpose LIKE ? OR 
				batches.supplier_id LIKE ? OR 
				batches.batch_number LIKE ? OR 
				batches.expiry_date LIKE ? OR 
				batches.received_date LIKE ? OR 
				batches.initial_quantity LIKE ? OR 
				batches.created_at LIKE ? OR 
				batches.updated_at LIKE ? OR 
				batches.deleted_at LIKE ? OR 
				batches.encodedby_id LIKE ? OR 
				batches.is_deleted LIKE ? OR 
				program_issuance_slips.id LIKE ? OR 
				program_issuance_slips.issuance_date LIKE ? OR 
				program_issuance_slips.division LIKE ? OR 
				program_issuance_slips.section LIKE ? OR 
				program_issuance_slips.approvedby_id LIKE ? OR 
				program_issuance_slips.encodedby_id LIKE ? OR 
				program_issuance_slips.created_at LIKE ? OR 
				program_issuance_slips.client_id LIKE ? OR 
				clients.id LIKE ? OR 
				clients.address LIKE ? OR 
				clients.contactnumber LIKE ? OR 
				clients.isactive LIKE ? OR 
				clients.encodedby_id LIKE ? OR 
				clients.created_at LIKE ? OR 
				clients.updated_at LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "program_item_usage/search.php";
		}
		$db->join("items", "program_item_usage.item_id = items.id", "LEFT");
		$db->join("batches", "program_item_usage.batch_id = batches.id", "LEFT");
		$db->join("program_issuance_slips", "program_item_usage.issuance_id = program_issuance_slips.id", "LEFT");
		$db->join("clients", "program_issuance_slips.client_id = clients.id", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("program_item_usage.id", ORDER_TYPE);
		}
		$db->where("program_item_usage.encodedby_id='".USER_ID."'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Program Item Usage";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("program_item_usage/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("program_item_usage.id", 
			"program_item_usage.program_manager_id", 
			"program_item_usage.item_id", 
			"program_item_usage.batch_id", 
			"program_item_usage.qty_used", 
			"program_item_usage.usage_date", 
			"program_item_usage.remarks", 
			"program_item_usage.stock_movement_id", 
			"program_item_usage.created_at", 
			"program_item_usage.updated_at", 
			"program_item_usage.issuance_id", 
			"program_item_usage.encodedby_id", 
			"items.id AS items_id", 
			"items.item_code AS items_item_code", 
			"items.item_name AS items_item_name", 
			"items.generic_name AS items_generic_name", 
			"items.category_id AS items_category_id", 
			"items.unit_of_measure AS items_unit_of_measure", 
			"items.min_stock_level AS items_min_stock_level", 
			"items.is_active AS items_is_active", 
			"items.created_at AS items_created_at", 
			"items.updated_at AS items_updated_at", 
			"items.deleted_at AS items_deleted_at", 
			"items.is_deleted AS items_is_deleted", 
			"items.encodedby_id AS items_encodedby_id", 
			"items.itemname_generic AS items_itemname_generic", 
			"batches.id AS batches_id", 
			"batches.item_id AS batches_item_id", 
			"batches.supplier_id AS batches_supplier_id", 
			"batches.batch_number AS batches_batch_number", 
			"batches.expiry_date AS batches_expiry_date", 
			"batches.received_date AS batches_received_date", 
			"batches.initial_quantity AS batches_initial_quantity", 
			"batches.created_at AS batches_created_at", 
			"batches.updated_at AS batches_updated_at", 
			"batches.deleted_at AS batches_deleted_at", 
			"batches.encodedby_id AS batches_encodedby_id", 
			"batches.is_deleted AS batches_is_deleted", 
			"program_issuance_slips.id AS program_issuance_slips_id", 
			"program_issuance_slips.slip_no AS program_issuance_slips_slip_no", 
			"program_issuance_slips.issuance_date AS program_issuance_slips_issuance_date", 
			"program_issuance_slips.division AS program_issuance_slips_division", 
			"program_issuance_slips.section AS program_issuance_slips_section", 
			"program_issuance_slips.purpose AS program_issuance_slips_purpose", 
			"program_issuance_slips.approvedby_id AS program_issuance_slips_approvedby_id", 
			"program_issuance_slips.encodedby_id AS program_issuance_slips_encodedby_id", 
			"program_issuance_slips.created_at AS program_issuance_slips_created_at", 
			"program_issuance_slips.client_id AS program_issuance_slips_client_id", 
			"clients.id AS clients_id", 
			"clients.name AS clients_name", 
			"clients.address AS clients_address", 
			"clients.contactnumber AS clients_contactnumber", 
			"clients.isactive AS clients_isactive", 
			"clients.encodedby_id AS clients_encodedby_id", 
			"clients.created_at AS clients_created_at", 
			"clients.updated_at AS clients_updated_at");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("program_item_usage.id", $rec_id);; //select record based on primary key
		}
		$db->join("items", "program_item_usage.item_id = items.id", "LEFT ");
		$db->join("batches", "program_item_usage.batch_id = batches.id", "LEFT ");
		$db->join("program_issuance_slips", "program_item_usage.issuance_id = program_issuance_slips.id", "LEFT ");
		$db->join("clients", "program_issuance_slips.client_id = clients.id", "LEFT ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Program Item Usage";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("program_item_usage/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("issuance_id","usage_date","program_manager_id","item_id","batch_id","qty_used","remarks","stock_movement_id","encodedby_id");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'issuance_id' => 'required|numeric',
				'usage_date' => 'required',
				'program_manager_id' => 'required',
				'item_id' => 'required',
				'batch_id' => 'required',
				'qty_used' => 'required|numeric',
				'remarks' => 'required',
				'stock_movement_id' => 'required',
				'encodedby_id' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'issuance_id' => 'sanitize_string',
				'usage_date' => 'sanitize_string',
				'program_manager_id' => 'sanitize_string',
				'item_id' => 'sanitize_string',
				'batch_id' => 'sanitize_string',
				'qty_used' => 'sanitize_string',
				'remarks' => 'sanitize_string',
				'stock_movement_id' => 'sanitize_string',
				'encodedby_id' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("program_item_usage");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Program Item Usage";
		$this->render_view("program_item_usage/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","issuance_id","usage_date","program_manager_id","item_id","batch_id","qty_used","remarks","stock_movement_id","encodedby_id");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'issuance_id' => 'required|numeric',
				'usage_date' => 'required',
				'program_manager_id' => 'required',
				'item_id' => 'required',
				'batch_id' => 'required',
				'qty_used' => 'required|numeric',
				'remarks' => 'required',
				'stock_movement_id' => 'required',
				'encodedby_id' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'issuance_id' => 'sanitize_string',
				'usage_date' => 'sanitize_string',
				'program_manager_id' => 'sanitize_string',
				'item_id' => 'sanitize_string',
				'batch_id' => 'sanitize_string',
				'qty_used' => 'sanitize_string',
				'remarks' => 'sanitize_string',
				'stock_movement_id' => 'sanitize_string',
				'encodedby_id' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("program_item_usage.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("program_item_usage");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("program_item_usage");
					}
				}
			}
		}
		$db->where("program_item_usage.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Program Item Usage";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("program_item_usage/edit.php", $data);
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
		$fields = $this->fields = array("id","issuance_id","usage_date","program_manager_id","item_id","batch_id","qty_used","remarks","stock_movement_id","encodedby_id");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'issuance_id' => 'required|numeric',
				'usage_date' => 'required',
				'program_manager_id' => 'required',
				'item_id' => 'required',
				'batch_id' => 'required',
				'qty_used' => 'required|numeric',
				'remarks' => 'required',
				'stock_movement_id' => 'required',
				'encodedby_id' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'issuance_id' => 'sanitize_string',
				'usage_date' => 'sanitize_string',
				'program_manager_id' => 'sanitize_string',
				'item_id' => 'sanitize_string',
				'batch_id' => 'sanitize_string',
				'qty_used' => 'sanitize_string',
				'remarks' => 'sanitize_string',
				'stock_movement_id' => 'sanitize_string',
				'encodedby_id' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("program_item_usage.id", $rec_id);;
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
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("program_item_usage.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("program_item_usage");
	}
}
