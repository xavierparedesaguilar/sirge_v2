<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Ubigeo Entity
 *
 * @property int $id
 * @property string $cod_dep
 * @property string $cod_pro
 * @property string $cod_dis
 * @property string $nombre
 *
 * @property \App\Model\Entity\Insitu[] $insitu
 * @property \App\Model\Entity\Passport[] $passport
 * @property \App\Model\Entity\Station[] $station
 */
class Ubigeo extends Entity
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

    /**  Obtiene el departamento del ubigeo **/
    protected function _getDepartamento()
    {
        $ubigeo = TableRegistry::get('Ubigeo')->find()->where(['id' => $this->_properties['id'] ])->first();

        $departamento = TableRegistry::get('Ubigeo')->find()->where(['cod_dep' => $ubigeo->cod_dep, 'cod_pro' => 0, 'cod_dis' => 0])->first();

        return $departamento ;
    }

    /**  Obtiene el Provincia del ubigeo **/
    protected function _getProvincia()
    {
        $ubigeo = TableRegistry::get('Ubigeo')->find()->where(['id' => $this->_properties['id'] ])->first();

        $provincia = [];

        if($ubigeo->cod_pro != 0 && $ubigeo->cod_dep != 0){

            $provincia = TableRegistry::get('Ubigeo')->find()->where(['cod_pro' => $ubigeo->cod_pro, 'cod_dep' => $ubigeo->cod_dep, 'cod_dis' => 0])->first();
            $name_prov = $provincia->nombre;

        } else {

            $name_prov = 'NINGUNO';
        }

        return $name_prov ;
    }

    /**  Obtiene el Distrito del ubigeo **/
    protected function _getDistrito()
    {
        $distrito = [];

        $ubigeo = TableRegistry::get('Ubigeo')->find()->where(['id' => $this->_properties['id'] ])->first();

        if($ubigeo->cod_dis != 0){

            $distrito = $ubigeo->nombre;
        } else {

            $distrito = 'NINGUNO';
        }

        return $distrito ;
    }

}
