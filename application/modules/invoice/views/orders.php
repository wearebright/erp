       <!-- Manage Orders Tracker -->
        <div id="parentKanban">
            <div style="width: 1500px;">
                <div class="row" style="display: flex;">
                    <!-- New Orders -->
                    <div class="col-md-3">
                        <div class="panel" style="border: 1px solid #e6e6e6; background-color: #e6e6e6;">
                            <div class="panel-heading" style="border: none; padding-bottom: 0px;">
                                <div class="panel-title">
                                    <h3>New Orders</h3>
                                </div>
                            </div>
                            <div class="panel-body" id="kanbanDiv" style="height: 67vh; overflow-y: auto;">
                                <?php 
                                    foreach($orders['NEW'] as $order){
                                ?>
                                        <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2"><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    </tr> 
                                                    <tr>
                                                        <td><span  style="margin-top: 15px; display: block;"> <b><?= $currency.' '.number_format($order->total_amount,2)  ?> </b> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span  style="margin-bottom: 10px; display: block;"> <?= $order->sales_channel ?> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            Customer: <b><?= $order->customer_name ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            Date: <b><?= date('M j, Y',strtotime($order->date)) ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            ANB: <b><?= $order->anb ?></b>
                                                        </td>
                                                    </tr> 
                                                </tbody>                                      
                                            </table>
                                            </div>     
                                            
                                        </div>
                                        </a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Warehouse -->
                    <div class="col-md-3">
                        <div class="panel" style="border: 1px solid #e6e6e6; background-color: #e6e6e6;">
                            <div class="panel-heading"  style="border: none; padding-bottom: 0px;">
                                <div class="panel-title">
                                    <h3>For Packaging</h3>
                                </div>
                            </div>
                            <div class="panel-body" id="kanbanDiv"  style="height: 67vh; overflow-y: auto;">
                                <?php 
                                    foreach($orders['WAREHOUSE'] as $order){
                                ?>
                                        <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2"><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    </tr> 
                                                    <tr>
                                                        <td><span  style="margin-top: 15px; display: block;"> <b><?= $currency.' '.number_format($order->total_amount,2)  ?> </b> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span  style="margin-bottom: 10px; display: block;"> <?= $order->sales_channel ?> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            Customer: <b><?= $order->customer_name ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            Date: <b><?= date('M j, Y',strtotime($order->date)) ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            ANB: <b><?= $order->anb ?></b>
                                                        </td>
                                                    </tr> 
                                                </tbody>                                      
                                            </table>
                                            </div>     
                                            
                                        </div>
                                        </a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- For Pickup -->
                    <div class="col-md-3">
                        <div class="panel" style="border: 1px solid #e6e6e6; background-color: #e6e6e6;">
                            <div class="panel-heading" style="border: none; padding-bottom: 0px;">
                                <div class="panel-title">
                                    <h3>For Pickup</h3>
                                </div>
                            </div>
                            <div class="panel-body" id="kanbanDiv" style="height: 67vh; overflow-y: auto;">
                                <?php 
                                    foreach($orders['READY'] as $order){
                                ?>
                                        <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2"><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    </tr> 
                                                    <tr>
                                                        <td><span  style="margin-top: 15px; display: block;"> <b><?= $currency.' '.number_format($order->total_amount,2)  ?> </b> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span  style="margin-bottom: 10px; display: block;"> <?= $order->sales_channel ?> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            Customer: <b><?= $order->customer_name ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            Date: <b><?= date('M j, Y',strtotime($order->date)) ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            ANB: <b><?= $order->anb ?></b>
                                                        </td>
                                                    </tr> 
                                                </tbody>                                      
                                            </table>
                                            </div>     
                                            
                                        </div>
                                        </a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Shipped -->
                    <div class="col-md-3">
                        <div class="panel" style="border: 1px solid #e6e6e6; background-color: #e6e6e6;">
                            <div class="panel-heading" style="border: none; padding-bottom: 0px;">
                                <div class="panel-title">
                                    <h3>Shipped</h3>
                                </div>
                            </div>
                            <div class="panel-body" id="kanbanDiv" style="height: 67vh; overflow-y: auto;">
                                <?php 
                                    foreach($orders['SHIPPED'] as $order){
                                ?>
                                        <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2"><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    </tr> 
                                                    <tr>
                                                        <td><span  style="margin-top: 15px; display: block;"> <b><?= $currency.' '.number_format($order->total_amount,2)  ?> </b> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span  style="margin-bottom: 10px; display: block;"> <?= $order->sales_channel ?> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            Customer: <b><?= $order->customer_name ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            Date: <b><?= date('M j, Y',strtotime($order->date)) ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            ANB: <b><?= $order->anb ?></b>
                                                        </td>
                                                    </tr> 
                                                </tbody>                                      
                                            </table>
                                            </div>     
                                            
                                        </div>
                                        </a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel" style="border: 1px solid #e6e6e6; background-color: #e6e6e6;">
                            <div class="panel-heading" style="border: none; padding-bottom: 0px;">
                                <div class="panel-title">
                                    <h3>RTS</h3>
                                </div>
                            </div>
                            <div class="panel-body" id="kanbanDiv"  style="height: 67vh; overflow-y: auto;">
                                <?php 
                                    foreach($orders['RETURN_TO_SENDER'] as $order){
                                ?>
                                        <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2"><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    </tr> 
                                                    <tr>
                                                        <td><span  style="margin-top: 15px; display: block;"> <b><?= $currency.' '.number_format($order->total_amount,2)  ?> </b> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span  style="margin-bottom: 10px; display: block;"> <?= $order->sales_channel ?> </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            Customer: <b><?= $order->customer_name ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            Date: <b><?= date('M j, Y',strtotime($order->date)) ?></b>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td colspan="2">
                                                            ANB: <b><?= $order->anb ?></b>
                                                        </td>
                                                    </tr> 
                                                </tbody>                                      
                                            </table>
                                            </div>     
                                            
                                        </div>
                                        </a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>