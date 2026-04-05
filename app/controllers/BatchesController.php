<?php 
/**
 * Batches Page Controller
 * @category  Controller
 */
class BatchesController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "batches";
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
		$fields = array("batches.id", 
			"batches.item_id", 
			"batches.received_date", 
			"batches.batch_number", 
			"suppliers.supplier_name AS suppliers_supplier_name", 
			"items.item_name AS items_item_name", 
			"items.generic_name AS items_generic_name", 
			"batches.unit_cost", 
			"batches.initial_quantity", 
			"batches.encodedby_id", 
			"batches_remaining.remainingqty AS batches_remaining_remainingqty", 
			"batches.unit_total");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				batches.id LIKE ? OR 
				batches.item_id LIKE ? OR 
				batches.received_date LIKE ? OR 
				batches.batch_number LIKE ? OR 
				suppliers.supplier_name LIKE ? OR 
				items.item_name LIKE ? OR 
				items.generic_name LIKE ? OR 
				batches.unit_cost LIKE ? OR 
				batches.initial_quantity LIKE ? OR 
				batches.supplier_id LIKE ? OR 
				batches.expiry_date LIKE ? OR 
				batches.created_at LIKE ? OR 
				batches.updated_at LIKE ? OR 
				batches.deleted_at LIKE ? OR 
				batches.encodedby_id LIKE ? OR 
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
				suppliers.id LIKE ? OR 
				suppliers.contact_person LIKE ? OR 
				suppliers.contact_number LIKE ? OR 
				suppliers.email LIKE ? OR 
				suppliers.address LIKE ? OR 
				suppliers.supplier_type LIKE ? OR 
				suppliers.is_active LIKE ? OR 
				suppliers.created_at LIKE ? OR 
				suppliers.updated_at LIKE ? OR 
				suppliers.deleted_at LIKE ? OR 
				suppliers.is_deleted LIKE ? OR 
				suppliers.encodedby_id LIKE ? OR 
				batches_remaining.batch_id LIKE ? OR 
				batches_remaining.remainingqty LIKE ? OR 
				batches_remaining.last_updated LIKE ? OR 
				batches.is_deleted LIKE ? OR 
				batches.unit_total LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "batches/search.php";
		}
		$db->join("items", "batches.item_id = items.id", "LEFT");
		$db->join("suppliers", "batches.supplier_id = suppliers.id", "LEFT");
		$db->join("batches_remaining", "batches.id = batches_remaining.batch_id", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("received_date", "DESC");
		}
		$allowed_roles = array ('program_manager', 'admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("batches.encodedby_id", get_active_user('id') );
		}
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
		$page_title = $this->view->page_title = "Batches";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("batches/list.php", $data); //render the full page
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
		$fields = array("batches.id", 
			"batches.received_date", 
			"batches.batch_number", 
			"suppliers.supplier_name AS suppliers_supplier_name", 
			"items.item_name AS items_item_name", 
			"items.generic_name AS items_generic_name", 
			"batches.initial_quantity", 
			"batches.unit_cost", 
			"batches.expiry_date", 
			"batches.item_id", 
			"batches.encodedby_id", 
			"batches.unit_total");
		$allowed_roles = array ('program_manager', 'admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("batches.encodedby_id", get_active_user('id') );
		}
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("batches.id", $rec_id);; //select record based on primary key
		}
		$db->join("items", "batches.item_id = items.id", "LEFT ");
		$db->join("suppliers", "batches.supplier_id = suppliers.id", "LEFT ");
		$db->join("batches_remaining", "batches.id = batches_remaining.batch_id", "LEFT ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['expiry_date'] = format_date($record['expiry_date'],'m-d-Y');
			$page_title = $this->view->page_title = "View  Batches";
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
		return $this->render_view("batches/view.php", $record);
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
			$fields = $this->fields = array("received_date","item_id","supplier_id","batch_number","expiry_date","initial_quantity","encodedby_id","unit_cost","unit_total");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'received_date' => 'required',
				'item_id' => 'required',
				'supplier_id' => 'required',
				'batch_number' => 'required',
				'expiry_date' => 'required',
				'initial_quantity' => 'required|numeric',
				'encodedby_id' => 'required',
				'unit_total' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'received_date' => 'sanitize_string',
				'item_id' => 'sanitize_string',
				'supplier_id' => 'sanitize_string',
				'batch_number' => 'sanitize_string',
				'expiry_date' => 'sanitize_string',
				'initial_quantity' => 'sanitize_string',
				'encodedby_id' => 'sanitize_string',
				'unit_cost' => 'sanitize_string',
				'unit_total' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['created_at'] = datetime_now();
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("batches");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Batches";
		$this->render_view("batches/add.php");
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
		$fields = $this->fields = array("id","received_date","item_id","supplier_id","batch_number","expiry_date","initial_quantity","encodedby_id","unit_cost","unit_total");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'received_date' => 'required',
				'item_id' => 'required',
				'supplier_id' => 'required',
				'batch_number' => 'required',
				'expiry_date' => 'required',
				'initial_quantity' => 'required|numeric',
				'encodedby_id' => 'required',
				'unit_total' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'received_date' => 'sanitize_string',
				'item_id' => 'sanitize_string',
				'supplier_id' => 'sanitize_string',
				'batch_number' => 'sanitize_string',
				'expiry_date' => 'sanitize_string',
				'initial_quantity' => 'sanitize_string',
				'encodedby_id' => 'sanitize_string',
				'unit_cost' => 'sanitize_string',
				'unit_total' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['updated_at'] = datetime_now();
			if($this->validated()){
		$allowed_roles = array ('program_manager', 'admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("batches.encodedby_id", get_active_user('id') );
		}
				$db->where("batches.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("batches");
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
						return	$this->redirect("batches");
					}
				}
			}
		}
		$allowed_roles = array ('program_manager', 'admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("batches.encodedby_id", get_active_user('id') );
		}
		$db->where("batches.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Batches";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("batches/edit.php", $data);
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
		$fields = $this->fields = array("id","received_date","item_id","supplier_id","batch_number","expiry_date","initial_quantity","encodedby_id","unit_cost","unit_total");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'received_date' => 'required',
				'item_id' => 'required',
				'supplier_id' => 'required',
				'batch_number' => 'required',
				'expiry_date' => 'required',
				'initial_quantity' => 'required|numeric',
				'encodedby_id' => 'required',
				'unit_total' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'received_date' => 'sanitize_string',
				'item_id' => 'sanitize_string',
				'supplier_id' => 'sanitize_string',
				'batch_number' => 'sanitize_string',
				'expiry_date' => 'sanitize_string',
				'initial_quantity' => 'sanitize_string',
				'encodedby_id' => 'sanitize_string',
				'unit_cost' => 'sanitize_string',
				'unit_total' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['updated_at'] = datetime_now();
			if($this->validated()){
		$allowed_roles = array ('program_manager', 'admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("batches.encodedby_id", get_active_user('id') );
		}
				$db->where("batches.id", $rec_id);;
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
		$db->where("batches.id", $arr_rec_id, "in");
		$allowed_roles = array ('program_manager', 'admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("batches.encodedby_id", get_active_user('id') );
		}
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("batches");
	}
}
