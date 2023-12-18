<?php
namespace App\Controller\Api\Micro;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use App\View\Helper\FunctionsHelper;

class BankMicroController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('BankMicro');
        $this->CurrentModel = $this->BankMicro;
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
            $data[$key]["acqdate"] = $row->acqdate== null ? "" : $row->acqdate->format("Y-m-d");
            $data[$key]["reacdate"] = $row->reacdate == null ? "" : $row->reacdate->format("Y-m-d");
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
        $entity["reacdate"] = $entity->reacdate == null ? "" : $entity->reacdate->format("Y-m-d");
        $entity["created"] = $entity->created->format("Y-m-d H:i:s");
        $entity["modified"] = $entity->modified->format("Y-m-d H:i:s");

        $this->response->body(json_encode($entity));
        return $this->response;
    }

    private function zerotoNull($entity){

        if ($entity['risk'] == 0) $entity['risk'] = null;
        if ($entity['lablevel'] == 0) $entity['lablevel'] = null;
        if ($entity['reactivation'] == 0) $entity['reactivation'] = null;
        if ($entity['isolamed_1'] == 0) $entity['isolamed_1'] = null;
        if ($entity['isolamed_2'] == 0) $entity['isolamed_2'] = null;
        if ($entity['gramstain'] == 0) $entity['gramstain'] = null;
        if ($entity['lactobluestain'] == 0) $entity['lactobluestain'] = null;

    }

    public function add()
    {
        $data= $this->request->data;
        $data['pasaporte'] = '1';
        $data['cod_per'] = '1';
        $data['status'] = '1';
        $data['bank_availability'] = '1';
        // $data['stock']= $data['tubenumb']*$data['explnumb'];
        $data['acqdate'] = $data['acqdate'] == null ? "": date("Y-m-d",strtotime($data['acqdate']));
        $data['reacdate'] = $data['reacdate'] == null ? "": date("Y-m-d",strtotime($data['reacdate']));

        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->newEntity();
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity->errors());
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de Microorganismos',[]);
        } 

        $result_entity['lotnumb'] = $result_entity['id'];
        
        $result_entity = $this->CurrentModel->save($result_entity);

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de Microorganismos',[]);
        }
        return $this->view($result_entity->id);
    }

    public function edit($id='')
    {
        $data= $this->request->data;
        $data['cod_per'] = '1';
        // $data['stock']= $data['tubenumb']*$data['explnumb'];
        $data['acqdate'] = date("Y-m-d",strtotime($data['acqdate']));
        $data['reacdate'] = date("Y-m-d",strtotime($data['reacdate']));
        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->get($id);
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity);
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede editar el Banco de Microorganismos',[]);
        }
        return $this->view($id);
    }

}