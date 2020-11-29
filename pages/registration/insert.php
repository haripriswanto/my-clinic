
<?php 
  include('../../config/config.php');
  if (!empty($_SESSION['login'])) {
?>
<div class="panel-heading">
    <b>Tambah Data</b>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="buttonClose">&times;</button>
</div>
<div class="panel-body">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group" id="code">
        <label for="">No. RM <span id="message"></span></label>
        <div class="input-group">
          <input type="text" class="form-control tooltips" id="i_rm" name="i_rm" placeholder="No RM" title="Pencarian dengan RM / NIK / No. Asuransi / Nama" onkeyup="checkCodeInsert();">
          <a href="#" class="input-group-addon tooltips btn btn-primary" id="basic-addon2" title="Klik Untuk Pencarian">
              <i class="fa fa-search"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">NIK</label>
        <input type="text" class="form-control tooltips" id="i_nik" name="i_nik" placeholder="Nik" title="Nik">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">No. Asuransi</label>
        <input type="text" class="form-control tooltips" id="i_insurance_number" name="i_insurance_number" placeholder="No. Asuransi" title="No. Asuransi">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Asuransi</label>
        <select class="form-control" name="i_insurance_name" id="i_insurance_name">
          <option value="">BELUM DIPILIH</option>
          <option value="BPJS">BPJS</option>
          <option value="PRUDENTIAL">PRUDENTIAL</option>
        </select>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <label for="">Nama Lengkap</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_full_name" name="i_full_name" placeholder="Nama Lengkap" title="Nama Lengkap">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Title</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_title" name="i_title" placeholder="Title/Gelar" title="Title/Gelar">      
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Status</label>
        <select class="form-control" name="i_status" id="i_status">
          <option value="">BELUM DIPILIH</option>
          <option value="SUAMI">SUAMI</option>
          <option value="ISTRI">ISTRI</option>
          <option value="ANAK">ANAK</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Tempat Lahir</label>
        <input type="text" class="form-control tooltips" id="i_place_of_birth" name="i_place_of_birth" placeholder="Tempat Lahir" title="Tempat Lahir">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Tgl Lahir</label>
        <input type="text" class="form-control tooltips datepicker" id="i_birth_date" name="i_birth_date" placeholder="Tgl Lahir" title="Tgl Lahir">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label for="">Umur</label>
        <input type="text" class="form-control tooltips" id="i_age" name="i_age" placeholder="Umur" title="Umur" style="width:60px; margin-right:1em;">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Gender</label>
        <select class="form-control tooltips" name="i_gender" id="i_gender">
          <option value="">BELUM DIPILIH</option>
          <option value="LAKI-LAKI">LAKI-LAKI</option>
          <option value="PEREMPUAN">PEREMPUAN</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Agama</label>
        <select class="form-control tooltips" name="i_gender" id="i_gender">
          <option value="">BELUM DIPILIH</option>
          <option value="ISLAM">ISLAM</option>
          <option value="PROTESTAN">PROTESTAN</option>
          <option value="KATHOLIK">KATHOLIK</option>
          <option value="HINDU">HINDU</option>
          <option value="BUDHA">BUDHA</option>
          <option value="KONGHUCU">KONGHUCU</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Pekerjaan</label>
        <select class="form-control tooltips" name="i_employment" id="i_employment">
          <option value="">BELUM DIPILIH</option>
          <option value="NONJOB">NONJOB</option>
          <option value="WIRASWASTA">WIRASWASTA</option>
          <option value="BURUH">BURUH</option>
          <option value="PNS">PNS</option>
          <option value="PELAJAR">PELAJAR</option>
          <option value="MAHASISWA">MAHASISWA</option>
          <option value="SWASTA">SWASTA</option>
          <option value="TNI">TNI</option>
          <option value="POLRI">POLRI</option>
          <option value="PENSIUNAN">PENSIUNAN</option>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="">Alamat</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_address" name="i_address" placeholder="Alamat Lengkap" title="Alamat Lengkap">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Negara</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_country" name="i_country" placeholder="Negara" title="Negara" value="Indonesia">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Provinsi</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_province" name="i_province" placeholder="Provinsi" title="Provinsi">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Kabupaten</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_district" name="i_district" placeholder="Kabupaten" title="Kabupaten">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Kecamatan</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_sub_district" name="i_sub_district" placeholder="Kecamatan" title="Kecamatan">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Desa</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_village" name="i_village" placeholder="Desa" title="Desa">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label for="">RT</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_rt" name="i_rt" placeholder="RT" title="RT"  style="width:60px; margin-right:1em;">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label for="">RW</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_rw" name="i_rw" placeholder="rw" title="rw" style="width:60px; margin-left:0px;">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label for="">Kode Pos</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_post" name="i_post" placeholder="Kode Pos" title="Kode Pos" style="width:70px;">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Telp.</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_telp" name="i_telp" placeholder="Telp" title="Telp">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Hp</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_mobile_phone" name="i_mobile_phone" placeholder="No. Handphone" title="No. Handphone">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Rujukan Dari</label>
        <select class="form-control" name="i_referal_in_type" id="i_referal_in_type">
          <option value="">BELUM DIPILIH</option>
          <option value="DATANG SENDIRI">DATANG SENDIRI</option>
          <option value="PUEKESMAS">PUEKESMAS</option>
          <option value="KLINIK">KLINIK</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Asal Rujukan</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_referal_in_from" name="i_referal_in_from" placeholder="Asal Rujukan" title="Asal Rujukan">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">No. Rujukan</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_referal_in_letter_number" name="i_referal_in_letter_number" placeholder="No. Rujukan" title="No. Rujukan">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Tgl Rujukan</label>
        <input type="text" onkeyup="" class="form-control tooltips datepicker" id="i_referal_in_date" name="i_referal_in_date" placeholder="Tgl Rujukan" title="Tgl Rujukan">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Dx Rujukan</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_referal_in_icds" name="i_referal_in_icds" placeholder="Diagnose Awal" title="Diagnose Awal">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Nama Poli</label>
        <select class="form-control" name="i_department_descrition" id="i_department_descrition" title="Nama Poli">
          <option value="">BELUM DIPILIH</option>
          <option value="POLI GIGI">POLI GIGI</option>
          <option value="POLI KEBIDANAN">POLI KEBIDANAN</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Kode Poli</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_department_code" name="i_department_code" placeholder="Kode Poli" title="Kode Poli">
      </div>
    </div> 
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Nama Dokter</label>
          <option value="">BELUM DIPILIH</option>
        <select class="form-control tooltips" name="i_dokter_name" id="i_dokter_name" title="Nama Dokter">
        <?php $selectDokter = mysqli_query($config, "SELECT * FROM tb_master_dokter WHERE bl_state <> 'D' AND outlet_code_relation = '$system_outlet_code'"); while ($rowDokter = mysqli_fetch_array($selectDokter)){ ?>
          <option value="<?= $rowDokter['id_dokter']; ?>"><?= $rowDokter['dokter_name']; ?></option>
        <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Kode Dokter</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_dokter_code" name="i_dokter_code" placeholder="Kode Dokter" title="Kode Dokter">
      </div>
    </div>  
  </div>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Cara Bayar</label>
        <select class="form-control" name="i_bill_category" id="i_bill_category" title="Cara Bayar">
          <option value="">BELUM DIPILIH</option>
          <option value="TUNAI">TUNAI</option>
          <option value="ASURANSI">ASURANSI</option>
          <option value="PERUSAHAAN">PERUSAHAAN</option>
        </select>
      </div>
    </div>    
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Nama Penanggung</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_service_name" name="i_service_name" placeholder="Nama Perusahaan" title="Nama Perusahaan">
      </div>
    </div>  
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Kode Penanggung</label>
        <input type="text" onkeyup="" class="form-control tooltips" id="i_service_code" name="i_service_code" placeholder="Kode Perusahaan" title="Kode Perusahaan">
      </div>
    </div>   
  </div>
<div class="clearfix"><br></div>
  <div class="row">
    <div class="col-md-12">
      <legend></legend>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-4">
        <div id="resultInsert"></div>
      </div>
      <div class="col-md-8 text-right">
        <button type="submit" class="btn btn-primary buttonInsert tooltips" title="Klik untuk simpan dan clear form" id="buttonInsertAgain">Simpan Dan Isi Lagi</button>
        <button type="submit" class="btn btn-primary buttonInsert tooltips" title="Klik untuk simpan dan close form" id="buttonInsert">Simpan</button>
        <button type="button" class="btn btn-default tooltips" title="Klik untuk batal form" id="buttonCancel" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  document.getElementById('i_department_code').disabled = true;
  document.getElementById('i_dokter_code').disabled = true;
  document.getElementById('i_service_code').disabled = true;

  // datepicker
  $( function() {
    $(".datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        yearRange:"-99:+0"
      });
    }
  );

  tooltips();

  function autoCode(status){
    status = status;   
    document.getElementById('i_product_code').disabled = status;
    $('#i_product_code').focus();
    $('#i_product_code').val('');
    $("#message").html("");
    enabledInsertForm();
  }

  document.getElementById('i_product_code').disabled = true;
  // document.getElementById('selling_price').disabled = true;
  $('#i_product_name').focus();

  function checkCodeInsert() {
    var i_product_code      = $('#i_product_code').val().trim();
    var count_product_code  = $('#i_product_code').val();
    var countCode           = count_product_code.length;
    
    if(i_product_code != ''){
      if (countCode < 5) {
        disabledInsertForm();
        $.notify('Minimal kode 5 karakter');
        $('#i_product_code').focus();
      } else {
        $('#message').html('<img src="<?php echo $base_url."assets/images/load.gif" ?>" width="15" height="15"/>');
        $.ajax({
          url: '<?php echo $base_url.'pages/master/product/codeCheck.php'; ?>',
          type: 'post',
          data: {i_product_code: i_product_code},
          success: function(response){
            $('#message').html(response);
          }    
        });
      }
    }else{
        $("#message").html("");
    }
  }

  function minSellingPrice(){
    var buying                = $('#i_product_price_buy').val();
    var i_product_price_sell  = $('#i_product_price_sell').val();
    var margin                = document.getElementById('i_product_price_margin');
    var min_price             = document.getElementById('i_product_price_min');
    var max_price             = document.getElementById('i_product_price_max');

    result = parseInt(i_product_price_sell) - parseInt(buying);

    if (i_product_price_sell != '') {
      min_price.value = i_product_price_sell;
      max_price.value = i_product_price_sell;
      if (!isNaN(result)) {
        margin.value = result;
      }
    } else if (i_product_price_sell === '') {
      min_price.value = '';
      max_price.value = '';
      margin.value = '';
    }
  }

  function sumSellingPrice(){
    var buying                = $('#i_product_price_buy').val();
    var margin                = $('#i_product_price_margin').val();
    var min_price             = document.getElementById('i_product_price_min');
    var max_price             = document.getElementById('i_product_price_max');
    var i_product_price_sell  = document.getElementById('i_product_price_sell');
    var margins               = margin.length;
    var persen                = ((margin * buying)/100);

    if (margins <= 2 || margin == 100){
      result = parseInt(persen) + parseInt(buying);
    }
    else if (margins > 2 || margin != 100) {
      result = parseInt(buying) + parseInt(margin);        
    }

    if (buying != '' || margin != '') {
      min_price.value = buying;
      max_price.value = buying;
      if (!isNaN(result)) {
        i_product_price_sell.value = result;
      }
    } else if (buying === '' || margin === '') {
      min_price.value = '';
      max_price.value = '';
      i_product_price_sell.value = '';
    }
  }

  // Save product
  function saveData(){
    var i_product_code          = $('#i_product_code').val();
    var i_product_name          = $('#i_product_name').val();
    var i_product_description   = $('#i_product_description').val();
    var i_product_price_min     = $('#i_product_price_min').val();
    var i_product_price_max     = $('#i_product_price_max').val();
    var i_product_price_margin  = $('#i_product_price_margin').val();
    var i_product_price_buy     = $('#i_product_price_buy').val();
    var i_product_price_sell    = $('#i_product_price_sell').val();
    var i_product_first_stock   = $('#i_product_first_stock').val();
    var i_product_category      = $('#i_product_category').val();
    var i_product_unit          = $('#i_product_unit').val();

    var auto_code = [];
      $('#auto_code').each(function(){
        if($(this).is(":checked")){
         auto_code.push($(this).val());
        }
      });
     auto_code = auto_code.toString();

    var stockable = [];
      $('#i_product_stockable').each(function(){
        if($(this).is(":checked")){
         stockable.push($(this).val());
        }
      });
     stockable = stockable.toString();

    // Validation Form
    if ($('#auto_code').val() == '') {
      if ($('#i_product_code').val() == '') {
        $.notify("No RM Tidak Boleh Kosong!", "error");
        $('#i_product_code').focus();
      }
    }else if ($('#i_product_name').val() == '') {
      $.notify("Nama Produk Harus Diisi!", "error");
      $('#i_product_name').focus();
    }else if ($('#i_product_description').val() == '') {
      $.notify("Deskripsi Produk Harus Diisi!", "error");
      $('#i_product_description').focus();
    }else if ($('#i_product_price_buy').val() == '') {
      $.notify("Harga Beli Tidak Boleh Kosong!", "error");
      $('#i_product_price_buy').focus();
    }else if ($('#i_product_price_min').val() == '') {
      $.notify("Minimal Harga Tidak Boleh Kosong!", "error");
      $('#i_product_price_min').focus();
    }else if ($('#i_product_price_max').val() == '') {
      $.notify("Maksimal Harga Tidak Boleh Kosong!", "error");
      $('#i_product_price_max').focus();
    }else if ($('#i_product_price_margin').val() == '') {
      $.notify("Margin Tidak Boleh Kosong!", "error");
      $('#i_product_price_margin').focus();
    }else if ($('#i_product_price_sell').val() == '') {
      $.notify("Harga Jual Tidak Boleh Kosong!", "error");
      $('#i_product_price_sell').focus();
    }else if ($('#i_product_first_stock').val() == '') {
      $.notify("Stok Awal Tidak Boleh Kosong!", "error");
      $('#i_product_first_stock').focus();
    }else if ($('#i_product_category').val() == '') {
      $.notify("Pilih Kategori Produk Dulu!", "error");
      $('#i_product_category').focus();
    }else if ($('#i_product_unit').val() == '') {
      $.notify("Satuan Belum Dipilih!", "error");
      $('#i_product_unit').focus();
    }else{
      // AJAX Insert
      disabledInsertForm();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
        $.ajax({
            type:"post",
            url:"<?php echo $base_url."pages/master/product/save.php" ?>",
            data:"auto_code="+auto_code+"&i_product_code="+i_product_code+"&i_product_name="+i_product_name+"&i_product_description="+i_product_description+"&i_product_price_buy="+i_product_price_buy+"&i_product_price_min="+i_product_price_min+"&i_product_price_max="+i_product_price_max+"&i_product_price_margin="+i_product_price_margin+"&i_product_price_sell="+i_product_price_sell+"&i_product_first_stock="+i_product_first_stock+"&i_product_category="+i_product_category+"&i_product_unit="+i_product_unit+"&stockable="+stockable,
            success:function(data){
              $("#resultInsert").html(data);
            }
        });  
    }
  }

  // Save product
  function saveDataAgain(){
    var i_product_code          = $('#i_product_code').val();
    var i_product_name          = $('#i_product_name').val();
    var i_product_description   = $('#i_product_description').val();
    var i_product_price_min     = $('#i_product_price_min').val();
    var i_product_price_max     = $('#i_product_price_max').val();
    var i_product_price_margin  = $('#i_product_price_margin').val();
    var i_product_price_buy     = $('#i_product_price_buy').val();
    var i_product_price_sell    = $('#i_product_price_sell').val();
    var i_product_first_stock   = $('#i_product_first_stock').val();
    var i_product_category      = $('#i_product_category').val();
    var i_product_unit          = $('#i_product_unit').val();

    var auto_code = [];
      $('#auto_code').each(function(){
        if($(this).is(":checked")){
         auto_code.push($(this).val());
        }
      });
     auto_code = auto_code.toString();

    var stockable = [];
      $('#i_product_stockable').each(function(){
        if($(this).is(":checked")){
         stockable.push($(this).val());
        }
      });
     stockable = stockable.toString();

    // Validation Form
    if ($('#auto_code').val() == '') {
      if ($('#i_product_code').val() == '') {
        $.notify("No RM Tidak Boleh Kosong!", "error");
        $('#i_product_code').focus();
      }
    }else if ($('#i_product_name').val() == '') {
      $.notify("Nama Produk Harus Diisi!", "error");
      $('#i_product_name').focus();
    }else if ($('#i_product_description').val() == '') {
      $.notify("Deskripsi Produk Harus Diisi!", "error");
      $('#i_product_description').focus();
    }else if ($('#i_product_price_buy').val() == '') {
      $.notify("Harga Beli Tidak Boleh Kosong!", "error");
      $('#i_product_price_buy').focus();
    }else if ($('#i_product_price_min').val() == '') {
      $.notify("Minimal Harga Tidak Boleh Kosong!", "error");
      $('#i_product_price_min').focus();
    }else if ($('#i_product_price_max').val() == '') {
      $.notify("Maksimal Harga Tidak Boleh Kosong!", "error");
      $('#i_product_price_max').focus();
    }else if ($('#i_product_price_margin').val() == '') {
      $.notify("Margin Tidak Boleh Kosong!", "error");
      $('#i_product_price_margin').focus();
    }else if ($('#i_product_price_sell').val() == '') {
      $.notify("Harga Jual Tidak Boleh Kosong!", "error");
      $('#i_product_price_sell').focus();
    }else if ($('#i_product_first_stock').val() == '') {
      $.notify("Stok Awal Tidak Boleh Kosong!", "error");
      $('#i_product_first_stock').focus();
    }else if ($('#i_product_category').val() == '') {
      $.notify("Pilih Kategori Produk Dulu!", "error");
      $('#i_product_category').focus();
    }else if ($('#i_product_unit').val() == '') {
      $.notify("Satuan Belum Dipilih!", "error");
      $('#i_product_unit').focus();
    }else{
      // AJAX Insert
      disabledInsertForm();
      $("#resultInsert").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='35' height='35'/><i> Sedang Proses ...</i></center>");
      $.ajax({
          type:"post",
          url:"<?php echo $base_url."pages/master/product/saveAgain.php" ?>",
            data:"auto_code="+auto_code+"&i_product_code="+i_product_code+"&i_product_name="+i_product_name+"&i_product_description="+i_product_description+"&i_product_price_buy="+i_product_price_buy+"&i_product_price_min="+i_product_price_min+"&i_product_price_max="+i_product_price_max+"&i_product_price_margin="+i_product_price_margin+"&i_product_price_sell="+i_product_price_sell+"&i_product_first_stock="+i_product_first_stock+"&i_product_category="+i_product_category+"&i_product_unit="+i_product_unit+"&stockable="+stockable,
          success:function(data){
            $("#resultInsert").html(data);
          }
      });      
    }
  }

  $('#i_product_code').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_code').val() == '') {
        $.notify("Kode product Harus Di Isi!", "error");
        $('#i_product_code').focus();
      }else {$('#i_product_name').focus();}
    }
  });
  $('#i_product_name').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_name').val() == '') {
        $.notify("Nama product Harus Di Isi!", "error");
        $('#i_product_name').focus();
      }else {$('#i_product_description').focus();}
    }
  });$('#i_product_description').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_description').val() == '') {
        $.notify("Deskripsi product Harus Di Isi!", "error");
        $('#i_product_description').focus();
      }else {$('#i_product_price_buy').focus();}
    }
  });
  $('#i_product_price_buy').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_buy').val() == '') {
        $.notify("Harga Beli Tidak Boleh Kosong!", "error");
        $('#i_product_price_buy').focus();
      }else {$('#i_product_price_margin').focus();}
    }
  });
  $('#i_product_price_margin').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_margin').val() == '') {
        $.notify("Margin Tidak Boleh Kosong!", "error");
        $('#i_product_price_margin').focus();
      }else {$('#i_product_price_sell').focus();}
    }
  });
  $('#i_product_price_sell').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_sell').val() == '') {
        $.notify("Harga Jual Tidak Boleh Kosong!", "error");
        $('#i_product_price_sell').focus();
      }else {$('#i_product_price_min').focus();}
    }
  });
  $('#i_product_price_min').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_min').val() == '') {
        $.notify("minimal Harga Tidak Boleh Kosong!", "error");
        $('#i_product_price_min').focus();
      }else {$('#i_product_price_max').focus();}
    }
  });
  $('#i_product_price_max').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_price_max').val() == '') {
        $.notify("Maksimal Harga Tidak Boleh Kosong!", "error");
        $('#i_product_price_max').focus();
      }else {$('#i_product_first_stock').focus();}
    }
  });
  $('#i_product_first_stock').keyup(function(e) {
    if(e.keyCode == 13) {
      if ($('#i_product_first_stock').val() == '') {
        $.notify("Margin Tidak Boleh Kosong!", "error");
        $('#i_product_first_stock').focus();
      }else {$('#i_product_category').focus();}
    }
  });
  $('#i_product_category').change(function(e) {
    if ($('#i_product_category').val() == '') {
      $.notify("Kategori Produk Harus Dipilih!", "error");
      $('#i_product_category').focus();
    }else {$('#i_product_unit').focus();}
  });
  $('#i_product_unit').change(function(e) {
    if ($('#i_product_unit').val() == '') {
      $.notify("Satuan Produk Harus Dipilih!", "error");
      $('#i_product_unit').focus();
    }else {$('#i_product_stockable').focus();}
  });
  $('#i_product_stockable').keyup(function(e) {
    if(e.keyCode == 13) {
      {$('#buttonInsertAgain').focus();}
    }
  });
  $('#buttonInsert').click(function(e) {
    saveData();
  });
  $('#buttonInsertAgain').click(function(e) {
    saveDataAgain();
  });

  // tooltips();

</script>

<?php 
}
elseif (empty($_SESSION['login'])) {
    ?>
    <script type="text/javascript">
        alert("sesi anda habis, silahkan login kembali");
        window.location="<?php echo $base_url."" ?>";
    </script>
<?php
}
?>