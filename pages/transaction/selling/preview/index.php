<div class="row">
    <div class="col-lg-12">
        <!-- <h1 class="page-header">Transaksi</h1> -->
        <div class="clearfix"><br></div>
    </div>
</div>
<div class="row">
    <a href="<?php echo $base_url."penjualan"; ?>" title="Pembelian" class='btn btn-success'><span class="fa fa-shopping-cart"></span> Penjualan</a>
    <div class="clearfix"><br></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
        	<b>REVIEW PENJUALAN</b>
        </div>
    	<div class="panel-body">
    		<div class="panel-body">
    			<!-- Filter Date -->
    			<form class="form-inline text-right" action="#">
    				<div class="form-group">
    					Filter Tanggal: 
    				</div>
    				<div class="form-group">
    					<input type="text" class="form-control datepicker" id="tgl_awal" name="tgl_awal" placeholder="Tgl Awal">
    				</div>
                    <div class="form-group">
                        <input type="text" class="form-control datepicker" id="tgl_akhir" name="tgl_akhir" placeholder="Tgl Akhir">
                    </div>
                    <div class="form-group">
                       <select name="status" id="status" class="form-control">
                           <option value="A">Aktif</option>
                           <option value="D">Tidak Aktif</option>
                       </select>
                    </div>
    				<button class="btn btn-default" id="buttonPreviewSelling">
                        <i class="fa fa-search"></i>
                    </button>
    			</form>
    			<div class="clearfix"><br></div>
    			<legend></legend>
    		</div>
    		<div id="contentReview">
    			<!-- content Review Transaction -->
    		</div>
    	</div>
    </div>
</div>

<div class="modal fade" id="detailTransaction">
    <div class="modal-dialog modal-lg" id="fetchDetailTransaction">
    </div>
</div>

<!-- Confirm Cancel Transaction -->
<div class="modal fade" id="deleteTransactionConfirm">
    <div class="modal-dialog" id="fetchDeleteTransaction">
    </div>
</div>


<script type="text/javascript">

    //Konrifmasi Hapus Transaksi
    $('#deleteTransactionConfirm').on('show.bs.modal', function (e) {
        var invoice_number = $(e.relatedTarget).data('id');
        $("#fetchDeleteTransaction").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
        $.ajax({
            type: 'get',
            url: '<?php echo $base_url."pages/transaction/selling/preview/cancelConfirm.php" ?>',
            data: 'invoice_number='+invoice_number,
            success : function(data){
                $('#fetchDeleteTransaction').html(data);//menampilkan data ke dalam modal
            }
        });
    });

    //Detail Transaksi
    $('#detailTransaction').on('show.bs.modal', function (e) {
        var invoice_number = $(e.relatedTarget).data('id');
        $("#fetchDetailTransaction").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><br><i> Sedang Proses ...</i></center>");
        $.ajax({
            type: 'get',
            url: '<?php echo $base_url."pages/transaction/selling/preview/detail.php" ?>',
            data: 'invoice_number='+invoice_number,
            success : function(data){
                $('#fetchDetailTransaction').html(data);//menampilkan data ke dalam modal
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

    function closeFormReviewSelling(){
        $('#deleteTransactionConfirm').modal('hide');
    }

	function disabledForm(){
		document.getElementById('tgl_awal').disabled = true;
		document.getElementById('tgl_akhir').disabled = true;
		document.getElementById('buttonPreviewSelling').disabled = true;
	}
	function enabledForm(){
		document.getElementById('tgl_awal').disabled = false;
		document.getElementById('tgl_akhir').disabled = false;
		document.getElementById('buttonPreviewSelling').disabled = false;
	}

    function enabledDelete(){
        document.getElementById('buttonHapus').disabled = false;
        document.getElementById('buttonCancel').disabled = false;
        document.getElementById('buttonClose').disabled = false;
    }

    function disabledDelete(){
        document.getElementById('buttonHapus').disabled = true;
        document.getElementById('buttonCancel').disabled = true;
        document.getElementById('buttonClose').disabled = true;
    }
    
    function loading(){
        disabledForm();
        $("#contentReview").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><font size='2'>Sedang Proses...</font></center>");
    }
	function LoadReviewTransactionSelling(){
        var tgl_awal    = $('#tgl_awal').val();
        var tgl_akhir   = $('#tgl_akhir').val();
        var status      = $('#status').val();

        loading();
        $.ajax({
            url:"pages/transaction/selling/preview/read.php?tgl_awal="+tgl_awal+"&tgl_akhir="+tgl_akhir+"&status="+status,
            success:function(data){
            $("#contentReview").html(data);
            }
        }); 
    }

	LoadReviewTransactionSelling();

    $('#buttonPreviewSelling').on('click', function(e) {
        if ($('#tgl_awal').val() == '' && $('#tgl_akhir').val() == '') {
            $.notify('Harus Pilih Tanggal!', 'error');
            $('#tgl_awal').focus();
        }else if ($('#tgl_awal').val() != '' && $('#tgl_akhir').val() == '') {
            $.notify('Pilih Tanggal Akhir!', 'error');
            $('#tgl_akhir').focus();
        }else if ($('#tgl_akhir').val() != '' && $('#tgl_awal').val() == '') {
            $.notify('Pilih Tanggal Awal!', 'error');
            $('#tgl_awal').focus();
        }else {
            LoadReviewTransactionSelling();
        }
    });

    $('#status').on('change', function(e) {
        LoadReviewTransactionSelling();
    })
</script>


<?php 
  // log Activity
  $insertLogData = log_insert('READ', 'Akses Menu Review Transaksi Penjualan', $ip_address, $os, $browser);
  $queryInsertLogData = mysqli_query($config, $insertLogData);
  if (!$queryInsertLogData) {
    echo "<span class='alert alert-danger'>Error Query Insert Log</span>";
  }
?>