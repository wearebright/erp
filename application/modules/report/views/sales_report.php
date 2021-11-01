
        <!-- Sales report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 
                        <?php echo form_open('datewise_sales_report', array('class' => 'form-inline', 'method' => 'get')) ?>
                        <?php
                        $today = date('Y-m-d');
                        ?>
                        <div class="row">
                            <div class="form-group col-md-2" style="min-width:150px;">
                                <label for="from_date"><?php echo display('sales_channel') ?></label>
                                <select onchange="getTeam()" name="sales_channel" class="form-control">
                                    <option <?= $sales_channel=='All'?"selected":"" ?> value="All">All</option>
                                    <?php 
                                        foreach ($departments as $key => $value) {
                                    ?>
                                            <option <?= $sales_channel === $value->department_name ? 'selected':'' ?> value="<?= $value->department_name ?>"><?= $value->department_name ?></option>
                                    <?php
                                        }
                                    ?>
                                </select> 
                            </div> 
                            <div class="form-group col-md-2" style="min-width:150px;">
                                <label for="from_date"><?php echo display('group_name') ?></label>
                                <select id="sales_team" name="sales_team" class="form-control">
                                    <option <?= $selected_team=='All'?"selected":"" ?> value="All">All</option>  
                                    <?php 
                                        foreach ($teams as $key => $value) {
                                    ?>
                                            <option <?= $selected_team === $value->id ? 'selected':'' ?> value="<?= $value->id ?>"><?= $value->group_name ?></option>
                                    <?php
                                        }
                                    ?>
                                </select> 
                            </div> 
                            <div class="form-group col-md-2" style="min-width:150px;">
                                <label for="from_date"><?php echo display('logistics') ?></label>
                                <select name="logistics" class="form-control">
                                    <option <?= $logistics=='All'?"selected":"" ?> value="All">All</option>
                                    <?php foreach ($logistics_list as $key => $item) { ?>
                                        <option <?= $logistics == $item['logistics_name']?"selected":"" ?> value="<?= $item['logistics_name'] ?>"><?= $item['logistics_name'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select> 
                            </div> 
                            <div class="form-group col-md-2" style="min-width:150px;">
                                <label for="from_date"><?php echo display('mov') ?></label>
                                <select name="paytype" class="form-control">
                                    <option <?= $paytype=='All'?"selected":"" ?> value="All">All</option>
                                    <option <?= $paytype==1?"selected":"" ?> value="1">Cash On Delivery</option>
                                    <option <?= $paytype==2?"selected":"" ?> value="2">Cash On Pick-up</option> 
                                    <option <?= $paytype==3?"selected":"" ?> value="3">Online Payment</option> 
                                </select> 
                            </div> 
                            <div class="form-group col-md-1">
                                <label for="from_date"><?php echo display('start_date') ?></label>
                                <input type="text" autocomplete="off" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo $from_date ?>">
                            </div> 

                            <div class="form-group col-md-1">
                                <label for="to_date"><?php echo display('end_date') ?></label>
                                <input type="text" autocomplete="off" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo $to_date ?>">
                            </div>  
                            <div class="col-md-2">
                                <label style="margin-bottom: 25px; display: block;"></label>
                                <div class="">
                                    <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                                    <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo display('print') ?></a>
                                    <?php echo form_close() ?>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo display('sales_report') ?> </span>
                            <span class="padding-lefttitle">         <?php if($this->permission1->method('all_report','read')->access()){ ?>
                    <a class="btn btn-primary m-b-5 m-r-2" href="<?php echo base_url('todays_report') ?>"><?php echo display('todays_report') ?></a>
                     <?php } ?>
        <?php if($this->permission1->method('todays_purchase_report','read')->access()){ ?>
                    <a href="<?php echo base_url('purchase_report') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('purchase_report') ?> </a>
                  <?php }?>
                  <?php if($this->permission1->method('product_sales_reports_date_wise','read')->access()){ ?>
                    <a href="<?php echo base_url('product_wise_sales_report') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('sales_report_product_wise') ?> </a>
                    <?php }?>
    <?php if($this->permission1->method('todays_sales_report','read')->access() && $this->permission1->method('todays_purchase_report','read')->access()){ ?>
                    <a href="<?php echo base_url('profit_report') ?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('profit_report') ?> </a>
                    <?php }?></span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="purchase_div">
                            <div class="paddin5ps">
                               <!-- <table class="print-table " width="100%">
                                                
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
                                   
                                </table> -->
                            </div>
                            <div class="table-responsive paddin5ps">
                                <table class="table table-bordered table-striped table-hover ">
                                    <thead>
                                        <tr>
                                            <th><?php echo display('sales_date') ?></th>
                                            <th><?php echo display('invoice_no') ?></th>
                                            <th><?php echo display('sale_by') ?></th>
                                            <th><?php echo display('logistics') ?></th>
                                            <th><?php echo display('mov') ?></th>
                                            <th><?php echo display('customer_name') ?></th>
                                            <th><?php echo display('total_amount') ?></th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        if ($sales_report) {
                                            ?>
                                    
                                            <?php 
                                            $subtotal = 0;
                                            foreach($sales_report as $sales){ ?>
                             <tr>
                                    <td><?php echo $sales['sales_date']?></td>
                                    <td>
                                        <a href="<?= base_url().'invoice_details/'.$sales['invoice_id'] ?>"><?= $sales['invoice']?></a>
                                    </td>
                                    <td><?php echo $sales['first_name']." ". $sales['last_name']?></td>
                                    <td><?php echo $sales['courier']?></td>
                                    <td><?php 
                                        switch ($sales['payment_type']) {
                                            case 1:
                                                echo 'Cash On Delivery';
                                                break;
                                            case 2:
                                                echo 'Cash On Pickup';
                                                break;
                                            case 3:
                                                echo 'Online Payment';
                                                break;
                                            default:
                                                # code...
                                                break;
                                        }
                                        
                                        
                                        ?></td>
                                    <td><?php echo $sales['customer_name']?></td>
                            <td class="text-right">
                                    <?php 
                                if($position == 0){
                                  echo $currency.' '.number_format($sales['total_amount'],2);  
                                }else{
                                echo number_format($sales['total_amount'],2).' '.$currency; 
                                }
                                $subtotal += $sales['total_amount']; ?>
                                    </td>
                                </tr>
                                            <?php } ?>
                                        <?php } else {
                                            ?>

                                            <tr>
                                                <th class="text-center" colspan="6"><?php echo display('not_found'); ?></th>
                                            </tr> 
                                        <?php } ?>
                                    </tbody>
                                     <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right"><b><?php echo display('total_seles') ?></b></td>
                                            <td class="text-right"><b><?php echo (($position == 0) ? "$currency ". number_format($subtotal) : number_format($subtotal) ." $currency") ?></b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
<script>
    $(document).ready(function (){
        
    })
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