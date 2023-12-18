<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankMicro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 * @property \Cake\ORM\Association\HasMany $InputMicro
 * @property \Cake\ORM\Association\HasMany $LongTermConservationMicro
 * @property \Cake\ORM\Association\HasMany $OutputMicro
 * @property \Cake\ORM\Association\HasMany $ShortTermConservationMicro
 *
 * @method \App\Model\Entity\BankMicro get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankMicro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BankMicro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankMicro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankMicro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankMicro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankMicro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BankMicroTable extends Table
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

        $this->setTable('bank_micro');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('InputMicro', [
            'foreignKey' => 'bank_micro_id'
        ]);
        $this->hasMany('LongTermConservationMicro', [
            'foreignKey' => 'bank_micro_id'
        ]);
        $this->hasMany('OutputMicro', [
            'foreignKey' => 'bank_micro_id'
        ]);
        $this->hasMany('ShortTermConservationMicro', [
            'foreignKey' => 'bank_micro_id'
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
            ->integer('bank_availability')
            ->allowEmpty('bank_availability');

        $validator
            ->allowEmpty('lotnumb');

        $validator
            ->allowEmpty('acqdate');

        $validator
            ->integer('availability')
            ->allowEmpty('availability');

        $validator
            ->integer('risk')
            ->allowEmpty('risk');

        $validator
            ->integer('lablevel')
            ->allowEmpty('lablevel');

        $validator
            ->allowEmpty('quarplace');

        $validator
            ->allowEmpty('quartime');

        $validator
            ->integer('reactivation')
            ->allowEmpty('reactivation');

        $validator
            ->allowEmpty('reactime');

        $validator
            ->allowEmpty('reactemp');

        $validator
            ->allowEmpty('reacdate');

        $validator
            ->allowEmpty('reacresponsible');

        $validator
            ->allowEmpty('reacrem');

        $validator
            ->integer('isolamed_1')
            ->allowEmpty('isolamed_1');

        $validator
            ->allowEmpty('reactime_1');

        $validator
            ->allowEmpty('reactemp_1');

        $validator
            ->integer('isolamed_2')
            ->allowEmpty('isolamed_2');

        $validator
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
            ->allowEmpty('datepurz');

        $validator
            ->allowEmpty('remarks');

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
        $rules->add($rules->existsIn(['passport_id'], 'Passport'));

        return $rules;
    }
}
