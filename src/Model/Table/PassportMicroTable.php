<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PassportMicro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 *
 * @method \App\Model\Entity\PassportMicro get($primaryKey, $options = [])
 * @method \App\Model\Entity\PassportMicro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PassportMicro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PassportMicro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PassportMicro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PassportMicro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PassportMicro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PassportMicroTable extends Table
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

        $this->setTable('passport_micro');
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
            ->allowEmpty('commonname');

        $validator
            ->allowEmpty('spauthor');

        $validator
            ->allowEmpty('subtaxa');

        $validator
            ->allowEmpty('subtauthor');

        $validator
            ->allowEmpty('strain');

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
            ->allowEmpty('coorduncert');

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
            ->allowEmpty('collinstaddress');

        $validator
            ->allowEmpty('collmissind');

        $validator
            ->integer('collsrc')
            ->allowEmpty('collsrc');

        $validator
            ->integer('collsrcdet')
            ->allowEmpty('collsrcdet');

        $validator
            ->integer('isosrc')
            ->allowEmpty('isosrc');

        $validator
            ->integer('sampstat')
            ->allowEmpty('sampstat');

        $validator
            ->date('colldate')
            ->allowEmpty('colldate');

        $validator
            ->allowEmpty('localname');

        $validator
            ->allowEmpty('groupethnic');

        $validator
            ->allowEmpty('samptype');

        $validator
            ->allowEmpty('sampsize');

        $validator
            ->allowEmpty('sampling');

        $validator
            ->allowEmpty('uso');

        $validator
            ->allowEmpty('humidity');

        $validator
            ->allowEmpty('temp');

        $validator
            ->allowEmpty('presure');

        $validator
            ->allowEmpty('precipitation');

        $validator
            ->integer('soiltext')
            ->allowEmpty('soiltext');

        $validator
            ->integer('soilped')
            ->allowEmpty('soilped');

        $validator
            ->integer('soilcol')
            ->allowEmpty('soilcol');

        $validator
            ->integer('soilph')
            ->allowEmpty('soilph');

        $validator
            ->integer('soilfis')
            ->allowEmpty('soilfis');

        $validator
            ->allowEmpty('soilrel');

        $validator
            ->allowEmpty('soiltemp');

        $validator
            ->allowEmpty('soilodor');

        $validator
            ->integer('watersrc')
            ->allowEmpty('watersrc');

        $validator
            ->integer('watercol')
            ->allowEmpty('watercol');

        $validator
            ->allowEmpty('watertemp');

        $validator
            ->integer('waterodor')
            ->allowEmpty('waterodor');

        $validator
            ->integer('waterph')
            ->allowEmpty('waterph');

        $validator
            ->allowEmpty('waterturb');

        $validator
            ->allowEmpty('donorcore');

        $validator
            ->allowEmpty('donorname');

        $validator
            ->allowEmpty('donaddress');

        $validator
            ->allowEmpty('donornumb');

        $validator
            ->allowEmpty('asocgenus');

        $validator
            ->allowEmpty('asocspecies');

        $validator
            ->allowEmpty('asoclocalname');

        $validator
            ->allowEmpty('mancest');

        $validator
            ->allowEmpty('pancest');

        $validator
            ->allowEmpty('ancest');

        $validator
            ->integer('mlsstat')
            ->allowEmpty('mlsstat');

        $validator
            ->allowEmpty('patent');

        $validator
            ->allowEmpty('straincode');

        $validator
            ->allowEmpty('strainname');

        $validator
            ->allowEmpty('duplinstname');

        $validator
            ->allowEmpty('duplsite');

        $validator
            ->allowEmpty('antag');

        $validator
            ->integer('biolrisk')
            ->allowEmpty('biolrisk');

        $validator
            ->allowEmpty('samphist');

        $validator
            ->allowEmpty('asilmed');

        $validator
            ->integer('micro')
            ->allowEmpty('micro');

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
