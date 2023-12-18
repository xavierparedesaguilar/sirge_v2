<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DescriptorState Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Descriptor
 *
 * @method \App\Model\Entity\DescriptorState get($primaryKey, $options = [])
 * @method \App\Model\Entity\DescriptorState newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DescriptorState[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DescriptorState|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DescriptorState patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DescriptorState[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DescriptorState findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DescriptorStateTable extends Table
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

        $this->setTable('descriptor_state');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Descriptor', [
            'foreignKey' => 'descriptor_id',
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
            ->requirePresence('label')
            ->notEmpty('label', 'Nombre de Estado no puede estar vacío.');

        $validator
            ->requirePresence('code')
            ->notEmpty('code', 'Estado no puede estar vacío.');

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
        $rules->add($rules->existsIn(['descriptor_id'], 'Descriptor'));

        return $rules;
    }
}
