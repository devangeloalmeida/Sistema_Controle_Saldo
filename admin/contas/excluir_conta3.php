<?php
session_start();
include ('../data/config.php');
//echo " aqui ...";

$sql_delete=$db->prepare("DELETE FROM `usuarios` WHERE `id_usuario`='".$_SESSION['id_cliente']."'  ");
$sql_delete->execute();

$sql_delete2=$db->prepare("DELETE FROM `contas` WHERE `id_cliente`='".$_SESSION['id_cliente']."' AND  `numero_conta`='".$_GET['2']."' ");
$sql_delete2->execute();

if($sql_delete){
    echo "<script> location.href='../painel.php';windows.location.reload();</script>";
    exit();
}else{
    echo "<script>alert('ERRO AO DELETAR');window.history.go(-1);</script>";
}

?>
