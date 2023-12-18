<?php
namespace App\View\Cell;

use Cake\Routing\Router;
use Cake\View\Cell;

/**
 * Portada cell
 */
class PortadaCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {

    }
    public function portada()
    {
//        $this->loadModel('Modulo');
//        $modulos = $this->Modulo->find('all');
        //$modulos = $this->moduloLoad();
        $modulos = $this->get_parent_module(4);
        print_r(json_encode($modulos,JSON_PRETTY_PRINT));
        $this->set('modulos', $modulos);
    }

    public function get_parent_module($module_id='2')
    {
        $this->loadModel('Module');

            print_r($module_id);
        $modulito = $this->Module->find()->where(['id' => $module_id])->first();
        if (is_null($modulito)) {
            print_r(json_encode($modulito,JSON_PRETTY_PRINT));

            return "iffff";
            //return $modulito;
        } else {
            print_r($modulito->parent_id);
            return $this->get_parent_module($modulito->parent_id);
        }
    }

    public function FunctionName($value='')
    {
        echo "<pre>";
        echo Router::url( $this->here, true );
        die();
    }
}
