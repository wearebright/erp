
                     <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 
                        <?php echo form_open('return_to_sender_report', array('class' => 'form-inline', 'method' => 'get')) ?>
                        
                            <div class="col-sm-3">
                           
                            <label class="col-sm-4" for="product"><?php echo display('product') ?></label>
                            <div class="col-sm-8">
                            <select name="product_id" class="form-control">
                                <option value=""></option>
                                <?php foreach($product_list as $productss){?>
                               <option value="<?php echo  $productss['product_id']?>" <?php if($productss['product_id'] == $product_id){echo 'selected';}?>><?php echo  $productss['product_name']?></option>
                                <?php }?>    
                            </select>
                       </div>
                            </div>
                            <div class="col-sm-7">
                               <div class="col-sm-6"> 
                            <label class="col-sm-4" for="from_date"><?php echo display('start_date') ?></label>
                            <div class="col-sm-8">
                            <input type="text" autocomplete="off" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $from?>">
                       
                             </div>
                         </div>
                        <div class="col-sm-6">
                            <label class="col-sm-4" for="to_date"><?php echo display('end_date') ?></label>
                            <div class="col-sm-8">
                            <input type="text" autocomplete="off" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $to?>">
                        </div>  
                        </div>
                            </div>
                            <div class="col-sm-2">
                                  <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo display('print') ?></a>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>

       

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo display('sales_report_product_wise') ?></span>
                             <span class="padding-lefttitle">
                                <?php if($this->permission1->method('return_to_sender_report','read')->access()){ ?>
                                    <a href="<?php echo base_url('return_to_sender_report') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('return_to_sender_report') ?> </a>
                                <?php }?>
                                <?php if($this->permission1->method('top_returning_product','read')->access()){ ?>
                                    <a href="<?php echo base_url('top_returning_product') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('top_returning_product') ?> </a>
                                <?php }?>
                                <?php if($this->permission1->method('rts_prone_areas','read')->access()){ ?>
                                    <a href="<?php echo base_url('rts_prone_areas') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('rts_prone_areas') ?> </a>
                                <?php }?>
                                <?php if($this->permission1->method('rts_reasons','read')->access()){ ?>
                                    <a href="<?php echo base_url('rts_reasons') ?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('rts_reasons') ?> </a>
                                <?php }?>         
                             </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="purchase_div" class="table-responsive ">
                            <div class="paddin5ps">
                                      <table class="print-table" width="100%">
                
                <tr>
                    <td align="left" class="print-table-tr">
                        <img src="<?php echo base_url().$setting->logo;?>" alt="logo">
                    </td>
                    <td align="center" class="print-cominfo">
                        <span class="company-txt">
                            <?php echo $company_info[0]['company_name'];?>
                           
                        </span><br>
                        <?php echo $company_info[0]['address'];?>
                        <br>
                        <?php echo $company_info[0]['email'];?>
                        <br>
                         <?php echo $company_info[0]['mobile'];?>
                        
                    </td>
                   
                     <td align="right" class="print-table-tr">
                        <date>
                        <?php echo display('date')?>: <?php
                        echo date('d-M-Y');
                        ?> 
                    </date>
                    </td>
                </tr>            
                                   
                                </table>
                            </div>

                            <div class="table-responsive paddin5ps">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('sales_date') ?></th>                                         
                                            <th><?php echo display('product_name') ?></th>
                                            <th><?php echo display('quantity') ?></th>
                                            <th class="text-right"><?php echo display('rate') ?></th>
                                            <th class="text-right"><?php echo display('total_ammount') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($rts_report) {
                                            foreach($rts_report as $reporst){
                                            ?>
                                                <tr>
                                                    <td><?php echo $reporst['sales_date']?></td>
                                                    <td><?php echo $reporst['product_name']?></td>
                                                    <td><?php echo $reporst['shipments']?></td>
                                                    <td class="text-right"><?php echo (($position == 0) ? $currency.' '.$reporst['rate'] : $reporst['rate'].' '.$currency) ?></td>
                                                    <td class="text-right"><?php echo (($position == 0) ? $currency.' '. $reporst['product_total_amount'] : $reporst['product_total_amount'].' '.$currency) ?></td>
                                                </tr>
                                            
                                            <?php
                                            }
                                        }else{
                                        ?>
                                            <td colspan="7" class="text-center">No Record Found</td>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" align="right">&nbsp; <b><?php echo display('total_ammount') ?></b></td>
                                            <td class="text-right"><b><?php echo (($position == 0) ? $currency.' '.$sub_total : $sub_total.' '.$currency) ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><b><?php echo display('total_ammount') ?></b></td>
                                            <td colspan="1" class="text-right"><b><?= display('total_sales') ?></b></td>
                                            <td colspan="1" class="text-right"><b><?= display('percentage') ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right"><b><?= (($position == 0) ? $currency.' '.$sub_total : $sub_total.' '.$currency) ?></b></td>
                                            <td colspan="1" class="text-right"><b><?=  $currency.' '.$total_sales ?></b></td>
                                            <td colspan="1" class="text-right"><b><?= $rts_percentage ?></b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   