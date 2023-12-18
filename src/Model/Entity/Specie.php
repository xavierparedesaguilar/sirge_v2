<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Specie Entity
 *
 * @property int $id
 * @property string $genus
 * @property string $species
 * @property string $cropname
 * @property string $family
 * @property int $availability
 * @property int $collection_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $status
 *
 * @property \App\Model\Entity\Collection $collection
 * @property \App\Model\Entity\Descriptor[] $descriptor
 * @property \App\Model\Entity\Passport[] $passport
 */
class Specie extends Entity
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
