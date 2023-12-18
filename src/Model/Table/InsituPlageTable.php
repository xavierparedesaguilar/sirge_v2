<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InsituPlage Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Insitu
 *
 * @method \App\Model\Entity\InsituPlage get($primaryKey, $options = [])
 * @method \App\Model\Entity\InsituPlage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InsituPlage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InsituPlage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InsituPlage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InsituPlage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InsituPlage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InsituPlageTable extends Table
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

        $this->setTable('insitu_plage');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Insitu', [
            'foreignKey' => 'insitu_id',
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
            ->integer('severity')
            ->requirePresence('severity', 'create')
            ->notEmpty('severity');

        $validator
            ->allowEmpty('scientific_name');

        $validator
            ->allowEmpty('reported_damage');

        $validator
            ->allowEmpty('culture');

        $validator
            ->allowEmpty('common_name');

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
        $rules->add($rules->existsIn(['insitu_id'], 'Insitu'));

        return $rules;
    }
}
