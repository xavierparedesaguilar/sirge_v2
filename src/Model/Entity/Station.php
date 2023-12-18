<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Station Entity
 *
 * @property int $id
 * @property string $eea
 * @property string $collsite
 * @property string $responsible
 * @property string $telephone
 * @property string $celphone
 * @property int $availability
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $ubigeo_id
 * @property int $country_id
 * @property int $status
 * @property string $localidad
 * @property string $email
 *
 * @property \App\Model\Entity\Ubigeo $ubigeo
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Insitu[] $insitu
 */
class Station extends Entity
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
