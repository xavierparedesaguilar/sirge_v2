<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankInvitro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 * @property \Cake\ORM\Association\HasMany $ConservationInvitro
 * @property \Cake\ORM\Association\HasMany $InputInvitro
 * @property \Cake\ORM\Association\HasMany $OutputInvitro
 * @property \Cake\ORM\Association\HasMany $PropagationInvitro
 *
 * @method \App\Model\Entity\BankInvitro get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankInvitro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BankInvitro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankInvitro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankInvitro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankInvitro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankInvitro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BankInvitroTable extends Table
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

        $this->setTable('bank_invitro');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ConservationInvitro', [
            'foreignKey' => 'bank_invitro_id'
        ]);
        $this->hasMany('InputInvitro', [
            'foreignKey' => 'bank_invitro_id'
        ]);
        $this->hasMany('OutputInvitro', [
            'foreignKey' => 'bank_invitro_id'
        ]);
        $this->hasMany('PropagationInvitro', [
            'foreignKey' => 'bank_invitro_id'
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
            ->integer('bank_availability')
            ->allowEmpty('bank_availability');

        $validator
            ->allowEmpty('lotnumb');

        $validator
            ->date('acqdate')
            ->allowEmpty('acqdate');

        $validator
            ->integer('availability')
            ->allowEmpty('availability');

        $validator
            ->integer('storoom')
            ->allowEmpty('storoom');

        $validator
            ->allowEmpty('temp');

        $validator
            ->allowEmpty('shelving');

        // $validator
        //     ->naturalNumber('levelshelv','Ingrese solo números enteros')
        //     ->maxLength('levelshelv',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('levelshelv');

        // $validator
        //     ->naturalNumber('rack','Ingrese solo números enteros')
        //     ->maxLength('rack',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('rack');

        $validator
            ->allowEmpty('duplinstname');

        // $validator
        //     ->naturalNumber('dupnumb','Ingrese solo números enteros')
        //     ->maxLength('dupnumb',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('dupnumb');

        $validator
            ->integer('plastate')
            ->allowEmpty('plastate');

        $validator
            ->integer('necrosis')
            ->allowEmpty('necrosis');

        $validator
            ->integer('defoliation')
            ->allowEmpty('defoliation');

        $validator
            ->integer('rooting')
            ->allowEmpty('rooting');

        $validator
            ->integer('chlorosis')
            ->allowEmpty('chlorosis');

        $validator
            ->integer('necrosis')
            ->allowEmpty('necrosis');

        $validator
            ->numeric('defoliation')
            ->allowEmpty('defoliation');

        $validator
            ->integer('phenolization')
            ->allowEmpty('phenolization');

        $validator
            ->integer('storage')
            ->allowEmpty('storage');

        $validator
            ->integer('propagation')
            ->allowEmpty('propagation');

        // $validator
        //     ->naturalNumber('protime','Ingrese solo números enteros positivos')
        //     ->maxLength('protime',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('protime');

        $validator
            ->integer('conservation')
            ->allowEmpty('conservation');

        // $validator
        //     ->naturalNumber('constime','Ingrese solo números enteros positivos')
        //     ->maxLength('constime',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('constime');

        // $validator
        //     ->naturalNumber('tubenumb','Ingrese solo números enteros positivos')
        //     ->maxLength('tubenumb',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('tubenumb');

        // $validator
        //     ->naturalNumber('explnumb','Ingrese solo números enteros positivos')
        //     ->maxLength('explnumb',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('explnumb');

        $validator
            //->naturalNumber('stock','Ingrese solo números enteros positivos')
            ->allowEmpty('stock');

        $validator
            ->integer('tubesize')
            ->allowEmpty('tubesize');

        $validator
            ->integer('fitostate')
            ->allowEmpty('fitostate');

        $validator
            ->allowEmpty('pathogen');

        $validator
            ->allowEmpty('remarks');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');
        $validator
            ->requirePresence('pasaporte')
            ->add('pasaporte', 'comparison', [
                    'rule' => function ($value, $context) {

                     return strlen($context['data']['passport_id']) >0 ;
                     },
                    'message' => 'Ingresar un Código Pasaporte válido.'
                    ])
            ->notEmpty('pasaporte','El Código Pasaporte no puede estar vacío.');

        // $validator
        //     ->requirePresence('codigoAccesion',true,'Ingresar Código de Accesión.')
        //     ->notEmpty('codigoAccesion', 'Ingresar Código de Accesión.');

        // $validator

        //     ->requirePresence('collection',true,'Ingresar Colección.')
        //     ->notEmpty('collection', 'Ingresar Colección.');

        // $validator

        //     ->requirePresence('especie',true,'Ingresar la Especie.')
        //     ->notEmpty('especie', 'Ingresar la Especie.');

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
        $rules->add($rules->existsIn(['passport_id'], 'Passport'));

        return $rules;
    }
}
