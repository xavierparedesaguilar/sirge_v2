<?php
namespace App\Controller\Api\Fito;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use App\Model\Entity\Passport;
use App\Model\Entity\PassportFito;
use App\View\Helper\FunctionsHelper;

class PassportController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('PassportFito');
        $this->loadModel('Passport');

    }

    public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');

        if (isset($update)){

            /*Inner Join [Modelo.campo]*/
            $params["PassportFito.modified >="] = $update;
        }

        $data = $this->PassportFito->find('all')->where(['resource_id'=>1 , $params])->contain(['Passport'])->toArray();
        foreach ($data as $key => $row) {
            $data[$key]["created"]  = ($row->created == NULL) ? NULL : $row->created->format("Y-m-d H:i:s");
            $data[$key]["modified"] = ($row->modified == NULL) ? NULL : $row->modified->format("Y-m-d H:i:s");
            $data[$key]["passport"]["created"]  = ($row->passport->created == NULL) ? NULL : $row->passport->created->format("Y-m-d H:i:s");
            $data[$key]["passport"]["modified"] = ($row->passport->modified == NULL) ? NULL : $row->passport->modified->format("Y-m-d H:i:s");
            $data[$key]["acqdate"]  = ($row->acqdate == NULL) ? NULL : $row->acqdate->format("Y-m-d");
            $data[$key]["colldate"] = ($row->colldate == NULL) ? NULL : $row->colldate->format("Y-m-d");
            $data[$key]["passport"]["accname"] = ($row->passport->accname == NULL) ? "" : $row->passport->accname;
            $data[$key]["passport"]["othenumb"] = ($row->passport->othenumb == NULL) ? "" : $row->passport->othenumb;

        }
        $this->response->body(json_encode($data));


    }

    public function view($id = null)
    {
        $passport_fito = $this->PassportFito->find()->where(['id' => $id])->first();


        if (!isset($passport_fito)){

            return $this->Functions->api_error($this->response,'No existe el Pasaporte',[]);
        }

        $passport = $this->Passport->find()->where(['id' => $passport_fito['passport_id']])->first();

        $data = $passport_fito;
        $data['passport'] = $passport;
        $data['passport']["created"] =($passport->created == NULL) ? NULL : $passport->created->format("Y-m-d H:i:s");
        $data['passport']["modified"] = ($passport->modified == NULL) ? NULL : $passport->modified->format("Y-m-d H:i:s");
        $data["created"] = ($passport_fito->created == NULL) ? NULL : $passport_fito->created->format("Y-m-d H:i:s");
        $data["modified"] = ($passport_fito->modified == NULL) ? NULL : $passport_fito->modified->format("Y-m-d H:i:s");
        $data["acqdate"] = ($passport_fito->acqdate == NULL) ? NULL : $passport_fito->acqdate->format("Y-m-d");
        $data["colldate"] = ($passport_fito->colldate == NULL) ? NULL : $passport_fito->colldate->format("Y-m-d");
        $data["accname"] = ($passport->accname == NULL) ? "" : $passport->accname;
        $data["othenumb"] = ($passport->othenumb == NULL) ? "" : $passport->othenumb;

        $this->response->body(json_encode($data));
        return $this->response;

    }

    public function add()
    {
        $passport_fito = $this->PassportFito->newEntity();
        $passport = $this->Passport->newEntity();

        if ($this->request->is('post')) {

            $dataSource = \Cake\Datasource\ConnectionManager::get('default');
            $dataSource->begin();

            $data =  $this->request->getData();

            $data['passport']['accenumb'] = 'PER1'.str_pad($passport_fito->passfitogenetico, 6, "0", STR_PAD_LEFT);
            $data['passport']['resource_id'] = '1';
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

            // $data['passport_id'] = $passport['id'];

            /****  Carga de Imagenes  ***/
            $dir_subida = WWW_ROOT.'/pass_fitogenetico/';

            /********* Imagen 1 *********/
            if(isset($data['accimag1']) && strlen(trim($data['accimag1']))>50){

                $data['accimag1'] = base64_decode($data['accimag1']);
                //escribimos la información obtenida en un archivo llamado
                file_put_contents('pass_fitogenetico/'.$data['passport']['accenumb'].'_1.jpg', $data['accimag1']);
                $data['accimag1'] = 'pass_fitogenetico/'.$data['passport']['accenumb'].'_1.jpg';
            }


            /********* Imagen 2 *********/
            if(isset($data['accimag2']) && strlen(trim($data['accimag2']))>50){

                $data['accimag2'] = base64_decode($data['accimag2']);
                //escribimos la información obtenida en un archivo llamado
                file_put_contents('pass_fitogenetico/'.$data['passport']['accenumb'].'_2.jpg', $data['accimag2']);
                $data['accimag2'] = 'pass_fitogenetico/'.$data['passport']['accenumb'].'_2.jpg';
            }

            /******** Imagen 3 ********/
            if(isset($data['accimag3']) && strlen(trim($data['accimag3']))>50){

                $data['accimag3'] = base64_decode($data['accimag3']);
                //escribimos la información obtenida en un archivo llamado
                file_put_contents('pass_fitogenetico/'.$data['passport']['accenumb'].'_3.jpg', $data['accimag3']);
                $data['accimag3'] = 'pass_fitogenetico/'.$data['passport']['accenumb'].'_3.jpg';
            }


            /********* Imagen 4 *********/
            /*validos si existe la imagen*/
            if(isset($data['accimag4']) && strlen(trim($data['accimag4']))>50){

                $data['accimag4'] = base64_decode($data['accimag4']);
                //escribimos la información obtenida en un archivo llamado
                file_put_contents('pass_fitogenetico/'.$data['passport']['accenumb'].'_4.jpg', $data['accimag4']);
                $data['accimag4'] = 'pass_fitogenetico/'.$data['passport']['accenumb'].'_4.jpg';
            }

            $passport_fito = $this->PassportFito->patchEntity($passport_fito, $data);
            unset($passport_fito['passport_id']);
            $result_passport_fito = $this->PassportFito->save($passport_fito);


            if ($result_passport_fito) {

                $dataSource->commit();
                return $this->view($result_passport_fito->id);

            } else {
                $dataSource->rollback();

                echo json_encode($passport_fito->errors());
                die();

                return $this->Functions->api_error($this->response,"Error",[]);

            }

        }
    }

    public function edit($id = null)
    {
        $passport_fito = $this->PassportFito->get($id, [
            'contain' => ['Passport']
            ]);

        $passport = $this->Passport->get($passport_fito->passport_id, [
            'contain' => []
            ]);

        if ($this->request->is(['post', 'put'])) {

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

            /**** Grabamos el model Pasaporte ***/
                // $passport = $this->Passport->patchEntity($passport, $data['passport']);

                // $result_passport = $this->Passport->save($passport);

                // /****  Carga de Imagenes  ***/
            $dir_subida = WWW_ROOT.'/pass_fitogenetico/';

                //imagen png codificada en base64
                //eliminamos data:image/png; y base64, de la cadena que tenemos
                //hay otras formas de hacerlo
                // list(, $data['passport_fito']['accimag1']) = explode(';', $data['passport_fito']['accimag1']);
                // list(, $data['passport_fito']['accimag1']) = explode(',', $data['passport_fito']['accimag1']);
                //Decodificamos $Base64Img codificada en base64.
            $fecha = date('YmdHis');

            if(isset($data['accimag1']) && strlen(trim($data['accimag1']))>50){

                $data['accimag1'] = base64_decode($data['accimag1']);
                    //escribimos la información obtenida en un archivo llamado
                file_put_contents('pass_fitogenetico/'.$passport['accenumb'].'_1_'.$fecha.'.jpg', $data['accimag1']);
                $data['accimag1'] = 'pass_fitogenetico/'.$passport['accenumb'].'_1_'.$fecha.'.jpg';
            }


            if(isset($data['accimag2']) && strlen(trim($data['accimag2']))>50){

                $data['accimag2'] = base64_decode($data['accimag2']);
                file_put_contents('pass_fitogenetico/'.$passport['accenumb'].'_2.jpg', $data['accimag2']);
                $data['accimag2'] = 'pass_fitogenetico/'.$passport['accenumb'].'_2.jpg';
            }

            if(isset($data['accimag3']) && strlen(trim($data['accimag3']))>50){

                $data['accimag3'] = base64_decode($data['accimag3']);
                file_put_contents('pass_fitogenetico/'.$passport['accenumb'].'_3.jpg', $data['accimag3']);
                $data['accimag3'] = 'pass_fitogenetico/'.$passport['accenumb'].'_3.jpg';
            }

            if(isset($data['accimag4']) && strlen(trim($data['accimag4']))>50) {

                $data['accimag4'] = base64_decode($data['accimag4']);
                file_put_contents('pass_fitogenetico/'.$passport['accenumb'].'_4.jpg', $data['accimag4']);
                $data['accimag4'] = 'pass_fitogenetico/'.$passport['accenumb'].'_4.jpg';
            }

            $passport_fito = $this->PassportFito->patchEntity($passport_fito, $data);

            $result_passport_fito = $this->PassportFito->save($passport_fito);


            if ($result_passport_fito) {

                return $this->view($result_passport_fito->id);

            } else {

               return $this->Functions->api_error($this->response,"Error",[]);

           }

       }
   }
}