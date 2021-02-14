<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
session_start();
include ('../data/config.php');
$data_hoje = date('Y-m-d');
$sql_login  = $db->prepare("SELECT * FROM usuarios WHERE login = :email AND senha = :senha LIMIT 1");    
$sql_login->bindValue(':email', $_SESSION['email']);
$sql_login->bindValue(':senha', sha1( $_SESSION['senha']) );
$sql_login->execute();
$dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);
if ($sql_login->rowCount() > 0) {     

	$val = $_POST['valor_aporte'];
	$valor = number_format($val, 2, '.', '');

	$sql_1 = $db->prepare("SELECT * FROM contas WHERE numero_conta=:nc LIMIT 1");    
	$sql_1->bindValue(':nc', $_SESSION['numero_conta'] );
	$sql_1->execute();
	$dados_1 = $sql_1->fetch(PDO::FETCH_ASSOC);
	if ($sql_1->rowCount() > 0) {     
		$saldo_atual         = $dados_1['saldo'];
		$rentabilidade_atual = $dados_1['rentabilidade'];
	}

	/*Gravar nova conta*/ 
	$dados = array( $_SESSION['numero_conta'], $_POST['id_cliente'], $_POST['data_aporte'], $val, $_POST['tipo_debito_credito'] );
	$sql_insert = $db->prepare("INSERT INTO `historico_conta` (numero_conta, id_cliente, data, valor, tipo ) VALUES (?,?,?,?,?)");
	$sql_insert->execute($dados);

	if($sql_insert){

		// somar saldo
	  if ($_POST['tipo_debito_credito'] == 'DEPOSITO'){

	  	//echo $_SESSION['numero_conta'].'<br>';
		$atual_saldo  = abs($val) + abs($saldo_atual);
		//echo 'saldo atual '.abs($saldo_atual).'<br>';
		//echo 'soma saldo  '.abs($atual_saldo).'<br>';

		//$atual_renta  = abs($rentabilidade_atual)+abs($val);
		$atual_saldo2 = number_format($atual_saldo, 2, '.', '');
		//echo '<br>'.$atual_saldo2.'-'.$_POST['tipo_debito_credito'];

		$dados = array( $atual_saldo2,  $_POST['valor_aporte'] );
 		$sql_editar = $db->prepare("UPDATE `contas` SET `saldo`=?,`valor_aporte`=? WHERE numero_conta='".$_SESSION['numero_conta']."' ");
  		$sql_editar->execute($dados);
  	  }

  	  	// subtrair saldo
  	  if ($_POST['tipo_debito_credito'] == 'SAQUE'){
		$atual_saldo = abs($saldo_atual)-abs($val);
		//$atual_renta = ($rentabilidade_atual)-($val);
		//echo '<br>'.$atual_saldo;
		$atual_saldo2 = number_format($atual_saldo, 2, '.', '');

		$dados = array( abs($atual_saldo2), abs($_POST['valor_aporte']) );
 		$sql_editar = $db->prepare("UPDATE `contas` SET `saldo`=?, `valor_aporte`=? WHERE numero_conta='".$_SESSION['numero_conta']."' ");
  		$sql_editar->execute($dados);
  	  }
		
	  echo "<script> location.href='../painel.php';windows.location.reload();</script>";
  	  exit();

	}else{
   		echo "<script>alert('ERRO AO CADASTRAR');window.history.go(-1);</script>";
	}

}else{
    echo "<script> alert('SEM AUTORIZAÇÃO AO ACESSO !'); location.href='index.php'; windows.location.reload();</script>";
    exit();         
}        

?>

</body>
</html>
