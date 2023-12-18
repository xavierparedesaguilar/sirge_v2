<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\ORM\TableRegistry;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $names
 * @property string $surnames
 * @property string $name_client
 * @property string $email
 * @property int $gender
 * @property int $country_id
 * @property string $origin
 * @property \Cake\I18n\FrozenDate $date_nac
 * @property string $study_center
 * @property string $institution
 * @property string $code_fao
 * @property int $state
 * @property string $commentary
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Order[] $orders
 */
class Client extends Entity
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

    /**  OBTIENE Estado del CLIENTE **/
    protected function _getEstadoCliente()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['state']])->first();

        return $result;
    }
}
