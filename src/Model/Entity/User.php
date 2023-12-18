<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $username
 * @property string $names
 * @property string $surnames
 * @property string $email
 * @property string $password
 * @property string $token
 * @property string $gender
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property string $study_center
 * @property string $institute
 * @property string $code_fao
 * @property string $origin
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $country_id
 * @property int $station_id
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Insitu[] $insitu
 * @property \App\Model\Entity\Log[] $log
 * @property \App\Model\Entity\TempCaracterizacion[] $temp_caracterizacion
 * @property \App\Model\Entity\TempDescriptore[] $temp_descriptores
 * @property \App\Model\Entity\TempPassportFito[] $temp_passport_fito
 * @property \App\Model\Entity\TempPassportMicro[] $temp_passport_micro
 * @property \App\Model\Entity\TempPassportZoo[] $temp_passport_zoo
 * @property \App\Model\Entity\Module[] $module
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        // 'password',
        // 'token'
    ];

      protected function _setPassword($password)
    {
        return md5('ab513c75f48d82bcd30aa48e478d2e6e'.$password);
    }
}
