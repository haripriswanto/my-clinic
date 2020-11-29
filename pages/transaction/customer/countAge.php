<?php

// include 'config.php';

if(isset($_POST['customer_birthday'])){
    $customer_birthday = $_POST['customer_birthday'];
    
    $tanggal = new DateTime($customer_birthday);
    $today 	= new DateTime('today');
    $years 	= $today->diff($tanggal)->y;
    $months = $today->diff($tanggal)->m;
    $days 	= $today->diff($tanggal)->d;

    echo $years." Th ".$months." Bln ".$days." Hr ";
    die;
}
