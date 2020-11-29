<?php 
include('../../../config/config.php');

  if (!isset($_POST['edit_id_user'])) {
    $insert_username  = mysqli_escape_string($config, $_POST['insert_username']);
    $filter           = "user_name = '$insert_username'";
  } else {
    $edit_username    = mysqli_escape_string($config, $_POST['edit_username']);
    $edit_id_user     = mysqli_escape_string($config, $_POST['edit_id_user']);   
    $filter           = "user_name = '$edit_username' AND id_user != '$edit_id_user' "; 
  }

  $selectDataUser = "SELECT * FROM tb_system_user WHERE $filter AND is_active = 'A'";

  // var_dump($selectDataUser);exit();
  $querySelectDataUser = mysqli_query($config, $selectDataUser);
  $rowCheckUser = mysqli_num_rows($querySelectDataUser);

  if ($rowCheckUser) {
  	$response = "<font class='fa fa-times-circle' color='red'> Username sudah ada!</font>
          <script>disableButtonInsert();</script>";
  } else {	
  	$response = "<font class='fa fa-check-circle' color='green'> Username Tersedia!</font>
          <script>enableButtonInsert();</script>";
  }

  echo $response;
  die;

?>