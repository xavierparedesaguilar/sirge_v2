<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OutputDna Entity
 *
 * @property int $id
 * @property string $reqcode
 * @property string $reqname
 * @property string $exitdate
 * @property int $numtubexit
 * @property string $object
 * @property string $remexit
 * @property int $bank_dna_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $status
 *
 * @property \App\Model\Entity\BankDna $bank_dna
 */
class OutputDna extends Entity
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
