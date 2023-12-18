<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankSeed Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 * @property \Cake\ORM\Association\HasMany $InputSeed
 * @property \Cake\ORM\Association\HasMany $OutputSeed
 *
 * @method \App\Model\Entity\BankSeed get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankSeed newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BankSeed[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankSeed|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankSeed patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankSeed[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankSeed findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BankSeedTable extends Table
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

        $this->setTable('bank_seed');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('InputSeed', [
            'foreignKey' => 'bank_seed_id'
        ]);
        $this->hasMany('OutputSeed', [
            'foreignKey' => 'bank_seed_id'
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
            ->allowEmpty('othenumb');

        $validator
            ->allowEmpty('detecnumb');

        $validator
            ->allowEmpty('lotnumb');

        $validator
            ->date('acqdate')
            ->allowEmpty('acqdate');

        $validator
            ->allowEmpty('origin');

        $validator
            ->integer('availability')
            ->allowEmpty('availability');

        $validator
            ->allowEmpty('accimag1');

        $validator
            ->allowEmpty('accimag2');

        $validator
            ->allowEmpty('remarks1');

        $validator
            ->allowEmpty('remarks2');

        $validator
            ->integer('harvestdate')
            ->allowEmpty('harvestdate');

        $validator
            ->integer('bags')
            ->allowEmpty('bags');

        $validator
            ->decimal('seeweight')
            ->allowEmpty('seeweight');

        $validator
            ->integer('seednumb')
            ->allowEmpty('seednumb');

        $validator
            ->integer('seedpro')
            ->allowEmpty('seedpro');

        $validator
            ->integer('seedsto')
            ->allowEmpty('seedsto');

        $validator
            ->allowEmpty('color');

        $validator
            ->decimal('size')
            ->allowEmpty('size');

        $validator
            ->allowEmpty('shape');

        $validator
            ->integer('typeref')
            ->allowEmpty('typeref');

        $validator
            ->integer('typemat')
            ->allowEmpty('typemat');

        $validator
            ->integer('germination')
            ->allowEmpty('germination');

        $validator
            ->decimal('seedhum')
            ->allowEmpty('seedhum');

        $validator
            ->allowEmpty('viability');

        $validator
            ->decimal('discweight')
            ->allowEmpty('discweight');

        $validator
            ->integer('discnumb')
            ->allowEmpty('discnumb');

        $validator
            ->decimal('p1')
            ->allowEmpty('p1');

        $validator
            ->integer('n1')
            ->allowEmpty('n1');

        $validator
            ->decimal('p2')
            ->allowEmpty('p2');

        $validator
            ->integer('n2')
            ->allowEmpty('n2');

        $validator
            ->decimal('p3')
            ->allowEmpty('p3');

        $validator
            ->integer('n3')
            ->allowEmpty('n3');

        $validator
            ->decimal('p4')
            ->allowEmpty('p4');

        $validator
            ->integer('n4')
            ->allowEmpty('n4');

        $validator
            ->decimal('p5')
            ->allowEmpty('p5');

        $validator
            ->integer('n5')
            ->allowEmpty('n5');

        $validator
            ->decimal('realweight')
            ->allowEmpty('realweight');

        $validator
            ->integer('storage')
            ->allowEmpty('storage');

        $validator
            ->integer('temp')
            ->allowEmpty('temp');

        $validator
            ->integer('humidity')
            ->allowEmpty('humidity');

        $validator
            ->allowEmpty('shelving');

        $validator
            ->allowEmpty('resistance');

        $validator
            ->allowEmpty('tolerancia');

        $validator
            ->allowEmpty('susceptibility');

        $validator
            ->integer('ciclo')
            ->allowEmpty('ciclo');

        $validator
            ->integer('time')
            ->allowEmpty('time');

        $validator
            ->integer('performance')
            ->allowEmpty('performance');

        $validator
            ->allowEmpty('responsible');

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
