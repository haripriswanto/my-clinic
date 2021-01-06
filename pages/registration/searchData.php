<?php
include('../../config/config.php');
if (!empty($_SESSION['login'])) {


    $i_rm = $_POST['i_rm'];

    //mengambil data
    $selectData = "SELECT * FROM tb_master_patient where rm = '$i_rm' ";
    $queryData = mysqli_query($config, $selectData);

    $dataPatient = mysqli_fetch_array($queryData);

    $data = array(
        'i_rm'                  =>  $dataPatient['mr'],
        'i_nik'                 =>  $dataPatient['no_identitas'],
        'i_insurance_number'    =>  $dataPatient['no_asuransi'],
        'i_insurance_name'      =>  $dataPatient['nama_asuransi'],
        'i_full_name'           =>  $dataPatient['nama_lengkap'],
        'i_title'               =>  $dataPatient['title'],
        'i_status'              =>  $dataPatient['status'],
    );

    //tampil data
    echo json_encode($data);

    // Check Session
} elseif (empty($_SESSION['login'])) {
?>
    <script type="text/javascript">
        alert("sesi anda habis, silahkan login kembali");
        window.location = "<?php echo $base_url . "" ?>";
    </script>
<?php
}
?>