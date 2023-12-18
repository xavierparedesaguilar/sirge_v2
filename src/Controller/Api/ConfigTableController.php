<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;

class ConfigTableController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ConfigTable');
        //$this->MyModel = $this->ConfigTable;
    }

    public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');
        if (isset($update)){
            //$params = [ "modified >=" => $update ];
            $params["modified >="] = $update;
        }

        $data = $this->ConfigTable->find('all')->where($params)->toArray();
        foreach ($data as $key => $row) {
            $data[$key]["created"] = $row->created->format("Y-m-d H:i:s");   
            $row["modified"] = $row->modified->format("Y-m-d H:i:s"); 
        }            
        $this->response->body(json_encode($data));
    } 
       
}
