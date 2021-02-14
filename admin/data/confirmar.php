<?php
session_start();
  include("../db/db.php");
$data_hoje            = date('Y-m-d');
$id_nivel_acesso      = "102";
//$email                = base64_decode($_GET['1']);
$status               = "C";   

//echo $email;
// VER SE EMAIL EXISTE PARA CONFIRMAR
//=================
$sql_item3 = $db->prepare("SELECT * FROM 0001_tb_usuario WHERE email=:email and status=:status LIMIT 1 ");
$sql_item3->bindParam(':status', $status );
$sql_item3->bindParam(':email', $_GET['1'] );
$sql_item3->execute();
$dados_item3 = $sql_item3->fetch(PDO::FETCH_ASSOC);
if ($sql_item3->rowCount() > 0) {                  
    //echo "achou";
  
  // Confirma existe e atualiza
  // ===========================
  $status2 = "S";
  $dados = array( $status2 );
  $sql_editar = $db->prepare("UPDATE `0001_tb_usuario` SET `status`=?  WHERE email='".$_GET['1']."' ");
  $sql_editar->bindParam(":status", $status2 );
  //$sql_editar->bindParam(":email", $email );
  $sql_editar->execute($dados);

  if($sql_editar){ 
      $_SESSION['erro'] = "gravado_confirmado";
      //include('dispara_email.php');
      echo "<script>  location.href='../confirmado_sucesso.php'; windows.location.reload();</script>";
      exit();
    }else{
      $_SESSION['erro'] = "erro_novo_registro";
      echo "<script>  location.href='../nao_confirmado.php'; windows.location.reload();</script>";
      exit();
  }

}else{
  echo "<meta http-equiv=refresh content='0;URL=../nao_confirmado.php'>";   
  exit();
}
?>

