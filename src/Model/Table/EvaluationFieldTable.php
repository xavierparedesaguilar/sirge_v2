<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EvaluationField Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankField
 *
 * @method \App\Model\Entity\EvaluationField get($primaryKey, $options = [])
 * @method \App\Model\Entity\EvaluationField newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EvaluationField[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EvaluationField|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EvaluationField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EvaluationField[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EvaluationField findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EvaluationFieldTable extends Table
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

        $this->setTable('evaluation_field');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BankField', [
            'foreignKey' => 'bank_field_id',
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
            ->date('evaldate')
            ->allowEmpty('evaldate');

        $validator
            ->allowEmpty('evalname');

        $validator
            ->allowEmpty('evalrem');

        $validator
            ->integer('prodtype')
            ->allowEmpty('prodtype');

        $validator
            ->allowEmpty('prodrem');

        $validator
            ->allowEmpty('harvest');

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
        $rules->add($rules->existsIn(['bank_field_id'], 'BankField'));

        return $rules;
    }
}
