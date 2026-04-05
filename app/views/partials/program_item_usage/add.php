<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New Program Item Usage</h4>
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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="program_item_usage-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="<?php print_link("program_item_usage/add?csrf_token=$csrf_token") ?>" method="post" >
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="issuance_id">Issuance Id</label></th>
                                            <th class="bg-light"><label for="batch_id">Batch Id</label></th>
                                            <th class="bg-light"><label for="qty_used">Qty Used</label></th>
                                            <th class="bg-light"><label for="remarks">Remarks</label></th>
                                            <th class="bg-light"><label for="unit_cost">Unit Cost</label></th>
                                            <th class="bg-light"><label for="unit_total">Unit Total</label></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        for( $row = 1; $row <= 1; $row++ ){
                                        ?>
                                        <tr class="input-row">
                                            <td>
                                                <div id="ctrl-issuance_id-row<?php echo $row; ?>-holder" class="">
                                                    <select required=""  id="ctrl-issuance_id-row<?php echo $row; ?>" name="row<?php echo $row ?>[issuance_id]"  placeholder="Select a value ..."    class="custom-select" >
                                                        <option value="">Select a value ...</option>
                                                        <?php 
                                                        $issuance_id_options = $comp_model -> program_item_usage_issuance_id_option_list();
                                                        if(!empty($issuance_id_options)){
                                                        foreach($issuance_id_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('issuance_id',$value, "");
                                                        ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                            <?php echo $label; ?>
                                                        </option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <input id="ctrl-usage_date-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('usage_date',date_now(), $row); ?>" type="hidden" placeholder="Enter Usage Date" list="usage_date_list"  required="" name="row<?php echo $row ?>[usage_date]"  class="form-control " />
                                                <datalist id="usage_date_list">
                                                    <?php 
                                                    $usage_date_options = $comp_model -> program_item_usage_usage_date_option_list();
                                                    if(!empty($usage_date_options)){
                                                    foreach($usage_date_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    ?>
                                                    <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </datalist>
                                                <input id="ctrl-program_manager_id-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('program_manager_id',"", $row); ?>" type="hidden" placeholder="Enter Program Manager Id"  name="row<?php echo $row ?>[program_manager_id]"  class="form-control " />
                                                    <input id="ctrl-item_id-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('item_id',"", $row); ?>" type="hidden" placeholder="Enter Item Id" list="item_id_list"  name="row<?php echo $row ?>[item_id]"  class="form-control " />
                                                        <datalist id="item_id_list">
                                                            <?php 
                                                            $item_id_options = $comp_model -> program_item_usage_item_id_option_list();
                                                            if(!empty($item_id_options)){
                                                            foreach($item_id_options as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            ?>
                                                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </datalist>
                                                        <td>
                                                            <div id="ctrl-batch_id-row<?php echo $row; ?>-holder" class="">
                                                                <select required=""  id="ctrl-batch_id-row<?php echo $row; ?>" name="row<?php echo $row ?>[batch_id]"  placeholder="Select a value ..."    class="custom-select" >
                                                                    <option value="">Select a value ...</option>
                                                                    <?php 
                                                                    $batch_id_options = $comp_model -> program_item_usage_batch_id_option_list();
                                                                    if(!empty($batch_id_options)){
                                                                    foreach($batch_id_options as $option){
                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                    $selected = $this->set_field_selected('batch_id',$value, "");
                                                                    ?>
                                                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                        <?php echo $label; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="ctrl-qty_used-row<?php echo $row; ?>-holder" class="">
                                                                <input id="ctrl-qty_used-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('qty_used',"1", $row); ?>" type="number" placeholder="Enter Qty Used" step="0.1" list="qty_used_list"  required="" name="row<?php echo $row ?>[qty_used]"  class="form-control " />
                                                                    <datalist id="qty_used_list">
                                                                        <?php 
                                                                        $qty_used_options = $comp_model -> program_item_usage_qty_used_option_list();
                                                                        if(!empty($qty_used_options)){
                                                                        foreach($qty_used_options as $option){
                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                        ?>
                                                                        <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="ctrl-remarks-row<?php echo $row; ?>-holder" class="">
                                                                    <textarea placeholder="Enter Remarks" id="ctrl-remarks-row<?php echo $row; ?>"  rows="5" name="row<?php echo $row ?>[remarks]" class=" form-control"><?php  echo $this->set_field_value('remarks',"", $row); ?></textarea>
                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                </div>
                                                            </td>
                                                            <input id="ctrl-stock_movement_id-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('stock_movement_id',"", $row); ?>" type="hidden" placeholder="Enter Stock Movement Id"  name="row<?php echo $row ?>[stock_movement_id]"  class="form-control " />
                                                                <input id="ctrl-encodedby_id-row<?php echo $row; ?>"  value="<?php echo USER_ID?>" type="hidden" placeholder="Enter Encodedby Id"  required="" name="row<?php echo $row ?>[encodedby_id]"  class="form-control " />
                                                                    <td>
                                                                        <div id="ctrl-unit_cost-row<?php echo $row; ?>-holder" class="">
                                                                            <input id="ctrl-unit_cost-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('unit_cost',"0.00", $row); ?>" type="number" placeholder="Enter Unit Cost" step="0.1"  required="" name="row<?php echo $row ?>[unit_cost]"  class="form-control " />
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div id="ctrl-unit_total-row<?php echo $row; ?>-holder" class="">
                                                                                <input id="ctrl-unit_total-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('unit_total',"", $row); ?>" type="number" placeholder="Enter Unit Total" step="0.1"  required="" name="row<?php echo $row ?>[unit_total]"  class="form-control " />
                                                                                </div>
                                                                            </td>
                                                                            <th class="text-center">
                                                                                <button type="button" class="close btn-remove-table-row">&times;</button>
                                                                            </th>
                                                                        </tr>
                                                                        <?php 
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th colspan="100" class="text-right">
                                                                                <?php $template_id = "table-row-" . random_str(); ?>
                                                                                <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-light btn-add-table-row"><i class="material-icons">add</i></button>
                                                                            </th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                                                <div class="form-ajax-status"></div>
                                                                <button class="btn btn-primary" type="submit">
                                                                    Submit
                                                                    <i class="material-icons">send</i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                        <!--[table row template]-->
                                                        <template id="<?php echo $template_id ?>">
                                                            <tr class="input-row">
                                                                <?php $row = 1; ?>
                                                                <td>
                                                                    <div id="ctrl-issuance_id-row<?php echo $row; ?>-holder" class="">
                                                                        <select required=""  id="ctrl-issuance_id-row<?php echo $row; ?>" name="row<?php echo $row ?>[issuance_id]"  placeholder="Select a value ..."    class="custom-select" >
                                                                            <option value="">Select a value ...</option>
                                                                            <?php 
                                                                            $issuance_id_options = $comp_model -> program_item_usage_issuance_id_option_list();
                                                                            if(!empty($issuance_id_options)){
                                                                            foreach($issuance_id_options as $option){
                                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                            $selected = $this->set_field_selected('issuance_id',$value, "");
                                                                            ?>
                                                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                                <?php echo $label; ?>
                                                                            </option>
                                                                            <?php
                                                                            }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <input id="ctrl-usage_date-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('usage_date',date_now(), $row); ?>" type="hidden" placeholder="Enter Usage Date" list="usage_date_list"  required="" name="row<?php echo $row ?>[usage_date]"  class="form-control " />
                                                                    <datalist id="usage_date_list">
                                                                        <?php 
                                                                        $usage_date_options = $comp_model -> program_item_usage_usage_date_option_list();
                                                                        if(!empty($usage_date_options)){
                                                                        foreach($usage_date_options as $option){
                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                        ?>
                                                                        <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                                        <?php
                                                                        }
                                                                        }
                                                                        ?>
                                                                    </datalist>
                                                                    <input id="ctrl-program_manager_id-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('program_manager_id',"", $row); ?>" type="hidden" placeholder="Enter Program Manager Id"  name="row<?php echo $row ?>[program_manager_id]"  class="form-control " />
                                                                        <input id="ctrl-item_id-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('item_id',"", $row); ?>" type="hidden" placeholder="Enter Item Id" list="item_id_list"  name="row<?php echo $row ?>[item_id]"  class="form-control " />
                                                                            <datalist id="item_id_list">
                                                                                <?php 
                                                                                $item_id_options = $comp_model -> program_item_usage_item_id_option_list();
                                                                                if(!empty($item_id_options)){
                                                                                foreach($item_id_options as $option){
                                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                ?>
                                                                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                                                <?php
                                                                                }
                                                                                }
                                                                                ?>
                                                                            </datalist>
                                                                            <td>
                                                                                <div id="ctrl-batch_id-row<?php echo $row; ?>-holder" class="">
                                                                                    <select required=""  id="ctrl-batch_id-row<?php echo $row; ?>" name="row<?php echo $row ?>[batch_id]"  placeholder="Select a value ..."    class="custom-select" >
                                                                                        <option value="">Select a value ...</option>
                                                                                        <?php 
                                                                                        $batch_id_options = $comp_model -> program_item_usage_batch_id_option_list();
                                                                                        if(!empty($batch_id_options)){
                                                                                        foreach($batch_id_options as $option){
                                                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                        $selected = $this->set_field_selected('batch_id',$value, "");
                                                                                        ?>
                                                                                        <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                                            <?php echo $label; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                        }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div id="ctrl-qty_used-row<?php echo $row; ?>-holder" class="">
                                                                                    <input id="ctrl-qty_used-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('qty_used',"1", $row); ?>" type="number" placeholder="Enter Qty Used" step="0.1" list="qty_used_list"  required="" name="row<?php echo $row ?>[qty_used]"  class="form-control " />
                                                                                        <datalist id="qty_used_list">
                                                                                            <?php 
                                                                                            $qty_used_options = $comp_model -> program_item_usage_qty_used_option_list();
                                                                                            if(!empty($qty_used_options)){
                                                                                            foreach($qty_used_options as $option){
                                                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                                            ?>
                                                                                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            }
                                                                                            ?>
                                                                                        </datalist>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div id="ctrl-remarks-row<?php echo $row; ?>-holder" class="">
                                                                                        <textarea placeholder="Enter Remarks" id="ctrl-remarks-row<?php echo $row; ?>"  rows="5" name="row<?php echo $row ?>[remarks]" class=" form-control"><?php  echo $this->set_field_value('remarks',"", $row); ?></textarea>
                                                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                                    </div>
                                                                                </td>
                                                                                <input id="ctrl-stock_movement_id-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('stock_movement_id',"", $row); ?>" type="hidden" placeholder="Enter Stock Movement Id"  name="row<?php echo $row ?>[stock_movement_id]"  class="form-control " />
                                                                                    <input id="ctrl-encodedby_id-row<?php echo $row; ?>"  value="<?php echo USER_ID?>" type="hidden" placeholder="Enter Encodedby Id"  required="" name="row<?php echo $row ?>[encodedby_id]"  class="form-control " />
                                                                                        <td>
                                                                                            <div id="ctrl-unit_cost-row<?php echo $row; ?>-holder" class="">
                                                                                                <input id="ctrl-unit_cost-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('unit_cost',"0.00", $row); ?>" type="number" placeholder="Enter Unit Cost" step="0.1"  required="" name="row<?php echo $row ?>[unit_cost]"  class="form-control " />
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div id="ctrl-unit_total-row<?php echo $row; ?>-holder" class="">
                                                                                                    <input id="ctrl-unit_total-row<?php echo $row; ?>"  value="<?php  echo $this->set_field_value('unit_total',"", $row); ?>" type="number" placeholder="Enter Unit Total" step="0.1"  required="" name="row<?php echo $row ?>[unit_total]"  class="form-control " />
                                                                                                    </div>
                                                                                                </td>
                                                                                                <th class="text-center">
                                                                                                    <button type="button" class="close btn-remove-table-row">&times;</button>
                                                                                                </th>
                                                                                            </tr>
                                                                                        </template>
                                                                                        <!--[/table row template]-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
