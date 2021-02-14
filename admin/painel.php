<?php
session_start();
include('data/config.php');
$sql_login  = $db->prepare("SELECT * FROM usuarios WHERE login = :email AND senha = :senha LIMIT 1");    
$sql_login->bindValue(':email', $_SESSION['email']);
$sql_login->bindValue(':senha', sha1( $_SESSION['senha']) );
$sql_login->execute();
$dados_login = $sql_login->fetch(PDO::FETCH_ASSOC);
$saldo=0;
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
                        		
                                  <div class="row">

                            <div class="col-lg-3 col-md-6">
                                <div class="card-box">                                   
                                    <h4 class="header-title m-t-0 m-b-30">Total do Saldo</h4>
                                    <div class="widget-chart-1">
                                        <div class="widget-detail-1">
                                            <h4 class="p-t-10 m-b-0"> 
                                                <?php 
                                                // recebendo o resultado da consulta
                                                $se=$db->query("SELECT saldo FROM contas");
                                                $se->execute();
                                                $dados = $se->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($dados as $sed) {
                                                   $saldo = $saldo + $sed['saldo'];
                                                } print number_format($saldo, 2, ',', '.');?>
                                            </h4>
                                            <p class="text-muted">Total R$</p>
                                            <?php 
                                                // recebendo o resultado da consulta
                                                $select = $db->query("SELECT * FROM usuarios WHERE tipo_usuario='CLIENTE' ")->fetchAll();
                                                // atribuindo a quantidade de linhas retornadas
                                                $count = count($select);
                                                // imprimindo o resultado
                                                print "<b>Qtd. das contas: ".$count."</b>";
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-lg-3 col-md-6">
                                <div class="card-box">                                   
                                    <h4 class="header-title m-t-0 m-b-30">Cálculos</h4>
                                    
                                        <a type="button" href="calcular.php" class="btn btn-success btn-xs">Rentabilidade diária</a>
                                    
                                    <hr>
                                    
                                    <!--<a type="button" href="calcular_saque.php" class="btn btn-success btn-xs">Saques diários </a>-->
                                    
                                </div>
                            </div> <!--end col -->

                            <!--<div class="col-lg-3 col-md-6">
                                <div class="card-box">                                   
                                    <h4 class="header-title m-t-0 m-b-30">Total da Comissão</h4>
                                    <div class="widget-chart-1">
                                        <div class="widget-detail-1">
                                            <h4 class="p-t-10 m-b-0"> 
                                                <?php 
                                                // recebendo o resultado da consulta
                                                $se3=$db->query("SELECT rentabilidade_indicacao FROM contas");
                                                $se3->execute();
                                                $dados3 = $se3->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($dados3 as $sed3) {
                                                   $saldo3 = $saldo3 + $sed3['rentabilidade_indicacao'];
                                                } print number_format($saldo3, 2, ',', '.');?>
                                            </h4>
                                            <p class="text-muted">Total R$</p>

                                        </div>

                                    </div>
                                    
                                </div>
                            </div> end col -->




                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                    
                                    <div class="card-box">


                                    <a href="cadastro_cli.php" class="btn btn-primary btn-lg pull-right">Novo cliente</a>

                                        <div class="panel-heading" >
                                            CADASTRO DE CLIENTES                                        
                                        </div>

                                        <table id="datatable" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">

                                            <thead>
                                                <tr class="panel panel-primary">
                                                    <th width="100">NOME</th>
                                                    <th width="50">CPF</th>
                                                    <th width="50">TELEFONE</th>
                                                    <th width="100">E-MAIL</th>                  
                                                    <th width="70">AÇÃO</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            <?php                               
                                            $admin='ADMIN';                 
                                            $sql_item = $db->prepare("SELECT * FROM usuarios WHERE tipo_usuario!=:tipo ORDER BY id_usuario DESC ");
                                            $sql_item->bindParam(':tipo', $admin);
                                            $sql_item->execute();
                                            $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($dados_item as $item) {                    
                                            ?>
                                                <tr>         
                                                    
                                                    <td width="100">
                                                        <?php 
                                                        /*-----------------------------------------
                                                        Quando existe conta com indicação encontrou
                                                        ------------------------------------------*/
                                                        $sql_i3=$db->prepare("SELECT * FROM contas AS c JOIN usuarios As u ON c.indicado_por_id_cliente=u.id_usuario WHERE c.id_cliente=:id_cli");
                                                        $sql_i3->bindParam(':id_cli', $item['id_usuario']);
                                                        $sql_i3->execute();
                                                        $dados_i3 = $sql_i3->fetch(PDO::FETCH_ASSOC);
                                                        if ($sql_i3->rowCount() > 0) {                        
                                                           // Econtrou nome do cliente por indicação
                                                           $_SESSION['indicado_por_id_cliente']=$dados_i3['indicado_por_id_cliente'];?>                
                                                           <a type="button" class="btn btn-primary btn-xs" href="lista_conta.php?1=<?php echo $item['id_usuario'];?>&2=<?php echo $_SESSION['indicado_por_id_cliente'];?>"><?php print_r( $item['nome']);?></a><br><label>Conta comissionada</label>
                                                        <?php } else{
                                                            $indicado_cliente="X01";?>
                                                            <a type="button" class="btn btn-primary btn-xs" href="lista_conta.php?1=<?php echo $item['id_usuario'];?>&2=<?php echo $indicado_cliente;?>"><?php print_r( $item['nome']);?></a> 
                                                        <?php }?>
                                                        <!-- 
                                                        Criar botão seleção de conta por nome de usuário
                                                        -->                                                        
                                                    </td>
                                                                                                            
                                                    <td width="50">
                                                        <?php                                       
                                                        echo $item['cpf']
                                                        ?>
                                                    </td> 
                                                    <td width="50">
                                                            <?php                                   
                                                        echo $item['telefone']
                                                        ?>
                                                    </td>

                                                    <td width="100">
                                                        <?php                                  
                                                        echo $item['email'];
                                                        ?>
                                                    </td>
                                                
                                                    <td width="70" class="text-right"> 
                                                       
                                                       <a href="contas/modal_excluir_conta.php?1=<?php echo $item['id_usuario'];?>" data-remote="contas/modal_excluir_conta.php?1=<?php echo $item['id_usuario'];?>&2=<? echo $dados_i3['numero_conta'];?>" data-toggle="modal" data-target="#edit_foto" class="btn btn-danger btn-xs">Excluir usuário</a>

                                                       <a href="modal_add_conta3.php?1=<?php echo $item['id_usuario'];?>"class="btn btn-success btn-xs">Criar nova conta</a>
                                                     
                                                    </td>
                                                </tr> 
                                                <?php } ?>

                                            </tbody>
8
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