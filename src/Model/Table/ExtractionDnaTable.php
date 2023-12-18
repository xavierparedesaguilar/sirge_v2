<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExtractionDna Model
 *
 * @property \Cake\ORM\Association\BelongsTo $BankDna
 *
 * @method \App\Model\Entity\ExtractionDna get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExtractionDna newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExtractionDna[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExtractionDna|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExtractionDna patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExtractionDna[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExtractionDna findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ExtractionDnaTable extends Table
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

        $this->setTable('extraction_dna');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('BankDna', [
            'foreignKey' => 'bank_dna_id',
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
            ->integer('extmethod')
            ->allowEmpty('extmethod');

        $validator
            ->date('extdate')
            ->allowEmpty('extdate');

        $validator
            ->allowEmpty('extres');

        $validator
            ->integer('buffer')
            ->allowEmpty('buffer');

        $validator
            ->allowEmpty('volumen');

        $validator
            ->integer('dnaqty')
            ->allowEmpty('dnaqty');

        $validator
            ->allowEmpty('conadnpur');

        $validator
            ->allowEmpty('leca260_280');

        $validator
            ->allowEmpty('leca260_230');

        $validator
            ->allowEmpty('conadnint');

        $validator
            ->allowEmpty('din');

        $validator
            ->integer('agaelec')
            ->allowEmpty('agaelec');

        $validator
            ->allowEmpty('shortermtemp');

        $validator
            ->allowEmpty('shortermtime');

        $validator
            ->date('shorconstime')
            ->allowEmpty('shorconstime');

        $validator
            ->allowEmpty('shortmatnumb');

        // $validator
        //     ->naturalNumber('shortminstock','Ingrese solo números enteros.')
        //     ->maxLength('shortminstock',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('shortminstock');

        $validator
            ->allowEmpty('shortstornumb');

        $validator
            ->integer('shortstorage')
            ->allowEmpty('shortstorage');

        $validator
            ->allowEmpty('shortlevsh');

        $validator
            ->allowEmpty('shortrack');

        $validator
            ->allowEmpty('shortrackpos');

        // $validator
        //     ->naturalNumber('shortcrionumb','Ingrese solo números enteros.')
        //     ->maxLength('shortcrionumb',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('shortcrionumb');

        $validator
            ->allowEmpty('shortcriopos');

        $validator
            ->allowEmpty('longtermtemp');

        $validator
            ->allowEmpty('longtermtime');

        $validator
            ->date('longconstime')
            ->allowEmpty('longconstime');

        $validator
            ->integer('longtermtype')
            ->allowEmpty('longtermtype');

        // $validator
        //     ->naturalNumber('criovinumb','Ingrese solo números enteros.')
        //     ->maxLength('criovinumb',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('criovinumb');

        // $validator
        //     ->naturalNumber('crioviminstock','Ingrese solo números enteros.')
        //     ->maxLength('crioviminstock',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('crioviminstock');

        $validator
            ->allowEmpty('longstornumb');

        $validator
            ->integer('longstorage')
            ->allowEmpty('longstorage');

        $validator
            ->allowEmpty('longlevsh');

        $validator
            ->allowEmpty('longrack');

        $validator
            ->allowEmpty('longrackpos');

        // $validator
        //     ->naturalNumber('longcrionumb','Ingrese solo números enteros.')
        //     ->maxLength('longcrionumb',10,'Ingrese como máximo 9 dígitos.')
        //     ->allowEmpty('longcrionumb');

        $validator
            ->allowEmpty('longcriopos');

        // $validator
        //     ->integer('status')
        //     ->requirePresence('status', 'create')
        //     ->notEmpty('status');

        $validator
            ->allowEmpty('remarks');

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
        $rules->add($rules->existsIn(['bank_dna_id'], 'BankDna'));

        return $rules;
    }
}
