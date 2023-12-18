<?php
namespace App\Model\Entity;


use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;
/**
 * OptionList Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property int $child_id
 * @property string $name
 * @property string $slug
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\OptionList $parent_option_list
 * @property \App\Model\Entity\Child $child
 * @property \App\Model\Entity\OptionList[] $child_option_list
 */
class OptionList extends Entity
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

protected function _getTiporecurso()
    {
        $result = TableRegistry::get('Resource')->find()->where(['id' => $this->_properties['resource_id']])->first();

            return $result;
    }
}
