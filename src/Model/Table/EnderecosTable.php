<?php
namespace Agenda\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Enderecos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vendas
 * @property \Cake\ORM\Association\BelongsTo $Pessoas
 * @property \Cake\ORM\Association\BelongsToMany $Clientes
 *
 * @method \Agenda\Model\Entity\Endereco get($primaryKey, $options = [])
 * @method \Agenda\Model\Entity\Endereco newEntity($data = null, array $options = [])
 * @method \Agenda\Model\Entity\Endereco[] newEntities(array $data, array $options = [])
 * @method \Agenda\Model\Entity\Endereco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Agenda\Model\Entity\Endereco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Endereco[] patchEntities($entities, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Endereco findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnderecosTable extends Table
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

        $this->table('enderecos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Vendas', [
            'foreignKey' => 'venda_id',
            'joinType' => 'INNER',
            'className' => 'Agenda.Vendas'
        ]);

        $this->belongsTo('Pessoas', [
            'foreignKey' => 'pessoa_id',
            'className' => 'Agenda.Pessoas'
        ]);

        $this->belongsToMany('Clientes', [
            'foreignKey' => 'endereco_id',
            'targetForeignKey' => 'cliente_id',
            'joinTable' => 'clientes_enderecos',
            'className' => 'Agenda.Clientes'
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
            ->requirePresence('cep', 'create')
            ->notEmpty('cep');

        $validator
            ->requirePresence('endereco', 'create')
            ->notEmpty('endereco');

        $validator
            ->requirePresence('numero', 'create')
            ->notEmpty('numero');

        $validator
            ->requirePresence('complemento', 'create')
            ->notEmpty('complemento');

        $validator
            ->requirePresence('referencia', 'create')
            ->notEmpty('referencia');

        $validator
            ->requirePresence('bairro', 'create')
            ->notEmpty('bairro');

        $validator
            ->requirePresence('cidade', 'create')
            ->notEmpty('cidade');

        $validator
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        $validator
            ->requirePresence('cep_instalacao', 'create')
            ->notEmpty('cep_instalacao');

        $validator
            ->requirePresence('endereco_instalacao', 'create')
            ->notEmpty('endereco_instalacao');

        $validator
            ->requirePresence('numero_instalacao', 'create')
            ->notEmpty('numero_instalacao');

        $validator
            ->requirePresence('complemento_instalacao', 'create')
            ->notEmpty('complemento_instalacao');

        $validator
            ->requirePresence('referencia_instalacao', 'create')
            ->notEmpty('referencia_instalacao');

        $validator
            ->requirePresence('bairro_instalacao', 'create')
            ->notEmpty('bairro_instalacao');

        $validator
            ->requirePresence('cidade_instalacao', 'create')
            ->notEmpty('cidade_instalacao');

        $validator
            ->requirePresence('estado_instalacao', 'create')
            ->notEmpty('estado_instalacao');*/

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['pessoa_id'], 'Pessoas'));

        return $rules;
    }
}
