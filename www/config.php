<?php

include_once('static.php');
include_once('navbar.php');



include_once('db.php');
$db = new TopFormDB();
$sql = "SELECT * FROM developer_tools WHERE id='1'";
$result = $db->query($sql);
$result_html = '';
$count = 1 ; 
$row = $result->fetchArray(SQLITE3_ASSOC);
$redirect_value=$row['redirect'];
$is_developer=$row['is_developer'];
$disabled = "disabled";
if($is_developer == "-11"){
	$disabled = "";
}