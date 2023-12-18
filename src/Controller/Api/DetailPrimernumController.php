<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class DetailPrimernumController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('DetailPrimernum');
        $this->CurrentModel = $this->DetailPrimernum;
    }


    public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');
        if (isset($update)){
            $params["modified >="] = $update;
        }

        $data = $this->CurrentModel->find('all')->where($params)->toArray();
        foreach ($data as $row) {
            $row["created"] = $row->created->format("Y-m-d H:i:s");
            $row["modified"] = $row->modified->format("Y-m-d H:i:s");
        }
        $this->response->body(json_encode($data));
    }



}
