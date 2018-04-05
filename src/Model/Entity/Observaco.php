<?php
namespace Agenda\Model\Entity;

use Cake\ORM\Entity;

/**
 * Observaco Entity
 *
 * @property int $id
 * @property int $venda_id
 * @property int $visita_id
 * @property int $usuario_id
 * @property string $observacao
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Agenda\Model\Entity\Venda $venda
 * @property \Agenda\Model\Entity\Visita[] $visita
 * @property \Agenda\Model\Entity\Usuario $usuario
 */
class Observaco extends Entity
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
