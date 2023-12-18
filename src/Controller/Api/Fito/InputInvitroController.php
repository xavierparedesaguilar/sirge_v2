<?php
namespace App\Controller\Api\Fito;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use App\View\Helper\FunctionsHelper;

class InputInvitroController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('InputInvitro');
        $this->CurrentModel = $this->InputInvitro;
    }
    public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');
        if (isset($update)){
            $params["modified >="] = $update;
        }

        $data = $this->CurrentModel->find('all')->where($params)->toArray();
        foreach ($data as $key => $row) {
            $data[$key]["enterdate"] = $row->enterdate == null? "" : $row->enterdate->format("Y-m-d");
            $data[$key]["created"] = $row->created->format("Y-m-d H:i:s");
            $data[$key]["modified"] = $row->modified->format("Y-m-d H:i:s");
        }

        $this->response->body(json_encode($data));
    }

    public function view($id=null)
    {
        $entity = $this->CurrentModel->find()->where(['id' => $id])->first();
        if (!isset($entity)) {
            return $this->Functions->api_error($this->response,"No existe",[]);
        }

        $entity["enterdate"] = $entity->enterdate == null? "" : $entity->enterdate->format("Y-m-d");
        $entity["created"] = $entity->created->format("Y-m-d H:i:s");
        $entity["modified"] = $entity->modified->format("Y-m-d H:i:s");

        $this->response->body(json_encode($entity));
        return $this->response;
    }

    private function zerotoNull($entity){
        if ($entity['tubentnumb'] == 0) $entity['tubentnumb'] = null;
        if ($entity['explentnumb'] == 0) $entity['explentnumb'] = null;
    }

    public function add()
    {
        $data= $this->request->data;
        $data['status'] = '1';
        $data['enterdate'] = $data['enterdate'] == null ? "": date("Y-m-d",strtotime($data['enterdate']));

        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->newEntity();
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity);
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Ingreso',[]);
        }
        return $this->view($result_entity->id);
    }

    public function edit($id='')
    {
        $data= $this->request->data;
        $data['enterdate'] = $data['enterdate'] == null ? "": date("Y-m-d",strtotime($data['enterdate']));

 // echo(json_encode($data)); die();
        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->get($id);
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);

        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity);
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede editar el Ingreso',[]);
        }
        return $this->view($id);
    }

}