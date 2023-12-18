<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankDna Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 * @property \Cake\ORM\Association\HasMany $ExtractionDna
 * @property \Cake\ORM\Association\HasMany $InputDna
 * @property \Cake\ORM\Association\HasMany $OutputDna
 * @property \Cake\ORM\Association\HasMany $TestIntegrityDna
 * @property \Cake\ORM\Association\HasMany $TestPurityDna
 *
 * @method \App\Model\Entity\BankDna get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankDna newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BankDna[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankDna|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankDna patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankDna[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankDna findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BankDnaTable extends Table
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

        $this->setTable('bank_dna');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ExtractionDna', [
            'foreignKey' => 'bank_dna_id'
        ]);
        $this->hasMany('InputDna', [
            'foreignKey' => 'bank_dna_id'
        ]);
        $this->hasMany('OutputDna', [
            'foreignKey' => 'bank_dna_id'
        ]);
        $this->hasMany('TestIntegrityDna', [
            'foreignKey' => 'bank_dna_id'
        ]);
        $this->hasMany('TestPurityDna', [
            'foreignKey' => 'bank_dna_id'
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
            ->integer('type_resource')
            ->allowEmpty('type_resource');

        $validator
            ->integer('bank_availability')
            ->allowEmpty('bank_availability');

        $validator
            ->allowEmpty('lotnumb');

        $validator
            ->date('acqdate')
            ->allowEmpty('acqdate');

        $validator
            ->integer('availability')
            ->allowEmpty('availability');

        $validator
            ->allowEmpty('remarks');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('pasaporte')
            ->add('pasaporte', 'comparison', [
                    'rule' => function ($value, $context) {

                     return strlen($context['data']['passport_id']) >0 ;
                     },
                    'message' => 'Ingresar un Código Pasaporte válido.'
                    ])
            ->notEmpty('pasaporte','Ingresar el Código Pasaporte');

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
