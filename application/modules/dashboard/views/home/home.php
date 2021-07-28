
        <?php 
if(isset($_POST['btnSearch']))
{
   $announcementdate = $_POST['alldata'];
}
$searchdate =(!empty($announcementdate)?$announcementdate:date('F Y'));

?>
        
        <div class="row">
            <?php if($this->permission1->method('view_overall_sales','read')->access()){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="small-box bg-yellow whitecolor">
                        <div class="inner">
                            <h4><span class="count-number"><?= $overall_sales_yearly ? $currency .' '. html_escape(number_format($overall_sales_yearly)) : $currency .' 0.00'; ?></span></h4>
                            <p><?php echo display('overall_sales')?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-pie-chart"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">Year to Date</a>
                    </div>
                </div>
            <?php }?>
            <?php if($this->permission1->method('view_daily_sales','read')->access()){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="small-box bg-yellow whitecolor">
                        <div class="inner">
                            <h4><span class="count-number"><?= $overall_sales_today ? $currency .' '. html_escape(number_format($overall_sales_today)) : $currency .' 0.00'; ?></span></h4>
                            <p><?php echo display('website_sales')?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-signal"></i>
                        </div>
                            <a href="javascript:void(0)" class="small-box-footer">Total Sales Today</a>
                    </div>
                </div>
            <?php } ?>
            <?php if($this->permission1->method('view_lazada_sales','read')->access()){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="small-box bg-yellow whitecolor">
                        <div class="inner">
                            <h4><span class="count-number"><?= $total_lazada_sales_today ? $currency .' '. html_escape($total_lazada_sales_today) : $currency .' 0.00' ?></span></h4>
                            <p><?php echo display('lazada_sales')?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">Total Sales Today</a>
                    </div>
                </div>
            <?php }?>
            <?php if($this->permission1->method('view_shopee_sales','read')->access()){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="small-box bg-yellow whitecolor">
                        <div class="inner">
                            <h4><span class="count-number"><?= $total_shopee_sales_today ? $currency .' '. html_escape($total_shopee_sales_today) : $currency .' 0.00'  ?></span> </h4>
                            <p><?php echo display('shopee_sales')?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer">Total Sales Today</a>
                    </div>
                </div>
            <?php }?>
            <?php if($this->permission1->method('view_announcement_stats','read')->access()){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="small-box bg-yellow whitecolor">
                        <div class="inner">
                            <h4><span class="count-number"><?= $total_post_current_month ? html_escape($total_post_current_month) : 0  ?></span></h4>
                            <p><?php echo display('announcements')?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bullhorn"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer"><?php echo 'New Posts this Month'?></a>
                    </div>
                </div>
            <?php }?>
            <?php if($this->permission1->method('view_shipped_orders_stats','read')->access()){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="small-box bg-yellow whitecolor">
                        <div class="inner">
                            <h4><span class="count-number"><?= $total_shipped_orders_today ? html_escape($total_shipped_orders_today) : 0; ?></span></h4>
                            <p><?php echo display('shipped_orders')?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-truck"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer"><?php echo 'Total '.display('shipped_orders').' Today'?></a>
                    </div>
                </div>
            <?php }?>
            <?php if($this->permission1->method('view_purchased_order_arrived_stats','read')->access()){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="small-box bg-yellow whitecolor">
                        <div class="inner">
                            <h4><span class="count-number"><?= $total_purchase_order_today ? $currency .' '. html_escape(number_format($total_purchase_order_today)) : 0; ?></span></h4>
                            <p><?php echo display('purchased_order_arrived')?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="javascript:void(0)" class="small-box-footer"><?php echo 'Total '.display('purchased_order_arrived').' Today'?></a>
                    </div>
                </div>
            <?php }?>
            <?php if($this->permission1->method('view_return_items_stats','read')->access()){ ?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="small-box bg-yellow whitecolor">
                        <div class="inner">
                            <h4><span class="count-number"><?= $total_return_item_today ? html_escape($total_return_item_today) : 0; ?></span> </h4>
                            <p><?php echo display('returned_items')?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-handshake-o"></i>
                        </div>
                            <a href="javascript:void(0)" class="small-box-footer"><?php echo 'Total '.display('returned_items').' Today' ?></a>
                    </div>
                </div>
            <?php }?>
        </div>
        <hr>

        <?php if ($this->session->userdata('isAdmin')){?>
        <div class="row">
                <div class="col-sm-12 col-md-8">
                <?php if($this->permission1->method('view_latest_announcements','read')->access()){ ?>
                <!-- Announcements -->
                    <div class="panel panel-bd">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <div style="margin-bottom: 10px;">
                                    <h4 class="charttitle"><?php echo display("latest_announcements");?></h4>
                                    <a style="float: right; font-size: 15px;" href="/bulletin_board"><u> <i class="ti-announcement"></i>  View Bulletin Board</u></a>
                                </div>
                                <?php
                                    if(count($announcements) > 0){
                                ?>
                                    <div id="carousel" class="owl-carousel owl-theme">
                                    <?php
                                        foreach($announcements as $announcement){
                                    ?>
                                    <div>
                                        <div class="main_slides post">
                                            <div class="placeHolder" style="left: 0px;">
                                                <a href="<?= base_url().'/announcement/'.$announcement->slug ?>">

                                                    <?php
                                                        if($announcement->banner){
                                                    ?>
                                                        <img class="object-fit-cover" src="<?= base_url().$announcement->banner ?>">
                                                        <div class="title_Container" style="margin-top: -85px;">
                                                            <p class="title"><?= $announcement->title ?></p>
                                                            <p class="datePosted">Posted on <?= date('F d, Y h:i A', strtotime($announcement->created_at)) ?> by <?= $announcement->name ?></p>
                                                        </div>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <img class="object-fit-cover" src="<?= base_url().$announcement->random_banner ?>">
                                                        <div class="title_Container2" style="margin-top: -85px;">
                                                            <div class="detailsContainer">
                                                                <p class="title"><?= $announcement->title ?></p>
                                                                <p class="description"><?= word_limiter($announcement->description,30) ?></p>
                                                                <p class="datePosted">Posted on <?= date('F d, Y h:i A', strtotime($announcement->created_at)) ?> by <?= $announcement->name ?></p>
                                                            </div>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                <?php
                                    }else{
                                ?>     
                                    <div class="empty-state">
                                        <img width="100" src="/my-assets/image/empty.svg">
                                        <h4 class="text-center"> No unread announcements </h4>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <!-- Announcements -->
                <?php
                    }
                    if($this->permission1->method('view_monthly_sales_performance','read')->access()){
                ?>
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
                <?php
                    }
                    if($this->permission1->method('view_best_sale_product','read')->access()){
                ?>
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
                <?php
                    }
                ?>
                </div>

                <!-- Daily Overview -->
                <div class="col-sm-12 col-md-4">

                    <?php
                        if($this->permission1->method('view_todays_overview','read')->access()){
                    ?>
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
                                                <th><?php echo display('website_sales') ?></th>
                                                <td><?= $overall_sales_today ? $currency .' '. html_escape(number_format($overall_sales_today)) : $currency .' 0.00'; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo display('lazada_sales') ?></th>
                                                <td><?= $total_lazada_sales_today ? $currency .' '. html_escape($total_lazada_sales_today) : $currency .' 0.00'  ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo display('shopee_sales') ?></th>
                                                <td><?= $total_shopee_sales_today ? $currency .' '. html_escape($total_shopee_sales_today) : $currency .' 0.00'  ?></td>
                                            </tr>

                                        </table>

                                        <!-- <table class="table table-bordered table-striped table-hover">
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
                                        </table> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Today's Overview -->
                    <?php
                        }
                        if($this->permission1->method('view_todays_sales_report','read')->access()){
                    ?>
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
                    <?php
                        }
                        if($this->permission1->method('view_top_marketing_associates','read')->access()){
                    ?>
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
                    <?php
                        }
                    ?>
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




