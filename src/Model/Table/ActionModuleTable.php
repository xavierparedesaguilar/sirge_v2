<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActionModule Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Module
 *
 * @method \App\Model\Entity\ActionModule get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActionModule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActionModule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActionModule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActionModule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActionModule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActionModule findOrCreate($search, callable $callback = null, $options = [])
 */
class ActionModuleTable extends Table
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

        $this->setTable('action_module');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Module', [
            'foreignKey' => 'module_id'
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
            ->allowEmpty('action_name');

        $validator
            ->allowEmpty('action_parent');

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
        $rules->add($rules->existsIn(['module_id'], 'Module'));

        return $rules;
    }
}
