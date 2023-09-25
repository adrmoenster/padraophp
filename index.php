<?php
ob_start();
require_once '_app/Config.inc.php';

$Sessao = new Session;
?>


<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <?php 
    
        $Link = new Link;
        $Link->getTags();
        var_dump($Link);
        
        ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site gerador de jogos</title>
    
</head>
<body>
<?php 
    
        require(REQUIRE_PATH . '/inc/header.inc.php');

        if (!require ($Link->getPatch())):
            ZTErro('Erro ao incluir arquivo de navegação!', ZT_ERROR, true);
        endif;

        require(REQUIRE_PATH . '/inc/footer.inc.php');

?>
</body>
</html>
<?php 
ob_end_flush();
?>