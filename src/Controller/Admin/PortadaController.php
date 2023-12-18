<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class PortadaController extends AppController
{

    public function initialize()
    {

        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('User');
        $this->loadModel('Module');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $titulo = "Inicio";
        $this->set(compact('titulo'));
    }

}