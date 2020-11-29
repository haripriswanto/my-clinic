<?php 

	if(isset($_GET['page'])){
		$page = $_GET['page'];

		$pageName = str_replace("-"," ", $page);
		switch ($page) {
			case '':
				include "pages/dashboard.php";
				break;
			case 'dashboard':
				include "pages/dashboard.php";
				var_dump($rowSelectDepartmentAccess[department_code]);
				break;

			// Query Select Menu
			$selectDepartmentAccess = "SELECT tb_system_department.id, tb_system_department.department_description, tb_system_department.module_directory
				FROM tb_system_department INNER JOIN tb_system_access_menu
				ON tb_system_department.id = tb_system_access_menu.department_id 
				WHERE tb_system_access_menu.role_id = '$roleId'
				AND tb_system_department.is_active = 'A'
				ORDER BY sort_field ASC
				";
				$querySelectDepartmentAccess = mysqli_query($config, $selectDepartmentAccess);
				$rowSelectDepartmentAccess = mysqli_fetch_array($querySelectDepartmentAccess);
				
				var_dump($rowSelectDepartmentAccess[department_code]);exit;

			case '".$rowSelectDepartmentAccess[department_code]."':
				include "pages/".$rowSelectDepartmentAccess['module_directory']."/product/index.php";
				break;
	
			// ****************** Error Notify ****************** //		
			default:
				include "pages/404.php";
				break;
			}
	}
	 ?>