<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * PassportFito Entity
 *
 * @property int $id
 * @property int $subtype
 * @property string $collnumb
 * @property string $spauthor
 * @property string $subtaxa
 * @property string $subtauthor
 * @property int $storage
 * @property \Cake\I18n\FrozenDate $acqdate
 * @property int $availability
 * @property string $collsite
 * @property float $latitude
 * @property float $longitude
 * @property float $elevation
 * @property int $coorddatum
 * @property int $georefmeth
 * @property string $coorduncert
 * @property string $accimag1
 * @property string $accimag2
 * @property string $accimag3
 * @property string $accimag4
 * @property string $remarks1
 * @property string $remarks2
 * @property string $remarks3
 * @property string $remarks4
 * @property string $collcode
 * @property string $collname
 * @property string $collinstaddress
 * @property string $collmissind
 * @property int $collsrc
 * @property int $collsrcdet
 * @property int $sampstat
 * @property \Cake\I18n\FrozenDate $colldate
 * @property string $localname
 * @property string $groupethnic
 * @property int $samptype
 * @property int $sampsize
 * @property string $sampling
 * @property int $plauspart
 * @property int $uso
 * @property string $poparea
 * @property string $pathogen
 * @property string $donorcore
 * @property string $donorname
 * @property string $donaddress
 * @property string $donornumb
 * @property string $humidity
 * @property string $temp
 * @property string $presure
 * @property string $precipitation
 * @property int $soiltext
 * @property int $soilped
 * @property int $soilcol
 * @property int $soilph
 * @property string $soilrel
 * @property string $mancest
 * @property string $pancest
 * @property string $ancest
 * @property int $mlsstat
 * @property string $patent
 * @property string $bredcode
 * @property string $bredname
 * @property string $duplinstname
 * @property string $duplsite
 * @property int $invitro
 * @property int $bseed
 * @property int $bfield
 * @property string $insitu
 * @property int $bdna
 * @property string $remarks
 * @property int $passport_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Passport $passport
 */
class PassportFito extends Entity
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

    /**  Obtiene el codigo autogenerado para pasaporte fitogenetico **/
    protected function _getPassfitogenetico()
    {
        $total = TableRegistry::get('Passport')->find()->where(['resource_id' => 1])->count();

        if($total > 0){

            $result = $total + 1;

        } else {

            $result = 1;
        }

        return $result;
    }

    /**  Obtiene el SUB TIPO DE RECURSO **/
    protected function _getSubtiporecurso()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['subtype']])->first();

        return $result;
    }

    /**  Obtiene  TIPO DE CONSERVACIÓN **/
    protected function _getTipoconservacion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['storage']])->first();

        return $result;
    }

    /**  Obtiene la disponibilidad **/
    protected function _getDisponibleaccesion()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['availability']])->first();

        return $result;
    }
	
	protected function _getPromisoria()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['promisori']])->first();

        return $result;
    }

    protected function _getSubrecurso()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['subtype']])->first();

        return $result;
    }

    protected function _getTipocoordenadas()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['coorddatum']])->first();

        return $result;
    }

    /**  Obtiene el Método de Georeferenciación **/
    protected function _getMetgeore()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['georefmeth']])->first();

        return $result;
    }

    protected function _getFuente()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['collsrc']])->first();

        return $result;
    }

    protected function _getFuentedet()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['collsrcdet']])->first();

        return $result;
    }

    protected function _getCondbiologica()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['sampstat']])->first();

        return $result;
    }

    protected function _getParteutil()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['plauspart']])->first();

        return $result;
    }

    protected function _getUsoplanta()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['uso']])->first();

        return $result;
    }

    protected function _getTextsuelo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soiltext']])->first();

        return $result;
    }

    protected function _getPedsuelo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soilped']])->first();

        return $result;
    }

    protected function _getColsuelo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soilcol']])->first();

        return $result;
    }

    protected function _getPhsuelo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soilph']])->first();

        return $result;
    }

    protected function _getSismultilateral()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['mlsstat']])->first();

        return $result;
    }

    protected function _getBankinvitro()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['invitro']])->first();

        return $result;
    }

    protected function _getBanksemilla()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['bseed']])->first();

        return $result;
    }

    protected function _getBankcampo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['bfield']])->first();

        return $result;
    }

    protected function _getTipomuestra()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['samptype']])->first();

        return $result;
    }

    protected function _getBankadn()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['bdna']])->first();

        return $result;
    }


    /********************** VALIDACION QUE NO TENGA REGISTROS ASOCIADOS : BANCOS Y CARACTERIZACION ***********************/
    protected function _getValidacion()
    {
        $conn = ConnectionManager::get('default');
        $stmt = $conn->prepare('
            SELECT sum(s.total) AS total FROM(
                SELECT COUNT(*) AS total FROM bank_field AS a INNER JOIN passport AS b ON a.passport_id = b.id
                        WHERE a.passport_id = :id AND b.resource_id = 1 AND b.id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM bank_invitro AS a INNER JOIN passport AS b ON a.passport_id = b.id
                        WHERE a.passport_id = :id AND b.resource_id = 1 AND b.id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM bank_dna AS a INNER JOIN passport AS b ON a.passport_id = b.id
                        WHERE a.passport_id = :id AND a.type_resource = 1 AND b.resource_id = 1 AND b.id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM bank_seed AS a INNER JOIN passport AS b ON a.passport_id = b.id
                        WHERE a.passport_id = :id AND b.resource_id = 1 AND b.id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM passport AS a
                 INNER JOIN characterization_detail AS b ON a.id = b.passport_id
                 INNER JOIN descriptor_value AS c ON c.characterization_detail_id = b.id
                 WHERE a.resource_id = 1 AND a.status = 1 AND b.status = 1 AND a.id = :id AND b.passport_id = :id
            ) s ');

        $stmt->bindValue( ':id', $this->_properties['passport_id'], PDO::PARAM_INT);
        $stmt->execute();
        $valor = $stmt->fetch('assoc');

        return $valor['total'];
    }

    /************************ VALIDACION DE BANCOS ******************************/
    protected function _getBancoCampo()
    {
        $result = TableRegistry::get('BankField')->find()->where(['passport_id' => $this->_properties['passport_id'], 'status' => '1' ])->count();
        return $result;
    }

    protected function _getBancoSemilla()
    {
        $result = TableRegistry::get('BankSeed')->find()->where(['passport_id' => $this->_properties['passport_id'], 'status' => '1'])->count();
        return $result;
    }

    protected function _getBancoInvitro()
    {
        $result = TableRegistry::get('BankInvitro')->find()->where(['passport_id' => $this->_properties['passport_id'], 'status' => '1'])->count();
        return $result;
    }

    protected function _getBancoAdn()
    {
        $result = TableRegistry::get('BankDna')->find()->where(['passport_id' => $this->_properties['passport_id'], 'status' => '1'])->count();
        return $result;
    }


}
