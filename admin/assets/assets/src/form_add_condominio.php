<?php      
session_start();
$chave_condominio = $_SESSION['chave_condominio'];
$chave_morador    = $_SESSION['chave_morador'];
$email_usuario    = $_SESSION['email'];

$telefone         = $_POST['telefone'];
$telefone_1       = $_POST['telefone_1'];

$email            = $_POST['email'];
$email_1          = $_POST['email_1'];


//echo $telefone."-".$email."-".$chave_morador."-".$chave_condominio;
//=================================================
// chave do condomínio

$razao_social    = $_POST['razao_social'];

$cnpj            = $_POST['cnpj'];
$_POST['cnpj']   = ( isset($_POST['cnpj']) ) ? true : null;

$endereco        = $_POST['rua'];
$numero          = $_POST['numero'];
$bairro          = $_POST['bairro'];
$cidade          = $_POST['cidade'];
$estado          = $_POST['uf'];
$cep             = $_POST['cep'];
$nome_fantasia   = $_POST['nome_fantasia'];

require('../conexao.php');
include('../src/class.fileuploader.php'); 


// não permite email de usuário igual email cadastro para condominio
//------------------------------------------------------------------
$sql = mysqli_query($con,"SELECT * FROM condominio WHERE email='$email'");
if (mysqli_num_rows($sql) == true){    
   echo '<script> alert("E-mail ocupado por outro Condomínio! Informe outro e-mail. Corriga Erro..."); history.back();</script>';
    exit();
} 

/*==============================
//BUSCA SE EXISTE CONDOMINIO CADASTRADO
//==============================;
$resul = "SELECT nome_fantasia FROM condominio WHERE nome_fantasia='$nome_fantasia'";
//echo $resul;
$res2       = mysqli_query($con,$resul) or die(mysqli_erro($con));
$rs2        = mysqli_fetch_array($res2) or die(mysqli_erro($con));
if ($rs2 > 0) { 
   echo "<meta http-equiv=refresh content='0;URL=novo_condominio.php'>";   
   exit();
}
*/
    
    // instancia o objeto e passa parametros
    $FileUploader = new FileUploader('files', array(
        'limit' => 1,
        'maxSize' => null,
        'fileMaxSize' => null,
        'changeInput'=>true,
        'extensions' => null,
        'required' => false,
        'uploadDir' => '../uploads/',
        'title' => 'name',
        'replace' => false,
        'listInput' => true,
        'files' => null
    ));
    
if (!empty($cnpj)) {
  
  if (validar_cnpj($cnpj)!=true){
    $_SESSION["aviso"]="Erro: CNPJ inválido!";      
  //echo "<meta http-equiv=refresh content='0;URL=../senha_confirma.php'>" ;  
    echo '<script> alert("CNPJ inválido!"); history.back();</script>';
    exit();
  }
}


if ($email != $email_1){
    $_SESSION['aviso']="Erro: email´s desiguais!";
    //echo "<meta http-equiv=refresh content='0;URL=../senha_confirma.php'>" ;  
     echo '<script> alert("Confirmação de email errada!"); history.back();</script>';
     exit();
}

if ($telefone != $telefone_1){
    $_SESSION['aviso']="Erro: telefones desiguais!";
   //echo "<meta http-equiv=refresh content='0;URL=../senha_confirma.php'>" ;  
      echo '<script> alert("Telefones desiguais!"); history.back();</script>';
   exit(); 
}


      // metodo para upload
    $data = $FileUploader->upload();

    // verifica sucesso do upload
    if($data['isSuccess'] && count($data['files']) > 0) {
        // pega arquivos enviados
        $uploadedFiles = $data['files'];
    }

    // captura erros
    if($data['hasWarnings']) {
        $warnings = $data['warnings'];
        echo '<pre>';
        print_r($warnings);
        echo '</pre>';
    }

    // pega os arquivos enviados em array
    $fileList = $FileUploader->getFileList();
    
    // get the fileList
    $fileList = $FileUploader->getFileList();
    $myFilesForSql = implode('|', $FileUploader->getFileList('name'));

    $arquivo[0]  = $fileList[0]['file'];
    $u = 0;
	
    //echo '<pre>';
    //print_r($fileList); array com todas as inforacoes do arquivo
    //echo "Arquivo <b>{$fileList[0]['file']}</b> enviado com sucesso";
    //echo '</pre>';
    $inativo="INATIVO";
    $sql  = "INSERT INTO condominio(email_inativo_ativo,chave_condominio,razao_social,cnpj,endereco,numero,bairro,cidade,uf,cep,telefone,email,foto,nome_fantasia) VALUES('$inativo','$chave_condominio','$razao_social','$cnpj','$endereco','$numero','$bairro','$cidade','$estado','$cep','$telefone','$email','$myFilesForSql','$nome_fantasia')" or die(mysqli_error($con));
      mysqli_query($con,$sql) or die(mysqli_error($con));

//echo $sql;

    //CADASTRO DE MORADOR E CONDOMINIO
    //================================
    $sql_1="INSERT INTO morador_condominio(chave_condominio,chave_morador,email,bloco) VALUES('$chave_condominio','$chave_morador','$email_usuario','$bloco')" or die(mysqli_error($con));
      mysqli_query($con,$sql_1) or die(mysqli_error($con));

//    echo "<meta http-equiv=refresh content='0;URL=../dispara_email_add_condominio.php'>";   
  //  exit();



function validar_cnpj($cnpj)
{
  $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
  // Valida tamanho
  if (strlen($cnpj) != 14)
    return false;
  // Valida primeiro dígito verificador
  for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
  {
    $soma += $cnpj{$i} * $j;
    $j = ($j == 2) ? 9 : $j - 1;
  }
  $resto = $soma % 11;
  if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
    return false;
  // Valida segundo dígito verificador
  for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
  {
    $soma += $cnpj{$i} * $j;
    $j = ($j == 2) ? 9 : $j - 1;
  }
  $resto = $soma % 11;
  return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
}
?>
?>
