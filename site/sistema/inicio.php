<!-- 
/////////////////////////////////////////////////////////////////
///////////////////// Direitos de código ////////////////////////
/////////////////////// ZATER SOLUÇÕES //////////////////////////
////////////////////// www.zater.com.br /////////////////////////
/////////////////////////////////////////////////////////////////
///////////////////////// CREATE BY /////////////////////////////
//////////////////// MICHEL ROBASKIEWICZ ////////////////////////
///////////////// ADRIANO SCHULTER MOENSTER /////////////////////
/////////////////////////////////////////////////////////////////
////////////////////////// 2018 /////////////////////////////////
/////////////////////////////////////////////////////////////////
///////////////////////// TWITTER ///////////////////////////////
////****************** @_robaskiewicz ***********************////
////****************** @adriano_alemao **********************////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
-->
<?php
if ($Link->getDados()):

    extract($Link->getDados());
else:
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404');
endif;
$View = new View;
$VejaMais = $View->Load('materia_mais');


$Classificado = $View->Load('classificadohome');

$ReadCor = new Read;
$ReadCor->ExeRead('categoria', "WHERE categoria_id =:idcat", "idcat={$post_categoria_pai}");
$categorianome = $ReadCor->getResult()[0]['categoria_nome'];


if ($categorianome == 'esporte'):
    ?><style>.fundo-sidebar-politica{  background-color: #088A08;} </style><?php
elseif ($categorianome == 'politica'):
    ?><style>.fundo-sidebar-politica{ background-color: #B40404;}</style><?php
elseif ($categorianome == 'entretenimento'):
    ?><style> .fundo-sidebar-politica{background-color: #eb750d;} </style><?php
else:
    ?><style> .fundo-sidebar-politica{ background-color: #088A08; }</style><?php
endif;
?>
<article class="container">
    <div class="row">
        <div class="col col-12 col-lg-8 col-xl-8 mt-4">

            <?php
            $ReadUsuario = new Read;
            $ReadUsuario->ExeRead('usuario', "WHERE usuario_status = 'on' AND usuario_id =:id", "id={$post_usuario}");
            if ($ReadUsuario->getResult()):
                foreach ($ReadUsuario->getResult() as $TT):
                    ?>
                    <h2><?= $post_titulo; ?></h2>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-12 col-lg-6">
                            <div class="autor-post mr-2">Por: <?= $TT['usuario_nome'] . ' ' . $TT['usuario_sobrenome']; ?></div> <div>    <i class=" ion-calendar"></i> Data: <?= date('d/m/Y', strtotime($post_data)); ?></div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
                <div class="col-12 col-lg-6 text-right">

                    <?php
                    $ReadCategoriaShare = new Read;
                    $ReadCategoriaShare->ExeRead('categoria', "WHERE categoria_pai is null AND categoria_id =:idcat", "idcat={$post_categoria_pai}");
                    $categorianome = $ReadCategoriaShare->getResult()[0]['categoria_nome'];
                    ?>


                    <ul class="compartilhar-redes">
                        <li class="float-right">

                            <a class="facebook customer share" href="https://www.facebook.com/sharer/sharer.php?u=<?= HOME . '/pagina/' . $categorianome . '/' . $post_nome ?>" title="Compartilhe no Facebook" target="_blank"><i class="compartilhar-icons-face ion-social-facebook"></i></a>
                        </li>
                        <li class="float-right">
                            <a class="twitter customer share" href="https://twitter.com/share?url=<?= HOME . '/pagina/' . $categorianome . '/' . $post_nome ?>&amp;text=<?= SITENAME; ?> - <?= SITESLOGAN; ?> &amp;hashtags=<?= $post_tag; ?>" title="Compartilhe no Twitter" target="_blank"><i class="compartilhar-icons-twitter ion-social-twitter"></i></a>
                        </li>
                        <li class="float-right">
                            <a class="linkedin customer share" href="https://www.linkedin.com/shareArticle?mini=true&url=<?= HOME . '/pagina/' . $categorianome . '/' . $post_nome ?>" title="Compartilhe no linkedin" target="_blank"><i class="compartilhar-icons-linkedin ion-social-linkedin"></i></a>
                        </li>
                        <li class="float-right">
                            <a href="https://api.whatsapp.com/send?text=<?= HOME . '/pagina/' . $categorianome . '/' . $post_nome ?>">  <i class="compartilhar-icons-whats ion-social-whatsapp"></i></a>

                        </li>
                        <li>Compartilhar: </li>
                    </ul>

                </div>
            </div>
            <!-- ANUNCIO Superior_post - INICIO -->
            <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                <?php
                $readAnuncio = new Read;
                $readAnuncio->ExeRead("anuncio", "WHERE anuncio_status = 'on' AND (anuncio_categoria = :cat OR anuncio_categoria_pai = :cat) AND anuncio_tamanho = '728X90' AND anuncio_posicao = 'superior_post' AND anuncio_inicio < anuncio_fim AND anuncio_img IS NOT NULL ORDER BY rand() LIMIT 1", "cat={$post_categoria_pai}");
                ?>
                <figure class="figure">
                    <?php
                    if (!$readAnuncio->getResult()):

                    else:
                        foreach ($readAnuncio->getResult() AS $RAn):
                            ?>
                            <a href="<?= $RAn['anuncio_url'] ?>" target="_blank"><img src="<?= HOME . "/img-anuncio" . $RAn['anuncio_img'] ?>" class="figure-img img-fluid rounded" alt="<?= $RAn['anuncio_nome']; ?>"></a>
                            <?php
                        endforeach;
                        ?>
                        <figcaption class="figure-caption text-right">Anúncio.</figcaption>
                    <?php
                    endif;
                    ?>
                </figure>

            </div><!-- ANUNCIO Superior_post - FIM -->

            <div class="conteudo-post"><?= $post_conteudo; ?></div><!-- CONTEUDO DO POST -->

            <!-- ANUNCIO Inferior_post - INICIO -->
            <div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                <?php
                $readAnuncio = new Read;
                $readAnuncio->ExeRead("anuncio", "WHERE anuncio_status = 'on' AND (anuncio_categoria = :cat OR anuncio_categoria_pai = :cat) AND anuncio_tamanho = '728X90' AND anuncio_posicao = 'inferior_post' AND anuncio_inicio < anuncio_fim AND anuncio_img IS NOT NULL ORDER BY rand() LIMIT 1", "cat={$post_categoria_pai}");
                ?>
                <figure class="figure">
                    <?php
                    if (!$readAnuncio->getResult()):

                    else:
                        foreach ($readAnuncio->getResult() AS $RAn):
                            ?>
                            <a href="<?= $RAn['anuncio_url'] ?>" target="_blank"><img src="<?= HOME . "/img-anuncio" . $RAn['anuncio_img'] ?>" class="figure-img img-fluid rounded" alt="<?= $RAn['anuncio_nome']; ?>"></a>
                            <?php
                        endforeach;
                        ?>
                        <figcaption class="figure-caption text-right">Anúncio.</figcaption>
                    <?php
                    endif;
                    ?>
                </figure>

            </div><!-- ANUNCIO Inferior_post - FIM -->

            <!-- GALERIA DE IMAGENS - INICIO-->


            <?php
            if ($post_slide == 'on'):
                ?>


                <noscript>
                <style>
                    .es-carousel ul{
                        display:block;
                    }
                </style>
                </noscript>
                <script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
                    <div class="rg-image-wrapper">
                    {{if itemsCount > 1}}
                    <div class="rg-image-nav">
                    <a href="#" class="rg-image-nav-prev">Previous Image</a>
                    <a href="#" class="rg-image-nav-next">Next Image</a>
                    </div>
                    {{/if}}
                    <div class="rg-image"></div>
                    <div class="rg-loading"></div>
                    <div class="rg-caption-wrapper">
                    <div class="rg-caption" style="display:none;">
                    <p></p>                                              
                    </div>
                    </div>
                    </div>
                </script>





                <div id="rg-gallery" class="rg-gallery">
                    <div class="rg-thumbs">
                        <!-- Elastislide Carousel Thumbnail Viewer -->
                        <div class="es-carousel-wrapper">
                            <div class="es-nav">
                                <span class="es-nav-prev">Previous</span>
                                <span class="es-nav-next">Next</span>
                            </div>
                            <?php
                            $ReadSlide = new Read;
                            $ReadSlide->ExeRead("postgaleria", "WHERE post_id =:ide", "ide={$post_id}");
                            ?>
                            <div class="es-carousel">
                                <ul>
                                    <?php
                                    if ($ReadSlide->getResult()):
                                        foreach ($ReadSlide->getResult() AS $Slide):
                                            $legenda = ($Slide['galeria_legenda'] == null ? ' ' : $Slide['galeria_legenda']);
                                            ?>

                                            <li><a href="#"><img src="<?= HOME . '/uploads' . $Slide['galeria_image'] ?>" data-large="<?= HOME . '/uploads' . $Slide['galeria_image'] ?>" alt="<?= HOME . '/uploads' . $Slide['galeria_image'] ?>" data-description="<?= $legenda; ?>"/></a></li>
                                            <?php
                                        endforeach;

                                    endif;
                                    ?>



                                </ul>

                                <!-- End Elastislide Carousel Thumbnail Viewer -->
                            </div><!-- rg-thumbs -->
                        </div><!-- rg-gallery -->

                    </div><!-- content -->
                </div><!-- container -->

                <?php
            endif;
            ?>

            <!-- GALERIA DE IMAGENS - FIM-->


        </div>



        <div class="col col-12 col-lg-4 col-xl-4 mt-4">

            <?php
            if ($post_tipo == 'Coluna'):

                $ReadUsu = new Read;
                $ReadUsu->ExeRead('usuario', "WHERE usuario_id =:usu", "usu={$post_usuario}");

                foreach ($ReadUsu->getResult() as $Us):


                    $sobrenomeColunista = $Us['usuario_nome'];
                    $nomeColunista = $Us['usuario_sobrenome'];


                    $ReadUsu = new Read;
                    $ReadUsu->ExeRead('usuario', "WHERE usuario_nivel = 2 AND usuario_nome =:nome AND usuario_sobrenome =:sobre", "nome={$Us['usuario_nome']}&sobre={$Us['usuario_sobrenome']}");
                    if ($ReadUsu->getResult()):
                        foreach ($ReadUsu->getResult() as $Usu):
                            $Usu['usuario_nome'];
                            $Usu['usuario_sobrenome'];
                            $Usu['usuario_avatar'];
                            ?>
                            <div class="card ">
                                <img class="card-img-top" src="<?= HOME . '/avatars' . $Usu['usuario_avatar']; ?>" alt>
                                <div class="card-block p-3">
                                    <h4 class="card-title"><?= $Usu['usuario_nome'] . ' ' . $Usu['usuario_sobrenome'] ?></h4>
                                    <p class="card-text"><?= $Usu['usuario_descricao'] ?></p>
                                </div>
                                <div class="card-footer text-center">
                                    <small class="text-muted">
                                        <a href="<?= $Usu['usuario_twitter'] ?>"><i class="compartilhar-icons-twitter ion-social-twitter"></i></a>
                                        <a href="<?= $Usu['usuario_facebook'] ?>"><i class="compartilhar-icons-face ion-social-facebook"></i></a>
                                        <a href="<?= $Usu['usuario_linkedin'] ?>"><i class="compartilhar-icons-linkedin ion-social-linkedin"></i></a>
                                       <!-- <a href="<?= $Usu['usuario_instagram'] ?>"><i style="font-size: 22px;  margin-right: 8px;" class="ion-social-instagram-outline"></i></a>-->
                                    </small>
                                </div>
                            </div>
                            <?php
                        endforeach;

                    endif;
                endforeach;

            endif;
            ?>



            <br>

            <?php
            $readAnuncio = new Read;
            $readAnuncio->ExeRead("anuncio", "WHERE anuncio_status = 'on' AND anuncio_categoria = :cat AND anuncio_tamanho = '472X420' AND anuncio_posicao = 'sidebar' AND anuncio_inicio < anuncio_fim AND anuncio_img IS NOT NULL ORDER BY rand() DESC LIMIT 1", "cat={$post_categoria}");
            $readAnuncioPai = new Read;
            $readAnuncioPai->ExeRead("anuncio", "WHERE anuncio_status = 'on' AND anuncio_categoria_pai = :cat AND anuncio_tamanho = '472X420' AND anuncio_posicao = 'sidebar' AND anuncio_inicio < anuncio_fim AND anuncio_img IS NOT NULL ORDER BY rand() DESC LIMIT 1", "cat={$post_categoria_pai}");
            ?>

            <figure class="figure">
                <?php
                if ($readAnuncioPai->getResult() && !$readAnuncio->getResult()):
                    foreach ($readAnuncioPai->getResult() AS $RAP):
                        ?>
                        <a href="<?= $RAP['anuncio_url'] ?>" target="_blank"><img src="<?= HOME . "/img-anuncio" . $RAP['anuncio_img'] ?>" class="figure-img img-fluid rounded" alt="<?= $RAP['anuncio_url'] ?>"></a>
                        <?php
                    endforeach;
                elseif ($readAnuncio->getResult()):
                    foreach ($readAnuncio->getResult() AS $RAn):
                        ?>
                        <a href="<?= $RAn['anuncio_url'] ?>" target="_blank"><img src="<?= HOME . "/img-anuncio" . $RAn['anuncio_img'] ?>" class="figure-img img-fluid rounded" alt="<?= $RAP['anuncio_url'] ?>"></a>
                        <?php
                    endforeach;
                else:
                    ?>
                    <a href="<?= HOME . '/contato' ?>"><img src="<?= INCLUDE_PATH; ?>/img/anuncios/anuncio-pequeno.jpg" class="figure-img img-fluid rounded" alt="Anuncie com <?= SITENAME; ?>"></a>
                <?php
                endif;
                ?>
                <figcaption class="figure-caption text-right">A caption for the above image.</figcaption>
            </figure>



            <br/> 

            <div class="card-deck">
                <?php
                $ReadClassificado = new Read;
                $ReadClassificado->ExeRead('classificado', "WHERE classificado_status = 'on' ORDER BY rand() LIMIT 1");
                if ($ReadClassificado->getResult()):
                    foreach ($ReadClassificado->getResult() as $Cla):

                        $ReadCat = new Read;
                        $ReadCat->ExeRead('categoria', "WHERE categoria_id =:id", "id={$Cla['classificado_categoria_pai']}");
                        foreach ($ReadCat->getResult() as $Cat):

                            $Cla['classificado_titulo'];
                            $Cla['classificado_valor'];
                            $Cla['classificado_categoria'] = $Cat['categoria_nome'];
                            $Cla['classificado_descricao'] = Check::Words($Cla['classificado_descricao'], 12);
                            $Cla['classificado_data'] = date('d/m/Y H:i:s', strtotime($Cla['classificado_data']));

                            $View->Show($Cla, $Classificado);

                        endforeach;

                    endforeach;
                endif;
                ?>
            </div>



        </div>




    </div>

    <br>
    <div class="col-4 mt-5">
        <h3 style="box-shadow: 0px 0px 0px #eb750d; color: #eb750d;"><i class="ion-plus-circled"></i> Veja Também</h3>
    </div>
    <div class="relacionadas">

        <div class="row">

            <?php
            $ReadVejaMais = new Read;
            $ReadVejaMais->ExeRead("post", "WHERE post_status = 'on' AND post_id != :id AND post_categoria = :cat ORDER BY rand() LIMIT 4", "id={$post_id}&cat={$post_categoria}");
            if ($ReadVejaMais->getResult()):

                foreach ($ReadVejaMais->getResult() AS $Mais):

                    $ReadCat = new Read;
                    $ReadCat->ExeRead("categoria", "WHERE categoria_pai IS NULL AND categoria_id =:id", "id={$Mais['post_categoria_pai']}");
                    foreach ($ReadCat->getResult() as $Cat):
                        $Mais['post_titulo'] = Check::Words($Mais['post_titulo'], 10);
                        $Mais['post_categoria'] = $Cat['categoria_nome'];

                        $View->Show($Mais, $VejaMais);
                    endforeach;



                endforeach;
            else:
                ZTErro("Ainda não existem Conteúdos relacionados a Esta categoria, favor, volte mais tarde!", ZT_INFOR);
            endif;
            ?>

        </div>
    </div>
    <br/>

    <div class="fb-comments" data-width="100%"></div>
</article>


<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.11';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    (function () {

        var shareButtons = document.querySelectorAll(".redes-link");

        if (shareButtons) {
            [].forEach.call(shareButtons, function (button) {
                button.addEventListener("click", function (event) {
                    var width = 650,
                            height = 450;

                    event.preventDefault();

                    window.open(this.href, 'Share Dialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=' + width + ',height=' + height + ',top=' + (screen.height / 2 - height / 2) + ',left=' + (screen.width / 2 - width / 2));
                });
            });
        }

    })();

</script>



<script>

    $redes = jQuery.noConflict();
    ;
    (function ($redes) {

        /**
         * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
         *
         * @param  {[object]} e           [Mouse event]
         * @param  {[integer]} intWidth   [Popup width defalut 500]
         * @param  {[integer]} intHeight  [Popup height defalut 400]
         * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
         */
        $redes.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {

            // Prevent default anchor event
            e.preventDefault();

            // Set values for window
            intWidth = intWidth || '500';
            intHeight = intHeight || '400';
            strResize = (blnResize ? 'yes' : 'no');

            // Set title and open popup with focus on it
            var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
                    strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,
                    objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
        }

        /* ================================================== */

        $redes(document).ready(function ($redes) {
            $redes('.customer.share').on("click", function (e) {
                $redes(this).customerPopup(e);
            });
        });

    }(jQuery));
</script>