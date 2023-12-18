<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;

/**
 * CataloguePassport Controller
 *
 * @property \App\Model\Table\CataloguePassportTable $CataloguePassport
 *
 * @method \App\Model\Entity\CataloguePassport[] paginate($object = null, array $settings = [])
 */
class CataloguePassportController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->modulo = "Catálogos";
        $this->loadModel('Resource');
        $this->loadModel('Passport');
        $this->loadModel('PassportFito');
        $this->loadModel('Collection');
        $this->loadModel('Specie');
        $this->loadModel('Descriptor');
        $this->loadModel('CatalogueCharacterization');

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => $this->name])->first();
        if(!empty( $this->module ))
          $this->permiso=$this->Functions->validarModulo($this->module->id);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {

        if($this->permiso['index']){

            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

            $mod_module   = $this->modulo;
            $permiso      = $this->permiso;
            $recursos     = $this->Resource->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id !=' => '4'])->all();
            $colecciones  = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['resource_id' => 1, 'availability' => 1, 'status' => 1])->order(['colname']);
            $species_list = $this->Specie->find('list', ['keyField' => 'id', 'valueField' => function ($model) { return mb_strtoupper($model->genus,'UTF-8').' '.mb_strtoupper($model->species,'UTF-8'); }])->where(['availability' => 1, 'status' => 1, 'collection_id' => 20])->order(['cropname']);

            if($this->request->is(['post', 'put']))
            {
                $data = $this->request->getData();

                if($data['tipo_catalogo'] == 1){

                    $action = $this->redirect(['action' => 'buscarPassport', 'id' => $data['recurso']]);

                } else {

                    $action = $this->redirect(['action' => 'buscarCaracterizacion', 'idx' => $data['recurso'], 'idy' => $data['coleccion'], 'idz' => $data['especie'] ]);
                }

                return $action;
            }
            else
            {
                $titulo = 'CAMPOS DE Recursos Fitogenéticos';

                $titulo_2 = 'DESCRIPTORES : Recursos Fitogenéticos - ACHIOTE - Bixa platycarpa ruiz ( Achiote )';

                $model = $this->getModel(1);

                $total_check_pass = 0;
                foreach ($model as $key => $value) {
                    if($value->availability == 1)
                        $total_check_pass ++;
                }

                $lista = $this->getDataTemporal(1);

                $list_catalagos = $this->getCaracterizacionTemporal(1, 20, 99);

                $columns_names = array('Cod. FAO', 'Cod. PER', 'Nombre de la Accesión', 'Código Accesión', 'Especie','Estación Experimental','Estación Experimental de Procedencia','País Origen', 'Ubigeo', 'Localidad','Colección', 'Promisoria', 'SubTipo de Recurso','Código de Colecta','Autoría de la Especie','Subtaxones','Autoría de los Subtaxones','Tipo Conservación','Fecha Aquisición','Ubicación del Sitio','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación','Incertidumbre de Coordenadas','Código del Instituto de Colecta','Nombre del Colector','Dirección del Colector','Misión de Colecta','Fuente','Fuente Detalle','Condición Biológica (Detalle)','Fecha de Recolección','Nombre local del material','Grupo Étnico','Tipo de Muestra','Número de Plantas Muestreadas','Tipo de Muestreo','Parte Útil de la Planta','Uso de la Planta','Área de la Colecta','Patógeno','Código del Donante','Nombre del Donante','Dirección del Donante','Código de Accesión del Donante','Humedad Ambiente','Temperatura Ambiente','Presión Atmosferica','Precipitación','Textura del Suelo','Pedregocidad del Suelo','Color del Suelo','PH del Suelo','Relieve del Suelo','Ancestro Materno','Ancestro paterno','Datos Ancestrales','Sistema Multilateral', 'Patente','Código del Instituto de Mejoramiento','Nombre del Instituto de Mejoramiento','Nombre del Lugar - duplicados de Seguridad','Ubicación - duplicados de Seguridad','Banco In vitro','Banco de Semillas','Banco Campo','Conservación In situ','Banco ADN','Anotaciones');

                for ($i=0; $i < count($lista); $i++) {
                    $lista_final[$lista[$i]] = $columns_names[$i];
                }

                $descriptores = $this->Descriptor->find()->innerJoinWith('Specie')->where(['Descriptor.resource_id' => 1, 'Descriptor.type' => 1, 'Descriptor.status' => 1, 'Specie.id' => 99, 'Specie.collection_id' => 20])->order(['Descriptor.name']);

                $this->set(compact('list_catalagos', 'total_check_pass', 'mod_module', 'recursos', 'model', 'lista_final', 'titulo', 'colecciones', 'species_list', 'titulo_2', 'descriptores', 'scripts'));
                return $this->render('/Admin/CataloguePassport/index');
            }

        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect($this->Auth->redirectUrl());

        }
    }

    /**
     * View method
     *
     * @param string|null $id Catalogue Passport id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function buscarPassport($id = null)
    {
        $model_recurso = $this->Resource->get($id);

        $mod_module = $this->modulo;

        $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

        $recursos     = $this->Resource->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id !=' => '4'])->all();
        $colecciones  = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['resource_id' => 1, 'availability' => 1, 'status' => 1])->order(['colname']);
        $species_list = $this->Specie->find('list', ['keyField' => 'id', 'valueField' => function ($model) { return mb_strtoupper($model->genus,'UTF-8').' '.mb_strtoupper($model->species,'UTF-8'); }])->where(['availability' => 1, 'status' => 1, 'collection_id' => 20])->order(['cropname']);

        $titulo_2 = 'DESCRIPTORES : Recursos Fitogenéticos - ACHIOTE - Bixa platycarpa ruiz ( Achiote )';

        $model = $this->getModel($id);

        $total_check_pass = 0;
        foreach ($model as $key => $value) {
            if($value->availability == 1)
                $total_check_pass ++;
        }

        $lista = $this->getDataTemporal($id);

        if($model_recurso->id == 1){

            $titulo = 'CAMPOS DE Recursos Fitogenéticos';

            $recurso_id = $model_recurso->id;

            $columns_names = array('Cod. FAO', 'Cod. PER', 'Nombre de la Accesión', 'Código Accesión', 'Especie','Estación Experimental','Estación Experimental de Procedencia','País Origen', 'Ubigeo', 'Localidad','Colección', 'Promisoria', 'SubTipo de Recurso','Código de Colecta','Autoría de la Especie','Subtaxones','Autoría de los Subtaxones','Tipo Conservación','Fecha Aquisición','Ubicación del Sitio','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación','Incertidumbre de Coordenadas','Código del Instituto de Colecta','Nombre del Colector','Dirección del Colector','Misión de Colecta','Fuente','Fuente Detalle','Condición Biológica (Detalle)','Fecha de Recolección','Nombre local del material','Grupo Étnico','Tipo de Muestra','Número de Plantas Muestreadas','Tipo de Muestreo','Parte Útil de la Planta','Uso de la Planta','Área de la Colecta','Patógeno','Código del Donante','Nombre del Donante','Dirección del Donante','Código de Accesión del Donante','Humedad Ambiente','Temperatura Ambiente','Presión Atmosferica','Precipitación','Textura del Suelo','Pedregocidad del Suelo','Color del Suelo','PH del Suelo','Relieve del Suelo','Ancestro Materno','Ancestro paterno','Datos Ancestrales','Sistema Multilateral', 'Patente','Código del Instituto de Mejoramiento','Nombre del Instituto de Mejoramiento','Nombre del Lugar - duplicados de Seguridad','Ubicación - duplicados de Seguridad','Banco In vitro','Banco de Semillas','Banco Campo','Conservación In situ','Banco ADN','Anotaciones');

            for ($i=0; $i < count($lista); $i++) {
                $lista_final[$lista[$i]] = $columns_names[$i];
            }

            $descriptores = $this->Descriptor->find()->innerJoinWith('Specie')->where(['Descriptor.resource_id' => 1, 'Descriptor.type' => 1, 'Descriptor.status' => 1, 'Specie.id' => 99, 'Specie.collection_id' => 20])->order(['name']);
            $list_catalagos = $this->getCaracterizacionTemporal(1, 20, 99);

            $this->set(compact('scripts', 'list_catalagos', 'mod_module', 'recursos', 'total_check_pass', 'model', 'lista_final', 'titulo', 'recurso_id', 'colecciones', 'species_list', 'titulo_2', 'descriptores'));

        } else if($model_recurso->id == 2){

            $titulo = 'CAMPOS DE Recursos Zoogenéticos';

            $recurso_id = $model_recurso->id;

            $columns_names = array('COD. FAO', 'Cod. PER', 'Nombre de la Accesión', 'Código Accesión', 'Especie','Estación Experimental','Estación Experimental de Procedencia','País Origen', 'Ubigeo', 'Localidad','Colección', 'Promisoria', 'SubTipo de Recurso','Código de Colecta','Autor Especie','SubTaxon','SubTaxon Autor','Tipo de Raza','Tipo Conservación','Fecha Aquisición','Referencia','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación','Código Colecta','Nombre Colector','Dirección Colector','Misión de Colecta','Nombre Local','Fecha de Recolección','Condición Biológica (Detalle)','Fuente','Fuente Detalle','Grupo Étnico','Fecha de Nacimiento','Fecha Deceso','Tipo de Muestra','Tipo Muestreo','Parte útiles del Animal','Uso del Animal','Patógeno','Área','Humedad Ambiente','Temperatura Ambiente','Presión Atmosférica','Precipitatión','Ancestro Materno','Ancestro Paterno','Datos Ancestrales','Criador (Propietario)','Dirección del Criador','Código del Donante','Nombre del Donante','Dirección del Donante','Sistema Multilateral','Patente','Código Instituto de Mejoramiento','Nombre Instituto de Mejoramiento','Nombre del lugar - duplicados de Seguridad','Ubicación - duplicados de Seguridad', 'Banco ADN', 'Anotaciones');

            for ($i=0; $i < count($lista); $i++) {
                $lista_final[$lista[$i]] = $columns_names[$i];
            }

            $descriptores = $this->Descriptor->find()->innerJoinWith('Specie')->where(['Descriptor.resource_id' => 1, 'Descriptor.type' => 1, 'Descriptor.status' => 1, 'Specie.id' => 99, 'Specie.collection_id' => 20])->order(['name']);
            $list_catalagos = $this->getCaracterizacionTemporal(1, 20, 99);

            $this->set(compact('scripts', 'list_catalagos', 'mod_module', 'recursos', 'total_check_pass', 'model', 'lista_final', 'titulo', 'recurso_id', 'colecciones', 'species_list', 'titulo_2', 'descriptores'));

        } else if($model_recurso->id == 3){

            $titulo = 'CAMPOS DE Recursos Microorganismos';

            $recurso_id = $model_recurso->id;

            $columns_names = array('COD. FAO', 'Cod. PER', 'Nombre de la Accesión', 'Código Accesión', 'Especie','Estación Experimental','Estación Experimental de Procedencia','País Origen', 'Ubigeo', 'Localidad', 'Colección', 'Promisoria', 'SubTipo de Recurso', 'Autoría de la Especie','SubTaxones','Autoría de los SubTaxones','Código del Instituto','Nombre de la Cepa','Tipo Conservación','Fecha Aquisición','Ubicación del Sitio','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación','Incertidumbre de Coordenadas','Código de Colecta','Nombre de Colector','Dirección de Colector','Misión de Colecta','Fuente','Fuente Detalle','Fuente de Aislamiento','Condición Biológica (Categoría)','Fecha de Recolección','Nombre Local del Material','Grupo Étnico','Tipo de Muestra','Nro. de Individuos Muestreados','Tipo de Muestreo','Uso de microorganismo','Humedad Ambiente','Temperatura del Suelo','Presión Atmosférica','Precipitación','Textura del Suelo','Pedregocidad del Suelo','Color del Suelo','PH del Suelo','Fisiografía','Relieve del Suelo','Temperatura del Suelo','Olor del Suelo','Fuente de Agua','Color del Agua','Temperatura del Agua','Olor del Agua','PH del Agua','Turbidez','Código del Donante','Nombre del Donante','Dirección del Donante','Código de Accesión del Donante','Género Especie Asociada','Especie Asociada','Nombre Local - Especie Asociada','Ancestro Materno','Ancestro paterno','Datos Ancestrales','Sistema Multilateral', 'Patente','Código del Instituto','Nombre del Instituto','Nomb. lugar - Duplicados de Seguridad','Ubicación - duplicados de Seguridad','Antagonistas','Riesgo Biológico','Historia de la Accesión','Medio de Aislamiento','Banco Micro', 'Banco ADN', 'Anotaciones');

            for ($i=0; $i < count($lista); $i++) {
                $lista_final[$lista[$i]] = $columns_names[$i];
            }

            $descriptores = $this->Descriptor->find()->innerJoinWith('Specie')->where(['Descriptor.resource_id' => 1, 'Descriptor.type' => 1, 'Descriptor.status' => 1, 'Specie.id' => 99, 'Specie.collection_id' => 20])->order(['name']);
            $list_catalagos = $this->getCaracterizacionTemporal(1, 20, 99);

            $this->set(compact('scripts', 'list_catalagos', 'mod_module', 'recursos', 'total_check_pass', 'model', 'lista_final', 'titulo', 'recurso_id', 'colecciones', 'species_list', 'titulo_2', 'descriptores'));
        }
    }

    public function buscarCaracterizacion($idx = null, $idy = null, $idz = null)
    {
        $model_recurso   = $this->Resource->get($idx);
        $model_coleccion = $this->Collection->get($idy);
        $model_especie   = $this->Specie->get($idz);

        $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

        $mod_module = $this->modulo;

        $recursos     = $this->Resource->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id !=' => '4'])->all();
        $colecciones  = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['resource_id' => 1, 'availability' => 1, 'status' => 1])->order(['colname']);
        $species_list = $this->Specie->find('list', ['keyField' => 'id', 'valueField' => function ($model) { return mb_strtoupper($model->genus,'UTF-8').' '.mb_strtoupper($model->species,'UTF-8'); }])->where(['availability' => 1, 'status' => 1, 'collection_id' => 20])->order(['cropname']);

        $model = $this->getModel($model_recurso->id);

        $total_check_pass = 0;
        foreach ($model as $key => $value) {
            if($value->availability == 1)
                $total_check_pass ++;
        }

        $lista = $this->getDataTemporal($model_recurso->id);

        if($model_recurso->id == 1){

            $titulo = 'CAMPOS DE Recursos Fitogenéticos';

            $titulo_2 = 'DESCRIPTORES : Recursos Fitogenéticos - '.$model_coleccion->colname.' - '.$model_especie->genus.' '.$model_especie->species.' ( '.$model_especie->cropname.' )';

            $recurso_id   = $model_recurso->id;
            $coleccion_id = $model_coleccion->id;
            $especie_id   = $model_especie->id;

            $list_catalagos = $this->getCaracterizacionTemporal($recurso_id, $coleccion_id, $especie_id);

            $columns_names = array('Cod. FAO', 'Cod. PER', 'Nombre de la Accesión', 'Código Accesión', 'Especie','Estación Experimental','Estación Experimental de Procedencia','País Origen', 'Ubigeo', 'Localidad','Colección', 'Promisoria', 'SubTipo de Recurso','Código de Colecta','Autoría de la Especie','Subtaxones','Autoría de los Subtaxones','Tipo Conservación','Fecha Aquisición','Ubicación del Sitio','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación','Incertidumbre de Coordenadas','Código del Instituto de Colecta','Nombre del Colector','Dirección del Colector','Misión de Colecta','Fuente','Fuente Detalle','Condición Biológica (Detalle)','Fecha de Recolección','Nombre local del material','Grupo Étnico','Tipo de Muestra','Número de Plantas Muestreadas','Tipo de Muestreo','Parte Útil de la Planta','Uso de la Planta','Área de la Colecta','Patógeno','Código del Donante','Nombre del Donante','Dirección del Donante','Código de Accesión del Donante','Humedad Ambiente','Temperatura Ambiente','Presión Atmosferica','Precipitación','Textura del Suelo','Pedregocidad del Suelo','Color del Suelo','PH del Suelo','Relieve del Suelo','Ancestro Materno','Ancestro paterno','Datos Ancestrales','Sistema Multilateral', 'Patente','Código del Instituto de Mejoramiento','Nombre del Instituto de Mejoramiento','Nombre del Lugar - duplicados de Seguridad','Ubicación - duplicados de Seguridad','Banco In vitro','Banco de Semillas','Banco Campo','Conservación In situ','Banco ADN','Anotaciones');

            for ($i=0; $i < count($lista); $i++) {
                $lista_final[$lista[$i]] = $columns_names[$i];
            }

            $descriptores = $this->Descriptor->find()->innerJoinWith('Specie')->where(['Descriptor.resource_id' => $model_recurso->id,
                                                                                       'Descriptor.type' => 1, 'Descriptor.status' => 1,
                                                                                       'Specie.id' => $model_especie->id,
                                                                                       'Specie.collection_id' => $model_coleccion->id])->order(['name']);

            $this->set(compact('scripts', 'list_catalagos', 'mod_module', 'recursos', 'total_check_pass', 'model', 'lista_final', 'titulo', 'especie_id', 'coleccion_id', 'recurso_id', 'descriptores', 'titulo_2', 'recursos', 'colecciones', 'species_list'));

        } else if($model_recurso->id == 2){

            $titulo = 'CAMPOS DE Recursos Zoogenéticos';

            $titulo_2 = 'DESCRIPTORES : Recursos Zoogenéticos - '.$model_coleccion->colname.' - '.$model_especie->genus.' '.$model_especie->species.' ( '.$model_especie->cropname.' )';

            $recurso_id   = $model_recurso->id;
            $coleccion_id = $model_coleccion->id;
            $especie_id   = $model_especie->id;

            $list_catalagos = $this->getCaracterizacionTemporal($recurso_id, $coleccion_id, $especie_id);

            $columns_names = array('COD. FAO', 'Cod. PER', 'Nombre de la Accesión', 'Código Accesión', 'Especie','Estación Experimental','Estación Experimental de Procedencia','País Origen', 'Ubigeo', 'Localidad','Colección', 'Promisoria', 'SubTipo de Recurso','Código de Colecta','Autor Especie','SubTaxon','SubTaxon Autor','Tipo de Raza','Tipo Conservación','Fecha Aquisición','Referencia','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación','Código Colecta','Nombre Colector','Dirección Colector','Misión de Colecta','Nombre Local','Fecha de Recolección','Condición Biológica (Detalle)','Fuente','Fuente Detalle','Grupo Étnico','Fecha de Nacimiento','Fecha Deceso','Tipo de Muestra','Tipo Muestreo','Parte útiles del Animal','Uso del Animal','Patógeno','Área','Humedad Ambiente','Temperatura Ambiente','Presión Atmosférica','Precipitatión','Ancestro Materno','Ancestro Paterno','Datos Ancestrales','Criador (Propietario)','Dirección del Criador','Código del Donante','Nombre del Donante','Dirección del Donante','Sistema Multilateral','Patente','Código Instituto de Mejoramiento','Nombre Instituto de Mejoramiento','Nombre del lugar - duplicados de Seguridad','Ubicación - duplicados de Seguridad', 'Banco ADN', 'Anotaciones');

            for ($i=0; $i < count($lista); $i++) {
                $lista_final[$lista[$i]] = $columns_names[$i];
            }

            $descriptores = $this->Descriptor->find()->innerJoinWith('Specie')->where(['Descriptor.resource_id' => $model_recurso->id,
                                                                                       'Descriptor.type' => 1, 'Descriptor.status' => 1,
                                                                                       'Specie.id' => $model_especie->id,
                                                                                       'Specie.collection_id' => $model_coleccion->id])->order(['name']);

            $this->set(compact('scripts', 'list_catalagos', 'mod_module', 'recursos', 'total_check_pass', 'model', 'lista_final', 'titulo', 'especie_id', 'coleccion_id', 'recurso_id', 'descriptores', 'titulo_2', 'recursos', 'colecciones', 'species_list'));

        } else if($model_recurso->id == 3){

            $titulo = 'CAMPOS DE Recursos Microorganismos';

            $titulo_2 = 'DESCRIPTORES : Recursos Microorganismos - '.$model_coleccion->colname.' - '.$model_especie->genus.' '.$model_especie->species.' ( '.$model_especie->cropname.' )';

            $recurso_id   = $model_recurso->id;
            $coleccion_id = $model_coleccion->id;
            $especie_id   = $model_especie->id;

            $list_catalagos = $this->getCaracterizacionTemporal($recurso_id, $coleccion_id, $especie_id);

            $columns_names = array('COD. FAO', 'Cod. PER', 'Nombre de la Accesión', 'Código Accesión', 'Especie','Estación Experimental','Estación Experimental de Procedencia','País Origen', 'Ubigeo', 'Localidad', 'Colección', 'Promisoria', 'SubTipo de Recurso', 'Autoría de la Especie','SubTaxones','Autoría de los SubTaxones','Código del Instituto','Nombre de la Cepa','Tipo Conservación','Fecha Aquisición','Ubicación del Sitio','Latitud','Longitud','Elevación','Tipo Coordenadas','Método de Georeferenciación','Incertidumbre de Coordenadas','Código de Colecta','Nombre de Colector','Dirección de Colector','Misión de Colecta','Fuente','Fuente Detalle','Fuente de Aislamiento','Condición Biológica (Categoría)','Fecha de Recolección','Nombre Local del Material','Grupo Étnico','Tipo de Muestra','Nro. de Individuos Muestreados','Tipo de Muestreo','Uso de microorganismo','Humedad Ambiente','Temperatura del Suelo','Presión Atmosférica','Precipitación','Textura del Suelo','Pedregocidad del Suelo','Color del Suelo','PH del Suelo','Fisiografía','Relieve del Suelo','Temperatura del Suelo','Olor del Suelo','Fuente de Agua','Color del Agua','Temperatura del Agua','Olor del Agua','PH del Agua','Turbidez','Código del Donante','Nombre del Donante','Dirección del Donante','Código de Accesión del Donante','Género Especie Asociada','Especie Asociada','Nombre Local - Especie Asociada','Ancestro Materno','Ancestro paterno','Datos Ancestrales','Sistema Multilateral', 'Patente','Código del Instituto','Nombre del Instituto','Nomb. lugar - Duplicados de Seguridad','Ubicación - duplicados de Seguridad','Antagonistas','Riesgo Biológico','Historia de la Accesión','Medio de Aislamiento','Banco Micro', 'Banco ADN', 'Anotaciones ','Ubigeo');

            for ($i=0; $i < count($lista); $i++) {
                $lista_final[$lista[$i]] = $columns_names[$i];
            }

            $descriptores = $this->Descriptor->find()->innerJoinWith('Specie')->where(['Descriptor.resource_id' => $model_recurso->id,
                                                                                       'Descriptor.type' => 1, 'Descriptor.status' => 1,
                                                                                       'Specie.id' => $model_especie->id,
                                                                                       'Specie.collection_id' => $model_coleccion->id])->order(['name']);

            $this->set(compact('scripts', 'list_catalagos', 'mod_module', 'recursos', 'total_check_pass', 'model', 'lista_final', 'titulo', 'especie_id', 'coleccion_id', 'recurso_id', 'descriptores', 'titulo_2', 'recursos', 'colecciones', 'species_list'));
        }
    }

    public function addPassport()
    {
        if($this->request->is(['post', 'put'])){

            $data = $this->request->getData();

            if(count($data) == 2){

                $model_catalogo = $this->CataloguePassport->find()->where(['resource_id' => $data['resource_id'], 'availability' => '1'])->all();

                foreach ($model_catalogo as $key => $value) {

                    if(!in_array($value->countryside, $data['passport'])){

                        $temp = TableRegistry::get('CataloguePassport');
                        $temp_passport = $temp->get($value->id);
                        $temp_passport->availability = '0';
                        $temp->save($temp_passport);

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-2)];
                        $action     = $list_module[(count($list_module)-1)];
                        $station_id = $temp_passport->id;
                        $recurso_id = '4';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);
                    }
                }

                foreach ($data['passport'] as $key => $value) {

                    $model = $this->CataloguePassport->find()->where(['countryside' => $value, 'resource_id' => $data['resource_id']])->first();

                    $temp = TableRegistry::get('CataloguePassport');
                    $temp_passport = $temp->get($model->id);
                    $temp_passport->availability = '1';
                    $temp->save($temp_passport);

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-2)];
                    $action     = $list_module[(count($list_module)-1)];
                    $station_id = $temp_passport->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);
                }

                $this->Flash->success(__('Catálogo creado satisfactoriamente.'));
                return $this->redirect(['action' => 'buscarPassport', 'id' => $data['resource_id']]);

            } else {

                $this->Flash->error(__('Por favor seleccione al menos una opción.'));
                return $this->redirect(['action' => 'buscarPassport', 'id' => $data['resource_id']]);
            }
        }
    }

    public function addCaracterizacion()
    {
        if($this->request->is(['post', 'put'])){

            $dataSource = \Cake\Datasource\ConnectionManager::get('default');

            $dataSource->begin();

            $data = $this->request->getData();

            if(count($data) > 3){

                $catalogos = $this->CatalogueCharacterization->find()->where(['resource_id' => $data['resource_id'], 'collection_id' => $data['collection_id'], 'specie_id' => $data['specie_id']]);

                if($catalogos->count() > 0){

                    foreach ($catalogos as $key => $value) {

                        if(!in_array($value->descriptor_id, $data['caracterizacion'])){
                            $temp = TableRegistry::get('CatalogueCharacterization');
                            $temp_caract = $temp->get($value->id);
                            $temp_caract->availability = '0';
                            $temp->save($temp_caract);

                        } else {

                            $temp = TableRegistry::get('CatalogueCharacterization');
                            $temp_caract = $temp->get($value->id);
                            $temp_caract->availability = '1';
                            $temp->save($temp_caract);
                        }
                    }

                    foreach ($catalogos as $key => $value) {

                        $temp_catalogos[] = $value->descriptor_id;
                    }

                    foreach ($data['caracterizacion'] as $key => $value) {

                        if(!in_array($value, $temp_catalogos)){

                            $model_descriptor = $this->Descriptor->get($value);

                            $temp = TableRegistry::get('CatalogueCharacterization');
                            $temp_caract = $temp->newEntity();
                            $temp_caract->descriptor_id   = $value;
                            $temp_caract->descriptor_name = $model_descriptor->name;
                            $temp_caract->resource_id     = $data['resource_id'];
                            $temp_caract->collection_id   = $data['collection_id'];
                            $temp_caract->specie_id       = $data['specie_id'];
                            $temp_caract->availability    = '1';

                            if(!$temp->save($temp_caract)){

                                $dataSource->rollback();
                                $this->Flash->error(__('Hubo inconvenientes al crear el Catálogo Caracterización. Por favor, otra vez intente.'));
                                return $this->redirect(['action' => 'buscarCaracterizacion', 'idx' => $data['resource_id'],
                                                                                             'idy' => $data['collection_id'],
                                                                                             'idz' => $data['specie_id'] ]);
                            }
                        }
                    }

                    $dataSource->commit();
                    $this->Flash->success(__('Catálogo Caracterización creado satisfactoriamente.'));
                    return $this->redirect(['action' => 'buscarCaracterizacion', 'idx' => $data['resource_id'],
                                                                                 'idy' => $data['collection_id'],
                                                                                 'idz' => $data['specie_id'] ]);

                } else {

                    foreach ($data['caracterizacion'] as $key => $value) {

                        $model_descriptor = $this->Descriptor->get($value);

                        $temp = TableRegistry::get('CatalogueCharacterization');
                        $temp_caract = $temp->newEntity();
                        $temp_caract->descriptor_id   = $value;
                        $temp_caract->descriptor_name = $model_descriptor->name;
                        $temp_caract->resource_id     = $data['resource_id'];
                        $temp_caract->collection_id   = $data['collection_id'];
                        $temp_caract->specie_id       = $data['specie_id'];
                        $temp_caract->availability    = '1';

                        if(!$temp->save($temp_caract)){

                            $dataSource->rollback();
                            $this->Flash->error(__('Hubo inconvenientes al crear el Catálogo Caracterización. Por favor, otra vez intente.'));
                            return $this->redirect(['action' => 'buscarCaracterizacion', 'idx' => $data['resource_id'],
                                                                                         'idy' => $data['collection_id'],
                                                                                         'idz' => $data['specie_id'] ]);
                        }
                    }

                    $dataSource->commit();
                    $this->Flash->success(__('Catálogo Caracterización creado satisfactoriamente.'));
                    return $this->redirect(['action' => 'buscarCaracterizacion', 'idx' => $data['resource_id'],
                                                                                 'idy' => $data['collection_id'],
                                                                                 'idz' => $data['specie_id'] ]);
                }

            } else {

                $this->Flash->error(__('Por favor seleccione al menos una opción.'));
                return $this->redirect(['action' => 'buscarCaracterizacion', 'idx' => $data['resource_id'],
                                                                             'idy' => $data['collection_id'],
                                                                             'idz' => $data['specie_id'] ]);
            }
        }
    }

    private function getCaracterizacionTemporal($resource_id, $collection_id, $specie_id){

        $validar = $this->CatalogueCharacterization->find()->where(['availability' => 1, 'resource_id' => $resource_id, 'collection_id' => $collection_id, 'specie_id' => $specie_id]);

        if($validar->count() > 0)
        {
            foreach ($validar as $key => $value) {
                $temp_u[] = $value->descriptor_id;
            }
        }
        else
        {
            $temp_u = [];
        }

        return $temp_u;
    }

    private function getDataTemporal($resource_id){

        $validar = $this->CataloguePassport->find()->where(['resource_id' => $resource_id])->all();

        if(count($validar) > 0)
        {
            foreach ($validar as $key => $value) {
                $temp_u[] = $value->countryside;
            }
        }
        else
        {
            $temp_u = [];
        }

        return $temp_u;
    }

    private function getModel($resource_id){

        $validar = $this->CataloguePassport->find()->where(['resource_id' => $resource_id])->all();

        if(count($validar) > 0) {
            $temp_u = $validar;
        } else {
            $temp_u = [];
        }

        return $temp_u;
    }


}
