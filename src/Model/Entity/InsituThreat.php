<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\ORM\TableRegistry;

/**
 * InsituThreat Entity
 *
 * @property int $id
 * @property int $severity
 * @property string $culture
 * @property string $damage_impact
 * @property string $alternative_handle
 * @property string $threat
 * @property string $description
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $insitu_id
 *
 * @property \App\Model\Entity\Insitu $insitu
 */
class InsituThreat extends Entity
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

    /**  OBTIENE GRADO DE INSTRUCCION **/
    protected function _getSeveridad()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['severity']])->first();

        return $result;
    }
}
