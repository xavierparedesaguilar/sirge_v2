<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class ConfigTableController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('User');
    }

    public function index($value='')
    {
        $titulo = 'Validaciones';
        $show_modules = [
                            [
                                'slug'  => 'pasaporte-fitogenetico',
                                'title' => 'Pasaporte Fitogenético',
                                'icon'  => 'fa fa-leaf',
                                'id'    => 1
                            ],
                            [
                                'slug'  => 'pasaporte-zoogenetico',
                                'title' => 'Pasaporte Zoogenético',
                                'icon'  => 'fa fa-twitter',
                                'id'    => 2
                            ],
                            [
                                'slug'  => 'pasaporte-microorganismo',
                                'title' => 'Pasaporte Microorganismo',
                                'icon'  => 'fa fa-bug',
                                'id'    => 3
                            ]
                        ];
        $this->set(compact('titulo','show_modules'));
    }

}