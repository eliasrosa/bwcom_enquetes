<?
defined('BW') or die("Acesso negado!");

// SITE
bwRouter::addUrl('/enquetes');
bwRouter::addUrl('/enquetes/votar');

// ADM
bwRouter::addUrl('/enquetes/task', array('type' => 'task'));
bwRouter::addUrl('/enquetes/lista');
bwRouter::addUrl('/enquetes/cadastro/:id', array('fields' => array('id')));
bwRouter::addUrl('/enquetes/opcao/cadastro/:id', array('fields' => array('id')));
