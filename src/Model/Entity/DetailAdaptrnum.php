<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DetailAdaptrnum Entity
 *
 * @property int $id
 * @property string $adapter_name
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $genotypic_id
 *
 * @property \App\Model\Entity\CaractGenotypic $caract_genotypic
 */
class DetailAdaptrnum extends Entity
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
        'id' => false,
        'genotypic_id' => false
    ];
}
