
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                   
                    <div class="panel-body">
                        <div>
                           
                            <div  id="printableArea">
                                <div class="table-responsive paddin5ps">
                               <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="checkListStockList">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?php echo display('sl') ?></th>
                                            <th class="text-center"><?php echo display('product_name') ?></th>
                                            <th class="text-center"><?php echo display('product_model') ?></th>
                                            <th class="text-center"><?php echo display('sell_price') ?></th>
                                            <th class="text-center"><?php echo display('in_qnty') ?></th>
                                            <th class="text-center"><?php echo display('out_qnty') ?></th>
                                            <th class="text-center"><?php echo display('stock') ?></th>
                                            <!-- <th class="text-center"><?php echo display('stock_sale')?></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="6" class="text-right"><?php echo display('total')?> :</th>
                                                <th id="stockqty"></th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </tfoot>
                                </table>
                            </div>
                            </div>
                        </div>
                        <input type="hidden" id="currency" value="<?php echo $currency?>" name="">
                         <input type="hidden" id="total_stock" value="<?php echo $totalnumber;?>" name="">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="editQuantityModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title">Edit Quantity</h3>    
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Current Quantity</label>
                            <input type="hidden" class="form-control" id="productId" value="" readonly>
                            <input type="text" class="form-control" id="currentQuantity" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label>New Quantity</label>
                            <input type="text" class="form-control" id="newQuantity" value="">
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea type="text" class="form-control" id="comment" value=""></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="saveChanges" class="btn btn-primary">Save changes</button>                
                    </div>
                </div>
            </div>
        </div>
       
<script>
    $('#checkListStockList').on('click', '.editQuantity', function(){
        $('#editQuantityModal').modal('show'); 
        $('#currentQuantity').val( $(this).attr('data-quantity') );
        $('#productId').val( $(this).attr('data-id') )
    })

    $('#saveChanges').on('click', function() {
        var base_url = $("#base_url").val();
        var new_quantity = $('#newQuantity').val();

        if(new_quantity){
            $.ajax({
                url : base_url + "report/report/saveNewQuantity/",
                type: "POST",
                dataType: "json",
                data: {
                    product_id: $('#productId').val(),
                    current_quantity: $('#currentQuantity').val(),
                    new_quantity: new_quantity,
                    comment: $('#comment').val()
                },
                success: function(data)
                {
                    $('#editQuantityModal').modal('hide');
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }else{
            alert('New quantity is required');
        }
       
    })
</script>