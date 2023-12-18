<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Insitu Model
 *
 * @property \Cake\ORM\Association\BelongsTo $User
 * @property \Cake\ORM\Association\BelongsTo $Ubigeo
 * @property \Cake\ORM\Association\HasMany $InsituAccesion
 * @property \Cake\ORM\Association\HasMany $InsituFarmerActivity
 * @property \Cake\ORM\Association\HasMany $InsituPlage
 * @property \Cake\ORM\Association\HasMany $InsituThreat
 *
 * @method \App\Model\Entity\Insitu get($primaryKey, $options = [])
 * @method \App\Model\Entity\Insitu newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Insitu[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Insitu|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Insitu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Insitu[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Insitu findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InsituTable extends Table
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

        $this->setTable('insitu');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Ubigeo', [
            'foreignKey' => 'ubigeo_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('InsituAccesion', [
            'foreignKey' => 'insitu_id'
        ]);
        $this->hasMany('InsituFarmerActivity', [
            'foreignKey' => 'insitu_id'
        ]);
        $this->hasMany('InsituPlage', [
            'foreignKey' => 'insitu_id'
        ]);
        $this->hasMany('InsituThreat', [
            'foreignKey' => 'insitu_id'
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
            ->requirePresence('code_insitu', 'create')
            ->notEmpty('code_insitu');

        $validator
            ->integer('degree_instruction')
            ->allowEmpty('degree_instruction');

        $validator
            ->integer('type_soil')
            ->allowEmpty('type_soil');

        $validator
            ->allowEmpty('reference');

        $validator
            ->allowEmpty('latitude');

        $validator
            ->allowEmpty('length');

        $validator
            ->allowEmpty('altitude');

        $validator
            ->allowEmpty('name_farmer');

        $validator
            ->allowEmpty('address_farmer');

        $validator
            ->integer('age_farmer')
            ->allowEmpty('age_farmer');

        $validator
            ->integer('peasant_organization')
            ->allowEmpty('peasant_organization');

        $validator
            ->allowEmpty('name_peasant_organization');

        $validator
            ->allowEmpty('biophysical_description');

        $validator
            ->allowEmpty('description_chakra');

        $validator
            ->integer('area')
            ->allowEmpty('area');

        $validator
            ->allowEmpty('living_area');

        $validator
            ->allowEmpty('meteorological_record');

        $validator
            ->allowEmpty('observation');

        $validator
            ->allowEmpty('description_workers');

        $validator
            ->integer('monitoring')
            ->allowEmpty('monitoring');

        $validator
            ->allowEmpty('ministerial_resolution');

        $validator
            ->integer('variety_number')
            ->allowEmpty('variety_number');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('other_people');

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
        $rules->add($rules->existsIn(['user_id'], 'User'));
        $rules->add($rules->existsIn(['ubigeo_id'], 'Ubigeo'));

        return $rules;
    }
}
