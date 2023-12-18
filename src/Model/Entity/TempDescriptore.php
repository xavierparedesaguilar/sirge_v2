<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TempDescriptore Entity
 *
 * @property int $id
 * @property string $motivo_error
 * @property string $especie
 * @property string $coleccion
 * @property string $campo_1
 * @property string $campo_2
 * @property string $campo_3
 * @property string $campo_4
 * @property int $recurso
 * @property int $tipo_carga
 * @property int $user_id
 */
class TempDescriptore extends Entity
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
