<?php
namespace Agenda\Test\TestCase\Model\Table;

use Agenda\Model\Table\UsuariosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Agenda\Model\Table\UsuariosTable Test Case
 */
class UsuariosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Agenda\Model\Table\UsuariosTable
     */
    public $Usuarios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agenda.usuarios',
        'plugin.agenda.pessoas',
        'plugin.agenda.clientes',
        'plugin.agenda.enderecos',
        'plugin.agenda.enderecos_pessoas',
        'plugin.agenda.listas',
        'plugin.agenda.observacoes',
        'plugin.agenda.vendas',
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
        $config = TableRegistry::exists('Usuarios') ? [] : ['className' => 'Agenda\Model\Table\UsuariosTable'];
        $this->Usuarios = TableRegistry::get('Usuarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Usuarios);

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
