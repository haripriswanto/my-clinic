<?php
include('../../config/config.php');
if (!empty($_SESSION['login'])) {
?>
  <div class="table-responsive">
    <table class="table table-hover table-striped" id="tableProduct">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">MR</th>
          <th class="text-center">Nama</th>
          <th class="text-center">Umur</th>
          <th class="text-center">Alamat</th>
          <th class="text-center">Tgl Daftar</th>
          <th class="text-center">Poli</th>
          <th class="text-center">Dokter</th>
          <!-- <th class="text-center">Action</th> -->
        </tr>
      </thead>
      <?php
      $selectData = "SELECT * FROM 
          tb_patient_active 
          WHERE is_active <> 'D' ";
      $querySelectData =  mysqli_query($config, $selectData);
      $number = 0;
      while ($rowDataPatient = mysqli_fetch_array($querySelectData)) {
        $number = $number + 1;
        $id = $rowDataPatient['id'];
        $mr = $rowDataPatient['mr'];
        $no_identitas = $rowDataPatient['no_identitas'];
        $nama_lengkap = $rowDataPatient['nama_lengkap'];
        $nama_keluarga  = $rowDataPatient['nama_keluarga'];
        $title  = $rowDataPatient['title'];
        $status = $rowDataPatient['status'];
        $ket_gender = $rowDataPatient['ket_gender'];
        $kode_gender  = $rowDataPatient['kode_gender'];
        $id_gender  = $rowDataPatient['id_gender'];
        $tempat_lhir  = $rowDataPatient['tempat_lhir'];
        $tgl_lahir  = $rowDataPatient['tgl_lahir'];
        $alamat_lengkap = $rowDataPatient['alamat_lengkap'];
        $alamat = $rowDataPatient['alamat'];
        $no_rumah = $rowDataPatient['no_rumah'];
        $no_blok  = $rowDataPatient['no_blok'];
        $blok = $rowDataPatient['blok'];
        $nama_desa  = $rowDataPatient['nama_desa'];
        $kode_desa  = $rowDataPatient['kode_desa'];
        $id_desa  = $rowDataPatient['id_desa'];
        $kecamatan  = $rowDataPatient['kecamatan'];
        $kode_kecamatan = $rowDataPatient['kode_kecamatan'];
        $id_kecamatan = $rowDataPatient['id_kecamatan'];
        $kabupaten  = $rowDataPatient['kabupaten'];
        $kode_kabupaten = $rowDataPatient['kode_kabupaten'];
        $id_kabupaten = $rowDataPatient['id_kabupaten'];
        $provinsi = $rowDataPatient['provinsi'];
        $kode_provinsi  = $rowDataPatient['kode_provinsi'];
        $id_provinsi  = $rowDataPatient['id_provinsi'];
        $kota = $rowDataPatient['kota'];
        $kode_kota  = $rowDataPatient['kode_kota'];
        $id_kota  = $rowDataPatient['id_kota'];
        $kode_pos = $rowDataPatient['kode_pos'];
        $no_hp  = $rowDataPatient['no_hp'];
        $no_telp  = $rowDataPatient['no_telp'];
        $email_pribadi  = $rowDataPatient['email_pribadi'];
        $telp_kantor  = $rowDataPatient['telp_kantor'];
        $ket_suku = $rowDataPatient['ket_suku'];
        $kode_suku  = $rowDataPatient['kode_suku'];
        $id_suku  = $rowDataPatient['id_suku'];
        $ket_gelar_pendidikan = $rowDataPatient['ket_gelar_pendidikan'];
        $kode_gelar_pendidikan  = $rowDataPatient['kode_gelar_pendidikan'];
        $id_gelar_pendidikan  = $rowDataPatient['id_gelar_pendidikan'];
        $jabatan  = $rowDataPatient['jabatan'];
        $ket_agama  = $rowDataPatient['ket_agama'];
        $kode_agama = $rowDataPatient['kode_agama'];
        $id_agama = $rowDataPatient['id_agama'];
        $nama_ayah  = $rowDataPatient['nama_ayah'];
        $no_identitas_ayah  = $rowDataPatient['no_identitas_ayah'];
        $alamat_ayah  = $rowDataPatient['alamat_ayah'];
        $telp_ayah  = $rowDataPatient['telp_ayah'];
        $nama_ibu = $rowDataPatient['nama_ibu'];
        $no_identitas_ibu = $rowDataPatient['no_identitas_ibu'];
        $alamat_ibu = $rowDataPatient['alamat_ibu'];
        $telp_ibu = $rowDataPatient['telp_ibu'];
        $emergency_person = $rowDataPatient['emergency_person'];
        $emergency_person_relation  = $rowDataPatient['emergency_person_relation'];
        $emergency_address  = $rowDataPatient['emergency_address'];
        $emergency_phone  = $rowDataPatient['emergency_phone'];
        $ket_status_menikah = $rowDataPatient['ket_status_menikah'];
        $kode_status_menikah  = $rowDataPatient['kode_status_menikah'];
        $id_status_menikah  = $rowDataPatient['id_status_menikah'];
        $nama_pasangan  = $rowDataPatient['nama_pasangan'];
        $golongan_darah = $rowDataPatient['golongan_darah'];
        $golongan_darah_resus = $rowDataPatient['golongan_darah_resus'];
        $nama_perusahaan  = $rowDataPatient['nama_perusahaan'];
        $kode_perusahaan  = $rowDataPatient['kode_perusahaan'];
        $id_perusahaan  = $rowDataPatient['id_perusahaan'];
        $no_pegawai = $rowDataPatient['no_pegawai'];
        $id_pegawai = $rowDataPatient['id_pegawai'];
        $department_pegawai = $rowDataPatient['department_pegawai'];
        $jabatan_pegawai  = $rowDataPatient['jabatan_pegawai'];
        $nama_asuransi  = $rowDataPatient['nama_asuransi'];
        $kode_asuransi  = $rowDataPatient['kode_asuransi'];
        $id_asuransi  = $rowDataPatient['id_asuransi'];
        $no_asuransi  = $rowDataPatient['no_asuransi'];
        $berlaku_sampai = $rowDataPatient['berlaku_sampai'];
        $kategori_cara_bayar  = $rowDataPatient['kategori_cara_bayar'];
        $kode_kategori_cara_bayar = $rowDataPatient['kode_kategori_cara_bayar'];
        $id_kategori_cara_bayar = $rowDataPatient['id_kategori_cara_bayar'];
        $ket_tagihan  = $rowDataPatient['ket_tagihan'];
        $kode_tagihan = $rowDataPatient['kode_tagihan'];
        $id_tagihan = $rowDataPatient['id_tagihan'];
        $status_rujukan = $rowDataPatient['status_rujukan'];
        $referal_in_type  = $rowDataPatient['referal_in_type'];
        $asal_rujukan = $rowDataPatient['asal_rujukan'];
        $tgl_rujukan_masuk  = $rowDataPatient['tgl_rujukan_masuk'];
        $waktu_rujukan_masuk  = $rowDataPatient['waktu_rujukan_masuk'];
        $diagnosa_saat_rujukan_masuk  = $rowDataPatient['diagnosa_saat_rujukan_masuk'];
        $kondisi_saat_rujukan_masuk = $rowDataPatient['kondisi_saat_rujukan_masuk'];
        $status_darurat = $rowDataPatient['status_darurat'];
        $tgl_masuk  = $rowDataPatient['tgl_masuk'];
        $waktu_masuk  = $rowDataPatient['waktu_masuk'];
        $nama_department  = $rowDataPatient['nama_department'];
        $kode_department  = $rowDataPatient['kode_department'];
        $id_department  = $rowDataPatient['id_department'];
        $no_antrian = $rowDataPatient['no_antrian'];
        $nama_dokter  = $rowDataPatient['nama_dokter'];
        $kode_dokter  = $rowDataPatient['kode_dokter'];
        $id_dokter  = $rowDataPatient['id_dokter'];
        $ket_tipe_pasien  = $rowDataPatient['ket_tipe_pasien'];
        $kode_tipe_pasien = $rowDataPatient['kode_tipe_pasien'];
        $id_tipe_pasien = $rowDataPatient['id_tipe_pasien'];
        $ket_diagnose = $rowDataPatient['ket_diagnose'];
        $icds_diagnose  = $rowDataPatient['icds_diagnose'];
        $kode_diagnose  = $rowDataPatient['kode_diagnose'];
        $tipe_rujukan_keluar  = $rowDataPatient['tipe_rujukan_keluar'];
        $tujuan_rujukan_keluar  = $rowDataPatient['tujuan_rujukan_keluar'];
        $no_rujukan_keluar  = $rowDataPatient['no_rujukan_keluar'];
        $tgl_rujukan_keluar = $rowDataPatient['tgl_rujukan_keluar'];
        $ket_diagnose_rujukan_keluar  = $rowDataPatient['ket_diagnose_rujukan_keluar'];
        $icds_rujukan_keluar  = $rowDataPatient['icds_rujukan_keluar'];
        $kode_dpjp  = $rowDataPatient['kode_dpjp'];
        $id_dpjp  = $rowDataPatient['id_dpjp'];
        $kondisi_rujukan_keluar = $rowDataPatient['kondisi_rujukan_keluar'];
        $date_insert  = $rowDataPatient['date_insert'];
        $time_insert  = $rowDataPatient['time_insert'];
        $ts_insert  = $rowDataPatient['ts_insert'];
        $ts_update  = $rowDataPatient['ts_update'];
        $is_active  = $rowDataPatient['is_active'];
        $ip_address = $rowDataPatient['ip_address'];
        $user_name  = $rowDataPatient['user_name'];
      ?>
        <tr>
          <td><?php echo $number; ?></td>
          <td><?php echo $product_code; ?></td>
          <td title="Detail <?php echo $product_name ?> " data-toggle="modal" id="#buttonDetail" data-id="<?php echo $id_product; ?>" data-target="#detail" style="cursor: pointer;"><?php echo $mr; ?></td>
          <td><?php echo $nama_lengkap; ?></td>
          <td><?php echo $alamat_lengkap; ?></td>
          <td><?php echo $date_insert . " " . $time_insert; ?></td>
          <td><?php echo $nama_department; ?></td>
          <td><?php echo $nama_dokter; ?></td>
          <td>
            <a data-toggle="modal" data-id="<?php echo $id_product; ?>" data-target="#editFormProduct" id="#buttonEdit" title="Ubah Data <?php echo $product_name ?>" class="btn btn-xs btn-primary" data-backdrop="static" data-keyboard="false">
              <span class="fa fa-pencil"></span>
            </a>
            <a data-id="<?php echo $id_product; ?>" data-toggle="modal" data-target="#archiveConfirm" id="buttonArchive" title="Arsipkan Data <?php echo $product_name ?>" class="btn btn-xs btn-info buttonArchive">
              <span class="fa fa-archive"></span>
            </a>
            <a data-id="<?php echo $id_product; ?>" data-code="<?php echo $product_code; ?>" data-name="<?php echo $product_name; ?>" title="Hapus Data <?php echo $product_name ?>" class="btn btn-xs btn-danger buttonDelete">
              <span class="fa fa-times"></span>
            </a>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>

  <script>
    $('#headerProduct').html('Daftar Pasien Aktif');

    $(document).ready(function() {
      enabledHeaderButton();
      $('#tableProduct').DataTable({
        responsive: true
      });
    });
  </script>


<?php
} elseif (empty($_SESSION['login'])) {
?>
  <script type="text/javascript">
    alert("sesi anda habis, silahkan login kembali");
    window.location = "<?php echo $base_url . "" ?>";
  </script>
<?php
}
?>