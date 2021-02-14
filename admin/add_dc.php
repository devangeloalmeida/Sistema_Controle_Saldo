<?php
session_start();
include('data/config.php');
  
  $conta = date('Ymd').'-'.date('H.i.s');
  $_SESSION['id_cliente']=$_GET['1'];
  $_SESSION['numero_conta']=$_GET['2'];


$sql_login  = $db->prepare("SELECT * FROM usuarios WHERE login = :email AND senha = :senha LIMIT 1");    
$sql_login->bindValue(':email', $_SESSION['email']);
$sql_login->bindValue(':senha', sha1( $_SESSION['senha']) );
$sql_login->execute();
$dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);

if ($sql_login->rowCount() > 0) {     

$_SESSION['tipo_usuario'] = $dados_login['tipo_usuario'];
$_SESSION['id_usuario']   = $dados_login['id_usuario'];

?>

<!DOCTYPE html >
<html>
<?php 

include('inc/header.php'); 
//include('header_topo.php');
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="painel.php" class="logo"><span>Controle<span>SALDO</span></span><i class="zmdi zmdi-layers"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <h4 class="page-title">CADASTRO DE CLIENTES</h4>
                            </li>
                        </ul>
                    </div><!-- end container -->
                </div><!-- end navbar -->
                
            </div>
            <!-- Top Bar End -->

            <?php include("data/menu.php");?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
          

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                        	<div class="col-sm-12">
                        		
                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <br>
                                    <div class="card-box ">

                                        <div class="panel-heading">
                                            DÉBITO E CRÉDITO                                        
                                        </div>


        <?php 
        $sql_item=$db->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario ");
        $sql_item->bindParam(':id_usuario', $_GET['1']);
        $sql_item->execute();
        $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dados_item as $item) {                    
          echo '<b>'.$item['nome'].'</b>';
        }
        ?>

  <form action="contas/gravar_dc.php" method="post" >
    
        <div class="col-md-12">
        <div class="col-md-6">
          <div class="form-group">
          <label>´Número de conta</label>      
          <input readonly type="text" class="form-control" name="conta" value="<?php echo $_GET['2'];?>">           
          </div>
        </div>  
        </div>
  <hr>  

  <div class="row">   
        <div class="col-md-12">

            <div class="col-md-6">
            <div class="form-group">
              <label>Tipo </label>                                      
               <select class="form-control" name="tipo_debito_credito" required>
                      <option value="">Selecionar</option>
                      <option value="SAQUE">Saque </option>
                      <option value="DEPOSITO">Depósito</option>
                      
               </select>
            </div>
            </div>
        
            <div class="col-md-6">
            <div class="form-group">
              <label>Valor R$</label>
              <input required type="text" id="valor_aporte" name="valor_aporte" class="form-control" placeholder="Valor do aporte">
            </div>
            </div>
        
            <div class="col-md-6">
            <div class="form-group">
              <label>Data do aporte </label>
              <input required type="date" name="data_aporte" class="form-control" placeholder="data do aporte">
            </div>
            </div>
            </div>
        </div>    

    <input type="hidden" name="id_cliente" value="<?php echo $_GET['1']; ?>">   
    <input type="hidden" name="numero_conta" value="<?php echo $_GET['2']; ?>">

    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <a href="javascript:history.back()" type="button" class="btn btn-danger btn-round btn-sm " data-dismiss="modal">CANCELAR</a>
        <button type="submit" class="btn btn-primary btn-round btn-sm ">ENVIAR</button></div>  
    </div>
    </div>
     
  </div>
 
  </form>

<script type="text/javascript">
    $("#valor_aporte").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'', decimal:'.', affixesStay: false});
</script>





          
                                    </div>
                                </div>

                        		</div><!-- end row -->
                        		</div>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->


                        </div>
                        <!-- End row -->



                    </div> <!-- container -->

                </div> <!-- content -->


            </div>

        </div>
        <!-- END wrapper -->
        
        <?php include('inc/footer.php'); ?>


    </body>
</html>

<?php

}else{

    echo "<script> alert('SEM AUTORIZAÇÃO AO ACESSO !'); location.href='index.php'; windows.location.reload();</script>";
    exit();         

}        

?>