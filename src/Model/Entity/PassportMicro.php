<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * PassportMicro Entity
 *
 * @property int $id
 * @property int $subtype
 * @property string $collnumb
 * @property int $colname
 * @property string $genus
 * @property string $species
 * @property string $commonname
 * @property string $spauthor
 * @property string $subtaxa
 * @property string $subtauthor
 * @property string $strain
 * @property int $storage
 * @property \Cake\I18n\Time $acqdate
 * @property int $eea
 * @property int $eeaproc
 * @property int $availability
 * @property string $collsite
 * @property string $latitude
 * @property string $longitude
 * @property string $elevation
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
 * @property int $isosrc
 * @property int $sampstat
 * @property \Cake\I18n\Time $colldate
 * @property string $localname
 * @property string $groupethnic
 * @property string $samptype
 * @property string $sampsize
 * @property string $sampling
 * @property string $uso
 * @property string $humidity
 * @property string $temp
 * @property string $presure
 * @property string $precipitation
 * @property int $soiltext
 * @property int $soilped
 * @property string $soilcol
 * @property int $soilph
 * @property int $soilfis
 * @property string $soilrel
 * @property string $soiltemp
 * @property string $soilodor
 * @property int $watersrc
 * @property string $watercol
 * @property string $watertemp
 * @property int $waterodor
 * @property int $waterph
 * @property string $waterturb
 * @property string $donorcore
 * @property string $donorname
 * @property string $donaddress
 * @property string $donornumb
 * @property string $asocgenus
 * @property string $asocspecies
 * @property string $asoclocalname
 * @property string $mancest
 * @property string $pancest
 * @property string $ancest
 * @property int $mlsstat
 * @property string $patent
 * @property string $straincode
 * @property string $strainname
 * @property string $duplinstname
 * @property string $duplsite
 * @property string $antag
 * @property int $biolrisk
 * @property string $samphist
 * @property string $asilmed
 * @property int $invitro
 * @property int $bdna
 * @property int $bfield
 * @property string $remarks
 * @property int $passport_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Passport $passport
 */
class PassportMicro extends Entity
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

    /**  Obtiene el codigo autogenerado para pasaporte microorganismo **/
   protected function _getPassmicroorganismo()
   {
       $total = TableRegistry::get('Passport')->find('all')->where(['resource_id' => 3])->count();

       if($total > 0){

           $result = $total + 1;

       } else {

           $result = 1;
       }

       return $result ;
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
   protected function _getDisponibleaccesionmicro()
   {
       $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['availability']])->first();

       return $result;
   }

   /**  Obtiene la Coleccion **/
   protected function _getColeccion()
   {
       $result = TableRegistry::get('Collection')->find()->where(['id' => $this->_properties['colname']])->first();

       return $result;
   }

   protected function _getTipconservacionmicro()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['storage']])->first();

        return $result;
    }

   protected function _getTipcoordenadamicro()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['coorddatum']])->first();

        return $result;
    }

    protected function _getMetgeoremicro()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['georefmeth']])->first();

        return $result;
    }

    protected function _getTextsuelo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soiltext']])->first();

        return $result;
    }

    protected function _getPedregocidadsue()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soilped']])->first();

        return $result;
    }

    protected function _getColorsue()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soilcol']])->first();

        return $result;
    }
    protected function _getDetallemicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['collsrc']])->first();

      return $result;
    }

    protected function _getFuentemicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['collsrcdet']])->first();

      return $result;
    }

    protected function _getAislamientomicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['isosrc']])->first();

      return $result;
    }

    protected function _getBiologicomicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['sampstat']])->first();

      return $result;
    }

    protected function _getPhsuelo()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soilph']])->first();

      return $result;
    }

    protected function _getFisiomicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['soilfis']])->first();

      return $result;
    }

    protected function _getFuenteagua()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['watersrc']])->first();

      return $result;
    }

    protected function _getColoragua()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['watercol']])->first();

      return $result;
    }

    protected function _getOloragua()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['waterodor']])->first();

      return $result;
    }

    protected function _getPhagua()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['waterph']])->first();

      return $result;
    }

    protected function _getSistemamicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['mlsstat']])->first();

      return $result;
    }

    protected function _getRiesgomicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['biolrisk']])->first();

      return $result;
    }

    protected function _getInvitromicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['asilmed']])->first();

      return $result;
    }

    protected function _getAdnmicro()
    {
      $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['micro']])->first();

      return $result;
    }

    protected function _getCampomicro()
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
                SELECT COUNT(*) AS total FROM bank_dna AS a INNER JOIN passport AS b ON a.passport_id = b.id
                        WHERE a.passport_id = :id AND a.type_resource = 3 AND b.resource_id = 3 AND b.id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM bank_micro AS a INNER JOIN passport AS b ON a.passport_id = b.id
                        WHERE a.passport_id = :id AND b.resource_id = 3 AND b.id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM passport AS a
                 INNER JOIN characterization_detail AS b ON a.id = b.passport_id
                 INNER JOIN descriptor_value AS c ON c.characterization_detail_id = b.id
                 WHERE a.resource_id = 3 AND a.status = 1 AND b.status = 1 AND a.id = :id AND b.passport_id = :id
            ) s ');

        $stmt->bindValue( ':id', $this->_properties['passport_id'], PDO::PARAM_INT);
        $stmt->execute();
        $valor = $stmt->fetch('assoc');

        return $valor['total'];
    }

    /************************ VALIDACION DE BANCOS ******************************/
    protected function _getBancoMicro()
    {
        $result = TableRegistry::get('BankMicro')->find()->where(['passport_id' => $this->_properties['passport_id'], 'status' => '1'])->count();
        return $result;
    }

    protected function _getBancoAdn()
    {
        $result = TableRegistry::get('BankDna')->find()->where(['passport_id' => $this->_properties['passport_id'], 'status' => '1'])->count();
        return $result;
    }

}

