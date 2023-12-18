<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * BankSeed Entity
 *
 * @property int $id
 * @property int $bank_availability
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $othenumb
 * @property string $detecnumb
 * @property string $lotnumb
 * @property \Cake\I18n\FrozenDate $acqdate
 * @property string $origin
 * @property int $availability
 * @property string $accimag1
 * @property string $accimag2
 * @property string $remarks1
 * @property string $remarks2
 * @property int $harvestdate
 * @property int $bags
 * @property float $seeweight
 * @property int $seednumb
 * @property int $seedpro
 * @property int $seedsto
 * @property string $color
 * @property float $size
 * @property string $shape
 * @property int $typeref
 * @property int $typemat
 * @property int $germination
 * @property float $seedhum
 * @property string $viability
 * @property float $discweight
 * @property int $discnumb
 * @property float $p1
 * @property int $n1
 * @property float $p2
 * @property int $n2
 * @property float $p3
 * @property int $n3
 * @property float $p4
 * @property int $n4
 * @property float $p5
 * @property int $n5
 * @property float $realweight
 * @property int $storage
 * @property int $temp
 * @property int $humidity
 * @property string $shelving
 * @property string $resistance
 * @property string $tolerancia
 * @property string $susceptibility
 * @property int $ciclo
 * @property int $time
 * @property int $performance
 * @property string $responsible
 * @property string $remarks
 * @property int $passport_id
 * @property int $status
 *
 * @property \App\Model\Entity\Passport $passport
 * @property \App\Model\Entity\InputSeed[] $input_seed
 * @property \App\Model\Entity\OutputSeed[] $output_seed
 */
class BankSeed extends Entity
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

    protected function _getDisponibilidad()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['availability']])->first();

        return $result;
    }
    protected function _getPropagacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['seedpro']])->first();

        return $result;
    }

    protected function _getConservacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['seedsto']])->first();

        return $result;
    }

    protected function _getRefrescamiento()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['typeref']])->first();

        return $result;
    }

    protected function _getMaterial()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['typemat']])->first();

        return $result;
    }

    protected function _getAlmacenamiento()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['storage']])->first();

        return $result;
    }

    protected function _getCiclovegetativo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['ciclo']])->first();

        return $result;
    }

    protected function _getCodaccesion()
    {
        $result = TableRegistry::get('Passport')->find()->where(['id' => $this->_properties['passport_id']])->first();

        return $result;
    }


}
