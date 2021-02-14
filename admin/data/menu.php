<?php session_start();?>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    
                    <!-- User -->
                    <div class="user-box"> 
                        <div class="user-img">
                            <?php //if( empty($_SESSION['foto']) ){?>
                                <!--<img src="../admin/usuario/upload/images.png" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">-->
                            <?php //}else{?>
                                <img src="../admin/assets/images/admin.jpg" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                            <?php //}?>    
                        </div>
                        <ul class="list-inline">                            
                            <li>
                                <a href="data/sair.php" class="text-custom">
                                    <i class="zmdi zmdi-power"></i> SAIR
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="text-muted menu-title">NAVEGAÇÃO</li>
                            <h6><?php //echo $_SESSION['tipo_usuario'];?></h6>

<?php //if ($_SESSION['tipo_usuario'] ==  "ADMIN"){?>
                            
                            <li>
                                <a href="painel.php" class="waves-effect"><i class="zmdi zmdi-invert-colors"></i> <span> INÍCIO </span> </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-invert-colors"></i> <span>CLIENTE</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="painel.php">Cadastro</a></li>
                                </ul>
                            </li>
                           
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-invert-colors"></i> <span>PAGAMENTOS</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="saque_automatico.php">Saque dos clientes</a></li>
                                </ul>
                            </li>

                            <!--<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-invert-colors"></i> <span>RELATÓRIOS </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="cliente_total.php">Total clientes e totais</a></li>
                                    <li>
                                        <a href="paga_rentabilidade.php">Rentabilidad mensal</a>
                                    </li>
                                </ul>
                            </li>-->

                            
<?php //}?>


                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->