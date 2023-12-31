<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * InputDna Controller
 *
 * @property \App\Model\Table\InputDnaTable $InputDna
 *
 * @method \App\Model\Entity\InputDna[] paginate($object = null, array $settings = [])
 */
class InputDnaZooController extends AppController
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadComponent('Csrf');
        $this->mod_parent = "Banco ADN ";
        $this->mod_padre = "Entrada de Material";
        $this->loadModel('BankDna');
        $this->loadModel('OptionList');
        $this->loadModel('InputDna');
        $this->loadModel('Passport');
        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => 'BankDnaZoo'])->first();
        if(!empty($this->module))
          $this->permiso=$this->Functions->validarModulo($this->module->id);

    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($id=null)
    {

        $bankDna_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->first();
        $passport = $this->Passport->find()->where(['id '=>$bankDna_count->passport_id])->first();

        if($bankDna_count!=NULL && $this->permiso['index']){

            $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
            $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                        'assets/js/datatable/dataTables.bootstrap.min',
                        'assets/js/datatable/dataTables.select.min'];

            $inputDna = $this->InputDna->find()->where(['InputDna.status !=' => '0', 'InputDna.bank_dna_id' => $id]);

            $titulo=$this->mod_parent.' - '. $this->mod_padre;
            $titulo_lista=$this->mod_padre;
            $permiso= $this->permiso;

            $this->set(compact('inputDna','titulo','styles','scripts','titulo_lista','id','permiso','passport'));
            $this->set('_serialize', ['inputDna']);

        } else{

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index','controller'=>'BankDnaZoo']);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Input Dna id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null,$child=null)
    {
        $bankDnaZoo_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->first();
        $passport = $this->Passport->find()->where(['id '=>$bankDnaZoo_count->passport_id])->first();
        $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if($bankDnaZoo_count ==NULL || !$this->permiso['view']){

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller'=>'BankDnaZoo']);

        }else{

            $inputDna = $this->InputDna->find()
                                             ->where(['InputDna.status !=' => '0','InputDna.id'=>$child,'InputDna.bank_dna_id'=>$id
                                                ])->first();

            if($inputDna==NULL){

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index',$id]);
            }

            $titulo = $this->mod_padre;
            $parent = $this->mod_parent;
            $permiso= $this->permiso;

            $this->set(compact('inputDna','titulo','permiso','id','child','validar'));
            $this->set('_serialize', ['inputDna']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $bankDnaZoo_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->count();

        if($bankDnaZoo_count>0 && $this->permiso['add']){

        $modulo= $this->mod_padre;
        $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];
        $inputDna = $this->InputDna->newEntity();
        $inputDna->bank_dna_id=$id;

        if ($this->request->is('post')) {
            $data=$this->request->getData();
            $data['status']=1;
             try{
                    $data['bank_dna_id']= $id;
                    $data['enterdate'] = ($data['fecha_entrada'] == '' || $data['fecha_entrada'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_entrada']));

                    $inputDna = $this->InputDna->patchEntity($inputDna,$data);
                    if ($this->InputDna->save($inputDna)) {

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-4)];
                        $action     = $list_module[(count($list_module)-2)].'/'.$list_module[(count($list_module)-1)];
                        $station_id = $inputDna->id;
                        $recurso_id = '2';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);
                        $this->Flash->success(__('La Entrada de Material fue creado satisfactoriamente.'));

                        return $this->redirect(['action' => 'index',$inputDna->bank_dna_id]);
                    }
                    $this->Flash->error(__('Hubo inconvenientes al crear la Entrada de Material. Por favor, Otra vez intente.'));
            } catch (\Exception $e) {

                    $this->Flash->error(__('Hubo inconvenientes al crear la Entrada de Material. Por favor, Otra vez intente.'));
                    return $this->redirect(['action' => 'index',$inputDna->bank_dna_id]);
            }
        }
        $lista_deposito= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 448, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

        $lista_muestra= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 452, 'status' => 1, 'OR' => [['resource_id' => 1],['resource_id' => 4]] ]);

        $lista_estado= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 460, 'status' => 1, 'OR' => [['resource_id' => 1],['resource_id' => 4]] ]);

        $this->set(compact('scripts','inputDna','modulo','lista_muestra','lista_estado','lista_deposito','id'));
        $this->set('_serialize', ['inputDna']);

        }else {

                 $this->Flash->error(__('Operación denegada.'));
                 return $this->redirect(['action' => 'index','controller'=>'BankDnaZoo']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Input Dna id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$child=null)
    {
        $bankDnaZoo_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->first();
        $passport = $this->Passport->find()->where(['id '=>$bankDnaZoo_count->passport_id])->first();
        $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if($bankDnaZoo_count!=NULL && $this->permiso['edit'] /*&& $validar*/){

            $inputDna = $this->InputDna->find()
                                         ->where(['InputDna.status !=' => '0','InputDna.id'=>$child,'InputDna.bank_dna_id'=>$id
                                            ])->first();

            if($inputDna==NULL){

                        $this->Flash->error(__('Operación denegada.'));
                        return $this->redirect(['action' => 'index',$id]);
            } else {

                $modulo=$this->mod_padre ;
                $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

                if ($this->request->is(['patch', 'post', 'put'])) {
                    $data=$this->request->getData();
                     try{
                            $data['enterdate'] = ($data['fecha_entrada'] == '' || $data['fecha_entrada'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_entrada']));
                            $inputDna = $this->InputDna->patchEntity($inputDna,$data);

                            if ($this->InputDna->save($inputDna)) {

                                $list_module = explode('/', $this->request->params['_matchedRoute']);

                                $user_id    = $this->Auth->User('id');
                                $module     = $list_module[(count($list_module)-5)];
                                $action     = $list_module[(count($list_module)-3)].'/'.$list_module[(count($list_module)-2)];
                                $station_id = $inputDna->id;
                                $recurso_id = '2';

                                $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                                $this->Flash->success(__('La Entrada de Material fue actualizado satisfactoriamente.'));

                                return $this->redirect(['action' => 'index',$inputDna->bank_dna_id]);
                            }
                            $this->Flash->error(__('Hubo inconvenientes al actualizar la Entrada de Material. Por favor, Otra vez intente.'));

                        } catch (\Exception $e) {

                            $this->Flash->error(__('Hubo inconvenientes al actualizar la Entrada de Material. Por favor, Otra vez intente.'));
                            return $this->redirect(['action' => 'index']);
                    }
                }
            }


        $lista_deposito= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 448, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

        $lista_muestra= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 452, 'status' => 1, 'OR' => [['resource_id' => 1], ['resource_id' => 4]] ]);

        $lista_estado= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 460, 'status' => 1, 'OR' => [['resource_id' => 1],['resource_id' => 4]] ]);

        $inputDna->enterdate=($inputDna->enterdate == NULL) ? NULL : date('d-m-Y', strtotime($inputDna->enterdate));

        $this->set(compact('scripts','inputDna','modulo','lista_deposito','lista_muestra','lista_estado','id','child'));
        $this->set('_serialize', ['inputDna']);

        } else {
                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller' => 'BankDnaZoo']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Input Dna id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$child=null)
    {
         $bankDnaZoo_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->first();
        $passport = $this->Passport->find()->where(['id '=>$bankDnaZoo_count->passport_id])->first();
        $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if($bankDnaZoo_count!=NULL && $this->permiso['delete'] /*&& $validar*/){

            $this->request->is(['post', 'delete']);

            $inputDnaZoo = $this->InputDna->find()
                                         ->where(['InputDna.status !=' => '0','InputDna.id'=>$child,'InputDna.bank_dna_id'=>$id
                                            ])->first();

            if($inputDnaZoo==NULL){

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index',$id]);
            }else{

                $inputDnaZoo['status'] = 0;

                if ($this->InputDna->save($inputDnaZoo)) {

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-5)];
                    $action     = $list_module[(count($list_module)-3)].'/'.$list_module[(count($list_module)-2)];
                    $station_id = $inputDnaZoo->id;
                    $recurso_id = '2';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('La Entrada Material fue eliminado satisfactoriamente.'));
                } else {
                     $this->Flash->error(__('Hubo inconvenientes al eliminar la Entrada Material . Por favor, Otra vez intente.'));
                }

               return $this->redirect(['action' => 'index', $inputDnaZoo->bank_dna_id]);
            }

        }else{

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller' => 'BankDnaZoo']);
        }
    }

    public function exportartabla($id=null) {

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
