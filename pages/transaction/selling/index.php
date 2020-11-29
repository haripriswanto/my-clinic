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
        <!-- <h1 class="page-header"></h1> -->
        <div class="clearfix"><br></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo $base_url."review-penjualan" ?>" title="Review Kegiatan penjualan, Print Ulang, Batal" class="btn btn-primary"> <span class="fa fa-list"></span> Review</a>
        
        <!-- Insert Customer -->
        <div class="modal fade" id="insertCustomer">
            <div class="modal-dialog modal-lg">
                <div class="panel panel-primary" id="fetchDataInsertCustomer">
                </div>
            </div>
        </div>
        <!-- Insert Dokter -->
        <div class="modal fade" id="insertDokter">
            <div class="modal-dialog modal-lg">
                <div class="panel panel-primary" id="fetchDataInsertDokter">
                </div>
            </div>
        </div>
        <!-- Insert HTU -->
        <div class="modal fade" id="insertHTU">
            <div class="modal-dialog">
                <div class="panel panel-primary" id="fetchDataInsertHTU">
                </div>
            </div>
        </div>

        <!-- Form Transaction Buying -->
        <div class="clearfix"><br></div>
        <div class="panel panel-primary">
            <div class="panel-heading">
            	<b>TRANSAKSI PENJUALAN</b>
            </div>
            <div class="panel-body">
                <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="form-inline">
                                 <div class="form-group">
                                    <input type="date" class="form-control tooltips" id="transaction_date" name="transaction_date" placeholder="Tgl Transaksi" title="Jika Kosong maka Tgl Hari ini">
                                </div>
                                <div class="form-group">
                                    <select name="transaction_time" id="transaction_time" class="form-control tooltips"  title="Jika Kosong maka Jam Saat ini">
                                        <?php include('master_time.php'); ?>
                                    </select>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control tooltips" id="customer_code" name="customer_code" placeholder="Kode Pelanggan">
                                </div>
                                <div class="input-group" >
                                    <input type="text" class="form-control tooltips" id="customer_name" name="customer_name" onkeypress="goTocustomer(event)" title="Nama Pelanggan" placeholder="Nama Pelanggan">
                                    <span class="input-group-btn tooltips">
                                        <button type="button" class="btn btn-default" id="customerSearch" name="customerSearch" data-toggle="modal" data-target="#listCustomer" data-placement="bottom" title="Pencarian Pelanggan">
                                        <span class="fa fa-search"></span>      
                                        </button> 
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="customer_code_hide" name="customer_code_hide" placeholder="Kode" style="width: 65%" class="form-control tooltips" disabled="">
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control tooltips" id="dokter_code" name="dokter_code" placeholder="Kode Dokter">
                                </div>
                                <div class="input-group" >
                                    <input type="text" class="form-control tooltips" id="dokter_name" name="dokter_name" onkeypress="goToDokter(event)" title="Nama Dokter" placeholder="Nama Dokter">
                                    <span class="input-group-btn tooltips">
                                        <button type="button" class="btn btn-default" id="dokterSearch" name="dokterSearch" data-toggle="modal" data-target="#listDokter" data-placement="bottom" title="Pencarian Dokter">
                                        <span class="fa fa-search"></span>      
                                        </button> 
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="dokter_code_hide" name="dokter_code_hide" placeholder="Kode" style="width: 65%" class="form-control tooltips" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-md-12 text-right">
                                <div class="row">
                                    <font size="2">TOTAL TAGIHAN: </font>
                                    <br>
                                    <i id="sellingTotal"></i>
                                    <br>
                                    <i id="itemTotal"></i> 
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row" id="resultCheckoutSelling">
                                    <button type="button" class="btn btn-default tooltips" name="cancelSellingCheckout" id="cancelSellingCheckout" data-toggle="modal" data-target="#cancelSellingCheckoutConfirm" title="Batal Transaksi">
                                        <span class="fa fa-trash"></span> Batal
                                    </button>  
                                    <button type="button" class="btn btn-success tooltips" name="submitSellingCheckout" id="submitSellingCheckout" data-toggle="modal" data-target="#submitSellingCheckoutConfirm" title="Selesaikan Transaksi">
                                        <span class="fa fa-save"></span> Checkout
                                    </button>
                                </div>
                            </div>
                            <style type="text/css">
                                #submitSellingCheckout{
                                    height: 50px;
                                    width: 140px;
                                    font-size: 20px
                                }
                                #cancelSellingCheckout{
                                    height: 50px;
                                    width: 140px;
                                    font-size: 20px
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="panel panel-primary">
                    <!-- <div class="panel-heading">
                        <h3 class="panel-title">Produk</h3>
                    </div> -->
                    <div class="panel-body">
                        <div class="form-inline">
                              <div class="input-group form-group">
                                <input type="text" class="form-control tooltips" id="c_selling_product_name" name="c_selling_product_name" onkeyup="goToProduct(event)" required placeholder="Ketik nama/kode produk" title="Ketik nama/kode produk lalu tekan enter.">
                                    <span class="input-group-btn tooltips">
                                        <button data-toggle="modal" data-target='#listProduct' data-placement="bottom" title="Pencarian Produk" class="btn btn-default" id="buttonSearch">
                                            <span class="fa fa-search"></span>      
                                        </button> 
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control tooltips" id="c_selling_product_code" name="c_selling_product_code" placeholder="Kode Produk">
                                </div>
                                <div class="form-group">
                                    <input type="text" onkeyup="numberOnly(this);" class="form-control tooltips" id="c_selling_product_qty" name="c_selling_product_qty" placeholder="Qty" style="width: 90px;" title="Jumlah Produk">
                                </div>
                                <div class="form-group">
                                    <input type="text" onkeyup="numberOnly(this);" class="form-control" id="c_selling_price" name="c_selling_price" placeholder="Harga Jual" style="width: 100px;">
                                </div>
                                <div class="input-group form-group">
                                    <input type="text" class="form-control tooltips" id="c_selling_HTU" name="c_selling_HTU" onkeyup="goToHTU(event)" placeholder="Cara Pakai" title="Ketik Cara Pakai Lalu Enter">
                                    <span class="input-group-btn">
                                        <button data-toggle="modal" data-target='#listHTU' title="Cara Pakai" class="btn btn-default tooltips" id="buttonSearchHTU">
                                            <span class="fa fa-search"></span>      
                                        </button> 
                                    </span>
                                </div>
                                <input type="hidden" id="c_selling_HTU_code" name="c_selling_HTU_code">
                                <div class="form-group text-right">
                                    <button type="submit" title="Tambah Produk" class="btn btn-default" id="buttonAddCart"><span class="fa fa-plus-circle" ></span> Tambah</button>
                                    <button type="reset" class="btn btn-default" title="Membatal kan Pencarian" id="buttonCancel"><span class="fa fa-eraser"></span> Hapus</button>
                                </div>
                        </div>
                        <div class="clearfix"><hr></div>
                        
                    <div class="clearfix"></div>
                    <div id="cartContentselling"></div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <legend></legend>
                    </div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <label>Catatan</label>
                        <textarea name="cart_note" id="cart_note" class="form-control tooltips" rows="3" cols="80" placeholder="Note!" title="Jika Ada Catatan Khusus."></textarea>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <label>Nama Kasir</label>
                        <input type="text" name="cashier" id="cashier" class="form-control tooltips" value="<?php echo $sessionUser ?>">
                    </div>
              </tbody>
          </table>

        </div>
    </div>
