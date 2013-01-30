<?

defined('BW') or die("Acesso negado!");

class bwEnquetes extends bwComponent
{
    // variaveis obrigatórias
    var $id = 'enquetes';
    var $nome = 'Enquetes';
    var $adm_visivel = true;
    
    
    // getInstance
    function getInstance($class = false)
    {
        $class = $class ? $class : __CLASS__;
        return bwObject::getInstance($class);
    }
}
?>
