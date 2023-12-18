<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\ORM\TableRegistry;

/**
 * InsituPlage Entity
 *
 * @property int $id
 * @property int $severity
 * @property string $scientific_name
 * @property string $reported_damage
 * @property string $culture
 * @property string $common_name
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $insitu_id
 *
 * @property \App\Model\Entity\Insitu $insitu
 */
class InsituPlage extends Entity
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

    /**  OBTIENE SEVERIDAD **/
    protected function _getSeveridad()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['severity']])->first();

        return $result;
    }

}
