<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

use Cake\ORM\TableRegistry;

/**
 * InsituFarmerActivity Entity
 *
 * @property int $id
 * @property string $purpose
 * @property string $comunities
 * @property string $common_name
 * @property string $description
 * @property int $input_tools
 * @property int $origin
 * @property int $practice_know
 * @property int $technical_category
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $insitu_id
 *
 * @property \App\Model\Entity\Insitu $insitu
 */
class InsituFarmerActivity extends Entity
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

    /**  OBTIENE GRADO DE INSTRUCCION **/
    protected function _getTecnicaCategoria()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['technical_category']])->first();

        return $result;
    }

    /**  OBTIENE TIPO SUELO **/
    protected function _getPracticaSaber()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['practice_know']])->first();

        return $result;
    }

    /**  OBTIENE GRADO DE INSTRUCCION **/
    protected function _getInsumoHerramienta()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['input_tools']])->first();

        return $result;
    }

    /**  OBTIENE TIPO SUELO **/
    protected function _getOrigen()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['origin']])->first();

        return $result;
    }

}
