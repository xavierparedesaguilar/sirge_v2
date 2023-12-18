<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConservationInvitro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankInvitro
 *
 * @method \App\Model\Entity\ConservationInvitro get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConservationInvitro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConservationInvitro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConservationInvitro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConservationInvitro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConservationInvitro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConservationInvitro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConservationInvitroTable extends Table
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

        $this->setTable('conservation_invitro');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BankInvitro', [
            'foreignKey' => 'bank_invitro_id',
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
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('stoper');

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
        $rules->add($rules->existsIn(['bank_invitro_id'], 'BankInvitro'));

        return $rules;
    }
}
