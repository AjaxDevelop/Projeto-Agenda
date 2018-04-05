<?php
namespace Agenda\Test\TestCase\Model\Table;

use Agenda\Model\Table\VisitasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Agenda\Model\Table\VisitasTable Test Case
 */
class VisitasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Agenda\Model\Table\VisitasTable
     */
    public $Visitas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agenda.visitas',
        'plugin.agenda.observacoes',
        'plugin.agenda.vendas',
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
        $config = TableRegistry::exists('Visitas') ? [] : ['className' => 'Agenda\Model\Table\VisitasTable'];
        $this->Visitas = TableRegistry::get('Visitas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Visitas);

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
}
