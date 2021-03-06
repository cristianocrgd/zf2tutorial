<?php
/**
 * Created by PhpStorm.
 * User: Univicosa
 * Date: 23/09/2015
 * Time: 08:19
 */

/**
 * namespace de localizacao do nosso controller
 */
namespace Contato\Controller;

// import Zend\Mvc
use Zend\Mvc\Controller\AbstractActionController;

// import ViewModel
use Zend\View\Model\ViewModel;

// import Zend\Db
use Zend\Db\Adapter\Adapter as Adaptador,
    Zend\Db\Sql\Sql;

class HomeController extends AbstractActionController
{
    /**
     * action index
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        /**
         * função anônima para var_dump estilizado
         */
        $myVarDump = function($nome_linha = "Nome da Linha", $data = null, $caracter = ' - ') {
            echo str_repeat($caracter, 100) . '<br/>' . ucwords($nome_linha) . '<pre><br/>';
            var_dump($data);
            echo '</pre>' . str_repeat($caracter, 100) . '<br/><br/>';
        };

        /**
         * conexão com banco
         */
        /*$adapter = new Adaptador(array( // alias use Zend\Db\Adapter\Adapter as Adaptador
            'driver'    => 'Pdo_Mysql',
            'database'  => 'agenda_contatos',
            'username'  => 'root',
            'password'  => ''
        ));*/
        $adapter = $this->getServiceLocator()->get('AdapterDb');

        /**
         * obter nome do sehema do nosso banco
         */
        $myVarDump(
            "Nome Schema",
            $adapter->getCurrentSchema()
        );

        /**
         * contar quantidade de elementos da nossa tabela
         */
        $myVarDump(
            "Quantidade elementos tabela contatos",
            $adapter->query("SELECT * FROM `contatos`")->execute()->count()
        );

        /**
         * montar objeto sql e executar
         */
        $sql        = new Sql($adapter); // use Zend\Db\Sql\Sql
        $select     = $sql->select()->from('contatos');
        $statement  = $sql->prepareStatementForSqlObject($select);
        $resultsSql = $statement->execute();
        $myVarDump(
            "Objet Sql com Select executado",
            $resultsSql
        );

        /**
         * motar objeto resultset com objeto sql e mostrar resultado em array
         */
        $resultSet = new \Zend\Db\ResultSet\ResultSet; // nao necessita do use devido a sintaxe iniciando em \
        $resultSet->initialize($resultsSql);
        $myVarDump(
            "Resultado do Objeto Sql para Array ",
            $resultSet->toArray()
        );
        die();
    }

    /**
     * action sobre
     * @return \Zend\View\Model\ViewModel
     */
    public function sobreAction()
    {
        return new ViewModel();
    }
}