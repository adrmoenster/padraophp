<div class="sub-rodape">
    <div class="container mt-2">
        <div class="row">
            <div class="col col-12 col-lg-6">
                <img src="<?= INCLUDE_PATH . '/img/logo.png' ?>" class="p-0">
                <!-- <div class="titulo">DIARIO ESPERANÇA</div>
                 <p class="subtitulo">O melhor conteúdo para você</p>-->
            </div>

            <div class="col col-12 col-lg-6">


                <div class="media">
                    <i class="material-icons md-65">smartphone</i>
                    <div class="media-body mt-2">
                        <p><em>
                                Acesse o melhor conteúdo jornalístico da região através do seu dispositivos, tablets, celulares e televisores.
                            </em></p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="fita-rodape"></div>
<footer class="rodape">

    <div class="container">
        <div class="col">
            <div class="row">

               <!-- <div class="col col-xs-12 col-lg-3">

                    <ul>
                        <label class="rodape-titulo">Estados</label>
                        <?php
                        $ReadEstado = new Read;
                        $ReadCidade = new Read;
                        $ReadEstado->ExeRead('estado', "WHERE estado_id != 'null' ORDER BY estado_id ASC LIMIT 10");
                        $ReadCidade->ExeRead('cidade', "WHERE cidade_id != 'null' AND cidade_nome != 'null' LIMIT 10");
                        if ($ReadEstado->getResult() && $ReadCidade->getResult()) :
                            foreach ($ReadEstado->getResult() as $Estado) :
                                foreach ($ReadCidade->getResult() as $Cidade) :
                                    if ($Estado['estado_id'] != null && $Estado['estado_codigouf'] == $Cidade['cidade_codigouf']) :
                        ?>
                                        <li class="text-uppercase"><a href="<?= HOME; ?>/estado/<?= $Estado['estado_nome']; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?= $Estado['estado_nome'] . ' ' . $Estado['estado_uf']; ?></a></li>
                                        <li class="text-uppercase"><a href="<?= HOME; ?>/estado/<?= $Cidade['cidade_nome']; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?= $Estado['estado_nome'] . ' ' . $Cidade['cidade_codigouf']; ?></a></li>

                                    <?php else :
                                    ?>
                                        <li class="text-uppercase"><a href="<?= HOME; ?>/estado/<?= $Estado['estado_nome']; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i> <?= $Estado['estado_uf'] . ' ' . $Estado['estado_uf']; ?></a></li>


                        <?php
                                    endif;
                                endforeach;
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>-->



                <div class="col col-12 col-lg-3">

                    <ul>
                        <label class="rodape-titulo">Estado e Cidade</label>
                        <?php
                        $ReadEst = new Read;
                        $ReadEst->ExeRead('estado', "WHERE estado_id != 'null' LIMIT 10");
                        
                        ?>
                        <select id="estado" onchange ="ListaEst">?>
                            <?php    
                                foreach ($ReadEst->getResult() as $Est) :
                            ?>                                
                            <option value="<?= $Est['estado_codigouf'];?>" selected><?= $Est['estado_nome'];?></option>
                            <?php endforeach;?>
                        </select>
                                   <?php
                                    $ReadCid = new Read;
                                    $ReadCid->ExeRead('cidade', "WHERE cidade_id != 'null' LIMIT 10");
                                   ?>
                                           <select id="estado" onchange="buscaCidades(this.value)">
                                                <option value="">Selecione o Estado</option>
                                                <option value="AC">Acre</option>
                                                <option value="AL">Alagoas</option>
                                            </select>
                                            <br />
                                            <select id="cidade">
                                            </select>
                                
                                
                                            <?php
                                            
                                           
                                            ?>
                                
                                </ul>
                                <ul>
                                    <li>
                                        
                                    </li>
                                </ul>
                                
                                <?php
                            
                            

                        
                        ?>
                                

                            
                            
                               
                               
                    </ul>
                </div>


                <div class="col col-12 col-lg-3">
                    <ul>
                        <label class="rodape-titulo">Anuncie</label>
                        <li><a href="<?= HOME; ?>/contato">Anuncie com a gente</a></li>


                    </ul>

                    <ul>
                        <label class="rodape-titulo">Contato</label>
                        <li><a href="<?= HOME; ?>/contato">Envie uma mensagem</a></li>
                    </ul>


                </div>

                <div class="col col-12 col-lg-3">
                    <label class="rodape-titulo">MÍDIAS SOCIAIS</label><br />
                    <ul class="redes">
                        <li><a href="<?= TWITTER ?>" target="_blank"><i style="font-size: 22px; margin-right: 10px;" class="ion-social-twitter"></i></a></li>
                        <li><a href="<?= INSTAGRAM ?>" target="_blank"><i style="font-size: 22px; margin-right: 10px;" class="ion-social-instagram"></i></a></li>
                        <li><a href="<?= FACEBOOK ?>" target="_blank"><i style="font-size: 22px;  margin-right: 10px;" class="ion-social-facebook"></i></a></li>
                        <li><a href="<?= LINKEDIN ?>" target="_blank"><i style="font-size: 22px;  margin-right: 10px;" class="ion-social-linkedin"></i></a></li>
                    </ul>

                    <br><br><br>
                    <ul>
                        <li><a href="<?= HOME; ?>/contato" style="font-size: 20px; font-weight: bold;"><i class="material-icons">phone</i> <?= SITEFONE ?></a></li>
                        <li><i class="material-icons">location_on</i><?= ADDRESSCIDADE . ' ' . ADDRESSESTADO . ', ' . ADDRESSRUA ?></li>
                    </ul>
                </div>

            </div>
        </div>

</footer>
<div class="direito">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <p><em><a href="http://www.zater.com.br" target="_blank">Theme desenvolvido por ZT soluções</a></em></p>
            </div>
            <div class="col-12 col-lg-6 ">
                <div class="row text-right">
                    <div class="col-12">
                        <span class="badge badge-secondary">Mantido por</span>
                    </div>
                    <div class="col-12">
                        <a href="http://epconnect.com.br/" target="_blank"><img src="<?= INCLUDE_PATH; ?>/img/epconnect-rodape.png"></a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>