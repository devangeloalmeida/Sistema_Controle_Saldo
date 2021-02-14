<?php

$host       = "localhost";
$database   = "banco";
$user       = "root";
$password   = "";
  //============================================================ começo PDO
	try {
		
	 $db=new PDO('mysql:host=$host;dbname=$database','$user','$password');
		//$db = new PDO('mysql:host=localhost;dbname=base_cme', 'root', '');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		if($e->getCode() == 1049){
			echo "Banco de dados errado.";
		}else{
			echo $e->getMessage();
		}
	}
  //============================================================ fim PDO
	@session_start();
	
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');

//	include('functions.php');
?>
