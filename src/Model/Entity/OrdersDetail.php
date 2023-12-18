<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\ORM\TableRegistry;

/**
 * OrdersDetail Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $passport_id
 * @property int $specie_id
 * @property int $quantity
 * @property int $bank_id
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Passport $passport
 * @property \App\Model\Entity\Specie $specie
 * @property \App\Model\Entity\Bank $bank
 */
class OrdersDetail extends Entity
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


    protected function _getNombreBanco()
    {
        if($this->_properties['bank_id'] == 1){
            $banco = "Banco Invitro";
        } else if($this->_properties['bank_id'] == 2){
            $banco = "Banco Campo";
        } else if($this->_properties['bank_id'] == 3){
            $banco = "Banco ADN";
        } else {
            $banco = "Banco Semilla";
        }

        return $banco;
    }

}
