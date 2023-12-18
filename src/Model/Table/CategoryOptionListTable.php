<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoryOptionList Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentCategoryOptionList
 * @property \Cake\ORM\Association\HasMany $ChildCategoryOptionList
 *
 * @method \App\Model\Entity\CategoryOptionList get($primaryKey, $options = [])
 * @method \App\Model\Entity\CategoryOptionList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CategoryOptionList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CategoryOptionList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CategoryOptionList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CategoryOptionList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CategoryOptionList findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CategoryOptionListTable extends Table
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

        $this->setTable('category_option_list');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentCategoryOptionList', [
            'className' => 'CategoryOptionList',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildCategoryOptionList', [
            'className' => 'CategoryOptionList',
            'foreignKey' => 'parent_id'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('slug');

        $validator
            ->integer('status')
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentCategoryOptionList'));

        return $rules;
    }
}
