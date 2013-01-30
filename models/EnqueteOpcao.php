<?php

class EnqueteOpcao extends bwRecord
{

    var $labels = array(
        'id_enquete' => 'Enquete',
        'opcao' => 'Opção',
        'ordem' => 'Ordem',
    );

    public function setTableDefinition()
    {
        $this->setTableName('bw_enquetes_opcoes');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => true,
            'autoincrement' => true,
        ));
        $this->hasColumn('id_enquete', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'autoincrement' => false,
        ));
        $this->hasColumn('opcao', 'string', 255, array(
            'type' => 'string',
            'length' => 255,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'notblank' => true,
            'autoincrement' => false,
        ));
        $this->hasColumn('ordem', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => false,
            'autoincrement' => false,
        ));
    }

    public function setUp()
    {
        parent::setUp();

        $this->hasOne('Enquete', array(
            'local' => 'id_enquete',
            'foreign' => 'id'
        ));

        $this->hasMany('EnqueteVoto as Votos', array(
            'local' => 'id',
            'foreign' => 'id_opcao'
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
            ->from('EnqueteVoto')
            ->where('id_opcao = ?', $dados['id'])
            ->execute() as $i) {

            EnqueteVoto::remover($i->toArray());
        }

        //
        $db = bwComponent::remover(__CLASS__, $dados);
        $r = bwComponent::retorno($db);

        return $r;
    }

}