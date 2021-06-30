  <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div id="printableArea" onload="printDiv('printableArea')">
                        <div class="panel-body">
                            <div class="row print_header">
                                
                                <div class="col-sm-8 company-content">
                                    <?php foreach($company_info as $company){?>
                                    <img src="<?php
                                    if (isset($setting->invoice_logo)) {
                                        echo html_escape($setting->invoice_logo);
                                    }
                                    ?>" class="img-bottom-m" alt="">
                                    <br>
                                    <span class="label label-success-outline m-r-15 p-10" ><?php echo display('billing_from') ?></span>
                                    <address class="margin-top10">
                                        <strong class="company_name_p"><?php echo $company['company_name']?></strong><br>
                                        <?php echo $company['address']?><br>
                                        <abbr><b><?php echo display('mobile') ?>:</b></abbr> <?php echo $company['mobile']?><br>
                                        <abbr><b><?php echo display('email') ?>:</b></abbr> 
                                        <?php echo $company['email']?><br>
                                        <abbr><b><?php echo display('website') ?>:</b></abbr> 
                                        <?php echo $company['website']?><br>
                                      <?php }?>
                                         <abbr><?php echo $tax_regno?></abbr>
                                    </address>
                                    <br>
                                    <span class="label label-success-outline m-r-15"><?php echo display('billing_to') ?></span>

                                    <address class="customer_name_p">  
                                        <strong class="c_name"><?php echo $customer_name?> </strong><br>
                                        <?php if ($customer_address) { ?>
                                            <?php echo $customer_address;?>
                                        <?php } ?>
                                        <br>
                                        <abbr><b><?php echo display('mobile') ?>:</b></abbr>
                                        <?php if ($customer_mobile) { ?>
                                            <?php echo $customer_mobile;?>
                                        <?php }if ($customer_email) {
                                            ?>
                                            <br>
                                            <abbr><b><?php echo display('email') ?>:</b></abbr> 
                                            <?php echo $customer_email;?>
                                        <?php } ?>
                                    </address>
                                   
                                  

                                </div>
                                
                                 
                                <div class="col-sm-4 text-left invoice-address">
                                    <h2 class="m-t-0">Invoice #<?php echo $invoice_no?></h2>
                                    <div class="m-b-15"><?php echo display('billing_date') ?>: <?php echo date("d-M-Y",strtotime($final_date));?></div>
                                    <?php echo form_open_multipart('invoice/invoice/update_order_status',array('class' => 'form-vertical', 'id' => 'insert_sale','name' => 'insert_sale'))?>
                                    <label for="order_status" class="col-form-label">Order Status<i class="text-danger">*</i>
                                            </label>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                    
                                            <select name="order_status" class="form-control" required="">
                                                <option <?php $order_status="NEW" ? "selected" : "" ?> value="NEW">New Order</option>
                                                <option <?php $order_status="WAREHOUSE" ? "selected" : "" ?> value="WAREHOUSE">For Packaging</option> 
                                                <option <?php $order_status="READY" ? "selected" : "" ?> value="READY">For Pickup</option> 
                                                <option <?php $order_status="SHIPPED" ? "selected" : "" ?> value="SHIPPED">Shipped</option> 
                                            </select> 
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-success btn-justify">Update</button>
                                        </div>
                                        <?php echo form_close()?>
                                    </div>
                                </div>
                            </div> 

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                                   <tr>
                                            <th class="text-center"><?php echo display('sl') ?></th>
                                            <th class="text-center"><?php echo display('product_name') ?></th>
                                              <th class="text-center"><?php if($is_unit !=0){ echo display('unit');
                                              }?></th>
                                            <th class="text-center"><?php if($is_desc !=0){ echo display('item_description');} ?></th>
                                            <th class="text-center"><?php if($is_serial !=0){ echo display('serial_no');} ?></th>
                                            <th class="text-right"><?php echo display('quantity') ?></th>
                                            <?php if($is_discount > 0){ ?>
                                            <?php if ($discount_type == 1) { ?>
                                                <th class="text-right"><?php echo display('discount_percentage') ?> %</th>
                                            <?php } elseif ($discount_type == 2) { ?>
                                                <th class="text-right"><?php echo display('discount') ?> </th>
                                            <?php } elseif ($discount_type == 3) { ?>
                                                <th class="text-right"><?php echo display('fixed_dis') ?> </th>
                                            <?php } ?>
                                        <?php }else{ ?>
<th class="text-right"><?php echo ''; ?> </th>
<?php }?>
                                            <th class="text-right"><?php echo display('rate') ?></th>
                                            <th class="text-right"><?php echo display('ammount') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($invoice_all_data as $details){?>
                                        <tr>
                                            <td class="text-center"><?php echo $details['sl']?></td>
                                            <td class="text-center"><div><?php echo $details['product_name']?> - (<?php echo $details['product_model']?>)</div></td>
                                              <td class="text-center"><div><?php echo $details['unit']?></div></td>
                                            <td align="center"><?php echo $details['description']?></td>
                                            <td align="center"><?php echo $details['serial_no']?></td>
                                            <td align="right"><?php echo $details['quantity']?></td>

                                            <?php if ($discount_type == 1) { ?>
                                                <td align="right"><?php echo $details['discount_per']?></td>
                                            <?php } else { ?>
                                                <td align="right"><?php echo (($position == 0) ? $currency.' '.$details['discount_per'] : $details['discount_per'].' '. $currency) ?></td>
                                            <?php } ?>

                                            <td align="right"><?php echo (($position == 0) ? $currency.' '.$details['rate'] : $details['rate'].' '. $currency) ?></td>
                                            <td align="right"><?php echo (($position == 0) ? $currency.' '.$details['total_price'] : $details['total_price'].' '. $currency) ?></td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td class="text-left" colspan="5"><b><?php echo display('grand_total') ?>:</b></td>
                                            <td align="right" ><b><?php echo number_format($subTotal_quantity,2)?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right" ><b><?php echo (($position == 0) ? $currency.' '.$subTotal_ammount  : $subTotal_ammount.' '. $currency) ?></b></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                               <div class="row">

                                <div class="col-xs-8 invoicefooter-content">

                                    <p></p>
                                    <p><strong><?php echo $invoice_details?></strong></p> 
                                   
                                </div>
                                <div class="col-xs-4 inline-block">

                                    <table class="table">
                                        <?php
                                        if ($invoice_all_data[0]['total_discount'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="border-bottom-top"><?php echo display('total_discount') ?> : </th>
                                                <td class="text-right border-bottom-top"><?php echo html_escape((($position == 0) ? $currency.' '.$total_discount  : $total_discount.' '. $currency)) ?> </td>
                                            </tr>
                                            <?php
                                        }
                                        if ($invoice_all_data[0]['total_tax'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="text-left border-bottom-top"><?php echo display('tax') ?> : </th>
                                                <td  class="text-right border-bottom-top"><?php echo html_escape((($position == 0) ? $currency.' '.$total_tax : $total_tax.' '. $currency)) ?> </td>
                                            </tr>
                                        <?php } ?>
                                         <?php if ($invoice_all_data[0]['shipping_cost'] != 0) {
                                            ?>
                                            <tr>
                                                <th class="text-left border-bottom-top"><?php echo 'Shipping Cost' ?> : </th>
                                                <td class="text-right border-bottom-top"><?php echo html_escape((($position == 0) ? $currency.' '.$shipping_cost: $shipping_cost.' '. $currency)) ?> </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th class="text-left grand_total"><?php echo display('grand_total') ?> :</th>
                                            <td class="text-right grand_total"><?php echo html_escape((($position == 0) ? $currency.' '.$total_amount : $total_amount.' '. $currency)) ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                         </tr>
  
                                    </table>

                                   

                                </div>
                            </div>
                            <div class="row margin-top50">
                                <div class="col-sm-4">
                                 <div class="inv-footer-left">
                                        <?php echo display('received_by') ?>
                                    </div>
                                </div>
                               <div class="col-sm-4"></div>
                                     <div class="col-sm-4"> <div class="inv-footer-right">
                                        <?php echo display('authorised_by') ?>
                                    </div></div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="panel-footer text-left">
                       
                        <button  class="btn btn-info" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>

                    </div>
                </div>
            </div>
        </div>