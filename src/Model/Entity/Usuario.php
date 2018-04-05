<?php
namespace Agenda\Model\Entity;

use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property int $pessoa_id
 * @property string $display
 * @property string $email
 * @property string $senha
 * @property string $role
 * @property string $ativo
 * @property string $interno
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Agenda\Model\Entity\Pessoa $pessoa
 * @property \Agenda\Model\Entity\Lista[] $listas
 * @property \Agenda\Model\Entity\Observaco[] $observacoes
 * @property \Agenda\Model\Entity\Reagendamento[] $reagendamentos
 * @property \Agenda\Model\Entity\Userconf[] $userconfs
 * @property \Agenda\Model\Entity\Pdv[] $pdvs
 */
class Usuario extends Entity
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

    //Verifica se o perfil do usuário que esta logado pertence a um 'Vendedor Externo'.//
    public function isVendedor(){

        if(strtoupper($this->role) == 'VENDEDOR_EXTERNO'){

            return true;

        }else{

            return false;

        }
    }
}
