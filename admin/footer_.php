            </div>

            <footer class="footer text-center">
                <?php echo date('Y'); ?> <a href='http://www.focosite.com.br' parent='_blank'>© Develop Focosite</a>
            </footer>

        </div>
    </div>

    <script>var resizefunc = [];</script>
     <!--<script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    -->
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
    
        <!-- KNOB JS -->
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart -->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard init -->
        <script src="assets/pages/jquery.dashboard.js"></script>  

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    <!-- App js 
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/app.js"></script>
    -->

    <!-- Upload e Fotos -->
    <!--<script src="dist/jquery.fileuploader.min.js" type="text/javascript"></script>
    <script src="js/custom.js" type="text/javascript"></script>
    -->

        <!-- impressão js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


    <script type="text/javascript">
            // Date Picker
        jQuery('#datepicker').datepicker();
    </script>

    <!-- seleção de múltiplas opções -->
    <link href="css/select2.min.css" rel="stylesheet" />
    <script src="js/select2.min.js"></script>
    <script src="js/filter_table.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.idioma').select2({tags: true});
            $("input[name=tipo]").on( "change", function() {
               var tipo = $(this).val();
               $(".tipo").hide();
               $("#"+tipo).show();
           });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.interesse').select2({tags: true});
            $("input[name=tipo]").on( "change", function() {
               var tipo = $(this).val();
               $(".tipo").hide();
               $("#"+tipo).show();
           });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>


</body>
</html>