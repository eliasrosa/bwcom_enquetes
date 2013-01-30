<?php

class Enquete extends bwRecord
{

    var $labels = array(
        'pergunta' => 'Pergunta',
    );

    public function setTableDefinition()
    {
        $this->setTableName('bw_enquetes');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => true,
            'autoincrement' => true,
        ));
        $this->hasColumn('pergunta', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'notblank' => true,
            'autoincrement' => false,
        ));
        $this->hasColumn('status', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'autoincrement' => false,
        ));
    }

    public function setUp()
    {
        parent::setUp();

        $this->hasMany('EnqueteOpcao as Opcoes', array(
            'local' => 'id',
            'foreign' => 'id_enquete'
        ));
    }

    public function salvar($dados)
    {
        $db = bwComponent::save(__CLASS__, $dados);
        $r = bwComponent::retorno($db);

        return $r;
    }

    public function remover($dados)
    {
        //
        foreach (Doctrine_Query::create()
            ->from('EnqueteOpcao')
            ->where('id_enquete = ?', $dados['id'])
            ->execute() as $i) {

            EnqueteOpcao::remover($i->toArray());
        }


        $db = bwComponent::remover(__CLASS__, $dados);
        $r = bwComponent::retorno($db);

        return $r;
    }

    public function abrir($id_enquete)
    {
        $dql_enquete = Doctrine_Query::create()
            ->select('*')
            ->addSelect('COUNT(v.id) AS total_votos')
            ->from('Enquete e')
            ->innerJoin('e.Opcoes o')
            ->leftJoin('o.Votos v')
            ->where('e.status = 1 AND e.id = ?', $id_enquete)
            ->fetchOne();

        $enquete = array(
            'id' => $dql_enquete->id,
            'safevar' => bwUtil::createSafeValue($dql_enquete->id),
            'pergunta' => $dql_enquete->pergunta,
            'total_votos' => $dql_enquete->total_votos,
            'is_session' => false,
        );

        $dql_opcoes = Doctrine_Query::create()
            ->from('EnqueteOpcao o')
            ->leftJoin('o.Votos v')
            ->where('o.id_enquete = ?', $dql_enquete->id)
            ->orderBy('o.ordem ASC');

        foreach ($dql_opcoes->execute() as $o) {

            $safevar = bwUtil::createSafeValue($o->id);
            $votos = $o->Votos->count();
            $porcentagem = round(($votos / $dql_enquete->total_votos) * 100);

            $enquete['opcoes'][] = array(
                'opcao' => $o->opcao,
                'votos' => $votos,
                'porcentagem' => $porcentagem . '%',
                'safevar' => $safevar,
                'id' => $o->id,
            );

            foreach ($o->Votos as $v) {
                if ($v->token == bwSession::getToken()) {
                    $enquete['is_session'] = true;
                }
            }
        }

        return $enquete;
    }

}