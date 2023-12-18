<?php
namespace App\Controller\Api\Zoo;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Passport;
use App\View\Helper\FunctionsHelper;
use App\Model\Entity\PassportZoo;


class PassportController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('PassportZoo');
        $this->loadModel('Passport');
        $this->modulo= "Datos de pasaporte";

    }

     public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');

        if (isset($update)){

            $params["PassportZoo.modified >="] = $update;
        }

            $data = $this->PassportZoo->find('all')->where(["resource_id" => 2,$params])->contain('Passport')->toArray();
            foreach ($data as $key => $row) {

                $data[$key]["acqdate"] = ($row->acqdate == NULL) ? NULL : $row->acqdate->format("Y-m-d");
                $data[$key]["colldate"] = ($row->colldate == NULL) ? NULL :  $row->colldate->format("Y-m-d");
                $data[$key]["datebirth"] = ($row->datebirth == NULL) ? NULL :  $row->datebirth->format("Y-m-d");
                $data[$key]["dateofdec"] = ($row->dateofdec == NULL) ? NULL :  $row->dateofdec->format("Y-m-d");
                $data[$key]["created"] = ($row->created == NULL) ? NULL :  $row->created->format("Y-m-d H:i:s");
                $data[$key]["modified"] = ($row->modified == NULL) ? NULL :  $row->modified->format("Y-m-d H:i:s");
                $data[$key]["passport"]["created"] = ($row->passport->created == NULL) ? NULL :  $row->passport->created->format("Y-m-d H:i:s");
                $data[$key]["passport"]["modified"] = ($row->passport->modified == NULL) ? NULL :  $row->passport->modified->format("Y-m-d H:i:s");
                $data[$key]["passport"]["accname"] = ($row->passport->accname == NULL) ? "" : $row->passport->accname;
                $data[$key]["passport"]["othenumb"] = ($row->passport->othenumb == NULL) ? "" : $row->passport->othenumb;
            }
            $this->response->body(json_encode($data));
    }

    public function view($id = null)
    {
        $passport_zoo = $this->PassportZoo->find()->where(['id' => $id])->first();

        if (!isset($passport_zoo)) {

            return $this->Functions->api_error($this->response,'No existe el Pasaporte',[]);
        }

        $passport = $this->Passport->find()->where(['id' => $passport_zoo['passport_id']])->first();
        $data = $passport_zoo;
        $data['passport'] = $passport;
        $data['passport']["created"] = ($passport->created == NULL) ? NULL : $passport->created->format("Y-m-d H:i:s");
        $data['passport']["modified"] = ($passport->modified == NULL) ? NULL : $passport->modified->format("Y-m-d H:i:s");
        $data["acqdate"]   = ($passport_zoo->acqdate == NULL) ? NULL : $passport_zoo->acqdate->format("Y-m-d");
        $data["colldate"]  = ($passport_zoo->colldate == NULL) ? NULL : $passport_zoo->colldate->format("Y-m-d");
        $data["datebirth"] = ($passport_zoo->datebirth == NULL) ? NULL : $passport_zoo->datebirth->format("Y-m-d");
        $data["dateofdec"] = ($passport_zoo->dateofdec == NULL) ? NULL : $passport_zoo->dateofdec->format("Y-m-d");
        $data["accname"] = ($passport->accname == NULL) ? "" : $passport->accname;
        $data["othenumb"] = ($passport->othenumb == NULL) ? "" : $passport->othenumb;

        $this->response->body(json_encode($data));
        return $this->response;

    }

    public function add()
    {

        $passport_zoo = $this->PassportZoo->newEntity();
        $passport = $this->Passport->newEntity();


        if ($this->request->is('post')) {

            $dataSource = \Cake\Datasource\ConnectionManager::get('default');

            $dataSource->begin();

            $data =  $this->request->getData();
            $data['passport']['accenumb'] = 'PER2'.str_pad($passport_zoo->passzoogenetico, 6, "0", STR_PAD_LEFT);
            $data['passport']['resource_id'] = '2';
            $data['passport']['status'] = '1';

            if ($data['passport']['ubigeo_id'] == 0) $data['passport']['ubigeo_id'] = "";
            if ($data['passport']['country_id'] == 0) $data['passport']['country_id'] = "";
            if ($data['passport']['resource_id'] == 0) $data['passport']['resource_id'] = "";
            if ($data['passport']['specie_id'] == 0) $data['passport']['specie_id'] = "";
            if ($data['passport']['station_current_id'] == 0) $data['passport']['station_current_id'] = "";
            if ($data['passport']['station_origin_id'] == 0) $data['passport']['station_origin_id'] = "";

            if ($data['passport']['country_id'] != 173) {
                $data['passport']['ubigeo_id'] = "";
            }

            // $passport = $this->Passport->patchEntity($passport,$data['passport']);
            // $result_passport = $this->Passport->save($passport);

            $data['passport_zoo']['passport_id'] = $passport['id'];

            /****  Carga de Imagenes  ***/
            $dir_subida = WWW_ROOT.'/webroot/pass_zoogenetico/';

            /********* Imagen 1 *********/
            if(isset($data['accimag1']) && strlen(trim($data['accimag1']))>50){

                $data['accimag1'] = base64_decode($data['accimag1']);
                file_put_contents('pass_zoogenetico/'.$data['passport']['accenumb'].'_1.jpg', $data['accimag1']);
                $data['accimag1'] = 'pass_zoogenetico/'.$data['passport']['accenumb'].'_1.jpg';
            }

             /********* Imagen 2 *********/
            if(isset($data['accimag2']) && strlen(trim($data['accimag2']))>50){

                $data['accimag2'] = base64_decode($data['accimag2']);
                file_put_contents('pass_zoogenetico/'.$data['passport']['accenumb'].'_2.jpg', $data['accimag2']);
                $data['accimag2'] = 'pass_zoogenetico/'.$data['passport']['accenumb'].'_2.jpg';
            }

            /******** Imagen 3 ********/
            if(isset($data['accimag3']) && strlen(trim($data['accimag3']))>50){

                $data['accimag3'] = base64_decode($data['accimag3']);
                file_put_contents('pass_zoogenetico/'.$data['passport']['accenumb'].'_3.jpg', $data['accimag3']);
                $data['accimag3'] = 'pass_zoogenetico/'.$data['passport']['accenumb'].'_3.jpg';
            }


            /********* Imagen 4 *********/
            /*validos si existe la imagen*/
            if(isset($data['accimag4']) && strlen(trim($data['accimag4']))>50){

                $data['accimag4'] = base64_decode($data['accimag4']);
                file_put_contents('pass_zoogenetico/'.$data['passport']['accenumb'].'_4.jpg', $data['accimag4']);
                $data['accimag4'] = 'pass_zoogenetico/'.$data['passport']['accenumb'].'_4.jpg';
            }


            $passport_zoo = $this->PassportZoo->patchEntity($passport_zoo,$data);
            unset($passport_zoo['passport_id']);
            $result_passport_zoo = $this->PassportZoo->save($passport_zoo);



            if ($result_passport_zoo) {

                $dataSource->commit();
                return $this->view($result_passport_zoo->id);

            } else {
// echo json_encode($passport_zoo->errors());
//              die();

                $dataSource->rollback();
                return $this->Functions->api_error($this->response,"Error",[]);

            }

        }

    }

    public function edit($id='')
    {
        $passport_zoo = $this->PassportZoo->get($id,['contain' => ['Passport']]);

        $passport = $this->Passport->get($passport_zoo->passport_id, ['contain' => []]);

        if ($this->request-> is(['post','put'])) {

            $data = $this->request->getData();

            if ($data['passport']['ubigeo_id'] == 0) $data['passport']['ubigeo_id'] = "";
            if ($data['passport']['country_id'] == 0) $data['passport']['country_id'] = "";
            if ($data['passport']['resource_id'] == 0) $data['passport']['resource_id'] = "";
            if ($data['passport']['specie_id'] == 0) $data['passport']['specie_id'] = "";
            if ($data['passport']['station_current_id'] == 0) $data['passport']['station_current_id'] = "";
            if ($data['passport']['station_origin_id'] == 0) $data['passport']['station_origin_id'] = "";

            if ($data['passport']['country_id'] != 173) {
                $data['passport']['ubigeo_id'] = "";
            }

            // $passport = $this->Passport->patchEntity($passport, $data['passport']);
            // $result_passport = $this->Passport->save($passport);

            /****  Carga de Imagenes  ***/
            $dir_subida = WWW_ROOT.'/webroot/pass_zoogenetico/';

            /********* Imagen 1 *********/
            if(isset($data['accimag1']) && strlen(trim($data['accimag1']))>50){

                $data['accimag1'] = base64_decode($data['accimag1']);
                file_put_contents('pass_zoogenetico/'.$passport['accenumb'].'_1.jpg', $data['accimag1']);
                $data['accimag1'] = 'pass_zoogenetico/'.$passport['accenumb'].'_1.jpg';
            }

            /********* Imagen 2 *********/
            if(isset($data['accimag2']) && strlen(trim($data['accimag2']))>50){

                $data['accimag2'] = base64_decode($data['accimag2']);
                file_put_contents('pass_zoogenetico/'.$passport['accenumb'].'_2.jpg', $data['accimag2']);
                $data['accimag2'] = 'pass_zoogenetico/'.$passport['accenumb'].'_2.jpg';
            }

            /********* Imagen 3 *********/
            if(isset($data['accimag3']) && strlen(trim($data['accimag3']))>50){

                $data['accimag3'] = base64_decode($data['accimag3']);
                file_put_contents('pass_zoogenetico/'.$passport['accenumb'].'_3.jpg', $data['accimag3']);
                $data['accimag3'] = 'pass_zoogenetico/'.$passport['accenumb'].'_3.jpg';
            }

            /********* Imagen 4 *********/
            if(isset($data['accimag4']) && strlen(trim($data['accimag4']))>50){

                $data['accimag4'] = base64_decode($data['accimag4']);
                file_put_contents('pass_zoogenetico/'.$passport['accenumb'].'_4.jpg', $data['accimag4']);
                $data['accimag4'] = 'pass_zoogenetico/'.$passport['accenumb'].'_4.jpg';
            }

            $passport_zoo = $this->PassportZoo->patchEntity($passport_zoo,$data);
            $result_passport_zoo = $this->PassportZoo->save($passport_zoo);
            $modulo = $this->modulo;
            //$this->Functions->saveLogAPI($this->request,$modulo,"EDITAR");
            //echo json_encode($passport_zoo->errors());
            //die();
            if ($result_passport_zoo) {

                return $this->view($result_passport_zoo->id);

            } else {

                return $this->Functions->api_error($this->response,"Error",[]);

            }

        }

    }
}