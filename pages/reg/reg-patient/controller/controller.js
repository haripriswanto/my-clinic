function insertEffect() {$("#insertProduct").show( 'clip', 800 );};
function deleteEffect() {$("#delete").show( 'clip', 800 );};
function detailEffect() {$("#detail").show( 'clip', 800 );};

$("#buttonAddProduct").click(function(event) {insertEffect();});
$("#buttonDelete").click(function(event) {deleteEffect();});
$("#buttonDetail").click(function(event) {detailEffect();});

//Insert Produk
$('#insertProduct').on('show.bs.modal', function (e) {
	$("#fetchDataInsert").html("<center><img src='assets/images/load.gif ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
	$.ajax({
	  type : 'get',
	  url : 'pages/transaction/product/insert.php',
	  success : function(data){
	  $('#fetchDataInsertProduct').html(data);//menampilkan data ke dalam modal
	  }
	});
});


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
        $('#c_product_expire').focus();
    }
  }
});
$('#c_product_expire').keyup(function(e) {
  if(e.keyCode == 13) {
    $('#c_batch_code').focus();
  }
});
$('#c_batch_code').keyup(function(e) {
  if(e.keyCode == 13) {
    if ($('#c_batch_code').val() <= 0) {
        toastr['error']('Kode Batch Harus Diisi!');
        $('#c_batch_code').focus();
    }else if ($('#c_batch_code').val() != '') {
        $('#buttonAddCart').focus();
    }
  }
});


