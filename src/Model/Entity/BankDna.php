<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use PDO;

/**
 * BankDna Entity
 *
 * @property int $id
 * @property int $type_resource
 * @property int $bank_availability
 * @property string $lotnumb
 * @property \Cake\I18n\FrozenDate $acqdate
 * @property int $availability
 * @property string $remarks
 * @property int $passport_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \App\Model\Entity\Passport $passport
 * @property \App\Model\Entity\ExtractionDna[] $extraction_dna
 * @property \App\Model\Entity\InputDna[] $input_dna
 * @property \App\Model\Entity\OutputDna[] $output_dna
 * @property \App\Model\Entity\TestIntegrityDna[] $test_integrity_dna
 * @property \App\Model\Entity\TestPurityDna[] $test_purity_dna
 */
class BankDna extends Entity
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

    protected function _getDisponibilidad()
    {
        $result = TableRegistry::get('OptionList')->find()->where(['id' => $this->_properties['availability']])->first();

        return $result;
    }


    protected function _getExtraccion()
    {
        $result = TableRegistry::get('ExtractionDna')->find()->where(['bank_dna_id' => $this->_properties['id']])->first();

        return $result;
    }
}
