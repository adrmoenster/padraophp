<?php
ob_start();
session_start();
require('../_app/Config.inc.php');

$login = new Login(2); //Nivel de acesso necessário
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN); //pegando na url a string logoff
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);



if (!$login->CheckLogin())://Se retonar resultado é porque não está logado ou não tem permissão
    unset($_SESSION['userlogin']); //Limpa a sessão de nome userlogin
    header('Location: index.php?exe=restrito'); //retorna a tela de login com mensagem de restrito
else://se entrou no else então está logado
    $userlogin = $_SESSION['userlogin']; //Atribui a váriável userlogin as informações da sessão userlogin
endif;

if ($logoff)://se busca na url pela string logoff retornar resultado então entra no if
    unset($_SESSION['userlogin']); //limpa a sessão
    header('Location: index.php?exe=logoff'); //deslogando então direciona para index com o exe igual a logoff
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>


        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <link rel="icon" type="image/png" sizes="16x16" href="img/br.jpg"><link rel="icon" type="image/png" sizes="32x32" href="img/br.jpg"><link rel="icon" sizes="192x192" href="img/br.jpg">
        <title><?= SITENAME; ?></title>
        <!--[if lt IE 9]>
                   <script src="../_cdn/html5.js"></script> 
                <![endif]-->

        <!-- Bootstrap -->
        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="font/css/font-awesome.min.css" rel="stylesheet">




        <!--Aqui para baixo oque for usando passa para cima deste texto e oque não vai apagando-->


        <!-- bootstrap-progressbar -->
        <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

        <!-- PNotify -->
        <link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
        <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
        <link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

        <!-- NProgress -->
        <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-wysiwyg -->
        <link href="vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- starrr -->
        <link href="vendors/starrr/dist/starrr.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- bootstrap-datetimepicker -->
        <link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- Ion.RangeSlider -->
        <link href="vendors/normalize-css/normalize.css" rel="stylesheet">
        <link href="vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
        <link href="vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
        <!-- Bootstrap Colorpicker -->
        <link href="vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">



        <!-- Datatables -- influencia nas tabelas -->
        <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

        <!-- Dropzone.js -->
        <link href="vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

        <!-- Custom Theme Style - parte de tela de login é atingida por essa opção, também todo site-->
        <link href="css/custom.min.css" rel="stylesheet">

        <style>

            #posicao{
                display:none;

            }

        </style>


        <!-- USADO NO CROPER - INICIO -->
        <link href="css/cropper.min.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <!-- USADO NO CROPER - FIM -->

        <!-- Custom Theme Style -->
        <link href="build/css/custom.min.css" rel="stylesheet">



    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php include_once './inc/sidebar.inc.php'; ?>

                <?php include_once './inc/header.inc.php'; ?>

                <?php
                if (isset($getexe)):
                    $linkto = explode('/', $getexe);

                else:
                    $linkto = array();

                endif;
                ?>

                <div id="painel">
                    <?php
                    //QUERY STRING
                    //Isso é um padrão de projeto chamado front controller - decide qual controlador será executado e carregado no sistema
                    if (!empty($getexe)):
                        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');

                    else:
                        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'home.php';
                    endif;

                    if (file_exists($includepatch) && $getexe != 'usuario/cadastra' && $getexe != 'usuario/edita' && $getexe != 'usuario/lista' && $getexe != 'materia-noticia/cadastra' && $getexe != 'materia-noticia/edita' && $getexe != 'materia-noticia/lista' && $getexe != 'anuncio/cadastra' && $getexe != 'anuncio/edita' && $getexe != 'anuncio/lista' && $getexe != 'classificado/cadastra' && $getexe != 'classificado/edita' && $getexe != 'classificado/lista'):
                        require_once $includepatch;
                    elseif (file_exists($includepatch) && $getexe == 'usuario/cadastra' || file_exists($includepatch) && $getexe == 'usuario/edita' || file_exists($includepatch) && $getexe == 'usuario/lista' || file_exists($includepatch) && $getexe == 'anuncio/cadastra' || file_exists($includepatch) && $getexe == 'anuncio/edita' || file_exists($includepatch) && $getexe == 'anuncio/lista'):
                        if ($_SESSION['userlogin']['usuario_nivel'] > 3):
                            require_once $includepatch;
                        else:
                            $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'semnivel.php';
                            require_once $includepatch;

                        endif;
                    elseif (file_exists($includepatch) && $getexe == 'materia-noticia/cadastra' || file_exists($includepatch) && $getexe == 'materia-noticia/edita' || file_exists($includepatch) && $getexe == 'materia-noticia/lista' || file_exists($includepatch) && $getexe == 'classificado/cadastra' || file_exists($includepatch) && $getexe == 'classificado/edita' || file_exists($includepatch) && $getexe == 'classificado/lista'):
                        if ($_SESSION['userlogin']['usuario_nivel'] > 2):
                            require_once $includepatch;
                        else:
                            $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'semnivel.php';
                            require_once $includepatch;

                        endif;
                    else:
                        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . '404.php';
                        require_once $includepatch;

                        echo "</div>";
                    endif;
                    ?>
                </div> <!-- painel -->

                <?php include_once './inc/footer.inc.php'; ?>
            </div>
        </div>







        <!-- GRAFICOS INICIO -->
        <!-- jQuery -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>


        <script src="vendors/raphael/raphael.min.js"></script>
        <script src="vendors/morris.js/morris.min.js"></script>
        <!-- GRAFICOS FIM -->
        <script src="vendors/Chart.js/dist/Chart.min.js"></script>






        <!-- aqui para baixo está na ordem certa -- se ver que algo não funcionou confirme ordem -->


        <!-- jQuery este e o bootstrap.min.js interferem no scrol dos menus-->
        <script src="js/jquery.min.js"></script>

        <!-- Bootstrap este e o jquery.min.js interferem no scrol dos menus-->
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- FastClick -->
        <script src="vendors/fastclick/lib/fastclick.js"></script>

        <!-- NProgress -->
        <script src="vendors/nprogress/nprogress.js"></script>

        <!-- Dropzone.js -->
        <script src="vendors/dropzone/dist/min/dropzone.min.js"></script>
        <!-- validator - este em formulários que existem validações de campo obrigatorio nos input essa opção é necessária-->
        <script src="vendors/validator/validator.js"></script>


        <!-- jQuery Sparklines -->
        <script src="vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

        <!-- gauge.js -->
        <script src="vendors/gauge.js/dist/gauge.min.js"></script>

        <!-- bootstrap-progressbar - interfere em um monte de graficos-->
        <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

        <!-- iCheck -->
        <script src="vendors/iCheck/icheck.min.js"></script>

        <!-- Skycons - se remover some com alguns icones-->
        <script src="vendors/skycons/skycons.js"></script>

        <!-- Flot -->
        <script src="vendors/Flot/jquery.flot.js"></script>
        <script src="vendors/Flot/jquery.flot.pie.js"></script>
        <script src="vendors/Flot/jquery.flot.time.js"></script>
        <script src="vendors/Flot/jquery.flot.stack.js"></script>
        <script src="vendors/Flot/jquery.flot.resize.js"></script>

        <!-- Flot plugins -->
        <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="vendors/flot.curvedlines/curvedLines.js"></script>

        <!-- DateJS tem relação com data - chegou dar problema na home no mapa e previsão do tempo-->
        <script src="vendors/DateJS/build/date.js"></script>

        <!-- bootstrap-daterangepicker -->
        <script src="vendors/moment/min/moment.min.js"></script>
        <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- bootstrap-datetimepicker -->    
        <script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

        <!-- Ion.RangeSlider -->
        <script src="vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>

        <!-- Bootstrap Colorpicker -->
        <script src="vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

        <!-- jquery.inputmask - mascaras de data, phone, serial, cartão-->
        <script src="vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

        <!-- jQuery Knob -->
        <script src="vendors/jquery-knob/dist/jquery.knob.min.js"></script>

        <!-- JQVMap - esses dois interferem no mapa mundi do index-->
        <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

        <!-- Datatables -- influencia nas tabelas -->
        <script src="vendors/datatables.net/js/jquery.dataTables.js"></script>
        <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="vendors/jszip/dist/jszip.min.js"></script>

        <!-- Responsável por gerar os arquivos PDF  -->
        <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="vendors/pdfmake/build/vfs_fonts.js"></script>


        <!-- bootstrap-wysiwyg -->
        <script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="vendors/google-code-prettify/src/prettify.js"></script>
        <!-- jQuery Tags Input -->
        <script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
        <!-- Switchery -->
        <script src="vendors/switchery/dist/switchery.min.js"></script>
        <!-- Select2 -->
        <script src="vendors/select2/dist/js/select2.full.min.js"></script>
        <!-- Parsley - faz validação alternativa dos inputs na pagina de formulario-->
        <script src="vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- Autosize -->
        <script src="vendors/autosize/dist/autosize.min.js"></script>
        <!-- jQuery autocomplete -->
        <script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <!-- starrr -->
        <script src="vendors/starrr/dist/starrr.js"></script>


        <!-- Custom Theme Scripts - este deve ficar aqui se colocar no inicio ele causa bug-->
        <script src="js/custom.min.js"></script>



        <script src="../_cdn/jmask.js"></script>

        <script src="__jsc/tinymce2/js/tinymce/tinymce.js"></script>


        <script>
            tinymce.init({
            selector: '.js_editor',
                    height: 500,
                    theme: 'modern',
                    plugins: 'spellchecker print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount  imagetools    contextmenu colorpicker textpattern help',
                    toolbar1: 'spellchecker | media | formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                    image_advtab: true,
                    templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                    ],
                    content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css'
                    ],
                    image_description: true,
                    image_caption: true,
                    image_class_list: [
                    {title: 'Responsiva', value: 'img-fluid rounded'},
                    ],
                    language: 'pt_BR',
                    language_url : '__jsc/tinymce2/langs/pt_BR.js'

            });
            tinymce.init({
            selector: '.js_live',
                    height: 500,
                    theme: 'modern',
                    plugins: 'spellchecker print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount  imagetools    contextmenu colorpicker textpattern help',
                    toolbar1: 'spellchecker | media | formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                    image_advtab: true,
                    templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                    ],
                    content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css'
                    ],
                    image_description: true,
                    image_caption: true,
                    image_class_list: [
                    {title: 'Responsiva', value: 'img-fluid rounded'}
                    ],
                    language: 'pt_BR',
                    language_url : '__jsc/tinymce2/langs/pt_BR.js'

            });
        </script>

        <!-- Initialize datetimepicker -->
        <script>
            $('#myDatepicker').datetimepicker();
            $('#myDatepicker2').datetimepicker({
            format: 'DD.MM.YYYY'
            });
            $('#myDatepicker3').datetimepicker({
            format: 'hh:mm A'
            });
            $('#myDatepicker4').datetimepicker({
            ignoreReadonly: true,
                    allowInputToggle: true
            });
            $('#datetimepicker6').datetimepicker();
            $('#datetimepicker7').datetimepicker({
            useCurrent: false
            });
            $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        </script>






        <!-- GRÁFICOS DO PAÍNEL - INICIO-->
        <?php
        $ReadVisita = new Read;
        $ReadVisita->ExeRead("siteviews_agent", "WHERE siteviews_agent_id > 0 ORDER BY agent_views DESC LIMIT 6");
        ?>

        <script>
            if ($('#graph_bar2').length) {

            Morris.Bar({
            element: 'graph_bar2',
                    data: [
<?php
if ($ReadVisita->getResult()):
    foreach ($ReadVisita->getResult() AS $Rvis):
        ?>
                            {device: '<?= $Rvis['agent_name']; ?>', geekbench: <?= $Rvis['agent_views']; ?>},
        <?php
    endforeach;
endif;
?>

                    ],
                    xkey: 'device',
                    ykeys: ['geekbench'],
                    labels: ['Visitas'],
                    barRatio: 0.4,
                    barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                    xLabelAngle: 35,
                    hideHover: 'auto',
                    resize: true
            });
            }
        </script>     




        <?php
        $Readjack = new Read;
        $Readjack->ExeRead("siteviews_agent", "WHERE siteviews_agent_id > 0 LIMIT 5");
        ?>
        <script>
            if ($('#graph_donut').length) {

            Morris.Donut({
            element: 'graph_donut',
                    data: [
<?php
if ($Readjack->getResult()):
    foreach ($Readjack->getResult() AS $Jack):
        ?>
                            {label: '<?= $Jack['agent_name'] ?>', value: <?= $Jack['agent_views'] ?>},
        <?php
    endforeach;
endif;
?>

                    ],
                    colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB', '#9B59B6'],
                    formatter: function (y) {
                    return y + "Visitas";
                    },
                    resize: true
            });
            }
        </script>
        <!-- GRÁFICOS DO PAÍNEL - FIM-->


<!--        <script src="js/bootstrap.min.js"></script>
        <script src="js/cropper.min.js"></script>
        <script src="js/main.js"></script>-->

    </body>



</html>