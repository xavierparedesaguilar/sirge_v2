<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;

class ConfigTableFitogeneticoController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->loadModel('PassportFito');
        $this->loadModel('Passport');
        $this->loadModel('ConfigTable');
    }

    public function index($value='')
    {
        $table_            = 'passport_fito';
        $generic_table     = 'passport';
        $description_table = "Pasaporte Fitogenetico";
        $mod_padre         = '$this->mod_parent';
        $mod_child         = '$this->mod_padre';
        $titulo            = "Datos Pasaporte";
        $resource_id       = 1;

        if ($this->request->is(['post','put']))
        {
            $count_1 = isset($this->request->data['passport'])? count($this->request->data['passport']) : 0 ;
            $count_2 = isset($this->request->data['passport_fito'])? count($this->request->data['passport_fito']) : 0 ;

            if (($count_1 + $count_2)>1) {

                $this->deleteData($table_,$resource_id);
                if (isset($this->request->data['passport'])) {
                    $data_passport = implode(",", $this->request->data['passport']);
                    $data_passport_1  =   [
                                            'table_name'  => $generic_table,
                                            'validation'  => $data_passport,
                                            'resource_id' => $resource_id,
                                            'created'     => date('Y-m-d H:i:s'),
                                            'modified'    => date('Y-m-d H:i:s'),
                                            'status' => 1
                                        ];
                    $passport_1 = $this->save_data($data_passport_1);
                }else{
                    $passport_1 = true;
                }
                if (isset($this->request->data['passport_fito'])) {
                    $data_passport_fito = implode(",", $this->request->data['passport_fito']);
                    $data_passport_2  =   [
                                        'table_name'  => $table_,
                                        'validation'  => $data_passport_fito,
                                        'resource_id' => $resource_id,
                                        'created'     => date('Y-m-d H:i:s'),
                                        'modified'    => date('Y-m-d H:i:s'),
                                        'status' => 1
                                    ];
                    $passport_2 = $this->save_data($data_passport_2);
                }else{
                    $passport_2 = true;
                }
                if ($passport_1 && $passport_2)
                {


                    $this->Flash->success(__('Se guardo los campos a validar de la tabla ' . $description_table));
                    return $this->redirect(['controller' => 'ConfigTableFitogenetico', 'action' => 'index']);

                }else{

                    $this->Flash->error(__('Ocurrió un inconveniente, por favor intentelo otra vez.'));
                    return $this->redirect(['controller' => 'ConfigTableFitogenetico', 'action' => 'index']);
                }
            } else {

                $this->Flash->error(__('Debe seleccionar como mínimo dos campos a validar de la tabla '.$description_table));
                return $this->redirect(['controller'=>'ConfigTableFitogenetico','action' => 'index']);
            }
        }else{

            $validar = $this->getDataTemporal($table_,$resource_id);
            $validar_2 = $this->getDataTemporal($generic_table,$resource_id);
            foreach ($validar_2 as $key => $value) {
                $validar[] = $value;
            }
            // print_r(json_encode($validar_2,JSON_PRETTY_PRINT));
            // die();
            //$validar = $validar_1+$validar_2;
            // $columns = array();
            $exclude = ['id', 'passport_id', 'collection_name', 'remarks', 'collsrcdet', 'created', 'modified','resource_id', 'accenumb', 'status', 'accimag1', 'accimag2', 'accimag3', 'accimag4', 'remarks1', 'remarks2', 'remarks3', 'remarks4'];

            $columns = $this->PassportFito->schema()->columns();
            $columns_passport = $this->Passport->schema()->columns();
			
            foreach ($columns_passport as $key => $column_){
                if (in_array($columns_passport[$key], $exclude)){
                    unset($columns_passport[$key]);
                }
            }

            foreach ($columns as $key => $column){
                if (in_array($columns[$key], $exclude)){
                        unset($columns[$key]);
                }
            }

            $final_lista = array_merge($columns_passport,$columns);
            $columns_names = array('COD. FAO','Nombre de la Accesión','Otro Código Accesión','Especie','Estación Experimental','Estación Experimental de Procedencia','País Origen','Ubigeo','Localidad', 'Promisoria', 'SubTipo de Recurso', 'Código Colecta', 'Autoría de la Especie','Subtaxones','Autoría de los Subtaxones','Tipo Conservación','Fecha Adquisición','Disponibilidad del Lote de la Accesión','Ubicación del Sitio','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación','Incertidumbre de Coordenadas','Código del Instituto de Colecta','Nombre del Colector','Dirección del Colector','Misión de Colecta','Fuente','Condición Biológica (Detalle)','Fecha de Recolección','Nombre local del material','Grupo Étnico','Tipo de Muestra','Número de Plantas Muestreadas','Tipo de Muestreo','Parte Útil de la Planta','Uso de la Planta','Área de la Colecta','Patógeno','Código del Donante','Nombre del Donante','Dirección del Donante','Código de Accesión del Donante','Humedad Ambiente','Temperatura Ambiente','Presión Atmosferica','Precipitación','Textura del Suelo','Pedregocidad del Suelo','Color del Suelo','PH del Suelo','Relieve del Suelo','Ancestro Materno','Ancestro paterno','Datos Ancestrales','Sistema Multilateral', 'Patente','Código del Instituto de Mejoramiento','Nombre del Instituto de Mejoramiento','Nombre del Lugar - duplicados de Seguridad','Ubicación - duplicados de Seguridad','Banco In vitro','Banco de Semillas','Banco Campo','Conservación In situ','Banco ADN','Anotaciones');
            

            for ($i=0; $i < count($final_lista); $i++) {
                $lista_final[$final_lista[$i]] = $columns_names[$i];
            }

            $this->set(compact('titulo', 'mod_padre', 'mod_child', 'columns', 'validar','table_','columns_passport', 'lista_final'));
            $this->render('/Admin/ConfigTable/pasaporte_fitogenetico');
        }
    }

    private function getDataTemporal($table_,$resource_id){
        $validar = $this->ConfigTable->find()->where(['table_name' => $table_, 'resource_id' => $resource_id, 'status' => 1])->first();
        $temp_u = (count($validar)>0) ? explode(',', $validar->validation) : [] ;
        return $temp_u;
    }

    private function deleteData($field_,$resource_id){
        $this->ConfigTable->updateAll(['status' => 0, 'modified' => date('Y-m-d H:i:s')], ['table_name'=>$field_, 'status' => 1]);
        $this->ConfigTable->updateAll(['status' => 0, 'modified' => date('Y-m-d H:i:s')], ['table_name'=>'passport','resource_id' => $resource_id, 'status' => 1]);
    }

    public function save_data($data)
    {
        $configTable = $this->ConfigTable->newEntity();
        $configTable = $this->ConfigTable->patchEntity($configTable, $data);
        if ($this->ConfigTable->save($configTable)) {
            return true;
        }
        return false;

    }
}