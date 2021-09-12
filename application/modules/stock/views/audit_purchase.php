<script src="<?php echo base_url()?>my-assets/js/admin_js/stock.js" type="text/javascript"></script>

  <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('edit_purchase') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                    <?php echo form_open_multipart('stock/stock/update_purchase',array('class' => 'form-vertical', 'id' => 'purchase_update'))?>
                        

                        <div class="row">
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-4 col-form-label"><?php echo display('supplier') ?>
                                    </label>
                                    <div class="col-sm-6">
                                            <?php foreach($supplier_list as $suppliers){?>
                                            <?= ($suppliers['supplier_id'] == $supplier_id) ? $suppliers['supplier_name'] : "";?>
                                            <?php }?>
                                    </div>
                                </div> 
                            </div>

                             <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('purchase_date') ?>:
                                    </label>
                                    <div class="col-sm-6">
                                        <?php $date = date('Y-m-d'); ?>
                                        <?php echo $purchase_date?>
                                        <input type="hidden" name="purchase_id" value="<?php echo $purchase_id?>">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="invoice_no" class="col-sm-4 col-form-label"><?php echo display('invoice_no') ?>:
                                    </label>
                                    <div class="col-sm-6">
                                        <?php echo $chalan_no;?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?>:
                                    </label>
                                    <div class="col-sm-6">
                                        <?= $purchase_details ? $purchase_details : 'N/A';?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                            <div class="row">
                              <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                        echo display('payment_type');
                                        ?></label>
                                    <div class="col-sm-6">
                                    <?= $paytype ==1 ? display('cash_payment'): display('bank_payment') ?>
                                    </div>
                                 
                                </div>
                            </div>
                             <div class="col-sm-6" id="bank_div">
                            <div class="form-group row">
                                <label for="bank" class="col-sm-4 col-form-label"><?php
                                    echo display('bank');
                                    ?> <i class="text-danger"></i></label>
                                <div class="col-sm-6">
                                   <select name="bank_id" class="form-control bankpayment"  id="bank_id">
                                        <option value="">Select Location</option>
                                        <?php foreach($bank_list as $bank){?>
                                            <option value="<?php echo $bank['bank_id']?>" <?php if($bank['bank_id'] == $bank_id){echo 'selected';}?>><?php echo $bank['bank_name'];?></option>
                                        <?php }?>
                                    </select>
                                    <input type="hidden" id="editpayment_type" value="<?php echo $paytype;?>" name="">
                                 
                                </div>
                             
                            </div>
                        </div>
                        </div>

                      <br>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th width="20%"><?php echo display('item_information') ?></th> 
                                            <th class="text-right"><?php echo display('quantity') ?></th>
                                            <th class="text-right"><?php echo display('total_received') ?></th>
                                            <th class="text-right"><?php echo display('receive') ?></th>
                                        </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <?php foreach($purchase_info as $purchases){?>
                                    <tr>
                                        <td class="span3 supplier">
                                           <?php echo $purchases['product_name']?>

                                            <input type="hidden" class="autocomplete_hidden_value product_id_<?php echo $purchases['sl']?>" name="product_id[]" id="SchoolHiddenId" value="<?php echo $purchases['product_id']?>"/>
                                            <input type="hidden" name="id[]" value="<?php echo $purchases['id']?>">
                                            <input type="hidden" class="sl" value="<?php echo $purchases['sl']?>">
                                        </td>
                                        
                                            <td class="text-right">
                                                <input type="text" name="product_quantity[]" id="cartoon_<?php echo $purchases['sl']?>" class="form-control text-right store_cal_<?php echo $purchases['sl']?>" onkeyup="calculate_store(<?php echo $purchases['sl']?>);" onchange="calculate_store(<?php echo $purchases['sl']?>);" placeholder="0.00" value="<?php echo $purchases['quantity']?>" readonly min="0" tabindex="6"/>
                                            </td>
                                           
                                            <td class="text-right">
                                                <input class="form-control text-right" name="product_quantity_received[]"  type="text" name="" onkeyup="calculate_pendingPurchase(<?php echo $purchases['sl']?>);"  id="received_quantity_<?php echo $purchases['sl']?>" value="<?php echo $purchases['quantity_received']?>" readonly="readonly"/>
                                                <input class="form-control text-right" type="hidden" name="" onkeyup="calculate_pendingPurchase(<?php echo $purchases['sl']?>);"  id="current_received_quantity_<?php echo $purchases['sl']?>" value="<?php echo $purchases['quantity_received']?>" readonly="readonly"/>
                                            </td>
                                            <td class="text-right">
                                                <input class="form-control text-right" name="receive[]"  type="text" name="" onkeyup="calculate_pendingPurchase(<?php echo $purchases['sl']?>);"  id="receive_<?php echo $purchases['sl']?>" value=""  />
                                            </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add_purchase" class="btn btn-primary btn-large" name="add-purchase" value="<?php echo display('submit') ?>" />
                               
                            </div>
                        </div>
                    <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>


