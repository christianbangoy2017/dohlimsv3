<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("program_issuance_slips/add");
$can_edit = ACL::is_allowed("program_issuance_slips/edit");
$can_view = ACL::is_allowed("program_issuance_slips/view");
$can_delete = ACL::is_allowed("program_issuance_slips/delete");
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
                    <h4 class="record-title">Program Issuance Slips</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("program_issuance_slips/add") ?>">
                        <i class="material-icons">add</i>                               
                        Add New Program Issuance Slips 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('program_issuance_slips'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('program_issuance_slips'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('program_issuance_slips'); ?>">
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
                            <div id="program_issuance_slips-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <th class="td-sno">#</th>
                                                <th  class="td-id"> Id</th>
                                                <th  class="td-slip_no"> Slip No</th>
                                                <th  class="td-issuance_date"> Issuance Date</th>
                                                <th  class="td-division"> Division</th>
                                                <th  class="td-section"> Section</th>
                                                <th  class="td-purpose"> Purpose</th>
                                                <th  class="td-approvedby_id"> Approvedby Id</th>
                                                <th  class="td-encodedby_id"> Encodedby Id</th>
                                                <th  class="td-client_id"> Client Id</th>
                                                <th  class="td-clients_id"> Clients Id</th>
                                                <th  class="td-clients_name"> Clients Name</th>
                                                <th  class="td-clients_address"> Clients Address</th>
                                                <th  class="td-clients_contactnumber"> Clients Contactnumber</th>
                                                <th  class="td-clients_isactive"> Clients Isactive</th>
                                                <th  class="td-clients_encodedby_id"> Clients Encodedby Id</th>
                                                <th  class="td-clients_created_at"> Clients Created At</th>
                                                <th  class="td-clients_updated_at"> Clients Updated At</th>
                                                <th class="td-btn"></th>
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
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <th class="td-sno"><?php echo $counter; ?></th>
                                                <td class="td-id"><a href="<?php print_link("program_issuance_slips/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
                                                <td class="td-slip_no">
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
                                                <td class="td-issuance_date">
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
                                                <td class="td-division">
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
                                                <td class="td-section">
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
                                                <td class="td-purpose">
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
                                                <td class="td-approvedby_id">
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
                                                <td class="td-encodedby_id">
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
                                                <td class="td-client_id">
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
                                                <td class="td-clients_id"> <?php echo $data['clients_id']; ?></td>
                                                <td class="td-clients_name">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['clients_name']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("clients/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="name" 
                                                        data-title="Enter Name" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['clients_name']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-clients_address">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['clients_address']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("clients/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="address" 
                                                        data-title="Enter Address" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['clients_address']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-clients_contactnumber">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['clients_contactnumber']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("clients/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="contactnumber" 
                                                        data-title="Enter Contactnumber" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['clients_contactnumber']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-clients_isactive">
                                                    <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $isactive); ?>' 
                                                        data-value="<?php echo $data['clients_isactive']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("clients/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="isactive" 
                                                        data-title="Enter Isactive" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="radiolist" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['clients_isactive']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-clients_encodedby_id">
                                                    <span <?php if($can_edit){ ?> data-value="<?php echo $data['clients_encodedby_id']; ?>" 
                                                        data-pk="<?php echo $data['id'] ?>" 
                                                        data-url="<?php print_link("clients/editfield/" . urlencode($data['id'])); ?>" 
                                                        data-name="encodedby_id" 
                                                        data-title="Enter Encodedby Id" 
                                                        data-placement="left" 
                                                        data-toggle="click" 
                                                        data-type="text" 
                                                        data-mode="popover" 
                                                        data-showbuttons="left" 
                                                        class="is-editable" <?php } ?>>
                                                        <?php echo $data['clients_encodedby_id']; ?> 
                                                    </span>
                                                </td>
                                                <td class="td-clients_created_at"> <?php echo $data['clients_created_at']; ?></td>
                                                <td class="td-clients_updated_at"> <?php echo $data['clients_updated_at']; ?></td>
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
