<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use App\View\Helper\FunctionsHelper;

class ExtractionDnaController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ExtractionDna');
        $this->CurrentModel = $this->ExtractionDna;
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
            $data[$key]["extdate"] = $row->extdate == null? "" : $row->extdate->format("Y-m-d");
            $data[$key]["shorconstime"] = $row->shorconstime == null? "" : $row->shorconstime->format("Y-m-d");
            $data[$key]["longconstime"] = $row->longconstime == null? "" : $row->longconstime->format("Y-m-d");
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

        $entity["extdate"] = $entity->extdate == null? "" : $entity->extdate->format("Y-m-d");
        $entity["shorconstime"] = $entity->shorconstime == null? "" : $entity->shorconstime->format("Y-m-d");
        $entity["longconstime"] = $entity->longconstime == null? "" : $entity->longconstime->format("Y-m-d");

        $entity["created"] = $entity->created->format("Y-m-d H:i:s");
        $entity["modified"] = $entity->modified->format("Y-m-d H:i:s");

        $this->response->body(json_encode($entity));
        return $this->response;
    }

    private function zerotoNull($entity){

        if ($entity['extmethod'] == 0) $entity['extmethod'] = null;
        if ($entity['buffer'] == 0) $entity['buffer'] = null;
        if ($entity['dnaqty'] == 0) $entity['dnaqty'] = null;
        if ($entity['conadnint'] == 0) $entity['conadnint'] = null;
        if ($entity['agaelec'] == 0) $entity['agaelec'] = null;
        if ($entity['shortmatnumb'] == 0) $entity['shortmatnumb'] = null;
        if ($entity['shortminstock'] == 0) $entity['shortminstock'] = null;
        if ($entity['shortstorage'] == 0) $entity['shortstorage'] = null;
        if ($entity['shortcrionumb'] == 0) $entity['shortcrionumb'] = null;
        if ($entity['longtermtype'] == 0) $entity['longtermtype'] = null;
        if ($entity['criovinumb'] == 0) $entity['criovinumb'] = null;
        if ($entity['crioviminstock'] == 0) $entity['crioviminstock'] = null;
        if ($entity['longstorage'] == 0) $entity['longstorage'] = null;
        if ($entity['longcrionumb'] == 0) $entity['longcrionumb'] = null;
        if ($entity['bank_dna_id'] == 0) $entity['bank_dna_id'] = null;
    }

    public function add()
    {
        $data= $this->request->data;
        $data['status'] = '1';
        $data['extdate'] = date("Y-m-d",strtotime($data['extdate']));
        $data['shorconstime'] = $data['shorconstime'] == null ? "": date("Y-m-d",strtotime($data['shorconstime']));
        $data['longconstime'] = $data['longconstime'] == null ? "": date("Y-m-d",strtotime($data['longconstime']));

        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->newEntity();
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity->errors());
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar la Extracción',[]);
        }
        return $this->view($result_entity->id);
    }

    public function edit($id='')
    {
        $data= $this->request->data;
        $data['extdate'] = date("Y-m-d",strtotime($data['extdate']));
        $data['shorconstime'] = $data['shorconstime'] == null ? "": date("Y-m-d",strtotime($data['shorconstime']));
        $data['longconstime'] = $data['longconstime'] == null ? "": date("Y-m-d",strtotime($data['longconstime']));

 // echo(json_encode($data)); die();
        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->get($id);
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);

        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity);
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede editar la Extracción',[]);
        }
        return $this->view($id);
    }

}