<?php
require_once("lazadaApi.php");

$action = checkRequest('Action');
if($action != ""){
	switch ($action) {
		case 'GetOrders':
			getOrders();
			break;
		default:
			# code...
			break;
	}
}else{
	
}

function checkRequest($req){
	if(isset($_GET[$req])){
		return $status = $_GET[$req];
	}else{
		return "";
	}
}

function getOrders(){
	$lazada = new LazadaApi();
	$status = checkRequest("Status");
	$limit = checkRequest("Limit");
	$offset = checkRequest("Offset");
	$sortBy = checkRequest("SortBy");
	$sortDirection = checkRequest("SortDirection");
	$params = array(
		'Action' => "GetOrders",
		'Status' => $status, 
		'Limit' => $limit == "" ? 5 : $limit, 
		'Offset' => $offset, 
		'SortBy' => $sortBy, 
		'SortDirection' => $sortDirection, 
		);
	$lazada->getData($params);
}