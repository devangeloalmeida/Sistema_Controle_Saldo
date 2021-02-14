<!doctype html>
<html class="no-js" lang="pt">
    <head>
        <title>SportSocial</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <!-- Notification css (Toastr) -->
        <link href="../assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert css -->
        <link href="../assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />

         <!-- Plugins css-->
        <link href="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="../assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css">
        <link href="../assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css">
        <link href="../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="../assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="../assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- App CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/font-awesome.css" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="../assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>        
      
        <!-- Ckeditor         -->
        <link rel="stylesheet" href="../assets/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
      
        <link href="../assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
      
        <!--UPLOAD DE FOTOS-->
        <link href="../dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">
        <link href="../dist/jquery.fileuploader-theme-thumbnails.css" media="all" rel="stylesheet">
        
        <script src="../js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript"> 
            $(document).ready(function () {

              $.getJSON('../js/estados_cidades.json', function (data) {

                var items = [];
                var options = '<option value="">escolha um estado</option>';  

                $.each(data, function (key, val) {
                  options += '<option value="' + val.nome + '">' + val.nome + '</option>';
              });         
                $("#estados").html(options);        

                $("#estados").change(function () {        

                  var options_cidades = '';
                  var str = "";         

                  $("#estados option:selected").each(function () {
                    str += $(this).text();
                });

                  $.each(data, function (key, val) {
                    if(val.nome == str) {             
                      $.each(val.cidades, function (key_city, val_city) {
                        options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                    });             
                  }
              });

                  $("#cidades").html(options_cidades);

              }).change();    

            });

          });
      </script>   

<style type="text/css">
  #ajuste{
    font-size: 20px;
     padding: 10px;
  }
</style>


<script type="text/javascript"> 
/* Máscaras ER */
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
</script>

</head>


<body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="../painel.php" class="logo"><span>Sport<span>Social</span></span><i class="zmdi zmdi-layers"></i></a>                    
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
                                <h4 class="page-title">Painel Administrativo</h4>
                            </li>
                        </ul>

                    </div><!-- end container -->
                </div><!-- end navbar -->

            </div>
            <!-- Top Bar End -->
