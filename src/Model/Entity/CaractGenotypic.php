<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * CaractGenotypic Entity
 *
 * @property int $id
 * @property string $expnumb
 * @property int $colname
 * @property string $accenumb
 * @property int $molmarker
 * @property int $restenzymuse
 * @property string $restenzymname
 * @property int $adaptrnum
 * @property string $project
 * @property string $projcode
 * @property int $primernum
 * @property string $ciclonumb
 * @property string $seqtech
 * @property string $accnumb
 * @property string $othername
 * @property string $seqsize
 * @property string $datamatrix
 * @property string $fragsizemeth
 * @property string $repnumb
 * @property int $location
 * @property string $respname
 * @property string $markerdescrip
 * @property string $platform
 * @property string $remarks
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 * @property int $resource_id
 *
 * @property \App\Model\Entity\Resource $resource
 */
class CaractGenotypic extends Entity
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

    /**  Obtiene el ultimo ID generado para concatenar en los documentos que se subiran **/
    protected function _getNumeroDocumentoFito()
    {
        $total = TableRegistry::get('CaractGenotypic')->find('all')->where(['resource_id' => 1])->count();

        if($total > 0){

            $result = $total + 1;

        } else {

            $result = 1;
        }

        return $result;
    }

    protected function _getNumeroDocumentoZoo()
    {
        $total = TableRegistry::get('CaractGenotypic')->find('all')->where(['resource_id' => 2])->count();

        if($total > 0){

            $result = $total + 1;

        } else {

            $result = 1;
        }

        return $result;
    }

    protected function _getNumeroDocumentoMicro()
    {
        $total = TableRegistry::get('CaractGenotypic')->find('all')->where(['resource_id' => 3])->count();

        if($total > 0){

            $result = $total + 1;

        } else {

            $result = 1;
        }

        return $result;
    }

    protected function _getMarcadormol()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['molmarker']])->first();

        return $result;
    }

    protected function _getLocalizacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['location']])->first();

        return $result;
    }

    protected function _getColecciongeno()
    {
        $result = TableRegistry::get('Collection')->find()->where(['id' => $this->_properties['colname']])->first();

        return $result;
    }

    protected function _getUsoenzima()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['restenzymuse']])->first();

        return $result;
    }

}
