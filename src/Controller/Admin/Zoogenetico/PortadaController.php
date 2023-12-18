<?php
namespace App\Controller\Admin\Zoogenetico;

use App\Controller\Admin\Zoogenetico\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class PortadaController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('User');
    }

    public function index($value='')
    {
        $titulo = "Zoogenético";
        $show_modules = $this->Functions->get_modules_();

        $this->set(compact('titulo','show_modules'));
    }

}

