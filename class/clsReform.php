<?php

$today = time();
$alertDate = "2023-07-30";
$expireDate = "2023-08-30";
$component = common::get_component();
$pageModuleInDirectory = $component[1];

$alertDateToEpoch = strtotime($alertDate);
$endDateToEpoch =  strtotime($expireDate);
//echo $endDate."</br>";
if($today > $alertDateToEpoch && $today < $endDateToEpoch) {
	if($pageModuleInDirectory != "calculate_amount_handler" && $pageModuleInDirectory != "get_max_date" && $pageModuleInDirectory != "details" && $pageModuleInDirectory != "download_pdf_formate" && $pageModuleInDirectory != "get_excel_formate") {
	echo "<div style='background-color:red;text-align:center;'> <br/><br/>This license is going to expire on <strong>$expireDate</strong>, Please contact service provider to continue using the software.</div>";
	}
}
if($today > $alertDateToEpoch && $today > $endDateToEpoch){

	$expireData = "<div heigh='100%' width='100%' style='height:100%;width:100%;background-color:orange;text-align:center'> <br/> <br/> <br/>  <br/> <br/> <br/>  <br/> <br/> <br/> This license has expired, Please contact service provider.</div>";
echo $expireData;
die();
}

?>