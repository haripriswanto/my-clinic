<?php
include('../../../config/config.php');
// var_dump($supplier_name);exit();

$mr_L = mysqli_escape_string($config, strtolower($_GET['mr']));
$mr_U = mysqli_escape_string($config, strtoupper($_GET['mr']));
$mr_C = mysqli_escape_string($config, ucwords($mr_L));
// var_rump($mr_L);exit(); 


$querySearch = "SELECT * FROM tb_master_patient WHERE mr = '$mr_L' OR nik = '$mr_L' ";

$query = mysqli_query($config, $querySearch);
$check = mysqli_num_rows($query);
$patient = mysqli_fetch_array($query);

$data = array(
    'mr' => $patient['mr'],
    'nik' => $patient['nik'],
    'nama_lengkap' => $patient['nama_lengkap'],
    'nama_keluarga' => $patient['nama_keluarga'],
    'title' => $patient['title'],
    'status_dalam_keluarga' => $patient['status_dalam_keluarga'],
    'gender' => $patient['gender'],
    'tgl_lahir' => $patient['tgl_lahir'],
    'umur' => $patient['umur'],
    'tempat_lahir' => $patient['tempat_lahir'],
    'alamat_lengkap' => $patient['alamat_lengkap'],
    'desa' => $patient['desa'],
    'kecamatan' => $patient['kecamatan'],
    'kabupaten' => $patient['kabupaten'],
    'provinsi' => $patient['provinsi'],
    'negara' => $patient['negara'],
    'kode_pos' => $patient['kode_pos'],
    'no_hp' => $patient['no_hp'],
    'no_telp' => $patient['no_telp'],
    'email' => $patient['email'],
    'telp' => $patient['telp'],
    'suku' => $patient['suku'],
    'pendidikan_terakhir' => $patient['pendidikan_terakhir'],
    'agama' => $patient['agama'],
    'pekerjaan' => $patient['pekerjaan'],
    'status_nikah' => $patient['status_nikah'],
    'nama_pasangan' => $patient['nama_pasangan'],
    'golongan_darah' => $patient['golongan_darah'],
    'golongan_darah_resus' => $patient['golongan_darah_resus'],
    'nama_perusahaan' => $patient['nama_perusahaan'],
    'no_pegawai' => $patient['no_pegawai'],
    'department_pegawai' => $patient['department_pegawai'],
    'jabatan_pegawai' => $patient['jabatan_pegawai'],
    'nama_asuransi' => $patient['nama_asuransi'],
    'kode_asuransi' => $patient['kode_asuransi'],
    'no_asuransi' => $patient['no_asuransi'],
    'kategori_cara_bayar' => $patient['kategori_cara_bayar'],
    'status_rujukan' => $patient['status_rujukan'],
    'jenis_rujukan' => $patient['jenis_rujukan'],
    'nama_asal_rujukan' => $patient['nama_asal_rujukan'],
    'tgl_rujukan_masuk' => $patient['tgl_rujukan_masuk'],
    'waktu_rujukan_masuk' => $patient['waktu_rujukan_masuk'],
    'diagnosa_saat_rujukan_masuk' => $patient['diagnosa_saat_rujukan_masuk'],
    'kondisi_saat_rujukan_masuk' => $patient['kondisi_saat_rujukan_masuk'],
    'status_darurat' => $patient['status_darurat'],
    'tgl_masuk' => $patient['tgl_masuk'],
    'waktu_masuk' => $patient['waktu_masuk'],
    'id_department' => $patient['id_department'],
    'no_antrian' => $patient['no_antrian'],
    'id_dokter' => $patient['id_dokter'],
    'ket_tipe_pasien' => $patient['ket_tipe_pasien'],
    'kode_tipe_pasien' => $patient['kode_tipe_pasien'],
    'id_tipe_pasien' => $patient['id_tipe_pasien'],
    'ket_diagnose' => $patient['ket_diagnose'],
    'icds_diagnose' => $patient['icds_diagnose'],
    'kode_diagnose' => $patient['kode_diagnose'],
    'tipe_rujukan_keluar' => $patient['tipe_rujukan_keluar'],
    'tujuan_rujukan_keluar' => $patient['tujuan_rujukan_keluar'],
    'no_rujukan_keluar' => $patient['no_rujukan_keluar'],
    'tgl_rujukan_keluar' => $patient['tgl_rujukan_keluar'],
    'ket_diagnose_rujukan_keluar' => $patient['ket_diagnose_rujukan_keluar'],
    'icds_rujukan_keluar' => $patient['icds_rujukan_keluar'],
    'id_dpjp' => $patient['id_dpjp'],
    'kondisi_rujukan_keluar' => $patient['kondisi_rujukan_keluar'],
    'date_insert' => $patient['date_insert'],
    'time_insert' => $patient['time_insert'],
    'ts_insert' => $patient['ts_insert'],
    'ts_update' => $patient['ts_update'],
    'is_active' => $patient['is_active'],
);
if ($check < 1) {
    // echo "<script>toastr['error']('Data pasien tidak ditemukan!', 'Warning!')</script>";
} else {
    echo json_encode($data);
    // echo "<script>$('#buttonPencarianMr').html('<span class='fa fa-search'></span>');</script>";
}
