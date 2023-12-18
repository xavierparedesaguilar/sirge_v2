<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * InsituFarmerActivity Controller
 *
 * @property \App\Model\Table\InsituFarmerActivityTable $InsituFarmerActivity
 *
 * @method \App\Model\Entity\InsituFarmerActivity[] paginate($object = null, array $settings = [])
 */
class InsituFarmerActivityController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadComponent('Csrf');
        $this->mod_modulo = "Conservación In Situ";
        $this->mod_title = "Prácticas Agrícolas";
        $this->loadModel('Insitu');
        $this->loadModel('OptionList');

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => 'Insitu'])->first();
        if(!empty($this->module))
          $this->permiso=$this->Functions->validarModulo($this->module->id);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index( $idx = null )
    {
        $insitu = $this->Insitu->find()->where(['Insitu.id'=> $idx , 'Insitu.status'=>1])->first();

        if ($insitu!=NULL && $this->permiso['index']) {

            $mod_modulo  = $this->mod_modulo;
            $mod_title   = $this->mod_title;
            $permiso     = $this->permiso;

            $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
            $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                        'assets/js/datatable/dataTables.bootstrap.min',
                        'assets/js/datatable/dataTables.select.min'];

            //$insitu = $this->Insitu->get($idx);
            $insituFarmerActivity = $this->InsituFarmerActivity->find()->where(['insitu_id' => $insitu->id, 'status' => '1'])->all();

            $this->set(compact('insituFarmerActivity', 'insitu', 'mod_modulo', 'mod_title', 'styles', 'scripts','permiso'));
            $this->set('_serialize', ['insituFarmerActivity']);

        }else{

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index','controller'=>'Insitu']);

        }

    }

    /**
     * View method
     *
     * @param string|null $id Insitu Farmer Activity id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($idx = null, $id = null)
    {
        $insitu = $this->Insitu->find()->where(['Insitu.id'=> $idx , 'Insitu.status'=>1])->first();

        if ($insitu!=NULL  && $this->permiso['view']) {

            $mod_modulo  = $this->mod_modulo;
            $mod_title   = $this->mod_title;
            $permiso     = $this->permiso;

            // $insituFarmerActivity = $this->InsituFarmerActivity->get($id, [
            //     'contain' => ['Insitu']
            // ]);

            $insituFarmerActivity = $this->InsituFarmerActivity->find()->contain(['Insitu'])->where(['InsituFarmerActivity.id'=>$id , 'InsituFarmerActivity.status'=>1,'InsituFarmerActivity.insitu_id'=>$idx])->first();

            if ($insituFarmerActivity!=NULL) {


            $this->set(compact('insituFarmerActivity', 'mod_modulo', 'mod_title','permiso', 'insitu'));
            $this->set('_serialize', ['insituFarmerActivity']);

            }else{

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index','controller'=>'InsituFarmerActivity',$idx]);

            }

        }else{
                // echo(json_encode($insitu)); die();
              // $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index','controller'=>'InsituFarmerActivity',$idx]);

        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add( $idx = null )
    {
        $insitu = $this->Insitu->find()->where(['Insitu.id'=> $idx , 'Insitu.status'=>1])->first();

        if ($insitu!=NULL  && $this->permiso['add']) {


        $insituFarmerActivity = $this->InsituFarmerActivity->newEntity();


        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $data['status'] = '1';
            $data['insitu_id'] = $insitu->id;

            $insituFarmerActivity = $this->InsituFarmerActivity->patchEntity($insituFarmerActivity, $data);

            if ($this->InsituFarmerActivity->save($insituFarmerActivity)) {

                $list_module = explode('/', $this->request->params['_matchedRoute']);

                $user_id    = $this->Auth->User('id');
                $module     = $list_module[(count($list_module)-2)];
                $action     = $list_module[(count($list_module)-1)];
                $station_id = $insituFarmerActivity->id;
                $recurso_id = '4';

                $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                $this->Flash->success(__('Práctica Agrícolas creado satisfactoriamente.'));

                return $this->redirect(['action' => 'index', 'idx' => $insitu->id]);
            }

            $this->Flash->error(__('Hubo inconvenientes al crear la Práctica Agrícola. Por favor, otra vez intente.'));
        }

        $mod_modulo  = $this->mod_modulo;
        $mod_title   = $this->mod_title;

        $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

        $tecnica_categoria = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'649', 'status' => '1', 'resource_id' => 4]);
        $practica_saber    = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'651', 'status' => '1', 'resource_id' => 4]);
        $origen            = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'652', 'status' => '1', 'resource_id' => 4]);
        $insumo_tools      = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'650', 'status' => '1', 'resource_id' => 4]);

        $this->set(compact('insituFarmerActivity', 'insitu', 'mod_modulo', 'mod_title', 'tecnica_categoria', 'practica_saber', 'origen',
                           'insumo_tools', 'scripts'));
        $this->set('_serialize', ['insituFarmerActivity']);

        } else{

              //$this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index','controller'=>'InsituFarmerActivity',$idx]);

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Insitu Farmer Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($idx = null, $id = null)
    {

        $insitu = $this->Insitu->find()->where(['Insitu.id'=> $idx , 'Insitu.status'=>1])->first();

        if ($insitu!=NULL && $this->permiso['edit']) {

            $insituFarmerActivity = $this->InsituFarmerActivity->find()->where(['InsituFarmerActivity.id'=>$id,'InsituFarmerActivity.status'=>1,'InsituFarmerActivity.insitu_id'=>$idx])->first();

            if ($insituFarmerActivity!=NULL) {

                if ($this->request->is(['patch', 'post', 'put'])) {

                    $data = $this->request->getData();

                    $insituFarmerActivity = $this->InsituFarmerActivity->patchEntity($insituFarmerActivity, $data);

                    if ($this->InsituFarmerActivity->save($insituFarmerActivity)) {

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-3)];
                        $action     = $list_module[(count($list_module)-2)];
                        $station_id = $insituFarmerActivity->id;
                        $recurso_id = '4';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Práctica Agrícolas actualizado satisfactoriamente.'));

                        return $this->redirect(['action' => 'index', 'idx' => $insitu->id]);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al actualizar la Práctica Agrícola. Por favor, otra vez intente.'));
                }

                $mod_modulo  = $this->mod_modulo;
                $mod_title   = $this->mod_title;

                $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

                $tecnica_categoria = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'649', 'status' => '1', 'resource_id' => 4]);
                $practica_saber    = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'651', 'status' => '1', 'resource_id' => 4]);
                $origen            = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'652', 'status' => '1', 'resource_id' => 4]);
                $insumo_tools      = $this->OptionList->find('list',['keyField'=>'id', 'valueField' => 'name'])->where(['parent_id'=>'650', 'status' => '1', 'resource_id' => 4]);


                $this->set(compact('insituFarmerActivity', 'insitu', 'mod_modulo', 'mod_title', 'tecnica_categoria', 'practica_saber', 'origen',
                                   'insumo_tools', 'scripts'));
                $this->set('_serialize', ['insituFarmerActivity']);

            } else{

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index','controller'=>'InsituFarmerActivity',$idx]);

            }

        } else{

          //$this->Flash->error(__('Operación denegada.'));
          return $this->redirect(['action' => 'index','controller'=>'InsituFarmerActivity',$idx]);

        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Insitu Farmer Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($idx = null, $id = null)
    {


        $insitu = $this->Insitu->find()->where(['Insitu.id'=> $idx , 'Insitu.status'=>1])->first();

        if ($insitu!=NULL && $this->permiso['delete']) {

            $this->request->is(['post', 'delete']);

            $insituFarmerActivity = $this->InsituFarmerActivity->find()->where(['InsituFarmerActivity.id'=> $id,
                                                                                'InsituFarmerActivity.status'=>1,
                                                                                'InsituFarmerActivity.insitu_id'=>$idx])
                                                                         ->first();

            if ($insituFarmerActivity==NULL) {


              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index','controller'=>'InsituFarmerActivity',$idx]);

            }else{

              $insituFarmerActivity['status'] = '0';
              if ($this->InsituFarmerActivity->save($insituFarmerActivity)) {

                  $list_module = explode('/', $this->request->params['_matchedRoute']);

                  $user_id    = $this->Auth->User('id');
                  $module     = $list_module[(count($list_module)-3)];
                  $action     = $list_module[(count($list_module)-2)];
                  $station_id = $insituFarmerActivity->id;
                  $recurso_id = '4';

                  $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                  $this->Flash->success(__('Práctica Agrícola eliminado satisfactoriamente.'));

              } else {

                  $this->Flash->error(__('Hubo inconvenientes al eliminar la Práctica Agrícola. Por favor, otra vez intente.'));
              }

              return $this->redirect(['action' => 'index', 'idx' => $insituFarmerActivity->insitu_id]);

            }

        } else{

          $this->Flash->error(__('Operación denegada.'));
          return $this->redirect(['action' => 'index','controller'=>'InsituFarmerActivity',$idx]);

        }
    }

    public function exportartabla($idx = null) {

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