<style type="text/css">
.anyClass {
  height:150px;
  overflow-y: scroll;
}
</style>
<?php 
//session_start();
?>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <ul class="list-inline">                            
                            <li>
                                <a href="../logout.php" class="text-custom">
                                    <i class="zmdi zmdi-power"></i> SAIR
                                    <br>
                                    <?php if ( $_SESSION['id_nivel_usuario'] !='101' ){ ;?>
                                    <a href="vendedor/pessoas.php"  class="logo img-responsive"><img width="40" height="40" src="../usuario/upload/<?php echo $_SESSION['foto'];?>"></a>
                                    <?php }?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        
                        <ul>
                            <li class="text-muted menu-title"><?php echo 'ID:'.$_SESSION['id_usuario'] .'-'. $_SESSION['nome_usuario'];?>
                                <?php 
                                if( $_SESSION['id_nivel_usuario'] == '101'){
                                    echo "<br>"."ADMINISTRADOR";
                                }elseif ( $_SESSION['id_nivel_usuario'] == '103' ) {
                                    echo "<br>"."USUÁRIO";
                                } ;?>
                            </li>

<?php if($_SESSION['id_nivel_usuario'] == '101'){ // ADMINISTRADOR ?>

                            <li>
                                <a href="painel.php" class="waves-effect"><i class="ti-home"></i> <span> HOME </span> </a>
                            </li>    
                            
                            <li>
                                <a href="../usuario/painel.php" class="waves-effect"><i class="ti-home"></i> <span> USUÁRIO </span> </a>
                            </li>    

                            <li>
                                <a href="../lotes/painel.php" class="waves-effect"><i class="ti-home"></i> <span> LOTES </span> </a>
                            </li>   

                            <li>
                                <a href="../cupons/painel.php" class="waves-effect"><i class="ti-home"></i> <span>  CARTELAS </span> </a>
                            </li>     

                            <!--<li class="has_sub">                                
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-face-smile"></i> <span> USUÁRIOS</span> <span class="menu-arrow "></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="../usuario/painel_ativo.php">ATIVOS</a></li>
                                </ul>
                            </li>-->
   
<?php }?>


<?php 
if ($_SESSION['id_nivel_usuario'] == '103'  ){ // USUÁRIO ?>


                            <li>
                                <a href="../cupons/painel.php" class="waves-effect"><i class="ti-home"></i> <span>  CARTELAS </span> </a>
                            </li>    
                            <li>
                                <a href="sorteio.php" class="waves-effect"><i class="ti-home"></i> <span>  SORTEIO </span> </a>
                            </li>    

<?php }?> 




                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->