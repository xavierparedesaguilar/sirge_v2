<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Passport Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Specie
 * @property \Cake\ORM\Association\BelongsTo $Resource
 * @property \Cake\ORM\Association\BelongsTo $Station
 * @property \Cake\ORM\Association\BelongsTo $Station
 * @property \Cake\ORM\Association\BelongsTo $Country
 * @property \Cake\ORM\Association\BelongsTo $Ubigeo
 * @property \Cake\ORM\Association\HasMany $BankDna
 * @property \Cake\ORM\Association\HasMany $BankField
 * @property \Cake\ORM\Association\HasMany $BankInvitro
 * @property \Cake\ORM\Association\HasMany $BankMicro
 * @property \Cake\ORM\Association\HasMany $BankSeed
 * @property \Cake\ORM\Association\HasMany $CharacterizationDetail
 * @property \Cake\ORM\Association\HasMany $InsituAccesion
 * @property \Cake\ORM\Association\HasMany $OrdersDetail
 * @property \Cake\ORM\Association\HasMany $PassportFito
 * @property \Cake\ORM\Association\HasMany $PassportMicro
 * @property \Cake\ORM\Association\HasMany $PassportZoo
 * @property \Cake\ORM\Association\HasMany $ShoppingCartProduct
 *
 * @method \App\Model\Entity\Passport get($primaryKey, $options = [])
 * @method \App\Model\Entity\Passport newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Passport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Passport|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Passport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Passport[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Passport findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PassportTable extends Table
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

        $this->setTable('passport');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Specie', [
            'foreignKey' => 'specie_id'
        ]);
        $this->belongsTo('Resource', [
            'foreignKey' => 'resource_id'
        ]);
        $this->belongsTo('Station', [
            'foreignKey' => 'station_current_id'
        ]);
        $this->belongsTo('Station', [
            'foreignKey' => 'station_origin_id'
        ]);
        $this->belongsTo('Country', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('Ubigeo', [
            'foreignKey' => 'ubigeo_id'
        ]);
        $this->hasMany('BankDna', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('BankField', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('BankInvitro', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('BankMicro', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('BankSeed', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('CharacterizationDetail', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('InsituAccesion', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('OrdersDetail', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('PassportFito', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('PassportMicro', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('PassportZoo', [
            'foreignKey' => 'passport_id'
        ]);
        $this->hasMany('ShoppingCartProduct', [
            'foreignKey' => 'passport_id'
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
            ->allowEmpty('instcode');

        $validator
            ->allowEmpty('accenumb');

        $validator
            ->allowEmpty('accname');

        $validator
            ->allowEmpty('othenumb');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('localidad');

        $validator
            ->allowEmpty('collection_name');

        $validator
            ->integer('promissory')
            ->allowEmpty('promissory');

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
        $rules->add($rules->existsIn(['specie_id'], 'Specie'));
        $rules->add($rules->existsIn(['resource_id'], 'Resource'));
        $rules->add($rules->existsIn(['station_current_id'], 'Station'));
        $rules->add($rules->existsIn(['station_origin_id'], 'Station'));
        $rules->add($rules->existsIn(['country_id'], 'Country'));
        $rules->add($rules->existsIn(['ubigeo_id'], 'Ubigeo'));

        return $rules;
    }
}
