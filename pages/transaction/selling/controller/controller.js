$("#buttonAddCustomer").click(function (event) {
  insertCustomer();
});
$("#buttonAddDokter").click(function (event) {
  insertDokter();
});
$("#buttonAddHTU").click(function (event) {
  insertHTUEffect();
});

function goTocustomer() {
  if (event.keyCode == 13) {
    if ($("#customer_name").val() == "") {
      $('#listCustomer').modal('show');
    } else {
      $('#dokter_name').focus();
    }
  }
}

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function resultTotalSelling() {
  var total_harga_ = $('#total_harga_').val();
  var total_item_ = $('#total_item_').val();

  // $('#loadCancelCheckoutConfirm').html('<font size="13"><b>Rp. '+formatNumber(total_harga_)+'</b></font>');
  $('#sellingTotal').html('<font size="6"><b>Rp. ' + formatNumber(total_harga_) + '</b></font>');
  $('#itemTotal').html('(<font size="2"><b>' + formatNumber(total_item_) + '  Item</b></font>)');
}

$(document).ready(function () {
  document.getElementById('cashier').disabled = true;
  document.getElementById('c_selling_price').disabled = true;
});

$('#submitSellingCheckout').click(function (event) {
  if ($('#c_selling_product_qty').val() != '') {
    toastr['error']('Transaksi Belum Selesai.');
    $('#c_selling_product_qty').focus();
  } else {
    CheckConfirm();
  }
});

function CheckConfirm() {
  // CheckOUt
  $('#submitSellingCheckoutConfirm').on('show.bs.modal', function (e) {
    var total_harga_ = $('#total_harga_').val();
    var total_item_ = $('#total_item_').val();
    var customer_code = $('#customer_code').val();
    var customer_name = $('#customer_name').val();
    var dokter_code = $('#dokter_code').val();
    var dokter_name = $('#dokter_name').val();
    var transaction_date = $('#transaction_date').val();
    var transaction_time = $('#transaction_time').val();
    var cart_note = $('#cart_note').val();

    // $("#loadCheckoutConfirm").html(loadingImage);
    $.ajax({
      type: 'GET',
      url: 'pages/transaction/selling/checkout.php',
      data: 'total_harga_=' + total_harga_ + '&total_item_=' + total_item_ + '&customer_code=' + customer_code + '&customer_name=' + customer_name + '&dokter_code=' + dokter_code + '&dokter_name=' + dokter_name + '&transaction_date=' + transaction_date + '&transaction_time=' + transaction_time + '&cart_note=' + cart_note,
      success: function (data) {
        // console.log(data);
        $('#loadCheckoutConfirm').html(data); //menampilkan data ke dalam modal
      }
    });
  });
}

function disableFormCheckout() {
  document.getElementById('cart_note').disabled = true;
  document.getElementById('cancelSellingCheckout').disabled = true;
  document.getElementById('submitSellingCheckout').disabled = true;
}

function enableFormCheckout() {
  document.getElementById('cart_note').disabled = false;
  document.getElementById('cancelSellingCheckout').disabled = false;
  document.getElementById('submitSellingCheckout').disabled = false;
  $('#cart_note').val('');
}

function disableButton() {
  document.getElementById('buttonCheckout').disabled = true;
  document.getElementById('buttonCancelCheckout').disabled = true;
  $("#buttonCheckout").html("<center><img src='assets/images/load.gif' width='25' height='25'/><font size='1'>Progress ...</font></center>");
}

function enableButton() {
  document.getElementById('buttonCheckout').disabled = false;
  document.getElementById('buttonCancelCheckout').disabled = false;
  $('#buttonCheckout').html('<span class="fa fa-save"> Bayar</span>');
}

function disable(status) {
  status = status;
}

function closeFormCheckout() {
  $('#submitSellingCheckoutConfirm').modal('hide');
}

//Insert Customer
var loadingImage = "<img src='assets/images/load.gif' width='15' height='15'/><i> Proses ...</i>";
$('#insertCustomer').on('show.bs.modal', function (e) {
  $("#fetchDataInsertCustomer").html(loadingImage);
  $.ajax({
    type: 'get',
    url: 'pages/transaction/customer/insert.php',
    success: function (data) {
      $('#fetchDataInsertCustomer').html(data); //menampilkan data ke dalam modal
    }
  });
});

