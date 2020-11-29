
<?php 
  include('../../../config/config.php');

  if (!empty($_SESSION['login'])) {

  $idDetail = $_GET['idDetail'];

  $querySelect =  mysqli_query($config, " 
      SELECT * FROM tb_system_user_role 
      WHERE id = '$idDetail' 
      AND is_active = 'A' ");

    while ($rowSelect = mysqli_fetch_array($querySelect)){
      $id                = $rowSelect['id'];
      $role_code         = $rowSelect['role_code'];
      $role_description  = $rowSelect['role_description'];
      $ts_insert         = $rowSelect['ts_insert'];
      $ts_update         = $rowSelect['ts_update'];
  }
?> 
<div class="panel-heading">
    <b>Detail Role Akses <?= $role_description; ?></b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="panel-body">
    
    <!-- <button type="button" id="buttonSaveAccess" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button> -->
    &nbsp; <span id="progressResult"></span>
    <br><br>
  <div class="panel panel-primary" id="fetchModalDetail">
    <div class="panel-body">
      <table class="table table-striped table-hover" id="dataDetailMenu">
        <thead>
          <tr>
            <th width="15%">#</th>
            <th>Menu</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php  
            $querySelectMenu =  mysqli_query($config, " 
                SELECT * FROM tb_system_menu WHERE is_active = 'A' ORDER BY sort_menu ASC ");
              $number = 0;
              while ($rowSelectMenu = mysqli_fetch_array($querySelectMenu)){

                $number            = $number+1;                
                $menu_id           = $rowSelectMenu['id'];
                $menu_code         = $rowSelectMenu['menu_code'];
                $menu_description  = $rowSelectMenu['menu_description'];
                $ts_insert         = $rowSelectMenu['ts_insert'];
                $ts_update         = $rowSelectMenu['ts_update'];


                $querySub = " 
                SELECT tb_system_menu.*, tb_system_access_menu.role_id 
                FROM tb_system_menu 
                INNER JOIN tb_system_access_menu
                ON tb_system_menu.id = tb_system_access_menu.menu_id
                WHERE tb_system_menu.id = '$menu_id'
                AND tb_system_access_menu.role_id = '$idDetail'
                AND is_active = 'A' ";

                // var_dump($querySub);

                $querySelectSub =  mysqli_query($config, $querySub);
                $checkRow = '';
                while ($rowSelectSub = mysqli_fetch_array($querySelectSub)){
                  $checkRow = mysqli_num_rows($querySelectSub);
                }
          ?>
            <tr>
              <td><?= $number ?></td>
              <td><?= $menu_description ?></td>
              <td>
                <input type="checkbox" class="checkAccess" data-role="<?= $id; ?>" data-menu="<?= $menu_id; ?>" <?php if($checkRow){echo "CHECKED";} ?>> 
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
// Check all
$("#checkAll").change(function(){

   var checked = $(this).is(':checked');
   if(checked){
      $(".checkAccess").each(function(){
          $(this).prop("checked",true);
      });
   }else{
      $(".checkAccess").each(function(){
          $(this).prop("checked",false);
      });
   }
});

$(".checkAccess").click(function(){
   if($(".checkAccess").length == $(".checkAccess:checked").length) {
       $("#checkAll").prop("checked", true);
   } else {
       $("#checkAll").prop("checked",false);
   }

});

$('.checkAccess').on('click', function() {
  const menuId = $(this).data('menu');
  const roleId = $(this).data('role');

  $("#progressResult").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='20' height='20'/><i>Proses ...</i>");
  $.ajax({
    url: '<?= $base_url."pages/setting/user-role/update-role.php" ?>',
    type: 'POST',
    data: {
      menuId: menuId,
      roleId: roleId
    },
    success : function(response) {
      $('#progressResult').html(response);
      // closeForm();
    }
  })  
});

  // Datatable
  $(document).ready(function() {
      $('#dataDetailMenu').DataTable({
          responsive: true
      });
  });

  $( function() {
    $( ".datepicker" ).datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange:"-59:+0"
    });
  });
  
  // TOOLTIP
  
  $(document).ready(function() {
      $("#edit_nama").focus();
  });

  $('#edit_nama').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#edit_nama').val() == '') {
        toastr['error']("Nama Lengkap Harus Di Isi!");
        $('#edit_nama').focus();
      }else {$('#edit_birthday').focus();}
    }
  });
  $('#edit_birthday').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#edit_birthday').val() == '') {
        toastr['error']("Header Harus Di Isi!");
        $('#edit_birthday').focus();
      }else {$('#edit_gender').focus();}
    }
  });
  $('#edit_gender').change(function(e) {
    if ($('#edit_gender').val() == '') {
      toastr['error']("Title Dashboard Harus Di Isi!");
      $('#edit_gender').focus();
    }else {$('#edit_address').focus();}
  });
  $('#edit_address').keyup(function(e) {
    if(e.keyCode == 13) {
      $('#edit_email').focus();
    }
  });
  $('#edit_email').keyup(function(e) {
    if(e.keyCode == 13) {
      var atpos  = $('#edit_email').val().indexOf("@");
      var dotpos = $('#edit_email').val().lastIndexOf(".");
      if ($('#edit_email').val() != '') {
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#edit_email').val().length){
          toastr['error']("cth: info@domain.com");
        }else {$('#edit_phone').focus();}
      }else {$('#edit_phone').focus();}
    }
  });
  $('#edit_phone').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#edit_phone').val() == '') {
        toastr['error']("No. Telp nya Berapa ya?");
        $('#edit_phone').focus();
      }else if ($('#edit_phone').val().length > 13) {
        toastr['error']("No Hp Maksimal 13 Digit");
        $('#edit_phone').focus();
      }else {$('#edit_username').focus();}
    }
  });
  $('#edit_username').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#edit_username').val() == '') {
        toastr['error']("Username Harus Di isi.");
        $('#edit_username').focus();
      }else {$('#edit_akses').focus();}
    }
  });
  $('#edit_akses').change(function(e) {
    if ($('#edit_akses').val() == '') {
      toastr['error']("Hak Akses Harus Di pilih Gaes!");
      $('#edit_akses').focus();
    }else {$('#buttonUpdate').focus();}
  });

  $("#buttonUpdate").click(function(event) {
    insertData();
  });

    function saveAccess(){
      var menu_id        = $("#edit_id_user").val();
      var role_id        = $("#edit_nama").val();
  
    if (edit_nama == '') {
      toastr['error']("Nama Lengkap Harus Di Isi!");
      $("#edit_nama").focus();
    }
    else if (edit_birthday == '') {
      toastr['error']("Tgl Lahir Harus Di Isi!");
      $("#edit_birthday").focus();
    }
    else if (edit_gender == '') {
      toastr['error']("Gender Harus Di Isi!");
      $("#edit_gender").focus();
    }
    else if (edit_phone == '') {
      toastr['error']("No. Telp nya Berapa ya?");
      $("#edit_phone").focus();
    }
    else if (edit_username == '') {
      toastr['error']("Username nya ga boleh kosong ya.");
      $("#edit_username").focus();
    }
    else if (edit_akses == '') {
      toastr['error']("Email nya masih kosong nih!");
      $("#edit_akses").focus();
    }
    else if (edit_password == '') {
      toastr['error']("Password nya masih kosong nih!");
      $("#edit_password").focus();
    }
    else if (confirm_password == '') {
      toastr['error']("Konfirmasi Password ga boleh kosong!");
      $("#confirm_password").focus();
    }
    else if (confirm_password != edit_password) {
      toastr['error']("Konfirmasi Password Tidak Sama!");
      $("#confirm_password").focus();
    }else if ($('#edit_email').val() != '') {
      var atpos  = $('#edit_email').val().indexOf("@");
      var dotpos = $('#edit_email').val().lastIndexOf(".");
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=$('#edit_email').val().length){
        toastr['error']("cth: info@domain.com");
        $('#edit_email').focus();
      }
    }else if (edit_akses == '') {
      toastr['error']("Hak akses nya Pilih Dulu Ya!");
      $("#edit_akses").focus();
    }else{
      // AJAX Insert
      disableButtonEdit();
      $("#resultUpdate").html("<img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i>");
      $.ajax({
          type:"get",
          url:"<?php echo $base_url."pages/setting/user-role/update.php" ?>",
          data:"edit_id_user="+edit_id_user+"&edit_nama="+edit_nama+"&edit_birthday="+edit_birthday+"&edit_gender="+edit_gender+"&edit_address="+edit_address+"&edit_email="+edit_email+"&edit_phone="+edit_phone+"&edit_username="+edit_username+"&edit_akses="+edit_akses+"&edit_password="+edit_password+"&confirm_password="+confirm_password,
          success:function(data){
            $("#resultUpdate").html(data);
          }
      });
    }
  }
</script>


<?php
}
elseif (empty($_SESSION['login'])) {
    ?>
    <script type="text/javascript">
        alert("sesi anda habis, silahkan login kembali");
        window.location="<?php echo $base_url."" ?>";
    </script>
<?php
}
?>