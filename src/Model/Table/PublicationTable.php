<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Publication Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Country
 * @property \Cake\ORM\Association\BelongsTo $Collection
 *
 * @method \App\Model\Entity\Publication get($primaryKey, $options = [])
 * @method \App\Model\Entity\Publication newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Publication[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Publication|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Publication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Publication[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Publication findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PublicationTable extends Table
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

        $this->setTable('publication');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Country', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Collection', [
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('author', 'create')
            ->notEmpty('author');

        $validator
            ->requirePresence('editorial', 'create')
            ->notEmpty('editorial');

        $validator
            ->requirePresence('languages', 'create')
            ->notEmpty('languages');

        $validator
            ->decimal('fec_edit')
            ->requirePresence('fec_edit', 'create')
            ->notEmpty('fec_edit');

        $validator
            ->decimal('month_edit')
            ->requirePresence('month_edit', 'create')
            ->notEmpty('month_edit');

        $validator
            ->integer('edition')
            ->requirePresence('edition', 'create')
            ->notEmpty('edition');

        $validator
            ->allowEmpty('public_place');

        $validator
            ->integer('numpag')
            ->requirePresence('numpag', 'create')
            ->notEmpty('numpag');

        $validator
            ->integer('copy')
            ->requirePresence('copy', 'create')
            ->notEmpty('copy');

        $validator
            ->integer('public_type')
            ->requirePresence('public_type', 'create')
            ->notEmpty('public_type');

        $validator
            ->allowEmpty('note');

        $validator
            ->requirePresence('summary', 'create')
            ->notEmpty('summary');

        $validator
            ->integer('volume')
            ->requirePresence('volume', 'create')
            ->notEmpty('volume');

        $validator
            ->allowEmpty('institution');

        $validator
            ->integer('category')
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        $validator
            ->allowEmpty('descriptors');

        $validator
            ->requirePresence('principal_image', 'create')
            ->notEmpty('principal_image');

        $validator
            ->requirePresence('documents', 'create')
            ->notEmpty('documents');

        $validator
            ->integer('availability')
            ->requirePresence('availability', 'create')
            ->notEmpty('availability');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('second_image');

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
        $rules->add($rules->existsIn(['country_id'], 'Country'));
        $rules->add($rules->existsIn(['collection_id'], 'Collection'));

        return $rules;
    }
}
