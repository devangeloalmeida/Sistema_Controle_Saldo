 <?php
session_start();
include('data/config.php');
$sql_login=$db->prepare("SELECT * FROM usuarios WHERE login = :email AND senha = :senha LIMIT 1");    
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
                                <h4 class="page-title">SAQUE AUTOMÁTICO </h4>
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
                                    <div class="card-box filterable">

                                        <!--<a href="cadastro_cli.php" data-remote="slide/php/galeria/modal_editar.php" data-toggle="modal" data-target="#modal_trafego" class="btn btn-primary btn-lg pull-right">Adicionar cliente</a>-->

                                        <!--<a href="painel.php" class="btn btn-primary btn-lg pull-right"> Adicionar conta</a>-->

                                        <div class="panel-heading">
                                            SAQUE AUTOMÁTICO                                     
                                        </div>

                                        <table id="example" class="display" style="width:100%">

                                            <thead>
                                                <tr class="panel panel-primary">
                                                    <th width="175">CLIENTE</th>
                                                    <th width="50">SAQUE</th>
                                                    <th width="50">CONTA</th>
                                                    <th width="50">DATA</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            <?php      
                                            $sql_i=$db->prepare("SELECT * FROM historico_conta ");
                                            $sql_i->execute();
                                            $dados_i = $sql_i->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($dados_i as $i){ ?>
                                                <tr>         
                                                    <td width="175">            
                                                        <?php 
                                                        $sql_item=$db->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario ");
                                                        $sql_item->bindParam(':id_usuario', $i['id_cliente']);
                                                        $sql_item->execute();
                                                        $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($dados_item as $item) {                    
                                                            echo '<b>'.$item['nome'].'</b>'; 
                                                        }?>
                                                    </td>
                                                    
                                                    <td width="50">
                                                    <?php                                       
                                                        echo number_format($i['valor'], 2, ',', '.');
                                                        ?>
                                                    </td>
                                                    <td width="50">
                                                        <span class="badge badge-primary"><?php echo 'Conta:'.$i['numero_conta'];
                                                        ?></span>
                                                    </td>

                                                    <td width="50">
                                                        <?php    
                                                        
                                                        echo date('d/m/Y',strtotime($i['data']));
                                                        ?>
                                                    </td>

                                                    
                                                    </td>
                                                </tr> 

                                                <?php } 
                                                ?>

                                            </tbody>

                                        </table>

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