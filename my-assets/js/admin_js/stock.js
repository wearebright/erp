//Calculate total pending purchase quantity
"use strict";
function calculate_pendingPurchase(sl) {
    var pen_tot = 0;
    var prch_qty = $('#cartoon_'+sl).val();
    var rcvd_qty = $('#received_quantity_'+sl).val();

    var pen_tot = prch_qty - rcvd_qty;
    $("#pending_quantity_"+sl).val(pen_tot.toFixed(2,2));
}

$(document).ready(function() { 
    "use strict";
    var csrf_test_name = $('#CSRF_TOKEN').val();
    var total_purchase_no = $("#total_purchase_no").val();
    var base_url = $("#base_url").val();
    var currency = $("#currency").val();
    var purchasedatatable = $('#PurList').DataTable({ 
       responsive: true,
        "aaSorting": [[4, "desc" ]],
        "columnDefs": [
          { "bSortable": false, "aTargets": [0,1,2,3,5] },
        ],
        "processing": true,
        "serverSide": true,
        "lengthMenu":[[10, 25, 50,100,250,500, total_purchase_no], [10, 25, 50,100,250,500, "All"]],
        dom:"'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'>Bfrtip", 
        buttons:[{
                extend: "copy",
                exportOptions: {
                            columns: [ 0,1,2,3,4 ] //Your Colume value those you want
                        }, className: "btn-sm prints"
            },{
                extend: "csv", 
                title: "PurchaseLIst",
                exportOptions: {
                    columns: [ 0,1,2,3,4] //Your Colume value those you want print
                }, 
                className: "btn-sm prints"
            }, 
            {
                extend: "excel",
                exportOptions: {
                    columns: [0,1,2,3,4 ] //Your Colume value those you want print
                }, 
                title: "PurchaseLIst", 
                className: "btn-sm prints"
            }
            , {
                extend: "pdf",exportOptions: {
                        columns: [0,1,2,3,4] //Your Colume value those you want print
                            }, title: "PurchaseLIst", className: "btn-sm prints"
            }
            , {
                extend: "print",exportOptions: {
                        columns: [ 0,1,2,3,4] //Your Colume value those you want print
                            },title: "<center> PurchaseLIst</center>", className: "btn-sm prints"
            }],
            'serverMethod': 'post',
            'ajax': {
                'url':base_url + 'purchase/purchase/CheckPurchaseListNoAmount',
                "data": function ( data) {
                    data.fromdate = $('#from_date').val();
                    data.todate = $('#to_date').val();
                    data.csrf_test_name = csrf_test_name;
                }
            },
            'columns': [
                { data: 'sl' },
                { data: 'chalan_no'},
                { data: 'purchase_id'},
                { data: 'supplier_name'},
                { data: 'purchase_date' },
                // { data: 'total_amount',class:"total_sale text-right",render: $.fn.dataTable.render.number( ',', '.', 2, currency )},
                { data: 'button'},
            ],

            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();
                api.columns('.total_sale', {
                    page: 'current'
                }).every(function() {
                var sum = this
                .data()
                .reduce(function(a, b) {
                var x = parseFloat(a) || 0;
                var y = parseFloat(b) || 0;
                return x + y;
                }, 0);
                $(this.footer()).html(currency+' '+sum.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                });
            }
    });


    $('#btn-filter').click(function(){ 
        purchasedatatable.ajax.reload();  
    });
});
