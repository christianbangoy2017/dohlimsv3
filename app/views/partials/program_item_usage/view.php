<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("program_item_usage/add");
$can_edit = ACL::is_allowed("program_item_usage/edit");
$can_view = ACL::is_allowed("program_item_usage/view");
$can_delete = ACL::is_allowed("program_item_usage/delete");
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
                    <h4 class="record-title">View  Program Item Usage</h4>
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
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"> Id: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-program_manager_id">
                                        <th class="title"> Program Manager Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['program_manager_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="program_manager_id" 
                                                data-title="Enter Program Manager Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['program_manager_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-item_id">
                                        <th class="title"> Item Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/program_item_usage_item_id_option_list'); ?>' 
                                                data-value="<?php echo $data['item_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="item_id" 
                                                data-title="Enter Item Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['item_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-batch_id">
                                        <th class="title"> Batch Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/program_item_usage_batch_id_option_list'); ?>' 
                                                data-value="<?php echo $data['batch_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="batch_id" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['batch_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-qty_used">
                                        <th class="title"> Qty Used: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="0.1" 
                                                data-source='<?php print_link('api/json/program_item_usage_qty_used_option_list'); ?>' 
                                                data-value="<?php echo $data['qty_used']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="qty_used" 
                                                data-title="Enter Qty Used" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['qty_used']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-usage_date">
                                        <th class="title"> Usage Date: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/program_item_usage_usage_date_option_list'); ?>' 
                                                data-value="<?php echo $data['usage_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="usage_date" 
                                                data-title="Enter Usage Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['usage_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-remarks">
                                        <th class="title"> Remarks: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="remarks" 
                                                data-title="Enter Remarks" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['remarks']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-stock_movement_id">
                                        <th class="title"> Stock Movement Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['stock_movement_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="stock_movement_id" 
                                                data-title="Enter Stock Movement Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['stock_movement_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-created_at">
                                        <th class="title"> Created At: </th>
                                        <td class="value"> <?php echo $data['created_at']; ?></td>
                                    </tr>
                                    <tr  class="td-updated_at">
                                        <th class="title"> Updated At: </th>
                                        <td class="value"> <?php echo $data['updated_at']; ?></td>
                                    </tr>
                                    <tr  class="td-issuance_id">
                                        <th class="title"> Issuance Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/program_item_usage_issuance_id_option_list'); ?>' 
                                                data-value="<?php echo $data['issuance_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="issuance_id" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['issuance_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-encodedby_id">
                                        <th class="title"> Encodedby Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['encodedby_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_item_usage/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="encodedby_id" 
                                                data-title="Enter Encodedby Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['encodedby_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-batches_id">
                                        <th class="title"> Batches Id: </th>
                                        <td class="value"> <?php echo $data['batches_id']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_item_id">
                                        <th class="title"> Batches Item Id: </th>
                                        <td class="value"> <?php echo $data['batches_item_id']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_supplier_id">
                                        <th class="title"> Batches Supplier Id: </th>
                                        <td class="value"> <?php echo $data['batches_supplier_id']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_batch_number">
                                        <th class="title"> Batches Batch Number: </th>
                                        <td class="value"> <?php echo $data['batches_batch_number']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_expiry_date">
                                        <th class="title"> Batches Expiry Date: </th>
                                        <td class="value"> <?php echo $data['batches_expiry_date']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_received_date">
                                        <th class="title"> Batches Received Date: </th>
                                        <td class="value"> <?php echo $data['batches_received_date']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_initial_quantity">
                                        <th class="title"> Batches Initial Quantity: </th>
                                        <td class="value"> <?php echo $data['batches_initial_quantity']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_created_at">
                                        <th class="title"> Batches Created At: </th>
                                        <td class="value"> <?php echo $data['batches_created_at']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_updated_at">
                                        <th class="title"> Batches Updated At: </th>
                                        <td class="value"> <?php echo $data['batches_updated_at']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_deleted_at">
                                        <th class="title"> Batches Deleted At: </th>
                                        <td class="value"> <?php echo $data['batches_deleted_at']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_encodedby_id">
                                        <th class="title"> Batches Encodedby Id: </th>
                                        <td class="value"> <?php echo $data['batches_encodedby_id']; ?></td>
                                    </tr>
                                    <tr  class="td-batches_is_deleted">
                                        <th class="title"> Batches Is Deleted: </th>
                                        <td class="value"> <?php echo $data['batches_is_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_id">
                                        <th class="title"> Program Issuance Slips Id: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_id']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_slip_no">
                                        <th class="title"> Program Issuance Slips Slip No: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_slip_no']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_issuance_date">
                                        <th class="title"> Program Issuance Slips Issuance Date: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_issuance_date']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_division">
                                        <th class="title"> Program Issuance Slips Division: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_division']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_section">
                                        <th class="title"> Program Issuance Slips Section: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_section']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_purpose">
                                        <th class="title"> Program Issuance Slips Purpose: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_purpose']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_approvedby_id">
                                        <th class="title"> Program Issuance Slips Approvedby Id: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_approvedby_id']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_encodedby_id">
                                        <th class="title"> Program Issuance Slips Encodedby Id: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_encodedby_id']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_created_at">
                                        <th class="title"> Program Issuance Slips Created At: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_created_at']; ?></td>
                                    </tr>
                                    <tr  class="td-program_issuance_slips_client_id">
                                        <th class="title"> Program Issuance Slips Client Id: </th>
                                        <td class="value"> <?php echo $data['program_issuance_slips_client_id']; ?></td>
                                    </tr>
                                    <tr  class="td-clients_id">
                                        <th class="title"> Clients Id: </th>
                                        <td class="value"> <?php echo $data['clients_id']; ?></td>
                                    </tr>
                                    <tr  class="td-clients_name">
                                        <th class="title"> Clients Name: </th>
                                        <td class="value"> <?php echo $data['clients_name']; ?></td>
                                    </tr>
                                    <tr  class="td-clients_address">
                                        <th class="title"> Clients Address: </th>
                                        <td class="value"> <?php echo $data['clients_address']; ?></td>
                                    </tr>
                                    <tr  class="td-clients_contactnumber">
                                        <th class="title"> Clients Contactnumber: </th>
                                        <td class="value"> <?php echo $data['clients_contactnumber']; ?></td>
                                    </tr>
                                    <tr  class="td-clients_isactive">
                                        <th class="title"> Clients Isactive: </th>
                                        <td class="value"> <?php echo $data['clients_isactive']; ?></td>
                                    </tr>
                                    <tr  class="td-clients_encodedby_id">
                                        <th class="title"> Clients Encodedby Id: </th>
                                        <td class="value"> <?php echo $data['clients_encodedby_id']; ?></td>
                                    </tr>
                                    <tr  class="td-clients_created_at">
                                        <th class="title"> Clients Created At: </th>
                                        <td class="value"> <?php echo $data['clients_created_at']; ?></td>
                                    </tr>
                                    <tr  class="td-clients_updated_at">
                                        <th class="title"> Clients Updated At: </th>
                                        <td class="value"> <?php echo $data['clients_updated_at']; ?></td>
                                    </tr>
                                    <tr  class="td-items_id">
                                        <th class="title"> Items Id: </th>
                                        <td class="value"> <?php echo $data['items_id']; ?></td>
                                    </tr>
                                    <tr  class="td-items_item_code">
                                        <th class="title"> Items Item Code: </th>
                                        <td class="value"> <?php echo $data['items_item_code']; ?></td>
                                    </tr>
                                    <tr  class="td-items_item_name">
                                        <th class="title"> Items Item Name: </th>
                                        <td class="value"> <?php echo $data['items_item_name']; ?></td>
                                    </tr>
                                    <tr  class="td-items_generic_name">
                                        <th class="title"> Items Generic Name: </th>
                                        <td class="value"> <?php echo $data['items_generic_name']; ?></td>
                                    </tr>
                                    <tr  class="td-items_category_id">
                                        <th class="title"> Items Category Id: </th>
                                        <td class="value"> <?php echo $data['items_category_id']; ?></td>
                                    </tr>
                                    <tr  class="td-items_unit_of_measure">
                                        <th class="title"> Items Unit Of Measure: </th>
                                        <td class="value"> <?php echo $data['items_unit_of_measure']; ?></td>
                                    </tr>
                                    <tr  class="td-items_min_stock_level">
                                        <th class="title"> Items Min Stock Level: </th>
                                        <td class="value"> <?php echo $data['items_min_stock_level']; ?></td>
                                    </tr>
                                    <tr  class="td-items_is_active">
                                        <th class="title"> Items Is Active: </th>
                                        <td class="value"> <?php echo $data['items_is_active']; ?></td>
                                    </tr>
                                    <tr  class="td-items_created_at">
                                        <th class="title"> Items Created At: </th>
                                        <td class="value"> <?php echo $data['items_created_at']; ?></td>
                                    </tr>
                                    <tr  class="td-items_updated_at">
                                        <th class="title"> Items Updated At: </th>
                                        <td class="value"> <?php echo $data['items_updated_at']; ?></td>
                                    </tr>
                                    <tr  class="td-items_deleted_at">
                                        <th class="title"> Items Deleted At: </th>
                                        <td class="value"> <?php echo $data['items_deleted_at']; ?></td>
                                    </tr>
                                    <tr  class="td-items_is_deleted">
                                        <th class="title"> Items Is Deleted: </th>
                                        <td class="value"> <?php echo $data['items_is_deleted']; ?></td>
                                    </tr>
                                    <tr  class="td-items_encodedby_id">
                                        <th class="title"> Items Encodedby Id: </th>
                                        <td class="value"> <?php echo $data['items_encodedby_id']; ?></td>
                                    </tr>
                                    <tr  class="td-items_itemname_generic">
                                        <th class="title"> Items Itemname Generic: </th>
                                        <td class="value"> <?php echo $data['items_itemname_generic']; ?></td>
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
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("program_item_usage/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("program_item_usage/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="material-icons">clear</i> Delete
                                                </a>
                                                <?php } ?>
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
