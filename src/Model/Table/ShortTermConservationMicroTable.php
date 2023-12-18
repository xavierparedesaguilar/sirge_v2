<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ShortTermConservationMicro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankMicro
 *
 * @method \App\Model\Entity\ShortTermConservationMicro get($primaryKey, $options = [])
 * @method \App\Model\Entity\ShortTermConservationMicro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ShortTermConservationMicro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ShortTermConservationMicro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ShortTermConservationMicro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ShortTermConservationMicro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ShortTermConservationMicro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShortTermConservationMicroTable extends Table
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

        $this->setTable('short_term_conservation_micro');
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
            ->date('constime')
            ->allowEmpty('constime');

        $validator
            ->allowEmpty('consresponsible');

        $validator
            ->allowEmpty('consrem');

        $validator
            ->integer('shortermcon')
            ->allowEmpty('shortermcon');

        $validator
            ->allowEmpty('shortermtemp');

        $validator
            ->allowEmpty('shortermtime');

        $validator
            ->integer('shortmatstor')
            ->allowEmpty('shortmatstor');

        $validator
            ->allowEmpty('shortmatnumb');

        $validator
            ->integer('shortminstock')
            ->allowEmpty('shortminstock');

        $validator
            ->allowEmpty('shortstornumb');

        $validator
            ->integer('shortstorage')
            ->allowEmpty('shortstorage');

        $validator
            ->allowEmpty('shortlevsh');

        $validator
            ->allowEmpty('criorack');

        $validator
            ->allowEmpty('shortrackpos');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->date('renewal_date')
            ->allowEmpty('renewal_date');

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
