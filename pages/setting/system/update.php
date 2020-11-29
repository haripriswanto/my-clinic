
<?php 
include('../../../config/config.php');

   if (!empty($_SESSION['login'])) {

   $id_system 			= mysqli_escape_string($config, $_GET['id_system']);
   // var_dump($id_system);exit();
   $edit_title		  	= mysqli_escape_string($config, $_GET['insert_title']);
   $edit_header        = mysqli_escape_string($config, $_GET['insert_header']);
   $edit_dashboard     = mysqli_escape_string($config, $_GET['insert_dashboard']);
   $edit_instansi_name = mysqli_escape_string($config, $_GET['insert_instansi_name']);
   $edit_owner         = mysqli_escape_string($config, $_GET['insert_owner']);
   $edit_phone         = mysqli_escape_string($config, $_GET['insert_phone']);
   $edit_address	    = mysqli_escape_string($config, $_GET['insert_address']);
   $edit_email         = mysqli_escape_string($config, $_GET['insert_email']);
   $edit_url           = mysqli_escape_string($config, $_GET['insert_url']);
   $edit_outlet_code	= mysqli_escape_string($config, $_GET['insert_outlet_code']);
   $edit_footer_struct = mysqli_escape_string($config, $_GET['insert_footer_struct']);


   

   $sql = "UPDATE tb_system_setting 
         SET system_title='".$edit_title."', system_header='".$edit_header."', system_dashboard_text='".$edit_dashboard."', system_owner='".$edit_owner."', system_instansi_name='".$edit_instansi_name."' , system_phone='".$edit_phone."', system_address='".$edit_address."', system_email='".$edit_email."' , system_url='".$edit_url."', system_outlet_code='".$edit_outlet_code."', system_footer_struct='".$edit_footer_struct."'
            WHERE id_system='".$id_system."' ";

   $result = mysqli_query($config, $sql);

   if ($result){

      // ************** QUERY log_activity

   $query_log = "INSERT INTO log_activity(

               id_log, log_date, log_menu, log_description, log_status, ip_address, user_name, log_os, log_browser)
         VALUES ( '".sha1(generate(10))."', '$currentDate "." $currentTime', 'UPDATE', 'Merubah Data Setting Dengan Kode ".$id_system."' , 'A', '$ip_address', '$sessionUser', '$os', '$browser')";
   $result1 = mysqli_query($config, $query_log);
      echo "<script>toastr['success']('Berhasil Update');loadDataSetting();closeForm();</script>"; 
   }
   else{
      echo "<div class='alert alert-danger'>Error Query update</div>";
   }


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