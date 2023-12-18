<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InputInvitro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankInvitro
 *
 * @method \App\Model\Entity\InputInvitro get($primaryKey, $options = [])
 * @method \App\Model\Entity\InputInvitro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InputInvitro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InputInvitro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InputInvitro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InputInvitro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InputInvitro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InputInvitroTable extends Table
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

        $this->setTable('input_invitro');
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
            ->allowEmpty('donorcore');

        $validator
            ->allowEmpty('donorname');

        $validator
            ->allowEmpty('donornumb');

        $validator
            ->date('enterdate')
            ->allowEmpty('enterdate');

        // $validator
        //     ->naturalNumber('tubentnumb','Ingresar solo números enteros positivos.')
        //     ->maxLength('tubentnumb',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('tubentnumb');

        // $validator
        //     ->naturalNumber('explentnumb','Ingresar solo números enteros positivos.')
        //     ->maxLength('explentnumb',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('explentnumb');


        $validator
            ->allowEmpty('rement');

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
