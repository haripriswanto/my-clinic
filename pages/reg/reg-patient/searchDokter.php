<?php
include('../../../config/config.php');
// var_dump($supplier_name);exit();

$nama_dokter_L = mysqli_escape_string($config, strtolower($_GET['nama_dokter']));
$nama_dokter_U = mysqli_escape_string($config, strtoupper($_GET['nama_dokter']));
$nama_dokter_C = mysqli_escape_string($config, ucwords($nama_dokter_L));
// var_rump($mr_L);exit(); 


$querySearch = "SELECT * FROM tb_master_pegawai WHERE kode_pegawai = '$nama_dokter_L' OR nama_pegawai LIKE '%$nama_dokter_L%' ";

$query = mysqli_query($config, $querySearch);
$check = mysqli_num_rows($query);
$pegawai = mysqli_fetch_array($query);

$data = array(
    'kode_dokter' => $pegawai['kode_pegawai'],
    'nama_dokter' => $pegawai['nama_pegawai'],
);
if ($check < 1) {
    // echo "<script>toastr['error']('Data pasien tidak ditemukan!', 'Warning!')</script>";
} else {
    echo json_encode($data);
    // echo "<script>$('#buttonPencarianMr').html('<span class='fa fa-search'></span>');</script>";
}
