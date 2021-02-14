<?php
session_start();
include('data/config.php');
$sql_login  = $db->prepare("SELECT * FROM usuarios WHERE login = :email AND senha = :senha LIMIT 1");    
$sql_login->bindValue(':email', $_SESSION['email']);
$sql_login->bindValue(':senha', sha1( $_SESSION['senha']) );
$sql_login->execute();
$dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);
$i=0;
$saldo2=0;

if ($sql_login->rowCount() > 0) {     
$_SESSION['tipo_usuario'] = $dados_login['tipo_usuario'];
$_SESSION['id_usuario']   = $dados_login['id_usuario'];
?>


<?php 
// captura o número da conta e pega o ID_CLIENTE DA CONTA
$sql_i = $db->prepare("SELECT numero_conta, id_cliente FROM historico_conta WHERE numero_conta=:numero");
$sql_i->bindParam(':numero', $_GET['1']);
$sql_i->execute();
$dados_i = $sql_i->fetchAll(PDO::FETCH_ASSOC);
if ($sql_i->rowCount() > 0) {     
    $id_cliente = $dados_i['id_cliente']; 
}                                        
?>

<!DOCTYPE html >
<html>
<?php 

include('inc/header.php'); 
//include('header_topo.php');
?>

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
                                <h4 class="page-title">EXTRATO CONTA</h4>
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
                                    <div class="card-box">

                                    <?php      
                                    $admin='ADMIN';                 
                                    $sql_item=$db->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario");
                                    $sql_item->bindParam(':id_usuario', $_GET['2']);
                                    $sql_item->execute();
                                    $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($dados_item as $item) {?>

                                    <div class="panel panel-default">
                                    <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                                    <?php echo $id_cliente; ?>
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <h3 class="logo">EXTRATO</h3>
                                            </div>
                                            <div class="pull-right">
                                                <h4>Número Conta <br>
                                                    <strong><?php echo $_GET['1'];?></strong>
                                                </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="pull-left m-t-30">
                                                    <address>
                                                      <strong><?php echo $item['nome']?></strong><br>
                                                      <b>E-mail:</b><?php echo $item['email'];?><br>
                                                      <b>Telefone:</b><?php echo $item['telefone'];?>
                                                      </address>
                                                </div>
                                                <div class="pull-right m-t-30">
                                                <p><strong>Gerado em: </strong> <?php echo date('d/m/Y');?></p>
                                                    <!--<p class="m-t-10"><strong>: </strong> #123456</p>-->
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->
                                           <?php  
                                        }?>


                                        <div class="m-h-50"></div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                        
                                                <table class="table m-t-30">
                                                        <thead>
                                                            <tr><th>#</th>
                                                            <th>TIPO</th>
                                                            <th>DATA</th>
                                                            <th class="text-right">VALOR R$</th>
                                                        </tr></thead>
                                                 <?php
                                                $sql_i2=$db->prepare("SELECT distinct(numero_conta), valor, id_cliente, data, tipo, id_historico FROM historico_conta WHERE numero_conta=:numero");
                                                $sql_i2->bindParam(':numero', $_GET['1']);
                                                $sql_i2->execute();
                                                $dados_i2 = $sql_i2->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($dados_i2 as $i2) {                    
                                                ?>

                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $i2['id_historico']; ?></td>
                                                                <td><?php echo $i2['tipo']; ?></td>
                                                                <td><?php    
                                                                echo date('d/m/Y',strtotime($i2['data']));
                                                                ?></td>
                                                                <td class="text-right"><?php print number_format($i2['valor'], 2, ',', '.'); ?></td>
                                                            </tr>
                                                            
                                                        </tbody>

                                                   <?php  
                                                    }?>
       
                                                </table>

                                              
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="clearfix m-t-40">
                                                    <h5 class="small text-inverse font-600">DETALHES</h5>

                                                    <small>
                                                        
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                                                <p class="text-right"><b>Sub-total:</b>   
                                                <?php 
                                                // recebendo o resultado da consulta
                                                $se=$db->prepare("SELECT valor FROM historico_conta WHERE numero_conta=:n_conta");
                                                $se->bindParam(':n_conta', $_GET['1']);
                                                $se->execute();
                                                $dados = $se->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($dados as $sed) {
                                                   $saldo = $saldo + $sed['valor'];
                                                } print number_format($saldo, 2, ',', '.');?></p>
                                                <!--<p class="text-right">Discout: 12.9%</p>
                                                <p class="text-right">VAT: 12.9%</p>-->
                                                <hr>
                                                <?php 
                                                // recebendo o resultado da consulta
                                                $se2=$db->prepare("SELECT saldo FROM contas WHERE numero_conta=:n_2");
                                                $se2->bindParam(':n_2', $_GET['1']);
                                                $se2->execute();
                                                $dados2 = $se2->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($dados2 as $sed2) {
                                                   $saldo2 = $saldo2 + $sed2['saldo'];
                                                } 
                                                ?>
                                                <h4 class="text-right"> <?php echo "Saldo R$ ".number_format($saldo2,2,',','.');?> </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="hidden-print">
                                            <div class="pull-right">
                                                <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
                                            </div>
                                        </div>
                                    </div>
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

                </div> <!-- content -->


            </div>

        </div>
        <!-- END wrapper -->
        
        <?php include('inc/footer.php'); ?>


        <div class="modal fade" id="ModalMapaTela" tabindex="-1" role="dialog" aria-labelledby="MyModalMapa">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_trafego" tabindex="-2" role="dialog" aria-labelledby="modal_trafego">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>

      <div class="modal fade" data-backdrop="static" id="edit_foto" tabindex="-3" role="dialog" aria-labelledby="edit_foto">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
       </div>



    </body>


</html>

<?php

}else{

    echo "<script> alert('SEM AUTORIZAÇÃO AO ACESSO !'); location.href='index.php'; windows.location.reload();</script>";
    exit();         

}        

?>