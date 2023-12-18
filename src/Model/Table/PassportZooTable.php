<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PassportZoo Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 *
 * @method \App\Model\Entity\PassportZoo get($primaryKey, $options = [])
 * @method \App\Model\Entity\PassportZoo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PassportZoo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PassportZoo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PassportZoo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PassportZoo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PassportZoo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PassportZooTable extends Table
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

        $this->setTable('passport_zoo');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Passport', [
            'foreignKey' => 'passport_id',
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
            ->integer('subtype')
            ->allowEmpty('subtype');

        $validator
            ->allowEmpty('collnumb');

        $validator
            ->integer('colname')
            ->allowEmpty('colname');

        $validator
            ->allowEmpty('genus');

        $validator
            ->allowEmpty('species');

        $validator
            ->allowEmpty('husbname');

        $validator
            ->allowEmpty('spauthor');

        $validator
            ->allowEmpty('subtaxa');

        $validator
            ->allowEmpty('subtauthor');

        $validator
            ->allowEmpty('racetype');

        $validator
            ->integer('storage')
            ->allowEmpty('storage');

        $validator
            ->date('acqdate')
            ->allowEmpty('acqdate');

        $validator
            ->integer('eea')
            ->allowEmpty('eea');

        $validator
            ->integer('eeaproc')
            ->allowEmpty('eeaproc');

        $validator
            ->integer('availability')
            ->allowEmpty('availability');

        $validator
            ->allowEmpty('collsite');

        $validator
            ->allowEmpty('latitude');

        $validator
            ->allowEmpty('longitude');

        $validator
            ->allowEmpty('elevation');

        $validator
            ->integer('coorddatum')
            ->allowEmpty('coorddatum');

        $validator
            ->integer('georefmeth')
            ->allowEmpty('georefmeth');

        $validator
            ->allowEmpty('accimag1');

        $validator
            ->allowEmpty('accimag2');

        $validator
            ->allowEmpty('accimag3');

        $validator
            ->allowEmpty('accimag4');

        $validator
            ->allowEmpty('remarks1');

        $validator
            ->allowEmpty('remarks2');

        $validator
            ->allowEmpty('remarks3');

        $validator
            ->allowEmpty('remarks4');

        $validator
            ->allowEmpty('collcode');

        $validator
            ->allowEmpty('collname');

        $validator
            ->allowEmpty('colladdress');

        $validator
            ->allowEmpty('collmissind');

        $validator
            ->allowEmpty('localname');

        $validator
            ->date('colldate')
            ->allowEmpty('colldate');

        $validator
            ->integer('sampstat')
            ->allowEmpty('sampstat');

        $validator
            ->integer('collsrc')
            ->allowEmpty('collsrc');

        $validator
            ->integer('collsrcdet')
            ->allowEmpty('collsrcdet');

        $validator
            ->allowEmpty('groupethnic');

        $validator
            ->date('datebirth')
            ->allowEmpty('datebirth');

        $validator
            ->date('dateofdec')
            ->allowEmpty('dateofdec');

        $validator
            ->allowEmpty('samptype');

        $validator
            ->allowEmpty('sampling');

        $validator
            ->allowEmpty('anuspart');

        $validator
            ->allowEmpty('uso');

        $validator
            ->allowEmpty('pathogen');

        $validator
            ->allowEmpty('poparea');

        $validator
            ->allowEmpty('humidity');

        $validator
            ->allowEmpty('temp');

        $validator
            ->allowEmpty('presure');

        $validator
            ->allowEmpty('precipitation');

        $validator
            ->allowEmpty('mancest');

        $validator
            ->allowEmpty('pancest');

        $validator
            ->allowEmpty('ancest');

        $validator
            ->allowEmpty('owname');

        $validator
            ->allowEmpty('owaddress');

        $validator
            ->allowEmpty('donorcore');

        $validator
            ->allowEmpty('donorname');

        $validator
            ->allowEmpty('donaddress');

        $validator
            ->integer('mlsstat')
            ->allowEmpty('mlsstat');

        $validator
            ->allowEmpty('patent');

        $validator
            ->allowEmpty('bredcode');

        $validator
            ->allowEmpty('bredname');

        $validator
            ->allowEmpty('duplinstname');

        $validator
            ->allowEmpty('duplsite');

        $validator
            ->integer('bdna')
            ->allowEmpty('bdna');

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
        $rules->add($rules->existsIn(['passport_id'], 'Passport'));

        return $rules;
    }
}
