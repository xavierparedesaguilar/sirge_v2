<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\ORM\TableRegistry;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $bank_id
 * @property \Cake\I18n\FrozenDate $date_payment
 * @property int $coin
 * @property float $amount_paid
 * @property int $state
 * @property string $commentary
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Bank $bank
 */
class Payment extends Entity
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


    /**  Obtiene la Estado de pagos **/
    protected function _getEstadoPagos()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['state']])->first();

        return $result;
    }

    /**  Obtiene la tipos de monedas **/
    protected function _getTipoMonedas()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['coin']])->first();

        return $result;
    }

    /**  Obtiene la tipos de bancos **/
    protected function _getTipoBancos()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['bank_id']])->first();

        return $result;
    }


}
