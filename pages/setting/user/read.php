<div class="table-responsive">
  <table class="table table-hover table-striped" id="dataUser">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>Telp</th>
        <th>Gender</th>
        <th>Username</th>
        <th>Password</th>
        <th>Hak Akses</th>
        <th>Action</th>
      </tr>
    </thead>
      <?php 
        include('../../../config/config.php');
        $querySelectUser =  mysqli_query($config, " 
          SELECT tb_system_user.*, tb_system_user_role.role_description as AccessLevel 
          FROM tb_system_user
          INNER JOIN tb_system_user_role
          ON tb_system_user.access_level = tb_system_user_role.id 
          WHERE tb_system_user.is_active = 'A'
          ORDER BY tb_system_user.ts_update ASC");

          $number = 0;
          while ($rowSelectUser = mysqli_fetch_array($querySelectUser)){
            $number                 = $number + 1 ;
            $id_user                = $rowSelectUser['id_user'];
            $user_name              = $rowSelectUser['user_name'];
            $user_password          = $rowSelectUser['user_password'];
            $user_full_name         = $rowSelectUser['user_full_name'];
            $user_address           = $rowSelectUser['user_address'];
            $user_email             = $rowSelectUser['user_email'];
            $user_phone             = $rowSelectUser['user_phone'];
            $user_gender            = $rowSelectUser['user_gender'];
            $user_birthday          = $rowSelectUser['user_birthday'];
            $AccessLevel           = $rowSelectUser['AccessLevel'];
            $ts_insert              = $rowSelectUser['ts_insert'];
            $ts_update              = $rowSelectUser['ts_update'];

        ?>
            <tr>
              <td><?php echo $number ?></td>
              <td><?php echo $user_full_name; ?></td>
              <td><?php echo substr($user_address, 0, 10) . '...'; ?></td>
              <td><?php echo substr($user_email, 0, 10) . '...'; ?></td>
              <td><?php echo $user_phone ; ?></td>
              <td><?php 
                if ($user_gender=='1') {echo 'Pria';} 
                elseif ($user_gender=='2') {echo 'Wanita';} ?>
              </td>
              <td><?php echo $user_name ?></td>
              <td><?php echo $user_password ?></td>
              <td><?php echo $AccessLevel; ?>
              </td>
              <td>
                <a data-toggle="modal" data-id="<?php echo $id_user; ?>" data-target="#editFormUser" id="buttonEdit" title="Ubah Data User" class="btn-xs btn btn-primary">
                    <span class="fa fa-pencil"></span>
                </a>
              <?php 
                if (empty($user_name == $_SESSION['login']['user_name'])) {
              ?>
                <a data-toggle="modal" data-id="<?php echo $id_user; ?>" data-target="#deleteConfirmUser" id="buttonDelete" title="Hapus Data User" class="btn-xs btn btn-danger">
                  <span class="fa fa-times"></span>
                </a>
              <?php } ?>
                  
              </td>
        </tr>   
        <?php } ?>
  </table>
</div>

<script type="text/javascript">
  // Datatable
  $(document).ready(function() {
      $('#dataUser').DataTable({
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