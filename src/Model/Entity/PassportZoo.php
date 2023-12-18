<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * PassportZoo Entity
 *
 * @property int $id
 * @property int $subtype
 * @property string $collnumb
 * @property int $colname
 * @property string $genus
 * @property string $species
 * @property string $husbname
 * @property string $spauthor
 * @property string $subtaxa
 * @property string $subtauthor
 * @property string $racetype
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
 * @property string $colladdress
 * @property string $collmissind
 * @property string $localname
 * @property \Cake\I18n\Time $colldate
 * @property int $sampstat
 * @property int $collsrc
 * @property int $collsrcdet
 * @property string $groupethnic
 * @property \Cake\I18n\Time $datebirth
 * @property \Cake\I18n\Time $dateofdec
 * @property string $samptype
 * @property string $sampling
 * @property string $anuspart
 * @property string $uso
 * @property string $pathogen
 * @property string $poparea
 * @property string $humidity
 * @property string $temp
 * @property string $presure
 * @property string $precipitation
 * @property string $mancest
 * @property string $pancest
 * @property string $ancest
 * @property string $owname
 * @property string $owaddress
 * @property string $donorcore
 * @property string $donorname
 * @property string $donaddress
 * @property int $mlsstat
 * @property string $patent
 * @property string $bredcode
 * @property string $bredname
 * @property string $duplinstname
 * @property string $duplsite
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
class PassportZoo extends Entity
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
   protected function _getPasszoogenetico()
   {
       $total = TableRegistry::get('Passport')->find('all')->where(['resource_id' => 2])->count();

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
   protected function _getDisponibleaccesion()
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

   protected function _getSubrecursozoo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['subtype']])->first();

        return $result;
    }

    protected function _getTipconservacionzoo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['storage']])->first();

        return $result;
    }

    protected function _getTipcoordenadazoo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['coorddatum']])->first();

        return $result;
    }

    protected function _getMetgeorezoo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['georefmeth']])->first();

        return $result;
    }

    protected function _getCondbiologicazoo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['sampstat']])->first();

        return $result;
    }

    protected function _getFuentezoo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['collsrc']])->first();

        return $result;
    }

    protected function _getFuentedetzoo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['collsrcdet']])->first();

        return $result;
    }

    protected function _getSismultilateralzoo()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['mlsstat']])->first();

        return $result;
    }

    protected function _getBankadnzoo()
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
                        WHERE a.passport_id = :id AND a.type_resource = 2 AND b.resource_id = 2 AND b.id = :id AND a.status = 1
                UNION ALL
                SELECT COUNT(*) AS total FROM passport AS a
                 INNER JOIN characterization_detail AS b ON a.id = b.passport_id
                 INNER JOIN descriptor_value AS c ON c.characterization_detail_id = b.id
                 WHERE a.resource_id = 2 AND a.status = 1 AND b.status = 1 AND a.id = :id AND b.passport_id = :id
            ) s ');

        $stmt->bindValue( ':id', $this->_properties['passport_id'], PDO::PARAM_INT);
        $stmt->execute();
        $valor = $stmt->fetch('assoc');

        return $valor['total'];
    }

    /************************ VALIDACION DE BANCOS ******************************/
    protected function _getBancoAdn()
    {
        $result = TableRegistry::get('BankDna')->find()->where(['passport_id' => $this->_properties['passport_id'], 'status' => '1'])->count();
        return $result;
    }

}
