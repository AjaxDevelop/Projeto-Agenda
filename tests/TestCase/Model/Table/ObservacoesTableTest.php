<?php
namespace Agenda\Test\TestCase\Model\Table;

use Agenda\Model\Table\ObservacoesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Agenda\Model\Table\ObservacoesTable Test Case
 */
class ObservacoesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Agenda\Model\Table\ObservacoesTable
     */
    public $Observacoes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agenda.observacoes',
        'plugin.agenda.vendas',
        'plugin.agenda.visitas',
        'plugin.agenda.usuarios',
        'plugin.agenda.pessoas',
        'plugin.agenda.clientes',
        'plugin.agenda.contatos',
        'plugin.agenda.enderecos',
        'plugin.agenda.enderecos_pessoas',
        'plugin.agenda.clientes_enderecos',
        'plugin.agenda.listas',
        'plugin.agenda.reagendamentos',
        'plugin.agenda.userconfs',
        'plugin.agenda.pdvs',
        'plugin.agenda.pdvs_usuarios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Observacoes') ? [] : ['className' => 'Agenda\Model\Table\ObservacoesTable'];
        $this->Observacoes = TableRegistry::get('Observacoes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Observacoes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
