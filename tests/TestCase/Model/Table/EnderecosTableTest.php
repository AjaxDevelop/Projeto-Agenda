<?php
namespace Agenda\Test\TestCase\Model\Table;

use Agenda\Model\Table\EnderecosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Agenda\Model\Table\EnderecosTable Test Case
 */
class EnderecosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Agenda\Model\Table\EnderecosTable
     */
    public $Enderecos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agenda.enderecos',
        'plugin.agenda.vendas',
        'plugin.agenda.pessoas',
        'plugin.agenda.clientes',
        'plugin.agenda.contatos',
        'plugin.agenda.enderecos_pessoas',
        'plugin.agenda.usuarios',
        'plugin.agenda.listas',
        'plugin.agenda.observacoes',
        'plugin.agenda.visitas',
        'plugin.agenda.reagendamentos',
        'plugin.agenda.userconfs',
        'plugin.agenda.pdvs',
        'plugin.agenda.pdvs_usuarios',
        'plugin.agenda.clientes_enderecos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Enderecos') ? [] : ['className' => 'Agenda\Model\Table\EnderecosTable'];
        $this->Enderecos = TableRegistry::get('Enderecos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Enderecos);

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
