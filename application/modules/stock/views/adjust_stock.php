<script src="<?php echo base_url()?>my-assets/js/admin_js/stock.js" type="text/javascript"></script>

<div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4><?php echo display('edit_stocks') ?></h4>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="date" class="col-sm-3 col-form-label" style="margin-top: 14px;"><?php echo display('product_id') ?>:
                                </label>
                                <div class="col-sm-6">
                                    <input autofocus  id="productID" onchange="getProductDetails()" type="text" class="form-control" style="height: 50px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="invoice_no" class="col-sm-3 col-form-label"><?php echo display('product_id') ?>:
                                </label>
                                <div class="col-sm-6">
                                    <span id="productID2"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="invoice_no" class="col-sm-3 col-form-label"><?php echo display('product_name') ?>:
                                </label>
                                <div class="col-sm-6">
                                    <span id="productName"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="invoice_no" class="col-sm-3 col-form-label"><?php echo display('product_model') ?>:
                                </label>
                                <div class="col-sm-6">
                                    <span id="productModel"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="invoice_no" class="col-sm-3 col-form-label"><?php echo display('price') ?>:
                                </label>
                                <div class="col-sm-6">
                                    <span id="productPrice"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="invoice_no" class="col-sm-3 col-form-label">Total Stocks:
                                </label>
                                <div class="col-sm-6">
                                    <span id="productStock"></span>
                                    <button style="margin-left: 5px; display: none;" id="editStockBtn" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Stock</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <img src="" id="productImage" style="width: 100%;">                                        
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
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
                <h3 class="modal-title">Edit Stock</h3>    
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Current Quantity</label>
                    <input type="hidden" class="form-control" id="productId" value="" readonly>
                    <input type="text" class="form-control" id="currentQuantity" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select type="text" class="form-control" id="adjustmentType" value="">
                        <option value="RETURN TO SUPPLIER">Return to supplier</option>
                        <option value="WASTAGE">Wastage</option>
                        <option value="ADJUSTMENT+">Adjustment</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control" id="newQuantity" value="">
                </div>
                <div class="form-group">
                    <label>Remarks</label>
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

    $('#editStockBtn').on('click', function(){
        $('#editQuantityModal').modal('show'); 
    })

    $('#saveChanges').on('click', function() {
        var base_url = $("#base_url").val();
        var adjustment = $('#newQuantity').val();

        if(adjustment != 0){
            $.ajax({
                url : base_url + "report/report/saveNewQuantity/",
                type: "POST",
                dataType: "json",
                data: {
                    product_id: $('#productId').val(),
                    current_quantity: $('#currentQuantity').val(),
                    adjustment: adjustment,
                    type: $('#adjustmentType :selected').val(),
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
            alert('Adjusment should not be 0 value');
        }
       
    })

    function getProductDetails() {
        $('.page-loader-wrapper').show();
        var productEl = document.getElementById('productID');
        var CSRF_TOKEN = $('#CSRF_TOKEN').val();
        var base_url = $('#base_url').val();

        $.ajax( {
          url: base_url + "/stock/stock/productDetails",
          method: 'post',
          dataType: "json",
          data: {
            product_id: productEl.value,
          },
          success: function( res ) {
            console.log( res );
            if(!res.error){
                $('#productID2').html(res.data.product_id);
                $('#productModel').html(res.data.product_model);
                $('#productName').html(res.data.product_name);
                $('#productPrice').html('Php '+res.data.price);
                $('#productStock').html(res.data.total_stock);
                $('#productImage').attr("src", res.data.image);
                $('#currentQuantity').val(res.data.total_stock);
                $('#productId').val(res.data.product_id);
                $('#editStockBtn').show();
               
            }else{
                alert(res.message);
            }
            $('.page-loader-wrapper').hide();
          }
        });
        
        productEl.value = "";
    }
</script>
