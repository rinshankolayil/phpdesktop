<?php

include_once('db.php');	
include_once('site_controller.php');	



$class_name = $_GET['class_name'];
$function_name = $_GET['function_name']; 


$class = new $class_name();
if ($class_name == 'TopFormDB') $class->conn = $class;
if(isset($_POST)){
	$result = $class->$function_name($_POST);
}
else{
	$result = $class->$function_name();
}


if(!empty($result) && is_string($result)) {
    echo $result;
} 
elseif (is_array($result)) {
 	print_r($result);
}
else {
	echo $result;    
}