<?php
namespace Agenda\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Pessoas Model
 *
 * @property \Cake\ORM\Association\HasMany $Clientes
 * @property \Cake\ORM\Association\HasMany $Contatos
 * @property \Cake\ORM\Association\HasMany $Enderecos
 * @property \Cake\ORM\Association\HasMany $Observacoes
 * @property \Cake\ORM\Association\HasMany $Socios
 * @property \Cake\ORM\Association\HasMany $Usuarios
 * @property \Cake\ORM\Association\HasMany $Visitas
 *
 * @method \Agenda\Model\Entity\Pessoa get($primaryKey, $options = [])
 * @method \Agenda\Model\Entity\Pessoa newEntity($data = null, array $options = [])
 * @method \Agenda\Model\Entity\Pessoa[] newEntities(array $data, array $options = [])
 * @method \Agenda\Model\Entity\Pessoa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Agenda\Model\Entity\Pessoa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Pessoa[] patchEntities($entities, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Pessoa findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PessoasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('pessoas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Clientes', [
            'foreignKey' => 'pessoa_id',
            'className' => 'Agenda.Clientes'
        ]);

        $this->hasMany('Contatos', [
            'foreignKey' => 'pessoa_id',
            'className' => 'Agenda.Contatos'
        ]);

        $this->hasOne('Enderecos', [
            'foreignKey' => 'pessoa_id',
            'className' => 'Agenda.Enderecos'
        ]);

        $this->hasMany('Usuarios', [
            'foreignKey' => 'pessoa_id',
            'className' => 'Agenda.Usuarios'
        ]);

        $this->hasOne('Observacoe', [
            'targetForeignKey' => 'pessoa_id',
            'className' => 'Agenda.Observacoes'
        ]);

        $this->hasMany('Socios', [
            'foreignKey' => 'empresa_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        /*$validator
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

        $validator
            ->requirePresence('representante', 'create')
            ->notEmpty('representante');

        $validator
            ->requirePresence('funcao', 'create')
            ->notEmpty('funcao');

        $validator
            ->requirePresence('apelido', 'create')
            ->notEmpty('apelido');

        $validator
            ->date('nascimento')
            ->requirePresence('nascimento', 'create')
            ->notEmpty('nascimento');

        $validator
            ->requirePresence('cpf_cnpj', 'create')
            ->notEmpty('cpf_cnpj');

        $validator
            ->requirePresence('insc_estadual', 'create')
            ->notEmpty('insc_estadual');

        $validator
            ->requirePresence('insc_municipal', 'create')
            ->notEmpty('insc_municipal');

        $validator
            ->requirePresence('rg', 'create')
            ->notEmpty('rg');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->requirePresence('observacao', 'create')
            ->notEmpty('observacao');

        $validator
            ->requirePresence('plugin', 'create')
            ->notEmpty('plugin');*/

        return $validator;
    }

    /**
     * Gerar Entidades.
     *
     * OBJETIVO: Gera as entidades correspondentes a empresa a ser cadastrada.
     *
     * REQUEST: $data: Array com os dados da Empresa.
     *
     * RESPONSE: $pessoas: Array com os dados da empresa convertidos em entidades.
     *
     */

    public function gerarEntidades($entidades = null) {

        $pessoas_model = $this;
        $pessoas = [];

        if (!is_array($entidades)) {
            return [];
        }

        foreach ($entidades as $key => $entidade) {

            $check_pessoa = $pessoas_model->find('all', [
                'conditions' => ['cpf_cnpj' => $entidade['cpf_cnpj']]
            ])->first();

            if ($check_pessoa != null) {

                $pessoa_temp = $pessoas_model->get($check_pessoa->id);

                if ($pessoa_temp->cpf_cnpj != $entidade['cpf_cnpj']) {

                    $pessoa_temp = [];

                }

            } else {

                $pessoa_temp = $pessoas_model->newEntity();

                $pessoa_temp = $pessoas_model->patchEntity($pessoa_temp, $entidade);


            }

            $pessoa_temp = $pessoas_model->patchEntity($pessoa_temp, $entidade);

            array_push($pessoas, $pessoa_temp);

        }

        return $pessoas;

    }


    /**
     * Get Sócios.
     *
     * OBJETIVO: Resgatar os dados dos sócios relacionado a pessoa.
     *
     * REQUEST: $socios_list: Array com Id dos sócios.
     *
     * RESPONSE: $socios: Array com os dados dos sócios associados a pessoa.
     *
     */

    public function getSocios($socios_list = null)
    {

        $socios = [];
        $ids = [];
        $model = $this;

        if ($socios_list != null && count($socios_list) > 0) {

            foreach ($socios_list as $value) {
                array_push($ids, $value->pessoa_id);
            }

            $socios = $model->find('all', [
                'conditions' => ['id in' => $ids]
            ])->contain(['Contatos'])->toArray();

            if (count($socios > 0)) {
                foreach ($socios as $socio) {
                    $socio->cpf_cnpj = $socio->masked_cpf_cnpj;
                }
            }

        }


        return $socios;
    }


    /**
     * Remover Caracteres.
     *
     * OBJETIVO: Remove os caracteres passados especiais ("/", ".", "-") da String passada por parâmetro.
     *
     * REQUEST: $string: String com os caracteres especiais.
     *
     * RESPONSE: $string: String sem os caracteres especiais.
     *
     */

    public function removerCaracteres($string = null) {

        $caracteres = array("/", ".", "-");
        $string = str_replace($caracteres, "", $string);

        return $string;
    }

    /**
     * Padronizar CPF/CNPJ.
     *
     * OBJETIVO: Converte a String (Caso seja um CPF) para o padrão do Bnaco de dados.
     *
     * REQUEST: $cpf_cipj: String com o cpf_cnpj.
     *
     * RESPONSE: $cpf_cnpj: String com o cpf_cnpj convertido (Se necessario).
     *
     */

    public function padronizarCpfCnpf($cpf_cnpj = null) {

        if (strlen($cpf_cnpj) == 11) {
            $cpf_cnpj = "000".$cpf_cnpj;
        }

        return $cpf_cnpj;
    }

    /**
     * Get Pessoa.
     *
     * OBJETIVO: Verificar se a Pessoa esta cadastra no banco de dados de acordo com o
     * filtro passsado na requisição.
     *
     * REQUEST: $filtro: Array com as regras da requisição.
     *
     * RESPONSE: $pessoas: Array contendo o(s) dado(s) da(s) pessoa(s) econtrado no banco
     * de dados.
     *
     */

    public function getPessoa($filtro = null) {
        //Gera o model da tabela Pessoas
        $pessoas_model = $this;

        //Verifica se o parâmetro passado é um array.
        if (!is_array($filtro)) {

            return false;

        } else {

            //Realiza a busca no banco de dados.
            $pessoas = $pessoas_model->find('all', [
                'conditions' => [$filtro],
                'order' => ['Pessoas.nome']
            ])->contain(['Contatos'])->toArray();

            if (count($pessoas > 0)) {
                foreach ($pessoas as $pessoa) {
                    $pessoa->cpf_cnpj = $pessoa->masked_cpf_cnpj;
                }
            }

            return $pessoas;

        }
    }
}
