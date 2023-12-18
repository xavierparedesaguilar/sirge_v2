<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TempPassportMicro Entity
 *
 * @property int $id
 * @property string $motivo_error
 * @property string $coleccion
 * @property string $nombre_especie
 * @property string $nombre_comun
 * @property string $genero_especie
 * @property string $instcode
 * @property string $accname
 * @property string $othenumb
 * @property string $station_current_id
 * @property string $station_origin_id
 * @property string $pais
 * @property string $departamento
 * @property string $provincia
 * @property string $distrito
 * @property string $localidad
 * @property string $promissory
 * @property string $subtype
 * @property string $collnumb
 * @property string $spauthor
 * @property string $subtaxa
 * @property string $subtauthor
 * @property string $strain
 * @property string $storage
 * @property string $acqdate
 * @property string $availability
 * @property string $collsite
 * @property string $latitude
 * @property string $longitude
 * @property string $elevation
 * @property string $coorddatum
 * @property string $georefmeth
 * @property string $coorduncert
 * @property string $collcode
 * @property string $collname
 * @property string $collinstaddress
 * @property string $collmissind
 * @property string $collsrc
 * @property string $collsrcdet
 * @property string $isosrc
 * @property string $sampstat
 * @property string $colldate
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
 * @property string $soiltext
 * @property string $soilped
 * @property string $soilcol
 * @property string $soilph
 * @property string $soilfis
 * @property string $soilrel
 * @property string $soiltemp
 * @property string $soilodor
 * @property string $watersrc
 * @property string $watercol
 * @property string $watertemp
 * @property string $waterodor
 * @property string $waterph
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
 * @property string $mlsstat
 * @property string $patent
 * @property string $straincode
 * @property string $strainname
 * @property string $duplinstname
 * @property string $duplsite
 * @property string $antag
 * @property string $biolrisk
 * @property string $samphist
 * @property string $asilmed
 * @property string $micro
 * @property string $bdna
 * @property string $remarks
 * @property int $resource_id
 * @property int $user_id
 */
class TempPassportMicro extends Entity
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
}
