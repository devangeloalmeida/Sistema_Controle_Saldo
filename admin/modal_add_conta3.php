<?php
session_start();
include('data/config.php');
$conta = date('Ymd').'-'.date('H.i.s');
$_SESSION['id_cliente']=$_GET['1'];
$_SESSION['numero_conta']=$_GET['2'];

$sql_login=$db->prepare("SELECT * FROM usuarios WHERE login = :email AND senha = :senha LIMIT 1");  
$sql_login->bindValue(':email', $_SESSION['email']);
$sql_login->bindValue(':senha', sha1($_SESSION['senha']));
$sql_login->execute();
$dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);

if ($sql_login->rowCount() > 0) {     
$_SESSION['id_usuario'] = $dados_login['cod'];

include('inc/header.php'); 
?>

<body class="fixed-left">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>

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
                                <h4 class="page-title">ADICIONAR CONTA</h4>
                                
                            </li>
                        </ul>
                    </div><!-- end container -->
                </div><!-- end navbar -->
                
            </div>
            <!-- Top Bar End -->

            <?php include("data/menu.php");?>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                        	<div class="col-sm-12">
                        		
                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                    <br>
                                    <div class="card-box filterable">
                                    <div class="panel-heading">
                                        <?php 
                                        $sql_item=$db->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario ");
                                        $sql_item->bindParam(':id_usuario', $_GET['1']);
                                        $sql_item->execute();
                                        $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($dados_item as $item) {                    ?>

                                        <h1 class="panel-title">CADASTRO CLIENTE <?php echo '<h5>'.$item['nome'].'</h5>';}?></h1>
                                            
                                
 <form action="contas/gravar_.php" method="post" >
      
      <div class="col-md-12">
      <div class="col-md-6">
         <div class="form-group">
         <label>Número da conta gerado automático</label>      
         <input readonly type="text" class="form-control" name="conta" value="<?php echo $conta;?>">
         </div>
      </div>  
      </div>
  <hr>  

  <div class="row">   
        <div class="col-md-12">
            <div class="col-md-6">
            <div class="form-group">
              <label>Valor do aporte R$</label>
              <input type="text" id="valor_aporte" name="valor_aporte" class="form-control" placeholder="Valor do aporte">
            </div>
            </div>
        
            <div class="col-md-6">
            <div class="form-group">
              <label>Data do aporte </label>
              <input type="date" name="data_aporte" class="form-control" placeholder="data do aporte">
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
              <label>Juros % mensal </label>
              <input type="number" name="comissao" class="form-control" placeholder="Comissão %">
            </div>
            </div>

            
            <div class="col-md-6">
            <div class="form-group">
              <label>Tipo remuneração</label>
              <select class="form-control" name="tipo_remunerado">
                <option value="Total"> Remuneração Total</option>
                <option value="Divisao"> Remuneração Divisão</option>
              </select>
            </div>
            </div>
        
        </div>
         
        
        <div class="col-md-12">
        
            <div class="form-group">
            <div class="col-md-6">
               <label style="color:blue;">Indicado para receber comissão</label>                                      
               <select class="form-control" name="id_usuario" >
                      <option value="">Selecionar</option>
                      <?php            
                      //$sql_item = $db->prepare("SELECT * FROM usuarios");
                      $admin='ADMIN';       
                      //$sql_item=$db->prepare("SELECT * FROM contas AS c JOIN usuarios As u ON c.indicado_por_id_cliente=u.id_usuario WHERE u.tipo_usuario!=:tipo OR u.id_usuario!=:id_usu");          
                      $sql_item=$db->prepare("SELECT * FROM usuarios WHERE tipo_usuario!=:tipo AND id_usuario!=:id_usu ORDER BY id_usuario DESC ");
                      $sql_item->bindParam(':id_usu', $_SESSION['id_cliente']);
                      $sql_item->bindParam(':tipo', $admin);
                      $sql_item->execute();
                      $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($dados_item as $item) { ?>
                          <option value="<?php echo $item['id_usuario'];?>"> <?php echo utf8_encode($item['nome']);?> <b> -  tem conta para receber comissão ?</b> </option>
                      <?php }?>                    
                </select>               
            </div>    
            <div class="col-md-6">
                  <div class="form-group">
                  <label style="color:blue;">Valor da comissão em % da indicação</label>
                  <input type="number" name="comissao_indicacao" class="form-control" placeholder="Comissão % da indicação">
            </div>
            </div>

            <div class="form-group">
            <div class="col-md-6">
                  <label style="color:blue;">Optou por retida fixa</label>
                  <select class="form-control" name="optou_valor_fixo">
                    <option value="">Selecione</option>
                    <option value="Sim">Sim</option>
                    <option value="Nao">Não</option>
                  </select>
            </div>
            <div class="col-md-6">
                  <label style="color:blue;">Valor fixo R$</label>
                  <input type="text" id="valor_fixo" name="valor_fixo" class="form-control" placeholder="Valor fixo por mês">
            </div>
            </div>




        </div>
        
        
        </div>     
  </div>
  </div><!-- modal body-->
 
    <input type="hidden" name="id_cliente" value="<?php echo $_GET['1']; ?>">   
    <div class="modal-footer">         
        <button type="button" class="btn btn-danger btn-round btn-sm " data-dismiss="modal">CANCELAR</button>
        <button type="submit" class="btn btn-primary btn-round btn-sm ">ENVIAR</button></div>
    </div>
</form>

                                        </div>
                                        
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

                <!--</div> 
            </div>
        </div>-->


<script type="text/javascript">
    $("#valor_aporte").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'', decimal:'.', affixesStay: false});
</script>

<script type="text/javascript">
    $("#valor_fixo").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'', decimal:'.', affixesStay: false});
</script>

<?php include('inc/footer.php'); ?>

</body>   
</html>

<?php

} else{ echo "<script> alert('SEM AUTORIZAÇÃO AO ACESSO !'); location.href='../index.php'; windows.location.reload();</script>";
exit(); 
}?>