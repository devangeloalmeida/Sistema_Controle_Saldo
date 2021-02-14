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


/*$sql=$db->prepare("SELECT * FROM contas AS c JOIN usuarios As u ON c.indicado_por_id_cliente=u.id_usuario WHERE c.id_cliente=:id_cli AND u.id_usuario=:id_cli");
$sql->bindParam(':id_cli', $_POST['id_usuario'] );
$sql->execute();
$dados = $sql->fetch(PDO::FETCH_ASSOC);
if ($sql->rowCount() > 0) {   
}else{
	echo "<script> location.href='../painel_aviso.php';windows.location.reload();</script>";
   	exit();
}*/


/*---------------
Gravar nova conta
----------------*/
$val = $_POST['valor_aporte'];
$valor = number_format($val, 2, '.', ',');

/*CALCULAR JUROS*/
$total_sob_juros    = abs($_POST['valor_aporte']) * abs($_POST['comissao'])/100;
$soma_saldo_juros   = (abs($_POST['valor_aporte']) + abs($total_sob_juros));
$total_sob_juros2   = number_format($total_sob_juros, 2, '.', ''); 

/*CALCULAR COMISSAO*/
$total_sob_comissao  = abs($_POST['valor_aporte']) * abs($_POST['comissao_indicacao'])/100;
$soma_comissao_juros = (abs($_POST['valor_aporte']) + abs($total_sob_comissao));
$total_sob_comissao2 = number_format($total_sob_comissao, 2, '.', ''); 
   
// calcular e pegar daqui a 30 dias a data
$data_aniversario = strtotime("+30 days");
$data_ani         = date('d',$data_aniversario);

//----------------------------------------------
//Aqui vai calcular a comissão do indicado sobre
//----------------------------------------------
if(!empty($_POST['id_usuario']) ){
	//echo "divisao";
	$juros_comissao_2 = abs($total_sob_comissao);
	$juros_saldo_2    = abs($total_sob_juros);

	$dados=array($_POST['conta'],$_POST['id_cliente'],$_POST['data_aporte'],$val,$_POST['id_usuario'],$_POST['comissao'],$_POST['comissao_indicacao'],$_POST['tipo_remunerado'], $val, $juros_comissao_2, $juros_saldo_2, $data_ani, $_POST['valor_fixo'], $_POST['optou_valor_fixo']);
	$sql_insert = $db->prepare("INSERT INTO `contas` (numero_conta, id_cliente, data_aporte, valor_aporte, indicado_por_id_cliente, comissao, comissao_indicacao, tipo_remuneracao, saldo, rentabilidade_indicacao, rentabilidade_cliente, data_aniversario, valor_fixo, optou_valor_fixo ) VALUES (?,?,?,?,?,?,?, ?,?,?,?, ?,?,?)");
	$sql_insert->execute($dados);
}else{
	$dados=array($_POST['conta'],$_POST['id_cliente'],$_POST['data_aporte'],$val,$_POST['id_usuario'],$_POST['comissao'],$_POST['comissao_indicacao'],$_POST['tipo_remunerado'], $val, $total_sob_juros, $data_ani, $_POST['valor_fixo'], $_POST['optou_valor_fixo'] );
	$sql_insert = $db->prepare("INSERT INTO `contas` (numero_conta, id_cliente, data_aporte, valor_aporte, indicado_por_id_cliente, comissao, comissao_indicacao, tipo_remuneracao, saldo, rentabilidade_cliente,data_aniversario, valor_fixo, optou_valor_fixo ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$sql_insert->execute($dados);
}

if($sql_insert){	
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
