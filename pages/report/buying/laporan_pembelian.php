

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Laporan Pembelian</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>Laporan Transaksi Pembelian</b>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body fetchFilterReport"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
      //INSERT DATA PRODUK
        $('#filterReport').on('show.bs.modal', function (e) {
            var row_id = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : '<?php echo $base_url ?>pages/report/buying_transaction/buying_modal.php',
                data :  'row_id='+ row_id,
                success : function(data){
                $('.fetchFilterReport').html(data);//menampilkan data ke dalam modal
                }
            });
         });

        $('#filterReport').modal('show');
    });
</script>
