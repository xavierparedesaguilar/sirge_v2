<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;


/**
 * PurityMicro Entity
 *
 * @property int $id
 * @property int $isolamed_1
 * @property int $reactime_1
 * @property string $reactemp_1
 * @property int $bank_micro_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 * @property int $isolamed_2
 * @property int $reactime_2
 * @property string $reactemp_2
 * @property int $gramstain
 * @property int $lactobluestain
 * @property \Cake\I18n\FrozenDate $datepurz
 *
 * @property \App\Model\Entity\BankMicro $bank_micro
 */
class PurityMicro extends Entity
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

    /**  Obtiene el Medio de Aislamiento 1 **/
   protected function _getMedio()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['isolamed_1']])->first();

        return $result;
    }
    protected function _getMedio2()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['isolamed_2']])->first();

        return $result;
    }

    protected function _getTincion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['gramstain']])->first();

        return $result;
    }

    protected function _getTincionazul()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['lactobluestain']])->first();

        return $result;
    }
}
