<?php
namespace App\Controller\Api\Fito;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use App\View\Helper\FunctionsHelper;

class BankSeedController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('BankSeed');
        $this->CurrentModel = $this->BankSeed;
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
        if ($entity['harvestdate'] == 0) $entity['harvestdate'] = null;
        if ($entity['bags'] == 0) $entity['bags'] = null;
        if ($entity['seednumb'] == 0) $entity['seednumb'] = null;
        if ($entity['seedpro'] == 0) $entity['seedpro'] = null;
        if ($entity['seedsto'] == 0) $entity['seedsto'] = null;
        if ($entity['typeref'] == 0) $entity['typeref'] = null;
        if ($entity['typemat'] == 0) $entity['typemat'] = null;
        if ($entity['germination'] == 0) $entity['germination'] = null;
        if ($entity['discnumb'] == 0) $entity['discnumb'] = null;
        if ($entity['n1'] == 0) $entity['n1'] = null;
        if ($entity['n2'] == 0) $entity['n2'] = null;
        if ($entity['n3'] == 0) $entity['n3'] = null;
        if ($entity['n4'] == 0) $entity['n4'] = null;
        if ($entity['n5'] == 0) $entity['n5'] = null;
        if ($entity['storage'] == 0) $entity['storage'] = null;
        if ($entity['temp'] == 0) $entity['temp'] = null;
        if ($entity['humidity'] == 0) $entity['humidity'] = null;
        if ($entity['ciclo'] == 0) $entity['ciclo'] = null;
        if ($entity['time'] == 0) $entity['time'] = null;
        if ($entity['performance'] == 0) $entity['performance'] = null;
    }

    public function add()
    {
        $data= $this->request->data;
        $data['cod_per'] = '1';
        $data['status'] = '1';
        $data['bank_availability'] = '1';
        $data['realweight'] = round($data['p1'] + $data['p2'] + $data['p3'] + $data['p4'] + $data['p5'],2);
        // echo(json_encode($data['realweight'])); die();
        $data['acqdate'] = $data['acqdate'] == null ? "": date("Y-m-d",strtotime($data['acqdate']));

        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->newEntity();
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity->errors());
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de Semillas',[]);
        }

        /****  Carga de Imagenes  ***/
        $dir_subida = 'pass_fitogenetico/banco_semilla/';

        $result_entity['lotnumb'] = $result_entity['id'];

        // echo json_encode($result_entity);
        // die();

        /********* Imagen 1 *********/
        if(isset($data['accimag1']) && strlen(trim($data['accimag1']))>50){

            $data['accimag1'] = base64_decode($data['accimag1']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($dir_subida.$result_entity['id'].'_1.jpg', $data['accimag1']);
            $result_entity['accimag1'] = $dir_subida.$result_entity['id'].'_1.jpg';
        }

        /********* Imagen 2 *********/
        if(isset($data['accimag2']) && strlen(trim($data['accimag2']))>50){

            $data['accimag2'] = base64_decode($data['accimag2']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($dir_subida.$result_entity['id'].'_2.jpg', $data['accimag2']);
            $result_entity['accimag2'] = $dir_subida.$result_entity['id'].'_2.jpg';
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

        $data['realweight'] = round($data['p1'] + $data['p2'] + $data['p3'] + $data['p4'] + $data['p5'],2);
        $data['acqdate'] = $data['acqdate'] == null ? "": date("Y-m-d",strtotime($data['acqdate']));

        // La validacion del Pasaporte esta en el Movil

        $entity = $this->CurrentModel->get($id);
        $entity = $this->CurrentModel->patchEntity($entity, $data);
        $this->zerotoNull($entity);
        $result_entity = $this->CurrentModel->save($entity);

        // echo json_encode($entity->errors());
        // die();

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede editar el Banco de Semillas',[]);
        }

        $dir_subida = 'pass_fitogenetico/banco_semilla/';

        /********* Imagen 1 *********/
        if(isset($data['accimag1']) && strlen(trim($data['accimag1']))>50){

            $data['accimag1'] = base64_decode($data['accimag1']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($dir_subida.$result_entity['id'].'_1.jpg', $data['accimag1']);
            $result_entity['accimag1'] = $dir_subida.$result_entity['id'].'_1.jpg';
        }

        /********* Imagen 2 *********/
        if(isset($data['accimag2']) && strlen(trim($data['accimag2']))>50){

            $data['accimag2'] = base64_decode($data['accimag2']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($dir_subida.$result_entity['id'].'_2.jpg', $data['accimag2']);
            $result_entity['accimag2'] = $dir_subida.$result_entity['id'].'_2.jpg';
        }

        $result_entity = $this->CurrentModel->save($result_entity);

        if (!$result_entity) {
            return $this->Functions->api_error($this->response,'No se puede agregar el Banco de Semillas',[]);
        }

        return $this->view($id);
    }

}