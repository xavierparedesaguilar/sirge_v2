<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Station Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ubigeo
 * @property \Cake\ORM\Association\BelongsTo $Country
 * @property \Cake\ORM\Association\HasMany $Insitu
 *
 * @method \App\Model\Entity\Station get($primaryKey, $options = [])
 * @method \App\Model\Entity\Station newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Station[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Station|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Station patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Station[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Station findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StationTable extends Table
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

        $this->setTable('station');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ubigeo', [
            'foreignKey' => 'ubigeo_id'
        ]);
        $this->belongsTo('Country', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Insitu', [
            'foreignKey' => 'station_id'
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
            ->allowEmpty('eea');

        $validator
            ->allowEmpty('collsite');

        $validator
            ->allowEmpty('responsible');

        $validator
            ->allowEmpty('email');

        $validator
            #->integer('telephone','Teléfono solo admite números.')
            ->add('telephone', 'validFormat',[
                'rule' => array('custom', '/^[\- 0-9]{7,10}$/i'),
                'message' => 'Teléfono solo admite números, debe tener 7 u 9 dígitos.'
            ])
            ->allowEmpty('telephone');

        $validator
            #->integer('celphone', 'Celular solo admite números.')
            ->add('celphone', 'validFormat',[
                'rule' => array('custom', '/^[\- 0-9]{9,9}$/i'),
                'message' => 'Celular solo admite números, debe tener 9 dígitos.'
            ])
            ->allowEmpty('celphone');

        $validator
            ->integer('availability')
            ->allowEmpty('availability');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        // $validator
        //     ->integer('country_id')
        //     ->requirePresence('country_id')
        //     ->notEmpty('country_id', 'País no puede estar vacío.');

        $validator
            ->allowEmpty('localidad');

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
        $rules->add($rules->existsIn(['ubigeo_id'], 'Ubigeo'));
        $rules->add($rules->existsIn(['country_id'], 'Country'));

        return $rules;
    }
}
