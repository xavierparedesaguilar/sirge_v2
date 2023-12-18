<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;

class SpecieController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Specie');
        $this->MyModel = $this->Specie;
    }

    public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');
        if (isset($update)){
            $params["modified >="] = $update;
        }

        $data = $this->MyModel->find('all')->where($params)->toArray();
        foreach ($data as $Key => $row) {
            $data[$Key]["created"] = $row->created->format("Y-m-d H:i:s");   
            $data[$Key]["modified"] = $row->modified->format("Y-m-d H:i:s"); 
        }            
        $this->response->body(json_encode($data));
    } 
}
