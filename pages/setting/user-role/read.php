<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataTables">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Role Menu</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');
        $querySelectUser =  mysqli_query($config, " 
          SELECT * FROM tb_system_user_role 
          WHERE is_active = 'A'
          ORDER BY ts_update DESC");

          $number = 0;
          while ($rowSelect = mysqli_fetch_array($querySelectUser)){
            $number            = $number + 1 ;
            $id                = $rowSelect['id'];
            $role_code         = $rowSelect['role_code'];
            $role_description  = $rowSelect['role_description'];
            $ts_insert         = $rowSelect['ts_insert'];
            $ts_update         = $rowSelect['ts_update'];

        ?>
            <tr>
              <td><?php echo $number ?></td>
              <td><?php echo $role_code; ?></td>
              <td><?php echo $role_description; ?></td>
              </td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $id; ?>" data-target="#modalDetail" id="buttonDetail" title="Detail Menu" class="btn-xs btn btn-warning">
                    <span class="fa fa-blind"></span> Access
                </a>
                <a data-toggle="modal" data-id="<?php echo $id; ?>" data-target="#editForm" id="buttonEdit" title="Ubah Data" class="btn-xs btn btn-primary">
                    <span class="fa fa-pencil"></span>
                </a>
                <a data-toggle="modal" data-id="<?php echo $id; ?>" data-target="#deleteConfirm" id="buttonDelete" title="Hapus Data" class="btn-xs btn btn-danger">
                  <span class="fa fa-times"></span>
                </a>
                  
              </td>
        </tr>   
        <?php } ?>
  </table>
</div>

<script type="text/javascript">
  // Datatable
  $(document).ready(function() {
      $('#dataTables').DataTable({
          responsive: true
      });
  });

  function editEffect() {
    $("#edit").show( 'clip', 500 );
  };
  function deleteEffect() {
    $("#delete").show( 'clip', 500 );
  };

  $("#buttonEdit").click(function(event) {
    editEffect();
  });
  $("#buttonDelete").click(function(event) {
    deleteEffect();
  });

</script>