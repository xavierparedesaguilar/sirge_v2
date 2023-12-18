<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ubigeo Model
 *
 * @property \Cake\ORM\Association\HasMany $Insitu
 * @property \Cake\ORM\Association\HasMany $Passport
 * @property \Cake\ORM\Association\HasMany $Station
 *
 * @method \App\Model\Entity\Ubigeo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ubigeo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ubigeo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ubigeo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ubigeo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ubigeo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ubigeo findOrCreate($search, callable $callback = null, $options = [])
 */
class UbigeoTable extends Table
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

        $this->setTable('ubigeo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Insitu', [
            'foreignKey' => 'ubigeo_id'
        ]);
        $this->hasMany('Passport', [
            'foreignKey' => 'ubigeo_id'
        ]);
        $this->hasMany('Station', [
            'foreignKey' => 'ubigeo_id'
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
            ->allowEmpty('cod_dep');

        $validator
            ->allowEmpty('cod_pro');

        $validator
            ->allowEmpty('cod_dis');

        $validator
            ->allowEmpty('nombre');

        return $validator;
    }
}
