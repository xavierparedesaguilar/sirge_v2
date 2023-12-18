<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DescriptorValue Entity
 *
 * @property int $id
 * @property string $value
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $passport_id
 * @property int $descriptor_id
 *
 * @property \App\Model\Entity\Passport $passport
 * @property \App\Model\Entity\Descriptor $descriptor
 */
class DescriptorValue extends Entity
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
