<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class GestionPublicacionCatalogoController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('User');
    }

    public function index($value='')
    {
        $titulo = "Públicaciones y Cátalogo Virtual";
        $show_modules = $this->Functions->get_modules_();

        $this->set(compact('titulo','show_modules'));
    }

}