<?

defined('BW') or die("Acesso negado!");

bwHtml::css(BW_URL_COMPONENTS . '/enquetes/adm/css/style.css');

echo bwAdm::createHtmlSubMenu(0);

echo bwButton::redirect('Criar nova enquete', '/enquetes/cadastro/0');
echo ' ';
echo bwButton::redirect('Criar nova opção', '/enquetes/opcao/cadastro/0');



class bwGridLista extends bwGrid
{

    function __construct()
    {
        parent::__construct(
            Doctrine_Query::create()
                ->from('Enquete e')
                ->leftJoin('e.Opcoes o')
        );

        $this->addCol('ID', 'e.id', 'tac', 50);
        $this->addCol('Enquete', 'e.pergunta');
        $this->addCol('Status', 'e.status', 'tac', 25);
    }

    function col0($i)
    {
        return '<a href="' . $i->getUrl('/enquetes/cadastro') . '">' . $i->id . '</a>';
    }

    function col1($i)
    {
        $html = sprintf('%s', $i->pergunta);

        if (count($i->Opcoes)) {

            $html .= '<br/><ul class="enquetes">';

            $dql_opcoes = Doctrine_Query::create()
                ->from('EnqueteOpcao o')
                ->leftJoin('o.Votos v')
                ->where('o.id_enquete = ?', $i->id)
                ->orderBy('o.ordem ASC')
                ->execute();

            $total_votos = 0;
            foreach ($dql_opcoes as $o) {
                $total_votos += $o->Votos->count();
            }

            //
            foreach ($dql_opcoes as $o) {

                $votos = $o->Votos->count();

                if ($total_votos) {
                    $porcentagem = round(($votos / $total_votos) * 100);
                } else {
                    $porcentagem = 0;
                }

                $html .= sprintf('<li><a href="%s">%s</a> <span>%s%% (%s votos)</span></li>'
                    , $o->getUrl('/enquetes/opcao/cadastro')
                    , $o->opcao
                    , $porcentagem
                    , $votos
                );
            }
            $html .= sprintf('</ul>');
        }
        return $html;
    }

    function col2($i)
    {
        return bwAdm::getImgStatus($i->status);
    }

}

$a = new bwGridLista();
$a->show();
?>
