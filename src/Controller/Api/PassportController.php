<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;

class PassportController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Passport');
        $this->MyModel = $this->Passport;
    }
    public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');
        if (isset($update)){
            $params["modified >="] = $update;
        }

        $data = $this->MyModel->find('all')->where($params)->toArray();
        foreach ($data as $key => $row) {
            $data[$key]["created"] = $row->created->format("Y-m-d H:i:s");   
            $data[$key]["modified"] = $row->modified->format("Y-m-d H:i:s"); 
        }            
        $this->response->body(json_encode($data));
    }  
       
}
