<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit  Program Item Usage</h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("program_item_usage/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="issuance_id">Issuance Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <select required=""  id="ctrl-issuance_id" name="issuance_id"  placeholder="Select a value ..."    class="custom-select" >
                                                    <option value="">Select a value ...</option>
                                                    <?php
                                                    $rec = $data['issuance_id'];
                                                    $issuance_id_options = $comp_model -> program_item_usage_issuance_id_option_list();
                                                    if(!empty($issuance_id_options)){
                                                    foreach($issuance_id_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    $selected = ( $value == $rec ? 'selected' : null );
                                                    ?>
                                                    <option 
                                                        <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                <input id="ctrl-usage_date"  value="<?php  echo $data['usage_date']; ?>" type="hidden" placeholder="Enter Usage Date" list="usage_date_list"  required="" name="usage_date"  class="form-control " />
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
                                    <input id="ctrl-program_manager_id"  value="<?php  echo $data['program_manager_id']; ?>" type="hidden" placeholder="Enter Program Manager Id"  name="program_manager_id"  class="form-control " />
                                        <input id="ctrl-item_id"  value="<?php  echo $data['item_id']; ?>" type="hidden" placeholder="Enter Item Id" list="item_id_list"  name="item_id"  class="form-control " />
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
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="batch_id">Batch Id <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <select required=""  id="ctrl-batch_id" name="batch_id"  placeholder="Select a value ..."    class="custom-select" >
                                                                <option value="">Select a value ...</option>
                                                                <?php
                                                                $rec = $data['batch_id'];
                                                                $batch_id_options = $comp_model -> program_item_usage_batch_id_option_list();
                                                                if(!empty($batch_id_options)){
                                                                foreach($batch_id_options as $option){
                                                                $value = (!empty($option['value']) ? $option['value'] : null);
                                                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                $selected = ( $value == $rec ? 'selected' : null );
                                                                ?>
                                                                <option 
                                                                    <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="qty_used">Qty Used <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-qty_used"  value="<?php  echo $data['qty_used']; ?>" type="number" placeholder="Enter Qty Used" step="0.1" list="qty_used_list"  required="" name="qty_used"  class="form-control " />
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
                                                            <label class="control-label" for="remarks">Remarks </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <textarea placeholder="Enter Remarks" id="ctrl-remarks"  rows="5" name="remarks" class=" form-control"><?php  echo $data['remarks']; ?></textarea>
                                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input id="ctrl-stock_movement_id"  value="<?php  echo $data['stock_movement_id']; ?>" type="hidden" placeholder="Enter Stock Movement Id"  name="stock_movement_id"  class="form-control " />
                                                    <input id="ctrl-encodedby_id"  value="<?php  echo $data['encodedby_id']; ?>" type="hidden" placeholder="Enter Encodedby Id"  required="" name="encodedby_id"  class="form-control " />
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="unit_cost">Unit Cost <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="">
                                                                        <input id="ctrl-unit_cost"  value="<?php  echo $data['unit_cost']; ?>" type="number" placeholder="Enter Unit Cost" step="0.1"  required="" name="unit_cost"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="unit_total">Unit Total <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <input id="ctrl-unit_total"  value="<?php  echo $data['unit_total']; ?>" type="number" placeholder="Enter Unit Total" step="0.1"  required="" name="unit_total"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-ajax-status"></div>
                                                            <div class="form-group text-center">
                                                                <button class="btn btn-primary" type="submit">
                                                                    Update
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
