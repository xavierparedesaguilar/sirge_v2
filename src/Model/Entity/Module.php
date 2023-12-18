<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property int $flg_visible
 * @property string $title
 * @property string $slug
 * @property string $icon
 * @property string $description
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $resource_id
 * @property string $controller
 *
 * @property \App\Model\Entity\ParentModule $parent_module
 * @property \App\Model\Entity\Resource $resource
 * @property \App\Model\Entity\Log[] $log
 * @property \App\Model\Entity\ChildModule[] $child_module
 * @property \App\Model\Entity\Role[] $role
 * @property \App\Model\Entity\User[] $user
 */
class Module extends Entity
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
