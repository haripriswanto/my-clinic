
                    <?php if (!empty($_SESSION['login']['access_level'] == '1')) { ?>
                        <li>
                            <a href="#"><i class="fa fa-id-card-o fa-fw"></i> Pendaftaran <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $base_url."poly" ?>"><i class="fa fa-stethoscope fa-fw"></i> klinik</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-medkit fa-fw"></i> E Rekam Medis <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $base_url."tindakan" ?>"> Tindakan</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."soap" ?>"> S O A P</a>
                                </li>
                            </ul>
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Kasir <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $base_url."registPayment" ?>"> Bayar Pendaftaran</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."actionPayment" ?>"> Bayar Tindakan</a>
                                </li>
                            </ul>
                        </li> 
                        <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Master <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $base_url."product-medical" ?>">Tindakan Medis</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."product" ?>">Obat</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."category" ?>">Kategori</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."unit" ?>">Satuan</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."supplier" ?>">Supplier</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."customer" ?>">Customer</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."dokter" ?>">Dokter</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-database fa-fw"></i> Stok Opname <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li>
                                    <a href="<?php echo $base_url."stock-opname" ?>">Stok</a>
                                </li>
                            </ul>
                        </li>
                    <?php }  ?>
                        <li>
                            <a href="#"><i class="fa fa-cart-arrow-down fa-fw"></i> Pembelian<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $base_url."pembelian" ?>">Pembelian</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."review-pembelian" ?>">Review Pembelian</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Penjualan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $base_url."penjualan" ?>">Penjualan</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."review-penjualan" ?>">Review Penjualan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-print fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <?php if (!empty($_SESSION['login']['access_level'] == '1')) { ?>
                                <li>
                                    <a href="<?php echo $base_url."laporan-penjualan" ?>">Penjualan</a>
                                </li>
                                <li>
                                    <a href="<?php echo $base_url."laporan-pembelian" ?>">Pembelian</a>
                                </li>
                            <?php } ?>
                                <li>
                                    <a href="<?php echo $base_url."laporan-stok" ?>">Stok</a>
                                </li>
                            <?php if (!empty($_SESSION['login']['access_level'] == '1')) { ?>
                                <li>
                                    <a href="<?php echo $base_url."aktifitas" ?>">Log Aktifitas</a>
                                </li>
                            <?php } ?>
                            </ul>
                        </li>