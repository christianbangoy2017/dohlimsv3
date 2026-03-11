<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("program_issuance_slips/add");
$can_edit = ACL::is_allowed("program_issuance_slips/edit");
$can_view = ACL::is_allowed("program_issuance_slips/view");
$can_delete = ACL::is_allowed("program_issuance_slips/delete");
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
                    <h4 class="record-title">View  Program Issuance Slips</h4>
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
                                    <tr  class="td-slip_no">
                                        <th class="title"> Slip No: </th>
                                        <td class="value">
                                            <div class="inline-page">
                                                <?php
                                                $page_fields = array('issuance_id' => $data['id'],'usage_date' => $data['issuance_date']);
                                                $page_link = "masterdetail/index/program_issuance_slips/program_item_usage/issuance_id/" . urlencode($data['id']);
                                                $md_pagelink = set_page_link($page_link, $page_fields); 
                                                ?>
                                                <a class="btn btn-sm btn-primary open-page-inline" href="<?php print_link($md_pagelink); ?>">
                                                    <i class="material-icons">visibility</i> <?php echo $data['slip_no'] ?>
                                                </a>
                                                <div class="page-content reset-grids d-none animated fadeIn"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr  class="td-issuance_date">
                                        <th class="title"> Issuance Date: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-source='<?php echo json_encode_quote(Menu :: $issuance_date); ?>' 
                                                data-value="<?php echo $data['issuance_date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_issuance_slips/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="issuance_date" 
                                                data-title="Enter Issuance Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['issuance_date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-division">
                                        <th class="title"> Division: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $issuance_date); ?>' 
                                                data-value="<?php echo $data['division']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_issuance_slips/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="division" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['division']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-section">
                                        <th class="title"> Section: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/program_issuance_slips_section_option_list'); ?>' 
                                                data-value="<?php echo $data['section']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_issuance_slips/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="section" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['section']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-purpose">
                                        <th class="title"> Purpose: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_issuance_slips/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="purpose" 
                                                data-title="Enter Purpose" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['purpose']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-approvedby_id">
                                        <th class="title"> Approvedby Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/program_issuance_slips_approvedby_id_option_list'); ?>' 
                                                data-value="<?php echo $data['approvedby_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_issuance_slips/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="approvedby_id" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['approvedby_id']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-encodedby_id">
                                        <th class="title"> Encodedby Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['encodedby_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_issuance_slips/editfield/" . urlencode($data['id'])); ?>" 
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
                                    <tr  class="td-created_at">
                                        <th class="title"> Created At: </th>
                                        <td class="value"> <?php echo $data['created_at']; ?></td>
                                    </tr>
                                    <tr  class="td-client_id">
                                        <th class="title"> Client Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('api/json/program_issuance_slips_client_id_option_list'); ?>' 
                                                data-value="<?php echo $data['client_id']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("program_issuance_slips/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="client_id" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['client_id']; ?> 
                                            </span>
                                        </td>
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
