<?
defined('BW') or die("Acesso negado!");
$task = bwRequest::getVar('task');


// Enquete
/////////////////////////////////////////////////////////////

if ($task == 'salvarEnquete')
{
    $r = Enquete::salvar(bwRequest::getVar('dados', array()));
}

if ($task == 'removerEnquete')
{
    $r = Enquete::remover(bwRequest::getVar('dados', array()));
    $r['redirect'] = bwRouter::_("/enquetes/lista");
}




// Opções
/////////////////////////////////////////////////////////////

if ($task == 'salvarOpcao')
{
    $r = EnqueteOpcao::salvar(bwRequest::getVar('dados', array()));
}

if ($task == 'removerOpcao')
{
    $r = EnqueteOpcao::remover(bwRequest::getVar('dados', array()));
    $r['redirect'] = bwRouter::_("/enquetes/lista");
}

die(json_encode($r));
?>
