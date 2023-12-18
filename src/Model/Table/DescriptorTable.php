<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Descriptor Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Specie
 * @property \Cake\ORM\Association\BelongsTo $Resource
 * @property \Cake\ORM\Association\HasMany $DescriptorState
 * @property \Cake\ORM\Association\HasMany $DescriptorValue
 *
 * @method \App\Model\Entity\Descriptor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Descriptor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Descriptor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Descriptor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Descriptor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Descriptor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Descriptor findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DescriptorTable extends Table
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

        $this->setTable('descriptor');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Specie', [
            'foreignKey' => 'specie_id'
        ]);
        $this->belongsTo('Resource', [
            'foreignKey' => 'resource_id'
        ]);
        $this->hasMany('DescriptorState', [
            'foreignKey' => 'descriptor_id'
        ]);
        $this->hasMany('DescriptorValue', [
            'foreignKey' => 'descriptor_id'
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
            ->requirePresence('name')
            ->notEmpty('name', 'Descriptor no puede estar vacío.');


        $validator
            ->requirePresence('title')
            ->notEmpty('title', 'Título no puede estar vacío.');

        $validator
            ->integer('value_type')
            ->requirePresence('value_type', 'create')
            ->notEmpty('value_type', 'Tipo no puede estar vacío.');

        $validator
            ->integer('type')
            ->allowEmpty('type');

        $validator
            ->allowEmpty('description');

        $validator
            ->integer('flg_catalogue')
            ->allowEmpty('flg_catalogue');

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
        $rules->add($rules->existsIn(['specie_id'], 'Specie'));
        $rules->add($rules->existsIn(['resource_id'], 'Resource'));

        return $rules;
    }
}
