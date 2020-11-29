<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataTables">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Menu</th>
        <th>Icon</th>
        <th>Urutan</th>
        <th>Tipe</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');
        $querySelectUser =  mysqli_query($config, " SELECT * FROM tb_system_menu 
          WHERE is_active = 'A' ORDER BY sort_menu ASC");
          $number = 0;
          while ($rowSelectUser = mysqli_fetch_array($querySelectUser)){
            $number                 = $number + 1 ;
            $id                     = $rowSelectUser['id'];
            $menu_code              = $rowSelectUser['menu_code'];
            $menu_description       = $rowSelectUser['menu_description'];
            $menu_url               = $rowSelectUser['menu_url'];
            $menu_icon              = $rowSelectUser['menu_icon'];
            $sort_menu              = $rowSelectUser['sort_menu'];
            $type_menu              = $rowSelectUser['type_menu'];
            $ts_insert              = $rowSelectUser['ts_insert'];
            $ts_update              = $rowSelectUser['ts_update'];

        ?>
            <tr>
              <td><?php echo $number ?></td>
              <td><?php echo $menu_code; ?></td>
              <td><?php echo $menu_description; ?></td>
              <td><span class="fa-fw fa fa-<?php echo $menu_icon; ?>"></span></td>
              <td><?php echo $sort_menu ?></td>
              <td><?php echo $type_menu ?></td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $id; ?>" data-target="#editFormMenu" id="buttonEdit" title="Ubah Data User" class="btn-xs btn btn-primary">
                    <span class="fa fa-pencil"></span>
                </a>
                <a data-toggle="modal" data-id="<?php echo $id; ?>" data-target="#deleteConfirmMenu" id="buttonDelete" title="Hapus Data User" class="btn-xs btn btn-danger">
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