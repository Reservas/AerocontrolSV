<?php 
	session_start();
	$unset = $_POST['unset'];
	if($unset=='true'){
		unset($_SESSION['airline']);
		echo "unset";
	}else{
		$_SESSION['airline'] = $_POST['airline'];
		echo "set";
	}
?>