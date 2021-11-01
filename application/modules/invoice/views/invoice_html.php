  <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div id="printableArea" onload="printDiv('printableArea')">
                        <div class="panel-body">
                            <div class="row print_header">
                                <div class="col-sm-6 text-left">
                                    <h2 class="m-t-0">Invoice #<?php echo $invoice_no?></h2>
                                    <div class="m-b-15"><?php echo display('billing_date') ?>: <?php echo date("d-M-Y",strtotime($final_date));?></div>
                                    <form action="/invoice/invoice/update_order_status" class="form-vertical" id="insert_sale" name="insert_sale" onsubmit="if(!confirm('Are you sure want to update the status?')){return false}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                        <input type="hidden" name="invoice_id" value="<?= $invoice_id ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="order_status" class="col-form-label">Order Status<i class="text-danger">*</i>
                                                </label>
                                                <div class="form-group">
                                                    <select name="order_status" class="form-control" required="" onchange="selectStatus()">
                                                        <option <?= $invoice_order_status == "NEW" ? "selected" : "" ?> <?= $invoice_order_status == "WAREHOUSE" || $invoice_order_status == "READY" || $invoice_order_status == "SHIPPED" || $invoice_order_status == "COMPLETED" || $invoice_order_status == "RETURN_TO_SENDER" ? "disabled" : "" ?>  value="NEW">New Order</option>
                                                        <option <?= $invoice_order_status == "WAREHOUSE" ? "selected" : "" ?> <?= $invoice_order_status == "READY" || $invoice_order_status == "SHIPPED" || $invoice_order_status == "COMPLETED" || $invoice_order_status == "RETURN_TO_SENDER" ? "disabled" : "" ?> value="WAREHOUSE">In Packaging</option> 
                                                        <option <?= $invoice_order_status == "READY" ? "selected" : "" ?> <?= $invoice_order_status == "NEW" || $invoice_order_status == "SHIPPED" || $invoice_order_status == "COMPLETED" || $invoice_order_status == "RETURN_TO_SENDER" ? "disabled" : "" ?> value="READY">For Shipment</option> 
                                                        <option <?= $invoice_order_status == "SHIPPED" ? "selected" : "" ?> <?= $invoice_order_status == "NEW" || $invoice_order_status == "WAREHOUSE" || $invoice_order_status == "COMPLETED" || $invoice_order_status == "RETURN_TO_SENDER" ? "disabled" : "" ?> value="SHIPPED">Shipped</option> 
                                                        <option <?= $invoice_order_status == "RETURN_TO_SENDER" ? "selected" : "" ?> <?= $invoice_order_status == "NEW" || $invoice_order_status == "WAREHOUSE" || $invoice_order_status == "READY" || $invoice_order_status == "COMPLETED" || $invoice_order_status == "WAREHOUSE" ? "disabled" : "" ?> value="RETURN_TO_SENDER">Return to Sender</option>
                                                        <option <?= $invoice_order_status == "COMPLETED" ? "selected" : "" ?> <?= $invoice_order_status == "NEW" || $invoice_order_status == "WAREHOUSE" || $invoice_order_status == "READY" || $invoice_order_status == "SHIPPED" || $invoice_order_status == "RETURN_TO_SENDER" ? "disabled" : "" ?> value="COMPLETED">Completed</option> 
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 logistics_option">
                                                <label for="order_status" class="col-form-label">Logistics
                                                </label>
                                                <div class="form-group">
                                                    <select name="logistics" class="form-control" required="" onchange="selectStatus()">
                                                        <option disabled>Select Option</option>
                                                        <?php foreach($logistics_list as $logistics){?>
                                                            <option <?= $courier == $logistics['logistics_name'] ? "selected" : "" ?> value="<?= $logistics['logistics_name'] ?>"><?= $logistics['logistics_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 rts_link" id="rts_link"" style="margin-bottom: 15px; display: <?= $invoice_order_status == 'RETURN_TO_SENDER' ? 'block': 'none'; ?>">
                                                <a class="btn btn-success btn-large" target="_blank" href="/invoice_return/<?php echo $invoice_no?>">Return to Sender</a>
                                            </div>
                                            <div class="col-sm-12" id="payment_from">
                                                <div class="form-group">
                                                    <label for="payment_type" class="col-form-label"><?php
                                                        echo display('payment_type');
                                                        ?> <i class="text-danger">*</i>
                                                    </label>                                   
                                                    <select name="paytype" class="form-control" required="" tabindex="3" <?= $invoice_order_status == 'RETURN_TO_SENDER' || $invoice_order_status == 'SHIPPED' || $invoice_order_status == 'COMPLETED' ? 'disabled': ''; ?>>
                                                        <option <?= $payment_type == "1" ? "selected" : "" ?> value="1">Cash On Delivery</option>
                                                        <option <?= $payment_type == "2" ? "selected" : "" ?> value="2">Cash On Pick-up</option> 
                                                        <option <?= $payment_type == "3" ? "selected" : "" ?> value="3">Online Payment</option> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="returnAdditionalFields" style="display: <?= $invoice_order_status == 'RETURN_TO_SENDER' ? 'block': 'none'; ?>">
                                            <div class="col-md-6">
                                                <label for="order_status" class="col-form-label">Reason</label>
                                                <div class="form-group">
                                                    <select name="reason" class="form-control" required="" onchange="selectStatus()">
                                                        <option disabled>Select Option</option>
                                                        <?php foreach($return_reasons as $reason){?>
                                                            <option <?= $return_reason == $reason['reason'] ? "selected" : "" ?> value="<?= $reason['reason'] ?>"><?= $reason['reason'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="order_status" class="col-form-label">Region
                                                </label>
                                                <div class="form-group">
                                                    <select name="region" class="form-control" required="">
                                                        <option disabled>Select Option</option>
                                                        <?php foreach($regions as $region){?>
                                                            <option <?= $selected_region == $region['region_name'] ? "selected" : "" ?> value="<?= $region['region_name'] ?>"><?= $region['region_name'] ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="awbField"  >
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="order_status" class="col-form-label">AWB</label>
                                                    <input type="text" class="form-control" name="awb" value="<?= $awb ?>" <?= $invoice_order_status == 'RETURN_TO_SENDER' || $invoice_order_status == 'SHIPPED' ? 'disabled': ''; ?> >
                                                </div>
                                            </div>
                                        </div>
                                        <div id="invoiceAdditionalFields">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="order_status" class="col-form-label">Remarks</label>
                                                        <textarea rows="3" class="form-control" name="comment"><?= $invoice_comment ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                               
                                                <?php
                                                    if($invoice_attachment){
                                                ?>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Proof Attachment</label>
                                                    <a target="_blank" style="margin-bottom: 15px; max-width: 200px;" href="<?= base_url().$invoice_attachment ?>">
                                                        <img style="width: 100%;" src="<?= $invoice_attachment ? base_url().$invoice_attachment: '' ?>" id="attachment_preview"/>
                                                    </a>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                                <div class="col-md-6">
                                                <div class="form-group " id="attachmentField" style="display: <?= $invoice_order_status == 'SHIPPED' ? 'none': 'block'; ?>">
                                                    <?php
                                                    if($invoice_attachment){
                                                    ?>
                                                        <label for="order_status" class="col-form-label">Update Attachment</label>
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <label for="order_status" class="col-form-label">Attachment</label>
                                                    <?php

                                                    } ?>

                                                        <!-- <input type="file" name="orderAttachment"/> -->
                                                        <div class="customFileInputWrapper">
                                                            <label for="et_pb_contact_brand_file_request_0" class="et_pb_contact_form_label">Enter</label>
                                                            <input name="orderAttachment" accept="image/*" onchange="readURL(this);" type="file" id="et_pb_contact_brand_file_request_0" class="file-upload">
                                                            <input name="orderAttachment_old" type="hidden" value="<?= $invoice_attachment ?>">
                                                        </div>
                                                    </div>


                                                    </div>

                                            </div>
                                            
                                        </div>
                                        <div class="form-group row" style="margin-bottom:40px; float:right;">
                                            <div class="col-md-4">
                                                <input  type="submit" class="btn btn-success btn-justify" value="Update">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <!-- <?php foreach($company_info as $company){?>
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
                                    <br> -->
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
                                
                                    <!-- INVOICE TABLE HERE -->
         
                                    
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
                                                    <td align="right"><?php echo number_format($details['quantity'],0) ?></td>

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
                                                    <td align="right" ><b><?php echo number_format($subTotal_quantity,0)?></b></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="right" ><b><?php echo (($position == 0) ? $currency.' '.$subTotal_ammount  : $subTotal_ammount.' '. $currency) ?></b></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 invoicefooter-content">

                                            <p></p>
                                            <p><strong><?php echo $invoice_details?></strong></p> 
                                        
                                        </div>
                                        <div class="col-xs-6 inline-block">

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
                                </div>
                            </div> 

                            <!-- <div class="row margin-top50">
                                <div class="col-sm-4">
                                 <div class="inv-footer-left">
                                        <?php echo display('received_by') ?>
                                    </div>
                                </div>
                               <div class="col-sm-4"></div>
                                     <div class="col-sm-4"> <div class="inv-footer-right">
                                        <?php echo display('authorised_by') ?>
                                    </div></div>
                            </div> -->
                            
                            
                            <div class="row" style="margin: 15px 0px;">
                                <div class="col-sm-12" id="actionBar" style="display: <?= $invoice_order_status == 'RETURN_TO_SENDER' || $invoice_order_status == 'COMPLETED' ? 'none': 'block'; ?>">
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label" style="padding: 13px 0px;">
                                            <?= display('scan_barcode')?>
                                        </label>
                                        <div class="col-sm-5">
                                            <input autocomplete="off" style="height: 48px; border-color: #d1d1d1;" class="form-control" autofocus placeholder="Product ID" id="productID" onchange="getProductDetails()" type="text" size="100" name="product_id" class=" form-control"/>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <form action="/tracking/outgoing/saveOutgoing" method="POST">
                                                <button type="submit" class="btn btn-primary" id="saveOutgoing">Save to Outgoing</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" >
                                <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="PrdScan"> 
                                    <thead>
                                        <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('product_id') ?></th>
                                        <th><?php echo display('product_name') ?></th>
                                        <th><?php echo display('product_model') ?></th>
                                        <th><?php echo display('scan_by') ?></th>
                                        <th><?php echo display('price') ?></th>
                                        <th><?php echo display('quantity') ?></th>
                                        <th><?php echo display('date') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($outgoing_data as $key => $value) {
                                        ?>
                                            <tr>
                                                <td><?= $value['id'] ?></td>
                                                <td><?= $value['product_id'] ?></td>
                                                <td><?= $value['product_name'] ?></td>
                                                <td><?= $value['product_model'] ?></td>
                                                <td><?= $value['first_name'] . '' . $value['last_name'] ?></td>
                                                <td><?= $value['price'] ?></td>
                                                <td><?= $value['quantity'] ?></td>
                                                <td><?= $value['created_at'] ?></td>
                                                <td class="text-center">
                                                    <a href="/tracking/outgoing/remove/<?= $value['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are You Sure ?')">
                                                        <i class='fa fa-trash'></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                                
                            </div>
                           
                        </div>
                    </div>
                    

                    <!-- <div class="panel-footer text-left">
                       
                        <button  class="btn btn-info" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></button>

                    </div> -->
                </div>
            </div>
        </div>
<script>
    function selectStatus(){
        let order_status = $('select[name=order_status] option').filter(":selected").val();
        console.log(order_status);
        // if(order_status == 'NEW' || order_status == 'WAREHOUSE'|| order_status == 'RETURN_TO_SENDER'){
        //     $('#invoiceAdditionalFields').show();
        // }else{
        //     $('#invoiceAdditionalFields').hide();
        // }

        if(order_status === 'RETURN_TO_SENDER'){
            $('#returnAdditionalFields').show();
            $('select[name=paytype]').attr('disabled', true);
            $('#awbField').hide();
            $('#rts_link').show();
        }else{
            $('#returnAdditionalFields').hide();
            $('select[name=paytype]').attr('disabled', false);
            $('#awbField').show();
            $('#rts_link').hide();
        }

        if(order_status === 'READY'){
            $('input[name=awb]').attr('required', true);
        }else{
            $('input[name=awb]').attr('required', false);
        }

        if(order_status === 'RETURN_TO_SENDER' || order_status === 'COMPLETED'){
            $('#actionBar').hide();
        }else{
            $('#actionBar').show();
        }

        if(order_status === 'SHIPPED' || order_status === 'COMPLETED'){
            $('input[name=awb]').attr('disabled', true);
            $('select[name=paytype]').attr('disabled', true);
            $('#attachmentField').hide();
        }else{
            $('input[name=awb]').attr('disabled', false);
            $('#attachmentField').show();
        }
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#attachment_preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $('input[type="file"]').on('click', function() {
            $(".file_names").html("");
        })
        if ($('input[type="file"]')[0]) {
            var fileInput = document.querySelector('label[for="et_pb_contact_brand_file_request_0"]');
            fileInput.ondragover = function() {
                this.className = "et_pb_contact_form_label changed";
                return false;
            }
            fileInput.ondragleave = function() {
                this.className = "et_pb_contact_form_label";
                return false;
            }
            fileInput.ondrop = function(e) {
                e.preventDefault();
                var fileNames = e.dataTransfer.files;
                for (var x = 0; x < fileNames.length; x++) {
                    console.log(fileNames[x].name);
                    $=jQuery.noConflict();
                    $('label[for="et_pb_contact_brand_file_request_0"]').append("<div class='file_names'>"+ fileNames[x].name +"</div>");
                }
            }
            $('#et_pb_contact_brand_file_request_0').change(function() {
                var fileNames = $('#et_pb_contact_brand_file_request_0')[0].files[0].name;
                // $('label[for="et_pb_contact_brand_file_request_0"]').append("<div class='file_names'>"+ fileNames +"</div>");
                $('label[for="et_pb_contact_brand_file_request_0"]').css('background-color', '##eee9ff');
            });
            }
        });


</script>

<script>
    function getProductDetails() {
        var productEl = document.getElementById('productID');
        var CSRF_TOKEN = $('#CSRF_TOKEN').val();
        var base_url = $('#base_url').val();

        $.ajax( {
          url: base_url + "/tracking/outgoing/addOutgoing",
          method: 'post',
          dataType: "json",
          data: {
            product_id: productEl.value,
            invoice_id: $('input[name=invoice_id]').val(),
          },
          success: function( res ) {
            console.log( res );
            if(!res.error){
                let html  = "";
                res.data.forEach((element, index) => {
                    html += "<tr><td>"+element.id+"</td><td>"+element.product_id+"</td><td>"+element.product_name+"</td><td>"+element.product_model+"</td><td>"+element.first_name+" "+ element.last_name+"</td><td>"+element.price+"</td><td>"+element.quantity+"</td><td>"+element.created_at+"</td><td class='text-center'><a href='"+base_url+"/tracking/outgoing/remove/"+element.id+"' class='btn btn-xs btn-danger' onclick='return confirm('Are You Sure ?')'><i class='fa fa-trash'></i></a></td></tr>"
                    if( (index+1) >= res.data.length){
                        $('#PrdScan tbody').html(html);
                    }
                });
            }else{
                alert(res.message);
            }
          }
        });
        
        productEl.value = "";
    }
</script>