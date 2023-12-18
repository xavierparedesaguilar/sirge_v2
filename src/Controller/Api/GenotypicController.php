<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use App\View\Helper\FunctionsHelper;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use App\Model\Entity\CaractGenotypic;
use App\Model\Entity\DetailAdaptrnum;
use App\Model\Entity\DetailPrimernum;
use Cake\ORM\TableRegistry;

class GenotypicController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('CaractGenotypic');
        $this->loadModel('DetailAdaptrnum');
        $this->loadModel('DetailPrimernum');
        $this->CurrentModel = $this->CaractGenotypic;
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

            $adaptrnum = $this->DetailAdaptrnum->find()->where(['genotypic_id' => $row->id])->toArray();
            $primernum = $this->DetailPrimernum->find()->where(['genotypic_id' => $row->id])->toArray();

            $row['adaptrnum_detail'] = $adaptrnum;
            $row['primernum_detail'] = $primernum;

        }
        $this->response->body(json_encode($data));
        return $this->response;
    }

    public function view($id=null)
    {
        $genotypic = $this->CaractGenotypic->find()->where(['id' => $id])->first();
        $adaptrnum = $this->DetailAdaptrnum->find()->where(['genotypic_id' => $id])->toArray();
        $primernum = $this->DetailPrimernum->find()->where(['genotypic_id' => $id])->toArray();
        $genotypic['adaptrnum_detail'] = $adaptrnum;
        $genotypic['primernum_detail'] = $primernum;
        if (!isset($genotypic)) {
            return $this->Functions->api_error($this->response,"No existe",[]);
        }
        $this->response->body(json_encode($genotypic));
        return $this->response;
    }


    public function add() {

        $caractGenotypic = $this->CaractGenotypic->newEntity();
        $detailPrimernum = $this->DetailPrimernum->newEntity();
        $detailAdaptrnum = $this->DetailAdaptrnum->newEntity();


        if (!$this->request->is('post')) return;

        $dataSource = \Cake\Datasource\ConnectionManager::get('default');
        $dataSource->begin();
        $data = $this->request->getData();
        $caractGenotypic['adaptrnum'] = count($data['adaptrnum_detail']);
        $caractGenotypic['primernum'] = count($data['primernum_detail']);
        // $caractGenotypic['expnumb'] = $data['expnumb'];
        // echo(json_encode($caractGenotypic)); die();
        $data['status'] = '1';

        $caractGenotypic = $this->CaractGenotypic->patchEntity($caractGenotypic, $data);
        $savedGeno = $this->CaractGenotypic->save($caractGenotypic);
        $savedGeno = $this->CaractGenotypic->get($savedGeno['id']);


       if ($data['resource_id']==1) {
            /****  Carga de Archivos  ***/
            $dir_subida = WWW_ROOT.'pass_fitogenetico'.DS.'genotipica'.DS;
            $carpeta_genotipica = 'pass_fitogenetico';
        }

        if ($data['resource_id']==2) {
            /****  Carga de Archivos  ***/
            $dir_subida = WWW_ROOT.'pass_zoogenetico'.DS.'genotipica'.DS;
            $carpeta_genotipica = 'pass_zoogenetico';
        }

        if ($data['resource_id']==3) {
            /****  Carga de Archivos  ***/
            $dir_subida = WWW_ROOT.'pass_microorganismo'.DS.'genotipica'.DS;
            $carpeta_genotipica = 'pass_microorganismo';
        }


        /********* Imagen 1 *********/
        $id_last=$savedGeno['expnumb'];
        // echo(json_encode( $caractGenotypic->numeroDocumentoMicro));
        // die();
        if(isset($data['accenumb'])){

            $data['accenumb'] = base64_decode($data['accenumb']);
            //escribimos la información obtenida en un archivo llamado
            file_put_contents($carpeta_genotipica.'/genotipica/'. 'accenumb_'.$id_last.'.'.$data['accenumb_extension'], $data['accenumb']);
            $savedGeno['accenumb'] = $carpeta_genotipica.'/genotipica/'. 'accenumb_'.$id_last.'.'.$data['accenumb_extension'];
        }

        $savedGeno = $this->CaractGenotypic->save($savedGeno);

        foreach ($data['adaptrnum_detail'] as $value) {
            $base = $this->DetailAdaptrnum->newEntity();
            $temp = $this->DetailAdaptrnum->patchEntity($base, $value);
            $temp['status'] = 1;
            $temp['genotypic_id'] = $savedGeno['id'];
            $this->DetailAdaptrnum->save($temp);
        }

        foreach ($data['primernum_detail'] as $value){
            $base = $this->DetailPrimernum->newEntity();
            $temp = $this->DetailPrimernum->patchEntity($base, $value);
            $temp['status'] = 1;
            $temp['genotypic_id'] = $savedGeno['id'];
            $this->DetailPrimernum->save($temp);
        }


        if (!$savedGeno) {
            $dataSource->rollback();
            return $this->Functions->api_error($this->response,"No se puede crear",[]);
        }

        $dataSource->commit();
        return $this->view($savedGeno->id);
    }

    public function edit($id=null) {

        $caractGenotypic = $this->CaractGenotypic->get($id,['contain'=>[]]);
        $detailAdaptrnum = $this->DetailAdaptrnum->find()->where(['genotypic_id' => $caractGenotypic->id, 'status' => '1'])->all();
        $detailPrimernum = $this->DetailPrimernum->find()->where(['genotypic_id' => $caractGenotypic->id, 'status' => '1'])->all();

        if ($this->request->is(['post', 'put'])) {


            $data = $this->request->getData();



                if ($data['resource_id']==1) {
                    /****  Carga de Archivos  ***/
                    $dir_subida = WWW_ROOT.'pass_fitogenetico'.DS.'genotipica'.DS;
                    $carpeta_genotipica = 'pass_fitogenetico';
                }

                if ($data['resource_id']==2) {
                    /****  Carga de Archivos  ***/
                    $dir_subida = WWW_ROOT.'pass_zoogenetico'.DS.'genotipica'.DS;
                    $carpeta_genotipica = 'pass_zoogenetico';
                }

                if ($data['resource_id']==3) {
                    /****  Carga de Archivos  ***/
                    $dir_subida = WWW_ROOT.'pass_microorganismo'.DS.'genotipica'.DS;
                    $carpeta_genotipica = 'pass_microorganismo';
                }

                /********* Imagen 1 *********/
                // echo( $data['accenumb']);

                if(isset($data['accenumb']) && !strpos($data['accenumb'],"/genotipica/accenumb_")){
                    echo "AAA";
                    die();
                    $id_last = $caractGenotypic['expnumb'];
                    $data['accenumb'] = base64_decode($data['accenumb']);
                    //escribimos la información obtenida en un archivo llamado
                    file_put_contents($carpeta_genotipica.'/genotipica/'. 'accenumb_'.$id_last.'.'.$data['accenumb_extension'], $data['accenumb']);
                    $data['accenumb'] = $carpeta_genotipica.'/genotipica/'. 'accenumb_'.$id_last.'.'.$data['accenumb_extension'];
                }


            $caractGenotypic = $this->CaractGenotypic->patchEntity($caractGenotypic,$data);
            $result_genotypic = $this->CaractGenotypic->save($caractGenotypic);

            $adaptrFound = [];
            foreach ($data['adaptrnum_detail'] as $value) {
                $detailAdaptrnum = $this->DetailAdaptrnum->find()->where(['id'=> $value['id']])->first();


                if ($detailAdaptrnum != null) {
                    array_push($adaptrFound, $value['id']);
                    $detailAdaptrnum['adapter_name'] = $value['adapter_name'];
                    $this->DetailAdaptrnum->save($detailAdaptrnum);
                }else{
                    $temp = TableRegistry::get('DetailAdaptrnum');
                    $detailAdaptrnum = $temp->newEntity();
                    $detailAdaptrnum['adapter_name'] = $value['adapter_name'];
                    $detailAdaptrnum['status'] = 1;
                    $detailAdaptrnum['genotypic_id'] = $result_genotypic['id'];
                    $temp->save($detailAdaptrnum);
                }
            }

            // Delete not included adapters
            if (count($adaptrFound)>0) {
                $adaptrsToDelete = $this->DetailAdaptrnum->find()->where(['id not in'=> $adaptrFound,'genotypic_id'=>$id])->toArray();
                foreach ($adaptrsToDelete as $adaptr) {
                    $adaptr["status"] = 0;
                    $this->DetailAdaptrnum->save($adaptr);
                }
            }


            $primerFound = [];
            foreach ($data['primernum_detail'] as $value) {
                $detailPrimernum = $this->DetailPrimernum->find()->where(['id'=> $value['id']])->first();


                if ($detailPrimernum != null) {
                    array_push($primerFound, $value['id']);
                    $detailPrimernum['primers_name_one'] = $value['primers_name_one'];
                    $detailPrimernum['primers_name_two'] = $value['primers_name_two'];
                    $detailPrimernum['indicator_name'] = $value['indicator_name'];
                    $detailPrimernum['temperat'] = $value['temperat'];
                    $this->DetailPrimernum->save($detailPrimernum);
                }else{

                    $temp_1 = TableRegistry::get('DetailPrimernum');
                    $detailPrimernum = $temp_1->newEntity();
                    $detailPrimernum['primers_name_one'] = $value['primers_name_one'];
                    $detailPrimernum['primers_name_two'] = $value['primers_name_two'];
                    $detailPrimernum['indicator_name'] = $value['indicator_name'];
                    $detailPrimernum['temperat'] = $value['temperat'];
                    $detailPrimernum['status'] = 1;
                    $detailPrimernum['genotypic_id'] = $result_genotypic['id'];
                    $temp_1->save($detailPrimernum);
                }
            }

            if (count($primerFound)>0) {
                $primersToDelete = $this->DetailPrimernum->find()->where(['id not in'=> $primerFound,'genotypic_id'=>$id])->toArray();
                foreach ($primersToDelete as $primer) {
                    $primer["status"] = 0;
                    $this->DetailPrimernum->save($primer);
                }
            }



            if (!$result_genotypic) {
                return $this->Functions->api_error($this->response,"No se puede editar la caracteristica Genotipica",[]);
            }

            $caractGenotypic = $this->CaractGenotypic->get($id, [
                'contain' => ['DetailAdaptrnum','DetailPrimernum']
                ]);

            return $this->view($id);

        }
    }
}

