<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TempPassportMicro Model
 *
 * @property \Cake\ORM\Association\BelongsTo $StationCurrents
 * @property \Cake\ORM\Association\BelongsTo $StationOrigins
 * @property \Cake\ORM\Association\BelongsTo $Resources
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\TempPassportMicro get($primaryKey, $options = [])
 * @method \App\Model\Entity\TempPassportMicro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TempPassportMicro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TempPassportMicro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TempPassportMicro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TempPassportMicro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TempPassportMicro findOrCreate($search, callable $callback = null, $options = [])
 */
class TempPassportMicroTable extends Table
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

        $this->setTable('temp_passport_micro');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // $this->belongsTo('StationCurrents', [
        //     'foreignKey' => 'station_current_id'
        // ]);
        // $this->belongsTo('StationOrigins', [
        //     'foreignKey' => 'station_origin_id'
        // ]);
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
            ->allowEmpty('motivo_error');

        $validator
            ->requirePresence('coleccion', 'create')
            ->notEmpty('coleccion');

        $validator
            ->requirePresence('nombre_especie', 'create')
            ->notEmpty('nombre_especie');

        $validator
            ->requirePresence('nombre_comun', 'create')
            ->notEmpty('nombre_comun');

        $validator
            ->requirePresence('genero_especie', 'create')
            ->notEmpty('genero_especie');

        $validator
            ->allowEmpty('instcode');

        $validator
            ->allowEmpty('accname');

        $validator
            ->allowEmpty('othenumb');

        $validator
            ->allowEmpty('pais');

        $validator
            ->allowEmpty('departamento');

        $validator
            ->allowEmpty('provincia');

        $validator
            ->allowEmpty('distrito');

        $validator
            ->allowEmpty('localidad');

        $validator
            ->allowEmpty('promissory');

        $validator
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
            ->allowEmpty('strain');

        $validator
            ->allowEmpty('storage');

        $validator
            ->allowEmpty('acqdate');

        $validator
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
            ->allowEmpty('coorddatum');

        $validator
            ->allowEmpty('georefmeth');

        $validator
            ->allowEmpty('coorduncert');

        $validator
            ->allowEmpty('collcode');

        $validator
            ->allowEmpty('collname');

        $validator
            ->allowEmpty('collinstaddress');

        $validator
            ->allowEmpty('collmissind');

        $validator
            ->allowEmpty('collsrc');

        $validator
            ->allowEmpty('collsrcdet');

        $validator
            ->allowEmpty('isosrc');

        $validator
            ->allowEmpty('sampstat');

        $validator
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
            ->allowEmpty('soiltext');

        $validator
            ->allowEmpty('soilped');

        $validator
            ->allowEmpty('soilcol');

        $validator
            ->allowEmpty('soilph');

        $validator
            ->allowEmpty('soilfis');

        $validator
            ->allowEmpty('soilrel');

        $validator
            ->allowEmpty('soiltemp');

        $validator
            ->allowEmpty('soilodor');

        $validator
            ->allowEmpty('watersrc');

        $validator
            ->allowEmpty('watercol');

        $validator
            ->allowEmpty('watertemp');

        $validator
            ->allowEmpty('waterodor');

        $validator
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
            ->allowEmpty('biolrisk');

        $validator
            ->allowEmpty('samphist');

        $validator
            ->allowEmpty('asilmed');

        $validator
            ->allowEmpty('micro');

        $validator
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
    // public function buildRules(RulesChecker $rules)
    // {
    //     $rules->add($rules->existsIn(['station_current_id'], 'StationCurrents'));
    //     $rules->add($rules->existsIn(['station_origin_id'], 'StationOrigins'));
    //     $rules->add($rules->existsIn(['resource_id'], 'Resources'));
    //     $rules->add($rules->existsIn(['user_id'], 'Users'));

    //     return $rules;
    // }
}
