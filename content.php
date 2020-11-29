<?php 

	if(isset($_GET['page'])){
		$page = $_GET['page'];

		$pageName = str_replace("-"," ", $page);
		switch ($page) {
			case '':
				include "pages/home.php";
				break;
			case 'home':
				include "pages/home.php";
				break;
			case 'dashboard':
				include "pages/dashboard.php";
				break;

			// ****************** Master ****************** //
			case 'product':
				include "pages/master/product/index.php";
				break;
			case 'category':
				include "pages/master/category/index.php";
				break;
			case 'unit':
				include "pages/master/unit/index.php";
				break;
			case 'supplier':
				include "pages/master/supplier/index.php";
				break;
			case 'customer':
				include "pages/master/customer/index.php";
				break;
			case 'dokter':
				include "pages/master/dokter/index.php";
				break;

			// ****************** TRANSACTION ****************** //
			case 'penjualan':
				include "pages/transaction/selling/index.php";
				break; 

			case 'review-penjualan':
				include "pages/transaction/selling/preview/index.php";
				break;

			case 'pembelian':
				include "pages/transaction/buying/index.php";
				break;

			case 'review-pembelian':
				include "pages/transaction/buying/preview/index.php";
				break;

			case 'stok-opname':
				include "pages/transaction/stock-opname/index.php";
				break;

			// ****************** SETTING ****************** //
			case 'user':
				include "pages/setting/user/index.php";
				break;

			case 'setting':
				include "pages/setting/system/index.php";
				break;

			case 'menu':
				include "pages/setting/menu/index.php";
				break;
				
			case 'sub-menu':
				include "pages/setting/sub-menu/index.php";
				break;

			case 'user-role':
				include "pages/setting/user-role/index.php";
				break;

			// ****************** REGISTRATION ****************** //
			// 
			case 'reg-patient':
				include "pages/reg/reg-patient/index.php";
				break;

			// ****************** REPORT ****************** //
			case 'laporan-penjualan':
				include "pages/report/selling/index.php";
				break;
			case 'laporan-pembelian':
				include "pages/report/buying/index.php";
				break;
			case 'aktifitas':
				include "pages/report/log-activity/index.php";
				break;
			case 'laporan-stok':
				include "pages/report/stock/index.php";
				break;
				
	
			// ****************** Error Notify ****************** //		
			default:
				include "pages/404.php";
				break;
			}
	}
	 ?>