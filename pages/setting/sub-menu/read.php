<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataTables">
    <thead>
      <tr>
        <th>#</th>
        <th>Menu</th>
        <th>Sub Menu</th>
        <th>Url</th>
        <th>Icon</th>
        <th>Urutan</th>
        <th>Active</th>
        <th>Action</th>
      </tr>
    </thead>
    <?php
    include('../../../config/config.php');
    $querySelect =  mysqli_query($config, " 
          SELECT tb_system_sub_menu.*, tb_system_menu.menu_description 
          FROM tb_system_sub_menu 
          JOIN tb_system_menu
          ON tb_system_menu.id = tb_system_sub_menu.menu_id
          WHERE tb_system_sub_menu.is_active = 'A'
          ORDER BY sub_menu_sort ASC");
    $number = 0;
    while ($rowSelect = mysqli_fetch_array($querySelect)) {
      $number                 = $number + 1;
      $id                     = $rowSelect['id'];
      $menu_description       = $rowSelect['menu_description'];
      $sub_menu_code          = $rowSelect['sub_menu_code'];
      $sub_menu_description   = $rowSelect['sub_menu_description'];
      $sub_menu_url           = $rowSelect['sub_menu_url'];
      $sub_menu_icon          = $rowSelect['sub_menu_icon'];
      $sub_menu_sort          = $rowSelect['sub_menu_sort'];
      $module_directory       = $rowSelect['module_directory'];
      $ts_insert              = $rowSelect['ts_insert'];
      $ts_update              = $rowSelect['ts_update'];

      if ($rowSelect['is_active'] == 'A') {
        $is_active  = "<span class='fa fa-check-circle text-success'></span>";
      } else {
        $is_active  = "<span class='fa fa-times-circle text-danger'></span>";
      }

    ?>
      <tr>
        <td><?php echo $number ?></td>
        <th><u><?php echo $menu_description; ?></u></th>
        <td><?php echo $sub_menu_description; ?></td>
        <td><?php echo $sub_menu_url; ?></td>
        <td><span class="fa-fw fa fa-<?php echo $sub_menu_icon; ?>"></span></td>
        <td><?php echo $sub_menu_sort ?></td>
        <td><?php echo $is_active ?></td>
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
    $("#edit").show('clip', 500);
  };

  function deleteEffect() {
    $("#delete").show('clip', 500);
  };

  $("#buttonEdit").click(function(event) {
    editEffect();
  });
  $("#buttonDelete").click(function(event) {
    deleteEffect();
  });
</script>