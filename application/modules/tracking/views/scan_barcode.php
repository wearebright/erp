<!-- Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>
       


        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <span><?php echo display('scan_barcode') ?></span>
                        </div>
                    </div>
                 
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-6" id="payment_from_1">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">
                                        <?= display('product_id')?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input autofocus id="productID" onchange="getProductDetails()" type="text" size="100" name="product_id" class=" form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                            <form action="/tracking/outgoing/saveOutgoing" method="POST">
                                <button type="submit" class="btn btn-primary" id="saveOutgoing">Save to Outgoing</button>
                            </form>
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
                                    <th><?php echo display('price') ?></th>
                                    <!-- <th><?php echo display('quantity') ?></th> -->
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
                                            <td><?= $value['price'] ?></td>
                                            <!-- <td><?= $value['quantity'] ?></td> -->
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
    /* $(document).ready( function() {
        $('#saveOutgoing').on('click', function(){

        });
    })

    function saveOutgoing(){
        $.ajax( {
          url: base_url + "/tracking/outgoing/addOutgoing",
          method: 'post',
          dataType: "json",
          data: {
            product_id: productEl.value,
          },
          success: function( data ) {
            console.log( data );
            if(!data.error){
                let html  = "<tr><td>"+data.data.id+"</td><td>"+data.data.product_id+"</td><td>"+data.data.product_name+"</td><td>"+data.data.product_model+"</td><td>"+data.data.price+"</td><td>"+data.data.created_at+"</td><td class='text-center'><a href='"+base_url+"/tracking/outgoing/remove/"+data.data.id+"' class='btn btn-xs btn-danger' onclick='return confirm('Are You Sure ?')'><i class='fa fa-trash'></i></a></td></tr>"
                $('#PrdScan tbody').prepend(html);
            }else{
                alert('please try again');
            }
          }
        });
    } */
    
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
          },
          success: function( data ) {
            console.log( data );
            if(!data.error){
                let html  = "<tr><td>"+data.data.id+"</td><td>"+data.data.product_id+"</td><td>"+data.data.product_name+"</td><td>"+data.data.product_model+"</td><td>"+data.data.price+"</td><td>"+data.data.created_at+"</td><td class='text-center'><a href='"+base_url+"/tracking/outgoing/remove/"+data.data.id+"' class='btn btn-xs btn-danger' onclick='return confirm('Are You Sure ?')'><i class='fa fa-trash'></i></a></td></tr>"
                $('#PrdScan tbody').prepend(html);
            }else{
                alert('please try again');
            }
          }
        });
        
        productEl.value = "";
    }
</script>

