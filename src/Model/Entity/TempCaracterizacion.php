<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TempCaracterizacion Entity
 *
 * @property int $id
 * @property int $val_error
 * @property int $val_error_annio
 * @property string $passport_accenumb
 * @property string $passport_othenumb
 * @property string $annio_periodo
 * @property string $descriptor_name
 * @property string $valor
 * @property string $observation
 * @property int $specie_name
 * @property int $collection_name
 * @property int $resource_id
 * @property int $user_id
 */
class TempCaracterizacion extends Entity
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
