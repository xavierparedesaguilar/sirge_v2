<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * BankField Entity
 *
 * @property int $id
 * @property string $expcode
 * @property int $bank_availability
 * @property int $sowsamptype
 * @property int $objective
 * @property \Cake\I18n\FrozenDate $startdate
 * @property \Cake\I18n\FrozenDate $enddate
 * @property string $researcher
 * @property string $proyect
 * @property string $design
 * @property float $fieldsize
 * @property int $plotsize
 * @property string $treatment
 * @property int $reps
 * @property string $fieldmap
 * @property string $image1
 * @property string $remarks1
 * @property int $dpto
 * @property int $prov
 * @property int $dist
 * @property string $locality
 * @property int $eea
 * @property string $field
 * @property float $latitude
 * @property float $longitude
 * @property float $elevation
 * @property int $plotnumb
 * @property string $accenumb
 * @property string $othenumb
 * @property string $othername
 * @property int $colname
 * @property string $genus
 * @property int $species
 * @property string $remarks
 * @property int $passport_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 * @property string $detecnumb
 *
 * @property \App\Model\Entity\Passport $passport
 * @property \App\Model\Entity\EvaluationField[] $evaluation_field
 * @property \App\Model\Entity\InputField[] $input_field
 * @property \App\Model\Entity\OutputField[] $output_field
 */
class BankField extends Entity
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

    protected function _getMaterial()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['sowsamptype']])->first();

        return $result;
    }

    protected function _getProyecto()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['objective']])->first();

        return $result;
    }

    /*OBTIENE EL DEPARTAMENTO*/

    protected function _getDepartamentoubi()
    {
        $result = TableRegistry::get('Ubigeo')->find()->where(['cod_dep' => $this->_properties['dpto']])->first();
        return $result;
    }

    protected function _getProvincias()
    {

        if ($this->_properties['prov'] > 0) {
            $result = TableRegistry::get('Ubigeo')->find()->where(['cod_pro' => $this->_properties['prov'],'cod_dep' => $this->_properties['dpto'],'cod_dis' =>0])->first();
        return $result;
        }

    }

    protected function _getDistritos()
    {
        if ($this->_properties['dist'] > 0) {
            $result = TableRegistry::get('Ubigeo')->find()->where(['id' => $this->_properties['dist'],'cod_dep' => $this->_properties['dpto'],'cod_pro' => $this->_properties['prov']])->first();
        return $result;
        }

    }

    protected function _getEstacionexp()
    {
        $result = TableRegistry::get('Station')->find()->where(['id' => $this->_properties['eea']])->first();

        return $result;

    }

    protected function _getColeccion()
    {
        $result = TableRegistry::get('Collection')->find()->where(['id' => $this->_properties['colname']])->first();

        return $result;
    }

    protected function _getEspecies()
    {
        $result = TableRegistry::get('Specie')->find()->where(['id' => $this->_properties['species']])->first();

        return $result;
    }

    protected function _getPassportcampo()
    {
        $result = TableRegistry::get('Passport')->find()->where(['id' => $this->_properties['passport_id']])->first();

        return $result;
    }


}
