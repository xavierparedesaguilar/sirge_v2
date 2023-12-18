<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Insitu Controller
 *
 * @property \App\Model\Table\InsituTable $Insitu
 *
 * @method \App\Model\Entity\Insitu[] paginate($object = null, array $settings = [])
 */
class InsituController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->mod_modulo = "Conservación In Situ";
        $this->loadModel('Ubigeo');
        $this->loadModel('OptionList');

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

            $mod_modulo  = $this->mod_modulo;
            $permiso = $this->permiso;

            $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
            $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                        'assets/js/datatable/dataTables.bootstrap.min',
                        'assets/js/datatable/dataTables.select.min'];

            $insitu = $this->Insitu->find()->contain(['User', 'Ubigeo'])->where(['Insitu.status' => '1'])->all();

            $this->set(compact('insitu', 'mod_modulo', 'styles', 'scripts','permiso'));
            $this->set('_serialize', ['insitu']);

        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect($this->Auth->redirectUrl());

       }


    }

    /**
     * View method
     *
     * @param string|null $id Insitu id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->permiso['view']){

            $insitu = $this->Insitu->find()->contain(['User','Ubigeo','InsituAccesion','InsituFarmerActivity','InsituPlage','InsituThreat'])
                                           ->where(['Insitu.id'=> $id])->first();
            if ($insitu!=NULL) {


            $mod_modulo  = $this->mod_modulo;
            $permiso     = $this->permiso;

            $this->set( compact('insitu', 'mod_modulo','permiso'));
            $this->set('_serialize', ['insitu']);

            }else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index','controller'=>'Insitu']);

            }

        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index','controller'=>'Insitu']);

       }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->permiso['add']) {


          $insitu = $this->Insitu->newEntity();

          if ($this->request->is('post')) {

              $data = $this->request->getData();

              $data['status'] = '1';
              $data['code_insitu'] = 'ZABD'.str_pad($insitu->codigo, 6, "0", STR_PAD_LEFT);
              $data['user_id'] = $this->Auth->User('id');

              $insitu = $this->Insitu->patchEntity($insitu, $data);

              if ($this->Insitu->save($insitu)) {

                  $list_module = explode('/', $this->request->params['_matchedRoute']);

                  $user_id    = $this->Auth->User('id');
                  $module     = $list_module[(count($list_module)-2)];
                  $action     = $list_module[(count($list_module)-1)];
                  $station_id = $insitu->id;
                  $recurso_id = '4';

                  $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                  $this->Flash->success(__('In Situ creado satisfactoriamente.'));

                  return $this->redirect(['action' => 'index']);
              }

              $this->Flash->error(__('Hubo inconvenientes al crear In Situ. Por favor, otra vez intente.'));
          }

          $mod_modulo  = $this->mod_modulo;

          $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

          $departamento      = $this->Ubigeo->find('list', ['keyField' => 'cod_dep', 'valueField' => 'nombre'])->where(['cod_pro' => 0]);
          $grado_instruccion = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'647', 'status' => '1', 'resource_id' => 4]);
          $tipo_suelo        = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'119', 'status' => '1', 'resource_id' => 4]);

          $this->set(compact('insitu', 'mod_modulo', 'departamento', 'grado_instruccion', 'tipo_suelo', 'scripts'));
          $this->set('_serialize', ['insitu']);

        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index','controller'=>'Insitu']);

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Insitu id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($this->permiso['edit']) {

          // $insitu = $this->Insitu->get($id, [
          //     'contain' => ['Ubigeo']
          // ]);

          $insitu = $this->Insitu->find()->contain(['Ubigeo'])->where(['Insitu.id'=>$id,'Insitu.status'=>'1'])->first();

          if ($insitu!=NULL) {


            if ($this->request->is(['patch', 'post', 'put'])) {

                $data = $this->request->getData();

                $insitu = $this->Insitu->patchEntity($insitu, $data);

                if ($this->Insitu->save($insitu)) {

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = $list_module[(count($list_module)-2)];
                    $station_id = $insitu->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('In Situ actualizado satisfactoriamente.'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Hubo inconvenientes al actualizar In Situ. Por favor, otra vez intente.'));
            }

            $mod_modulo  = $this->mod_modulo;

            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

            $departamento      = $this->Ubigeo->find('list', ['keyField' => 'cod_dep', 'valueField' => 'nombre'])->where(['cod_pro' => 0]);

            if($insitu->ubigeo_id != NULL || $insitu->ubigeo_id != ''){

                $provincias = $this->Ubigeo->find('list', ['keyField'=>'cod_pro','valueField'=>'nombre'])->where(['cod_dep' => $insitu['ubigeo']['cod_dep'], 'cod_pro !=' => 0, 'cod_dis' => 0]);
                $distritos  = $this->Ubigeo->find('list', ['keyField'=>'id','valueField'=>'nombre'])->where(['cod_dep' => $insitu['ubigeo']['cod_dep'], 'cod_pro' => $insitu['ubigeo']['cod_pro'], 'cod_dis !=' => 0]);

            } else {

                $provincias = [];
                $distritos  = [];
            }

            $grado_instruccion = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'647', 'status' => '1', 'resource_id' => 4]);
            $tipo_suelo        = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'119', 'status' => '1', 'resource_id' => 4]);

            $this->set(compact('insitu', 'mod_modulo', 'departamento', 'provincias', 'distritos', 'grado_instruccion', 'tipo_suelo', 'scripts'));
            $this->set('_serialize', ['insitu']);

          } else {

          $this->Flash->error(__('Operación denegada.'));
          return $this->redirect(['action' => 'index','controller'=>'Insitu']);

          }

        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index','controller'=>'Insitu']);

        }

    }

    /**
     * Delete method
     *
     * @param string|null $id Insitu id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

      if ($this->permiso['delete']) {


          $this->request->is(['post', 'delete']);

          //$insitu = $this->Insitu->get($id);
          $insitu = $this->Insitu->find()->where(['Insitu.id'=>$id])->first();

          if ($insitu!=NULL) {


          if($insitu->validacionInsitu > 0){

              $this->Flash->error(__('Insitu '.$insitu->code_Insitu.', imposible de eliminar. Tiene registros asociados.'));

          } else {

              $insitu['status'] = '0';

              if ($this->Insitu->save($insitu)) {

                  $list_module = explode('/', $this->request->params['_matchedRoute']);

                  $user_id    = $this->Auth->User('id');
                  $module     = $list_module[(count($list_module)-3)];
                  $action     = $list_module[(count($list_module)-2)];
                  $station_id = $insitu->id;
                  $recurso_id = '4';

                  $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                  $this->Flash->success(__('In Situ eliminado satisfactoriamente.'));

              } else {

                  $this->Flash->error(__('Hubo inconvenientes al eliminar In Situ. Por favor, otra vez intente.'));
              }
          }

          return $this->redirect(['action' => 'index']);

          } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index','controller'=>'Insitu']);

          }

        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index','controller'=>'Insitu']);

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
