<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * InsituAccesion Entity
 *
 * @property int $id
 * @property string $accenumb
 * @property string $othenumb
 * @property string $common_name
 * @property string $manifold
 * @property string $reported_usage
 * @property string $extension
 * @property string $area_cultivation
 * @property string $others
 * @property string $scientific_name
 * @property string $uso
 * @property string $local_name
 * @property string $habitat
 * @property string $reference
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $insitu_id
 * @property int $passport_id
 * @property string $wild_relatives
 *
 * @property \App\Model\Entity\Insitu $insitu
 * @property \App\Model\Entity\Passport $passport
 */
class InsituAccesion extends Entity
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
