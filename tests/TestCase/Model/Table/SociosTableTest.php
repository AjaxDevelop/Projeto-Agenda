<?php
namespace Agenda\Test\TestCase\Model\Table;

use Agenda\Model\Table\SociosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Agenda\Model\Table\SociosTable Test Case
 */
class SociosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Agenda\Model\Table\SociosTable
     */
    public $Socios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agenda.socios',
        'plugin.agenda.pessoas',
        'plugin.agenda.clientes',
        'plugin.agenda.contatos',
        'plugin.agenda.enderecos',
        'plugin.agenda.vendas',
        'plugin.agenda.clientes_enderecos',
        'plugin.agenda.usuarios',
        'plugin.agenda.listas',
        'plugin.agenda.observacoes',
        'plugin.agenda.visitas',
        'plugin.agenda.observacoe',
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
        $config = TableRegistry::exists('Socios') ? [] : ['className' => 'Agenda\Model\Table\SociosTable'];
        $this->Socios = TableRegistry::get('Socios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Socios);

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
