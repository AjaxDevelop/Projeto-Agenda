<?php
namespace Agenda\Test\TestCase\Model\Table;

use Agenda\Model\Table\PessoasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Agenda\Model\Table\PessoasTable Test Case
 */
class PessoasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Agenda\Model\Table\PessoasTable
     */
    public $Pessoas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Pessoas') ? [] : ['className' => 'Agenda\Model\Table\PessoasTable'];
        $this->Pessoas = TableRegistry::get('Pessoas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pessoas);

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
     * Test gerarEntidades method
     *
     * @return void
     */
    public function testGerarEntidades()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test removerCaracteres method
     *
     * @return void
     */
    public function testRemoverCaracteres()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test padronizarCpfCnpf method
     *
     * @return void
     */
    public function testPadronizarCpfCnpf()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getPessoa method
     *
     * @return void
     */
    public function testGetPessoa()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
