<?php
namespace App\View\Cell;

use Cake\Routing\Router;
use Cake\View\Cell;

/**
 * Menu cell
 */
class MenuCell extends Cell
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
//        $this->loadModel('Modulo');
        $modulos = $this->reloadModule();
        $this->set('modulos', $modulos);
    }

    public function portada()
    {
        $user = $this->request->session()->read('Auth.User');
        $modulos = $this->reloadModule();
        $this->set(compact('modulos', 'user'));
    }

    public function reloadModule()
    {
        $user = $this->request->session()->read('Auth.User');
        $moduser = $user['modulos'];
        $temp = [];
        $temp_modules = [];
        foreach ($moduser as $key => $modulo) {
            $temp_module = $this->get_parent_module($modulo->module_id);
            $temp[$temp_module->id] = $temp_module;
        }

        foreach ($temp as $key => $temp_) {
            if ($temp_->resource_id==4) {
                $temp_modules[] = $temp_;
                unset($temp[$key]);
            }
        }

        $temp = $this->super_unique($temp,'resource_id');

        foreach ($temp_modules as $key => $temp_x) {
            $temp[] = $temp_x;
        }

        return $temp;
    }
    public function super_unique($array,$key)
    {
       $temp_array = array();
       foreach ($array as &$v) {
           if (!isset($temp_array[$v[$key]]))
           $temp_array[$v[$key]] =& $v;
       }
       $array = array_values($temp_array);
       return $array;
    }

    public function get_parent_module($module_id='2')
    {
        $this->loadModel('Module');
        $modulito = $this->Module->find()->where(['id' => $module_id])->first();
        if (is_null($modulito->parent_id)) {
            return $modulito;
        } else {
            return $this->get_parent_module($modulito->parent_id);
        }
    }
}
