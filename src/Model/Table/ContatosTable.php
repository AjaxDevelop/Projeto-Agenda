<?php
namespace Agenda\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contatos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vendas
 * @property \Cake\ORM\Association\BelongsTo $Pessoas
 *
 * @method \Agenda\Model\Entity\Contato get($primaryKey, $options = [])
 * @method \Agenda\Model\Entity\Contato newEntity($data = null, array $options = [])
 * @method \Agenda\Model\Entity\Contato[] newEntities(array $data, array $options = [])
 * @method \Agenda\Model\Entity\Contato|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Agenda\Model\Entity\Contato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Contato[] patchEntities($entities, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Contato findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContatosTable extends Table
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

        $this->table('contatos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Pessoas', [
            'foreignKey' => 'pessoa_id',
            'className' => 'Agenda.Pessoas'
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
            ->requirePresence('contato', 'create')
            ->notEmpty('contato');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');*/

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
