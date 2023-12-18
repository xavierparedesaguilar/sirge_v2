<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\ORM\TableRegistry;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $nro_order
 * @property \Cake\I18n\FrozenDate $date_order
 * @property int $client_id
 * @property int $state
 * @property string $commentary
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\OrdersDetail[] $orders_detail
 * @property \App\Model\Entity\Payment[] $payments
 */
class Order extends Entity
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


    /**  Obtiene el estado de la orden **/
    protected function _getEstadoPedido()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['state']])->first();

        return $result;
    }

    //************************ Obtiene el codigo de Orden ****************************/
    protected function _getCodigoOrden()
    {
        $total = TableRegistry::get('Orders')->find('all')->where(['YEAR(date_order)' => date('Y')])->count();

        if($total > 0){

            $result = $total + 1;

        } else {

            $result = 1;
        }

        return $result;
    }


}
