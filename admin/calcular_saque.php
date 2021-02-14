<?php
session_start();
include('data/config.php');
$data_hoje  = date('Y-m-d');
$dia_mes    = date('Y-m');
$data_hoje2 = substr($data_hoje,8,2);
$s    		= 0;
$tipo 		= "SAQUE";

$sql=$db->prepare("SELECT * FROM rentabilidade WHERE data_calculo=:data_hoje ");
$sql->bindParam(':data_hoje', $data_hoje );
$sql->execute();
$dados = $sql->fetch(PDO::FETCH_ASSOC);
if ($sql->rowCount() > 0) {   
	echo "<script> location.href='calculo_rentabilidade.php';windows.location.reload();</script>";
   	exit();
}

$sql_i=$db->prepare("SELECT * FROM contas WHERE data_aniversario=:data_hoje ");
$sql_i->bindParam(':data_hoje', $data_hoje2 );
$sql_i->execute();
$dados_i = $sql_i->fetchAll(PDO::FETCH_ASSOC);
foreach ($dados_i as $i){ 

// A data aniversário é registrado sempre 30 dias depois do cadastro de 
// uma nova conta com entrada de um aporte, no formulário criar-nova-conta em cadastro de clientes
$data_aporte         = $i['data_aniversario'];
//$data_aporte2        = substr($data_aporte,8,2);
$valor_fixo 		 = $i['valor_fixo'];
$id_cliente_indicado = $i['indicado_por_id_cliente']; /* ID do indicado */
$id_cliente          = $i['id_cliente'];              /* ID do cliente */

	if ( $data_aporte == $data_hoje2 ){

		//echo "entrou";
		$s=$s+1;
    	$numero_conta      = $dados_i['numero_conta'];
		
		//CALCULAR JUROS
		$soma_saldo_juros  =  ( abs($i['saldo']) - abs($valor_fixo) ); // abater o valor fixo no saldo
		$total_sob_juros2  =  number_format($soma_saldo_juros, 2, '.', ''); 

		$dados             =  array( $tipo, abs($total_sob_juros2) );
	 	$sql_editar=$db->prepare("UPDATE `contas` SET `tipo`=?, `saldo`=? WHERE numero_conta='".$i['numero_conta']."' ");
  		$sql_editar->execute($dados);

		/*-----------------------------*/
		// Gravar em Histórico do Cliente
		/*-----------------------------*/			
		$dados=array($i['indicado_por_id_cliente'],$i['id_cliente'],$valor_fixo,$data_hoje2,$i['numero_conta'],$tipo);
		$sql_insert = $db->prepare("INSERT INTO `historico_conta` (indicado_por, id_cliente, valor, data, numero_conta, tipo) VALUES(?,?,?,?,?,?)" );
		$sql_insert->execute($dados);
			
	}

}

			echo "<script> location.href='saque_automatico.php';windows.location.reload();</script>";
  			exit();

			/*echo "Valor saldo R$   ".$i['saldo'].'<br>';
			echo "Taxa comissão ".$i['comissao_indicacao'].'<br>';
			echo "Cálculo Juros comissão ".$total_sob_comissao2.'<br>';
			echo "Taxa juros ".$i['comissao'].'<br>';
			echo "Cálculo Juros saldo    ".$total_sob_juros2.'<br>';
			echo "<hr><br>";*/
