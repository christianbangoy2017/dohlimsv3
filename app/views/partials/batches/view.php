<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("batches/add");
$can_edit = ACL::is_allowed("batches/edit");
$can_view = ACL::is_allowed("batches/view");
$can_delete = ACL::is_allowed("batches/delete");
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
                    <h4 class="record-title">View  Batches</h4>
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
                                        <td class="value">
                                            <?php
                                            $page_fields = array('batch_id' => $data['id']);
                                            $page_link = "masterdetail/index/batches/stock_movements/batch_id/" . urlencode($data['id']);
                                            $md_pagelink = set_page_link($page_link, $page_fields); 
                                            ?>
                                            <a class="btn btn-sm btn-primary open-page-popover" href="<?php print_link($md_pagelink); ?>">
                                                <i class="material-icons">visibility</i> <?php echo $data['id'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-received_date">
                                        <th class="title"> Received Date: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['received_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("batches/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="received_date" 
                                                data-title="Enter Received Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['received_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-batch_number">
                                        <th class="title"> Batch Number: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['batch_number']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("batches/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="batch_number" 
                                                data-title="Enter Batch Number" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['batch_number']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-suppliers_supplier_name">
                                        <th class="title"> Supplier Name: </th>
                                        <td class="value"> <?php echo $data['suppliers_supplier_name']; ?></td>
                                    </tr>
                                    <tr  class="td-items_item_name">
                                        <th class="title"> Item Name: </th>
                                        <td class="value">
                                            <?php
                                            $page_fields = array('batch_id' => $data['id']);
                                            $page_link = "masterdetail/index/items/stock_movements/batch_id/" . urlencode($data['id']);
                                            $md_pagelink = set_page_link($page_link, $page_fields); 
                                            ?>
                                            <a class="btn btn-sm btn-primary open-page-popover" href="<?php print_link($md_pagelink); ?>">
                                                <i class="material-icons">visibility</i> <?php echo $data['items_item_name'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-items_generic_name">
                                        <th class="title"> Generic Name: </th>
                                        <td class="value"> <?php echo $data['items_generic_name']; ?></td>
                                    </tr>
                                    <tr  class="td-initial_quantity">
                                        <th class="title"> Initial Quantity: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['initial_quantity']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("batches/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="initial_quantity" 
                                                data-title="Enter Initial Quantity" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['initial_quantity']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-unit_cost">
                                        <th class="title"> Unit Cost: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['unit_cost']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("batches/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="unit_cost" 
                                                data-title="Enter Unit Cost" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['unit_cost']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-expiry_date">
                                        <th class="title"> Expiry Date: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['expiry_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("batches/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="expiry_date" 
                                                data-title="Enter Expiry Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['expiry_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-unit_total">
                                        <th class="title"> Unit Total: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-step="0.1" 
                                                data-value="<?php echo $data['unit_total']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("batches/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="unit_total" 
                                                data-title="Enter Unit Total" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['unit_total']; ?> 
                                            </span>
                                        </td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("batches/edit/$rec_id"); ?>">
                                                    <i class="material-icons">edit</i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("batches/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
