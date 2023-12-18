<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurityMicro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankMicro
 *
 * @method \App\Model\Entity\PurityMicro get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurityMicro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurityMicro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurityMicro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurityMicro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurityMicro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurityMicro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PurityMicroTable extends Table
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

        $this->setTable('purity_micro');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BankMicro', [
            'foreignKey' => 'bank_micro_id',
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
            ->integer('isolamed_1')
            ->allowEmpty('isolamed_1');

        $validator
            ->integer('reactime_1')
            ->allowEmpty('reactime_1');

        $validator
            ->allowEmpty('reactemp_1');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('isolamed_2')
            ->allowEmpty('isolamed_2');

        $validator
            ->integer('reactime_2')
            ->allowEmpty('reactime_2');

        $validator
            ->allowEmpty('reactemp_2');

        $validator
            ->integer('gramstain')
            ->allowEmpty('gramstain');

        $validator
            ->integer('lactobluestain')
            ->allowEmpty('lactobluestain');

        $validator
            ->date('datepurz')
            ->allowEmpty('datepurz');

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
        $rules->add($rules->existsIn(['bank_micro_id'], 'BankMicro'));

        return $rules;
    }
}
