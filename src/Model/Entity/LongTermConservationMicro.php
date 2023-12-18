<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;


/**
 * LongTermConservationMicro Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $constime
 * @property string $consresponsible
 * @property string $consrem
 * @property int $longtermcon
 * @property string $longtermtemp
 * @property string $longtermtime
 * @property int $criopro
 * @property int $longtermtype
 * @property int $criovinumb
 * @property int $crioviminstock
 * @property string $longstornumb
 * @property int $longstorage
 * @property string $criolevel
 * @property string $criorack
 * @property string $longrackpos
 * @property int $longcrionumb
 * @property string $longcriopos
 * @property string $amprack
 * @property string $amppos
 * @property int $bank_micro_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 * @property \Cake\I18n\FrozenDate $renewal_date
 *
 * @property \App\Model\Entity\BankMicro $bank_micro
 */
class LongTermConservationMicro extends Entity
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

        protected function _getMediolargo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['longtermcon']])->first();

        return $result;
    }
    protected function _getTipolargo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['longtermtype']])->first();

        return $result;
    }
    protected function _getLugarlargo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['longstorage']])->first();

        return $result;
    }
    protected function _getCriolargo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['criopro']])->first();

        return $result;
    }

}
