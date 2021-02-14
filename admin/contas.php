<?php
session_start();
include('data/config.php');
$sql_login  = $db->prepare("SELECT * FROM usuarios WHERE login = :email AND senha = :senha LIMIT 1");    
$sql_login->bindValue(':email', $_SESSION['email']);
$sql_login->bindValue(':senha', sha1($_SESSION['senha']));
$sql_login->execute();
$dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);

if ($sql_login->rowCount() > 0) {     
$_SESSION['id_usuario'] = $dados_login['cod'];
include('inc/header.php'); 
?>

<!DOCTYPE html >
<html lang="pt" xml:lang="pt" xmlns="http://www.w3.org/1999/xhtml">
<head>

</head>

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
                                <h4 class="page-title">CADASTRO CONTAS</h4>
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
                                    <div class="panel-heading">
                                    <h1 class="panel-title"> <i class="fas fa-user-friends"></i>CADASTRO CONTAS</h1>
                                            
                                    <form action="contas/gravar_.php" method="post">

                                            <div class="col-md-12">

                                                <div class="col-md-12 p-20">
                                                <div class="form-group">
                                                    <label>Nome cliente</label>  
                                                    <select class="form-control" name="id_usuario" required >
                                                    <option value="">Selecionar</option>
                                                    <?php            
                                                    //$sql_item = $db->prepare("SELECT * FROM usuarios");
                                                    $admin='ADMIN';                 
                                                    $sql_item = $db->prepare("SELECT * FROM usuarios WHERE tipo_usuario!=:tipo ORDER BY id_usuario DESC ");
                                                    $sql_item->bindParam(':tipo', $admin);
                                                    $sql_item->execute();
                                                    $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($dados_item as $item) { ?>
                                                    <option value="<?php echo $item['id_usuario'];?>"> <?php echo utf8_encode($item['nome']);?> </option>
                                                    <?php }?>                    
                                                    </select>               
                                                </div>
                                                </div><!-- end col -->
                                                
                                                
                                                <div class="col-md-3 p-20">
                                                <div class="form-group">
                                                    <label>Banco</label>
                                                    <input type="text" name="banco" class="form-control" placeholder="Nome do Banco" >
                                                </div>
                                                </div>
                                                
                                                <div class="col-md-3 p-20">
                                                <div class="form-group">
                                                    <label>Agência</label>
                                                    <input type="text" name="agencia" class="form-control" placeholder="Número da agência" >
                                                </div>
                                                </div>

                                                <div class="col-md-3 p-20">
                                                <div class="form-group">
                                                    <label>Número conta</label>
                                                    <input type="text" name="conta" class="form-control" placeholder="Número da conta" >
                                                </div>
                                                </div>


                                            </div>
                            
                                            <div class="form-group text-right m-b-0">
                                                <input type="hidden" name="item" value="<?php echo $item['id'];?>"  class="fupload form-control">
                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">CANCELAR</button>
                                                <button type="submit" class="btn btn-danger waves-effect waves-light m-l-5">ENVIAR</button>
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

                </div> <!-- content -->


            </div>

        </div>
        <!-- END wrapper -->
        

        <div class="modal fade" id="ModalMapaTela" tabindex="-1" role="dialog" aria-labelledby="MyModalMapa">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_trafego" tabindex="-1" role="dialog" aria-labelledby="modal_trafego">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>

      <div class="modal fade" id="deletar_trafego" tabindex="-1" role="dialog" aria-labelledby="delete_trafego">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>


<?php include('inc/footer.php'); ?>

</body>   
</html>

<?php

} else{ echo "<script> alert('SEM AUTORIZAÇÃO AO ACESSO !'); location.href='../index.php'; windows.location.reload();</script>";
exit(); 
}?>