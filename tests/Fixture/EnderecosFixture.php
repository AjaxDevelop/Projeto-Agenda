<?php
namespace Agenda\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EnderecosFixture
 *
 */
class EnderecosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'venda_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'pessoa_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cep' => ['type' => 'string', 'fixed' => true, 'length' => 9, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'endereco' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'numero' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'complemento' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'referencia' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'bairro' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cidade' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'estado' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cep_instalacao' => ['type' => 'string', 'fixed' => true, 'length' => 9, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'endereco_instalacao' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'numero_instalacao' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'complemento_instalacao' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'referencia_instalacao' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'bairro_instalacao' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cidade_instalacao' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'estado_instalacao' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'updated' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'cep' => ['type' => 'index', 'columns' => ['cep'], 'length' => []],
            'endereco' => ['type' => 'index', 'columns' => ['endereco'], 'length' => []],
            'numero' => ['type' => 'index', 'columns' => ['numero'], 'length' => []],
            'bairro' => ['type' => 'index', 'columns' => ['bairro'], 'length' => []],
            'cidade' => ['type' => 'index', 'columns' => ['cidade'], 'length' => []],
            'estado' => ['type' => 'index', 'columns' => ['estado'], 'length' => []],
            'venda_id' => ['type' => 'index', 'columns' => ['venda_id'], 'length' => []],
            'pessoa_id' => ['type' => 'index', 'columns' => ['pessoa_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'enderecos_ibfk_1' => ['type' => 'foreign', 'columns' => ['pessoa_id'], 'references' => ['pessoas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'venda_id' => 1,
            'pessoa_id' => 1,
            'cep' => 'Lorem i',
            'endereco' => 'Lorem ipsum dolor sit amet',
            'numero' => 'Lorem ip',
            'complemento' => 'Lorem ipsum dolor sit amet',
            'referencia' => 'Lorem ipsum dolor sit amet',
            'bairro' => 'Lorem ipsum dolor sit amet',
            'cidade' => 'Lorem ipsum dolor sit amet',
            'estado' => 'Lorem ipsum dolor sit amet',
            'cep_instalacao' => 'Lorem i',
            'endereco_instalacao' => 'Lorem ipsum dolor sit amet',
            'numero_instalacao' => 'Lorem ip',
            'complemento_instalacao' => 'Lorem ipsum dolor sit amet',
            'referencia_instalacao' => 'Lorem ipsum dolor sit amet',
            'bairro_instalacao' => 'Lorem ipsum dolor sit amet',
            'cidade_instalacao' => 'Lorem ipsum dolor sit amet',
            'estado_instalacao' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-03-31 16:05:23',
            'updated' => '2017-03-31 16:05:23'
        ],
    ];
}
