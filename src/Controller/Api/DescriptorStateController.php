<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use App\View\Helper\FunctionsHelper;
use App\Model\Entity\DescriptorState;

class DescriptorStateController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('DescriptorState');
        $this->MyModel = $this->DescriptorState;
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

    public function view($id=null)
    {
         $descriptor_state = $this->DescriptorState->find()->where(['id' => $id])->first();

         if (!isset($descriptor_state)) {
             return $this->Functions->api_error($this->response,"No existe un estado descriptor",[]);
         }
        $descriptor_state["created"] =($descriptor_state->created == NULL) ? NULL : $descriptor_state->created->format("Y-m-d H:i:s");   
        $descriptor_state["modified"] = ($descriptor_state->modified == NULL) ? NULL : $descriptor_state->modified->format("Y-m-d H:i:s");
         $this->response->body(json_encode($descriptor_state));
         return $this->response;
     }

     public function add()
     {
         $data = $this->request->data;

         $descriptor_state = $this->DescriptorState->newEntity();
         $descriptor_state = $this->DescriptorState->patchEntity($descriptor_state,$data);
         $result_descriptor_state = $this->DescriptorState->save($descriptor_state);

         if (!$result_descriptor_state) {
                return $this->Functions->api_error($this->response,"No se puede agrefar el Estado Descriptor",[]);
            }
         return $this->view($result_descriptor_state->id);   

      }

      public function edit($id='')
      {
          $data = $this->request->data;
          $descriptor['status'] = '1';
          $descriptor_state = $this->DescriptorState->get($id);
          $descriptor_state = $this->DescriptorState->patchEntity($descriptor_state,$data);
          $result_descriptor_state = $this->DescriptorState->save($descriptor_state);

          if (!$result_descriptor_state) {
              return $this->Functions->api_error($this->response,"No se puede editar el Estado Descriptor",[]);
          }
          return $this->view($id);

      }   
       
}