function formatNumber(num) {
return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

// Ajax Login 
function actionCartTransaction(){
var c_id_buying              = $('#c_id_buying').val();
var c_buying_product_name    = $('#c_buying_product_name').val();
var c_buying_product_code    = $('#c_buying_product_code').val();
var c_buying_product_qty     = $('#c_buying_product_qty').val();
var c_buying_price           = $('#c_buying_price').val();
var c_product_expire         = $('#c_product_expire').val();
var c_batch_code             = $('#c_batch_code').val();

if(c_buying_product_code != ""){
    // Progress Load
    disabledFormCart();
    // Result
    $.ajax({
        type:"post",
        url:"pages/transaction/buying/saveToCart.php",
        data:{
            c_id_buying: c_id_buying,
            c_buying_product_name: c_buying_product_name,
            c_buying_product_code: c_buying_product_code,
            c_buying_product_qty: c_buying_product_qty,
            c_buying_price: c_buying_price,
            c_product_expire: c_product_expire,
            c_batch_code: c_batch_code
        },
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

enabledFormCart();
clearFormCart();

function disableFormCheckout() {
  document.getElementById('cart_note').disabled = true;
  document.getElementById('cancelBuyingCheckout').disabled = true;
  document.getElementById('submitBuyingCheckout').disabled = true;
  document.getElementById('update_price').disabled = true;
}

function enableFormCheckout() {
  document.getElementById('cart_note').disabled = false;
  document.getElementById('cancelBuyingCheckout').disabled = false;
  document.getElementById('submitBuyingCheckout').disabled = false;
  document.getElementById('update_price').disabled = false;
  $('#cart_note').val('');
}


function resultTotalBuying() {
  var total_harga_ = $('#total_harga_').val();
  var total_item_ = $('#total_item_').val();

  // $('#loadCancelCheckoutConfirm').html('<font size="13"><b>Rp. '+formatNumber(total_harga_)+'</b></font>');
  $('#buyingTotal').html('<font size="6"><b>Rp. ' + formatNumber(total_harga_) + '</b></font>');
  $('#itemTotal').html('(<font size="2"><b>' + formatNumber(total_item_) + '  Item</b></font>)');
}

function disabledFormCart(){
  document.getElementById('buttonSearch').disabled = true;
  document.getElementById('buttonAddCart').disabled = true;
  document.getElementById('buttonCancel').disabled = true;
  document.getElementById('c_buying_product_name').disabled = true;
  document.getElementById('c_buying_product_code').disabled = true;
  document.getElementById('c_buying_product_qty').disabled = true;
  document.getElementById('c_buying_price').disabled = true;
  document.getElementById('c_product_expire').disabled = true;
  document.getElementById('c_batch_code').disabled = true;
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
  document.getElementById('c_batch_code').disabled = false;
  document.getElementById('c_id_buying').disabled = false;
}

function clearFormCart(){
$('#c_buying_product_name').val('');
$('#c_buying_product_code').val('');
$('#c_buying_product_qty').val('');
$('#c_buying_price').val('');
$('#c_product_expire').val('');
$('#c_batch_code').val('');
$('#c_id_buying').val('');
$('#c_buying_product_name').focus();
}

// datepicker
$( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange:"-1:+10"
      });
    }
); 

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
// CHECKOUT
function actionCheckoutBuying(){
  if ($("#c_buying_product_code").val() != '' ) {
    toastr['error']('Transaksi Belum Selesai!');
    $('#buttonAddCart').focus();
  } else {
    var total_item_         = $('#total_item_').val();
    var total_harga_        = $('#total_harga_').val();
    var payment_type        = $('#payment_type').val();
    var transaction_date    = $('#transaction_date').val();
    var transaction_time    = $('#transaction_time').val();
    var cart_note           = $('#cart_note').val();
    var money_paid          = $('#money_paid').val();
    // Supplier
    var supplier_code       = $('#supplier_code').val();
    var supplier_name       = $('#supplier_name').val();
    // Tambahan
    var transaction_date    = $('#transaction_date').val();
    var transaction_time    = $('#transaction_time').val();
    var cart_note           = $('#cart_note').val();

    var updatePrice = [];
      $('#update_price').each(function(){
        if($(this).is(":checked")){
         updatePrice.push($(this).val());
        }
      });
     updatePrice = updatePrice.toString();

      // Progress Load
      disableButton();
      $("#submitBuyingCheckout").html("<center><img src='assets/images/load.gif' width='25' height='25'/><font size='2'>Proses...</font></center>")
      // Result
      $.ajax({
          type:"get",
          url:"pages/transaction/buying/transactionCheckout.php",
          data:{                    
            total_item_:total_item_,
            total_harga_:total_harga_,
            payment_type:payment_type,
            transaction_date:transaction_date,
            transaction_time:transaction_time,
            cart_note:cart_note,
            money_paid:money_paid,
            supplier_code:supplier_code,
            supplier_name:supplier_name,
            transaction_date:transaction_date,
            transaction_time:transaction_time,
            cart_note:cart_note,
            updatePrice:updatePrice
          },
          success:function(data){
            $("#submitBuyingCheckout").html(data);
          }
      });
  }
}

function disableButton(){
  document.getElementById('submitBuyingCheckout').disabled = true;
  document.getElementById('cancelBuyingCheckout').disabled = true;
}
function enableButton(){
  document.getElementById('submitBuyingCheckout').disabled = false;
  document.getElementById('cancelBuyingCheckout').disabled = false;
}

$('#submitBuyingCheckout').click(function(e){
  actionCheckoutBuying();
});

$(document).on('dblclick', '#selectProductCart', function (e) {
  $("#c_buying_product_code").val($(this).attr('data-product-code'));
  $("#c_buying_product_name").val($(this).attr('data-product-name'));   
  $("#c_buying_product_qty").val($(this).attr('data-product-qty'));   
  $("#c_product_expire").val($(this).attr('data-product-exp'));   
  $("#c_batch_code").val($(this).attr('data-batch-code'));   
  $("#c_buying_price").val($(this).attr('data-product-price'));             
  $('#c_buying_product_qty').focus();

  $('#buttonAddCart').html('<span class="fa fa-pencil"></span> Update');
  $('#buttonCancel').html('<span class="fa fa-undo"></span> Batal');
});


$("#cancelBuyingCheckout").click(function(event) {$("#cancelBuyingCheckoutConfirm").show( 'clip', 800 );});
// Cancel Checkout
$('#cancelBuyingCheckoutConfirm').on('show.bs.modal', function (e) {
    $("#fetchCancelCheckout").html("<center><img src='assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
    $.ajax({
        type : 'get',
        url : 'pages/transaction/buying/cartCancelConfirm.php',
        success : function(data){
        $('#fetchCancelCheckout').html(data); //menampilkan data ke dalam modal
        }
    });
 });


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
  $("#fetchDeleteDataCart").html("<center><img src='assets/images/load.gif' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
  $.ajax({
    type : 'get',
    url : 'pages/transaction/buying/cartDeleteItemConfirm.php',
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

function clearSupplier(){
    $('#supplier_name').val('');
    $('#supplier_code').val('');
    $('#supplier_code_hide').val('');
}


function loading(){
    disabledFormCart();
    $("#cartContentBuying").html("<center><img src='assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
    $("#cartContentBuying").hide();
    $("#cartContentBuying").fadeIn("slow");
};

function LoadCartTransaction(){loading();$("#cartContentBuying").load('pages/transaction/buying/cartView.php')};

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
    $("#fetchEditSellingPrice").html("<center><img src='assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
    $.ajax({
        type : 'post',
        url : '/pages/master_edit_selling_price.php',
        data :  'id_product='+ id_product,
        success : function(data){
        $('#fetchEditSellingPrice').html(data); //menampilkan data ke dalam modal
        }
    });
 });

// Search Suplier
$('#listSupplier').on('show.bs.modal', function (e) {
    var supplier_name = $('#supplier_name').val();
    $("#fetchedDataSupplier").html("<center><img src='assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
    $.ajax({
        type : 'GET',
        url : 'pages/transaction/buying/listSupplier.php',
        data :  'supplier_name='+ supplier_name,
        success : function(data){
        $('#fetchedDataSupplier').html(data);//menampilkan data ke dalam modal
        }
    });
 });

// Search Product
$('#listProduct').on('show.bs.modal', function (e) {
    var c_buying_product_name = $('#c_buying_product_name').val();
    $("#fetchDataProduct").html("<center><img src='assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
    $.ajax({
        type : 'get',
        url : 'pages/transaction/buying/listProduct.php',
        data :  'c_buying_product_name='+ c_buying_product_name,
        success : function(data){
        $('#fetchDataProduct').html(data); //menampilkan data ke dalam modal
        }       
    });
});