<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * User Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Role
 * @property \Cake\ORM\Association\BelongsTo $Country
 * @property \Cake\ORM\Association\BelongsTo $Station
 * @property \Cake\ORM\Association\HasMany $Insitu
 * @property \Cake\ORM\Association\HasMany $Log
 * @property \Cake\ORM\Association\HasMany $TempCaracterizacion
 * @property \Cake\ORM\Association\HasMany $TempDescriptores
 * @property \Cake\ORM\Association\HasMany $TempPassportFito
 * @property \Cake\ORM\Association\HasMany $TempPassportMicro
 * @property \Cake\ORM\Association\HasMany $TempPassportZoo
 * @property \Cake\ORM\Association\BelongsToMany $Module
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserTable extends Table
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

        $this->setTable('user');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Role', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Country', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Station', [
            'foreignKey' => 'station_id'
        ]);
        $this->hasMany('Insitu', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Log', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TempCaracterizacion', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TempDescriptores', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TempPassportFito', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TempPassportMicro', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('TempPassportZoo', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsToMany('Module', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'module_id',
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
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->allowEmpty('names');

        $validator
            ->allowEmpty('surnames');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        $validator
            ->allowEmpty('gender');

        $validator
            ->date('birth_date')
            ->allowEmpty('birth_date');

        $validator
            ->allowEmpty('study_center');

        $validator
            ->allowEmpty('institute');

        $validator
            ->allowEmpty('code_fao');

        $validator
            ->allowEmpty('origin');

        $validator
            ->integer('status')
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Role'));
        $rules->add($rules->existsIn(['country_id'], 'Country'));
        $rules->add($rules->existsIn(['station_id'], 'Station'));

        return $rules;
    }
}
