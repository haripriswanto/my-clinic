var loadImage = "<center><img src='assets/images/load.gif' width='20' height='20'/><font size='1'>Updating ...</font></center>";

function showOmset() {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    $("#showOmset").html(loadImage);
    $("#showOmset").load('pages/dashboard/totalOmset.php?monthOption=' + monthOption + '&yearOption=' + yearOption);
}

// Selling Total
function showTotalSelling() {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    $("#showTotalSellingTransaction").html(loadImage);
    $("#showTotalSellingTransaction").load('pages/dashboard/totalSellingTransaction.php?monthOption=' + monthOption + '&yearOption=' + yearOption);
}

// Total Product Selling
function showTotalProductSelling() {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    $("#showTotalProductSelling").html(loadImage);
    $("#showTotalProductSelling").load('pages/dashboard/totalProductSelling.php?monthOption=' + monthOption + '&yearOption=' + yearOption);
}

// Total Customer
function showTotalCustomer() {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    $("#showTotalCustomer").html(loadImage);
    $("#showTotalCustomer").load('pages/dashboard/totalCustomer.php?monthOption=' + monthOption + '&yearOption=' + yearOption);
}

// Expire Date
function showProductExpired() {
    $("#showProductExpired").html(loadImage);
    var txtExpired = $('#txtExpired').val();
    $("#showProductExpired").load('pages/dashboard/productExpired.php?txtExpired=' + txtExpired);
    $('#txtExpired').val('');
}

// Product Stock
function showProductStock() {
    $("#showProductStock").html(loadImage);
    var txtStock = $('#txtStock').val();
    $("#showProductStock").load('pages/dashboard/productStock.php?txtStock=' + txtStock);
    $('#txtStock').val('');
}

// Cart Selling
function executeDeleteCartSelling() {
    $("#showExecuteDeleteCartSelling").html(loadImage);
    // var txtStock = $('#txtStock').val();
    $("#showExecuteDeleteCartSelling").load('pages/autoQuery/deleteCartSelling.php');
}


// Chart Selling Product
function showChartSellingPerProduct() {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    $("#chartTransactionSellingProduct").html(loadImage);
    $("#chartTransactionSellingProduct").load('pages/dashboard/chart/line_chartSellingProduct.php?monthOption=' + monthOption + '&yearOption=' + yearOption);
}

// Chart Selling Transaction
function showChartSelling() {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    $("#chartTransactionSelling").html(loadImage);
    $("#chartTransactionSelling").load('pages/dashboard/chart/line_chartSelling.php?monthOption=' + monthOption + '&yearOption=' + yearOption);
}

// Chart Income Selling
function showChartIncome() {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    $("#chartSellingIncome").html(loadImage);
    $("#chartSellingIncome").load('pages/dashboard/chart/bar_chartSellingIncome.php?monthOption=' + monthOption + '&yearOption=' + yearOption);
}

// Chart Best Selling
function showChartBestIncome() {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    $("#chartBestSelling").html(loadImage);
    $("#chartBestSelling").load('pages/dashboard/chart/bar_chartBestSelling.php?monthOption=' + monthOption + '&yearOption=' + yearOption);
}

$('#btnFilter').on('click', function (e) {

    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    if (monthOption != '' && yearOption == '') {
        toastr['error']('Pilih Tahun Terlebih Dahulu!', 'Notify!');
        $('#yearOption').focus();
    } else if (monthOption == '' && yearOption != '') {
        toastr['error']('Pilih Bulan Terlebih Dahulu!');
        $('#monthOption').focus();
    } else {
        showChartIncome();
        showChartSelling();
        showChartBestIncome();
        showOmset();
        showTotalProductSelling();
        showTotalCustomer();
        showTotalSelling();
        showChartSellingPerProduct()
    }
});

$('#monthOption').on('change', function (e) {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    if (yearOption == '') {
        $('#yearOption').focus();
    } else {
        showChartIncome();
        showChartSelling();
        showChartBestIncome();
        showOmset();
        showTotalProductSelling();
        showTotalCustomer();
        showTotalSelling();
        showChartSellingPerProduct()
    }
});

$('#yearOption').on('change', function (e) {
    var monthOption = $('#monthOption').val();
    var yearOption = $('#yearOption').val();
    if (monthOption == '') {
        toastr['error']('Pilih bulan Terlebih Dahulu!', 'Notify!');
        $('#monthOption').focus();
    } else {
        showChartIncome();
        showChartSelling();
        showChartBestIncome();
        showOmset();
        showTotalProductSelling();
        showTotalCustomer();
        showTotalSelling();
        showChartSellingPerProduct()
    }
});

$('#buttonShowOmset').on('click', function (e) {
    showOmset();
});

$('#buttonShowTotalSelling').on('click', function (e) {
    showTotalSelling();
});

$('#buttonShowTotalCustomer').on('click', function (e) {
    showTotalCustomer();
});

$('#buttonShowTotalProductSelling').on('click', function (e) {
    showTotalProductSelling();
});

$('#buttonShowProductExpired').on('click', function (e) {
    showProductExpired();
});

$('#buttonShowProductStock').on('click', function (e) {
    showProductStock();
});

$('#buttonTxtStock').on('click', function (e) {
    showProductStock();
});

$('#buttonTxtExpired').on('click', function (e) {
    showProductExpired();
});

$('#txtStock').on('keyup', function (e) {
    if (e.which === 13) {
        showProductStock();
    }
});

$('#txtExpired').on('keyup', function (e) {
    if (e.which === 13) {
        showProductExpired();
    }
});

$(document).ready(function () {
    showOmset();
    showTotalSelling();
    showTotalCustomer();
    showTotalProductSelling();
    showProductExpired();
    showProductStock();
    showChartIncome();
    showChartSelling();
    showChartBestIncome();
    showChartSellingPerProduct();
});

// refresh setiap 180000 milidetik = 3 Menit
setInterval(function () {
    showOmset();
    showTotalSelling();
    showTotalCustomer();
    showTotalProductSelling();
    showProductExpired();
    showProductStock();
    showChartIncome();
    showChartSelling();
    showChartBestIncome();
    showChartSellingPerProduct();
}, 180000)