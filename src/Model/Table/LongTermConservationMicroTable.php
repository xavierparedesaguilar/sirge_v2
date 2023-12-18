<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LongTermConservationMicro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankMicro
 *
 * @method \App\Model\Entity\LongTermConservationMicro get($primaryKey, $options = [])
 * @method \App\Model\Entity\LongTermConservationMicro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LongTermConservationMicro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LongTermConservationMicro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LongTermConservationMicro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LongTermConservationMicro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LongTermConservationMicro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LongTermConservationMicroTable extends Table
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

        $this->setTable('long_term_conservation_micro');
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
            ->integer('longtermcon')
            ->allowEmpty('longtermcon');

        $validator
            ->allowEmpty('longtermtemp');

        $validator
            ->allowEmpty('longtermtime');

        $validator
            ->integer('criopro')
            ->allowEmpty('criopro');

        $validator
            ->integer('longtermtype')
            ->allowEmpty('longtermtype');

        $validator
            ->integer('criovinumb')
            ->allowEmpty('criovinumb');

        $validator
            ->integer('crioviminstock')
            ->allowEmpty('crioviminstock');

        $validator
            ->allowEmpty('longstornumb');

        $validator
            ->integer('longstorage')
            ->allowEmpty('longstorage');

        $validator
            ->allowEmpty('criolevel');

        $validator
            ->allowEmpty('criorack');

        $validator
            ->allowEmpty('longrackpos');

        $validator
            ->integer('longcrionumb')
            ->allowEmpty('longcrionumb');

        $validator
            ->allowEmpty('longcriopos');

        $validator
            ->allowEmpty('amprack');

        $validator
            ->allowEmpty('amppos');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
