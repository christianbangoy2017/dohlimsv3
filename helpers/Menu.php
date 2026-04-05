<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Dashboard', 
			'icon' => ''
		),
		
		array(
			'path' => 'home', 
			'label' => 'Transactions', 
			'icon' => ''
		),
		
		array(
			'path' => 'batches', 
			'label' => 'Batches', 
			'icon' => '<i class="material-icons ">today</i>'
		),
		
		array(
			'path' => 'vw_stock_movements_at_program', 
			'label' => 'Program Items On Hand', 
			'icon' => '<i class="material-icons ">inbox</i>'
		),
		
		array(
			'path' => 'program_issuance_slips', 
			'label' => 'Program Issuance Slips', 
			'icon' => '<i class="material-icons ">receipt</i>'
		),
		
		array(
			'path' => 'program_item_usage', 
			'label' => 'Program Item Usage', 
			'icon' => '<i class="material-icons ">pie_chart</i>'
		),
		
		array(
			'path' => 'stock_movements', 
			'label' => 'Stock Movements', 
			'icon' => '<i class="material-icons ">shopping_cart</i>','submenu' => array(
		array(
			'path' => 'stock_movements/Index', 
			'label' => 'List', 
			'icon' => '<i class="material-icons ">shopping_cart</i>'
		),
		
		array(
			'path' => 'vw_stock_movements_at_program', 
			'label' => 'At Program Managers', 
			'icon' => '<i class="material-icons ">supervisor_account</i>'
		),
		
		array(
			'path' => 'stock_movements_reasons', 
			'label' => 'Settings Reasons', 
			'icon' => '<i class="material-icons ">settings</i>'
		)
	)
		),
		
		array(
			'path' => 'home', 
			'label' => 'References', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'home/Index', 
			'label' => 'References', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'items', 
			'label' => 'Items', 
			'icon' => '<i class="material-icons ">shopping_basket</i>'
		),
		
		array(
			'path' => 'categories', 
			'label' => 'Categories', 
			'icon' => '<i class="material-icons ">book</i>'
		),
		
		array(
			'path' => 'locations', 
			'label' => 'Locations', 
			'icon' => '<i class="material-icons ">map</i>'
		),
		
		array(
			'path' => 'suppliers', 
			'label' => 'Suppliers', 
			'icon' => '<i class="material-icons ">perm_contact_calendar</i>'
		),
		
		array(
			'path' => 'clients', 
			'label' => 'Clients', 
			'icon' => '<i class="material-icons ">person_add</i>'
		),
		
		array(
			'path' => 'home', 
			'label' => 'Administrator', 
			'icon' => ''
		),
		
		array(
			'path' => 'users', 
			'label' => 'Users', 
			'icon' => '<i class="material-icons ">account_circle</i>'
		),
		
		array(
			'path' => 'program_sections', 
			'label' => 'Program Sections', 
			'icon' => ''
		)
	);
		
	
	
			public static $movement_type = array(
		array(
			"value" => "IN", 
			"label" => "IN", 
		),
		array(
			"value" => "OUT", 
			"label" => "OUT", 
		),
		array(
			"value" => "ADJUSTMENT", 
			"label" => "ADJUSTMENT", 
		),);
		
			public static $role = array(
		array(
			"value" => "PROGRAM_MANAGER", 
			"label" => "PROGRAM_MANAGER", 
		),
		array(
			"value" => "ADMIN", 
			"label" => "ADMIN", 
		),);
		
			public static $account_status = array(
		array(
			"value" => "Approved", 
			"label" => "Approved", 
		),
		array(
			"value" => "Pending", 
			"label" => "Pending", 
		),
		array(
			"value" => "Blocked", 
			"label" => "Blocked", 
		),);
		
			public static $issuance_date = array(
		array(
			"value" => "Assistant Regional Director (ARD)", 
			"label" => "Assistant Regional Director (ARD)", 
		),
		array(
			"value" => "Management Support Division (MSD)", 
			"label" => "Management Support Division (MSD)", 
		),
		array(
			"value" => "Local Health Support Division (LHSD)", 
			"label" => "Local Health Support Division (LHSD)", 
		),);
		
			public static $isactive = array(
		array(
			"value" => "1", 
			"label" => "Active", 
		),
		array(
			"value" => "0", 
			"label" => "Disabled", 
		),);
		
}