<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\ORM\TableRegistry;

use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * Insitu Entity
 *
 * @property int $id
 * @property string $code_insitu
 * @property int $degree_instruction
 * @property int $type_soil
 * @property string $reference
 * @property string $latitude
 * @property string $length
 * @property string $altitude
 * @property string $name_farmer
 * @property string $address_farmer
 * @property int $age_farmer
 * @property int $peasant_organization
 * @property string $name_peasant_organization
 * @property string $biophysical_description
 * @property string $description_chakra
 * @property int $area
 * @property string $living_area
 * @property string $meteorological_record
 * @property string $observation
 * @property string $description_workers
 * @property int $monitoring
 * @property string $ministerial_resolution
 * @property int $variety_number
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $user_id
 * @property int $ubigeo_id
 * @property string $other_people
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Ubigeo $ubigeo
 * @property \App\Model\Entity\Station $station
 * @property \App\Model\Entity\InsituAccesion[] $insitu_accesion
 * @property \App\Model\Entity\InsituFarmerActivity[] $insitu_farmer_activity
 * @property \App\Model\Entity\InsituPlage[] $insitu_plage
 * @property \App\Model\Entity\InsituThreat[] $insitu_threat
 */
class Insitu extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**  Obtiene el codigo autogenerado para insitu **/
    protected function _getCodigo()
    {
        $total = TableRegistry::get('Insitu')->find()->count();

        if($total > 0){

            $result = $total + 1;

        } else {

            $result = 1;
        }

        return $result;
    }

    /**  OBTIENE GRADO DE INSTRUCCION **/
    protected function _getGradoInstruccion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['degree_instruction']])->first();

        return $result;
    }

    /**  OBTIENE TIPO SUELO **/
    protected function _getTipoSuelo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['type_soil']])->first();

        return $result;
    }

    /********************** VALIDACION QUE NO TENGA REGISTROS ASOCIADOS  ***********************/
    protected function _getValidacionInsitu()
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->prepare('
            SELECT SUM(s.total) AS total FROM (
                SELECT COUNT(*) AS total FROM insitu_accesion AS a WHERE a.insitu_id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM insitu_farmer_activity AS a WHERE a.insitu_id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM insitu_plage AS a WHERE a.insitu_id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM insitu_threat AS a WHERE a.insitu_id = :id AND a.status = 1
            ) s;');

        $stmt->bindValue( ':id', $this->_properties['id'], PDO::PARAM_INT);
        $stmt->execute();
        $valor = $stmt->fetch('assoc');

        return $valor['total'];
    }

}
