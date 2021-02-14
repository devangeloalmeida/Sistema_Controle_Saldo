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


/*POR Indicação encontrou
------------------------*/

$sql_i2=$db->prepare("SELECT * FROM contas AS c JOIN usuarios As u ON c.indicado_por_id_cliente=u.id_usuario WHERE c.id_cliente=:id_cli");
$sql_i2->bindParam(':id_cli', $_GET['1']);
$sql_i2->execute();
$dados_i2 = $sql_i2->fetchAll(PDO::FETCH_ASSOC);
foreach ($dados_i2 as $i2) {                    
   // Econtrou nome do cliente por indicação
   $indicado_por_id_cliente = $i2['indicado_por_id_cliente'];
   $nome_por_indicacao      = $i2['nome'];
   $valor_comissao          = $i2['comissao_indicacao'];
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
                                <h4 class="page-title">LISTA CONTAS </h4>
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
                                            LISTA CONTAS                                     
                                        </div>

                                        <!--<table id="datatable" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">-->

                                        <table id="example" class="display" style="width:100%">

                                            <thead>
                                                <tr class="panel panel-primary">
                                                    <th width="175">CLIENTE</th>
                                                    
                                                    <th width="50">TIPO</th>
                                                    <th width="50">CONTA</th>
                                                    <th width="50">DATAS</th>                  
                                                    <th width="50">APORTE</th>                  
                                                    <th width="50">JUROS</th> 
                                                    <th width="50">COMISSÃO</th> 
                                                    <th width="50">SALDO</th> 
                                                    <th width="70">AÇÃO</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            
                                            <?php
                                            $sql_i3=$db->prepare("SELECT * FROM contas AS c JOIN usuarios As u ON c.indicado_por_id_cliente=u.id_usuario WHERE c.id_cliente=:id_cli");
                                            $sql_i3->bindParam(':id_cli', $_GET['1']);
                                            $sql_i3->execute();
                                            $dados_i3 = $sql_i3->fetch(PDO::FETCH_ASSOC);
                                            if ($sql_i3->rowCount() > 0){ 
                                                //echo "aqui...1";
                                                // Aqui eu achei que existe usuarios com contas veiculadas/indicadas
                                                //$sql_i=$db->prepare("SELECT * FROM contas AS c JOIN usuarios As u ON c.indicado_por_id_cliente=u.id_usuario WHERE c.id_cliente=:id_cli");
                                                $sql_i=$db->prepare("SELECT distinct(c.id_cliente), c.tipo_remuneracao, c.numero_conta, c.saldo, c.indicado_por_id_cliente, c.valor_aporte, c.rentabilidade_cliente, c.data_aporte, c.comissao, c.comissao_indicacao, c.data_aniversario, u.id_usuario, u.nome, c.rentabilidade_indicacao FROM contas AS c JOIN usuarios As u ON c.indicado_por_id_cliente=u.id_usuario WHERE c.id_cliente=:id_cli");
                                                $sql_i->bindParam(':id_cli', $_GET['1']);
                                                $sql_i->execute();
                                                $dados_i = $sql_i->fetchAll(PDO::FETCH_ASSOC);
                                            }else{
                                                //echo "aqui...";
                                                // Aqui eu NÂO achei que existe usuarios com contas veiculadas/indicadas
                                                $sql_i=$db->prepare("SELECT distinct(c.id_cliente), c.tipo_remuneracao, c.numero_conta, c.saldo, c.indicado_por_id_cliente, c.valor_aporte, c.rentabilidade_cliente, c.data_aniversario, c.data_aporte, c.comissao, c.comissao_indicacao, u.id_usuario, u.nome, c.rentabilidade_indicacao FROM contas AS c JOIN usuarios As u ON c.id_cliente=u.id_usuario WHERE c.indicado_por_id_cliente=:id_cli2 or c.id_cliente=:id_cli2");
                                                //$sql_i=$db->prepare("SELECT * FROM contas AS c JOIN usuarios As u ON c.indicado_por_id_cliente=u.id_usuario WHERE c.indicado_por_id_cliente=:id_cli2");
                                                $sql_i->bindParam(':id_cli2', $_GET['1']);
                                                $sql_i->execute();
                                                $dados_i = $sql_i->fetchAll(PDO::FETCH_ASSOC);
                                            }                                    
                                            foreach ($dados_i as $i) {    
                                            //echo "<br>"."ENTROU";                
                                            $admin='ADMIN';                 
                                             /*---------------------------
                                             se a conta não tem indicação
                                             ----------------------------*/                                        
                                            $sql_item=$db->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario");
                                            $sql_item->bindParam(':id_usuario', $i['id_cliente']);
                                            $sql_item->execute();
                                            $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($dados_item as $item) {                    
                                            ?>
                                                <tr>         
                                                    <td width="175">            
                                                        <?php print_r( $item['nome']);?>
                                                        <?php if (!empty($i['indicado_por_id_cliente']) ) {?>
                                                    
                                                        <?php
                                                        $sql_item2=$db->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario");
                                                        $sql_item2->bindParam(':id_usuario', $i['indicado_por_id_cliente']);
                                                        $sql_item2->execute();
                                                        $dados_item2 = $sql_item2->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($dados_item2 as $item2){ ?>
                                                            <label class="alert alert-success alert-xs">COMISSIONADO
                                                            <a href="lista_conta.php?1=<?php echo $item2['id_usuario'];?>"><?php echo $item2['nome'];;?> </a> </label>
                                                        <?php }
                                                        ?>

                                                         

                                                        <?php }else{?>
                                                            <label class="alert alert-warning alert-xs" >SEM COMISSIONADO</label>
                                                        <?php }?>

                                                    </td>
                                                    
                                                    
                                                    <td width="50">            
                                                        <?php print_r( $i['tipo_remuneracao']);?>
                                                    </td>
                                                    <td width="50">                                 
                                                        <span class="badge badge-primary"><?php echo $i['numero_conta'];
                                                        ?></span>
                                                    </td> 
                                                    
                                                    <td width="50">
                                                        <?php    
                                                        echo '<b>Aporte:</b><br>'.date('d/m/Y',strtotime($i['data_aporte']));
                                                        echo '<br>';
                                                        echo '<b>Dia </b>'.$i['data_aniversario'].'<b>, data aniversário </b>';
                                                        ?>
                                                    </td>
                                                    <td width="50">
                                                        <?php                                       
                                                        
                                                        echo 'R$ '.number_format($i['valor_aporte'], 2, ',', '.'); 
                                                        ?>
                                                    </td>

                                                    <td width="50">
                                                        <?php
                                                         echo 'R$ '.number_format($i['rentabilidade_cliente'], 2, ',', '.');
                                                        ?>
                                                        <p class="text-muted font-13 m-b-15 m-t-20">Comissão do cliente <b><?php echo $i['comissao'];?>%</b> e indicado <b><?php echo $i['comissao_indicacao'];?>%</b></p>
                                                    </td>

                                                    <td width="50">
                                                        <?php
                                                         echo 'R$ '.number_format($i['rentabilidade_indicacao'], 2, ',', '.');
                                                        ?>
                                                    </td>

                                                    <td width="50">
                                                        <?php                      
                                                                             
                                                        echo 'R$ '.number_format($i['saldo'], 2, ',', '.'); 
                                                        ?>
                                                    </td>

                                                    <td width="70" class="text-right">        
                                                        
                                                    <div class="m-t-10">
                                                    
                                                        <div class="form-group">
                                                            <a href="add_dc.php?1=<?php echo $item['id_usuario'];?>&2=<?php echo $i['numero_conta'];?>"  class="btn btn-danger btn-xs waves-effect waves-light">Debitar/Creditar</a>
                                                        </div>
                                                    
                                                        <div class="form-group">    
                                                            <a href="extrato.php?1=<?php echo $i['numero_conta'];?>&2=<?php echo $item['id_usuario'];?>"  class="btn btn-primary btn-xs waves-effect waves-light">Extrato da conta</a>
                                                        </div>
                                                    
                                                    </div>

                                                    </td>
                                                </tr> 

                                                <?php } 

                                                }?>

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