<?php
namespace App\Controller\Api\Fito;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use App\View\Helper\FunctionsHelper;

class BankFieldController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('BankField');
        $this->CurrentModel = $this->BankField;
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
            $data[$key]["startdate"] = $row->startdate== null ? "" : $row->startdate->format("Y-m-d");
            $data[$key]["enddate"] = $row->enddate == null ? "" : $row->enddate->format("Y-m-d");
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

        $entity["startdate"] = $entity->startdate == null ? "" : $entity->startdate->format("Y-m-d");
        $entity["enddate"] = $entity->enddate == null ? "" : $entity->enddate->format("Y-m-d");
        $entity["created"] = $entity->created->format("Y-m-d H:i:s");
        $entity["modified"] = $entity->modified->format("Y-m-d H:i:s");

        $this->response->body(json_encode($entity));
        return $this->response;
    }

    private function zerotoNull($entity){
        if ($entity['sowsamptype'] == 0) $entity['sowsamptype'] = null;
        if ($entity['objective'] == 0) $entity['objective'] = null;
        if ($entity['plotsize'] == 0) $entity['plotsize'] = null;
        if ($entity['reps'] == 0) $entity['reps'] = null;
        if ($entity['dpto'] == 0) $entity['dpto'] = null;
        if ($entity['prov'] == 0) $entity['prov'] = null;
        if ($entity['dist'] == 0) $entity['dist'] = null;
        if ($entity['eea'] == 0) $entity['eea'] = null;
        if ($entity['plotnumb'] == 0) $entity['plotnumb'] = null;
        if ($entity['colname'] == 0) $entity['colname'] = null;
        if ($entity['species'] == 0) $entity['species'] = null;

    }

    public function add()
    {
        $data= $this->request->data;
        $data['pasaporte'] = '1';
        $data['cod_per'] = '1';
        $data['status'] = '1';
        $data['bank_availability'] = '1';
        // $data['stock']= $data['tubenumb']*$data['explnumb'];
        $data['startdate'] = $data['startdate'] == null ? "": date("Y-m-d",strtotime($data['startdate']));
        $data['enddate'] = $data['enddate'] == null ? "": date("Y-m-d",strtotime($data['enddate']));

        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->newEntity();
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity->errors());
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de Campo',[]);
        }

          /****  Carga de Imagenes  ***/
        $dir_subida = 'pass_fitogenetico/banco_campo/';

        $result_entity['expcode'] = $result_entity['id'];

        // echo json_encode($result_entity);
        // die();

        /********* Imagen 1 *********/
        if(isset($data['image1']) && strlen(trim($data['image1']))>50){

            $data['image1'] = base64_decode($data['image1']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($dir_subida.$result_entity['id'].'_1.jpg', $data['image1']);
            $result_entity['image1'] = $dir_subida.$result_entity['id'].'_1.jpg';
        }

        /********* Imagen 2 *********/
        if(isset($data['fieldmap']) && strlen(trim($data['fieldmap']))>50){

            $data['fieldmap'] = base64_decode($data['fieldmap']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($dir_subida.$result_entity['id'].'_map.jpg', $data['fieldmap']);
            $result_entity['fieldmap'] = $dir_subida.$result_entity['id'].'_map.jpg';
        }

        $result_entity = $this->CurrentModel->save($result_entity);

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de Semillas',[]);
        }

        return $this->view($result_entity->id);
    }

    public function edit($id='')
    {
        $data= $this->request->data;
        $data['cod_per'] = '1';
        // $data['stock']= $data['tubenumb']*$data['explnumb'];
        $data['startdate'] = $data['startdate'] == null ? "": date("Y-m-d",strtotime($data['startdate']));
        $data['enddate'] = $data['enddate'] == null ? "": date("Y-m-d",strtotime($data['enddate']));
        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->get($id);
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        if ($entity['passport_id']==0) unset($entity['passport_id']);
        $result_entity = $this->CurrentModel->save($entity);
        // echo (json_encode($entity));

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede editar el Banco de Campo',[]);
        }


          /****  Carga de Imagenes  ***/
        $dir_subida = 'pass_fitogenetico/banco_campo/';

        // echo json_encode($result_entity);
        // die();

        /********* Imagen 1 *********/
        if(isset($data['image1']) && strlen(trim($data['image1']))>50){

            $data['image1'] = base64_decode($data['image1']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($dir_subida.$result_entity['id'].'_1.jpg', $data['image1']);
            $result_entity['image1'] = $dir_subida.$result_entity['id'].'_1.jpg';
        }

        /********* Imagen 2 *********/
        if(isset($data['fieldmap']) && strlen(trim($data['fieldmap']))>50){

            $data['fieldmap'] = base64_decode($data['fieldmap']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($dir_subida.$result_entity['id'].'_map.jpg', $data['fieldmap']);
            $result_entity['fieldmap'] = $dir_subida.$result_entity['id'].'_map.jpg';
        }

        $result_entity = $this->CurrentModel->save($result_entity);

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de Semillas',[]);
        }

        return $this->view($id);
    }

}