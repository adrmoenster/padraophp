<?php

//CONFIGURAÇÂO DO SITE ####################
define('HOST', 'localhost');//Endereço do site
define('USER', 'root');//Usuário do banco de dados
define('PASS', '');//Senha do banco de dados
define('DBSA', 'sistema');//Nome do Banco de Dados

//DEFINE IDENTIDADE DO SITE ###############
define('SITENAME', 'sistema');//Nome do Site
define('SITEDESC', 'Colocar aqui a descrição sobre o site');//Breve descrição do site
define('SITEFONE', '(00) 0000-0000');//Telefone informado no site
define('SITESKYPE', 'sistemaonline');//Skype informado no site
define('SITESLOGAN', 'Desenvolvendo!!!!');//SLOGAN do site

//DEFINE A BASE DO SITE ####################
define('HOME', 'localhost/padraophp');//Endereço base do site, colocar (Https://www.etc...)para evitar erros nas postagens
define('TEMA', 'sistema');//Serve para especificar tema(pasta) pasta do index(2) do site
define('INCLUDE_PATH', HOME . DIRECTORY_SEPARATOR . 'site' . DIRECTORY_SEPARATOR . TEMA);
define('REQUIRE_PATH', 'site' . DIRECTORY_SEPARATOR . TEMA);





//AUTO LOAD DE CLASSES ####################
//Esta função recebe automáticamente o nome da classe e busca classe ao instanciar
spl_autoload_register( function ($Class) {
    $cDir = ['Conn', 'Helpers', 'Models'];//Configuração de diretório, indica pastas a serem carregadas no autoload
    $iDir = null;//Serve para verificar se a inclusão de diretório ocorreu, se ocorreu seta true, caso não então retorna erro
    
    foreach ($cDir as $dirName)://Percorrendo o array do cDir
        $path = __DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class .'.class.php';
        

        if (!$iDir && file_exists($path) && !is_dir($path))://Verifica se arquivo existe e se não é um diretório
            include_once ($path);
            $iDir = true;        
        endif;
    endforeach;
    if (!$iDir)://Se não conseguiu incluir ai sim retorna o erro de inclusão
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
    endif;
    
});



// TRATAMENTO DE ERROS NO PAINEL#####################
//CSS Constantes :: Mensagem de Erro
define('ZT_ACCEPT', 'alert-success');
define('ZT_INFOR', 'alert-info');
define('ZT_ALERT', 'alert-warning');
define('ZT_ERROR', 'alert-danger');




//PRECISA CORRIGIR ESTA PARTE DOS ERROS ESTÂO CONSIDERANDO TER BOOTSTRAP

//ZTErro :: Exibe erros lançados :: Front do painel
function ZTErro($ErrMsg, $ErrNo, $ErrDie = null){
    $CssClass = ($ErrNo == E_USER_NOTICE ? ZT_INFOR : ($ErrNo == E_USER_WARNING ? ZT_ALERT : ($ErrNo == E_USER_ERROR ? ZT_ERROR : $ErrNo)));
    echo "<div><p class=\"alert  {$CssClass} alert-dismissible fade in\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span>
                    </button>{$ErrMsg}</p></div>";
    
    if ($ErrDie):
        die;
    endif;
}


//ZTErro :: Exibe erros lançados :: Front do Site
function ZTErro2($ErrMsg, $ErrNo, $ErrDie = null){
    $CssClass = ($ErrNo == E_USER_NOTICE ? ZT_INFOR : ($ErrNo == E_USER_WARNING ? ZT_ALERT : ($ErrNo == E_USER_ERROR ? ZT_ERROR : $ErrNo)));
    echo "<div class=\"m-0 alert  {$CssClass}\" role=\"alert\">{$ErrMsg}</div>";
    
    if ($ErrDie):
        die;
    endif;
}




//PHPErro :: personaliza o gatilho de erro PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine){
    $CssClass = ($ErrNo == E_USER_NOTICE ? ZT_INFOR : ($ErrNo == E_USER_WARNING ? ZT_ALERT : ($ErrNo == E_USER_ERROR ? ZT_ERROR : $ErrNo)));
    echo "<div><p class=\"alert {$CssClass} alert-dismissible fade in\">";
    echo "<strong>Erro na Linha: {$ErrLine} ::</strong> {$ErrMsg} <br>";
    echo "<small>{$ErrFile}</small>";
    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button></p></div>";
    
    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}
set_error_handler('PHPErro');
?>