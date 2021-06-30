       <!-- Manage Orders Tracker -->
        <div id="parentKanban">
            <div class="row">
                <!-- New Orders -->
                <div class="col-md-3">
                    <div class="panel"  style="height:80vh">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>New Orders</h3>
                            </div>
                        </div>
                        <div class="panel-body" id="kanbanDiv">
                            <?php 
                                foreach($orders['NEW'] as $order){
                                    ?>
                                    <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                        <table style="width:100%">
                                            <tbody>
                                                 <tr>
                                                    <td><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    <td style="text-align:right"><b><?= $currency.' '.number_format($order->total_amount,2)  ?></b></td>
                                                </tr> 
                                                <tr>
                                                    <td><?= date('M j, Y',strtotime($order->date)) ?></td>
                                                    <td style="text-align:right"><?= $order->sales_channel ?></td>
                                                </tr>   
                                                <tr>
                                                    <td colspan="2">
                                                        <b><?= $order->customer_name ?></b>
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
                    <div class="panel" style="height:80vh">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>For Packaging</h3>
                            </div>
                        </div>
                        <div class="panel-body" id="kanbanDiv">
                            <?php 
                                foreach($orders['WAREHOUSE'] as $order){
                                    ?>
                                    <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                        <table style="width:100%">
                                            <tbody>
                                                 <tr>
                                                    <td><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    <td style="text-align:right"><b><?= $currency.' '.number_format($order->total_amount,2)  ?></b></td>
                                                </tr> 
                                                <tr>
                                                    <td><?= date('M j, Y',strtotime($order->date)) ?></td>
                                                    <td style="text-align:right"><?= $order->sales_channel ?></td>
                                                </tr>   
                                                <tr>
                                                    <td colspan="2">
                                                        <b><?= $order->customer_name ?></b>
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
                    <div class="panel" style="height:80vh">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>For Pickup</h3>
                            </div>
                        </div>
                        <div class="panel-body" id="kanbanDiv">
                            <?php 
                                foreach($orders['READY'] as $order){
                                    ?>
                                    <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                        <table style="width:100%">
                                            <tbody>
                                                 <tr>
                                                    <td><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    <td style="text-align:right"><b><?= $currency.' '.number_format($order->total_amount,2)  ?></b></td>
                                                </tr> 
                                                <tr>
                                                    <td><?= date('M j, Y',strtotime($order->date)) ?></td>
                                                    <td style="text-align:right"><?= $order->sales_channel ?></td>
                                                </tr>   
                                                <tr>
                                                    <td colspan="2">
                                                        <b><?= $order->customer_name ?></b>
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
                    <div class="panel" style="height:80vh">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h3>Shipped</h3>
                            </div>
                        </div>
                        <div class="panel-body" id="kanbanDiv">
                            <?php 
                                foreach($orders['SHIPPED'] as $order){
                                    ?>
                                    <a class="kanbanCards" href="<?= base_url('invoice_details/'.$order->invoice_id) ?>" title="Update Order# <?= $order->invoice ?>">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                        <table style="width:100%">
                                            <tbody>
                                                 <tr>
                                                    <td><b class="orderN" style="font-size:115%;">Order# <?= $order->invoice ?></b></td>
                                                    <td style="text-align:right"><b><?= $currency.' '.number_format($order->total_amount,2)  ?></b></td>
                                                </tr> 
                                                <tr>
                                                    <td><?= date('M j, Y',strtotime($order->date)) ?></td>
                                                    <td style="text-align:right"><?= $order->sales_channel ?></td>
                                                </tr>   
                                                <tr>
                                                    <td colspan="2">
                                                        <b><?= $order->customer_name ?></b>
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