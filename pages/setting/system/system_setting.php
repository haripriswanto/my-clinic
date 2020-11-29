<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">SYSTEM SETTING</h1>
    </div>
</div>

<?php 
  $query =  mysqli_query($config, " 
  SELECT * FROM tb_system_setting 
        WHERE id_transaction = '1'
          ORDER BY id_system ASC");

    $number = 0;
    while ($row = mysqli_fetch_array($query)){
      $number                 = $number + 1 ;
      $id_system              = $row['id_system'];
      $system_title           = $row['system_title'];
      $system_header          = $row['system_header'];
      $system_dashboard_text  = $row['system_dashboard_text'];
      $system_instansi_name   = $row['system_instansi_name'];
      $system_owner           = $row['system_owner'];
      $system_phone           = $row['system_phone'];
      $system_address         = $row['system_address'];
      $system_email           = $row['system_email'];
      $system_url             = $row['system_url'];
      $system_outlet_code     = $row['system_outlet_code'];
      $system_footer_struct   = $row['system_footer_struct'];
    }

  ?>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><b>DATA SETTING</b> 
        <?php if (!empty($id_system)) { ?>
        <a data-toggle="modal" data-id="<?php echo $id_system; ?>" href='#systemEdit' title="Ubah Data System Setting" class="btn btn-primary">
          <span class="fa fa-edit"></span>
        </a>
        <?php } if (empty($id_system)) { ?>
          <a data-toggle="modal" href='#systemInsert' title="Setting Sekarang" class="btn btn-primary">
            <span class="fa fa-plus-circle"></span>
          </a>
      <?php } ?>
      </h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover table-striped" id="dataTables">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Toko</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>URL</th>
              </tr>
            </thead>
                    <tr>
                      <td><?php echo $number ?></td>
                      <td><?php echo $system_instansi_name ; ?></td>
                      <td><?php echo $system_phone ; ?></td>
                      <td><?php echo $system_address ; ?></td>
                      <td><?php echo $system_email ; ?></td>
                      <td><?php echo $system_url ; ?></td>                      
                  <!--td>
                    <a data-toggle="modal" href="#hapus_system_setting" title="Hapus Data System Setting" class="btn btn-danger">
                      <span class="fa fa-times"></span>
                    </a>
                  </td-->
                </tr> 
          </table>
        </div>
    </div>


    <!-- Edit Page -->
    <div class="modal fade" id="systemEdit">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="fetched-data"></div>
            </div>
        </div>
    </div>

    <!-- Insert Page -->
    <div class="modal fade" id="systemInsert">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="fetchedDataInsert"></div>
            </div>
        </div>
    </div>

<script type="text/javascript">
  
    // Edit Ajax
    $('#systemEdit').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id'); 
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url : '<?php echo $base_url ?>/pages/system_edit.php',
            data :  'id='+ id,
            success : function(data){
            $('.fetched-data').html(data); //menampilkan data ke dalam modal
            }
        });
     });

    // Insert Ajax
    $('#systemInsert').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id'); 
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type : 'post',
            url : 'pages/system_insert.php',
            data :  'id='+ id,
            success : function(data){
            $('.fetchedDataInsert').html(data); //menampilkan data ke dalam modal
            }
        });
     });
</script>