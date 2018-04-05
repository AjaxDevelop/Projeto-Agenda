<?php
namespace Agenda\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HistoricosVisitas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Pessoas
 * @property \Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \Agenda\Model\Entity\HistoricosVisita get($primaryKey, $options = [])
 * @method \Agenda\Model\Entity\HistoricosVisita newEntity($data = null, array $options = [])
 * @method \Agenda\Model\Entity\HistoricosVisita[] newEntities(array $data, array $options = [])
 * @method \Agenda\Model\Entity\HistoricosVisita|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Agenda\Model\Entity\HistoricosVisita patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Agenda\Model\Entity\HistoricosVisita[] patchEntities($entities, array $data, array $options = [])
 * @method \Agenda\Model\Entity\HistoricosVisita findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HistoricosVisitasTable extends Table
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

        $this->table('historicos_visitas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Pessoas', [
            'foreignKey' => 'pessoa_id',
            'joinType' => 'INNER',
            'className' => 'Agenda.Pessoas'
        ]);

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'responsavel_id',
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

        $validator
            ->date('data')
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        $validator
            ->requirePresence('hora_inicial', 'create')
            ->notEmpty('hora_inicial');

        $validator
            ->requirePresence('hora_final', 'create')
            ->notEmpty('hora_final');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));

        return $rules;
    }


}
