

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Laporan Penjualan</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Filter Laporan</h3>
    </div>
    <div class="panel-body">
        <a class="btn btn-primary" data-toggle="modal" href='#filterReport'>Atur Filter</a>
    </div>
</div>


<!-- FILTER REPORT -->
<div class="modal fade" id="filterReport">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <b>Laporan Transaksi Penjualan</b>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="fetchFilterReport"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
      //INSERT DATA PRODUK
        $('#filterReport').on('show.bs.modal', function (e) {
            $.ajax({
                type : 'post',
                url : '<?php echo $base_url."pages/report/selling/filterReport.php" ?>',
                success : function(data){
                $('#fetchFilterReport').html(data);//menampilkan data ke dalam modal
                }
            });
         });

        $('#filterReport').modal('show');
    });
</script>
