<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use App\View\Helper\FunctionsHelper;

class BankDnaController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('BankDna');
        $this->CurrentModel = $this->BankDna;
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
            $data[$key]["acqdate"] = $row->acqdate == null ? "" : $row->acqdate->format("Y-m-d");
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

        $entity["acqdate"] = $entity->acqdate == null ? "" : $entity->acqdate->format("Y-m-d");
        $entity["created"] = $entity->created->format("Y-m-d H:i:s");
        $entity["modified"] = $entity->modified->format("Y-m-d H:i:s");

        $this->response->body(json_encode($entity));
        return $this->response;
    }

    private function zerotoNull($entity){
        if ($entity['type_resource'] == 0) $entity['type_resource'] = null;
    }

    public function add()
    {
        $data= $this->request->data;
        $data['pasaporte'] = '1';
        $data['status'] = '1';
        $data['bank_availability'] = '1';
        // $data['stock']= $data['tubenumb']*$data['explnumb'];
        $data['acqdate'] = $data['acqdate'] == null ? "": $data['acqdate'] == null ? "": date("Y-m-d",strtotime($data['acqdate']));

        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->newEntity();
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity->errors());
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de ADN',[]);
        }

        $result_entity['lotnumb'] = $result_entity['id'];

        $result_entity = $this->CurrentModel->save($result_entity);
        
        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de ADN',[]);
        }
        return $this->view($result_entity->id);
    }

    public function edit($id='')
    {
        $data= $this->request->data;
        $data['pasaporte'] = '1';
        // $data['stock']= $data['tubenumb']*$data['explnumb'];
        $data['acqdate'] = $data['acqdate'] == null ? "": date("Y-m-d",strtotime($data['acqdate']));

        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->get($id);
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity);
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede editar el Banco de ADN',[]);
        }
        return $this->view($id);
    }

}