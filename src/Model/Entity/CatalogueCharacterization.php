<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CatalogueCharacterization Entity
 *
 * @property int $id
 * @property int $descriptor_id
 * @property string $descriptor_name
 * @property int $resource_id
 * @property int $collection_id
 * @property int $specie_id
 * @property int $availability
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class CatalogueCharacterization extends Entity
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
}
