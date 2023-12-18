<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
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
    	die();
    }

}