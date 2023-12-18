<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TempCaracterizacion Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Resources
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\TempCaracterizacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\TempCaracterizacion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TempCaracterizacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TempCaracterizacion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TempCaracterizacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TempCaracterizacion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TempCaracterizacion findOrCreate($search, callable $callback = null, $options = [])
 */
class TempCaracterizacionTable extends Table
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

        $this->setTable('temp_caracterizacion');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->belongsTo('Resources', [
        //     'foreignKey' => 'resource_id',
        //     'joinType' => 'INNER'
        // ]);
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
            ->integer('val_error')
            ->allowEmpty('val_error');

        $validator
            ->integer('val_error_annio')
            ->requirePresence('val_error_annio', 'create')
            ->notEmpty('val_error_annio');

        $validator
            ->allowEmpty('passport_accenumb');

        $validator
            ->allowEmpty('passport_othenumb');

        $validator
            ->allowEmpty('annio_periodo');

        $validator
            ->allowEmpty('descriptor_name');

        $validator
            ->allowEmpty('valor');

        $validator
            ->allowEmpty('observation');

        $validator
            ->integer('specie_name')
            ->requirePresence('specie_name', 'create')
            ->notEmpty('specie_name');

        $validator
            ->integer('collection_name')
            ->requirePresence('collection_name', 'create')
            ->notEmpty('collection_name');

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
    //     $rules->add($rules->existsIn(['resource_id'], 'Resources'));
    //     $rules->add($rules->existsIn(['user_id'], 'Users'));

    //     return $rules;
    // }
}
