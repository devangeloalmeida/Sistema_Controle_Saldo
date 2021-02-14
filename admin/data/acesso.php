<?php 
	session_start();
	include('config.php');
	$sql_login = $db->prepare("SELECT * FROM usuarios WHERE login=:email AND senha=:senha LIMIT 1");
	$sql_login->bindParam(':email', $_POST['email']);
	$sql_login->bindParam(':senha', sha1( $_POST['senha']) );
	$sql_login->execute();
	$dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);
	if($sql_login->rowCount() > 0){
		
		$_SESSION['tipo_usuario'] =  $dados_login['tipo_usuario'];
		$_SESSION['id_usuario']   =  $dados_login['cod']; 

		$_SESSION['senha'] 		  =  $_POST['senha']; 
		$_SESSION['email'] 		  =  $_POST['email'];

		//$_SESSION['foto']         =  $dados_login['foto'];
		$_SESSION['nome']  		  =  $dados_login['nome'];
		$_SESSION['cpf']   		  =  $dados_login['cpf'];
		$_SESSION['tipo_usuario'] =  $dados_login['tipo_usuario'];
		
		if ($_SESSION['tipo_usuario'] == "ADMIN"){	
			header('Location: ../painel.php');
		}


		if ($_SESSION['tipo_usuario'] == "USUARIO"){			
			header('Location: ../../painel_usuarios.php');
		}
		
	}else{
		$_SESSION['senha_incorreta']="incorreta";
		echo "<script> location.href='/admin'; windows.location.reload();</script>";
  		exit();
	}

?>