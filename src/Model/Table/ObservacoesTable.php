<?php
namespace Agenda\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Observacoes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vendas
 * @property \Cake\ORM\Association\BelongsTo $Visitas
 * @property \Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \Agenda\Model\Entity\Observaco get($primaryKey, $options = [])
 * @method \Agenda\Model\Entity\Observaco newEntity($data = null, array $options = [])
 * @method \Agenda\Model\Entity\Observaco[] newEntities(array $data, array $options = [])
 * @method \Agenda\Model\Entity\Observaco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Agenda\Model\Entity\Observaco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Observaco[] patchEntities($entities, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Observaco findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ObservacoesTable extends Table
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

        $this->table('observacoes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Vendas', [
            'foreignKey' => 'venda_id',
            'joinType' => 'INNER',
            'className' => 'Agenda.Vendas'
        ]);

        $this->belongsTo('Visitas', [
            'ForeignKey' => 'visita_id',
            'className' => 'Agenda.Visitas'
        ]);

        $this->belongsTo('Pessoas', [
            'ForeignKey' => 'pessoa_id',
            'className' => 'Agenda.Pessoas'
        ]);

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
            'className' => 'Agenda.Usuarios'
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
            ->allowEmpty('observacao');*/

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
        $rules->add($rules->existsIn(['visita_id'], 'Visitas'));

        return $rules;
    }
}
