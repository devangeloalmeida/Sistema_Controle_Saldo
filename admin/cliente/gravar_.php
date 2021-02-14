<?php
	include ('../data/config.php');

   $data_hoje = date('Y-m-d');
   $tipo_usuario="CLIENTE";
   $dados = array( $_POST['nome'], $_POST['cpf'], $tipo_usuario, $_POST['telefone'], $_POST['email'] );
   $sql_insert = $db->prepare("INSERT INTO `usuarios` (nome, cpf, tipo_usuario, telefone, email) VALUES (?,?,?,?,?)");
   $sql_insert->execute($dados);

   if($sql_insert){	
    	echo "<script> location.href='../painel.php';windows.location.reload();</script>";
    	exit();
    }else{
    	echo "<script>alert('ERRO AO CADASTRAR');window.history.go(-1);</script>";
   }

?>
