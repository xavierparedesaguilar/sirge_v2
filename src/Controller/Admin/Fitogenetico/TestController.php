<?php
namespace App\Controller\Fitogenetico;

use App\Controller\Admin\Fitogenetico\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class TestController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('User');
    }

    public function index($value='')
    {
    	echo "<pre>";
    	print_r("hola mundo");
        $this->Functions->get_modules_();
    }

}

