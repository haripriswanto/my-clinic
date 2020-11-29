
<?php 
  include('../../../config/config.php');
?>

  <form id="buyingFilterReport" action="pages/report/buying/printing.php" target="_blank" method="POST" role="form"> 
        <h3>Filter Laporan</h3>
        <legend></legend>
      <div class="col-md-12"> 
        <div class="form-group">
            <label>Jenis Laporan</label>
            <select name="report_type" id="report_type" class="form-control tooltips" title="Jenis Laporan">
              <option value="">-- Pilih --</option>
              <option value="1">Laporan Pembelian</option>
              <option value="2">Laporan Pembelian Detail</option>
              <option value="3">Laporan Pembelian Per Produk</option>
          </select>
        </div>
      </div>
      <div class="col-md-8"> 
        <div class="form-group">
            <label>Tanggal Awal</label>
            <input type="text" class="form-control tooltips datepicker" name="in_date_report" id="in_date_report" title="Pilih Tanggal Awal" placeholder="Pilih Tanggal Awal">
        </div>
      </div>
      <div class="col-md-4"> 
        <div class="form-group">
            <label>Pukul</label>
            <input type="time" class="form-control tooltips" name="in_time_report" id="in_time_report" title="Waktu" value="00:00:00">
        </div>
      </div>
      <div class="col-md-8"> 
        <div class="form-group">
            <label>Tanggal Akhir</label>
            <input type="text" class="form-control tooltips datepicker" name="out_date_report" id="out_date_report" title="Pilih Tanggal Akhir" placeholder="Pilih Tanggal Akhir">
        </div>
      </div>
      <div class="col-md-4"> 
        <div class="form-group">
            <label>Pukul</label>
            <input type="time" class="form-control tooltips" name="out_time_report" id="out_time_report" title="Waktu" value="23:59:59">
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">             
        <div class="form-group">
            <label>Kategori</label>
            <select name="product_category" id="product_category" class="form-control tooltips" title="Jika Kategori Kosong Maka Muncul Semua Kategori Produk">
              <option value="">-- Pilih --</option>
              <?php 
              $queryCategory = mysqli_query($config, "
                SELECT tb_master_category.* FROM tb_master_category 
                WHERE tb_master_category.bl_state='A' 
                ORDER BY tb_master_category.category_description ASC");

                while ($rowCategory = mysqli_fetch_array($queryCategory)) {
               ?>
              <option value="<?php echo $rowCategory['category_code'] ?>"><?php echo $rowCategory['category_description'] ?></option>
            <?php } ?>
          </select>
        </div>   
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">             
        <div class="form-group">
            <label>Produk</label>
            <select name="product_name" id="product_name" class="form-control tooltips" title="Jika Nama Produk Kosong Maka Muncul Semua Nama Produk">
              <option value="">-- Pilih Kategori Dahulu --</option>
            </select>
        </div>   
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">             
        <div class="form-group">
            <label>Nama Kasir</label>
            <select name="casier_name" id="casier_name" class="form-control tooltips" title="Jika Nama Kasir Kosong Maka Muncul Semua Kasir" >
              <option value="">-- Pilih --</option>
              <?php 
              $queryUser = mysqli_query($config, "SELECT * FROM tb_user 
                                            WHERE is_active = '1'  
                                            ORDER BY full_name ASC");

                while ($rowUser = mysqli_fetch_array($queryUser)) {
               ?>
              <option value="<?php echo $rowUser['user_name'] ?>"><?php echo $rowUser['full_name'] ?></option>
            <?php } ?>
          </select>
        </div>   
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
        <legend></legend>
        <div class="col-md-6"> 
          <div id="result"></div>
        </div>
        <div class="col-md-6 text-right">
          <button type="submit" class="btn btn-success" name="excel" id="buttonExcel"><span class="fa fa-file-excel-o"></span> Excel</button>
          <button type="submit" class="btn btn-primary" name="preview" id="buttonPreview"><span class="fa fa-eye"></span> Preview</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>

<script type="text/javascript">

    $( ".tooltips" ).tooltip({
      show: {
        effect: "slideDown",
        delay: 150
      }, 
      hide: {
        effect: "fold",
        delay: 150
      },
      show: null,
      position: {
        my: "left top",
        at: "left bottom"
      },
      open: function( event, ui ) {
        ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
      }
    });

    // datepicker
    $( function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange:"-10:+10"
          });
        }
    );
      
    function fetch_select(val){
        $.ajax({
        type: 'get',
        url: 'pages/report/buying/product_select.php',
        data: {
        get_option:val
        },
          success: function (response) {
            document.getElementById("product_name").innerHTML = response; 
          }
        });
    }

    // DISABLE CUSTOM
     $(document).ready(function() {
          // Kondisi saat Form di-load
          if ($("#report_type").val() == "") {
              $('#in_date_report').attr('disabled','disabled'); 
              $('#out_date_report').attr('disabled','disabled');
              $('#in_time_report').attr('disabled','disabled');
              $('#out_time_report').attr('disabled','disabled');
              $('#payment_type').attr('disabled','disabled');
              $('#casier_name').attr('disabled','disabled');
              $('#product_category').attr('disabled','disabled');
              $('#product_name').attr('disabled','disabled');

              // Empty Form
              $('#payment_type').val('');
              $('#casier_name').val('');
              $('#in_date_report').val('');
              $('#out_date_report').val('');
              $('#payment_type').val('');
              $('#casier_name').val('');
              $('#product_category').val('');
              $('#product_name').val('');
              $('#report_type').focus();
          } 
          // Kondisi saat ComboBox (Select Option) dipilih nilainya
          $("#report_type").change(function() {
            if (this.value == "1") {
                $('#in_date_report').removeAttr('disabled'); 
                $('#out_date_report').removeAttr('disabled');
                $('#in_time_report').removeAttr('disabled');
                $('#out_time_report').removeAttr('disabled');
                $('#payment_type').removeAttr('disabled');
                $('#casier_name').removeAttr('disabled');
                $('#product_category').attr('disabled','disabled');
                $('#product_name').attr('disabled','disabled');
                $('#in_date_report').value('<?php echo $currentDate; ?>'); 

                // Empty Form
                $('#payment_type').val('');
                $('#casier_name').val('');
                $('#in_date_report').focus();
            } 
            else if (this.value == "2") {
                $('#in_date_report').removeAttr('disabled'); 
                $('#out_date_report').removeAttr('disabled');
                $('#in_time_report').removeAttr('disabled');
                $('#out_time_report').removeAttr('disabled');
                $('#payment_type').removeAttr('disabled');
                $('#casier_name').removeAttr('disabled');
                $('#product_category').attr('disabled','disabled');
                $('#product_name').attr('disabled','disabled');
                
                $('#payment_type').val('');
                $('#casier_name').val('');
                $('#payment_type').val('');
                $('#casier_name').val('');
                $('#product_category').val('');
                $('#product_name').val('');
                $('#in_date_report').focus();
            }  
            else if (this.value == "3") {
                $('#in_date_report').removeAttr('disabled'); 
                $('#out_date_report').removeAttr('disabled');
                $('#in_time_report').removeAttr('disabled');
                $('#out_time_report').removeAttr('disabled');
                $('#product_category').removeAttr('disabled');
                $('#product_name').removeAttr('disabled');
                $('#payment_type').attr('disabled','disabled');
                $('#casier_name').attr('disabled','disabled');
                
                $('#payment_type').val('');
                $('#casier_name').val('');
                $('#payment_type').val('');
                $('#casier_name').val('');
                $('#product_category').val('');
                $('#product_name').val('');
                $('#in_date_report').focus();
            }
            else if (this.value == "") {
                $('#in_date_report').attr('disabled','disabled'); 
                $('#out_date_report').attr('disabled','disabled');
                $('#in_time_report').attr('disabled','disabled');
                $('#out_time_report').attr('disabled','disabled');
                $('#payment_type').attr('disabled','disabled');
                $('#casier_name').attr('disabled','disabled');
                $('#product_category').attr('disabled','disabled');
                $('#product_name').attr('disabled','disabled');

                $('#payment_type').val('');
                $('#casier_name').val('');
                $('#in_date_report').val('');
                $('#out_date_report').val('');
                $('#payment_type').val('');
                $('#casier_name').val('');
                $('#product_category').val('');
                $('#product_name').val('');
                $('#in_time_report').val('00:00:00');
                $('#out_time_report').val('23:59:59');
                $('#report_type').focus();
            }
          });
      });

    $('#in_date_report').keyup(function(e) {
      if (e.keyCode == 13) {
        if ($('#in_date_report').val() == '') {
          $.notify('Tanggal Awal Harus Dipilih', 'error')
          $('#in_date_report').focus();
        }else{
          $('#out_date_report').focus();
        }
      }
    });

    $('#out_date_report').keyup(function(e) {
      if (e.keyCode == 13) {
        if ($('#out_date_report').val() == '') {
          $.notify('Tanggal akhir Harus Dipilih', 'error')
          $('#out_date_report').focus();
        }else{
          $('#buttonPreview').focus();
        }
      }
    });

    $('#product_name').change(function(e) {
        $('#buttonPreview').focus();
    });

    $('#buttonExcel').click(function(event) {
      if ($('#report_type').val() == '') {
        $.notify('Pilih Jenis Laporan', 'error');
        $('#report_type').focus();
      }else if ($('#in_date_report').val() == '') {
        $.notify('Pilih Tanggal Awal', 'error');
        $('#in_date_report').focus();
      }else if ($('#out_date_report').val() == '') {
        $.notify('Pilih Tanggal Akhir', 'error');
        $('#out_date_report').focus();
      }
    });

    $('#buttonPreview').click(function(event) {
      if ($('#report_type').val() == '') {
        $.notify('Pilih Jenis Laporan', 'error');
        $('#report_type').focus();
      }else if ($('#in_date_report').val() == '') {
        $.notify('Pilih Tanggal Awal', 'error');
        $('#in_date_report').focus();
      }else if ($('#out_date_report').val() == '') {
        $.notify('Pilih Tanggal Akhir', 'error');
        $('#out_date_report').focus();
      }
    });

    $(document).ready(function() {
      $('#product_category').change(function() { 
        var product_category = $(this).val(); 
        $.ajax({
          type: 'GET', 
          url: '<?php echo $base_url."pages/report/buying/product_select.php" ?>', 
          data: 'product_category=' + product_category, 
          success: function(response) { 
            $('#product_name').html(response); 
            $('#product_name').focus();
          }
        });
      });
    });
</script>
