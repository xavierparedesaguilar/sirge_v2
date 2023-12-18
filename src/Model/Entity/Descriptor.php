<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
/**
 * Descriptor Entity
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property int $value_type
 * @property int $type
 * @property string $description
 * @property int $flg_catalogue
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $specie_id
 * @property int $resource_id
 *
 * @property \App\Model\Entity\Specie $specie
 * @property \App\Model\Entity\DescriptorState[] $descriptor_state
 * @property \App\Model\Entity\DescriptorValue[] $descriptor_value
 */
class Descriptor extends Entity
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

    protected function _getRecursodes()
    {
        $recurso = TableRegistry::get('Resource')->find()->where(['id' => $this->_properties['resource_id'] ])->first();

        return $recurso->name ;
    }
}
