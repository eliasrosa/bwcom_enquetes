<?php

class EnqueteVoto extends bwRecord
{

    var $labels = array(
        'id_opcao' => 'Opção',
        'token' => 'TOKEN',
        'datahora' => 'data/Hora',
    );

    public function setTableDefinition()
    {
        $this->setTableName('bw_enquetes_votos');
        $this->hasColumn('id', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => true,
            'autoincrement' => true,
        ));
        $this->hasColumn('id_opcao', 'integer', 4, array(
            'type' => 'integer',
            'length' => 4,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'autoincrement' => false,
        ));
        $this->hasColumn('token', 'string', 40, array(
            'type' => 'string',
            'length' => 40,
            'fixed' => false,
            'unsigned' => false,
            'primary' => false,
            'notnull' => true,
            'autoincrement' => false,
        ));
        $this->hasColumn('datahora', 'timestamp', null, array(
            'type' => 'timestamp',
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

        $this->hasOne('EnqueteOpcao', array(
            'local' => 'id_opcao',
            'foreign' => 'id'
        ));
    }

    public function salvar($id_opcao)
    {
        $dados = array(
            'id' => '',
            'id_opcao' => $id_opcao,
            'token' => bwSession::getToken(),
            'datahora' => bwUtil::dataNow(),
        );
        
        $db = bwComponent::save(__CLASS__, $dados);
        $r = bwComponent::retorno($db);
        
        return $r;
    }

    public function remover($dados)
    {
        $db = bwComponent::remover(__CLASS__, $dados);
        $r = bwComponent::retorno($db);

        return $r;
    }

}
