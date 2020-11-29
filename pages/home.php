<style type="text/css">
    a{cursor: pointer;}
</style>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Home</h1>
        <span id="showExecuteDeleteCartSelling"></span>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo "$ucapan"; if ($rowUser['user_gender'] == 1) { echo " Mr. ";} elseif ($rowUser['user_gender'] == 2) { echo " Mrs. ";} ?> 
                <b class="full_name tooltips" title="Klik Untuk membuka Profile <?php echo $rowUser['user_full_name']; ?>" data-toggle="modal" data-id="<?php echo $_SESSION['login']['id_user'] ?>" data-target="#clickProfile"><?php echo $rowUser['user_full_name']; ?></b></h3>
            </div>
            <div class="panel-body">
                <h2><?php echo $system_dashboard_text; ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="chat-panel panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-bell-o fa-fw"></i>
                Notifikasi Produk Stok <span id="countHeader"><i class='label label-info' id="countHeaders"></i></span>
                <div class="btn-group pull-right">
                    <button id="buttonShowProductStock" class="btn btn-success btn-xs tooltips" title="Klik Untuk Refresh">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="panel-body" id="showProductStock">
                <!-- Show Content -->
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control input-sm"
                           placeholder="Pencarian Ketik Kode/Nama Produk ..." id="txtStock"/>
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-sm" id="buttonTxtStock">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="chat-panel panel panel-success">
            <div class="panel-heading">
                <i class="fa fa-bell-o fa-fw"></i>
                Notifikasi Produk Expired
                <div class="btn-group pull-right">
                    <button id="buttonShowProductExpired" class="btn btn-success btn-xs tooltips" title="Klik Untuk Refresh">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="panel-body" id="showProductExpired">
                <!-- Show Content -->
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control input-sm"
                           placeholder="Pencarian Ketik Nama Produk ..." id="txtExpired" />
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-sm" id="buttonTxtExpired">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $base_url."pages/dashboard/js/controller.js"; ?>"></script>
