<div class="panel panel-primary">
    <div class="panel-heading">
        <b>PENDAFTARAN PASIEN</b>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="panel-body">
        <!-- <div class="form-group col-md-3 pull-right">
                <input type="date" class="form-control" id="transaction_date" name="transaction_date" placeholder="Tgl Transaksi" data-toggle="tooltip" data-placement="bottom" title="Jika Kosong maka Tgl Hari ini">
                <select name="transaction_time" id="transaction_time" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Jika Kosong maka Jam Saat ini">
                    <?php include('master_time.php'); ?>
                </select>
            </div> -->

        <div class="row">
            <!-- Form Pasien -->
            <div class="col-md-2">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="mr" name="mr" data-toggle="tooltip" data-placement="bottom" title="No MR" placeholder="No MR" onkeypress="javascript:return isNumber(event)">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianMr" name="buttonPencarianMr" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Pasien">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="nik" name="nik" data-toggle="tooltip" data-placement="bottom" title="NIK" placeholder="NIK" onkeypress="javascript:return isNumber(event)">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianNik" name="buttonPencarianNik" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Pasien">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="no_asuransi" name="no_asuransi" data-toggle="tooltip" data-placement="bottom" title="No Asuransi" placeholder="No Asuransi" onkeypress="javascript:return isNumber(event)">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianNoKartu" name="buttonPencarianNoKartu" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Pasien">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" title="Nama Lengkap" placeholder="Nama Lengkap">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="title" id="title" class="form-control" title="Title" placeholder="Title">
                        <option value="">-- Status --</option>
                        <option value="TN">TN</option>
                        <option value="NY">NY</option>
                        <option value="Nn">Nn</option>
                    </select>
                    <!-- <input type="text" class="form-control" id="title" name="title" title="Title" placeholder="Ct: Tn, Ny, By, Nn"> -->
                </div>
            </div>
            <div class="col-md-2">
                <div class="group">
                    <select name="status_dalam_keluarga" id="status_dalam_keluarga" class="form-control">
                        <option value="">-- Status --</option>
                        <option value="SUAMI">SUAMI</option>
                        <option value="ISTRI">ISTRI</option>
                        <option value="ANAK">ANAK</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="clear-fix"><br></div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <select name="gender" id="gender" class="form-control">
                        <option value="">-- gender --</option>
                        <option value="1">Pria</option>
                        <option value="2">Wanita</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" title="Tempat Lahir" placeholder="Tempat Lahir">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" title="tgl Lahir" placeholder="tgl Lahir" onchange="getAge()">
                </div>
                <span id="resultAge"></span>
            </div>
            <div class="col-md-2">
                <input type="hidden" id="umur" name="umur">
                <div class="input-group">
                    <input type="number" class="form-control" id="umur_d" name="umur_d" title="Umur" placeholder="Umur" onkeypress="javascript:return isNumber(event)">
                    <span class="input-group-addon">
                        Thn
                    </span>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" data-toggle="tooltip" data-placement="bottom" title="Alamat Lengkap (perum, Kompleks, No. Rumah, RT, RW, )" placeholder="Alamat Lengkap (perum, Kompleks, No. Rumah, RT, RW, )">
                </div>
            </div>
            <!-- <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="no_rumah" name="no_rumah" title="No. Rumah" placeholder="No." style="width:40%;">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="rt" name="rt" title="RT" placeholder="RT" style="width:40%; margin-left:0">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="rw" name="rw" title="RW" placeholder="RW" style="width:40%">
                </div>
            </div> -->
            <div class="col-md-3">
                <div class="form-group">
                    <div class="input-group">
                        <!-- <select class="selectpicker" data-show-subtext="true" data-live-search="true">
                            <option data-subtext="Rep California">Tom Foolery</option>
                        </select> -->
                        <input type="text" class="form-control" id="desa" name="desa" title="Kel/Desa" placeholder="Kel/Desa">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonSearchAddress" name="buttonSearchAddress" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Alamat">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" title="kecamatan" placeholder="kecamatan">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" title="Kabupaten" placeholder="Kabupaten">
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="provinsi" name="provinsi" title="provinsi" placeholder="provinsi">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="negara" name="negara" title="negara" placeholder="negara">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" title="Kode Pos" placeholder="Kode Pos">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="telp" name="telp" title="telp" placeholder="telp" onkeypress="javascript:return isNumber(event)">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="hp" name="hp" title="hp" placeholder="hp" onkeypress="javascript:return isNumber(event)">
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <select name="pendidikan" id="pendidikan_terakhir" class="form-control">
                        <option value="">-- Pendidikan --</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="D1">DIPLOMA 1</option>
                        <option value="D2">DIPLOMA 2</option>
                        <option value="D3">DIPLOMA 3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="TIDAK SEKOLAH">TIDAK SEKOLAH</option>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <select name="pekerjaan" id="pekerjaan" class="form-control">
                        <option value="">-- Pekerjaan --</option>
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
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="suku" name="suku" title="suku" placeholder="suku">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="agama" id="agama" class="form-control">
                        <option value="">-- Agama --</option>
                        <option value="ISLAM">ISLAM</option>
                        <option value="HINDU">HINDU</option>
                        <option value="BUDHA">BUDHA</option>
                        <option value="KATHOLIK">KATHOLIK</option>
                        <option value="PROTESTAN">PROTESTAN</option>
                        <option value="KONGHUCU">KONGHUCU</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="status_nikah" id="status_nikah" class="form-control">
                        <option value="">-- Status Pernikahan --</option>
                        <option value="1">MENIKAH</option>
                        <option value="2">BELUM MENIKAH</option>
                        <option value="3">CERAI</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="nama_pasangan" name="nama_pasangan" title="Nama Pasangan" placeholder="Nama Pasangan">
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <select name="jenis_rujukan" id="jenis_rujukan" class="form-control">
                        <option value="">-- Asal Rujukan --</option>
                        <option value="DATANG SENDIRI">DATANG SENDIRI</option>
                        <option value="DOKTER PRAKTEK">DOKTER PRAKTEK</option>
                        <option value="PUSKESMAS">PUSKESMAS</option>
                        <option value="RUMAH SAKIT">RUMAH SAKIT</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="nama_asal_rujukan" name="nama_asal_rujukan" title="Nama Asal Rujukan" placeholder="Nama Asal Rujukan">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="no_rujukan" name="no_rujukan" title="No. Rujukan" placeholder="No. Rujukan">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="date" class="form-control" id="tgl_rujukan" name="tgl_rujukan" title="Tgl Rujukan" placeholder="Tgl Rujukan">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="diagnose" name="diagnose" title="Diagnose" placeholder="Diagnose">
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <select name="cara_bayar" id="cara_bayar" class="form-control">
                        <option value="">-- Cara Bayar --</option>
                        <option value="TUNAI">TUNAI</option>
                        <option value="ASURANSI">ASURANSI</option>
                        <option value="PERUSAHAAN">PERUSAHAAN</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="nama_penanggung" name="nama_penanggung" title="Nama Penanggung" placeholder="Nama Penanggung">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" id="no_sep" name="no_sep" title="SEP" placeholder="SEP">
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" title="Layanan Poli/Ranap" placeholder="Layanan Poli/Ranap">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianLayanan" name="buttonPencarianLayanan" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Poli">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="kode_layanan" name="kode_layanan" title="Kode Layanan" placeholder="Kode Layanan" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="pilih_dokter" name="pilih_dokter" title="Pilih Dokter" placeholder="Pilih Dokter">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="buttonPencarianDokter" name="buttonPencarianDokter" data-toggle="modal" data-target="#" data-placement="bottom" title="Pencarian Dokter">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control" id="kode_dokter" name="kode_dokter" title="Kode Dokter" placeholder="Kode Dokter" disabled>
                </div>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12 pull-right">
                <div class="form-group pull-right">
                    <button type="button" class="btn btn-primary" id="buttonSaveAgain"><span class="fa fa-save" title="Klik untuk menyimpan dan membersihkan form."></span> Simpan Dan Isi Lagi</button>
                    <button type="button" class="btn btn-success" id="buttonSave"><span class="fa fa-save"></span> Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close" id="buttonCancel"><span class="fa fa-history"></span> Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
    var mr = $('#mr');
    var nik = $("#nik");
    var no_asuransi = $("#no_asuransi");
    var nama_lengkap = $('#nama_lengkap');
    var title = $('#title');
    var status_dalam_keluarga = $('#status_dalam_keluarga');
    var gender = $('#gender');
    var tempat_lahir = $('#tempat_lahir');
    var tgl_lahir = $('#tgl_lahir');
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
    var pendidikan_terakhir = $('#pendidikan_terakhir');
    var pekerjaan = $('#pekerjaan');
    var suku = $('#suku');
    var agama = $('#agama');
    var status_nikah = $('#status_nikah');
    var nama_pasangan = $('#nama_pasangan');
    var jenis_rujukan = $('#jenis_rujukan');
    var nama_asal_rujukan = $('#nama_asal_rujukan');
    var no_rujukan = $('#no_rujukan');
    var tgl_rujukan = $('#tgl_rujukan');
    var diagnose = $('#diagnose');
    var cara_bayar = $('#cara_bayar');
    var nama_penanggung = $('#nama_penanggung');
    var no_sep = $('#no_sep');
    var nama_layanan = $('#nama_layanan');
    var buttonPencarianLayanan = $('#buttonPencarianLayanan');
    var pilih_dokter = $('#pilih_dokter');
    var buttonPencarianDokter = $('#buttonPencarianDokter');
    var buttonPencarianMr = $('#buttonPencarianMr');
    var buttonPencarianNik = $('#buttonPencarianNik');
    var buttonPencarianNoKartu = $('#buttonPencarianNoKartu');


    document.getElementById('umur_d').disabled = true;

    function getAge() {

        var date = document.getElementById('tgl_lahir').value;

        if (date === "") {
            $('#umur').val('age');
        } else {
            var today = new Date();
            var birthday = new Date(date);
            var age = Math.floor((today - birthday) / (365.25 * 24 * 60 * 60 * 1000));
            $('#umur').val(age);
            $('#umur_d').val(age);
        }
    }
    mr.keyup(function(e) {
        if (e.keyCode == 13) {
            if (mr.val() == '') {
                toastr['error']("MR Wajid Di Isi!", "Warning!");
                mr.focus();
            } else {
                searchPatient();
                cara_bayar.focus();
            }
        }
    });
    nik.keyup(function(e) {
        if (e.keyCode == 13) {
            if (mr.val() == '') {
                toastr['error']("No MR Belum Di Isi!", "Warning!");
                mr.focus();
            } else if (nik.val() == '') {
                toastr['error']("NIK Wajid Di Isi!", "Warning!");
                nik.focus();
            } else {
                no_asuransi.focus();
            }
        } else if (e.keyCode == 38) {
            mr.focus();
        }
    });
    no_asuransi.keyup(function(e) {
        if (e.keyCode == 13) {
            if (nik.val() == '') {
                toastr['error']("NIK Belum Di Isi!", "Warning!");
                nik.focus();
            } else if (e.keyCode == 13) {
                nama_lengkap.focus();
            }
        } else if (e.keyCode == 38) {
            nik.focus();
        }
    });
    nama_lengkap.change(function(e) {
        if (e.keyCode == 13) {
            if (nama_lengkap.val() == '') {
                toastr['error']("Nama Lengkap Wajid Di Isi!", "Warning!");
                nama_lengkap.focus();
            } else {
                title.focus();
            }
        }
    });
    title.change(function(e) {
        if (title.val() == '') {
            toastr['error']("Title Wajid Di Isi!", "Warning!");
            title.focus();
        } else {
            status_dalam_keluarga.focus();
        }
    });
    status_dalam_keluarga.change(function(e) {
        if (status_dalam_keluarga.val() == '') {
            toastr['error']("status Wajib Dipilih!", "Warning!");
            status_dalam_keluarga.focus();
        } else {
            gender.focus();
        }
    });
    gender.change(function(e) {
        if (gender.val() == '') {
            toastr['error']("gender Wajib dipilih!", "Warning!");
            gender.focus();
        } else {
            tempat_lahir.focus();
        }
    });
    tempat_lahir.keyup(function(e) {
        if (e.keyCode == 13) {
            if (tempat_lahir.val() == '') {
                toastr['error']("Tempat Lahir Wajid di Isi!", "Warning!");
                tempat_lahir.focus();
            } else {
                tgl_lahir.focus();
            }
        }
    });
    tgl_lahir.keyup(function(e) {
        if (e.keyCode == 13) {
            if (tgl_lahir.val() == '') {
                toastr['error']("Tgl Lahir Wajib dipilih!", "Warning!");
                tgl_lahir.focus();
            } else {
                alamat_lengkap.focus();
            }
        }
    });
    alamat_lengkap.keyup(function(e) {
        if (e.keyCode == 13) {
            if (alamat_lengkap.val() == '') {
                toastr['error']("Alamat Lengkap Wajib Di Isi!", "Warning!");
                alamat_lengkap.focus();
            } else {
                desa.focus();
            }
        }
    });
    desa.keyup(function(e) {
        if (e.keyCode == 13) {
            if (desa.val() == '') {
                toastr['error']("Desa Wajib Di Isi!", "Warning!");
                desa.focus();
            } else {
                kecamatan.focus();
            }
        }
    });
    kecamatan.keyup(function(e) {
        if (e.keyCode == 13) {
            if (kecamatan.val() == '') {
                toastr['error']("kecamatan Wajib Di Isi!", "Warning!");
                kecamatan.focus();
            } else {
                kabupaten.focus();
            }
        }
    });
    kabupaten.keyup(function(e) {
        if (e.keyCode == 13) {
            if (kabupaten.val() == '') {
                toastr['error']("kabupaten Wajib Di Isi!", "Warning!");
                kabupaten.focus();
            } else {
                provinsi.focus();
            }
        }
    });
    provinsi.keyup(function(e) {
        if (e.keyCode == 13) {
            if (provinsi.val() == '') {
                toastr['error']("Provinsi Wajib Di Isi!", "Warning!");
                provinsi.focus();
            } else {
                negara.focus();
            }
        }
    });
    negara.keyup(function(e) {
        if (e.keyCode == 13) {
            if (negara.val() == '') {
                toastr['error']("Negara Wajib Di Isi!", "Warning!");
                negara.focus();
            } else {
                kode_pos.focus();
            }
        }
    });
    kode_pos.keyup(function(e) {
        if (e.keyCode == 13) {
            if (kode_pos.val() == '') {
                toastr['error']("Kode Pos Wajib Di Isi!", "Warning!");
                kode_pos.focus();
            } else {
                telp.focus();
            }
        }
    });
    telp.keyup(function(e) {
        if (e.keyCode == 13) {
            if (telp.val() == '') {
                toastr['error']("Telp Wajib Di Isi!", "Warning!");
                telp.focus();
            } else {
                hp.focus();
            }
        }
    });
    hp.keyup(function(e) {
        if (e.keyCode == 13) {
            if (hp.val() == '') {
                toastr['error']("HP Wajib Di Isi!", "Warning!");
                hp.focus();
            } else {
                pendidikan_terakhir.focus();
            }
        }
    });
    pendidikan_terakhir.change(function(e) {
        if (pendidikan_terakhir.val() == '') {
            toastr['error']("Pendidikan Terakhir Wajib Di Isi!", "Warning!");
            pendidikan_terakhir.focus();
        } else {
            pekerjaan.focus();
        }
    });
    pekerjaan.change(function(e) {
        if (pekerjaan.val() == '') {
            toastr['error']("Pekerjaan Wajib Di Isi!", "Warning!");
            pekerjaan.focus();
        } else {
            suku.focus();
        }
    });
    suku.keyup(function(e) {
        if (e.keyCode == 13) {
            if (suku.val() == '') {
                toastr['error']("Suku Wajib Di Isi!", "Warning!");
                suku.focus();
            } else {
                agama.focus();
            }
        }
    });
    agama.change(function(e) {
        if (agama.val() == '') {
            toastr['error']("Agama Wajib Di Pilih!", "Warning!");
            agama.focus();
        } else {
            status_nikah.focus();
        }
    });
    status_nikah.change(function(e) {
        if (status_nikah.val() == '') {
            toastr['error']("Status Nikah Wajib Di Isi!", "Warning!");
            status_nikah.focus();
        } else if (status_nikah.val() == 1) {
            document.getElementById('nama_pasangan').disabled = false;
            nama_pasangan.focus();
        } else {
            document.getElementById('nama_pasangan').disabled = true;
            jenis_rujukan.focus();
        }
    });
    nama_pasangan.keyup(function(e) {
        if (e.keyCode == 13) {
            if (nama_pasangan.val() == '') {
                toastr['error']("Nama Pasangan Wajib Di Isi!", "Warning!");
                nama_pasangan.focus();
            } else {
                jenis_rujukan.focus();
            }
        }
    });
    jenis_rujukan.change(function(e) {
        if (jenis_rujukan.val() == '') {
            toastr['error']("Asal Rujukan Wajib Di Isi!", "Warning!");
            jenis_rujukan.focus();
        } else if (jenis_rujukan.val() == 'DATANG SENDIRI') {
            document.getElementById('nama_asal_rujukan').disabled = true;
            no_rujukan.focus();
        } else {
            document.getElementById('nama_asal_rujukan').disabled = false;
            nama_asal_rujukan.focus();
        }
    });
    nama_asal_rujukan.keyup(function(e) {
        if (e.keyCode == 13) {
            if (nama_asal_rujukan.val() == '') {
                toastr['error']("Asal Rujukan Wajib Di Isi!", "Warning!");
                nama_asal_rujukan.focus();
            } else {
                no_rujukan.focus();
            }
        }
    });
    no_rujukan.keyup(function(e) {
        if (e.keyCode == 13) {
            if (no_rujukan.val() == '') {
                toastr['error']("No. Rujukan Wajib Di Isi!", "Warning!");
                no_rujukan.focus();
            } else {
                tgl_rujukan.focus();
            }
        }
    });
    tgl_rujukan.keyup(function(e) {
        if (e.keyCode == 13) {
            if (tgl_rujukan.val() == '') {
                toastr['error']("Tgl Rujukan Wajib Di Isi!", "Warning!");
                tgl_rujukan.focus();
            } else {
                diagnose.focus();
            }
        }
    });
    diagnose.keyup(function(e) {
        if (e.keyCode == 13) {
            if (diagnose.val() == '') {
                toastr['error']("Diagnosa Awal Wajib Di Isi!", "Warning!");
                diagnose.focus();
            } else {
                cara_bayar.focus();
            }
        }
    });
    cara_bayar.change(function(e) {
        if (cara_bayar.val() == '') {
            toastr['error']("Wajib Pilih Cara Bayar!", "Warning!");
            cara_bayar.focus();
        } else if (cara_bayar.val() == 'TUNAI') {
            var nama = nama_lengkap.val();
            nama_penanggung.val(nama);
            no_sep.focus();
        } else {
            nama_penanggung.focus();
        }
    });
    nama_penanggung.keyup(function(e) {
        if (e.keyCode == 13) {
            if (nama_penanggung.val() == '') {
                toastr['error']("Nama Penanggung Wajib di isi!", "Warning!");
                nama_penanggung.focus();
            } else {
                no_sep.focus();
            }
        }
    });
    no_sep.keyup(function(e) {
        if (e.keyCode == 13) {
            if (no_sep.val() == '') {
                toastr['error']("No SEP Wajib di isi!", "Warning!");
                no_sep.focus();
            } else {
                nama_layanan.focus();
            }
        }
    });
    nama_layanan.keyup(function(e) {
        if (e.keyCode == 13) {
            if (nama_layanan.val() == '') {
                toastr['error']("Jenis Layanan Wajib di isi!", "Warning!");
                nama_layanan.focus();
            } else {
                searchPelayanan()
                pilih_dokter.focus();
            }
        }
    });
    pilih_dokter.keyup(function(e) {
        if (e.keyCode == 13) {
            if (pilih_dokter.val() == '') {
                toastr['error']("Nama Dokter Wajib di isi!", "Warning!");
                pilih_dokter.focus();
            } else {
                searchDokter();
                buttonSaveAgain.focus();
            }
        }
    });

    function clearForm() {
        $('#mr').focus();
        $('#mr').val('');
        $("#nik").val('');
        $("#no_asuransi").val('');
        $('#nama_lengkap').val('');
        $('#title').val('');
        $('#status_dalam_keluarga').val('');
        $('#gender').val('');
        $('#tempat_lahir').val('');
        $('#tgl_lahir').val('');
        $('#umur').val('');
        $('#umur_d').val('');
        $('#alamat_lengkap').val('');
        $('#no_rumah').val('');
        $('#rt').val('');
        $('#rw').val('');
        $('#desa').val('');
        $('#kecamatan').val('');
        $('#kabupaten').val('');
        $('#provinsi').val('');
        $('#negara').val('');
        $('#kode_pos').val('');
        $('#telp').val('');
        $('#hp').val('');
        $('#pendidikan_terakhir').val('');
        $('#pekerjaan').val('');
        $('#suku').val('');
        $('#agama').val('');
        $('#status_nikah').val('');
        $('#nama_pasangan').val('');
        $('#jenis_rujukan').val('');
        $('#nama_asal_rujukan').val('');
        $('#no_rujukan').val('');
        $('#tgl_rujukan').val('');
        $('#diagnose').val('');
        $('#cara_bayar').val('');
        $('#nama_penanggung').val('');
        $('#no_sep').val('');
        $('#nama_layanan').val('');
        $('#kode_layanan').val('');
        $('#buttonPencarianLayanan').val('');
        $('#pilih_dokter').val('');
        $('#kode_dokter').val('');
        $('#buttonPencarianDokter').val('');
        $('#buttonPencarianMr').val('');
        $('#buttonPencarianNik').val('');
        $('#buttonPencarianNoKartu').val('');
    }

    function searchPatient() {
        var mr = $("#mr").val();

        // $('#buttonPencarianMr').html("<img src='assets/images/load.gif ?>' width='20' height='20'/>");
        // $("#fetchModalContent").html("");
        $.ajax({
            url: 'pages/reg/reg-patient/searchPatient.php',
            data: {
                mr: mr
            },
        }).success(function(data) {
            var json = data,
                obj = JSON.parse(json);
            // $('#nama').val(obj.nama);
            // $('#jurusan').val(obj.jurusan);
            // $('#email').val(obj.email);

            $('#mr').val(obj.mr);
            $('#nik').val(obj.nik);
            $('#nama_lengkap').val(obj.nama_lengkap);
            $('#nama_keluarga').val(obj.nama_keluarga);
            $('#title').val(obj.title);
            $('#status_dalam_keluarga').val(obj.status_dalam_keluarga);
            $('#gender').val(obj.gender);
            $('#tgl_lahir').val(obj.tgl_lahir);
            $('#umur_d').val(obj.umur);
            $('#tempat_lahir').val(obj.tempat_lahir);
            $('#alamat_lengkap').val(obj.alamat_lengkap);
            $('#desa').val(obj.desa);
            $('#kecamatan').val(obj.kecamatan);
            $('#kabupaten').val(obj.kabupaten);
            $('#provinsi').val(obj.provinsi);
            $('#negara').val(obj.negara);
            $('#kode_pos').val(obj.kode_pos);
            $('#no_hp').val(obj.no_hp);
            $('#no_telp').val(obj.no_telp);
            $('#email').val(obj.email);
            $('#telp').val(obj.telp);
            $('#suku').val(obj.suku);
            $('#pendidikan_terakhir').val(obj.pendidikan_terakhir);
            $('#agama').val(obj.agama);
            $('#pekerjaan').val(obj.pekerjaan);
            $('#status_nikah').val(obj.status_nikah);
            $('#nama_pasangan').val(obj.nama_pasangan);
            $('#golongan_darah').val(obj.golongan_darah);
            $('#golongan_darah_resus').val(obj.golongan_darah_resus);
            $('#nama_perusahaan').val(obj.nama_perusahaan);
            $('#no_pegawai').val(obj.no_pegawai);
            $('#department_pegawai').val(obj.department_pegawai);
            $('#jabatan_pegawai').val(obj.jabatan_pegawai);
            $('#nama_asuransi').val(obj.nama_asuransi);
            $('#kode_asuransi').val(obj.kode_asuransi);
            $('#no_asuransi').val(obj.no_asuransi);
            $('#kategori_cara_bayar').val(obj.kategori_cara_bayar);
            $('#status_rujukan').val(obj.status_rujukan);
            $('#jenis_rujukan').val(obj.jenis_rujukan);
            $('#nama_asal_rujukan').val(obj.nama_asal_rujukan);
            $('#tgl_rujukan_masuk').val(obj.tgl_rujukan_masuk);
            $('#waktu_rujukan_masuk').val(obj.waktu_rujukan_masuk);
            $('#diagnose').val(obj.diagnosa_saat_rujukan_masuk);
            $('#kondisi_saat_rujukan_masuk').val(obj.kondisi_saat_rujukan_masuk);
            $('#status_darurat').val(obj.status_darurat);
            $('#tgl_masuk').val(obj.tgl_masuk);
            $('#waktu_masuk').val(obj.waktu_masuk);
            $('#id_department').val(obj.id_department);
            $('#no_antrian').val(obj.no_antrian);
            $('#id_dokter').val(obj.id_dokter);
            $('#ket_tipe_pasien').val(obj.ket_tipe_pasien);
            $('#kode_tipe_pasien').val(obj.kode_tipe_pasien);
            $('#id_tipe_pasien').val(obj.id_tipe_pasien);
            $('#ket_diagnose').val(obj.ket_diagnose);
            $('#icds_diagnose').val(obj.icds_diagnose);
            $('#kode_diagnose').val(obj.kode_diagnose);
            $('#tipe_rujukan_keluar').val(obj.tipe_rujukan_keluar);
            $('#tujuan_rujukan_keluar').val(obj.tujuan_rujukan_keluar);
            $('#no_rujukan_keluar').val(obj.no_rujukan_keluar);
            $('#tgl_rujukan_keluar').val(obj.tgl_rujukan_keluar);
            $('#ket_diagnose_rujukan_keluar').val(obj.ket_diagnose_rujukan_keluar);
            $('#icds_rujukan_keluar').val(obj.icds_rujukan_keluar);
            $('#id_dpjp').val(obj.id_dpjp);
            $('#kondisi_rujukan_keluar').val(obj.kondisi_rujukan_keluar);
            $('#date_insert').val(obj.date_insert);
            $('#time_insert').val(obj.time_insert);
            $('#ts_insert').val(obj.ts_insert);
            $('#ts_update').val(obj.ts_update);
            $('#is_active').val(obj.is_active);
        });
    }

    function searchPelayanan() {
        var nama_layanan = $("#nama_layanan").val();
        $.ajax({
            url: 'pages/reg/reg-patient/searchPelayanan.php',
            data: {
                nama_layanan: nama_layanan
            },
        }).success(function(data) {
            var json = data,
                obj = JSON.parse(json);
            $('#nama_layanan').val(obj.nama_department);
            $('#kode_layanan').val(obj.kode_department);
        });
    }

    function searchDokter() {
        var nama_dokter = $("#pilih_dokter").val();
        $.ajax({
            url: 'pages/reg/reg-patient/searchDokter.php',
            data: {
                nama_dokter: nama_dokter
            },
        }).success(function(data) {
            var json = data,
                obj = JSON.parse(json);
            $('#pilih_dokter').val(obj.nama_dokter);
            $('#kode_dokter').val(obj.kode_dokter);
        });
    }

    $('#buttonSaveAgain').click(function() {
        toastr['success']("Berhasil Simpan Data " + nama_lengkap.val(), "success!");
        clearForm();
    });
</script>