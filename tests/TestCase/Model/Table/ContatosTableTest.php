<?php
namespace Agenda\Test\TestCase\Model\Table;

use Agenda\Model\Table\ContatosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Agenda\Model\Table\ContatosTable Test Case
 */
class ContatosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Agenda\Model\Table\ContatosTable
     */
    public $Contatos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agenda.contatos',
        'plugin.agenda.vendas',
        'plugin.agenda.pessoas',
        'plugin.agenda.clientes',
        'plugin.agenda.enderecos',
        'plugin.agenda.enderecos_pessoas',
        'plugin.agenda.clientes_enderecos',
        'plugin.agenda.usuarios',
        'plugin.agenda.listas',
        'plugin.agenda.observacoes',
        'plugin.agenda.visitas',
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
        $config = TableRegistry::exists('Contatos') ? [] : ['className' => 'Agenda\Model\Table\ContatosTable'];
        $this->Contatos = TableRegistry::get('Contatos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contatos);

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
