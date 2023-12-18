<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InsituFarmerActivity Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Insitu
 *
 * @method \App\Model\Entity\InsituFarmerActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\InsituFarmerActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InsituFarmerActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InsituFarmerActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InsituFarmerActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InsituFarmerActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InsituFarmerActivity findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InsituFarmerActivityTable extends Table
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

        $this->setTable('insitu_farmer_activity');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Insitu', [
            'foreignKey' => 'insitu_id',
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
            ->allowEmpty('purpose');

        $validator
            ->allowEmpty('comunities');

        $validator
            ->allowEmpty('common_name');

        $validator
            ->allowEmpty('description');

        $validator
            ->integer('input_tools')
            ->allowEmpty('input_tools');

        $validator
            ->integer('origin')
            ->allowEmpty('origin');

        $validator
            ->integer('practice_know')
            ->allowEmpty('practice_know');

        $validator
            ->integer('technical_category')
            ->allowEmpty('technical_category');

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
        $rules->add($rules->existsIn(['insitu_id'], 'Insitu'));

        return $rules;
    }
}
