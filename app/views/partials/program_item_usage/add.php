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
                        <form id="program_item_usage-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("program_item_usage/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="issuance_id">Issuance Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-issuance_id"  value="<?php  echo $this->set_field_value('issuance_id',""); ?>" type="number" placeholder="Enter Issuance Id" step="1"  required="" name="issuance_id"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="usage_date">Usage Date <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input id="ctrl-usage_date" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('usage_date',date_now()); ?>" type="datetime" name="usage_date" placeholder="Enter Usage Date" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="ctrl-program_manager_id"  value="<?php  echo $this->set_field_value('program_manager_id',""); ?>" type="hidden" placeholder="Enter Program Manager Id"  required="" name="program_manager_id"  class="form-control " />
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="item_id">Item Id <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select required=""  id="ctrl-item_id" name="item_id"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php 
                                                                $item_id_options = $comp_model -> program_item_usage_item_id_option_list();
                                                                if(!empty($item_id_options)){
                                                                foreach($item_id_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = $this->set_field_selected('item_id',$value, "");
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
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="ctrl-batch_id"  value="<?php  echo $this->set_field_value('batch_id',""); ?>" type="hidden" placeholder="Enter Batch Id" list="batch_id_list"  required="" name="batch_id"  class="form-control " />
                                                <datalist id="batch_id_list">
                                                    <?php 
                                                    $batch_id_options = $comp_model -> program_item_usage_batch_id_option_list();
                                                    if(!empty($batch_id_options)){
                                                    foreach($batch_id_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    ?>
                                                    <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </datalist>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="qty_used">Qty Used <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-qty_used"  value="<?php  echo $this->set_field_value('qty_used',""); ?>" type="number" placeholder="Enter Qty Used" step="0.1" list="qty_used_list"  required="" name="qty_used"  class="form-control " />
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="remarks">Remarks <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <textarea placeholder="Enter Remarks" id="ctrl-remarks"  required="" rows="5" name="remarks" class=" form-control"><?php  echo $this->set_field_value('remarks',""); ?></textarea>
                                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input id="ctrl-stock_movement_id"  value="<?php  echo $this->set_field_value('stock_movement_id',""); ?>" type="hidden" placeholder="Enter Stock Movement Id"  required="" name="stock_movement_id"  class="form-control " />
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="encodedby_id">Encodedby Id <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-encodedby_id"  value="<?php  echo $this->set_field_value('encodedby_id',""); ?>" type="number" placeholder="Enter Encodedby Id" step="1"  required="" name="encodedby_id"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-submit-btn-holder text-center mt-3">
                                                            <div class="form-ajax-status"></div>
                                                            <button class="btn btn-primary" type="submit">
                                                                Submit
                                                                <i class="material-icons">send</i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
