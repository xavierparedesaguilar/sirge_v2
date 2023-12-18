<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Collection Entity
 *
 * @property int $id
 * @property string $colname
 * @property string $colgroup
 * @property int $resource_id
 * @property int $eea
 * @property int $invitro
 * @property int $bseed
 * @property int $bfield
 * @property int $bdna
 * @property int $insitu
 * @property int $availability
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \App\Model\Entity\Station $station
 * @property \App\Model\Entity\Resource $resource
 * @property \App\Model\Entity\Specie[] $specie
 */
class Collection extends Entity
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
