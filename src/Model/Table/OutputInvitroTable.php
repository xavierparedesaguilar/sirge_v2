<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OutputInvitro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankInvitro
 *
 * @method \App\Model\Entity\OutputInvitro get($primaryKey, $options = [])
 * @method \App\Model\Entity\OutputInvitro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OutputInvitro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OutputInvitro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OutputInvitro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OutputInvitro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OutputInvitro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OutputInvitroTable extends Table
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

        $this->setTable('output_invitro');
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
            ->allowEmpty('reqcode');

        $validator
            ->allowEmpty('reqname');

        $validator
            ->date('exitdate')
            ->allowEmpty('exitdate');

        $validator
            ->naturalNumber('tubexitnumb','Ingresar solo números enteros positivos.')
            ->maxLength('tubexitnumb',10,'Ingrese como máximo 9 dígitos')
            ->allowEmpty('tubexitnumb');

        $validator
            ->naturalNumber('explexitnumb','Ingresar solo números enteros positivos.')
            ->maxLength('explexitnumb',10,'Ingrese como máximo 9 dígitos')
            ->allowEmpty('explexitnumb');

        $validator
            ->allowEmpty('reason');

        $validator
            ->allowEmpty('remexit');

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
        $rules->add($rules->existsIn(['bank_invitro_id'], 'BankInvitro'));

        return $rules;
    }
}
