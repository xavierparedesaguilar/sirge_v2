<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InsituAccesion Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Insitu
 * @property \Cake\ORM\Association\BelongsTo $Passport
 *
 * @method \App\Model\Entity\InsituAccesion get($primaryKey, $options = [])
 * @method \App\Model\Entity\InsituAccesion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InsituAccesion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InsituAccesion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InsituAccesion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InsituAccesion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InsituAccesion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InsituAccesionTable extends Table
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

        $this->setTable('insitu_accesion');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Insitu', [
            'foreignKey' => 'insitu_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id'
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
            ->allowEmpty('accenumb');

        $validator
            ->allowEmpty('othenumb');

        $validator
            ->allowEmpty('common_name');

        $validator
            ->allowEmpty('manifold');

        $validator
            ->allowEmpty('reported_usage');

        $validator
            ->allowEmpty('extension');

        $validator
            ->allowEmpty('area_cultivation');

        $validator
            ->allowEmpty('others');

        $validator
            ->allowEmpty('scientific_name');

        $validator
            ->allowEmpty('uso');

        $validator
            ->allowEmpty('local_name');

        $validator
            ->allowEmpty('habitat');

        $validator
            ->allowEmpty('reference');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('wild_relatives');

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
        $rules->add($rules->existsIn(['passport_id'], 'Passport'));

        return $rules;
    }
}
