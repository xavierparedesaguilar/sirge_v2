<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * CaractPhysicalChemistry Controller
 *
 * @property \App\Model\Table\CaractPhysicalChemistryTable $CaractPhysicalChemistry
 *
 * @method \App\Model\Entity\CaractPhysicalChemistry[] paginate($object = null, array $settings = [])
 */
class CaractPhysicalChemistryController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->mod_modulo = "Caraterización";
        $this->mod_parent = "FisicoQuímica";
        $this->loadModel('Collection');

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => $this->name])->first();
        if(!empty($this->module))
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

            $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
            $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                        'assets/js/datatable/dataTables.bootstrap.min',
                        'assets/js/datatable/dataTables.select.min'];

            $modulo  = $this->mod_modulo;
            $titulo  = $this->mod_parent;
            $permiso= $this->permiso;

            $caractPhysicalChemistry = $this->CaractPhysicalChemistry->find()->where(['status' => '1'])->all();

            $this->set(compact('caractPhysicalChemistry', 'styles', 'scripts', 'modulo', 'titulo','permiso'));
            $this->set('_serialize', ['caractPhysicalChemistry']);

        } else {

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect($this->Auth->redirectUrl());

       }
    }

    /**
     * View method
     *
     * @param string|null $id Caract Physical Chemistry id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $caractPhysicalChemistry = $this->CaractPhysicalChemistry->find()->where(['status' => '1','id'=>$id])->first();

        if($this->permiso['view'] && $caractPhysicalChemistry!=NULL){


            $modulo  = $this->mod_modulo;
            $titulo  = $this->mod_parent;
            $permiso= $this->permiso;

            $this->set( compact('caractPhysicalChemistry', 'modulo', 'titulo','permiso'));
            $this->set('_serialize', ['caractPhysicalChemistry']);

        } else {

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        if($this->permiso['add']){

                $caractPhysicalChemistry = $this->CaractPhysicalChemistry->newEntity();

                if ($this->request->is('post')) {

                    $data = $this->request->getData();

                    $data['status'] = '1';

                    /****  Carga de Archivos  ***/
                    $dir_subida = WWW_ROOT.'pass_fitogenetico'.DS.'fisicoquimica'.DS;

                    if( $data['file_1']['type'] == 'text/plain' ){ $extension_1 = '.txt'; } else { $extension_1 = '.csv'; }
                    if( $data['file_2']['type'] == 'text/plain' ){ $extension_2 = '.txt'; } else { $extension_2 = '.csv'; }
                    if( $data['file_3']['type'] == 'text/plain' ){ $extension_3 = '.txt'; } else { $extension_3 = '.csv'; }

                    /********* ARCHIVO 1 *********/
                    $data['file_1']['name'] =  'traitlist_'.$caractPhysicalChemistry->numeroDocumento.$extension_1;
                    $fichero_subido_1 = $dir_subida . basename($data['file_1']['name']);
                    if(move_uploaded_file($data['file_1']['tmp_name'], $fichero_subido_1))
                        $data['traitlist'] = 'pass_fitogenetico/fisicoquimica/'. 'traitlist_'.$caractPhysicalChemistry->numeroDocumento.$extension_1;

                    /********* ARCHIVO 2 *********/
                    $data['file_2']['name'] =  'samplelist_'.$caractPhysicalChemistry->numeroDocumento.$extension_2;
                    $fichero_subido_2 = $dir_subida . basename($data['file_2']['name']);
                    if(move_uploaded_file($data['file_2']['tmp_name'], $fichero_subido_2))
                        $data['samplelist'] = 'pass_fitogenetico/fisicoquimica/'. 'samplelist_'.$caractPhysicalChemistry->numeroDocumento.$extension_2;

                    /********* ARCHIVO 3 *********/
                    $data['file_3']['name'] =  'datamatrix_'.$caractPhysicalChemistry->numeroDocumento.$extension_3;
                    $fichero_subido_2 = $dir_subida . basename($data['file_3']['name']);
                    if(move_uploaded_file($data['file_3']['tmp_name'], $fichero_subido_2))
                        $data['datamatrix'] = 'pass_fitogenetico/fisicoquimica/'. 'datamatrix_'.$caractPhysicalChemistry->numeroDocumento.$extension_3;


                    $caractPhysicalChemistry = $this->CaractPhysicalChemistry->patchEntity($caractPhysicalChemistry, $data);

                    if ($this->CaractPhysicalChemistry->save($caractPhysicalChemistry)) {

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                                    $user_id    = $this->Auth->User('id');
                                    $module     = $list_module[(count($list_module)-2)];
                                    $action     = $list_module[(count($list_module)-1)];
                                    $station_id = $caractPhysicalChemistry->id;
                                    $recurso_id = '1';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Registro FisicoQuimica creado satisfactoriamente.'));

                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al crear la Caracterización FisicoQuimica. Por favor, Otra vez intente.'));
                }

                $scripts   = ['assets/packages/jqueryvalidation/dist/jquery.validate'];
                $modulo    = $this->mod_modulo;
                $titulo    = $this->mod_parent;

                $coleccion = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['resource_id' => 1, 'status' => 1, 'availability' => '1']);

                $this->set(compact('caractPhysicalChemistry', 'scripts', 'modulo', 'titulo', 'coleccion'));
                $this->set('_serialize', ['caractPhysicalChemistry']);

        } else {
                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Caract Physical Chemistry id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $caractPhysicalChemistry = $this->CaractPhysicalChemistry->find()->where(['status' => '1','id'=>$id])->first();

        if($caractPhysicalChemistry!=NULL && $this->permiso['edit'] ){

                if ($this->request->is(['patch', 'post', 'put'])) {

                    $data = $this->request->getData();

                    /****  Carga de Archivos  ***/
                    $dir_subida = WWW_ROOT.'pass_fitogenetico'.DS.'fisicoquimica'.DS;

                    if( $data['file_1']['type'] == 'text/plain' ){ $extension_1 = '.txt'; } else { $extension_1 = '.csv'; }
                    if( $data['file_2']['type'] == 'text/plain' ){ $extension_2 = '.txt'; } else { $extension_2 = '.csv'; }
                    if( $data['file_3']['type'] == 'text/plain' ){ $extension_3 = '.txt'; } else { $extension_3 = '.csv'; }

                    /********* ARCHIVO 1 *********/
                    $data['file_1']['name'] =  'traitlist_'.$caractPhysicalChemistry->id.$extension_1;
                    $fichero_subido_1 = $dir_subida . basename($data['file_1']['name']);
                    if(move_uploaded_file($data['file_1']['tmp_name'], $fichero_subido_1))
                        $data['traitlist'] = 'pass_fitogenetico/fisicoquimica/'. 'traitlist_'.$caractPhysicalChemistry->id.$extension_1;

                    /********* ARCHIVO 2 *********/
                    $data['file_2']['name'] =  'samplelist_'.$caractPhysicalChemistry->id.$extension_2;
                    $fichero_subido_2 = $dir_subida . basename($data['file_2']['name']);
                    if(move_uploaded_file($data['file_2']['tmp_name'], $fichero_subido_2))
                        $data['samplelist'] = 'pass_fitogenetico/fisicoquimica/'. 'samplelist_'.$caractPhysicalChemistry->id.$extension_2;

                    /********* ARCHIVO 3 *********/
                    $data['file_3']['name'] =  'datamatrix_'.$caractPhysicalChemistry->id.$extension_3;
                    $fichero_subido_2 = $dir_subida . basename($data['file_3']['name']);
                    if(move_uploaded_file($data['file_3']['tmp_name'], $fichero_subido_2))
                        $data['datamatrix'] = 'pass_fitogenetico/fisicoquimica/'. 'datamatrix_'.$caractPhysicalChemistry->id.$extension_3;


                    $caractPhysicalChemistry = $this->CaractPhysicalChemistry->patchEntity($caractPhysicalChemistry, $data);

                    if ($this->CaractPhysicalChemistry->save($caractPhysicalChemistry)) {

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-3)];
                        $action     = $list_module[(count($list_module)-2)];
                        $station_id = $caractPhysicalChemistry->id;
                        $recurso_id = '1';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Registro FisicoQuimica actualizado satisfactoriamente.'));

                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al actualizar la Caracterización FisicoQuimica. Por favor, Otra vez intente.'));
                }

                $scripts   = ['assets/packages/jqueryvalidation/dist/jquery.validate'];
                $modulo    = $this->mod_modulo;
                $titulo    = $this->mod_parent;

                $coleccion = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['resource_id' => 1, 'status' => 1, 'availability' => '1']);

                $this->set(compact('caractPhysicalChemistry', 'scripts', 'modulo', 'titulo', 'coleccion'));
                $this->set('_serialize', ['caractPhysicalChemistry']);

        } else {

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Caract Physical Chemistry id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->is(['post', 'delete']);

        $caractPhysicalChemistry = $this->CaractPhysicalChemistry->find()->where(['status' => '1','id'=>$id])->first();

        if($this->permiso['delete'] && $caractPhysicalChemistry!=NULL){

                $caractPhysicalChemistry['status'] = '0';

                if ($this->CaractPhysicalChemistry->save($caractPhysicalChemistry)) {

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = $list_module[(count($list_module)-2)];
                    $station_id = $caractPhysicalChemistry->id;
                    $recurso_id = '1';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('Caracterización FisicoQuimica eliminado satisfactoriamente.'));

                } else {

                    $this->Flash->error(__('Hubo inconvenientes al eliminar la Caracterización FisicoQuimica. Por favor, Otra vez intente.'));
                }

                return $this->redirect(['action' => 'index']);

        } else {

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }

    }

    /*************************** METODOS PARA LA DESCARGA DE ARCHIVOS *****************************/
    public function exportarsamplelist($id = null)
    {
        $caractPhysicalChemistry = $this->CaractPhysicalChemistry->find()->where(['status' => '1','id'=>$id])->first();

        if($this->permiso['export'] && $caractPhysicalChemistry!=NULL){

                $filePath = WWW_ROOT .$caractPhysicalChemistry['samplelist'];

                if(file_exists($filePath)){

                    $this->response->file($filePath , array('download'=> true));

                    return $this->response;

                } else {

                    $this->Flash->error(__('No existe el archivo.'));
                    return $this->redirect(['action' => 'view', 'id' => $caractPhysicalChemistry->id]);
                }

        } else {

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }


    }

    public function exportartraitlist($id = null)
    {

        $caractPhysicalChemistry = $this->CaractPhysicalChemistry->find()->where(['status' => '1','id'=>$id])->first();

        if($this->permiso['export'] && $caractPhysicalChemistry!=NULL){

                $caractPhysicalChemistry = $this->CaractPhysicalChemistry->get($id);

                $filePath = WWW_ROOT .$caractPhysicalChemistry['traitlist'];

                if(file_exists($filePath)){

                    $this->response->file($filePath , array('download'=> true));

                    return $this->response;

                } else {

                    $this->Flash->error(__('No existe el archivo.'));
                    return $this->redirect(['action' => 'view', 'id' => $caractPhysicalChemistry->id]);
                }

        } else {

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }
    }

    public function exportardatamatrix($id = null)
    {

        $caractPhysicalChemistry = $this->CaractPhysicalChemistry->find()->where(['status' => '1','id'=>$id])->first();

        if($this->permiso['export'] && $caractPhysicalChemistry!=NULL){


                $caractPhysicalChemistry = $this->CaractPhysicalChemistry->get($id);

                $filePath = WWW_ROOT .$caractPhysicalChemistry['datamatrix'];

                if(file_exists($filePath)){

                    $this->response->file($filePath , array('download'=> true));

                    return $this->response;

                } else {

                    $this->Flash->error(__('No existe el archivo.'));
                    return $this->redirect(['action' => 'view', 'id' => $caractPhysicalChemistry->id]);
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
