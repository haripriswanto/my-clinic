$("#buttonRefresh").click(function (e) {
    loadData();
});

$("#showDataArchive").click(function (e) {
    loadDataArsip();
});

$('#synchronButton').on('click', function (e) {
    syncDataProduct();
});

var loading = "<center><img src='assets/images/load.gif' width='50' height='50'/><br><i> Sedang Proses ...</i></center>";

// Syncronize
function syncDataProduct() {
    disabledHeaderButton();
    $("#syncProgress").html(loading);
    $('#syncProgress').load('pages/registration/sync.php');
}


// Load Data Customer
function loadData() {
    disabledHeaderButton();
    $("#resultHandler").html(loading);
    $('#resultHandler').load('pages/registration/read.php');
}

// Load Data Customer
function loadDataArsip() {
    disabledHeaderButton();
    $("#resultHandler").html(loading);
    $('#resultHandler').load('pages/registration/archive/readArsip.php');
}

loadData();

function insertEffect() {
    $("#insert").show('clip', 800);
};

$("#buttonAddPatient").click(function (event) {
    insertEffect();
});

//INSERT DATA 
$('#formRegistration').on('show.bs.modal', function (e) {
    $("#fetchFormRegistrationPatient").html(loading);
    $.ajax({
        type: 'get',
        url: 'pages/registration/insert.php',
        success: function (data) {
            $('#fetchFormRegistrationPatient').html(data); //menampilkan data ke dalam modal
        }
    });
});

// EDIT DATA
$('#editFormProduct').on('show.bs.modal', function (e) {
    var idEdit = $(e.relatedTarget).data('id');
    $("#fetchDataEdit").html(loading);
    $.ajax({
        type: 'get',
        url: 'pages/registration/edit.php',
        data: 'idEdit=' + idEdit,
        success: function (data) {
            $('#fetchDataEdit').html(data); //menampilkan data ke dalam modal
        }
    });
});

// Restore DATA
$('#restoreConfirm').on('show.bs.modal', function (e) {
    var idRestore = $(e.relatedTarget).data('id');
    $("#fetchDataEdit").html(loading);
    $.ajax({
        type: 'get',
        url: 'pages/registration/archive/confirmRestore.php',
        data: 'idRestore=' + idRestore,
        success: function (data) {
            $('#fetchRestoreProgress').html(data); //menampilkan data ke dalam modal
        }
    });
});

// Restore DATA
$('#archiveConfirm').on('show.bs.modal', function (e) {
    var idArchive = $(e.relatedTarget).data('id');
    $("#fetchDataEdit").html(loading);
    $.ajax({
        type: 'get',
        url: 'pages/registration/archive/confirmArchive.php',
        data: 'idArchive=' + idArchive,
        success: function (data) {
            $('#fetchDataArchive').html(data); //menampilkan data ke dalam modal
        }
    });
});

//DELETE
$(document).on('click', '.buttonDelete', function (e) {
    e.preventDefault();
    $("#deleteConfirm").modal('show');
    $.get('pages/registration/confirm.php', {
            id: $(this).attr('data-id'),
            name: $(this).attr('data-name'),
            code: $(this).attr('data-code')
        },
        function (html) {
            $("#fetchDataDelete").html(html);
        }
    );
});

//DETAIL
$('#detail').on('show.bs.modal', function (e) {
    var idDetail = $(e.relatedTarget).data('id');
    $("#fetchDataDetail").html(loading);
    $.ajax({
        type: 'get',
        url: 'pages/registration/detail.php',
        data: 'idDetail=' + idDetail,
        success: function (data) {
            $('#fetchDataDetail').html(data);
        }
    });
});

// INSERT HANDLER AJAX
function clearInsertForm() {
    $('#i_product_code').val('');
    $('#i_product_name').val('');
    $('#i_product_description').val('');
    $('#i_product_price').val('');
    $('#i_product_price_sell').val('');
    $('#i_product_price_buy').val('');
    $('#i_product_price_min').val('');
    $('#i_product_price_max').val('');
    $('#i_product_price_margin').val('');
    $('#i_product_first_stock').val('');
    $('#i_product_category').val('');
    $('#i_product_unit').val('');
    $('#i_product_name').focus();
}

function closeForm() {
    $('#formRegistration').modal('hide');
    $('#editFormProduct').modal('hide');
    $('#deleteConfirm').modal('hide');
    $('#restoreConfirm').modal('hide');
    $('#archiveConfirm').modal('hide');
}

function enabledInsertForm() {
    document.getElementById('buttonInsertAgain').disabled = false;
    document.getElementById('buttonInsert').disabled = false;
    document.getElementById('buttonClose').disabled = false;
    document.getElementById('buttonCancel').disabled = false;
}

function disabledInsertForm() {
    document.getElementById('buttonInsertAgain').disabled = true;
    document.getElementById('buttonInsert').disabled = true;
    document.getElementById('buttonClose').disabled = true;
    document.getElementById('buttonCancel').disabled = true;
}

function enabledUpdateForm() {
    document.getElementById('buttonUpdate').disabled = false;
    document.getElementById('buttonCloseUpdate').disabled = false;
    document.getElementById('buttonCancelUpdate').disabled = false;
}

function disabledUpdateForm() {
    document.getElementById('buttonUpdate').disabled = true;
    document.getElementById('buttonCloseUpdate').disabled = true;
    document.getElementById('buttonCancelUpdate').disabled = true;
}

function enabledHeaderButton() {
    document.getElementById('buttonAddPatient').disabled = false;
    document.getElementById('buttonRefresh').disabled = false;
    document.getElementById('showDataArchive').disabled = false;
    // document.getElementById('synchronButton').disabled = false;
}

function disabledHeaderButton() {
    document.getElementById('buttonAddPatient').disabled = true;
    document.getElementById('buttonRefresh').disabled = true;
    document.getElementById('showDataArchive').disabled = true;
    // document.getElementById('synchronButton').disabled = true;
}