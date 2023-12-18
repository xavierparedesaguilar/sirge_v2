<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * PropagationInvitro Controller
 *
 * @property \App\Model\Table\PropagationInvitroTable $PropagationInvitro
 */
class PropagationInvitroController extends AppController
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadComponent('Csrf');
        $this->mod_parent = "Banco Invitro ";
        $this->mod_padre = "Propagación Invitro";
        $this->loadModel('BankInvitro');
        $this->loadModel('OptionList');
        $this->loadModel('Passport');

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => 'BankInvitro'])->first();
        if(!empty( $this->module ))
          $this->permiso=$this->Functions->validarModulo($this->module->id);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($id = null)
    {
        $bankInvitro_count = $this->BankInvitro->find()->where(['BankInvitro.status '=>'1','BankInvitro.id'=>$id])->first();
        $passport = $this->Passport->find()->where(['id '=>$bankInvitro_count->passport_id])->first();

        if($bankInvitro_count !=NULL && $this->permiso['index']){

            $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
            $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                        'assets/js/datatable/dataTables.bootstrap.min',
                        'assets/js/datatable/dataTables.select.min'];

            $propagationInvitro = $this->PropagationInvitro->find()->contain(['BankInvitro'])->where(['PropagationInvitro.status !=' => '0', 'bank_invitro_id' => $id]);

            $titulo=$this->mod_parent.' - '.$this->mod_padre ;
            $titulo_lista=$this->mod_padre ;
            $permiso=$this->permiso;

            $this->set(compact('propagationInvitro','titulo','titulo_lista','styles','scripts','id','permiso','passport'));
            $this->set('_serialize', ['propagationInvitro']);
        }else{
              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index','controller'=>'BankInvitro']);
        }

    }

    /**
     * View method
     *
     * @param string|null $id Propagation Invitro id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $child = null)
    {

       $bankInvitro_count = $this->BankInvitro->find()->where(['BankInvitro.status '=>'1','BankInvitro.id'=>$id])->first();
       $passport = $this->Passport->find()->where(['id '=>$bankInvitro_count->passport_id])->first();
       $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

          if($bankInvitro_count ==NULL || !$this->permiso['view']) {

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller'=>'BankInvitro']);

            }else{

                $propagationInvitro = $this->PropagationInvitro->find()
                                             ->where(['PropagationInvitro.status !=' => '0','PropagationInvitro.id'=>$child,'PropagationInvitro.bank_invitro_id'=>$id
                                                ])->first();

                 if($propagationInvitro==NULL){

                            $this->Flash->error(__('Operación denegada.'));
                            return $this->redirect(['action' => 'index',$id]);
                 }
            }

        $titulo = $this->mod_padre;
        $parent = $this->mod_parent;
        $permiso=$this->permiso;

        $this->set(compact('propagationInvitro','titulo','permiso','id','child','validar'));
        $this->set('_serialize', ['propagationInvitro']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $bankInvitro_count = $this->BankInvitro->find()->where(['BankInvitro.status '=>'1','BankInvitro.id'=>$id])->count();

        if($bankInvitro_count>0 && $this->permiso['add']){

            $propagationInvitro = $this->PropagationInvitro->newEntity();
            $modulo=$this->mod_padre;
            $scripts = ['assets/js/fileinput/fileinput.min','assets/packages/jqueryvalidation/dist/jquery.validate'];
            $propagationInvitro->bank_invitro_id=$id;

            if ($this->request->is('post')) {

                $data=$this->request->getData();
                $data['status']=1;
                try{
                        $data['bank_invitro_id']= $id;
                        $data['prodate'] = ($data['fecha_propagacion'] == '' || $data['fecha_propagacion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_propagacion']));

                        $propagationInvitro = $this->PropagationInvitro->patchEntity($propagationInvitro, $data);

                        if ($this->PropagationInvitro->save($propagationInvitro)) {

                            $list_module = explode('/', $this->request->params['_matchedRoute']);

                            $user_id    = $this->Auth->User('id');
                            $module     = $list_module[(count($list_module)-4)];
                            $action     = $list_module[(count($list_module)-2)].'/'.$list_module[(count($list_module)-1)];
                            $station_id = $propagationInvitro->id;
                            $recurso_id = '1';

                            $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                            $this->Flash->success(__('La Propagación Invitro fue creado satisfactoriamente.'));

                            return $this->redirect(['action' => 'index', $propagationInvitro->bank_invitro_id]);
                        }
                        $this->Flash->error(__('Hubo inconvenientes al crear la Propagación Invitro. Por favor, Otra vez intente.'));
                } catch (\Exception $e) {

                        $this->Flash->error(__('Hubo inconvenientes al crear la Propagación Invitro. Por favor, Otra vez intente.'));
                        return $this->redirect(['action' => 'index', $propagationInvitro->bank_invitro_id]);
                }

            }
            $bankInvitro = $this->BankInvitro->find()->where(['id' => $id])->first();

            $this->set(compact('propagationInvitro', 'bankInvitro','modulo','scripts','id'));
            $this->set('_serialize', ['propagationInvitro']);

         }else {

                 $this->Flash->error(__('Operación denegada.'));
                 return $this->redirect(['action' => 'index','controller'=>'BankInvitro']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Propagation Invitro id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $child = null)
    {

        $bankInvitro_count = $this->BankInvitro->find()->where(['BankInvitro.status '=>'1','BankInvitro.id'=>$id])->first();
        $passport = $this->Passport->find()->where(['id '=>$bankInvitro_count->passport_id])->first();
        $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if($bankInvitro_count!=NULL /*&& $validar*/ ){

            $propagationInvitro = $this->PropagationInvitro->find()
                                         ->where(['PropagationInvitro.status !=' => '0','PropagationInvitro.id'=>$child,'PropagationInvitro.bank_invitro_id'=>$id
                                            ])->first();

            if($propagationInvitro==NULL){

                        $this->Flash->error(__('Operación denegada.'));
                        return $this->redirect(['action' => 'index',$id]);
            }else {

                    $scripts = ['assets/js/fileinput/fileinput.min','assets/packages/jqueryvalidation/dist/jquery.validate'];

                    $modulo=$this->mod_padre ;

                    if ($this->request->is(['patch', 'post', 'put'])) {

                        try{
                                $data=$this->request->getData();
                                $data['bank_invitro_id']= $id;
                                $data['prodate'] = ($data['fecha_propagacion'] == '' || $data['fecha_propagacion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_propagacion']));

                                $propagationInvitro = $this->PropagationInvitro->patchEntity($propagationInvitro, $data);

                                if ($this->PropagationInvitro->save($propagationInvitro)) {

                                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                                    $user_id    = $this->Auth->User('id');
                                    $module     = $list_module[(count($list_module)-5)];
                                    $action     = $list_module[(count($list_module)-3)].'/'.$list_module[(count($list_module)-2)];
                                    $station_id = $propagationInvitro->id;
                                    $recurso_id = '1';

                                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                                    $this->Flash->success(__('La Propagación Invitro fue actualizado satisfactoriamente.'));

                                    return $this->redirect(['action' => 'index', $propagationInvitro->bank_invitro_id]);
                                }
                                $this->Flash->error(__('Hubo inconvenientes al actualizar la Propagación Invitro. Por favor, Otra vez intente.'));
                            }
                        catch (\Exception $e) {

                            $this->Flash->error(__('Hubo inconvenientes al actualizar la Propagación Invitro. Por favor, Otra vez intente.'));
                            return $this->redirect(['action' => 'index', $propagationInvitro->bank_invitro_id]);
                        }
                    }
                    $propagationInvitro->prodate = ($propagationInvitro->prodate == NULL) ? NULL : date('d-m-Y', strtotime($propagationInvitro->prodate));
                    $bankInvitro = $this->BankInvitro->find()->where(['id' => $id])->first();

                    $this->set(compact('propagationInvitro', 'bankInvitro','scripts','modulo','id','child'));
                    $this->set('_serialize', ['propagationInvitro']);
                }

        } else {

                 $this->Flash->error(__('Operación denegada.'));
                 return $this->redirect(['action' => 'index','controller'=>'BankInvitro']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Propagation Invitro id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $child = null)
    {
       $bankInvitro_count = $this->BankInvitro->find()->where(['BankInvitro.status '=>'1','BankInvitro.id'=>$id])->first();
       $passport = $this->Passport->find()->where(['id '=>$bankInvitro_count->passport_id])->first();
       $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if($bankInvitro_count!=NULL /*&& $validar*/){

            $this->request->is(['post', 'delete']);

            $propagationInvitro = $this->PropagationInvitro->find()
                                         ->where(['PropagationInvitro.status !=' => '0','PropagationInvitro.id'=>$child,'PropagationInvitro.bank_invitro_id'=>$id
                                            ])->first();

                if($propagationInvitro==NULL){

                            $this->Flash->error(__('Operación denegada.'));
                            return $this->redirect(['action' => 'index',$id]);
                }else{

                $propagationInvitro['status'] = 0;

                    if ($this->PropagationInvitro->delete($propagationInvitro)) {

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-5)];
                        $action     = $list_module[(count($list_module)-3)].'/'.$list_module[(count($list_module)-2)];
                        $station_id = $propagationInvitro->id;
                        $recurso_id = '1';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('La Propagación Invitro fue eliminado satisfactoriamente.'));

                    } else {

                         $this->Flash->error(__('Hubo inconvenientes al eliminar La Propagación Invitro . Por favor, Otra vez intente.'));
                    }

                     return $this->redirect(['action' => 'index', $propagationInvitro->bank_invitro_id]);
                 }

            }else{

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller'=>'BankInvitro']);

            }
    }

    public function exportartabla($id = null) {

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
