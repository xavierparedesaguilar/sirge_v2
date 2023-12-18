<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TempDescriptores Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\TempDescriptore get($primaryKey, $options = [])
 * @method \App\Model\Entity\TempDescriptore newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TempDescriptore[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TempDescriptore|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TempDescriptore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TempDescriptore[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TempDescriptore findOrCreate($search, callable $callback = null, $options = [])
 */
class TempDescriptoresTable extends Table
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

        $this->setTable('temp_descriptores');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->belongsTo('Users', [
        //     'foreignKey' => 'user_id',
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
            ->allowEmpty('motivo_error');

        $validator
            ->requirePresence('especie', 'create')
            ->notEmpty('especie');

        $validator
            ->requirePresence('coleccion', 'create')
            ->notEmpty('coleccion');

        $validator
            ->allowEmpty('campo_1');

        $validator
            ->allowEmpty('campo_2');

        $validator
            ->allowEmpty('campo_3');

        $validator
            ->allowEmpty('campo_4');

        $validator
            ->integer('recurso')
            ->requirePresence('recurso', 'create')
            ->notEmpty('recurso');

        $validator
            ->integer('tipo_carga')
            ->requirePresence('tipo_carga', 'create')
            ->notEmpty('tipo_carga');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    // public function buildRules(RulesChecker $rules)
    // {
    //     $rules->add($rules->existsIn(['user_id'], 'Users'));

    //     return $rules;
    // }
}
