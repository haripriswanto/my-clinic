<?php
include('../../../config/config.php');
// var_dump($supplier_name);exit();

$nama_layanan_L = mysqli_escape_string($config, strtolower($_GET['nama_layanan']));
$nama_layanan_U = mysqli_escape_string($config, strtoupper($_GET['nama_layanan']));
$nama_layanan_C = mysqli_escape_string($config, ucwords($nama_layanan_L));
// var_rump($mr_L);exit(); 


$querySearch = "SELECT * FROM tb_master_department WHERE kode_department = '$nama_layanan_L' OR nama_department LIKE '%$nama_layanan_L%' ";

$query = mysqli_query($config, $querySearch);
$check = mysqli_num_rows($query);
$department = mysqli_fetch_array($query);

$data = array(
    'kode_department' => $department['kode_department'],
    'nama_department' => $department['nama_department'],
);
if ($check < 1) {
    // echo "<script>toastr['error']('Data pasien tidak ditemukan!', 'Warning!')</script>";
} else {
    echo json_encode($data);
    // echo "<script>$('#buttonPencarianMr').html('<span class='fa fa-search'></span>');</script>";
}
