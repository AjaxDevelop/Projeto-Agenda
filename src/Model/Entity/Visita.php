<?php
namespace Agenda\Model\Entity;

use Cake\ORM\Entity;

/**
 * Visita Entity
 *
 * @property int $id
 * @property int $pessoa_id
 * @property \Cake\I18n\Time $data
 * @property string $hora_inicial
 * @property string $hora_final
 * @property string $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Agenda\Model\Entity\Observaco[] $observacoes
 */
class Visita extends Entity
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
