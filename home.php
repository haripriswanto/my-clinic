<?php 
include('config/config.php'); 
include('assets/plugin/fpdf/fpdf.php');

if (!empty($_SESSION['login'])) {
function angka_pembulatan($angka,$digit,$minimal){
    $digitvalue   = substr($angka, -($digit));    
    $bulat        = 0;
    $nolnol       = "";

    for($i=1; $i<=$digit; $i++){
        $nolnol = "0";
        // echo $digitvalue;
    }
    if($digitvalue < $minimal && $digit != $nolnol){      
        $x1     = $minimal - $digitvalue;
        $bulat  = $angka + $x1;
    }else{
        $bulat = $angka;
    }
    return $bulat;  
}
// SESSION USER
$id_user = $_SESSION['login']['id_user'];
$selectUser = "SELECT * FROM tb_system_user WHERE id_user = '$id_user' ";
$querySelectUser = mysqli_query($config, $selectUser);
$rowUser = mysqli_fetch_array($querySelectUser);

// SESSION ROLE ACCESS
$roleId = $_SESSION['login']['access_level'];

?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    function numberOnly(e) {
      if (!/^[0-9]+$/.test(e.value)) {
        e.value = e.value.substring(0,e.value.length-1);
      }
    }
</script>
<head>

    <meta charset="utf-8">
    <link rel="icon" href="<?php echo $base_url."assets/images/store.png" ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $system_title; ?></title>

    <link href="<?php echo $base_url."assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css" ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url."assets/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/jquery-ui/jquery-ui.css" ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo $base_url."assets/css/bootstrap-select.min.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/css/timeline.css" ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $base_url."assets/css/style.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/bower_components/metisMenu/dist/metisMenu.min.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/dist/css/sb-admin-2.css" ?>" rel="stylesheet">
    <link href="<?php echo $base_url."assets/css/toastr.min.css" ?>" rel="stylesheet">

    <script src="<?php echo $base_url."assets/bower_components/jquery/dist/jquery.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/bower_components/raphael/raphael-min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/bower_components/morrisjs/morris.min.js" ?>"></script>
    <!-- <script src="<?php echo $base_url."assets/js/notify.js" ?>"></script> -->
    <script src="<?php echo $base_url."assets/js/sweetalert.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/printjs/print.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/js/chart.js" ?>"></script>
    <script src="<?php echo $base_url."assets/js/toastr.min.js" ?>"></script>

<style type="text/css" media="screen">
    .close{
        color: #ffffff;
    }
    .close::hover{
        color: #ffffff;
    }
    body{
        font-size: 11px;
    }
    /*.form-control{
        height:3%;
        margin-top:0%;
    }
    .form-group{
        margin: 2px;
    }*/
</style>


</head>
<body onload="tampilkanwaktu(); setInterval('tampilkanwaktu()', 1000);">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $base_url."home" ?>"><?php echo $system_header; ?></a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                    <div align="center">
                        <script type="text/javascript">
                            function tampilkanwaktu() {
                                var waktu = new Date();
                                var sh = waktu.getHours() + "";
                                var sm = waktu.getMinutes() + "";
                                var ss = waktu.getSeconds() + "";
                                document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
                            }
                        </script>
                        <i class="fa fa-calendar"></i> 
                        <span><?php echo $hari.", ". $tgl." ".$bln." ".$thn ?></span>
                        <i class="fa fa-clock-o"></i> 
                        <span id="clock"></span> 
                    </div>
                    </a>
                </li>
                <!-- /.Setting -->
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell-o fa-fw"></i> <b id="totalNotify"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts" id="notify">
                        
                    </ul>
                </li> -->
                <style type="text/css">
                    .label-danger{
                      border-radius: 70px;
                      padding: 6px;
                      font-size: 8px;
                    }
                </style>
                
                <?php 
                    $selectAccessTopMenu = "SELECT tb_system_menu.id, tb_system_menu.menu_description
                                FROM tb_system_menu INNER JOIN tb_system_access_menu
                                ON tb_system_menu.id = tb_system_access_menu.menu_id 
                                WHERE tb_system_access_menu.role_id = '$roleId' 
                                AND tb_system_menu.type_menu = 'top-bar'
                                AND tb_system_menu.is_active = 'A'
                                ORDER BY sort_menu ASC
                    ";
                    // var_dump($selectAccessTopMenu);
                    $querySelectAccessTopMenu = mysqli_query($config, $selectAccessTopMenu);
                    while($rowSelectAccessTopMenu = mysqli_fetch_array($querySelectAccessTopMenu)){
                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-sliders fa-fw"></i> System <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo $base_url."user" ?>"><i class="fa fa-user-o fa-fw"></i> System User</a></li>
                        <li><a href="<?php echo $base_url."user-role" ?>"><i class="fa fa-building fa-fw"></i> System Role Akses</a></li>                    
                        <li><a href="<?php echo $base_url."menu" ?>"><i class="fa fa-list fa-fw"></i> System Menu</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-cogs fa-fw"></i> Setup <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo $base_url."setting" ?>"><i class="fa fa-wrench fa-fw"></i> Setting</a></li>
                    </ul>
                </li>
            <?php } ?>
            
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-blind fa-fw"></i> Aktif Department <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    <?php 
                        $selectDepartmentAccess = "SELECT tb_system_department.id, tb_system_department.department_description, tb_system_department.department_code
                            FROM tb_system_department INNER JOIN tb_system_access_menu
                            ON tb_system_department.id = tb_system_access_menu.department_id 
                            WHERE tb_system_access_menu.role_id = '$roleId'
                            AND tb_system_department.is_active = 'A'
                            ORDER BY sort_field ASC
                        ";
                            // var_dump($selectDepartmentAccess);
                            $querySelectDepartmentAccess = mysqli_query($config, $selectDepartmentAccess);
                            while($rowSelectDepartmentAccess = mysqli_fetch_array($querySelectDepartmentAccess)){
                        ?>
                            <li><a href="<?php echo $base_url.$rowSelectDepartmentAccess['department_code'] ?>"><i class="fa fa-user-o fa-fw"></i> <?= $rowSelectDepartmentAccess['department_description']; ?></a></li>
                        <?php } ?>
                    </ul>
                </li> -->
            
                <!-- /.Session -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-android fa-fw"></i> <?php echo $rowUser['user_full_name']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" data-toggle="modal" data-id="<?= $rowUser['user_full_name']; ?>" data-target="#clickProfile" data-backdrop="static" data-keyboard="false"><i class="fa fa-user-circle fa-fw"></i> Profil</a>
                        <li><a href="#" data-toggle="modal" data-target="#buttonLogout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo $base_url."home" ?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <?php 
                            $selectAccessMenu = "SELECT tb_system_menu.id, tb_system_menu.menu_description, tb_system_menu.menu_url, tb_system_menu.menu_icon
                                        FROM tb_system_menu INNER JOIN tb_system_access_menu
                                        ON tb_system_menu.id = tb_system_access_menu.menu_id 
                                        WHERE tb_system_access_menu.role_id = '$roleId'
                                        AND tb_system_menu.type_menu = 'side-bar'
                                        AND tb_system_menu.is_active = 'A'
                                        ORDER BY sort_menu ASC
                            ";
                            // var_dump($selectAccessMenu);
                            $querySelectAccessMenu = mysqli_query($config, $selectAccessMenu);
                            while($rowSelectAccessMenu = mysqli_fetch_array($querySelectAccessMenu)){
                        ?>
                        <li>
                        <!-- <?= $rowSelectAccessMenu['menu_description']; if($rowSelectAccessMenu['menu_description'] == 'home'){ ?>
                            <a href="#"><i class="fa-fw fa fa-<?= $rowSelectAccessMenu['menu_icon']; ?>"></i> <?= $rowSelectAccessMenu['menu_description']; ?> <span class="fa arrow"></span></a>
                        <?php } else{ ?> -->
                            <a href="#"><i class="fa-fw fa fa-<?= $rowSelectAccessMenu['menu_icon']; ?>"></i> <?= $rowSelectAccessMenu['menu_description']; ?> <span class="fa arrow"></span></a>
                        <!-- <?php } ?> -->
                            <ul class="nav nav-second-level">
                            <?php 
                                $menu_id = $rowSelectAccessMenu['id'];
                                $selectSubMenu = "SELECT *
                                            FROM tb_system_menu INNER JOIN tb_system_sub_menu
                                            ON tb_system_menu.id = tb_system_sub_menu.menu_id 
                                            WHERE tb_system_sub_menu.menu_id = '$menu_id' 
                                            AND tb_system_sub_menu.is_active = 'A'
                                            ORDER BY tb_system_sub_menu.sub_menu_sort ASC
                                ";
                                $querySelectSubMenu = mysqli_query($config, $selectSubMenu);
                                while($rowseSectSubMenu = mysqli_fetch_array($querySelectSubMenu)){
                            ?>
                                <li>
                                    <a href="<?php echo $base_url.$rowseSectSubMenu['sub_menu_url']; ?>"><i class=" fa-fw fa fa-<?= $rowseSectSubMenu['sub_menu_icon']; ?>"></i> <?= $rowseSectSubMenu['sub_menu_description']; ?></a>
                                </li>
                            <?php } ?>                                
                            </ul>
                        </li>
                        <?php } ?>
                        <li class="text-center">
                            <i class="text-center">&copy;Copyright <?php echo date('Y') ?> <a href="#" title="">RII</a> V.1.0</i>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <?php include("content.php"); ?>
        </div>
    </div>

    <!-- <script src="<?php echo $base_url."assets/js/bootstrap3-typeahead.min.js" ?>"></script> -->
    <script src="<?php echo $base_url."assets/bower_components/bootstrap/dist/js/bootstrap.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/bower_components/metisMenu/dist/metisMenu.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/bower_components/datatables/media/js/jquery.dataTables.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js" ?>"></script>
    <script src="<?php echo $base_url."assets/bower_components/datatables-responsive/js/dataTables.responsive.js" ?>"></script>
    <script src="<?php echo $base_url."assets/dist/js/sb-admin-2.js" ?>"></script>
    <script src="<?php echo $base_url."assets/jquery-ui/jquery-ui.js" ?>"></script>
    <script src="<?php echo $base_url."assets/ajax/controller-dashboard.js" ?>"></script>

<?php 
    $CheckSystemSetting =  mysqli_query($config, "SELECT * FROM tb_system_setting ");
    $check_qty = mysqli_num_rows($CheckSystemSetting);

    if ($check_qty < 1) { 
?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#systemInsertNotify').modal('show');
        });
    </script>

    <!-- Insert Page -->
    <div class="modal fade" id="systemInsertNotify">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Warning!
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </h3>
                  </div>
                    <div class="panel-body text-center">
                        <h5>Sistem Setting Belum di Ubah, Silahkan klik menu setting lalu input data setting untuk melanjutkan Transaksi lainnya.</h5>
                        <div class="modal-footer">
                            <a href="<?php echo $base_url."setting" ?>" class="btn btn-success"><span class="fa fa-wrench"></span> Setting</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

