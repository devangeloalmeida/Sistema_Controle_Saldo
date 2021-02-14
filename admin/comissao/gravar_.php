<?php
	 include ('../data/config.php');
   $data_hoje = date('Y-m-d');
   
   $dados = array( $_POST['comissao'], $_POST['tipo'] );
   $sql_insert = $db->prepare("INSERT INTO `tipo_comissao` (valor_comissao,tipo_comissao) VALUES (?,?)");
   $sql_insert->execute($dados);

   if($sql_insert){	
    	echo "<script> location.href='../tipo_comissao.php';alert('CADASTRADO COM SUCESSO!');windows.location.reload();</script>";
    	exit();
    }else{
    	echo "<script>alert('ERRO AO CADASTRAR');window.history.go(-1);</script>";
   }

?>
