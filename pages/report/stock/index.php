<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">LAPORAN</h1>
    </div>
</div>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><b>Riwayat Stok</b>
      </h3>
    </div>
    <div class="panel-body">
        <div class="panel-body">
          <form class="form-inline text-right" method="GET" action="<?php echo $base_url."pages/report/stock/read.php"; ?>">
            <div class="form-group">
              Filter Tanggal: 
            </div>
            <div class="form-group">
              <input type="text" class="form-control tooltips datepicker" id="tglAwal" name="tglAwal" title="Pilih tanggal awal (jika kosong = hari ini)" placeholder="Tgl Awal">
            </div>
            <div class="form-group">
                <input type="text" class="form-control tooltips datepicker" id="tglAkhir" name="tglAkhir" title="Pilih tanggal akhir (jika kosong = hari ini)" placeholder="Tgl Akhir">
            </div>
            <div class="form-group">
              <select name="transactionType" id="transactionType" class="form-control tooltips"  title="Pilih jenis transaksi">
                <option value="">Semua</option>
                <option value="13">Pembelian</option>
                <option value="14">Retur Pembelian</option>
                <option value="12">Penjualan</option>
                <option value="11">Retur Penjualan</option>
                <option value="10">Stok Opname</option>
              </select>
            </div>
            <span class="btn btn-primary tooltips" id="buttonSearch" title="Klik untuk pencarian"><i class="fa fa-search"></i></span>
            <button type="submit" class="btn btn-success tooltips" name="buttonExcel" title="Klik untuk download Excel"><i class="fa fa-file-excel-o"></i></button>
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
      var transactionType = $('#transactionType').val();
      $("#result_stock_report").html("<center><img src='<?php echo $base_url ?>assets/images/load.gif' width='50' height='50'/><font size='3'>Sedang Proses ...</font></center>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url ?>pages/report/stock/read.php",
          data:'tglAwal='+tglAwal+'&tglAkhir='+tglAkhir+'&transactionType='+transactionType,
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
      $.notify('Tanggal Awal Tidak Boleh Kosong!', 'error');
      $('#tglAwal').focus();
    }else if ($('#tglAwal').val() != '' && $('#tglAkhir').val() == '') {
      $.notify('Tanggal Akhir Tidak Boleh Kosong!', 'error');
      $('#tglAkhir').focus();
    }else if ($('#tglAwal').val() > $('#tglAkhir').val()) {
      $.notify('Tanggal Awal Tidak Boleh Melebihi Tanggal Akhir!', 'error');
      $('#tglAwal').focus();
    }else{
      loadDateReview();
    }
  });

  $('#transactionType').change(function(event) {
    if ($('#tglAwal').val() == '' && $('#tglAkhir').val() != '') {
      $.notify('Tanggal Awal Tidak Boleh Kosong!', 'error');
      $('#tglAwal').focus();
    }else if ($('#tglAwal').val() != '' && $('#tglAkhir').val() == '') {
      $.notify('Tanggal Akhir Tidak Boleh Kosong!', 'error');
      $('#tglAkhir').focus();
    }else if ($('#tglAwal').val() > $('#tglAkhir').val()) {
      $.notify('Tanggal Awal Tidak Boleh Melebihi Tanggal Akhir!', 'error');
      $('#tglAwal').focus();
    }else{
      loadDateReview();
    }
  });
</script>
