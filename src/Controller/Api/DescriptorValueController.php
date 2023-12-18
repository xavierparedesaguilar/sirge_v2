<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use App\View\Helper\FunctionsHelper;
use App\Model\Entity\Descriptor;

class DescriptorValueController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('DescriptorValue');
        $this->loadModel('Descriptor');
        
        // $this->MyModel = $this->DescriptorValue;
    }

    public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');
        if (isset($update)){
            $params["modified >="] = $update;
        }

        $data = $this->DescriptorValue->find('all')->where($params)->toArray();
        foreach ($data as $key => $row) {
            $data[$key]["created"] = $row->created->format("Y-m-d H:i:s");   
            $data[$key]["modified"] = $row->modified->format("Y-m-d H:i:s"); 
        }            
        $this->response->body(json_encode($data));
    }

    public function view($id=null)
    {
        $descriptor_value = $this->DescriptorValue->find()->where(['id' => $id])->first();
        

        if (!isset($descriptor_value)) {
           return $this->Functions->api_error($this->response,"No existe el Descriptor",[]);

        }

        $descriptor_value["created"] =($descriptor_value->created == NULL) ? NULL : $descriptor_value->created->format("Y-m-d H:i:s");   
        $descriptor_value["modified"] = ($descriptor_value->modified == NULL) ? NULL : $descriptor_value->modified->format("Y-m-d H:i:s");
        $this->response->body(json_encode($descriptor_value));
        return $this->response;

    }

    public function add()
    {
        $data = $this->request->data;

        $descriptor_value = $this->DescriptorValue->newEntity();

        $descriptor_value = $this->DescriptorValue->patchEntity($descriptor_value,$data);
        $result_descriptor_value = $this->DescriptorValue->save($descriptor_value);
        
        
        if (!$result_descriptor_value) {
            return $this->Functions->api_error($this->response,"No se puede agregar el Valor de la Descripcion",[]);
        }
         
        return $this->view($result_descriptor_value->id);
    }

    public function edit($id='')
    {
        $data = $this->request->data;

        $descriptor_value = $this->DescriptorValue->get($id);
        $descriptor_value = $this->DescriptorValue->patchEntity($descriptor_value,$data);
        $result_descriptor_value = $this->DescriptorValue->save($descriptor_value);

        if (!$result_descriptor_value) {
            return $this->Functions->api_error($this->response,"No se puede editar el Valor de la Descripcion",[]);
        }
        return $this->view($id);

    }
     
}
