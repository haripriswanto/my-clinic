<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">LAPORAN</h1>
    </div>
</div>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><b>Log Aktifitas</b>
      </h3>
    </div>
    <div class="panel-body">
        <div class="panel-body">
          <form class="form-inline text-right" target="blank" method="GET" action="<?php echo $base_url."pages/report/log-activity/read.php"; ?>">
            <div class="form-group">
              Filter Tanggal: 
            </div>
            <div class="form-group">
              <input type="text" class="form-control tooltips datepicker" id="tglAwal" name="tglAwal" title="Pilih tanggal awal (jika kosong = hari ini)" placeholder="Tgl Awal">
            </div>
            <div class="form-group">
                <input type="text" class="form-control tooltips datepicker" id="tglAkhir" name="tglAkhir" title="Pilih tanggal akhir (jika kosong = hari ini)" placeholder="Tgl Akhir">
            </div>
          <?php if ($sessionAccess == 1) { ?>
            <div class="form-group">
              <select name="casier_name" id="casier_name" class="form-control tooltips" title="Pilih Nama Admin">
                <option value="">Semua Admin</option>
                <?php 
                  $queryUser = mysqli_query($config, "SELECT * FROM tb_system_user 
                                                WHERE is_active = 'A'  
                                                ORDER BY user_full_name ASC");

                    while ($rowUser = mysqli_fetch_array($queryUser)) {
                      ?>
                  <option value="<?php echo $rowUser['user_name'] ?>"><?php echo $rowUser['user_full_name'] ?></option>
                <?php } ?>
              </select>
            </div>
          <?php } ?>
            <span class="btn btn-primary tooltips" id="buttonSearch" title="Klik Untuk Pencarian"><i class="fa fa-search"></i></span>
            <button type="submit" class="btn btn-success tooltips" name="buttonExcel" title="Klik Untuk Download Excel"><i class="fa fa-file-excel-o"></i></button>
          </form>
          <div class="clearfix"><br></div>
          <legend></legend>
        </div>
      <div id="result_stock_report"></div>
    </div>

<script type="text/javascript">

    // datepicker
    $( function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange:"-10:+10"
          });
        }
    );

    function loadDateReview(){
      var tglAwal  = $('#tglAwal').val();
      var tglAkhir = $('#tglAkhir').val();
      var casier_name = $('#casier_name').val();
      $("#result_stock_report").html("<center><img src='<?php echo $base_url ?>assets/images/load.gif' width='50' height='50'/><font size='3'>Sedang Proses ...</font></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url ?>pages/report/log-activity/read.php",
          data:'tglAwal='+tglAwal+'&tglAkhir='+tglAkhir+'&casier_name='+casier_name,
          success:function(data){
            $("#result_stock_report").html(data);
          }
      });
    }

    var today = new Date();
    var currentDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

  //TAMPIL DATA

  $(document).ready(function() { 
      loadDateReview();
  });

  $('#buttonSearch').click(function(event) {
    if ($('#tglAwal').val() == '' && $('#tglAkhir').val() != '') {
      toastr['error']('Tanggal Awal Tidak Boleh Kosong!');
      $('#tglAwal').focus();
    }else if ($('#tglAwal').val() != '' && $('#tglAkhir').val() == '') {
      toastr['error']('Tanggal Akhir Tidak Boleh Kosong!');
      $('#tglAkhir').focus();
    }else if ($('#tglAwal').val() > $('#tglAkhir').val()) {
      toastr['error']('Tanggal Awal Tidak Boleh Melebihi Tanggal Akhir!');
      $('#tglAwal').focus();
    }else{
      loadDateReview();
    }
  });

  $('#casier_name').change(function(event) {
    if ($('#tglAwal').val() == '' && $('#tglAkhir').val() != '') {
      toastr['error']('Tanggal Awal Tidak Boleh Kosong!');
      $('#tglAwal').focus();
    }else if ($('#tglAwal').val() != '' && $('#tglAkhir').val() == '') {
      toastr['error']('Tanggal Akhir Tidak Boleh Kosong!');
      $('#tglAkhir').focus();
    }else if ($('#tglAwal').val() > $('#tglAkhir').val()) {
      toastr['error']('Tanggal Awal Tidak Boleh Melebihi Tanggal Akhir!');
      $('#tglAwal').focus();
    }else{
      loadDateReview();
    }
  });
</script>
