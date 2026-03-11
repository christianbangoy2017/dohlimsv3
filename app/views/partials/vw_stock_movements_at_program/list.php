<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("vw_stock_movements_at_program/add");
$can_edit = ACL::is_allowed("vw_stock_movements_at_program/edit");
$can_view = ACL::is_allowed("vw_stock_movements_at_program/view");
$can_delete = ACL::is_allowed("vw_stock_movements_at_program/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Vw Stock Movements At Program</h4>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('vw_stock_movements_at_program'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="material-icons">search</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('vw_stock_movements_at_program'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('vw_stock_movements_at_program'); ?>">
                                            <i class="material-icons">arrow_back</i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="vw_stock_movements_at_program-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-sno">#</th>
                                                <th  class="td-id"> Id</th>
                                                <th  class="td-transaction_date"> Transaction Date</th>
                                                <th  class="td-item_code"> Item Code</th>
                                                <th  class="td-item_name"> Item Name</th>
                                                <th  class="td-initialqty"> Initial Qty</th>
                                                <th  class="td-program_item_balance_total_used"> Total Used</th>
                                                <th  class="td-program_item_balance_remainingqty"> Balance</th>
                                                <th  class="td-expiry_date"> Expiry Date</th>
                                                <th  class="td-movement_type"> Movement Type</th>
                                                <th  class="td-reason_code"> Reason Code</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <th class="td-sno"><?php echo $counter; ?></th>
                                                <td class="td-id">
                                                    <div class="inline-page">
                                                        <?php
                                                        $page_fields = array('program_manager_id' => $data['program_manager_id'],'item_id' => $data['item_id'],'stock_movement_id' => $data['id'],'batch_id' => $data['batch_id'],'issuance_id' => $data['id']);
                                                        $page_link = "masterdetail/index/vw_stock_movements_at_program/program_item_usage/stock_movement_id/" . urlencode($data['id']);
                                                        $md_pagelink = set_page_link($page_link, $page_fields); 
                                                        ?>
                                                        <a class="btn btn-sm btn-primary open-page-inline" href="<?php print_link($md_pagelink); ?>">
                                                            <i class="material-icons">visibility</i> <?php echo $data['id'] ?>
                                                        </a>
                                                        <div class="page-content reset-grids d-none animated fadeIn"></div>
                                                    </div>
                                                </td>
                                                <td class="td-transaction_date"> <?php echo $data['transaction_date']; ?></td>
                                                <td class="td-item_code"> <?php echo $data['item_code']; ?></td>
                                                <td class="td-item_name"> <?php echo $data['item_name']; ?></td>
                                                <td class="td-initialqty"> <?php echo $data['initialqty']; ?></td>
                                                <td class="td-program_item_balance_total_used">
                                                    <span <?php if($can_edit){ ?> data-step="0.1" 
                                                        data-value="<?php echo $data['program_item_balance_total_used']; ?>" 
                                                        data-pk="<?php echo $data[''] ?>" 
                                                        data-url="<?php print_link("program_item_balance/editfield/" . urlencode($data['stock_movement_id'])); ?>" 
                                                        data-name="total_used" 
                                                        data-title="Enter Total Used" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['program_item_balance_total_used']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-program_item_balance_remainingqty">
                                                    <span <?php if($can_edit){ ?> data-step="0.1" 
                                                        data-value="<?php echo $data['program_item_balance_remainingqty']; ?>" 
                                                        data-pk="<?php echo $data[''] ?>" 
                                                        data-url="<?php print_link("program_item_balance/editfield/" . urlencode($data['stock_movement_id'])); ?>" 
                                                        data-name="remainingqty" 
                                                        data-title="Enter Remainingqty" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="number" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['program_item_balance_remainingqty']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-expiry_date"> <?php echo $data['expiry_date']; ?></td>
                                                <td class="td-movement_type"> <?php echo $data['movement_type']; ?></td>
                                                <td class="td-reason_code"> <?php echo $data['reason_code']; ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            <!--endrecord-->
                                        </tbody>
                                        <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                    <?php 
                                    if(empty($records)){
                                    ?>
                                    <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                        <i class="material-icons">block</i> No record found
                                    </h4>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if( $show_footer && !empty($records)){
                                ?>
                                <div class=" border-top mt-2">
                                    <div class="row justify-content-center">    
                                        <div class="col-md-auto justify-content-center">    
                                            <div class="p-3 d-flex justify-content-between">    
                                                <div class="dropup export-btn-holder mx-1">
                                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="material-icons">save</i> Export
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                        <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                            <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                            </a>
                                                            <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                </a>
                                                                <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                    </a>
                                                                    <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                        </a>
                                                                        <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col">   
                                                                <?php
                                                                if($show_pagination == true){
                                                                $pager = new Pagination($total_records, $record_count);
                                                                $pager->route = $this->route;
                                                                $pager->show_page_count = true;
                                                                $pager->show_record_count = true;
                                                                $pager->show_page_limit =true;
                                                                $pager->limit_count = $this->limit_count;
                                                                $pager->show_page_number_list = true;
                                                                $pager->pager_link_range=5;
                                                                $pager->render();
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
