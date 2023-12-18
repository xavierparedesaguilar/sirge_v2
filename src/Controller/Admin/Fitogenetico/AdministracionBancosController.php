<?php
namespace App\Controller\Admin\Fitogenetico;

use App\Controller\Admin\Fitogenetico\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class AdministracionBancosController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('User');
    }

    public function index($value='')
    {
        $titulo = "Gestión de Inventario";
        $show_modules = $this->Functions->get_modules_inventary();

        $this->set(compact('titulo','show_modules'));
    }

}

