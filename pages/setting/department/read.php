<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataTables">
    <thead>
      <tr>
        <th>#</th>
        <th>Kode</th>
        <th>Department</th>
        <th>Sort</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');
        $selectQuery = " SELECT * FROM tb_system_department 
            WHERE is_active = 'A' 
            ORDER BY sort_field ASC
        ";
          $query =  mysqli_query($config, $selectQuery);
          $number = 0;
          while ($objSystemDepartment = mysqli_fetch_array($query)){
            $number                 = $number + 1 ;
            $id                     = $objSystemDepartment['id'];
            $department_code        = $objSystemDepartment['department_code'];
            $department_description = $objSystemDepartment['department_description'];
            $sort_field             = $objSystemDepartment['sort_field'];
            $ts_insert              = $objSystemDepartment['ts_insert'];
            $ts_update              = $objSystemDepartment['ts_update'];

        ?>
            <tr>
              <td><?php echo $number ?></td>
              <td><?php echo $department_code; ?></td>
              <td><?php echo $department_description; ?></td>
              <td><?php echo $sort_field ; ?></td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $id; ?>" data-target="#editFormDepartment" id="buttonEdit" title="Ubah Data User" class="btn-xs btn btn-primary">
                    <span class="fa fa-pencil"></span>
                </a>
                <a data-toggle="modal" data-id="<?php echo $id; ?>" data-target="#deleteConfirmDepartment" id="buttonDelete" title="Hapus Data User" class="btn-xs btn btn-danger">
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