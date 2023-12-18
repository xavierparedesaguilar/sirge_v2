<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TempPassportZoo Entity
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
 * @property string $racetype
 * @property string $storage
 * @property string $acqdate
 * @property string $availability
 * @property string $collsite
 * @property string $latitude
 * @property string $longitude
 * @property string $elevation
 * @property string $coorddatum
 * @property string $georefmeth
 * @property string $collcode
 * @property string $collname
 * @property string $colladdress
 * @property string $collmissind
 * @property string $localname
 * @property string $colldate
 * @property string $sampstat
 * @property string $collsrc
 * @property string $collsrcdet
 * @property string $groupethnic
 * @property string $datebirth
 * @property string $dateofdec
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
 * @property string $mlsstat
 * @property string $patent
 * @property string $bredcode
 * @property string $bredname
 * @property string $duplinstname
 * @property string $duplsite
 * @property string $bdna
 * @property string $remarks
 * @property int $resource_id
 * @property int $user_id
 */
class TempPassportZoo extends Entity
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
