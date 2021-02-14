<?php
session_start();
include('data/config.php');
$data_hoje = date('Y-m-d');
$dia_mes   = date('Y-m');
$data_hoje2          = substr($data_hoje,8,2);
$s=0;

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


$id_cliente_indicado = $i['indicado_por_id_cliente']; /* ID do indicado */
$id_cliente          = $i['id_cliente'];              /* ID do cliente */

if ( $data_aporte == $data_hoje2 ){
		
		//echo "entrou";

			$s=$s+1;
	    	$numero_conta      = $dados_i['numero_conta'];
		
			//CALCULAR JUROS
			$total_sob_juros   =  (abs($i['saldo']) * abs($i['comissao']))/100;
			$soma_saldo_juros  =  (abs($i['saldo']) + abs($total_sob_juros));
			$total_sob_juros2  =  number_format($soma_saldo_juros, 2, '.', ''); 

			$dados             =  array( abs($total_sob_juros2) );
	 		$sql_editar = $db->prepare("UPDATE `contas` SET `saldo`=? WHERE numero_conta='".$i['numero_conta']."' ");
  			$sql_editar->execute($dados);

			// Aqui a conta tem um cliente indicado
			// ele retorna indicando o campo tem informações, não está em branco
			//------------------------------------------------------------------
			if (!empty($id_cliente_indicado)){
				//CALCULAR COMISSAO
				$total_sob_comissao  = (abs($i['saldo']) * abs($i['comissao_indicacao']))/100;
				//$soma_comissao_juros = (abs($total_sob_comissao)/2); 
				$total_sob_comissao2 = number_format($total_sob_comissao, 2, '.', ''); 
			
				$dados = array( abs($total_sob_comissao2), abs($total_sob_juros) );
	 			$sql_editar = $db->prepare("UPDATE `contas` SET `rentabilidade_indicacao`=?,`rentabilidade_cliente`=? WHERE numero_conta='".$i['numero_conta']."' ");
  				$sql_editar->execute($dados);
  			}

			
			//--------------------------------------------------------------
			//PEGAR número da conta do usuario indicado a receber comissão
			//--------------------------------------------------------------
			$sql_1=$db->prepare("SELECT * FROM contas WHERE id_cliente=:indicado_por_id_cliente LIMIT 1");
			$sql_1->bindParam(':indicado_por_id_cliente', $i['indicado_por_id_cliente'] );
			$sql_1->execute();
			$dados_1 = $sql_1->fetchAll(PDO::FETCH_ASSOC);
			foreach ($dados_1 as $i2){ 
				$indicado_por_id_cliente=$i2['numero_conta'];
				$saldo_cliente_comissao =$i2['saldo'];
			}

	
			$juros_comissao_2 = abs($total_sob_comissao);
			$juros_saldo_2    = abs($total_sob_juros);

			//gravar em rentabilidade
			$dados = array($indicado_por_id_cliente, $saldo_cliente_comissao, $i['id_cliente'], $i['indicado_por_id_cliente'], $data_hoje2, $i['numero_conta'], $i['saldo'], $i['comissao'], $i['comissao_indicacao'], $data_hoje, $total_sob_juros2, $total_sob_comissao2);

			$sql_insert = $db->prepare("INSERT INTO `rentabilidade` (numero_conta_comissionado, saldo_cliente_comissao, id_usuario_conta, id_usuario_comissao, data_aniversario, numero_conta, saldo, valor_juros, valor_comissao, data_calculo, total_sob_juros, total_sob_comissao ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
			
			$sql_insert->execute($dados);
			
}

}

			echo "<script> location.href='calculo_rentabilidade.php';windows.location.reload();</script>";
  			exit();

			/*echo "Valor saldo R$   ".$i['saldo'].'<br>';
			echo "Taxa comissão ".$i['comissao_indicacao'].'<br>';
			echo "Cálculo Juros comissão ".$total_sob_comissao2.'<br>';
			echo "Taxa juros ".$i['comissao'].'<br>';
			echo "Cálculo Juros saldo    ".$total_sob_juros2.'<br>';
			echo "<hr><br>";*/
