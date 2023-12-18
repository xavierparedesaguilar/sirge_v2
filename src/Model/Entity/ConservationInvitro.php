<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConservationInvitro Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $constime
 * @property string $consresponsible
 * @property string $consrem
 * @property int $bank_invitro_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $status
 * @property string $stoper
 *
 * @property \App\Model\Entity\BankInvitro $bank_invitro
 */
class ConservationInvitro extends Entity
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
