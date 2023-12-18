<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CaractGenotypic Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Resource
 *
 * @method \App\Model\Entity\CaractGenotypic get($primaryKey, $options = [])
 * @method \App\Model\Entity\CaractGenotypic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CaractGenotypic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CaractGenotypic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CaractGenotypic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CaractGenotypic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CaractGenotypic findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CaractGenotypicTable extends Table
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

        $this->setTable('caract_genotypic');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Resource', [
            'foreignKey' => 'resource_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('DetailPrimernum', [
            'foreignKey' => 'genotypic_id'
        ]);

        $this->hasMany('DetailAdaptrnum', [
            'foreignKey' => 'genotypic_id'
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
            ->allowEmpty('expnumb');

        $validator
            // ->integer('colname')
            // ->allowEmpty('colname');
            ->requirePresence('colname', 'create')
            ->notEmpty('colname');

        $validator
            ->allowEmpty('accenumb');

        $validator
            ->integer('molmarker')
            ->allowEmpty('molmarker');

        $validator
            ->integer('restenzymuse')
            ->allowEmpty('restenzymuse');

        $validator
            ->allowEmpty('restenzymname');

        $validator
            ->integer('adaptrnum')
            ->allowEmpty('adaptrnum');

        $validator
            ->allowEmpty('project');

        $validator
            ->allowEmpty('projcode');

        $validator
            ->integer('primernum')
            ->requirePresence('primernum', 'create')
            ->notEmpty('primernum');

        $validator
            ->allowEmpty('ciclonumb');

        $validator
            ->allowEmpty('seqtech');

        $validator
            ->allowEmpty('accnumb');

        $validator
            ->allowEmpty('othername');

        $validator
            ->allowEmpty('seqsize');

        $validator
            ->allowEmpty('datamatrix');

        $validator
            ->allowEmpty('fragsizemeth');

        $validator
            ->allowEmpty('repnumb');

        $validator
            ->integer('location')
            ->allowEmpty('location');

        $validator
            ->allowEmpty('respname');

        $validator
            ->allowEmpty('markerdescrip');

        $validator
            ->allowEmpty('platform');

        $validator
            ->allowEmpty('remarks');

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
        $rules->add($rules->existsIn(['resource_id'], 'Resource'));

        return $rules;
    }
}
