<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DetailPrimernum Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CaractGenotypic
 *
 * @method \App\Model\Entity\DetailPrimernum get($primaryKey, $options = [])
 * @method \App\Model\Entity\DetailPrimernum newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DetailPrimernum[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DetailPrimernum|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DetailPrimernum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DetailPrimernum[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DetailPrimernum findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DetailPrimernumTable extends Table
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

        $this->setTable('detail_primernum');
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
            ->requirePresence('primers_name_one', 'create')
            ->notEmpty('primers_name_one');

        $validator
            ->requirePresence('primers_name_two', 'create')
            ->notEmpty('primers_name_two');

        $validator
            ->requirePresence('indicator_name', 'create')
            ->notEmpty('indicator_name');

        $validator
            ->requirePresence('temperat', 'create')
            ->notEmpty('temperat');

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
