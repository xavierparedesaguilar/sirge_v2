<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrdersDetail Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Orders
 * @property \Cake\ORM\Association\BelongsTo $Passport
 * @property \Cake\ORM\Association\BelongsTo $Specie
 * @property \Cake\ORM\Association\BelongsTo $Banks
 *
 * @method \App\Model\Entity\OrdersDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrdersDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrdersDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrdersDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrdersDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrdersDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrdersDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersDetailTable extends Table
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

        $this->setTable('orders_detail');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Specie', [
            'foreignKey' => 'specie_id',
            'joinType' => 'INNER'
        ]);
        // $this->belongsTo('Banks', [
        //     'foreignKey' => 'bank_id',
        //     'joinType' => 'INNER'
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
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['passport_id'], 'Passport'));
        $rules->add($rules->existsIn(['specie_id'], 'Specie'));
        // $rules->add($rules->existsIn(['bank_id'], 'Banks'));

        return $rules;
    }
}
