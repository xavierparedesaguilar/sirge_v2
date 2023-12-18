<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DetailAdaptrnum Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CaractGenotypic
 *
 * @method \App\Model\Entity\DetailAdaptrnum get($primaryKey, $options = [])
 * @method \App\Model\Entity\DetailAdaptrnum newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DetailAdaptrnum[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DetailAdaptrnum|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetailAdaptrnum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DetailAdaptrnum[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DetailAdaptrnum findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DetailAdaptrnumTable extends Table
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

        $this->setTable('detail_adaptrnum');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['id', 'genotypic_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('CaractGenotypic', [
            'foreignKey' => 'genotypic_id',
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
            ->requirePresence('adapter_name', 'create')
            ->notEmpty('adapter_name');

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
        $rules->add($rules->existsIn(['genotypic_id'], 'CaractGenotypic'));

        return $rules;
    }
}