//Insert Dokter
$('#insertDokter').on('show.bs.modal', function (e) {
  $("#fetchDataInsertDokter").html(loadingImage);
  $.ajax({
    type: 'get',
    url: 'pages/transaction/dokter/insert.php',
    success: function (data) {
      $('#fetchDataInsertDokter').html(data); //menampilkan data ke dalam modal
    }
  });
});

//Insert HTU
$('#insertHTU').on('show.bs.modal', function (e) {
  $("#fetchDataInsertHTU").html(loadingImage);
  $.ajax({
    type: 'get',
    url: 'pages/transaction/htu/insert.php',
    success: function (data) {
      $('#fetchDataInsertHTU').html(data); //menampilkan data ke dalam modal
    }
  });
});

$('#customer_name').keyup(function (e) {
  if (e.keyCode == 13) {
    if ($('#customer_code').val() == '') {
      $('#customer_name').focus();
    } else {
      $('#dokter_name').focus();
    }
  }
});
$('#c_selling_product_qty').keyup(function (e) {
  if (e.keyCode == 13) {
    if ($('#c_selling_product_qty').val() <= 0) {
      toastr['error']('Jumlah Produk Harus Diisi!');
      $('#c_selling_product_qty').focus();
    } else if ($('#c_selling_product_qty').val() != '') {
      $('#buttonAddCart').focus();
    }
  }
});
$('#c_selling_HTU').change(function (e) {
  $('#buttonAddCart').focus();
});

// Function Customer

// CLEAR Form
function clearFormCustomer() {
  $('#customer_code').val('');
  $('#customer_name').val('');
  $('#customer_gender').val('');
  $('#customer_birthday').val('');
  $('#customer_email').val('');
  $('#customer_phone').val('');
  $('#customer_address').val('');
  $('#customer_name').focus();
}

// Enabled Form
function enabledFormCustomer() {
  document.getElementById('customer_code').disabled = false;
  document.getElementById('customer_name').disabled = false;
  document.getElementById('customer_gender').disabled = false;
  document.getElementById('customer_birthday').disabled = false;
  document.getElementById('customer_email').disabled = false;
  document.getElementById('customer_phone').disabled = false;
  document.getElementById('customer_address').disabled = false;
  document.getElementById('customer_name').disabled = false;
  document.getElementById('buttonInsertCustomer').disabled = false;
  document.getElementById('buttonCancelCustomer').disabled = false;
}

// Disabled Form
function disabledFormCustomer() {
  document.getElementById('customer_code').disabled = true;
  document.getElementById('customer_name').disabled = true;
  document.getElementById('customer_gender').disabled = true;
  document.getElementById('customer_birthday').disabled = true;
  document.getElementById('customer_email').disabled = true;
  document.getElementById('customer_phone').disabled = true;
  document.getElementById('customer_address').disabled = true;
  document.getElementById('customer_name').disabled = true;
  document.getElementById('buttonInsertCustomer').disabled = true;
  document.getElementById('buttonCancelCustomer').disabled = true;
}

function closeFormCustomer() {
  $('#insertCustomer').modal('hide');
}

// Function Dokter

// INSERT HANDLER AJAX
function clearDokterForm() {
  $('#dokter_code').val('');
  $('#dokter_type').val('');
  $('#dokter_name').val('');
  $('#dokter_address').val('');
  $('#dokter_email').val('');
  $('#dokter_phone').val('');
  $('#dokter_website').val('');
  $('#dokter_name').focus();
}

function closeDokterForm() {
  $('#insertDokter').modal('hide');
  $('#dokter_name').focus();
}

