<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Collection Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Resources
 * @property \Cake\ORM\Association\HasMany $Specie
 *
 * @method \App\Model\Entity\Collection get($primaryKey, $options = [])
 * @method \App\Model\Entity\Collection newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Collection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Collection|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Collection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Collection[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Collection findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CollectionTable extends Table
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

        $this->setTable('collection');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Station', [
            'foreignKey' => 'eea',
            'joinType'   => 'INNER',
        ]);

        $this->belongsTo('Resource', [
            'foreignKey' => 'resource_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Specie', [
            'foreignKey' => 'collection_id'
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
            ->allowEmpty('colname');

        $validator
            ->allowEmpty('colgroup');

        $validator
            ->integer('eea')
            ->allowEmpty('eea');

        $validator
            ->integer('invitro')
            ->allowEmpty('invitro');

        $validator
            ->integer('bseed')
            ->allowEmpty('bseed');

        $validator
            ->integer('bfield')
            ->allowEmpty('bfield');

        $validator
            ->integer('bdna')
            ->allowEmpty('bdna');

        $validator
            ->integer('insitu')
            ->allowEmpty('insitu');

        $validator
            ->integer('availability')
            ->allowEmpty('availability');

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
        $rules->add($rules->existsIn(['eea'], 'Station'));
        $rules->add($rules->existsIn(['resource_id'], 'Resource'));

        return $rules;
    }
}
