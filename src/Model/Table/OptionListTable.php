<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OptionList Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentOptionList
 * @property \Cake\ORM\Association\BelongsTo $Children
 * @property \Cake\ORM\Association\BelongsTo $Resources
 * @property \Cake\ORM\Association\HasMany $ChildOptionList
 *
 * @method \App\Model\Entity\OptionList get($primaryKey, $options = [])
 * @method \App\Model\Entity\OptionList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OptionList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OptionList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OptionList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OptionList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OptionList findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OptionListTable extends Table
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

        $this->setTable('option_list');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        // $this->belongsTo('ParentOptionList', [
        //     'className' => 'OptionList',
        //     'foreignKey' => 'parent_id'
        // ]);
        // $this->belongsTo('Children', [
        //     'foreignKey' => 'child_id'
        // ]);
        $this->belongsTo('Resource', [
            'foreignKey' => 'resource_id',
            'joinType' => 'INNER'
        ]);
        // $this->hasMany('ChildOptionList', [
        //     'className' => 'OptionList',
        //     'foreignKey' => 'parent_id'
        // ]);
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
            ->notEmpty('name', 'El nombre no puede estar vacío.');

        $validator
            ->allowEmpty('slug');

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
        // $rules->add($rules->existsIn(['parent_id'], 'ParentOptionList'));
        // $rules->add($rules->existsIn(['child_id'], 'Children'));
        $rules->add($rules->existsIn(['resource_id'], 'Resource'));

        return $rules;
    }
}