// Ajax Login 
function actionCartTransaction() {
  var c_selling_product_name = $('#c_selling_product_name').val();
  var c_selling_product_code = $('#c_selling_product_code').val();
  var c_selling_product_qty = $('#c_selling_product_qty').val();
  var c_selling_price = $('#c_selling_price').val();
  var c_selling_HTU_code = $('#c_selling_HTU_code').val();
  var c_selling_HTU = $('#c_selling_HTU').val();

  // var e_ticket = [];
  //   $('#eticket').each(function(){
  //     if($(this).is(":checked")){
  //      e_ticket.push($(this).val());
  //     }
  //   });
  // e_ticket = e_ticket.toString();
  // alert(c_selling_product_name, c_selling_product_code, c_selling_price);

  if (c_selling_product_code != "") {
    // Progress Load
    disabledFormCart();
    $("#buttonAddCart").html(loadingImage);
    // Result
    $.ajax({
      type: "get",
      url: "pages/transaction/selling/saveToCart.php",
      data: 'c_selling_product_name=' + c_selling_product_name + '&c_selling_product_code=' + c_selling_product_code + '&c_selling_product_qty=' + c_selling_product_qty + '&c_selling_price=' + c_selling_price + "&c_selling_HTU_code=" + c_selling_HTU_code + "&c_selling_HTU=" + c_selling_HTU,
      success: function (data) {
        $("#buttonAddCart").html(data);
      }
    });
  }
}

$("#buttonAddCart").click(function () {
  if ($('#c_selling_product_name').val() == '' || $('#c_selling_product_code').val() == '') {
    $("#listProduct").modal("show");
    $("#c_selling_product_name").focus();
  } else if ($('#c_selling_product_qty').val() < 1) {
    toastr['error']('Jumlah Produk Harus Diisi!');
    $("#c_selling_product_qty").focus();
  } else if ($('#product_price').val() < 1) {
    toastr['error']('Harga Produk Harus Diisi!');
    $("#product_price").focus();
  } else {
    actionCartTransaction();
    $('#buttonAddCart').html('<span class="fa fa-plus-circle"></span> Tambah');
    $('#buttonCancel').html('<span class="fa fa-eraser"></span> Hapus');
  }
});

$("#buttonCancel").click(function () {
  enabledFormCart();
  clearFormCart();
  $('#buttonAddCart').html('<span class="fa fa-plus-circle"></span> Tambah');
  $('#buttonCancel').html('<span class="fa fa-eraser"></span> Hapus');
});

function disabledButtonCart() {
  document.getElementById('submitSellingCheckout').disabled = true;
  document.getElementById('cancelSellingCheckout').disabled = true;
  document.getElementById('cart_note').disabled = true;
}

function enabledButtonCart() {
  document.getElementById('submitSellingCheckout').disabled = false;
  document.getElementById('cancelSellingCheckout').disabled = false;
  document.getElementById('cart_note').disabled = false;
}

function clearHeadForm() {
  $('#customer_code').val('');
  $('#customer_name').val('');
  $('#customer_code_hide').val('');
  $('#dokter_code').val('');
  $('#dokter_name').val('');
  $('#dokter_code_hide').val('');
  $('#transaction_date').val('');
  $('#transaction_time').val('');
  $('#customer_name').focus();
  resultTotalSelling();
}

if ($('#total_harga_').val() == '') {
  disabledFormCart();
} else {
  enabledButtonCart();
}

// datepicker
$(function () {
  $(".datepicker").datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    yearRange: "-10:+10"
  });
});

$('#customer_name').focus();

$("#buttonDeleteItem").click(function (event) {
  $("#deleteDataCart").show('clip', 800);
});
//Insert Produk
$('#deleteDataCart').on('show.bs.modal', function (e) {
  var productCodeDelete = $(e.relatedTarget).data('id');
  $("#fetchDeleteDataCart").html(loadingImage);
  $.ajax({
    type: 'get',
    url: 'pages/transaction/selling/cartDeleteItemConfirm.php',
    data: 'productCodeDelete=' + productCodeDelete,
    success: function (data) {
      $('#fetchDeleteDataCart').html(data); //menampilkan data ke dalam modal
    }
  });
});

function closeForm() {
  $('#deleteDataCart').modal('hide');
  $('#cancelSellingCheckoutConfirm').modal('hide');
  $('#insertCustomer').modal('hide');
  $('#insertHtu').modal('hide');
  clearFormCart();
}

