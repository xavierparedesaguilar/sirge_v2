<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * ExtractionDna Entity
 *
 * @property int $id
 * @property int $extmethod
 * @property \Cake\I18n\FrozenDate $extdate
 * @property string $extres
 * @property int $buffer
 * @property float $volumen
 * @property int $dnaqty
 * @property float <1conadnpur></1conadnpur>
 * @property string $leca260_280
 * @property string <1leca260_230></1leca260_230>
 * @property float $conadnint
 * @property string $din
 * @property int $agaelec
 * @property string $shortermtemp
 * @property string $shortermtime
 * @property \Cake\I18n\FrozenDate $shorconstime
 * @property int $shortmatnumb
 * @property int $shortminstock
 * @property string $shortstornumb
 * @property int $shortstorage
 * @property string $shortlevsh
 * @property string $shortrack
 * @property string $shortrackpos
 * @property int $shortcrionumb
 * @property string $shortcriopos
 * @property string $longtermtemp
 * @property string $longtermtime
 * @property \Cake\I18n\FrozenDate $longconstime
 * @property int $longtermtype
 * @property int $criovinumb
 * @property int $crioviminstock
 * @property string $longstornumb
 * @property int $longstorage
 * @property string $longlevsh
 * @property string $longrack
 * @property string $longrackpos
 * @property int $longcrionumb
 * @property string $longcriopos
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $bank_dna_id
 * @property string $remarks
 *
 * @property \App\Model\Entity\BankDna $bank_dna
 */
class ExtractionDna extends Entity
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

       protected function _getMetodo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['extmethod']])->first();

        return $result;
    }
        protected function _getDilucion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['buffer']])->first();

        return $result;
    }

        protected function _getAlmacenamientoc()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['shortstorage']])->first();

        return $result;
    }

        protected function _getConservacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['longtermtype']])->first();

        return $result;
    }

        protected function _getAlmacenamientol()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['longstorage']])->first();

        return $result;
    }
}
