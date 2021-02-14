<?php
session_start();
include ('../data/config.php');
//echo " aqui ...";

$sql_delete = $db->prepare("DELETE FROM `rentabilidade` WHERE `id_rentabilidade` = '".$_GET['1']."'  ");
$sql_delete->execute();

if($sql_delete){
    echo "<script> location.href='../calculo_rentabilidade.php';windows.location.reload();</script>";
    exit();
}else{
    echo "<script>alert('ERRO AO DELETAR');window.history.go(-1);</script>";
}

?>
