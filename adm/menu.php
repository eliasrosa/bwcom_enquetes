<?
defined('BW') or die("Acesso negado!");

$tituloPage = "Administração de Enquetes";

$menu = array(
    '0' => array(
        'url' => '/enquetes/lista',
        'tit' => 'Enquetes'
    ),
    '1' => array(
        'url' => '/enquetes/cadastro/0',
        'tit' => 'Criar nova enquete'
    ),
    '2' => array(
        'url' => '/enquetes/opcao/cadastro/0',
        'tit' => 'Criar nova opção'
    ),
);

?>
