<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Module Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentModule
 * @property \Cake\ORM\Association\BelongsTo $Resource
 * @property \Cake\ORM\Association\HasMany $Log
 * @property \Cake\ORM\Association\HasMany $ChildModule
 * @property \Cake\ORM\Association\BelongsToMany $Role
 * @property \Cake\ORM\Association\BelongsToMany $User
 *
 * @method \App\Model\Entity\Module get($primaryKey, $options = [])
 * @method \App\Model\Entity\Module newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Module[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Module|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Module patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Module[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Module findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ModuleTable extends Table
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

        $this->setTable('module');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentModule', [
            'className' => 'Module',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Resource', [
            'foreignKey' => 'resource_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Log', [
            'foreignKey' => 'module_id'
        ]);
        $this->hasMany('ChildModule', [
            'className' => 'Module',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Role', [
            'foreignKey' => 'module_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'module_role'
        ]);
        $this->belongsToMany('User', [
            'foreignKey' => 'module_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'module_user'
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
            ->integer('flg_visible')
            ->allowEmpty('flg_visible');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('slug');

        $validator
            ->allowEmpty('icon');

        $validator
            ->allowEmpty('description');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('controller');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentModule'));
        $rules->add($rules->existsIn(['resource_id'], 'Resource'));

        return $rules;
    }
}
