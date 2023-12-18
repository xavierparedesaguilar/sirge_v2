<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InputMicro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankMicro
 *
 * @method \App\Model\Entity\InputMicro get($primaryKey, $options = [])
 * @method \App\Model\Entity\InputMicro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InputMicro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InputMicro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InputMicro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InputMicro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InputMicro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InputMicroTable extends Table
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

        $this->setTable('input_micro');
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
            ->allowEmpty('donorcore');

        $validator
            ->allowEmpty('donorname');

        $validator
            ->allowEmpty('donornumb');

        $validator
            ->date('enterdate')
            ->allowEmpty('enterdate');

        $validator
            ->integer('numtubent')
            ->allowEmpty('numtubent');

        $validator
            ->allowEmpty('rement');

        $validator
            ->allowEmpty('sampstat');

        $validator
            ->integer('tipdep')
            ->allowEmpty('tipdep');

        $validator
            ->integer('estmuestra')
            ->allowEmpty('estmuestra');

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
        $rules->add($rules->existsIn(['bank_micro_id'], 'BankMicro'));

        return $rules;
    }
}
