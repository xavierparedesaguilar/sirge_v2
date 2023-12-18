<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class ConfigTableZoogeneticoController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->loadModel('PassportZoo');
        $this->loadModel('Passport');
        $this->loadModel('ConfigTable');
    }

    public function index($value='')
    {
        $table_ = 'passport_zoo';
        $generic_table = 'passport';
        $description_table = "Pasaporte Zoogenetico";
        $mod_padre  = '$this->mod_parent';
        $mod_child  = '$this->mod_padre';
        $titulo     = "Datos Pasaporte";
        $resource_id = 2;
        if ($this->request->is(['post','put']))
        {

            $count_1 = isset($this->request->data['passport'])? count($this->request->data['passport']) : 0 ;
            $count_2 = isset($this->request->data['passport_zoo'])? count($this->request->data['passport_zoo']) : 0 ;

            if (($count_1 + $count_2)>1) {

                $this->deleteData($table_,$resource_id);
                if (isset($this->request->data['passport'])) {
                    $data_passport = implode(",", $this->request->data['passport']);
                    $data_passport_1  =   [
                                            'table_name' => $generic_table,
                                            'validation' => $data_passport,
                                            'resource_id' => $resource_id,
                                            'created' => date('Y-m-d H:i:s'),
                                            'modified' => date('Y-m-d H:i:s'),
                                            'status' => 1
                                        ];
                    $passport_1 = $this->save_data($data_passport_1);
                }else{
                    $passport_1 = true;
                }
                if (isset($this->request->data[$table_])) {
                    $data_passport_fito = implode(",", $this->request->data[$table_]);
                    $data_passport_2  =   [
                                        'table_name' => $table_,
                                        'validation' => $data_passport_fito,
                                        'resource_id' => $resource_id,
                                        'created' => date('Y-m-d H:i:s'),
                                        'modified' => date('Y-m-d H:i:s'),
                                        'status' => 1
                                    ];
                    $passport_2 = $this->save_data($data_passport_2);
                }else{
                    $passport_2 = true;
                }
                if ($passport_1 && $passport_2)
                {
                    $this->Flash->success(__('Se guardo los campos a validar de la tabla ' . $description_table));
                    return $this->redirect(['controller' => 'ConfigTableZoogenetico', 'action' => 'index']);

                }else{

                    $this->Flash->error(__('Ocurrió un inconveniente, por favor intentelo otra vez.'));
                    return $this->redirect(['controller' => 'ConfigTableZoogenetico', 'action' => 'index']);
                }

            } else {

                $this->Flash->error(__('Debe seleccionar como mínimo dos campos a validar de la tabla '.$description_table));
                return $this->redirect(['controller'=>'ConfigTableZoogenetico','action' => 'index']);
            }
        }else{
            $validar = $this->getDataTemporal($table_,$resource_id);
            $validar_2 = $this->getDataTemporal($generic_table,$resource_id);
            foreach ($validar_2 as $key => $value) {
                $validar[] = $value;
            }

            $exclude = ['id', 'passport_id'/*, 'ubigeo_id'*/, 'collection_name', 'created', 'modified','resource_id', 'accenumb', 'status', 'accimag1', 'accimag2', 'accimag3', 'accimag4', 'remarks1', 'remarks2', 'remarks3', 'remarks4','eea','eeaproc','genus','commonname','colname','husbname','species','collsrcdet'];

            $columns_passport = $this->Passport->schema()->columns();
            $columns = $this->PassportZoo->schema()->columns();

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

            $columns_names = array('COD. FAO','Nombre de la Accesión','Otro Código Accesión','Especie','Estación Experimental',
                'Estación Experimental de Procedencia','País Origen','Ubigeo','Localidad', 'Promisoria', 'SubTipo de Recurso',
                'Código Colecta','Autor Especie','SubTaxon','SubTaxon Autor','Tipo de Raza','Tipo Conservación','Fecha Ingreso',
                'Disponibilidad','Referencia','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación',
                'Código del Instituto de Colecta','Nombre Colector','Dirección Colector','Misión de Colecta','Nombre Local','Fecha de Recolección',
                'Condición Biológica (Detalle)','Fuente','Grupo Étnico','Fecha de Nacimiento','Fecha Deceso',
                'Tipo de Muestra','Tipo Muestreo','Parte útiles del Animal','Uso del Animal','Patógeno','Área','Humedad Ambiente',
                'Temperatura Ambiente','Presión Atmosférica','Precipitatión','Ancestro Materno','Ancestro Paterno','Datos Ancestrales',
                'Criador (Propietario)','Dirección del Criador','Código del Donante','Nombre del Donante','Dirección del Donante',
                'Sistema Multilateral','Patente','Código Instituto de Mejoramiento','Nombre Instituto de Mejoramiento',
                'Nombre del lugar - duplicados de Seguridad','Ubicación - duplicados de Seguridad', 'Banco ADN', 'Anotaciones');

            for ($i=0; $i < count($final_lista); $i++) {
                $lista_final[$final_lista[$i]] = $columns_names[$i];
            }

            $this->set(compact('titulo', 'mod_padre', 'mod_child', 'columns', 'validar','table_','columns_passport','lista_final'));
            $this->render('/Admin/ConfigTable/pasaporte_zoogenetico');
        }
    }

    private function getDataTemporal($table_,$resource_id){
        $validar = $this->ConfigTable->find()->where(['table_name' => $table_, 'resource_id' => $resource_id, 'status' => 1])->first();
        $temp_u = (count($validar)>0) ? explode(',', $validar->validation) : [] ;
        return $temp_u;
    }
    private function deleteData($field_,$resource_id){
        $this->ConfigTable->updateAll(['status' => 0], ['table_name'=>$field_]);
        $this->ConfigTable->updateAll(['status' => 0], ['table_name'=>'passport','resource_id' => $resource_id]);
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