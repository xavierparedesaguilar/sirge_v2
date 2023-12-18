<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModuleUser Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Module
 * @property \Cake\ORM\Association\BelongsTo $User
 *
 * @method \App\Model\Entity\ModuleUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\ModuleUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ModuleUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ModuleUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ModuleUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ModuleUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ModuleUser findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ModuleUserTable extends Table
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

        $this->setTable('module_user');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Module', [
            'foreignKey' => 'module_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->allowEmpty('permissions');

        $validator
            ->integer('status')
            //->requirePresence('status', 'create')
            //->notEmpty('status');
            ->allowEmpty('status', 'create');

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
        $rules->add($rules->existsIn(['module_id'], 'Module'));
        $rules->add($rules->existsIn(['user_id'], 'User'));

        return $rules;
    }
}
