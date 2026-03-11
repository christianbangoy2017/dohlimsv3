<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("vw_stock_movements_at_program/add");
$can_edit = ACL::is_allowed("vw_stock_movements_at_program/edit");
$can_view = ACL::is_allowed("vw_stock_movements_at_program/view");
$can_delete = ACL::is_allowed("vw_stock_movements_at_program/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Vw Stock Movements At Program</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value">
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
                                    </tr>
                                    <tr  class="td-item_code">
                                        <th class="title"> Item Code: </th>
                                        <td class="value"> <?php echo $data['item_code']; ?></td>
                                    </tr>
                                    <tr  class="td-item_name">
                                        <th class="title"> Item Name: </th>
                                        <td class="value"> <?php echo $data['item_name']; ?></td>
                                    </tr>
                                    <tr  class="td-expiry_date">
                                        <th class="title"> Expiry Date: </th>
                                        <td class="value"> <?php echo $data['expiry_date']; ?></td>
                                    </tr>
                                    <tr  class="td-movement_type">
                                        <th class="title"> Movement Type: </th>
                                        <td class="value"> <?php echo $data['movement_type']; ?></td>
                                    </tr>
                                    <tr  class="td-reason_code">
                                        <th class="title"> Reason Code: </th>
                                        <td class="value"> <?php echo $data['reason_code']; ?></td>
                                    </tr>
                                    <tr  class="td-initialqty">
                                        <th class="title"> Initialqty: </th>
                                        <td class="value"> <?php echo $data['initialqty']; ?></td>
                                    </tr>
                                    <tr  class="td-encodedby_id">
                                        <th class="title"> Encodedby Id: </th>
                                        <td class="value"> <?php echo $data['encodedby_id']; ?></td>
                                    </tr>
                                    <tr  class="td-transaction_date">
                                        <th class="title"> Transaction Date: </th>
                                        <td class="value"> <?php echo $data['transaction_date']; ?></td>
                                    </tr>
                                    <tr  class="td-program_item_balance_stock_movement_id">
                                        <th class="title"> Program Item Balance Stock Movement Id: </th>
                                        <td class="value"> <?php echo $data['program_item_balance_stock_movement_id']; ?></td>
                                    </tr>
                                    <tr  class="td-program_item_balance_initialqty">
                                        <th class="title"> Program Item Balance Initialqty: </th>
                                        <td class="value"> <?php echo $data['program_item_balance_initialqty']; ?></td>
                                    </tr>
                                    <tr  class="td-program_item_balance_total_used">
                                        <th class="title"> Program Item Balance Total Used: </th>
                                        <td class="value"> <?php echo $data['program_item_balance_total_used']; ?></td>
                                    </tr>
                                    <tr  class="td-program_item_balance_remainingqty">
                                        <th class="title"> Program Item Balance Remainingqty: </th>
                                        <td class="value"> <?php echo $data['program_item_balance_remainingqty']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="material-icons">block</i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
