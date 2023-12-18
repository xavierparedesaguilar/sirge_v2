<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Specie Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Collection
 * @property \Cake\ORM\Association\HasMany $Descriptor
 * @property \Cake\ORM\Association\HasMany $Passport
 *
 * @method \App\Model\Entity\Specie get($primaryKey, $options = [])
 * @method \App\Model\Entity\Specie newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Specie[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Specie|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Specie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Specie[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Specie findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SpecieTable extends Table
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

        $this->setTable('specie');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Collection', [
            'foreignKey' => 'collection_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Descriptor', [
            'foreignKey' => 'specie_id'
        ]);
        $this->hasMany('Passport', [
            'foreignKey' => 'specie_id'
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
            ->allowEmpty('genus');

        $validator
            ->allowEmpty('species');

        $validator
            ->allowEmpty('cropname');

        $validator
            ->allowEmpty('family');

        $validator
            ->integer('collection_id')
            ->requirePresence('collection_id')
            ->notEmpty('collection_id', 'Colección no puede estar vacío.');

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
        $rules->add($rules->existsIn(['collection_id'], 'Collection'));

        return $rules;
    }
}
