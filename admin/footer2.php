        

            <footer class="footer text-center">
                <?php echo date('Y'); ?> <a href='#' parent='_blank'>© Colocar Centro Tecnológico Municipal - CTM - LRV - SME</a>
            </footer>
        
        </div>
   </div>
</div>
        
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/detect.js"></script>
        <script src="../assets/js/fastclick.js"></script>
        <script src="../assets/js/jquery.slimscroll.js"></script>
        <script src="../assets/js/jquery.blockUI.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/js/jquery.scrollTo.min.js"></script>

        
        <!-- Plugins Js -->
        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="../assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="../assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/moment/moment.js"></script>
        <script src="../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="../assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="../assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
        
        <!-- Datatables-->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.scroller.min.js"></script>

        
        <!-- Datatable init js -->
        <script src="../assets/pages/datatables.init.js"></script>

        <!-- file uploads js -->
        <script src="../assets/plugins/fileuploads/js/dropify.min.js"></script>

        <!-- Form wizard -->
        <script src="../assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
        <script src="../assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>

        <!-- Sweet Alert js -->
        <script src="../assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
        <script src="../assets/pages/jquery.sweet-alert.init.js"></script>


        <script type="text/javascript">
            $('.dropify').dropify({
                messages: {
                    'default': 'Arraste e solte um arquivo aqui ou clique',
                    'replace': 'Arraste e solte um arquivo ou clique para substituir',
                    'remove': 'Remove',
                    'error': 'Ooops, algo errado no anexo.'
                },
                error: {
                    'fileSize': 'O tamanho do arquivo é muito grande (1M max).'
                }
            });
        </script>



        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "../assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();
        </script>

        

        <!-- Upload e Fotos -->
        <script src="../dist/jquery.fileuploader.min.js" type="text/javascript"></script>
        <script src="../js/custom.js" type="text/javascript"></script>

        <!-- seleção de múltiplas opções -->
        <link href="../assets/css/select2.min.css" rel="stylesheet" />
        <script src="../assets/js/select2.min.js"></script>
        <script src="../js/filter_table.js"></script>

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
            $("#success-alert").fadeTo(3000, 1000).slideUp(1000, function(){
                $("#success-alert").slideUp(3000);
            });
        </script>


    <script type="text/javascript"> 
    // CHECK-BOX Forma 1 - seleciona todos
    $("#checkTodos").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    // CHECK-BOX Forma 2
    $("#checkTodos").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
    
    // CHECK-BOX Forma 3
    var checkTodos = $("#checkTodos");
    checkTodos.click(function () {
        if ( $(this).is(':checked') ){
            $('input:checkbox').prop("checked", true);
        }else{
            $('input:checkbox').prop("checked", false);
        }
    });
    </script>

<script type="text/javascript">

            jQuery(document).ready(function() {

                //advance multiselect start
                $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });

                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                  maximumSelectionLength: 2
                });

            });

            //Bootstrap-TouchSpin
            $(".vertical-spin").TouchSpin({
                verticalbuttons: true,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary",
                verticalupclass: 'ti-plus',
                verticaldownclass: 'ti-minus'
            });
            var vspinTrue = $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            if (vspinTrue) {
                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
            }

            $("input[name='demo1']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary",
                postfix: '%'
            });
            $("input[name='demo2']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary",
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='demo3']").TouchSpin({
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });
            $("input[name='demo3_21']").TouchSpin({
                initval: 40,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });
            $("input[name='demo3_22']").TouchSpin({
                initval: 40,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });

            $("input[name='demo5']").TouchSpin({
                prefix: "pre",
                postfix: "post",
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });
            $("input[name='demo0']").TouchSpin({
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });

            // Time Picker
            jQuery('#timepicker').timepicker({
                defaultTIme : false
            });
            jQuery('#timepicker2').timepicker({
                showMeridian : false
            });
            jQuery('#timepicker3').timepicker({
                minuteStep : 15
            });

            //colorpicker start

            $('.colorpicker-default').colorpicker({
                format: 'hex'
            });
            $('.colorpicker-rgba').colorpicker();

            // Date Picker
            jQuery('#datepicker').datepicker();
            jQuery('#datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            jQuery('#datepicker-inline').datepicker();
            jQuery('#datepicker-multiple-date').datepicker({
                format: "mm/dd/yyyy",
                clearBtn: true,
                multidate: true,
                multidateSeparator: ","
            });
            jQuery('#date-range').datepicker({
                toggleActive: true
            });

            //Date range picker
            $('.input-daterange-datepicker').daterangepicker({
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-default',
                cancelClass: 'btn-primary'
            });
            $('.input-daterange-timepicker').daterangepicker({
                timePicker: true,
                format: 'MM/DD/YYYY h:mm A',
                timePickerIncrement: 30,
                timePicker12Hour: true,
                timePickerSeconds: false,
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-default',
                cancelClass: 'btn-primary'
            });
            $('.input-limit-datepicker').daterangepicker({
                format: 'MM/DD/YYYY',
                minDate: '06/01/2016',
                maxDate: '06/30/2016',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-default',
                cancelClass: 'btn-primary',
                dateLimit: {
                    days: 6
                }
            });

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2016',
                maxDate: '12/31/2016',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-success',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            //Bootstrap-MaxLength
            $('input#defaultconfig').maxlength()

            $('input#thresholdconfig').maxlength({
                threshold: 20
            });

            $('input#moreoptions').maxlength({
                alwaysShow: true,
                warningClass: "label label-success",
                limitReachedClass: "label label-danger"
            });

            $('input#alloptions').maxlength({
                alwaysShow: true,
                warningClass: "label label-success",
                limitReachedClass: "label label-danger",
                separator: ' out of ',
                preText: 'You typed ',
                postText: ' chars available.',
                validate: true
            });

            $('textarea#textarea').maxlength({
                alwaysShow: true
            });

            $('input#placement').maxlength({
                alwaysShow: true,
                placement: 'top-left'
            });
        </script>

<script>
    function goBack() {
        window.history.back();    
    }
</script>


    </body>
</html>

