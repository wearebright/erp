
        <?php 
if(isset($_POST['btnSearch']))
{
   $postdate = $_POST['alldata'];
}
$searchdate =(!empty($postdate)?$postdate:date('F Y'));

?>
        
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                 <div class="small-box bg-yellow whitecolor">
            <div class="inner">
              <h4><span class="count-number"><?php echo html_escape($total_customer) ?></span></h4>
              <p><?php echo display('total_customer')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-users"></i>
            </div>
            <?php if($this->permission1->method('manage_customer','read')->access()){ ?>
            <a href="<?php echo base_url('customer_list') ?>" class="small-box-footer"><?php echo display('total_customer')?></a>
        <?php }else{?>
             <a href="javascript:void(0)" class="small-box-footer"><?php echo display('total_customer')?></a>
        <?php }?>
          </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="small-box bg-yellow whitecolor">
            <div class="inner">
              <h4><span class="count-number"><?php echo html_escape($total_product) ?></span></h4>

              <p><?php echo display('total_product')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-shopping-bag"></i>
            </div>
             <?php if($this->permission1->method('manage_product','read')->access()){ ?>
            <a href="<?php echo base_url('product_list') ?>" class="small-box-footer"><?php echo display('total_product')?></a>
            <?php }else{?>
             <a href="javascript:void(0)" class="small-box-footer"><?php echo display('total_product')?></a>
        <?php }?>
          </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
         <div class="small-box bg-yellow whitecolor">
            <div class="inner">
              <h4><span class="count-number"><?php echo html_escape($total_suppliers)?></span></h4>

              <p><?php echo display('total_supplier')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <?php if($this->permission1->method('manage_supplier','read')->access()){ ?>
            <a href="<?php echo base_url('supplier_list') ?>" class="small-box-footer"><?php echo display('total_supplier')?> </a>
            <?php }else{?>
             <a href="javascript:void(0)" class="small-box-footer"><?php echo display('total_supplier')?></a>
        <?php }?>
          </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <div class="small-box bg-yellow whitecolor">
            <div class="inner">
              <h4><span class="count-number"><?php echo html_escape($total_sales) ?></span> </h4>

              <p><?php echo display('total_invoice')?></p>
            </div>
            <div class="icon">
             <i class="fa fa-money"></i>
            </div>
             <?php if($this->permission1->method('manage_invoice','read')->access()){ ?>
            <a href="<?php echo base_url('invoice_list') ?>" class="small-box-footer"><?php echo display('total_invoice')?> </a>
             <?php }else{?>
             <a href="javascript:void(0)" class="small-box-footer"><?php echo display('total_invoice')?></a>
        <?php }?>
          </div>
            </div>
        </div>
        <hr>
       
          <?php if ($this->session->userdata('isAdmin')){?>
        <div class="row">
                <div class="col-sm-12 col-md-8">
                <!-- Monthly Chart -->
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="charttitle"><?php echo display("sales_and_purchase_report_summary");?>- <?php echo  date("Y")?></h4>
                            </div>
                            <div class="panel-body">
                              <canvas id="yearlyreport" width="600" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                <!-- End Monthly Chart -->
                <!-- Start Top Products -->
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="best-sale-title"> <?php echo display('best_sale_product') ?></h4>
                                <a href="<?php echo base_url(); ?>dashboard/home/see_all_best_sales" class="btn btn-success text-white best-sale-seeall">See All</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <canvas id="lineChart" height="168"></canvas>
                        </div>
                    </div>
                <!-- End Top Products Chart -->
                </div>

                <!-- Daily Overview -->
                <div class="col-sm-12 col-md-4">
                    <div class="panel panel-bd lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('todays_overview') ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="message_inner">
                                <div class="message_widgets">

                                    <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <th><?php echo display('todays_report') ?></th>
                                            <th>PHP</th>
                                        </tr>
                                        <tr>
                                            <th><?php echo display('total_sales') ?></th>
                                            <td><?php echo html_escape((($position == 0) ? "$currency $sales_amount" : "$sales_amount $currency")) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo display('total_purchase') ?></th>
                                            <td><?php echo html_escape((($position == 0) ? "$currency $todays_total_purchase" : "$todays_total_purchase $currency")) ?></td>
                                        </tr>

                                    </table>

                                    <table class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <th><?php echo display('last_sales') ?></th>
                                            <th>PHP</th>
                                        </tr>
                                        <?php
                                        if ($todays_sale_product) {
                                            ?>
                                            <?php foreach($todays_sale_product as $tsale){?>
                                            <tr>
                                                <th><?php echo $tsale['product_name']?></th>
                                                <td><?php echo (($position == 0) ? $currency.' '.$tsale['price'] : $tsale['price'].' '.$currency) ?></td>
                                            </tr>
                                            
                                        <?php }} ?>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

                <!-- End Today's Overview -->
                <!-- This current sales -->
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="charttitle"> <?php echo display('todays_sales_report') ?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive todayssaletitle">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('sl') ?></th>
                                            <th><?php echo display('customer_name') ?></th>
                                            <th><?php echo display('invoice_no') ?></th>
                                            <th><?php echo display('total_amount') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ttl_amount = $ttl_paid = $ttl_due = $ttl_discout = $ttl_receipt = 0;
                                        $todays = date('Y-m-d');
                                        if ($todays_sales_report) {
                                            $sl = 0;
                                            foreach ($todays_sales_report as $single) {                     
                                                $sl++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td>                                                        
                                                            <?php echo html_escape($single->customer_name); ?>                                                        
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'invoice_details/'; ?><?php echo html_escape($single->invoice_id); ?>">
                                                            <?php echo html_escape($single->invoice); ?>
                                                        </a>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php
                                                        $ttl_amount += $single->total_amount; 
                                                        echo html_escape(number_format($single->total_amount, '2','.',',')); 
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <th class="text-center" colspan="4"><?php echo display('not_found'); ?></th>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>                                        
                                        <tr>
                                            <td colspan="2" align="right">&nbsp;<b><?php echo display('total') ?>:</b></td>
                                            <td class="text-right">
                                                <?php
                                                $ttl_amount_float = html_escape(number_format($ttl_amount, '2', '.',','));
                                                echo (($position == 0) ? "$currency $ttl_amount_float" : "$ttl_amount_float $currency"); ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                $ttl_paid_float = html_escape(number_format($ttl_paid, '2', '.',','));
                                                echo (($position == 0) ? "$currency $ttl_paid_float" : "$ttl_paid_float $currency"); ?>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>                            
                        </div>                        
                    </div>
                <!-- End current sales -->

                <!-- top marketing agents -->
                <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="charttitle"> Top Marketing Associates <?php echo  date("F Y")?></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive todayssaletitle">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <th class="text-center" colspan="2">Coming Soon</th>
                                            </tr>
                                    </tbody>                                    
                                </table>
                            </div>                            
                        </div>                        
                    </div>
                <!-- End top marketing agents -->
                </div>


<!-- META FIELDS -->
<input type="hidden" id="totalsalep" value="<?php echo html_escape($this->home_model->total_sales_amount($searchdate))?>" name="">
<input type="hidden" id="totalplurchasep" value="<?php
echo html_escape($this->home_model->total_purchase_amount($searchdate))?>" name="">
<input type="hidden" id="totalexpensep" value="<?php
echo html_escape($this->home_model->total_expense_amount($searchdate))?>" name="">
<input type="hidden" id="totalemployeesalaryp" value="<?php
echo html_escape($this->home_model->total_employee_salary($searchdate))?>" name="">

<input type="hidden" id="totalservicep" value="<?php
echo html_escape($this->home_model->total_service_amount($searchdate))?>" name="">
<input type="hidden" id="month" value="<?php echo html_escape($month);?>" name="">

<input type="hidden" id="tlvmonthsale" value="<?php echo html_escape($tlvmonthsale);?>" name="">
<input type="hidden" id="tlvmonthpurchase" value="<?php echo html_escape($tlvmonthpurchase);?>" name=""> 

<input type="hidden" id="salspurhcaselabel"  value="<?php echo display("sales_and_purchase_report_summary");?>- <?php echo  date("Y")?>" name="">

<input type="hidden" id="bestsalelabel" value='<?php echo html_escape($chart_label);?>' name=""> 
<input type="hidden" id="bestsaledata" value='<?php echo html_escape($chart_data);?>' name=""> 
<input type="hidden" value='<?php $seperatedData = explode(',', $chart_data); echo html_escape(($seperatedData[0] + 10));?>' name="" id="bestsalemax"> 

</div>
<?php }?>
    
     

<script src="<?php echo base_url() ?>assets/js/Chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/canvasjs.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/dashboard.js" type="text/javascript"></script>




