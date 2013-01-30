<?

defined('BW') or die("Acesso negado!");

echo bwAdm::createHtmlSubMenu(2);

$id = bwRequest::getInt('id');
$i = bwComponent::openById('EnqueteOpcao', $id);

$form = new bwForm($i, '/enquetes/task');
$form->addH2('Dados da opção');
$form->addInputID();
$form->addSelectDB('id_enquete', 'Enquete', array(
    'db.value' => 'pergunta',
    'edit' => false
));
$form->addInput('opcao');
$form->addInputInteger('ordem');

$form->addBottonSalvar('salvarOpcao');
$form->addBottonRemover('removerOpcao');
$form->show();
?>
