<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankField Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 * @property \Cake\ORM\Association\HasMany $EvaluationField
 * @property \Cake\ORM\Association\HasMany $InputField
 * @property \Cake\ORM\Association\HasMany $OutputField
 *
 * @method \App\Model\Entity\BankField get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankField newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BankField[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankField|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankField[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankField findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BankFieldTable extends Table
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

        $this->setTable('bank_field');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('EvaluationField', [
            'foreignKey' => 'bank_field_id'
        ]);
        $this->hasMany('InputField', [
            'foreignKey' => 'bank_field_id'
        ]);
        $this->hasMany('OutputField', [
            'foreignKey' => 'bank_field_id'
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
            ->allowEmpty('expcode');

        $validator
            ->integer('bank_availability')
            ->allowEmpty('bank_availability');

        $validator
            ->integer('sowsamptype')
            ->allowEmpty('sowsamptype');

        $validator
            ->integer('objective')
            ->allowEmpty('objective');

        $validator
            ->date('startdate')
            ->allowEmpty('startdate');

        $validator
            ->date('enddate')
            ->allowEmpty('enddate');

        $validator
            ->allowEmpty('researcher');

        $validator
            ->allowEmpty('proyect');

        $validator
            ->allowEmpty('design');

        $validator
            ->decimal('fieldsize')
            ->allowEmpty('fieldsize');

        $validator
            ->integer('plotsize')
            ->allowEmpty('plotsize');

        $validator
            ->allowEmpty('treatment');

        $validator
            ->integer('reps')
            ->allowEmpty('reps');

        $validator
            ->allowEmpty('fieldmap');

        $validator
            ->allowEmpty('image1');

        $validator
            ->allowEmpty('remarks1');

        $validator
            ->integer('dpto')
            ->allowEmpty('dpto');

        $validator
            ->integer('prov')
            ->allowEmpty('prov');

        $validator
            ->integer('dist')
            ->allowEmpty('dist');

        $validator
            ->allowEmpty('locality');

        $validator
            ->integer('eea')
            ->allowEmpty('eea');

        $validator
            ->allowEmpty('field');

        $validator
            ->decimal('latitude')
            ->allowEmpty('latitude');

        $validator
            ->decimal('longitude')
            ->allowEmpty('longitude');

        $validator
            ->decimal('elevation')
            ->allowEmpty('elevation');

        $validator
            ->integer('plotnumb')
            ->allowEmpty('plotnumb');

        $validator
            ->allowEmpty('accenumb');

        $validator
            ->allowEmpty('othenumb');

        $validator
            ->allowEmpty('othername');

        $validator
            ->integer('colname')
            ->allowEmpty('colname');

        $validator
            ->allowEmpty('genus');

        $validator
            ->integer('species')
            ->allowEmpty('species');

        $validator
            ->allowEmpty('remarks');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('detecnumb');

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
