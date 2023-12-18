<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * CaractPhysicalChemistry Entity
 *
 * @property int $id
 * @property string $expnumb
 * @property int $colname
 * @property string $samplelist
 * @property string $project
 * @property string $projcode
 * @property string $datamatrix
 * @property string $traitlist
 * @property string $respname
 * @property string $remarks
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 */
class CaractPhysicalChemistry extends Entity
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
    protected function _getNumeroDocumento()
    {
        $total = TableRegistry::get('CaractPhysicalChemistry')->find('all')->count();

        if($total > 0){

            $result = $total + 1;

        } else {

            $result = 1;
        }

        return $result;
    }

    protected function _getColeccioncara()

    {

        $result = TableRegistry::get('Collection')->find()->where(['id' => $this->_properties['colname']])->first();

        return $result;
    }

}
