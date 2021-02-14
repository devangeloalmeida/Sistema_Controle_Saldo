<?php
session_start();
include('config.php');
$sql_login  = $db->prepare("SELECT * FROM usuarios WHERE login = :email AND senha = :senha LIMIT 1");    
$sql_login->bindValue(':email', $_SESSION['email']);
$sql_login->bindValue(':senha', $_SESSION['senha']);
$sql_login->execute();
$dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);

if ($sql_login->rowCount() > 0) {     

$_SESSION['id_usuario'] = $dados_login['cod'];

?>

<!DOCTYPE html >
<html>
<?php 
include('config.php'); 
include('../header.php'); 
//include('header_topo.php');
?>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="painel.php" class="logo"><span>AutoEcole-<span>2.0</span></span><i class="zmdi zmdi-layers"></i></a>
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
                                <h4 class="page-title">Painel site UVB</h4>
                            </li>
                        </ul>
                    </div><!-- end container -->
                </div><!-- end navbar -->
                
            </div>
            <!-- Top Bar End -->

            <?php include("menu.php");?>

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

                                        <!--    
                                        <a href="../../slide/modal_editar.php" data-remote="../../slide/modal_editar.php" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#adiciona_abastecimento">NOVO SLIDE<i class=""></i></a>
                                        -->

                                          <a href="slide/modal_editar.php" data-remote="slide/modal_editar.php" data-toggle="modal" data-target="#modal_trafego" class="btn btn-primary btn-sm pull-right">Adicionar<i class=""></i></a>



                                        <div class="panel-heading">
                                            <h1 class="panel-title"> <i class="fas fa-user-friends"></i> SLIDE </h1>
                                            
                                        </div>

                                        <table id="example" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">

                                            <thead>
                                                <tr class="panel panel-primary">
                                                    <th width="75" class="">
                                                    <th width="267">FOTO</th>                                                     
                                                    <td width="230" class="">
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                
                                                $sql_item = $db->prepare("SELECT * FROM slide order by id desc");
                                                $sql_item->execute();
                                                $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);                                              
                                                foreach ($dados_item as $item) {                                                
                                                ?>
                                                    <tr>         
                                                    <th width="5">            
                                                                                                                
                                                        <td width="267">
                                                        <?php
                                                        /*/ PESQUISAR PERCURSOS
                                                        $sql_login2 = $db->prepare("SELECT * FROM produto WHERE codigo_pro = :cod_produto ");
                                                        $sql_login2->bindParam(':cod_produto', $item['codigo_pro']);
                                                        $sql_login2->execute();
                                                        $dados_login2 = $sql_login2->fetch(PDO::FETCH_ASSOC);
                                                        
                                                        echo ($dados_login2['nome_pro']);  */
                                                        ?>          
                                                        </td>

                                                        <td width="267">
                                                        <?php
                                                        /*/ PESQUISAR ID DO NOME DO CLIENTE
                                                        $sql_login = $db->prepare("SELECT * FROM fornecedor WHERE id = :id_fornecedor ");
                                                        $sql_login->bindParam(':id_fornecedor', $item['codigo_for']);
                                                        $sql_login->execute();
                                                        $dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);
                                                        echo utf8_encode($dados_login['nome_for']);  */
                                                        ?>          
                                                        </td>   
                                                        <td width="75"><?php echo $item['nome'] ; ?></td>

                                                        <td width="100"><?php 
                                                        //echo date('d/m/Y',strtotime($item['data_entrada']));
                                                        ?></td>

                                                        <td width="230" class="text-right">                                                        
                                                           <div class="btn-group btn-group-sm" role="group" aria-label="acoes">  
                                                                                                                           
                                                    <!--<a href="data/entrada/entrada_estoque.php?1=<?php //echo $dados_login2['codigo_pro']?>" data-toggle="modal" data-target="#ModalMapaTela" class="btn btn-primary btn-xs">ENTRADA<i class=""></i></a>-->
                                                           
                                                    <a href="../site/slide/modal_editar.php?1=<?php echo $dados_login['cod']; ?>" data-remote="../site/slide/modal_editar.php?1=<?php echo $dados_login['cod']; ?>" data-toggle="modal" data-target="#modal_trafego" class="btn btn-warning btn-xs">Edit<i class=""></i></a>

                                                        <!--<a href="data/entrada/modal_editar.php?1=<?php echo $item['codigo_pro']?>&2=<?php echo $item['codigo_for']?>" data-remote="data/entrada/modal_editar.php?1=<?php echo $dados_login2['codigo_pro']?>&2=<?php echo $dados_login2['codigo_for']?>" data-toggle="modal" data-target="#modal_trafego" class="btn btn-warning btn-xs">Edit<i class=""></i></a>-->
                                                            
                                                        <!--
                                                        <a href="javascript:void(0)" data-remote="data/trafego/modal_excluir.php?1=<?php //echo $item['id'] ?>" data-toggle="modal" data-target="#deletar_trafego" class="btn btn-danger btn-xs">Del<i class=""></i></a>
                                                              --> 

                                                            </div>
                                                        </td>

                                                    </tr>
                                                
                                                <?php } ?>

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
        
        <?php include('footer.php'); ?>


        <div class="modal fade" id="ModalMapaTela" tabindex="-1" role="dialog" aria-labelledby="MyModalMapa">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="adiciona_abastecimento" tabindex="-1" role="dialog" aria-labelledby="adiciona_abastecimento">
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


    </body>
</html>

<?

}else{

echo "<script> alert('SEM AUTORIZAÇÃO AO ACESSO !'); location.href='../index.php'; windows.location.reload();</script>";
exit();         

}        

?>