</div> 

<!-- Cancel Checkout -->
<div class="modal fade" id="cancelSellingCheckoutConfirm" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" id="loadCancelCheckoutConfirm"></div>
</div>

<!-- CheckOut -->
<div class="modal fade" id="submitSellingCheckoutConfirm" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" id="loadCheckoutConfirm"></div>
</div>

<!-- REVIEW SEARCH How To Use -->
<div class="modal fade bs-example-modal-lg" id="listHTU">
  <div class="modal-dialog modal-lg" id="fetchedDataHTU"></div>
</div>

<!-- REVIEW SEARCH customer -->
<div class="modal fade bs-example-modal-lg" id="listCustomer">
  <div class="modal-dialog modal-lg" id="fetchedDataCustomer"></div>
</div>

<!-- REVIEW SEARCH DOKTER -->
<div class="modal fade bs-example-modal-lg" id="listDokter">
  <div class="modal-dialog modal-lg" id="fetchedDataDokter"></div>
</div>

<!-- REVIEW SEARCH PRODUCT -->
<div class="modal fade bs-example-modal-lg" id="listProduct">
  <div class="modal-dialog modal-lg" id="fetchDataProduct"></div>
</div>

<!-- Delete Product -->
<div class="modal fade" id="deleteDataCart">
  <div class="modal-dialog">
      <div class="panel panel-red" id="fetchDeleteDataCart"></div>
  </div>
</div>

<script src="<?php echo $base_url."pages/transaction/selling/controller/controller.js" ?>" type="text/javascript"></script>


<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu Transaksi Penjualan', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>