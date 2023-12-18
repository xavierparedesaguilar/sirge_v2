<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BankSeed Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 * @property \Cake\ORM\Association\HasMany $InputSeed
 * @property \Cake\ORM\Association\HasMany $OutputSeed
 *
 * @method \App\Model\Entity\BankSeed get($primaryKey, $options = [])
 * @method \App\Model\Entity\BankSeed newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BankSeed[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BankSeed|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BankSeed patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BankSeed[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BankSeed findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BankSeedTable extends Table
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

        $this->setTable('bank_seed');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('InputSeed', [
            'foreignKey' => 'bank_seed_id'
        ]);
        $this->hasMany('OutputSeed', [
            'foreignKey' => 'bank_seed_id'
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
            ->allowEmpty('othenumb');

        $validator
            ->allowEmpty('detecnumb');

        $validator
            ->allowEmpty('lotnumb');

        $validator
            ->date('acqdate')
            ->allowEmpty('acqdate');

        $validator
            ->allowEmpty('origin');

        $validator
            ->naturalNumber('availability','Ingrese solo números enteros.')
            ->maxLength('availability',10,'Ingrese como máximo 9 dígitos.')
            ->allowEmpty('availability');

        $validator
            ->allowEmpty('accimag1');

        $validator
            ->allowEmpty('accimag2');

        $validator
            ->allowEmpty('remarks1');

        $validator
            ->allowEmpty('remarks2');

        $validator
            ->naturalNumber('harvestdate','Ingrese solo números enteros.')
            ->maxLength('harvestdate',10,'Ingrese como máximo 9 dígitos.')
            ->allowEmpty('harvestdate');

        // $validator
        //     ->naturalNumber('bags','Ingrese solo números enteros')
        //     ->maxLength('bags',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('bags');

        // $validator
        //     ->decimal('seeweight',2,'Ingresese un número con 2 decimales.')
        //     ->range('seeweight',[0,100],'El rango del porcentaje debe estar entre 0 a 100.')
        //     ->allowEmpty('seeweight');

        // $validator
        //     ->naturalNumber('seednumb','Ingrese solo números enteros.')
        //     ->maxLength('seednumb',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('seednumb');

        // $validator
        //     ->naturalNumber('seedpro','Ingrese solo números enteros.')
        //     ->maxLength('seedpro',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('seedpro');

        $validator
            ->naturalNumber('seedsto','Ingrese solo números enteros.')
            ->maxLength('seedsto',10,'Ingrese como máximo 9 dígitos.')
            ->allowEmpty('seedsto');

        $validator
            ->allowEmpty('color');

        $validator
            ->numeric('size')
            ->allowEmpty('size');

        $validator
            ->allowEmpty('shape');

        $validator
            ->integer('typeref')
            ->allowEmpty('typeref');

        // $validator
        //     ->naturalNumber('typemat','Ingrese solo números enteros.')
        //     ->maxLength('typemat',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('typemat');

        // $validator
        //     ->range('germination',[0,100],'El rango del porcentaje debe estar entre 0 a 100.')
        //     ->decimal('germination',2,'Ingresese un número con 2 decimales.')
        //     ->allowEmpty('germination');

        // $validator
        //     ->range('seedhum',[0,100],'El rango del porcentaje debe estar entre 0 a 100.')
        //     ->decimal('seedhum',2,'Ingresese un número con 2 decimales.')
        //     ->allowEmpty('seedhum');

        $validator
            ->allowEmpty('viability');

        // $validator
        //     ->decimal('discweight',2,'Ingresese un número con 2 decimales.')
        //     ->allowEmpty('discweight');

        // $validator
        //     ->naturalNumber('discnumb','Ingrese solo números enteros')
        //     ->maxLength('discnumb',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('discnumb');

        // $validator
        //     ->decimal('p1',2,'Ingrese un número con 2 decimales.')
        //     ->greaterThan('p1',0,'Ingrese un número mayor a 0')
        //     ->allowEmpty('p1');

        // $validator
        //     ->naturalNumber('n1','Ingrese solo números enteros')
        //     ->maxLength('n1',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('n1');

        // $validator
        //     ->decimal('p2',2,'Ingresese un número con 2 decimales.')
        //     ->greaterThan('p2',0,'Ingrese un número mayor a 0')
        //     ->allowEmpty('p2');

        // $validator
        //     ->naturalNumber('n2','Ingrese solo números enteros')
        //     ->maxLength('n2',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('n2');

        // $validator
        //     ->decimal('p3',2,'Ingresese un número con 2 decimales.')
        //     ->greaterThan('p3',0,'Ingrese un número mayor a 0')
        //     ->allowEmpty('p3');

        // $validator
        //     ->naturalNumber('n3','Ingrese solo números enteros')
        //     ->maxLength('n3',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('n3');

        // $validator
        //     ->decimal('p4',2,'Ingresese un número con 2 decimales.')
        //     ->greaterThan('p4',0,'Ingrese un número mayor a 0')
        //     ->allowEmpty('p4');

        // $validator
        //     ->naturalNumber('n4','Ingrese solo números enteros')
        //     ->maxLength('n4',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('n4');

        // $validator
        //     ->decimal('p5',2,'Ingresese un número con 2 decimales.')
        //     ->greaterThan('p5',0,'Ingrese un número mayor a 0')
        //     ->allowEmpty('p5');

        // $validator
        //     ->naturalNumber('n5','Ingrese solo números enteros')
        //     ->maxLength('n5',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('n5');

        // $validator
        //     ->decimal('realweight',2,'Ingresese un número con 2 decimales.')
        //     ->allowEmpty('realweight');

        $validator
            ->naturalNumber('storage','Ingrese solo números enteros')
            ->maxLength('storage',10,'Ingrese como máximo 9 dígitos')
            ->allowEmpty('storage');

        // $validator
        //     ->range('temp',[0,100],'El porcentaje ingresado no es valido')
        //     ->decimal('temp',2,'Ingrese un número con 2 decimales.')
        //     ->allowEmpty('temp');

        $validator
            ->integer('humidity')
            ->allowEmpty('humidity');

        $validator
            ->allowEmpty('shelving');

        $validator
            ->allowEmpty('resistance');

        $validator
            ->allowEmpty('tolerancia');

        $validator
            ->allowEmpty('susceptibility');

        // $validator
        //     ->naturalNumber('ciclo','Ingrese solo números enteros')
        //     ->maxLength('ciclo',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('ciclo');

        // $validator
        //     ->naturalNumber('time','Ingrese solo números enteros')
        //     ->maxLength('time',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('time');

        // $validator
        //     ->naturalNumber('performance','Ingrese solo números enteros')
        //     ->maxLength('performance',10,'Ingrese como máximo 9 dígitos')
        //     ->allowEmpty('performance');

        $validator
            ->allowEmpty('responsible');

        $validator
            ->allowEmpty('remarks');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('cod_per')
            ->add('cod_per', 'comparison', [
                    'rule' => function ($value, $context) {

                     return strlen($context['data']['passport_id']) >0 ;
                     },
                    'message' => 'Ingresar un Código Pasaporte válido.'
                    ])
            ->notEmpty('cod_per', 'El Código Pasaporte no puede estar vacío.');

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
