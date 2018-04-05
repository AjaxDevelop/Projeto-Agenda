<?php
namespace Agenda\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\MaskTrait;

/**
 * Pessoa Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $representante
 * @property string $funcao
 * @property string $apelido
 * @property \Cake\I18n\Time $nascimento
 * @property string $cpf_cnpj
 * @property string $insc_estadual
 * @property string $insc_municipal
 * @property string $rg
 * @property string $tipo
 * @property string $observacao
 * @property string $plugin
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Agenda\Model\Entity\Cliente[] $clientes
 * @property \Agenda\Model\Entity\Contato[] $contatos
 * @property \Agenda\Model\Entity\Endereco $endereco
 * @property \Agenda\Model\Entity\Usuario[] $usuarios
 * @property \Agenda\Model\Entity\Observaco $observacoe
 * @property \App\Model\Entity\Socio[] $socios
 */
class Pessoa extends Entity
{

    use MaskTrait;

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

    protected function _getMaskedCpfCnpj()
    {

        $cpf_cnpj = $this->_properties['cpf_cnpj'];
        $tipo = $this->_properties['tipo'];

        if(strtoupper($tipo) == 'PF') {

            $cpf_cnpj = substr($cpf_cnpj, 3);

            $cpf_cnpj_masked = $this->mask($cpf_cnpj, "###.###.###-##");

        } else if(strtoupper($tipo) == 'PJ') {

            $cpf_cnpj_masked = $this->mask($cpf_cnpj, "##.###.###/####-##");

        } else {

            $cpf_cnpj_masked = 'Cpf/Cnpj inválido.';

        }

        return $cpf_cnpj_masked;
    }
}
