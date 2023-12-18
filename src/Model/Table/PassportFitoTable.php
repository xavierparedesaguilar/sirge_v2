<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PassportFito Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Passport
 *
 * @method \App\Model\Entity\PassportFito get($primaryKey, $options = [])
 * @method \App\Model\Entity\PassportFito newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PassportFito[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PassportFito|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PassportFito patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PassportFito[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PassportFito findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PassportFitoTable extends Table
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

        $this->setTable('passport_fito');
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
            ->allowEmpty('spauthor');

        $validator
            ->allowEmpty('subtaxa');

        $validator
            ->allowEmpty('subtauthor');

        $validator
            ->integer('storage')
            ->allowEmpty('storage');

        $validator
            ->date('acqdate')
            ->allowEmpty('acqdate');

        $validator
            ->integer('availability')
            ->allowEmpty('availability');

        $validator
            ->allowEmpty('collsite');

        $validator
            ->decimal('latitude')
            ->allowEmpty('latitude');

        $validator
            ->decimal('longitude')
            ->allowEmpty('longitude');

        $validator
            ->decimal('elevation')
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
            ->integer('samptype')
            ->allowEmpty('samptype');

        $validator
            ->integer('sampsize')
            ->allowEmpty('sampsize');

        $validator
            ->allowEmpty('sampling');

        $validator
            ->integer('plauspart')
            ->allowEmpty('plauspart');

        $validator
            ->integer('uso')
            ->allowEmpty('uso');

        $validator
            ->allowEmpty('poparea');

        $validator
            ->allowEmpty('pathogen');

        $validator
            ->allowEmpty('donorcore');

        $validator
            ->allowEmpty('donorname');

        $validator
            ->allowEmpty('donaddress');

        $validator
            ->allowEmpty('donornumb');

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
            ->allowEmpty('soilrel');

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
            ->allowEmpty('bredcode');

        $validator
            ->allowEmpty('bredname');

        $validator
            ->allowEmpty('duplinstname');

        $validator
            ->allowEmpty('duplsite');

        $validator
            ->integer('invitro')
            ->allowEmpty('invitro');

        $validator
            ->integer('bseed')
            ->allowEmpty('bseed');

        $validator
            ->integer('bfield')
            ->allowEmpty('bfield');

        $validator
            ->allowEmpty('insitu');

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
