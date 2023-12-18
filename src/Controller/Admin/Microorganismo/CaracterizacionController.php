<?php
namespace App\Controller\Admin\Microorganismo;

use App\Controller\Admin\Microorganismo\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class CaracterizacionController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('User');
    }

    public function index($value='')
    {
        $titulo = "Caracterización";
        $show_modules = $this->Functions->get_modules_caract();

        $this->set(compact('titulo','show_modules'));
    }

}
