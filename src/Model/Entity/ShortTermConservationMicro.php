<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;
/**
 * ShortTermConservationMicro Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $constime
 * @property string $consresponsible
 * @property string $consrem
 * @property int $shortermcon
 * @property string $shortermtemp
 * @property string $shortermtime
 * @property int $shortmatstor
 * @property string $shortmatnumb
 * @property int $shortminstock
 * @property string $shortstornumb
 * @property int $shortstorage
 * @property string $shortlevsh
 * @property string $criorack
 * @property string $shortrackpos
 * @property int $bank_micro_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 * @property \Cake\I18n\FrozenDate $renewal_date
 *
 * @property \App\Model\Entity\BankMicro $bank_micro
 */
class ShortTermConservationMicro extends Entity
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

        protected function _getLugaral()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['shortstorage']])->first();

        return $result;
    }

    protected function _getMedioconser($value='')
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id'=> $this->_properties['shortermcon']])->first();

        return $result;
    }

    protected function _getMaterialAlm($value='')
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id'=> $this->_properties['shortmatstor']])->first();

        return $result;
    }
}
