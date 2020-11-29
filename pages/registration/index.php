<div class="row">
  <div class="col-md-12">
    <h1 class="page-header">PENDAFTARAN</h1>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <button data-toggle="modal" data-target='#formRegistration' id="buttonAddPatient" title="Tambah Data" class="btn btn-primary" data-backdrop="static" data-keyboard="false">
      <span class="fa fa-plus-circle"></span> Tambah
    </button>
    <button id="buttonRefresh" class="btn btn-success" title="Refresh">
      <span class="fa fa-refresh"></span> Aktif
    </button>
    <button id="showDataArchive" class="btn btn-default" title="Data Arsip">
      <span class="fa fa-archive"></span> Arsip
    </button>
    <!-- <button id="synchronButton" class="btn btn-warning" title="Sinkronkan Data Produk">
      <span id="syncProgress"> <i class="fa fa-toggle-on"></i> Sinkron</span>
    </button> -->
  </div>
</div>
<div class="clearfix"><br></div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><b id="headerProduct">Daftar Pasien Aktif</b> 
        </h3>
      </div>
      <div class="panel-body" id="resultHandler"></div>
    </div>    
  </div>
</div>

<!-- INSERT -->
<div class="modal fade" id="formRegistration">
    <div class="modal-dialog modal-lg-insert">
        <div class="panel panel-primary" id="fetchFormRegistrationPatient"></div>
    </div>
</div>

<!-- EDIT -->
<div class="modal fade" id="editFormProduct">
    <div class="modal-dialog">
        <div class="panel panel-primary" id="fetchDataEdit"></div>
    </div>
</div>

<!-- DETAIL -->
<div class="modal fade" id="detail">
    <div class="modal-dialog modal-lg">
        <div class="panel panel-primary" id="fetchDataDetail"></div>
    </div>
</div> 

<!-- DELETE -->
<div class="modal fade" id="deleteConfirm">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <b>Konfirmasi!</b>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchDataDelete"></div>
        </div>
    </div>
</div> 

<!-- Arsip -->
<div class="modal fade" id="archiveConfirm">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <b>Konfirmasi!</b>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchDataArchive"></div>
        </div>
    </div>
</div> 

<!-- Arsip -->
<div class="modal fade" id="restoreConfirm">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <b>Konfirmasi!</b>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchRestoreProgress"></div>
        </div>
    </div>
</div> 

<script src="<?php echo $base_url."pages/registration/js/controller.regist.js"; ?>" type="text/javascript"></script>

<style>
  .modal-lg-insert{
    width:80%;
  }
</style>
<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu Registrasi Pasien', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>