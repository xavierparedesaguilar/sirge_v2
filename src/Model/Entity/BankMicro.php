<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * BankMicro Entity
 *
 * @property int $id
 * @property int $bank_availability
 * @property string $lotnumb
 * @property \Cake\I18n\FrozenDate $acqdate
 * @property int $availability
 * @property int $risk
 * @property int $lablevel
 * @property string $quarplace
 * @property string $quartime
 * @property int $reactivation
 * @property string $reactime
 * @property string $reactemp
 * @property \Cake\I18n\FrozenDate $reacdate
 * @property string $reacresponsible
 * @property string $reacrem
 * @property int $isolamed_1
 * @property string $reactime_1
 * @property string $reactemp_1
 * @property int $isolamed_2
 * @property string $reactime_2
 * @property string $reactemp_2
 * @property int $gramstain
 * @property int $lactobluestain
 * @property string $datepurz
 * @property string $remarks
 * @property int $passport_id
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Passport $passport
 * @property \App\Model\Entity\InputMicro[] $input_micro
 * @property \App\Model\Entity\LongTermConservationMicro[] $long_term_conservation_micro
 * @property \App\Model\Entity\OutputMicro[] $output_micro
 * @property \App\Model\Entity\ShortTermConservationMicro[] $short_term_conservation_micro
 */
class BankMicro extends Entity
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

    protected function _getRiesgo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['risk']])->first();

        return $result;
    }

    protected function _getNivel()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['lablevel']])->first();

        return $result;
    }

    protected function _getReactivacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['reactivation']])->first();

        return $result;
    }
    protected function _getCodaccesionmicro()
    {
        $result = TableRegistry::get('Passport')->find()->where(['id' => $this->_properties['passport_id']])->first();

        return $result;
    }

}
