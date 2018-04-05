<?php
namespace Agenda\Model\Entity;

use Cake\ORM\Entity;

/**
 * Endereco Entity
 *
 * @property int $id
 * @property int $venda_id
 * @property int $pessoa_id
 * @property string $cep
 * @property string $endereco
 * @property string $numero
 * @property string $complemento
 * @property string $referencia
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property string $cep_instalacao
 * @property string $endereco_instalacao
 * @property string $numero_instalacao
 * @property string $complemento_instalacao
 * @property string $referencia_instalacao
 * @property string $bairro_instalacao
 * @property string $cidade_instalacao
 * @property string $estado_instalacao
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $updated
 *
 * @property \Agenda\Model\Entity\Venda $venda
 * @property \Agenda\Model\Entity\Pessoa[] $pessoas
 * @property \Agenda\Model\Entity\Cliente[] $clientes
 */
class Endereco extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
