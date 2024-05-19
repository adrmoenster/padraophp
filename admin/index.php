<?php
ob_start();
session_start();
require ('../_app/Config.inc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        
        <link rel="icon" type="image/png" sizes="16x16" href="img/br.jpg"><link rel="icon" type="image/png" sizes="32x32" href="img/br.jpg"><link rel="icon" sizes="192x192" href="img/br.jpg">
       
        <!-- Bootstrap -->
        <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="font/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom Theme Style - parte de tela de login é atingida por essa opção-->
        <link href="css/custom.min.css" rel="stylesheet">
        <!-- Animate.css - este faz animação entre login e redefinir senha -->
        <link href="css/animate.css/animate.min.css" rel="stylesheet">
        
        
        
       
        
    </head>
    <body class="login">



        <?php
        $login = new Login(2); //Aqui instancia metodo que irá validar login, verificando nível, não deixa logar se nível do usuário for menor que definido

        if ($login->CheckLogin())://Verificando Login através do metodo CheckLogin, se passar nas validações do metodo então direciona para o painel.
            header('Location: painel.php');
        endif;


        $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT); //Pegando os dados array do formulario
        if (!empty($dataLogin['AdminLogin']))://Verificando negação de não existe e não é nulo
            $login->ExeLogin($dataLogin); //Executando o metodo ExeLogin da Classe Login
            if (!$login->getResult())://Verificando a negação de retorno no metodo ExeLogin executado anteriormente, ou seja, não deu certo o login
                ZTErro($login->getError()[0], $login->getError()[1]); //Este é retorno da mensagem informando de não ser possível fazer login
            else://Depois de todas as negações então a seguir autentica na página painel.php
                header('Location: painel.php?exe=home'); //Direcionando para página painel.php
            endif;
        endif;

        $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT); //Buscando com segurança uma string de nome 'exe' na url
        if (!empty($get))://Se não ocorreu retorno na busca anterior realizada entra nesse if
            if ($get == 'restrito')://verificando se na url ocorreu retorno da palavra 'restrito' na exe, assim: exe=restrito
                ZTErro('<b>Oppsss:</b> Acesso negado. Favor efetue login para acessar o painel!', ZT_ALERT); //Se verificação anterior retornar positivo apresenta então essa mensagem
            elseif ($get == 'logoff')://verificando se na url ocorreu retorno da palavra 'logoff' na exe, assim: exe=logoff
                ZTErro('<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada. Volte sempre!', ZT_ACCEPT); //Se retornou positvo para verificação anterior então apresenta essa mensagem
            endif;
        endif;
        ?>

        <div>
            <a class="hiddenanchor" id="signup"></a><!-- Ancora para tela de Recuperar senha -->
            <a class="hiddenanchor" id="signin"></a><!-- Ancora para tela de fazer login -->

            <div class="login_wrapper">
                 <!-- INICIO Opção fazer login -->
                <div class="animate form login_form">
                    <section class="login_content">
                        <form class="form-signin" name="AdminLoginForm" action="" method="post">
                            <h1>Acessar Sistema</h1>
                            <div>
                                <input type="email" name="user" class="form-control" placeholder="Informe seu E-mail" required="" id="inputEmail">

                            </div>
                            <div>
                                <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Senha" required="" >

                            </div>
                            <div>

                                <button class="btn btn-sm btn-success" name="AdminLogin" value="Logar" type="submit"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Entrar</button>
                                <a class="reset_pass" href="#signup">Esqueceu a Senha?</a>
                            </div>

                            <div class="clearfix"></div>

                            
                                <br />

                                
                            </div>
                        </form>

                    </section>
                </div>
                <!-- FIM Opção fazer login -->
                
                <!-- INICIO Opção Recuperar Senha -->
                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <form>
                            <h1>Recuperar Senha</h1>

                            <div>
                                <p> Para recuperar sua senha, entre em contato com o Administrador!</p>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Entrar no Sistema ?
                                    <a href="#signin" class="to_register"> Entrar </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-deviantart"></i> Zater Sistemas</h1>
                                    <p>©<?= date('Y'); ?> Todos os direitos reservados. Termos e contrato Registrados!</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <!-- FIM Opção Recuperar Senha -->
            </div>
        </div>
       
    </body>
</html>