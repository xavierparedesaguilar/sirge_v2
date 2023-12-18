<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * Passport Entity
 *
 * @property int $id
 * @property string $instcode
 * @property string $accenumb
 * @property string $accname
 * @property string $othenumb
 * @property int $specie_id
 * @property int $resource_id
 * @property int $station_current_id
 * @property int $station_origin_id
 * @property int $status
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $created
 * @property int $country_id
 * @property int $ubigeo_id
 * @property string $localidad
 * @property string $collection_name
 * @property int $promissory
 *
 * @property \App\Model\Entity\Specie $specie
 * @property \App\Model\Entity\Resource $resource
 * @property \App\Model\Entity\Station $station
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Ubigeo $ubigeo
 * @property \App\Model\Entity\BankDna[] $bank_dna
 * @property \App\Model\Entity\BankField[] $bank_field
 * @property \App\Model\Entity\BankInvitro[] $bank_invitro
 * @property \App\Model\Entity\BankMicro[] $bank_micro
 * @property \App\Model\Entity\BankSeed[] $bank_seed
 * @property \App\Model\Entity\DescriptorValue[] $descriptor_value
 * @property \App\Model\Entity\InsituAccesion[] $insitu_accesion
 * @property \App\Model\Entity\PassportFito[] $passport_fito
 * @property \App\Model\Entity\PassportMicro[] $passport_micro
 * @property \App\Model\Entity\PassportZoo[] $passport_zoo
 * @property \App\Model\Entity\ShoppingCartProduct[] $shopping_cart_product
 */
class Passport extends Entity
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

    /*********** Valida que el ubigeo exista en la base de datos ***********/
    public static function validaubigeo( $departamento, $provincia, $distrito )
    {
        $conn = ConnectionManager::get('default');

        $stmt = $conn->prepare( 'SELECT f_busca_ubigeo_id( ? , ? , ? ) AS ubigeo' );
        $stmt->bindValue(1, $departamento, PDO::PARAM_STR);
        $stmt->bindValue(2, $provincia, PDO::PARAM_STR);
        $stmt->bindValue(3, $distrito, PDO::PARAM_STR);
        $stmt->execute();
        $x_ubigeo = $stmt->fetchAll('assoc');

        if($x_ubigeo[0]['ubigeo'] > 0){

            $resultado = $x_ubigeo[0]['ubigeo'];
			

        } else {

            $resultado = 0;
        }
        return $resultado;
    }

    protected function _getPais()
    {
        $result = TableRegistry::get('Country')->find()->where(['id' => $this->_properties['country_id']])->first();
		//debug($resultado);
		//exit;
        return $result;
    }

     protected function _getEspeciefito()
    {
        $result = TableRegistry::get('Specie')->find()/*->select(['genus','species'])*/->where(['id' => $this->_properties['specie_id']])->first();
        return $result;
    }

    protected function _getEstacionorigen()
    {
        $result = TableRegistry::get('Station')->find()->where(['id' => $this->_properties['station_origin_id']])->first();
        return $result;
    }

    protected function _getEstacionprocedencia()
    {
        $result = TableRegistry::get('Station')->find()/*->select(['eea'])*/->where(['id' => $this->_properties['station_current_id']])->first();
        return $result;
    }
    protected function _getEspeciesemilla()
    {
        $result = TableRegistry::get('Specie')->find()->where(['id' => $this->_properties['specie_id']])->first();
        return $result;
    }



}
