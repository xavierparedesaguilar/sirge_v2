<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InputDna Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankDna
 *
 * @method \App\Model\Entity\InputDna get($primaryKey, $options = [])
 * @method \App\Model\Entity\InputDna newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InputDna[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InputDna|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InputDna patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InputDna[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InputDna findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InputDnaTable extends Table
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

        $this->setTable('input_dna');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BankDna', [
            'foreignKey' => 'bank_dna_id',
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
            ->allowEmpty('enterdate');

        // $validator
        //     ->naturalNumber('numtubent','Ingrese solo números enteros.')
        //     ->maxLength('numtubent',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('numtubent');

        $validator
            ->allowEmpty('rement');

        $validator
            ->integer('tipdep')
            ->allowEmpty('tipdep');

        $validator
            ->integer('tipmuestra')
            ->allowEmpty('tipmuestra');

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
        $rules->add($rules->existsIn(['bank_dna_id'], 'BankDna'));

        return $rules;
    }
}
