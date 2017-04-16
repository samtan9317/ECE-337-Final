<?php
// This controller acts as the go between the view and the model. 
//
// Author Xuesen Tan
//
include 'model.php';  // for $theDBA, an instance of DataBaseAdaptor
//$name = $_GET['Actors']; 
//$input = $_GET['input'];

/* if($input == "Actors" ){
	$arr = $theDBA->getAllActors ($name);
}
else{
	$arr = $theDBA->getAllRolls($name);
} */
//New Function 
$arr = $theDBA->getAllMoviesAndRoles ();

echo  json_encode($arr);
?>