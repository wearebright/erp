<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>
       


        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo display('new_invoice') ?></span>
                           <span class="padding-lefttitle">            
       <?php if($this->permission1->method('manage_invoice','read')->access()){ ?>
                    <a href="<?php echo base_url('invoice_list') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('manage_invoice') ?> </a>
                    <?php }?>
                            </span>
                        </div>
                    </div>
                 
                    <div class="panel-body">
                        <?php echo form_open_multipart('invoice/invoice/bdtask_manual_sales_insert',array('class' => 'form-vertical', 'id' => 'insert_sale','name' => 'insert_sale'))?>
                        <div class="row">

                            <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-3 col-form-label"><?php
                                        echo display('customer_name').'/'.display('phone');
                                        ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="text" size="100"  name="customer_name" class=" form-control" placeholder='<?php echo display('customer_name').'/'.display('phone') ?>' id="customer_name" tabindex="1" onkeyup="customer_autocomplete()" value="<?php echo $customer_name?>"/>

                                        <input id="autocomplete_customer_id" class="customer_hidden_value abc" type="hidden" name="customer_id" value="<?php echo $customer_id?>">
                                    </div>
                                     <?php if($this->permission1->method('add_customer','create')->access()){ ?>
                                    <div  class=" col-sm-3">
                                         <a href="#" class="client-add-btn btn btn-success" aria-hidden="true" data-toggle="modal" data-target="#cust_info"><i class="ti-plus m-r-2"></i></a>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>

                          
                            <div class="col-sm-6" id="payment_from">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-3 col-form-label"><?php
                                        echo display('payment_type');
                                        ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">                                      
                                        <select name="paytype" class="form-control" required="" tabindex="3">
                                            <option value="1">Cash On Delivery</option>
                                            <option value="2">Cash On Pick-up</option> 
                                            <option value="3">Online Payment</option> 
                                        </select>   
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" style="display: <?= $user_type == 1 ? 'block':'none' ?>;">
                                <div class="form-group row">
                                    <label for="sales_channel" class="col-sm-3 col-form-label">Sales Channel<i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">                                      
                                        <select name="sales_channel" class="form-control" required="" onchange="getTeam()" >
                                            <?php 
                                                foreach ($departments as $key => $value) {
                                            ?>
                                                    <option <?= $user_department->department_id === $value->id ? 'selected':'' ?> value="<?= $value->department_name ?>"><?= $value->department_name ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-3 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <?php
                               
                                        $date = date('Y-m-d');
                                        ?>
                                        <input class="datepicker form-control" type="text" size="50" name="invoice_date" id="date" required value="<?php echo html_escape($date); ?>" tabindex="4" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6" style="display: none;">
                                <div class="form-group row" style="min-width:150px;">
                                    <label class="col-sm-3 col-form-label" for="from_date"><?php echo display('group_name') ?></label>
                                    <div class="col-sm-6">
                                        <select id="sales_team" name="sales_team" class="form-control">
                                            <option <?= $selected_team=='All'?"selected":"" ?> value="All">All</option>  
                                            <?php 
                                                foreach ($teams as $key => $value) {
                                            ?>
                                                    <option <?= $user_group->group_id === $value->id ? 'selected':'' ?> value="<?= $value->id ?>"><?= $value->group_name ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select> 
                                    </div> 
                                </div> 
                            </div>

                            <div class="col-sm-6">
                                 <div class="form-group row">
                                <label for="invoice_no" class="col-sm-3 col-form-label"><?php
                                    echo display('invoice_no');
                                    ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                         <input class="form-control" type="text"  name="invoice_no" id="invoice_no" required value="<?php echo html_escape($invoice_no); ?>" readonly/>
                                    </div>
                            </div>
                        </div>
                                  <div class="col-sm-6" id="bank_div">
                            <div class="form-group row">
                                <label for="bank" class="col-sm-3 col-form-label"><?php
                                    echo display('bank');
                                    ?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                   <select name="bank_id" class="form-control bankpayment"  id="bank_id">
                                        <option value="">Select Location</option>
                                        <?php foreach($bank_list as $bank){?>
                                            <option value="<?php echo html_escape($bank['bank_id'])?>"><?php echo html_escape($bank['bank_name']);?></option>
                                        <?php }?>
                                    </select>
                                 
                                </div>
                             
                            </div>
                        </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center product_field"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('item_description')?></th>
                                        <th class="text-center"><?php echo display('available_qnty') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center invoice_fields"><?php echo display('total') ?> 
                                        </th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <tr>
                                        <td class="product_field">
                                            <input type="text" required name="product_name" onkeypress="invoice_productList(1)" id="product_name_1" class="form-control productSelection" autocomplete="off" placeholder="<?php echo display('product_name') ?>"   tabindex="5">

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId"/>

                                            <input type="hidden" class="baseUrl" value="<?php echo base_url(); ?>" />
                                        </td>
                                          <td>
                                            <input type="text" name="desc[]" class="form-control text-right "  tabindex="6"/>
                                        </td>
                                        <td>
                                            <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_1" value="0" readonly="" />
                                        </td>
                                        <td>
                                            <input type="text" name="product_quantity[]" required="" onkeyup="bdtask_invoice_quantity_calculate(1);" onchange="bdtask_invoice_quantity_calculate(1);" class="total_qntt_1 form-control text-right" id="total_qntt_1" placeholder="0.00" min="0" tabindex="8"  value="1" />
                                        </td>
                                        <td class="invoice_fields">
                                            <input type="text" name="product_rate[]" id="price_item_1" class="price_item1 price_item form-control text-right" tabindex="9" required="" onkeyup="bdtask_invoice_quantity_calculate(1);" onchange="bdtask_invoice_quantity_calculate(1);" placeholder="0.00" min="0" />
                                        </td>
                                        <input type="hidden" name="discount[]" id="discount_1" class="form-control text-right common_discount" placeholder="0.00" min="0">
                                        <td class="invoice_fields">
                                            <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" />
                                        </td>

                                        <td>
                                            <!-- Tax calculate start-->
                                            <?php $x=0;
                                     foreach($taxes as $taxfldt){?>
                                            <input id="total_tax<?php echo $x;?>_1" class="total_tax<?php echo $x;?>_1" type="hidden">
                                            <input id="all_tax<?php echo $x;?>_1" class="total_tax<?php echo $x;?>" type="hidden" name="tax[]">
                                           
                                            <!-- Tax calculate end-->

                                            <!-- Discount calculate start-->
                                           
                                            <?php $x++;} ?>
                                            <!-- Tax calculate end-->

                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_1" class="" />
                                            <input type="hidden" id="all_discount_1" class="total_discount dppr" name="discount_amount[]" />
                                            <!-- Discount calculate end -->

                                         <button  class='btn btn-danger text-right' type='button' value='Delete' onclick='deleteRow_invoice(this)'><i class='fa fa-close'></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                     <tr>
                                        <td colspan="4" rowspan="2">
                                <center><label  for="details" class="  col-form-label text-center"><?php echo display('invoice_details') ?></label></center>
                                <textarea name="inva_details" id="details" class="form-control" placeholder="<?php echo display('invoice_details') ?>" tabindex="12"></textarea>
                                </td>
                                    <td class="text-right" colspan="1"><b><?php echo display('invoice_discount') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" onkeyup="bdtask_invoice_quantity_calculate(1);"  onchange="bdtask_invoice_quantity_calculate(1);" id="invoice_discount" class="form-control text-right total_discount" name="invoice_discount" placeholder="0.00"   tabindex="13"/>
                                        <input type="hidden" id="txfieldnum">
                                    </td>
                                    <td><a href="javascript:void(0)"  id="add_invoice_item" class="btn btn-info" name="add-invoice-item"  onClick="addInputField_invoice('addinvoiceItem');"  tabindex="11"><i class="fa fa-plus"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="1"><b><?php echo display('total_discount') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" value="0.00" readonly="readonly" />
                                    </td>
                                </tr>
                                    <?php $x=0;
                                     foreach($taxes as $taxfldt){?>
                                    <tr class="hideableRow hiddenRow">
                                       
                                <td class="text-right" colspan="6"><b><?php echo html_escape($taxfldt['tax_name']) ?></b></td>
                                <td class="text-right">
                                    <input id="total_tax_ammount<?php echo $x;?>" tabindex="-1" class="form-control text-right valid totalTax" name="total_tax<?php echo $x;?>" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                                </tr>
                            <?php $x++;}?>
                                 
                    <tr>
                                    <tr style="display:none;">
                                <td class="text-right" colspan="5"><b><?php echo display('total_tax') ?>:</b></td>
                                <td class="text-right">
                                    <input id="total_tax_amount" tabindex="-1" class="form-control text-right valid" name="total_tax" value="0.00" readonly="readonly" aria-invalid="false" type="text">
                                </td>
                                 <td><button type="button" class="toggle btn-warning">
                <i class="fa fa-angle-double-down"></i>
              </button></td>
                                </tr>
                               
                                 <tr>
                                    <td class="text-right" colspan="5"><b><?php echo display('shipping_cost') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="shipping_cost" class="form-control text-right" name="shipping_cost" onkeyup="bdtask_invoice_quantity_calculate(1);"  onchange="bdtask_invoice_quantity_calculate(1);"  placeholder="0.00" tabindex="14" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5"  class="text-right"><b><?php echo display('grand_total') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="grandTotal" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                                    </td>
                                </tr>
                                 <tr style="display:none;">
                                    <td colspan="5"  class="text-right"><b><?php echo display('previous'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="previous" class="form-control text-right" name="previous" value="0.00" readonly="readonly" />
                                    </td>
                                </tr>
                                <tr style="display:none;">
                                    <td colspan="5"  class="text-right"><b><?php echo display('net_total'); ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="n_total" class="form-control text-right" name="n_total" value="0" readonly="readonly" placeholder="" />
                                    </td>
                                </tr>
                                <tr style="display:none;">
                                    
                                    <td class="text-right" colspan="7"><b><?php echo display('paid_ammount') ?>:</b></td>
                                    <td class="text-right">
                                         <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url(); ?>"/>
                                        <input type="text" id="paidAmount" 
                                               onkeyup="invoice_paidamount();" class="form-control text-right" name="paid_amount" placeholder="0.00" tabindex="15" value=""/>
                                    </td>
                                </tr>
                                <tr style="display:none;">
                                   

                                    <td class="text-right" colspan="7"><b><?php echo display('due') ?>:</b></td>
                                    <td class="text-right">
                                        <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="0.00" readonly="readonly"/>
                                    </td>
                                </tr>
                                <tr>
                                     <td colspan="6" style="text-align:right" >
                                        <input style="display:none;" type="button" id="full_paid_tab" class="btn btn-warning" value="<?php echo display('full_paid') ?>" tabindex="16" onClick="invoicee_full_paid()"/>

                                        <input type="submit" id="add_invoice" class="btn btn-success btn-lg" name="add-invoice" value="<?php echo display('submit') ?>" tabindex="17"/>
                                    </td>
                                    <td style="display:none;" colspan="6"  class="text-right"><b><?php echo display('change'); ?>:</b></td>
                                    <td style="display:none;" class="text-right">
                                        <input type="text" id="change" class="form-control text-right" name="change" value="0" readonly="readonly" placeholder="" />
                                        <input type="hidden" name="is_normal" value="1">
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                               <?php echo form_close()?>
                    </div>
                   
                </div>
            </div>
     
         
        </div>
        <script>
            function printRawHtml(view) {
              printJS({
                printable: view,
                type: 'raw-html',
                
              });

             }

            function getTeam(){
                var $dept = $('select[name=sales_channel] :selected').text();

                var base_url = $("#base_url").val();

                var myKeyVals = { department : $dept }

                $.ajax({
                    url : base_url + "report/report/get_team_by_department/",
                    data:myKeyVals, 
                    type: "POST",
                    dataType: "json",
                    success: function(data)
                    {
                        $("#sales_team").empty();
                        $("#sales_team").append('<option value="All">All</option>');
                        data.forEach((el, key) => {
                            $("#sales_team").append('<option value=' + el.id + '>' + el.group_name + '</option>');
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }
        </script>
   


