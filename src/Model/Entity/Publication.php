<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Publication Entity
 *
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $editorial
 * @property string $languages
 * @property float $fec_edit
 * @property float $month_edit
 * @property int $edition
 * @property int $country_id
 * @property string $public_place
 * @property int $numpag
 * @property int $copy
 * @property int $public_type
 * @property string $note
 * @property string $summary
 * @property int $volume
 * @property string $institution
 * @property int $category
 * @property string $descriptors
 * @property string $principal_image
 * @property string $documents
 * @property int $availability
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $second_image
 * @property int $collection_id
 *
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Collection $collection
 */
class Publication extends Entity
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

    /************* correlativo para el nombre de la imagen **************/
    protected function _getNumeral()
    {
        $result = TableRegistry::get('Publication')->find()->count();

        if($result > 0){

            $total = $result + 1;

        } else {

            $total = 1;
        }

        return $total;
    }

    /**  Obtiene el SUB TIPO DE RECURSO **/
    protected function _getTipoPublicacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['public_type']])->first();

        return $result;
    }

    /**  Obtiene el SUB TIPO DE RECURSO **/
    protected function _getTipoCategoria()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['category']])->first();

        return $result;
    }


}
