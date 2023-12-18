<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PropagationInvitro Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $prodate
 * @property string $propagator
 * @property string $prorem
 * @property int $bank_invitro_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $status
 * @property string $proper
 *
 * @property \App\Model\Entity\BankInvitro $bank_invitro
 */
class PropagationInvitro extends Entity
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
