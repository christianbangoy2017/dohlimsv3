    <?php
    $comp_model = new SharedController;
    $view_data = $this->view_data; //array of all  data passed from controller
    $field_name = $view_data['field_name'];
    $field_value = $view_data['field_value'];
    $form_data = $this->form_data; //request pass to the page as form fields values
    $can_list = ACL::is_allowed("program_item_usage/list/issuance_id/$field_value");$can_add = ACL::is_allowed("program_item_usage/add/?issuance_id=$field_value");$can_edit = ACL::is_allowed("program_item_usage/edit/$field_value");
    $page_id = random_str(6);
    ?>
    <div class="master-detail-page">
        <div class="card-header p-0 pt-2 px-2">
            <ul class="nav nav-tabs">
                <?php if($can_list){ ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#program_issuance_slips_program_item_usage_List_<?php echo $page_id ?>" class="nav-link active">
                        List
                    </a>
                </li>
                <?php } ?>
                <?php if($can_add){ ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#program_issuance_slips_program_item_usage_Add_<?php echo $page_id ?>" class="nav-link ">
                        Add
                    </a>
                </li>
                <?php } ?>
                <?php if($can_edit){ ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#program_issuance_slips_program_item_usage_Edit_<?php echo $page_id ?>" class="nav-link ">
                        Edit
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-content">
            <?php if($can_list){ ?>
            <div class="tab-pane fade show active show" id="program_issuance_slips_program_item_usage_List_<?php echo $page_id ?>" role="tabpanel">
                <?php $this->render_page("program_item_usage/list/issuance_id/$field_value"); ?>
            </div>
            <?php } ?>
            <?php if($can_add){ ?>
            <div class="tab-pane fade show " id="program_issuance_slips_program_item_usage_Add_<?php echo $page_id ?>" role="tabpanel">
                <?php $this->render_page("program_item_usage/add/?issuance_id=$field_value", array('issuance_id' => get_value('issuance_id'),'usage_date' => get_value('usage_date'))); ?>
            </div>
            <?php } ?>
            <?php if($can_edit){ ?>
            <div class="tab-pane fade show " id="program_issuance_slips_program_item_usage_Edit_<?php echo $page_id ?>" role="tabpanel">
                <?php $this->render_page("program_item_usage/edit/$field_value"); ?>
            </div>
            <?php } ?>
        </div>
    </div>
    