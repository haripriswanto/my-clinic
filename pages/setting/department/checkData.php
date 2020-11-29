<?php 
include('../../../config/config.php');

  if (!isset($_POST['idUpdate'])) {
    $insertDescription  = mysqli_escape_string($config, $_POST['insertDescription']);
    $filter             = "department_description = '$insertDescription'";
  }else {
    $editDescription  = mysqli_escape_string($config, $_POST['editDescription']);
    $idUpdate         = mysqli_escape_string($config, $_POST['idUpdate']);   
    $filter           = "department_description = '$editDescription' AND id != '$idUpdate' "; 
  }

  
  $selectData = "SELECT * FROM tb_system_department WHERE $filter AND is_active = 'A'";
  // var_dump($selectData);exit;
  $querySelectData = mysqli_query($config, $selectData);
  $rowCheckData = mysqli_num_rows($querySelectData);

  if ($rowCheckData) {
    ?>
      <font class='fa fa-times-circle' color='red'> Nama Department sudah ada!</font>
      <script>disableButtonInsert();document.getElementById.disabled = true;</script>
    <?php
  } else {	
    ?>
      <font class='fa fa-check-circle' color='green'> Nama Department Tersedia!</font>
      <script>enableButtonInsert();</script>
    <?php    
  }

  // echo $response;
  die;

?>