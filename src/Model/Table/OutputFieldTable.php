<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OutputField Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankField
 *
 * @method \App\Model\Entity\OutputField get($primaryKey, $options = [])
 * @method \App\Model\Entity\OutputField newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OutputField[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OutputField|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OutputField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OutputField[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OutputField findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OutputFieldTable extends Table
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

        $this->setTable('output_field');
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
            ->allowEmpty('reqcode');

        $validator
            ->allowEmpty('reqname');

        $validator
            ->date('exitdate')
            ->allowEmpty('exitdate');

        $validator
            ->integer('samptype')
            ->allowEmpty('samptype');

        $validator
            // ->naturalNumber('samplamount','Ingresar solo números enteros positivos.')
            // ->maxLength('samplamount',10,'Ingrese como máximo 9 dígitos')
            ->allowEmpty('samplamount');

        $validator
            ->allowEmpty('destiny');

        $validator
            ->allowEmpty('object');

        $validator
            ->allowEmpty('remexit');

        $validator
            ->allowEmpty('sampres');

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
