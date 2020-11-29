 <style type="text/css" media="screen">
    .btn-default{
        background-color: transparent;
        color: #333;
    }
    .btn-default:hover{
        background-color: #333;
        color: #fff;
    }
 </style>
<div class="row">
    <div class="col-lg-12">
        <!-- <h1 class="page-header">Transaksi</h1> -->
        <div class="clearfix"><br></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo $base_url."review-pembelian" ?>" title="Review Kegiatan Pembelian, Print Ulang, Batal" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom"> <span class="fa fa-list"></span> Review</a>
        <a data-toggle="modal" data-target='#insertProduct' id="buttonAddProduct" title="Tambah Produk" class="btn btn-success" data-backdrop="static" data-keyboard="false">
          <span class="fa fa-plus-circle"></span> Produk
        </a>

        <!-- Insert Product -->
        <div class="modal fade" id="insertProduct">
            <div class="modal-dialog">
                <div class="panel panel-primary" id="fetchDataInsertProduct">
                </div>
            </div>
        </div>
        <script type="text/javascript">
          function insertEffect() {$("#insertProduct").show( 'clip', 800 );};
          function deleteEffect() {$("#delete").show( 'clip', 800 );};
          function detailEffect() {$("#detail").show( 'clip', 800 );};

          $("#buttonAddProduct").click(function(event) {insertEffect();});
          $("#buttonDelete").click(function(event) {deleteEffect();});
          $("#buttonDetail").click(function(event) {detailEffect();});
            
          //Insert Produk
          $('#insertProduct').on('show.bs.modal', function (e) {
            $("#fetchDataInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
            $.ajax({
              type : 'get',
              url : '<?php echo $base_url."pages/transaction/product/insert.php" ?>',
              success : function(data){
              $('#fetchDataInsertProduct').html(data);//menampilkan data ke dalam modal
              }
            });
           });
        </script>
        
        <!-- Form Transaction Buying -->
        <div class="clearfix"><br></div>
        <div class="panel panel-primary">
            <div class="panel-heading">
            	<b>TRANSAKSI PEMBELIAN</b>
            </div>
            <div class="panel-body">
                <div class="panel panel-primary">
                    <!-- <div class="panel-heading">
                        <h3 class="panel-title">Supplier</h3>
                    </div> -->
                    <div class="panel-body">
                        <div class="form-inline">
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="supplier_code" name="supplier_code" placeholder="Kode Supplier">
                                </div>
                                <div class="input-group" >
                                    <input type="text" class="form-control" id="supplier_name" name="supplier_name" onkeypress="goToSupplier(event)" data-toggle="tooltip" data-placement="bottom" title="Nama Supplier" placeholder="Nama Supplier">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default" id="supplierSearch" name="supplierSearch" data-toggle="modal" data-target="#listSupplier" data-placement="bottom" title="Pencarian Supplier">
                                        <span class="fa fa-search"></span>      
                                        </button> 
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="supplier_code_hide" name="supplier_code_hide" placeholder="Kode" style="width: 65%" class="form-control" disabled="">
                                </div>
                            </div>
                            <div class="clearfix row"> <br></div>
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <input type="text" id="batch_code" name="batch_code" placeholder="Kode Batch" style="width: 65%" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="transaction_date" name="transaction_date" placeholder="Tgl Transaksi" data-toggle="tooltip" data-placement="bottom" title="Jika Kosong maka Tgl Hari ini">
                                </div>
                                <div class="form-group">
                                    <select name="transaction_time" id="transaction_time" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Jika Kosong maka Jam Saat ini">
                                        <?php include('master_time.php'); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <!-- <div class="panel-heading">
                        <h3 class="panel-title">Produk</h3>
                    </div> -->
                    <div class="panel-body">
                        <div class="form-inline">
                              <div class="input-group form-group">
                                <input type="text" class="form-control" id="c_buying_product_name" name="c_buying_product_name" onkeyup="isi_otomatis(event)" required placeholder="Nama Produk" data-toggle="tooltip" data-placement="bottom" title="Nama Produk">
                                    <span class="input-group-btn">
                                        <button data-toggle="modal" data-target='#listProduct' data-placement="bottom" title="Pencarian Produk" class="btn btn-default" id="buttonSearch">
                                            <span class="fa fa-search"></span>      
                                        </button> 
                                    </span>
                                </div>
                                    <input type="hidden" class="form-control" id="c_id_buying" name="c_id_buying">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="c_buying_product_code" name="c_buying_product_code" placeholder="Kode Produk">
                                </div>
                                <div class="form-group">
                                    <input type="text" onkeyup="numberOnly(this);" class="form-control" id="c_buying_product_qty" name="c_buying_product_qty" placeholder="Qty" style="width: 90px;" data-toggle="tooltip" data-placement="bottom" title="Jumlah Produk">
                                </div>
                                <div class="form-group">
                                    <input type="text" onkeyup="numberOnly(this);" class="form-control" id="c_buying_price" name="c_buying_price" placeholder="Harga" style="width: 100px;" data-toggle="tooltip" data-placement="bottom" title="Harga Beli.">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control datepicker" id="c_product_expire" name="c_product_expire" placeholder="Exp. Date" style="width: 120px;" data-toggle="tooltip" data-placement="bottom" title="Exp. Date">
                                </div>
                                <script type="text/javascript">
                                    function disable(status){status=status;}
                                </script>

                                <div class="form-group text-right">
                                    <button type="submit" data-toggle="tooltip" data-placement="bottom" title="Tambah Produk" class="btn btn-default" id="buttonAddCart"><span class="fa fa-plus-circle" ></span id="buttonCaption"> Tambah</button>
                                    <button type="reset" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Membatal kan Pencarian" id="buttonCancel"><span class="fa fa-eraser"></span> Bersih</button>
                                </div>
                        </div>
                        <div class="clearfix"><hr></div>
                        <div id="resultCartBuying"></div>
                        <script type="text/javascript">
                            
                            // Add To Cart 
                            $('#supplier_name').keyup(function(e) {
                              if(e.keyCode == 13) {
                                $('#c_buying_product_name').focus();
                              }
                            });
                            // Add To Cart 
                            $('#c_buying_product_qty').keyup(function(e) {
                              if(e.keyCode == 13) {
                                if ($('#c_buying_product_qty').val() <= 0) {
                                    toastr['error']('Jumlah Produk Harus Diisi!');
                                    $('#c_buying_product_qty').focus();
                                }else if ($('#c_buying_product_qty').val()!='') {
                                    $('#c_buying_price').focus();
                                }
                              }
                            });
                            $('#c_buying_price').keyup(function(e) {
                              if(e.keyCode == 13) {
                                if ($('#c_buying_price').val() <= 0) {
                                    toastr['error']('Harga Produk Harus Diisi!');
                                    $('#c_buying_price').focus();
                                }else if ($('#c_buying_price').val() != '') {
                                    $('#buttonAddCart').focus();
                                }
                              }
                            });
                            $('#c_product_expire').keyup(function(e) {
                              if(e.keyCode == 13) {
                                $('#buttonAddCart').focus();
                              }
                            });

                        // Ajax Login 
                        function actionCartTransaction(){
                            var c_id_buying              = $('#c_id_buying').val();
                            var c_buying_product_name    = $('#c_buying_product_name').val();
                            var c_buying_product_code    = $('#c_buying_product_code').val();
                            var c_buying_product_qty     = $('#c_buying_product_qty').val();
                            var c_buying_price           = $('#c_buying_price').val();
                            var c_product_expire         = $('#c_product_expire').val();

                          if(c_buying_product_code != ""){
                                // Progress Load
                                disabledFormCart();
                                // Result
                                $.ajax({
                                    type:"get",
                                    url:"<?php echo $base_url."pages/transaction/buying/saveToCart.php" ?>",
                                    data:'c_id_buying='+c_id_buying+'&c_buying_product_name='+c_buying_product_name+'&c_buying_product_code='+c_buying_product_code+'&c_buying_product_qty='+c_buying_product_qty+'&c_buying_price='+c_buying_price+"&c_product_expire="+c_product_expire,
                                    success:function(data){
                                      $("#resultCartBuying").html(data);
                                    }
                                });
                              }
                          }

                        $("#buttonAddCart").click(function(){
                            if ($('#c_buying_product_name').val()=='') {
                                $("#listProduct").modal("show");
                                $("#c_buying_product_name").focus();        
                            }
                            else if ($('#c_buying_product_qty').val()  <= 0) {
                                toastr['error']('Jumlah Produk Harus Diisi!');
                                $("#c_buying_product_qty").focus();        
                            }
                            else if ($('#product_price').val()  <= 0) {
                                toastr['error']('Harga Produk Harus Diisi!');
                                $("#product_price").focus();          
                            }
                            else{
                                actionCartTransaction();
                                $('#buttonAddCart').html('<span class="fa fa-plus-circle"></span> Tambah');
                            }
                        });

                          $("#buttonCancel").click(function(){
                            enabledFormCart();
                            clearFormCart();
                            $('#buttonAddCart').html('<span class="fa fa-plus-circle"></span> Tambah');
                            $('#buttonCancel').html('<span class="fa fa-eraser"></span> Bersih');
                          });
                        </script>
                        <div class="clearfix"></div>
                    <div id="cartContentBuying"></div>
              </tbody>
          </table>

        </div>
    </div>
</div> 


<div class="modal fade" id="cancelBuyingCheckoutConfirm">
  <div class="modal-dialog">
    <div id="fetchCancelCheckout">
    </div>
  </div>
</div>
<script type="text/javascript">

    $("#cancelBuyingCheckout").click(function(event) {$("#cancelBuyingCheckoutConfirm").show( 'clip', 800 );});
    // Cancel Checkout
    $('#cancelBuyingCheckoutConfirm').on('show.bs.modal', function (e) {
        $("#fetchCancelCheckout").html("<center><img src='<?php echo $base_url ?>assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
        $.ajax({
            type : 'get',
            url : '<?php echo $base_url."pages/transaction/buying/cartCancelConfirm.php" ?>',
            success : function(data){
            $('#fetchCancelCheckout').html(data); //menampilkan data ke dalam modal
            }
        });
     });
</script>
<!-- REVIEW SEARCH SUPPLIER -->
<div class="modal fade bs-example-modal-lg" id="listSupplier">
  <div class="modal-dialog modal-lg" id="fetchedDataSupplier"></div>
</div>

<!-- REVIEW SEARCH PRODUCT -->
<div class="modal fade bs-example-modal-lg" id="listProduct">
  <div class="modal-dialog modal-lg" id="fetchDataProduct"></div>
</div>

<!-- EDIT HARGA JUAL -->
<div class="modal fade" id="editSellingPrice">
    <div class="modal-dialog">
        <div class="modal-content" id="fetchEditSellingPrice"></div>
    </div>
</div>

<!-- Delete Product -->
<div class="modal fade" id="deleteDataCart">
  <div class="modal-dialog">
      <div class="panel panel-red" id="fetchDeleteDataCart"></div>
  </div>
</div>

<script type="text/javascript">

    // datepicker
    $( function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange:"-10:+10"
          });
        }
    );

    $("#buttonDeleteItem").click(function(event) {$("#deleteDataCart").show( 'clip', 800 );});
    //Insert Produk
    $('#deleteDataCart').on('show.bs.modal', function (e) {
      var productCodeDelete = $(e.relatedTarget).data('id');
      $("#fetchDeleteDataCart").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
      $.ajax({
        type : 'get',
        url : '<?php echo $base_url."pages/transaction/buying/cartDeleteItemConfirm.php" ?>',
        data:'productCodeDelete='+productCodeDelete,
        success : function(data){
        $('#fetchDeleteDataCart').html(data);//menampilkan data ke dalam modal
        }
      });
     });
    
    function closeForm(){
      $('#deleteDataCart').modal('hide');
      $('#cancelBuyingCheckoutConfirm').modal('hide');
      clearFormCart();
    }

    LoadCartTransaction();
    // clearFormCart();

    function disabledFormCart(){
        document.getElementById('buttonSearch').disabled = true;
        document.getElementById('buttonAddCart').disabled = true;
        document.getElementById('buttonCancel').disabled = true;
        document.getElementById('c_buying_product_name').disabled = true;
        document.getElementById('c_buying_product_code').disabled = true;
        document.getElementById('c_buying_product_qty').disabled = true;
        document.getElementById('c_buying_price').disabled = true;
        document.getElementById('c_product_expire').disabled = true;
        document.getElementById('c_id_buying').disabled = true;
    }

    function enabledFormCart(){
        document.getElementById('buttonSearch').disabled = false;
        document.getElementById('buttonAddCart').disabled = false;
        document.getElementById('buttonCancel').disabled = false;
        document.getElementById('c_buying_product_name').disabled = false;
        document.getElementById('c_buying_product_code').disabled = false;
        document.getElementById('c_buying_product_qty').disabled = false;
        document.getElementById('c_buying_price').disabled = false;
        document.getElementById('c_product_expire').disabled = false;
        document.getElementById('c_id_buying').disabled = false;
    }

    function clearFormCart(){
        $('#c_buying_product_name').val('');
        $('#c_buying_product_code').val('');
        $('#c_buying_product_qty').val('');
        $('#c_buying_price').val('');
        $('#c_product_expire').val('');
        $('#c_id_buying').val('');
        $('#c_buying_product_name').focus();
    }

    function clearSupplier(){
        $('#supplier_name').val('');
        $('#supplier_code').val('');
        $('#supplier_code_hide').val('');
    }


    function loading(){
        disabledFormCart();
        $("#cartContentBuying").html("<center><img src='<?php echo $base_url ?>assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
        $("#cartContentBuying").hide();
        $("#cartContentBuying").fadeIn("slow");
    };

    function LoadCartTransaction(){loading();$("#cartContentBuying").load('<?php echo $base_url."pages/transaction/buying/cartView.php" ?>')};

    function isi_otomatis(){
        if(event.keyCode == 13){
            var c_buying_product_code  = $("[name='c_buying_product_code']").val();
            var c_buying_product_name  = $("[name='c_buying_product_name']").val();
            var c_buying_product_qty   = $("[name='c_buying_product_qty']").val();

             if ($("#c_buying_product_code").val() == "" || $("#c_buying_product_name").val() == "") {
                $(document).ready(function() {
                    $('#listProduct').modal('show');
                })
            }
            else{
                $("#c_buying_product_qty").focus();                    
            }
        }
    }
    function goToSupplier(){
        if(event.keyCode == 13){
            if ($("#supplier_code").val() == "" || $("#supplier_name").val() == "") {
                $('#listSupplier').modal('show');
            }
        }
    }


    // EDIT SELLING PRICE
    $('#editSellingPrice').on('show.bs.modal', function (e) {
        var id_product = $(e.relatedTarget).data('id'); 
        $("#fetchEditSellingPrice").html("<center><img src='<?php echo $base_url ?>assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
        $.ajax({
            type : 'post',
            url : '<?php echo $base_url ?>/pages/master_edit_selling_price.php',
            data :  'id_product='+ id_product,
            success : function(data){
            $('#fetchEditSellingPrice').html(data); //menampilkan data ke dalam modal
            }
        });
     });

    // Search Suplier
    $('#listSupplier').on('show.bs.modal', function (e) {
        var supplier_name = $('#supplier_name').val();
        $("#fetchedDataSupplier").html("<center><img src='<?php echo $base_url ?>assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
        $.ajax({
            type : 'GET',
            url : '<?php echo $base_url."pages/transaction/buying/listSupplier.php" ?>',
            data :  'supplier_name='+ supplier_name,
            success : function(data){
            $('#fetchedDataSupplier').html(data);//menampilkan data ke dalam modal
            }
        });
     });

    // Search Product
    $('#listProduct').on('show.bs.modal', function (e) {
        var c_buying_product_name = $('#c_buying_product_name').val();
        $("#fetchDataProduct").html("<center><img src='<?php echo $base_url ?>assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
        $.ajax({
            type : 'get',
            url : '<?php echo $base_url."pages/transaction/buying/listProduct.php" ?>',
            data :  'c_buying_product_name='+ c_buying_product_name,
            success : function(data){
            $('#fetchDataProduct').html(data); //menampilkan data ke dalam modal
            }       
        });
    });
</script>


<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu Transaksi Pembelian', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>