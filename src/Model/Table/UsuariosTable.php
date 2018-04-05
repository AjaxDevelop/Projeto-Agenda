<?php
namespace Agenda\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuarios Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Pessoas
 * @property \Cake\ORM\Association\HasMany $Listas
 * @property \Cake\ORM\Association\HasMany $Observacoes
 * @property \Cake\ORM\Association\HasMany $Reagendamentos
 * @property \Cake\ORM\Association\HasMany $Userconfs
 * @property \Cake\ORM\Association\BelongsToMany $Pdvs
 *
 * @method \Agenda\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \Agenda\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \Agenda\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \Agenda\Model\Entity\Usuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Agenda\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Usuario findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsuariosTable extends Table
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

        $this->table('usuarios');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Pessoas', [
            'foreignKey' => 'pessoa_id',
            'joinType' => 'INNER',
            'className' => 'Agenda.Pessoas'
        ]);
        $this->hasMany('Listas', [
            'foreignKey' => 'usuario_id',
            'className' => 'Agenda.Listas'
        ]);
        $this->hasMany('Observacoes', [
            'foreignKey' => 'usuario_id',
            'className' => 'Agenda.Observacoes'
        ]);
        $this->hasMany('Reagendamentos', [
            'foreignKey' => 'usuario_id',
            'className' => 'Agenda.Reagendamentos'
        ]);
        $this->hasMany('Userconfs', [
            'foreignKey' => 'usuario_id',
            'className' => 'Agenda.Userconfs'
        ]);
        $this->belongsToMany('Pdvs', [
            'foreignKey' => 'usuario_id',
            'targetForeignKey' => 'pdv_id',
            'joinTable' => 'pdvs_usuarios',
            'className' => 'Agenda.Pdvs'
        ]);

        $this->hasMany('Visitas', [
            'foreignKey' => 'usuario_id',
            'className' => 'Agenda.Visitas'
        ]);

        $this->hasMany('Historicos_Visitas', [
            'foreignKey' => 'responsavel_id'
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
            ->requirePresence('display', 'create')
            ->notEmpty('display');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('senha', 'create')
            ->notEmpty('senha');

        $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role');

        $validator
            ->requirePresence('ativo', 'create')
            ->notEmpty('ativo');

        $validator
            ->requirePresence('interno', 'create')
            ->notEmpty('interno');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['pessoa_id'], 'Pessoas'));

        return $rules;
    }

}
