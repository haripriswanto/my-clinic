<div class="row">
    <div class="col-lg-12">
        <!-- <h1 class="page-header">Transaksi</h1> -->
        <div class="clearfix"><br></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <!-- <button id="insert" class="btn btn-primary" title="Tambah Data">
            <span class="fa fa-plus-circle"></span> Tambah
        </button> -->
        <a href="#" data-toggle="modal" data-target="#insertPatient" class="btn btn-primary" title="Tambah Data Pasien">
            <span class="fa fa-plus-circle"></span> Tambah
        </a>
        <button id="btnRefresh" class="btn btn-default" title="Perbarui Data">
            <span class="fa fa-refresh"></span> Refresh
        </button>
        <div class="clearfix"><br></div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <b>DAFTAR PASIEN</b>
            </div>
            <div class="panel-body">
                <div class="clearfix"><br></div>
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div id="listPatient"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade fade-modal" id="insertPatient">
    <div class="modal-dialog modal-lg">
        <div id="fetchModalContent">
        </div>
    </div>
</div>

<style type="text/css">
    .modal-dialog {
        width: 98%;
        height: 80%;
        padding: 0;
        margin: 1em 1em 1em 1em;
    }

    .modal-content {
        height: 100%;
        border-radius: 0;
        color: #333;
        overflow: auto;
    }

    .modal-title {
        font-size: 3em;
        font-weight: 300;
        margin: 0 0 10px 0;
    }
</style>

<script>
    //Reg Patient
    $('#insertPatient').on('show.bs.modal', function(e) {
        $("#fetchModalContent").html("<center><img src='assets/images/load.gif ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
        $.ajax({
            type: 'get',
            url: 'pages/reg/reg-patient/insertPatient.php',
            success: function(data) {
                $('#fetchModalContent').html(data); //menampilkan data ke dalam modal
            }
        });
    });

    function loading() {
        $("#listPatient").html("<center><img src='assets/images/load.gif' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
        $("#listPatient").hide();
        $("#listPatient").fadeIn("slow");
    };

    function loadListPatient() {
        loading();
        $("#listPatient").load('pages/reg/reg-patient/listPatient.php')
    };

    loadListPatient();

    $('#btnRefresh').click(function() {
        loadListPatient();
    })
</script>

<!-- <script src="<?php echo $base_url . "pages/transaction/buying/controller/controller.js" ?>" type="text/javascript"></script> -->



<?php
// log Activity
$insertLogData = log_insert('READ', 'Akses Menu Transaksi Pembelian', $ip_address, $os, $browser);
$queryInsertLogData = mysqli_query($config, $insertLogData);
if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
}
?>