<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * BankInvitro Entity
 *
 * @property int $id
 * @property string $lotnumb
 * @property int $bank_availability
 * @property \Cake\I18n\FrozenDate $acqdate
 * @property int $availability
 * @property int $storoom
 * @property int $temp
 * @property string $shelving
 * @property int $levelshelv
 * @property int $rack
 * @property string $duplinstname
 * @property int $dupnumb
 * @property int $plastate
 * @property int $necrosis
 * @property int $defoliation
 * @property int $rooting
 * @property int $chlorosis
 * @property int $phenolization
 * @property int $storage
 * @property int $propagation
 * @property int $protime
 * @property int $conservation
 * @property int $constime
 * @property int $tubenumb
 * @property int $explnumb
 * @property int $stock
 * @property int $tubesize
 * @property int $fitostate
 * @property string $pathogen
 * @property string $remarks
 * @property int $passport_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \App\Model\Entity\Passport $passport
 * @property \App\Model\Entity\ConservationInvitro[] $conservation_invitro
 * @property \App\Model\Entity\InputInvitro[] $input_invitro
 * @property \App\Model\Entity\OutputInvitro[] $output_invitro
 * @property \App\Model\Entity\PropagationInvitro[] $propagation_invitro
 */
class BankInvitro extends Entity
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

            /**  Obtiene LA FENOLIZACIÓN **/
    protected function _getFenolizacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['phenolization']])->first();

        return $result;
    }

    /**  Obtiene la disponibilidad **/
    protected function _getDisponibilidad()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['availability']])->first();

        return $result;
    }

        protected function _getConservacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['storoom']])->first();

        return $result;
    }

        protected function _getTemperatura()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['temp']])->first();

        return $result;
    }

        protected function _getEstadoPlanta()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['plastate']])->first();

        return $result;
    }

        protected function _getNecrosisinput()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['necrosis']])->first();

        return $result;
    }

        protected function _getDefolacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['defoliation']])->first();

        return $result;
    }

        protected function _getEnraizamiento()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['rooting']])->first();

        return $result;
    }

        protected function _getClorosis()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['chlorosis']])->first();

        return $result;
    }


        protected function _getAlmacenamiento()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['storage']])->first();

        return $result;
    }

        protected function _getPropagacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['propagation']])->first();

        return $result;
    }


        protected function _getTubo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['tubesize']])->first();

        return $result;
    }

        protected function _getPlanta()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['pathogen']])->first();

        return $result;
    }

        protected function _getEstadoFito()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['fitostate']])->first();

        return $result;
    }
        protected function _getCodaccesionin()
    {
        $result = TableRegistry::get('Passport')->find()->where(['id' => $this->_properties['passport_id']])->first();

        return $result;
    }

}
