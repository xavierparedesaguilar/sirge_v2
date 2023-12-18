<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoryOptionList Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $parent_id
 *
 * @property \App\Model\Entity\CategoryOptionList $parent_category_option_list
 * @property \App\Model\Entity\CategoryOptionList[] $child_category_option_list
 */
class CategoryOptionList extends Entity
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
