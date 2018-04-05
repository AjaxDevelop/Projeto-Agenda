<?php
namespace Agenda\Test\TestCase\Model\Table;

use Agenda\Model\Table\HistoricosVisitasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Agenda\Model\Table\HistoricosVisitasTable Test Case
 */
class HistoricosVisitasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Agenda\Model\Table\HistoricosVisitasTable
     */
    public $HistoricosVisitas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agenda.historicos_visitas',
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
        'plugin.agenda.pdvs_usuarios',
        'plugin.agenda.socios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HistoricosVisitas') ? [] : ['className' => 'Agenda\Model\Table\HistoricosVisitasTable'];
        $this->HistoricosVisitas = TableRegistry::get('HistoricosVisitas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HistoricosVisitas);

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