function closeList() {
  $('#deleteDataCart').modal('hide');
  $('#cancelSellingCheckoutConfirm').modal('hide');
  $('#insertCustomer').modal('hide');
  $('#insertHtu').modal('hide');
  clearFormCart();
}

LoadCartTransaction();

// clearFormCart();
function disabledFormCart() {
  document.getElementById('buttonSearch').disabled = true;
  document.getElementById('buttonAddCart').disabled = true;
  document.getElementById('buttonCancel').disabled = true;
  document.getElementById('c_selling_product_name').disabled = true;
  document.getElementById('c_selling_product_code').disabled = true;
  document.getElementById('c_selling_product_qty').disabled = true;
  document.getElementById('c_selling_HTU').disabled = true;
  document.getElementById('buttonSearchHTU').disabled = true;
}

function enabledFormCart() {
  document.getElementById('buttonSearch').disabled = false;
  document.getElementById('buttonAddCart').disabled = false;
  document.getElementById('buttonCancel').disabled = false;
  document.getElementById('c_selling_product_name').disabled = false;
  document.getElementById('c_selling_product_code').disabled = false;
  document.getElementById('c_selling_product_qty').disabled = false;
  document.getElementById('c_selling_HTU').disabled = false;
  document.getElementById('buttonSearchHTU').disabled = false;
}

function clearFormCart() {
  $('#c_selling_product_name').val('');
  $('#c_selling_product_code').val('');
  $('#c_selling_product_qty').val('');
  $('#c_selling_price').val('');
  $('#c_selling_HTU_code').val('');
  $('#c_selling_HTU').val('');
  // $('#cart_note').html('');
  $('#c_selling_product_name').focus();
}

function clearcustomer() {
  $('#customer_name').val('');
  $('#customer_code').val('');
  $('#customer_code_hide').val('');
}

// INSERT HANDLER AJAX
function clearInsertForm() {
  $('#i_htu_description').val('');
  $('#i_htu_description').focus();
  $('#insertHTU').modal('hide');
}

function enabledInsertForm() {
  document.getElementById('buttonInsertHTU').disabled = false;
  document.getElementById('buttonCloseHTU').disabled = false;
  document.getElementById('buttonCancelHTU').disabled = false;
}

function disabledInsertForm() {
  document.getElementById('buttonInsertHTU').disabled = true;
  document.getElementById('buttonCloseHTU').disabled = true;
  document.getElementById('buttonCancelHTU').disabled = true;
}

function loading() {
  disabledFormCart();
  $("#cartContentselling").html(loadingImage);
  $("#cartContentselling").hide();
  $("#cartContentselling").fadeIn("slow");
};

function LoadCartTransaction() {
  loading();
  $("#cartContentselling").load('pages/transaction/selling/cartView.php');
};

function goToHTU() {
  if (event.keyCode == 13) {
    var c_selling_HTU = $("#c_selling_HTU").val();
    var c_selling_HTU_code = $("#c_selling_HTU_code").val();

    if ($("#c_selling_HTU_code").val() == "" || $("#c_selling_HTU").val() == "") {
      $('#listHTU').modal('show');
    } else {
      $("#buttonAddCart").focus();
    }
  }
}

function goToProduct() {
  if (event.keyCode == 13) {
    var c_selling_product_code = $("[name='c_selling_product_code']").val();
    var c_selling_product_name = $("[name='c_selling_product_name']").val();
    var c_selling_product_qty = $("[name='c_selling_product_qty']").val();

    if ($("#c_selling_product_code").val() == "" || $("#c_selling_product_name").val() == "") {
      $('#listProduct').modal('show');
    } else {
      $("#c_selling_product_qty").focus();
    }
  }
}


function goToDokter() {
  if (event.keyCode == 13) {
    if ($("#dokter_name").val() == "") {
      $('#listDokter').modal('show');
    } else {
      $('#c_selling_product_name').focus();
    }
  }
}