</body>
</html>

<div class="modal fade" id="buttonLogout">
    <div class="modal-dialog">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <b>Notifikasi!</b>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="panel-body" id="contentProgress">
                <h3>Klik Logout Untuk Keuar.</h3>
                <legend></legend>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                <a id="clickLogout" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- NOTIFICATION POPUP -->
<!-- <div class="modal fade bs-example-modal-lg" id="notification_popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
        <div class="panel-body fetched-data">
        </div>
  </div>
</div> -->

<!-- Profile Page -->
<div class="modal fade bd-example-modal-lg" id="clickProfile" aria-hidden="true">
  <div class="modal-dialog modal-lg">
        <div class="panel panel-primary" id="fetchDataProfile"></div>
    </div>
</div>
<script type="text/javascript">

	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": true,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "200",
	  "hideDuration": "900",
	  "timeOut": "4000",
	  "extendedTimeOut": "900",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}

  //Profile Controller
  $('#clickProfile').on('show.bs.modal', function (e) {
      var id_profile = $(e.relatedTarget).data('id');
      // LOADING
      $('#fetchDataProfile').html('<center><img src="<?php echo $base_url."assets/images/load.gif" ?>" width="50" height="50"/><i> Sedang Proses ...</i></center>');
      $.ajax({
          type : 'post',
          url : '<?php echo $base_url."pages/profile/profile.php"; ?>',
          data :  'id_profile='+id_profile,
          success : function(data){
          $('#fetchDataProfile').html(data); //menampilkan data ke dalam modal
          }
      });
   });


    function logoutSession(){
      $("#contentProgress").html("<center><img src='<?php echo $base_url."assets/images/load.gif" ?>' width='50' height='50'/><i> Sedang Proses ...</i></center>");
      $("#contentProgress").load('<?php echo $base_url."pages/login/logout-validate.php" ?>');
    }

    $("#clickLogout").click(function(event) {
        logoutSession();
    });

    // ubah password
    function disabledPassword(){
      document.getElementById("oldPassword").disabled = true;
      document.getElementById("newPassword").disabled = true;
      document.getElementById("password").disabled = true;
      document.getElementById("buttonPassword").disabled = true;
      // document.getElementById("buttonCancelPassword").disabled = true;
    }
    // ubah password
    function enabledPassword(){
      document.getElementById("oldPassword").disabled = false;
      document.getElementById("newPassword").disabled = false;
      document.getElementById("password").disabled = false;
      document.getElementById("buttonPassword").disabled = false;
      // document.getElementById("buttonCancelPassword").disabled = false;
    }
    function tooltips(){
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
    }

    tooltips();

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