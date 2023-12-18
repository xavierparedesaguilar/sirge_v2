<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use App\View\Helper\FunctionsHelper;
use App\View\Helper\api_error;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;

class PhysicalController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('CaractPhysicalChemistry');
        $this->CurrentModel = $this->CaractPhysicalChemistry;

     }

    public function index()
    {
        $params = [];
        $update = $this->request->getQuery('update');
        if (isset($update)){
            $params["modified >="] = $update;
        }

        $data = $this->CurrentModel->find()->where($params)->toArray();
        foreach ($data as $row) {
            $row["created"] = $row->created->format("Y-m-d H:i:s");
            $row["modified"] = $row->modified->format("Y-m-d H:i:s");
        }
        $this->response->body(json_encode($data));
        return $this->response;
    }

    public function view($id=null)
    {
        $caract = $this->CaractPhysicalChemistry->find()->where(['id'=>$id])->first();

        if (!isset($caract)) {

            return $this->Functions->api_error($this->response,"No existe Características Fisicoquímicas",[]);
        }

        $this->response->body(json_encode($caract));
        return $this->response;
    }

    public function add()
    {
        $caract = $this->CaractPhysicalChemistry->newEntity();

        if ($this->request->is('post')){


        $data = $this->request->getData();
        $data['status'] = '1';


        /****  Carga de Archivos  ***/
        $dir_subida = WWW_ROOT.'pass_fitogenetico'.DS.'fisicoquimica'.DS;

        /********* Archivo 1 *********/
        if(isset($data['samplelist']) && strlen(trim($data['samplelist']))>50){



            $data['samplelist'] = base64_decode($data['samplelist']);
            file_put_contents('pass_fitogenetico/fisicoquimica/'.'samplelist_'.$caract->numeroDocumento.'.'.$data['samplelist_extension'], $data['samplelist']);
            $data['samplelist'] = 'pass_fitogenetico/fisicoquimica/'.'samplelist_'.$caract->numeroDocumento.'.'.$data['samplelist_extension'];

        }
        /********* Archivo 2 *********/
        if(isset($data['traitlist']) && strlen(trim($data['traitlist']))>50){

            $data['traitlist'] = base64_decode($data['traitlist']);
            file_put_contents('pass_fitogenetico/fisicoquimica/'.'traitlist_'.$caract->numeroDocumento.'.'.$data['traitlist_extension'], $data['traitlist']);
            $data['traitlist'] = 'pass_fitogenetico/fisicoquimica/'.'traitlist_'.$caract->numeroDocumento.'.'.$data['traitlist_extension'];
        }

        $caract = $this->CaractPhysicalChemistry->patchEntity($caract,$data);

        $result_caract = $this->CaractPhysicalChemistry->save($caract);

            if (!$result_caract) {

                return $this->Functions->api_error($this->response,"No se puede agregar la Característica Fisicoquímica",[]);
            }
        }
        return $this->view($result_caract->id);
    }

    public function edit($id=null)
    {
        //echo('hola'); die();
        $caract_physical = $this->CaractPhysicalChemistry->get($id,['contain'=>[]]);

        if ($this->request->is(['post','put'])) {

            $data = $this->request->getData();

            /****  Carga de Archivos  ***/
            $dir_subida = WWW_ROOT.'pass_fitogenetico'.DS.'fisicoquimica'.DS;

            /********* Imagen 1 *********/
            if(isset($data['samplelist']) && strlen(trim($data['samplelist']))>50){

                $data['samplelist'] = base64_decode($data['samplelist']);

                file_put_contents('pass_fitogenetico/fisicoquimica/'.'samplelist_'.$caract_physical->numeroDocumento.'.'.$data['samplelist_extension'], $data['samplelist']);
                $data['samplelist'] = 'pass_fitogenetico/fisicoquimica/'.'samplelist_'.$caract_physical->numeroDocumento.'.'.$data['samplelist_extension'];
            }
            /********* Imagen 2 *********/
            if(isset($data['traitlist']) && strlen(trim($data['traitlist']))>50){

                $data['traitlist'] = base64_decode($data['traitlist']);

                //escribimos la información obtenida en un archivo llamado
                file_put_contents('pass_fitogenetico/fisicoquimica/'.'traitlist_'.$caract_physical->numeroDocumento.'.'.$data['traitlist_extension'], $data['traitlist']);
                $data['traitlist'] = 'pass_fitogenetico/fisicoquimica/'.'traitlist_'.$caract_physical->numeroDocumento.'.'.$data['traitlist_extension'];

            }

            $caract_physical = $this->CaractPhysicalChemistry->patchEntity($caract_physical,$data);
            $result_caract = $this->CaractPhysicalChemistry->save($caract_physical);

             if (!$result_caract) {

                 return $this->Functions->api_error($this->response,"No se puede editar la Característica Fisicoquímica",[]);
             }
         return $this->view($id);
        }
    }
}