// EDIT SELLING PRICE
$('#editSellingPrice').on('show.bs.modal', function (e) {
  var id_product = $(e.relatedTarget).data('id');
  $("#fetchEditSellingPrice").html(loadingImage);
  $.ajax({
    type: 'post',
    url: 'pages/master_edit_selling_price.php',
    data: 'id_product=' + id_product,
    success: function (data) {
      $('#fetchEditSellingPrice').html(data); //menampilkan data ke dalam modal
    }
  });
});


// Search Customer
$('#listCustomer').on('show.bs.modal', function (e) {
  var customer_name = $('#customer_name').val().trim();
  $("#fetchedDataCustomer").html(loadingImage);
  $.ajax({
    type: 'GET',
    url: 'pages/transaction/selling/listCustomer.php',
    data: 'customer_name=' + customer_name,
    success: function (data) {
      $('#fetchedDataCustomer').html(data); //menampilkan data ke dalam modal
    }
  });
});

// Search Dokter
$('#listDokter').on('show.bs.modal', function (e) {
  var dokter_name = $('#dokter_name').val().trim();
  $("#fetchedDataDokter").html(loadingImage);
  $.ajax({
    type: 'GET',
    url: 'pages/transaction/selling/listDokter.php',
    data: 'dokter_name=' + dokter_name,
    success: function (data) {
      $('#fetchedDataDokter').html(data); //menampilkan data ke dalam modal
    }
  });
});

// Search Product
$('#listProduct').on('show.bs.modal', function (e) {
  var c_selling_product_name = $('#c_selling_product_name').val().trim();
  $("#fetchDataProduct").html(loadingImage);
  $.ajax({
    type: 'get',
    url: 'pages/transaction/selling/listProduct.php',
    data: 'c_selling_product_name=' + c_selling_product_name,
    success: function (data) {
      $('#fetchDataProduct').html(data); //menampilkan data ke dalam modal
    }
  });
});

// Search How To Use
$('#listHTU').on('show.bs.modal', function (e) {
  var c_selling_HTU = $('#c_selling_HTU').val();
  $("#fetchedDataHTU").html(loadingImage);
  $.ajax({
    type: 'GET',
    url: 'pages/transaction/selling/listHTU.php',
    data: 'c_selling_HTU=' + c_selling_HTU,
    success: function (data) {
      $('#fetchedDataHTU').html(data); //menampilkan data ke dalam modal
    }
  });
});

// Cancel Transaction confirm
$('#cancelSellingCheckoutConfirm').on('show.bs.modal', function (e) {
  $("#loadCancelCheckoutConfirm").html(loadingImage);
  $.ajax({
    type: 'GET',
    url: 'pages/transaction/selling/cartCancelConfirm.php',
    success: function (data) {
      $('#loadCancelCheckoutConfirm').html(data); //menampilkan data ke dalam modal
    }
  });
});

// tooltips();

// // CheckOUt
// $('#submitSellingCheckoutConfirm').on('show.bs.modal', function (e) {
//     var total_harga_    = $('#total_harga_').val();
//     var total_item_     = $('#total_item_').val();
//     var supplier_code   = $('#supplier_code').val();
//     var supplier_name   = $('#supplier_name').val();
//     var dokter_code     = $('#dokter_code').val();
//     var dokter_name     = $('#dokter_name').val();
//     var transactionDate = $('#transaction_date').val();
//     var transactionTime = $('#transaction_time').val();
//     var cart_note       = $('#cart_note').val();

//     // $("#loadCheckoutConfirm").html(loadingImage);
//     $.ajax({
//         type : 'GET',
//         url  : 'pages/transaction/selling/checkout.php',
//         data : 'total_harga_='+ total_harga_+'&total_item_='+total_item_+'&supplier_code='+supplier_code+'&supplier_name='+supplier_name+'&dokter_code='+dokter_code+'&dokter_name='+dokter_name+'&transactionDate='+transactionDate+'&transactionTime='+transactionTime+'&cart_note='+cart_note,
//         success : function(data){
//             console.log(data);
//             $('#loadCheckoutConfirm').html(data);//menampilkan data ke dalam modal
//         }
//     });
// });