<?php
include('../../../config/config.php');
// var_dump($supplier_name);exit();

// $supplier_name = $_GET['supplier_name']; 
$c_name_L = mysqli_escape_string($config, strtolower($_GET['supplier_name']));
$c_name_U = mysqli_escape_string($config, strtoupper($_GET['supplier_name']));
$c_name_C = mysqli_escape_string($config, ucwords($c_name_L));

$query = mysqli_query($config, "
                SELECT * FROM tb_master_supplier 
                  WHERE (supplier_name LIKE '%$c_name_C%' OR supplier_name LIKE '%$c_name_L%') 
                  AND bl_state = 'A' AND outlet_code_relation = '$system_outlet_code'
                  ORDER BY supplier_name ASC");

$id_supplier            = $row['id_supplier'];
$supplier_code          = $row['supplier_code'];
$supplier_type          = $row['supplier_type'];
$supplier_name          = $row['supplier_name'];
$supplier_address       = $row['supplier_address'];
$supplier_email         = $row['supplier_email'];
$supplier_phone         = $row['supplier_phone'];
$website                = $row['website'];

$data = array(
  'id_supplier'       =>  $id_supplier,
  'supplier_code'     =>  $supplier_code,
  'supplier_type'     =>  $supplier_type,
  'supplier_name'     =>  $supplier_name,
  'supplier_address'  =>  $supplier_address,
  'supplier_phone'    =>  $supplier_phone,
  'website'           =>  $website,
);

//tampil data
echo json_encode($data);
