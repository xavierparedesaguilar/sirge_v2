<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CaractPhysicalChemistry Model
 *
 * @method \App\Model\Entity\CaractPhysicalChemistry get($primaryKey, $options = [])
 * @method \App\Model\Entity\CaractPhysicalChemistry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CaractPhysicalChemistry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CaractPhysicalChemistry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CaractPhysicalChemistry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CaractPhysicalChemistry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CaractPhysicalChemistry findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CaractPhysicalChemistryTable extends Table
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

        $this->setTable('caract_physical_chemistry');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->allowEmpty('expnumb');

        $validator
            ->integer('colname')
            ->allowEmpty('colname');

        $validator
            ->allowEmpty('samplelist');

        $validator
            ->allowEmpty('project');

        $validator
            ->allowEmpty('projcode');

        $validator
            ->allowEmpty('datamatrix');

        $validator
            ->allowEmpty('traitlist');

        $validator
            ->allowEmpty('respname');

        $validator
            ->allowEmpty('remarks');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
