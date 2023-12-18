<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * EvaluationField Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $evaldate
 * @property string $evalname
 * @property string $evalrem
 * @property int $prodtype
 * @property string $prodrem
 * @property string $harvest
 * @property int $bank_field_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \App\Model\Entity\BankField $bank_field
 */
class EvaluationField extends Entity
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

    protected function _getProducto()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['prodtype']])->first();

        return $result;
    }
}
