<?

defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(1);

$id = bwRequest::getInt('id');
$i = bwComponent::openById('Enquete', $id);

$form = new bwForm($i, '/enquetes/task');
$form->addH2('Dados da enquete');
$form->addInputID();
$form->addInput('pergunta');
$form->addStatus();

$form->addBottonSalvar('salvarEnquete');
$form->addBottonRemover('removerEnquete');
$form->show();
?>
