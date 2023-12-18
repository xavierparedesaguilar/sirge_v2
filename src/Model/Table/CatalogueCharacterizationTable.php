<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CatalogueCharacterization Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Descriptors
 * @property \Cake\ORM\Association\BelongsTo $Resources
 * @property \Cake\ORM\Association\BelongsTo $Collections
 * @property \Cake\ORM\Association\BelongsTo $Species
 *
 * @method \App\Model\Entity\CatalogueCharacterization get($primaryKey, $options = [])
 * @method \App\Model\Entity\CatalogueCharacterization newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CatalogueCharacterization[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueCharacterization|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CatalogueCharacterization patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueCharacterization[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CatalogueCharacterization findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CatalogueCharacterizationTable extends Table
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

        $this->setTable('catalogue_characterization');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Descriptor', [
            'foreignKey' => 'descriptor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Resource', [
            'foreignKey' => 'resource_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Collection', [
            'foreignKey' => 'collection_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Specie', [
            'foreignKey' => 'specie_id',
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
            ->requirePresence('descriptor_name', 'create')
            ->notEmpty('descriptor_name');

        $validator
            ->integer('availability')
            ->requirePresence('availability', 'create')
            ->notEmpty('availability');

        $validator
            ->integer('resource_id')
            ->requirePresence('resource_id', 'create')
            ->notEmpty('resource_id');

        $validator
            ->integer('collection_id')
            ->requirePresence('collection_id', 'create')
            ->notEmpty('collection_id');

        $validator
            ->integer('specie_id')
            ->requirePresence('specie_id', 'create')
            ->notEmpty('specie_id');

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
        $rules->add($rules->existsIn(['resource_id'], 'Resource'));
        $rules->add($rules->existsIn(['collection_id'], 'Collection'));
        $rules->add($rules->existsIn(['specie_id'], 'Specie'));

        return $rules;
    }
}
