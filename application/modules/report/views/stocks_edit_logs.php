
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 
                        <?php echo form_open('stock_logs', array('class' => 'form-inline', 'method' => 'get')) ?>
                        
                            <div class="col-sm-3">
                           
                            <label class="col-sm-4" for="product"><?php echo display('product') ?></label>
                            <div class="col-sm-8">
                            <select name="product_id" class="form-control">
                                <option value="all">All</option>
                                <?php foreach($product_list as $product){?>
                               <option value="<?php echo  $product['product_id']?>" <?php if($product['product_id'] == $product_id){echo 'selected';}?>><?php echo  $product['product_name']?></option>
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
                            <span><?php echo display('stock_logs') ?></span>
                        </div>
                    </div>
                 
                    <div class="panel-body">

                        <div class="table-responsive" >
                            <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="EditLogs"> 
                                <thead>
                                    <tr>
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('product_id') ?></th>
                                    <th><?php echo display('product_name') ?></th>
                                    <th><?php echo display('product_model') ?></th>
                                    <th><?php echo display('adjustment') ?></th>
                                    <th><?php echo display('movement_type') ?></th>
                                    <th><?php echo display('remarks') ?></th>
                                    <th><?php echo display('adjusted_by') ?></th>
                                    <th><?php echo display('date') ?></th>
                                    <!-- <th class="text-center"><?php echo display('action') ?></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($edit_logs as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?= $value['id'] ?></td>
                                            <td><?= $value['product_id'] ?></td>
                                            <td><?= $value['product_name'] ?></td>
                                            <td><?= $value['product_model'] ?></td>
                                            <td><?= $value['quantity_adjustment'] ?></td>
                                            <td><?= $value['movement_type'] ?></td>
                                            <td><?= $value['comment'] ?></td>
                                            <td><?= $value['first_name']. " ". $value['last_name'] ?></td>
                                            <td><?= $value['created_at'] ?></td>
                                            <!-- <td class="text-center">
                                                <a href="/tracking/outgoing/remove/<?= $value['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are You Sure ?')">
                                                    <i class='fa fa-trash'></i>
                                                </a>
                                            </td> -->
                                        </tr>
                                    <?php
                                    } ?>
                                       
                                </tbody>
                                <!-- <tfoot>
                                    <th colspan="4" class="text-right"><?php echo display('total') ?>:</th>
                                    <th></th>  
                                    <th></th> 
                                </tfoot> -->
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    

<script>
    $(document).ready(function() {
        $('#EditLogs').dataTable( {
            "order": [[ 0, "desc" ]]
        });
    } );
</script>
   


