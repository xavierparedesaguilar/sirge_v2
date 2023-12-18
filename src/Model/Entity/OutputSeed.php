<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OutputSeed Entity
 *
 * @property int $id
 * @property string $reqcode
 * @property string $reqname
 * @property \Cake\I18n\FrozenDate $exitdate
 * @property int $numbagexit
 * @property string $reason
 * @property string $remexit
 * @property int $bank_seed_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \App\Model\Entity\BankSeed $bank_seed
 */
class OutputSeed extends Entity
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
