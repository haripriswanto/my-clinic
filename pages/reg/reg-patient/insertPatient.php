
<div class="panel panel-primary">
    <div class="panel-heading">
        <b>PENDAFTARAN PASIEN</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
            <div class="panel-body">
                <div class="form-inline">
                    <!-- <div class="form-group col-md-3 pull-right">
                        <input type="date" class="form-control" id="transaction_date" name="transaction_date" placeholder="Tgl Transaksi" data-toggle="tooltip" data-placement="bottom" title="Jika Kosong maka Tgl Hari ini">
                        <select name="transaction_time" id="transaction_time" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Jika Kosong maka Jam Saat ini">
                            <?php include('master_time.php'); ?>
                        </select>
                    </div> -->

                    <div class="form-group col-md-2 pull-right">
                        <button type="button" class="btn btn-success" id="buttonSave"><span class="fa fa-save"></span> Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close" id="buttonCancel"><span class="fa fa-history"></span> Batal</button>
                    </div>

                    <!-- Form Pasien -->
                    <div class="input-group" >
                        <input type="text" class="form-control" id="no_mr" name="no_mr"data-toggle="tooltip" data-placement="bottom" title="No MR" placeholder="No MR">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianMr" name="buttonPencarianMr" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Pasien">
                            <span class="fa fa-search"></span>      
                            </button> 
                        </span>
                    </div>

                    <div class="input-group" >
                        <input type="text" class="form-control" id="nik" name="nik"data-toggle="tooltip" data-placement="bottom" title="NIK" placeholder="NIK">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianNik" name="buttonPencarianNik" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Pasien">
                            <span class="fa fa-search"></span>      
                            </button> 
                        </span>
                    </div>
                    <div class="input-group" >
                        <input type="text" class="form-control" id="no_kartu" name="no_kartu"data-toggle="tooltip" data-placement="bottom" title="No Kartu" placeholder="No Kartu">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianNoKartu" name="buttonPencarianNoKartu" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Pasien">
                            <span class="fa fa-search"></span>      
                            </button> 
                        </span>
                    </div>
                    <div class="clearfix"><br></div> <!-- Enter -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" title="Nama Lengkap" placeholder="Nama Lengkap" style="width: 380%: margin-right:1em;">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" title="Title" placeholder="Title (Tn, Ny, By, Nn)" style="width: 70%: margin-right:1em;">
                    </div>
                    <div class="form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="SUAMI">SUAMI</option>
                            <option value="ISTRI">ISTRI</option>
                            <option value="ANAK">ANAK</option>
                        </select>
                    </div>
                    <div class="clearfix"><br></div> <!-- Enter -->
                    <div class="form-group">
                        <select name="gender" id="gender" class="form-control">
                            <option value="">-- Pilih gender --</option>
                            <option value="1">Pria</option>
                            <option value="2">Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" title="Tempat Lahir" placeholder="Tempat Lahir" style="width: 80%: margin-right:1em;">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" title="tgl Lahir" placeholder="tgl Lahir" style="width: 80%: margin-right:1em;">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="umur" name="umur" title="Umur" placeholder="Umur" style="width: 80%: margin-right:1em;">
                    </div>

                    <div class="clearfix"><br></div> <!-- Enter -->
                    <div class="input-group" >
                        <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap"data-toggle="tooltip" data-placement="bottom" title="Ketik Desa, Kecamatan, Dll." placeholder="Ketik Desa, Kecamatan, Dll." style="width: 280%: margin-right:1em;">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="pencarianAlamat" name="pencarianAlamat" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Alamat">
                            <span class="fa fa-search"></span>      
                            </button> 
                        </span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_rumah" name="no_rumah" title="No. Rumah" placeholder="No. Rumah">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="rt" name="rt" title="RT" placeholder="RT">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="rw" name="rw" title="RW" placeholder="RW">
                    </div>
                    <div class="clearfix"><br></div> <!-- Enter -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="desa" name="desa" title="Kel/Desa" placeholder="Kel/Desa">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" title="kecamatan" placeholder="kecamatan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kabupaten" name="kabupaten" title="Kabupaten" placeholder="Kabupaten">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="provinsi" name="provinsi" title="provinsi" placeholder="provinsi">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="negara" name="negara" title="negara" placeholder="negara">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" title="kode_pos" placeholder="kode_pos">
                    </div>
                    <div class="clearfix"><br></div> <!-- Enter -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="telp" name="telp" title="telp" placeholder="telp">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="hp" name="hp" title="hp" placeholder="hp">
                    </div>
                    <div class="form-group">
                        <select name="pendidikan" id="pendidikan" class="form-control">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="DIPLOMA 1">DIPLOMA 1</option>
                            <option value="DIPLOMA 2">DIPLOMA 2</option>
                            <option value="DIPLOMA 3">DIPLOMA 3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="TIDAK SEKOLAH">TIDAK SEKOLAH</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="pekerjaan" id="pekerjaan" class="form-control">
                            <option value="">-- Pilih Pekerjaan --</option>
                            <option value="WIRASWASTA">WIRASWASTA</option>
                            <option value="BURUH">BURUH</option>
                            <option value="PETANI">PETANI</option>
                            <option value="PNS">PNS</option>
                            <option value="TNI">TNI</option>
                            <option value="POLRI">POLRI</option>
                            <option value="MAHASISWA">MAHASISWA</option>
                            <option value="SWASTA">SWASTA</option>
                            <option value="HONORER">HONORER</option>
                            <option value="NONJOB">NONJOB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="suku" name="suku" title="suku" placeholder="suku">
                    </div>
                    <div class="form-group">
                        <select name="agama" id="agama" class="form-control">
                            <option value="">-- Pilih Agama --</option>
                            <option value="ISLAM">ISLAM</option>
                            <option value="HINDU">HINDU</option>
                            <option value="BUDHA">BUDHA</option>
                            <option value="KATHOLIK">KATHOLIK</option>
                            <option value="PROTESTAN">PROTESTAN</option>
                            <option value="KONGHUCU">KONGHUCU</option>
                        </select>
                    </div>

                    <div class="clearfix"><br></div> <!-- Enter -->
                    <div class="form-group">
                        <select name="status_nikah" id="status_nikah" class="form-control">
                            <option value="">-- Pilih Status Pernikahan --</option>
                            <option value="MENIKAH">MENIKAH</option>
                            <option value="BELUM MENIKAH">BELUM MENIKAH</option>
                            <option value="CERAI">CERAI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_pasangan" name="nama_pasangan" title="Nama Pasangan" placeholder="Nama Pasangan">
                    </div>                    

                    <div class="clearfix"><br></div> <!-- Enter -->
                    <div class="form-group">
                        <select name="asal_rujukan" id="asal_rujukan" class="form-control">
                            <option value="">-- Pilih Asal Rujukan --</option>
                            <option value="DATANG SENDIRI">DATANG SENDIRI</option>
                            <option value="DOKTER PRAKTEK">DOKTER PRAKTEK</option>
                            <option value="PUSKESMAS">PUSKESMAS</option>
                            <option value="RUMAH SAKIT">RUMAH SAKIT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_asal_rujukan" name="nama_asal_rujukan" title="Asal Rujukan" placeholder="Asal Rujukan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_rujukan" name="no_rujukan" title="No. Rujukan" placeholder="No. Rujukan">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="tgl_rujukan" name="tgl_rujukan" title="Tgl Rujukan" placeholder="Tgl Rujukan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="diagnose" name="diagnose" title="Diagnose" placeholder="Diagnose">
                    </div>

                    <div class="clearfix"><br></div> <!-- Enter -->
                    <div class="form-group">
                        <select name="cara_bayar" id="cara_bayar" class="form-control">
                            <option value="">-- Pilih Cara Bayar --</option>
                            <option value="TUNAI">TUNAI</option>
                            <option value="ASURANSI">ASURANSI</option>
                            <option value="PERUSAHAAN">PERUSAHAAN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_penanggung" name="nama_penanggung" title="Nama Penanggung" placeholder="Nama Penanggung">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_sep" name="no_sep" title="SEP" placeholder="SEP">
                    </div>

                    <div class="input-group" >
                        <input type="text" class="form-control" id="pilih_layanan" name="pilih_layanan" title="Layanan Poli/Ranap" placeholder="Layanan Poli/Ranap" style="width: 280%: margin-right:1em;">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianLayanan" name="buttonPencarianLayanan" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Poli">
                            <span class="fa fa-search"></span>      
                            </button> 
                        </span>
                    </div>
                    <div class="input-group" >
                        <input type="text" class="form-control" id="pilih_dokter" name="pilih_dokter" title="Pilih Dokter" placeholder="Pilih Dokter" style="width: 280%: margin-right:1em;">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianDokter" name="buttonPencarianDokter" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Dokter">
                            <span class="fa fa-search"></span>      
                            </button> 
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        
        var no_mr = $('#no_mr');
        var nama_lengkap = $('#nama_lengkap');
        var title = $('#title');
        var gender = $('#gender');
        var tempat_lahir = $('#tempat_lahir');
        var tgl_lahir = $('#tgl_lahir');
        var umur = $('#umur');
        var alamat_lengkap = $('#alamat_lengkap');
        var no_rumah = $('#no_rumah');
        var rt = $('#rt');
        var rw = $('#rw');
        var desa = $('#desa');
        var kecamatan = $('#kecamatan');
        var kabupaten = $('#kabupaten');
        var provinsi = $('#provinsi');
        var negara = $('#negara');
        var kode_pos = $('#kode_pos');
        var telp = $('#telp');
        var hp = $('#hp');
        var pendidikan = $('#pendidikan');
        var pekerjaan = $('#pekerjaan');
        var suku = $('#suku');
        var agama = $('#agama');
        var status_nikah = $('#status_nikah');
        var nama_pasangan = $('#nama_pasangan');
        var asal_rujukan = $('#asal_rujukan');
        var nama_asal_rujukan = $('#nama_asal_rujukan');
        var no_rujukan = $('#no_rujukan');
        var tgl_rujukan = $('#tgl_rujukan');
        var diagnose = $('#diagnose');
        var cara_bayar = $('#cara_bayar');
        var nama_penanggung = $('#nama_penanggung');
        var no_sep = $('#no_sep');
        var pilih_layanan = $('#pilih_layanan');
        var buttonPencarianLayanan = $('#buttonPencarianLayanan');
        var pilih_dokter = $('#pilih_dokter');
        var buttonPencarianDokter = $('#buttonPencarianDokter');
        var buttonPencarianMr = $('#buttonPencarianMr');
        var buttonPencarianNik = $('#buttonPencarianNik');
        var buttonPencarianNoKartu = $('#buttonPencarianNoKartu');


          no_mr.keyup(function(e) {
            if(e.keyCode == 13) {
              if (no_mr.val() == '') {
                toastr['error']("MR Harus Di Isi!", "Warning!");
                no_mr.focus();
              }else {nama_lengkap.focus();}
            }
          });

    </script>