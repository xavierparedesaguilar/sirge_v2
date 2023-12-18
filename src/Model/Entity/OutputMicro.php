<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * OutputMicro Entity
 *
 * @property int $id
 * @property string $reqcode
 * @property string $reqname
 * @property \Cake\I18n\FrozenDate $exitdate
 * @property int $numtubexit
 * @property string $object
 * @property string $remexit
 * @property int $matersta
 * @property int $bank_micro_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \App\Model\Entity\BankMicro $bank_micro
 */
class OutputMicro extends Entity
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

    protected function _getEstado()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['matersta']])->first();

        return $result;
    }
}
