<?php 
/**
 * Vw_stock_movements_at_program Page Controller
 * @category  Controller
 */
class Vw_stock_movements_at_programController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "vw_stock_movements_at_program";
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
		$fields = array("vw_stock_movements_at_program.id", 
			"vw_stock_movements_at_program.transaction_date", 
			"vw_stock_movements_at_program.item_id", 
			"vw_stock_movements_at_program.item_code", 
			"vw_stock_movements_at_program.item_name", 
			"vw_stock_movements_at_program.initialqty", 
			"vw_stock_movements_at_program.unit_of_measure", 
			"vw_stock_movements_at_program.unit_cost", 
			"vw_stock_movements_at_program.unit_total", 
			"program_item_balance.total_used AS program_item_balance_total_used", 
			"program_item_balance.remainingqty AS program_item_balance_remainingqty", 
			"vw_stock_movements_at_program.expiry_date", 
			"vw_stock_movements_at_program.movement_type", 
			"vw_stock_movements_at_program.reason_code", 
			"vw_stock_movements_at_program.program_manager_id", 
			"vw_stock_movements_at_program.batch_id", 
			"program_item_balance.last_updated AS program_item_balance_last_updated");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				vw_stock_movements_at_program.id LIKE ? OR 
				vw_stock_movements_at_program.transaction_date LIKE ? OR 
				vw_stock_movements_at_program.item_id LIKE ? OR 
				vw_stock_movements_at_program.item_code LIKE ? OR 
				vw_stock_movements_at_program.item_name LIKE ? OR 
				vw_stock_movements_at_program.initialqty LIKE ? OR 
				vw_stock_movements_at_program.unit_of_measure LIKE ? OR 
				vw_stock_movements_at_program.unit_cost LIKE ? OR 
				vw_stock_movements_at_program.unit_total LIKE ? OR 
				program_item_balance.total_used LIKE ? OR 
				program_item_balance.remainingqty LIKE ? OR 
				vw_stock_movements_at_program.expiry_date LIKE ? OR 
				vw_stock_movements_at_program.movement_type LIKE ? OR 
				vw_stock_movements_at_program.reason_code LIKE ? OR 
				vw_stock_movements_at_program.encodedby_id LIKE ? OR 
				vw_stock_movements_at_program.program_manager_id LIKE ? OR 
				vw_stock_movements_at_program.batch_id LIKE ? OR 
				program_item_balance.stock_movement_id LIKE ? OR 
				program_item_balance.initialqty LIKE ? OR 
				program_item_balance.last_updated LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "vw_stock_movements_at_program/search.php";
		}
		$db->join("program_item_balance", "vw_stock_movements_at_program.id = program_item_balance.stock_movement_id", "LEFT");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("program_item_balance_last_updated", "DESC");
		}
		$db->where("encodedby_id='".USER_ID."'");
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
		$page_title = $this->view->page_title = "Vw Stock Movements At Program";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("vw_stock_movements_at_program/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
}
