<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\ORM\TableRegistry;

/**
 * CaractGenotypic Controller
 *
 * @property \App\Model\Table\CaractGenotypicTable $CaractGenotypic
 */
class CaractGenotypicMicroController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->mod_modulo = "Caraterización";
        $this->mod_parent = "Genotípica";
        $this->loadModel('CaractGenotypic');
        $this->loadModel('DetailAdaptrnum');
        $this->loadModel('DetailPrimernum');
        $this->loadModel('OptionList');
        $this->loadModel('Collection');

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => $this->name])->first();
        if(!empty($this->module))
          $this->permiso=$this->Functions->validarModulo($this->module->id);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        if($this->permiso['index']){

            $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
            $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                        'assets/js/datatable/dataTables.bootstrap.min',
                        'assets/js/datatable/dataTables.select.min'];

            $modulo  = $this->mod_modulo;
            $titulo  = $this->mod_parent;
            $permiso= $this->permiso;

            $caractGenotypic = $this->CaractGenotypic->find()->where(['status' => '1', 'resource_id' => 3])->all();

            $this->set(compact('caractGenotypic', 'styles', 'scripts', 'modulo', 'titulo','permiso'));
            $this->set('_serialize', ['caractGenotypic']);

        } else {

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect($this->Auth->redirectUrl());

        }


    }

    /**
     * View method
     *
     * @param string|null $id Caract Genotypic id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        if($this->permiso['view']){

            $caractGenotypic = $this->CaractGenotypic->find()->where(['CaractGenotypic.status' => '1','CaractGenotypic.id '=>$id,'CaractGenotypic.resource_id '=>3])->first();

            if($caractGenotypic ==NULL){

                    $this->Flash->error(__('Operación denegada.'));
                    return $this->redirect(['action' => 'index']);
            }

            $modulo  = $this->mod_modulo;
            $titulo  = $this->mod_parent;
            $permiso= $this->permiso;

            $this->set( compact('caractGenotypic', 'modulo', 'titulo','permiso'));
            $this->set('_serialize', ['caractGenotypic']);

        } else {

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

            $caractGenotypic = $this->CaractGenotypic->newEntity();
            $detailPrimernum = $this->DetailPrimernum->newEntity();
            $detailAdaptrnum = $this->DetailAdaptrnum->newEntity();

            if($this->permiso['add']){

                if ($this->request->is(['patch', 'post', 'put'])) {

                    $data = $this->request->getData();

                    $total_adaptrnum = 0;

                    if(!empty($data['DetailAdaptrnum'])){

                        foreach ($data['DetailAdaptrnum'] as $key => $value) {
                            if (!empty($value['adapter_name'])){
                                $total_adaptrnum ++;
                            }
                        }
                    }

                    $total_primernum = 0;

                    if(!empty($data['DetailPrimernum'])){

                        foreach ($data['DetailPrimernum'] as $key => $value) {
                            if (!empty($value['primers_name_one']) && !empty($value['primers_name_two']) && !empty($value['indicator_name']) && !empty($value['temperat'])){
                                $total_primernum ++;
                            }
                        }
                    }

                    $data['CaractGenotypic']['adaptrnum'] = $total_adaptrnum;
                    $data['CaractGenotypic']['primernum'] = $total_primernum;
                    $data['CaractGenotypic']['status'] = '1';
                    $data['CaractGenotypic']['resource_id'] = '3';

                    /****  Carga de Archivos  ***/
                    $dir_subida = WWW_ROOT.'pass_microorganismo'.DS.'genotipica'.DS;

                    if( $data['file_1']['type'] == 'text/plain' ){ $extension = '.txt'; } else { $extension = '.csv'; }
                    if( $data['file_2']['type'] == 'text/plain' ){ $extension_ = '.txt'; } else { $extension_ = '.csv'; }

                    /********* ARCHIVO 1 *********/
                    $data['file_1']['name'] =  'accenumb_'.$caractGenotypic->numeroDocumentoMicro.$extension;
                    $fichero_subido_1 = $dir_subida . basename($data['file_1']['name']);
                    if(move_uploaded_file($data['file_1']['tmp_name'], $fichero_subido_1))
                        $data['CaractGenotypic']['accenumb'] = 'pass_microorganismo/genotipica/'. 'accenumb_'.$caractGenotypic->numeroDocumentoMicro.$extension;

                    /********* ARCHIVO 2 *********/
                    $data['file_2']['name'] =  'datamatrix_'.$caractGenotypic->numeroDocumentoMicro.$extension_;
                    $fichero_subido_2 = $dir_subida . basename($data['file_2']['name']);
                    if(move_uploaded_file($data['file_2']['tmp_name'], $fichero_subido_2))
                        $data['CaractGenotypic']['datamatrix'] = 'pass_microorganismo/genotipica/'. 'datamatrix_'.$caractGenotypic->numeroDocumentoMicro.$extension_;

                    $caractGenotypic = $this->CaractGenotypic->patchEntity($caractGenotypic, $data['CaractGenotypic']);

                    if ($this->CaractGenotypic->save($caractGenotypic)) {

                        if(!empty($data['DetailAdaptrnum'])){

                            foreach ($data['DetailAdaptrnum'] as $key => $value) {
                                if (!empty($value['adapter_name'])){

                                    $temp  = TableRegistry::get('DetailAdaptrnum');
                                    $temp_adaptrnum = $temp->newEntity();
                                    $temp_adaptrnum->adapter_name = $value['adapter_name'];
                                    $temp_adaptrnum->status       = '1';
                                    $temp_adaptrnum->genotypic_id = $caractGenotypic->id;
                                    $temp->save($temp_adaptrnum);
                                }
                            }
                        }

                        if(!empty($data['DetailPrimernum'])){

                            foreach ($data['DetailPrimernum'] as $key => $value) {
                                if (!empty($value['primers_name_one']) && !empty($value['primers_name_two']) && !empty($value['indicator_name']) && !empty($value['temperat'])){

                                    $temp  = TableRegistry::get('DetailPrimernum');
                                    $temp_primernum = $temp->newEntity();
                                    $temp_primernum->primers_name_one = $value['primers_name_one'];
                                    $temp_primernum->primers_name_two = $value['primers_name_two'];
                                    $temp_primernum->indicator_name   = $value['indicator_name'];
                                    $temp_primernum->temperat         = $value['temperat'];
                                    $temp_primernum->status           = '1';
                                    $temp_primernum->genotypic_id     = $caractGenotypic->id;
                                    $temp->save($temp_primernum);
                                }
                            }
                        }

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-2)];
                        $action     = $list_module[(count($list_module)-1)];
                        $station_id = $caractGenotypic->id;
                        $recurso_id = '3';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Registro Genotípica creado satisfactoriamente.'));

                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al crear el Pasaporte Fitogenético. Por favor, Otra vez intente.'));
                }

                $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];
                $modulo  = $this->mod_modulo;
                $titulo  = $this->mod_parent;

                $coleccion          = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['resource_id' => 3, 'status' => 1, 'availability' => '1']);
                $marcador_molecular = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 421, 'OR' => [['resource_id' => 3], ['resource_id' => 4]] ]);
                $localizacion       = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 422, 'OR' => [['resource_id' => 3], ['resource_id' => 4]] ]);
                $enzima_restriccion = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 567, 'OR' => [['resource_id' => 1], ['resource_id' => 4]] ]);

                $this->set(compact('caractGenotypic', 'modulo', 'titulo', 'coleccion', 'marcador_molecular', 'localizacion', 'detailPrimernum',
                                   'detailAdaptrnum', 'scripts', 'enzima_restriccion'));
                $this->set('_serialize', ['caractGenotypic']);

        } else {
                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Caract Genotypic id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        if($this->permiso['edit']){

            $caractGenotypic =$this->CaractGenotypic->find()->where(['CaractGenotypic.status' => '1', 'CaractGenotypic.resource_id' => 3,'CaractGenotypic.id'=>$id])->first();

            if($caractGenotypic!=NULL){

                $detailAdaptrnum = $this->DetailAdaptrnum->find()->where(['genotypic_id' => $caractGenotypic->id, 'status' => '1'])->all();
                $detailPrimernum = $this->DetailPrimernum->find()->where(['genotypic_id' => $caractGenotypic->id, 'status' => '1'])->all();

                foreach ($detailAdaptrnum as $key => $value) {
                    $id_adaptrnum[] = $value['id'];
                }

                foreach ($detailPrimernum as $key => $value) {
                    $id_primernum[] = $value['id'];
                }

                if ($this->request->is(['patch', 'post', 'put'])) {

                    $data = $this->request->getData();

                    $total_adaptrnum = 0;

                    if(!empty($data['DetailAdaptrnum'])){

                        foreach ($data['DetailAdaptrnum'] as $key => $value) {
                            if (!empty($value['adapter_name'])){
                                $total_adaptrnum ++;
                            }
                        }
                    }

                    $total_primernum = 0;

                    if(!empty($data['DetailPrimernum'])){

                        foreach ($data['DetailPrimernum'] as $key => $value) {
                            if (!empty($value['primers_name_one']) && !empty($value['primers_name_two']) && !empty($value['indicator_name']) && !empty($value['temperat'])){
                                $total_primernum ++;
                            }
                        }
                    }

                    $data['CaractGenotypic']['adaptrnum'] = $total_adaptrnum;
                    $data['CaractGenotypic']['primernum'] = $total_primernum;

                    /****  Carga de Archivos  ***/
                    $dir_subida = WWW_ROOT.'pass_microorganismo'.DS.'genotipica'.DS;

                    if( $data['file_1']['type'] == 'text/plain' ){ $extension = '.txt'; } else { $extension = '.csv'; }
                    if( $data['file_2']['type'] == 'text/plain' ){ $extension_ = '.txt'; } else { $extension_ = '.csv'; }

                    /********* ARCHIVO 1 *********/
                    $data['file_1']['name'] =  'accenumb_'.$caractGenotypic->expnumb.$extension;
                    $fichero_subido_1 = $dir_subida . basename($data['file_1']['name']);
                    if(move_uploaded_file($data['file_1']['tmp_name'], $fichero_subido_1))
                        $data['CaractGenotypic']['accenumb'] = 'pass_microorganismo/genotipica/'. 'accenumb_'.$caractGenotypic->expnumb.$extension;

                    /********* ARCHIVO 2 *********/
                    $data['file_2']['name'] =  'datamatrix_'.$caractGenotypic->expnumb.$extension_;
                    $fichero_subido_2 = $dir_subida . basename($data['file_2']['name']);
                    if(move_uploaded_file($data['file_2']['tmp_name'], $fichero_subido_2))
                        $data['CaractGenotypic']['datamatrix'] = 'pass_microorganismo/genotipica/'. 'datamatrix_'.$caractGenotypic->expnumb.$extension_;

                    $caractGenotypic = $this->CaractGenotypic->patchEntity($caractGenotypic, $data['CaractGenotypic']);

                    if ($this->CaractGenotypic->save($caractGenotypic)) {

                        if(!empty($data['DetailAdaptrnum'])){

                            foreach ($data['DetailAdaptrnum'] as $key => $value) {
                                if (!empty($value['adapter_name'])){

                                    if(!isset($value['item'])){

                                        $temp  = TableRegistry::get('DetailAdaptrnum');
                                        $temp_adaptrnum = $temp->newEntity();
                                        $temp_adaptrnum->adapter_name = $value['adapter_name'];
                                        $temp_adaptrnum->status       = '1';
                                        $temp_adaptrnum->genotypic_id = $caractGenotypic->id;
                                        $temp->save($temp_adaptrnum);

                                    } else {

                                        $temp = TableRegistry::get('DetailAdaptrnum');
                                        $temp_adaptrnum = $temp->get([$value['item'], $caractGenotypic->id]);
                                        $temp_adaptrnum->adapter_name = $value['adapter_name'];
                                        $temp->save($temp_adaptrnum);

                                        foreach ($id_adaptrnum as $key => $val) {
                                            if($val == $value['item']){
                                                unset($id_adaptrnum[$key]);
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        if(!empty($id_adaptrnum)){
                            foreach ($id_adaptrnum as $key => $value) {
                                $temp = TableRegistry::get('DetailAdaptrnum');
                                $temp_adaptrnum = $temp->get([$value, $caractGenotypic->id]);
                                $temp_adaptrnum->status = '0';
                                $temp->save($temp_adaptrnum);
                            }
                        }

                        if(!empty($data['DetailPrimernum'])){

                            foreach ($data['DetailPrimernum'] as $key => $value) {
                                if (!empty($value['primers_name_one']) && !empty($value['primers_name_two']) && !empty($value['indicator_name']) && !empty($value['temperat'])){

                                    if(!isset($value['item'])){

                                        $temp  = TableRegistry::get('DetailPrimernum');
                                        $temp_primernum = $temp->newEntity();
                                        $temp_primernum->primers_name_one = $value['primers_name_one'];
                                        $temp_primernum->primers_name_two = $value['primers_name_two'];
                                        $temp_primernum->indicator_name   = $value['indicator_name'];
                                        $temp_primernum->temperat         = $value['temperat'];
                                        $temp_primernum->status           = '1';
                                        $temp_primernum->genotypic_id     = $caractGenotypic->id;
                                        $temp->save($temp_primernum);

                                    } else {

                                        $temp  = TableRegistry::get('DetailPrimernum');
                                        $temp_primernum = $temp->get([$value['item'], $caractGenotypic->id]);
                                        $temp_primernum->primers_name_one = $value['primers_name_one'];
                                        $temp_primernum->primers_name_two = $value['primers_name_two'];
                                        $temp_primernum->indicator_name   = $value['indicator_name'];
                                        $temp_primernum->temperat         = $value['temperat'];
                                        $temp->save($temp_primernum);

                                        foreach ($id_primernum as $key => $val) {
                                            if($val == $value['item']){
                                                unset($id_primernum[$key]);
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        if(!empty($id_primernum)){
                            foreach ($id_primernum as $key => $value) {
                                $temp = TableRegistry::get('DetailPrimernum');
                                $temp_primernum = $temp->get([$value, $caractGenotypic->id]);
                                $temp_primernum->status = '0';
                                $temp->save($temp_primernum);
                            }
                        }

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-3)];
                        $action     = $list_module[(count($list_module)-2)];
                        $station_id = $caractGenotypic->id;
                        $recurso_id = '3';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Registro Genotípica actualizado satisfactoriamente.'));

                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al actualizar el Pasaporte Fitogenético. Por favor, Otra vez intente.'));
                }

                $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];
                $modulo  = $this->mod_modulo;
                $titulo  = $this->mod_parent;

                $coleccion          = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['resource_id' => 3, 'status' => 1, 'availability' => '1']);
                $marcador_molecular = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 421, 'OR' => [['resource_id' => 3], ['resource_id' => 4]] ]);
                $localizacion       = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 422, 'OR' => [['resource_id' => 3], ['resource_id' => 4]] ]);
                $enzima_restriccion = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 567, 'OR' => [['resource_id' => 1], ['resource_id' => 4]] ]);

                $this->set(compact('caractGenotypic', 'scripts', 'modulo', 'titulo', 'coleccion', 'marcador_molecular', 'localizacion',
                                   'detailAdaptrnum', 'detailPrimernum', 'enzima_restriccion'));
                $this->set('_serialize', ['caractGenotypic']);

                } else {

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);

                }

        } else {

        $this->Flash->error(__('Operación denegada.'));
        return $this->redirect(['action' => 'index']);

        }


    }

    /**
     * Delete method
     *
     * @param string|null $id Caract Genotypic id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if($this->permiso['delete']){

            $this->request->is(['post', 'delete']);

            $caractGenotypic =$this->CaractGenotypic->find()->where(['CaractGenotypic.status' => '1', 'CaractGenotypic.resource_id' => 3,'CaractGenotypic.id'=>$id])->first();

                if($caractGenotypic==NULL){

                        $this->Flash->error(__('Operación denegada.'));
                        return $this->redirect(['action' => 'index']);

                }else{

                    $caractGenotypic['status'] = '0';

                    if ($this->CaractGenotypic->save($caractGenotypic)) {

                        if($caractGenotypic['adaptrnum'] > 0){

                            $list_adaptrnum = $this->DetailAdaptrnum->find()->where(['genotypic_id' => $caractGenotypic->id])->all();

                            foreach ($list_adaptrnum as $value) {
                                $adaptrnumTable = TableRegistry::get('DetailAdaptrnum');
                                $temp = $adaptrnumTable->get([$value->id, $caractGenotypic->id]);
                                $temp->status = '0';
                                $adaptrnumTable->save($temp);
                            }
                        }

                        if($caractGenotypic['primernum'] > 0){

                            $list_primernum = $this->DetailPrimernum->find()->where(['genotypic_id' => $caractGenotypic->id])->all();

                            foreach ($list_primernum as $key => $value) {
                                $primernumTable = TableRegistry::get('DetailPrimernum');
                                $temp = $primernumTable->get([$value->id, $caractGenotypic->id]);
                                $temp->status = '0';
                                $primernumTable->save($temp);
                            }
                        }

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-3)];
                        $action     = $list_module[(count($list_module)-2)];
                        $station_id = $caractGenotypic->id;
                        $recurso_id = '3';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Caracterización genotípica eliminado satisfactoriamente.'));

                    } else {

                        $this->Flash->error(__('Hubo inconvenientes al eliminar la Caracterización Genotípica. Por favor, Otra vez intente.'));
                    }

                    return $this->redirect(['action' => 'index']);
                }

        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);

        }

    }

    /*************************** METODOS PARA LA DESCARGA DE ARCHIVOS *****************************/
    public function exportaraccenumb($id = null)
    {


                $caractGenotypic =$this->CaractGenotypic->find()->where(['CaractGenotypic.status' => '1', 'CaractGenotypic.resource_id' => 3,'CaractGenotypic.id'=>$id])->first();

                if($caractGenotypic!=NULL) {

                        $filePath = WWW_ROOT .$caractGenotypic['accenumb'];

                        if(file_exists($filePath)){

                            $this->response->file($filePath , array('download'=> true));

                            return $this->response;

                        } else {

                            $this->Flash->error(__('No existe el archivo.'));
                            return $this->redirect(['action' => 'view', 'id' => $caractGenotypic->id]);
                        }

                } else {

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);

                }




    }

    public function exportardatamatrix($id = null)
    {
        $caractGenotypic =$this->CaractGenotypic->find()->where(['CaractGenotypic.status' => '1', 'CaractGenotypic.resource_id' => 3,'CaractGenotypic.id'=>$id])->first();

        if($caractGenotypic!=NULL){

                $filePath = WWW_ROOT .$caractGenotypic['datamatrix'];

                if(file_exists($filePath)){

                    $this->response->file($filePath , array('download'=> true));

                    return $this->response;

                } else {

                    $this->Flash->error(__('No existe el archivo.'));
                    return $this->redirect(['action' => 'view', 'id' => $caractGenotypic->id]);
                }

        } else {

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);

        }
    }

    public function exportartabla() {

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $filePath = WWW_ROOT .'reportes/'.$data['filename'].'.xlsx';

            if(file_exists($filePath)){

                $this->response->file($filePath , array('download'=> true));

                return $this->response;

            } else {

                $this->Flash->error(__('No existe el archivo.'));
                return $this->redirect(['action' => 'index']);
            }
        }
    }


}
