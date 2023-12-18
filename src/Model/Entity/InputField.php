<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * InputField Entity
 *
 * @property int $id
 * @property string $donorcore
 * @property string $donorname
 * @property string $donornumb
 * @property \Cake\I18n\FrozenDate $enterdate
 * @property int $numtubent
 * @property string $rement
 * @property int $bank_field_id
 * @property int $muestratype
 * @property int $estmuestra
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \App\Model\Entity\BankField $bank_field
 */
class InputField extends Entity
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

    protected function _getMuestra()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['muestratype']])->first();

        return $result;
    }


}
