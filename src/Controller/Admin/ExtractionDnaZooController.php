<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;


/**
 * ExtractionDna Controller
 *
 * @property \App\Model\Table\ExtractionDnaTable $ExtractionDna
 *
 * @method \App\Model\Entity\ExtractionDna[] paginate($object = null, array $settings = [])
 */
class ExtractionDnaZooController extends AppController
{

        public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadComponent('Csrf');
        $this->mod_parent = "Banco ADN ";
        $this->mod_padre = "Extracción de ADN";
        $this->loadModel('BankDna');
        $this->loadModel('ExtractionDna');
        $this->loadModel('OptionList');

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
         $this->Flash->error(__('Operación denegada.'));
         return $this->redirect(['controller' => 'BankDnaZoo', 'action' => 'index']);
    }

    /**
     * View method
     *
     * @param string|null $id Extraction Dna id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null,$child=null)
    {
         $extractionDna_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->count();

        if($extractionDna_count ==0 || !$this->permiso['view']){

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller'=>'BankDnaZoo']);

        }else{

            $extractionDna = $this->ExtractionDna->find()->where(['ExtractionDna.status !='=>'0','ExtractionDna.bank_dna_id'=>$id, 'ExtractionDna.id '=>$child
                                                ])->first();


            if($extractionDna==NULL){

                //$this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index',$id]);
            }

            $titulo = $this->mod_padre;
            $parent = $this->mod_parent;
            $permiso= $this->permiso;

            $this->set(compact('extractionDna','titulo','permiso'));
            $this->set('_serialize', ['extractionDna']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {

     $bankDna_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->count();

        if($bankDna_count>0 && $this->permiso['add']){

            $modulo= $this->mod_padre;
            $extractionDna = $this->ExtractionDna->newEntity();
            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];
            $extractionDna->bank_dna_id=$id;
            if ($this->request->is('post')) {
                $data=$this->request->getData();
                $data['status']=1;
                 try{
                        $data['bank_dna_id']= $id;
                        $data['extdate'] = ($data['fecha_extraccion'] == '' || $data['fecha_extraccion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_extraccion']));

                        $data['shorconstime'] = ($data['fecha_renovacion'] == '' || $data['fecha_renovacion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_renovacion']));

                        $data['longconstime'] = ($data['fecha_renovacion_largo'] == '' || $data['fecha_renovacion_largo'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_renovacion_largo']));

                        if( strlen($data['shorconstime']) ==0 && strlen($data['longconstime'])==0 ){

                            $this->Flash->error(__('Registrar Conservación Corto o Largo plazo.'));
                        }

                        else{

                             $extractionDna = $this->ExtractionDna->patchEntity($extractionDna,$data);
                            if ($this->ExtractionDna->save($extractionDna)) {

                                $list_module = explode('/', $this->request->params['_matchedRoute']);

                                $user_id    = $this->Auth->User('id');
                                $module     = $list_module[(count($list_module)-4)];
                                $action     = $list_module[(count($list_module)-2)].'/'.$list_module[(count($list_module)-1)];
                                $station_id = $extractionDna->id;
                                $recurso_id = '2';

                                $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                                $this->Flash->success(__('La Extración del ADN fue creado satisfactoriamente.'));
                                return $this->redirect(['controller' => 'BankDnaZoo', 'action' => 'index']);
                            }
                        }

                        //$this->Flash->error(__('Hubo inconvenientes al crear la Extración del ADN. Por favor, Otra vez intente.'));
                } catch (\Exception $e) {

                        $this->Flash->error(__('Hubo inconvenientes al crear la Extración del ADN. Por favor, Otra vez intente.' .$e->getMessage()));
                       return $this->redirect(['controller' => 'BankDnaZoo', 'action' => 'index']);
                }
            }

            $lista_extraccion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 444, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

            $lista_dilucion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 465, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

            $lista_almacenamiento= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 473, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

            $lista_conservacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 477, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

            $lista_almacenamiento_largo= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 473, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

             $extractionDna->extdate = ($extractionDna->extdate == NULL) ? NULL : date('d-m-Y', strtotime($extractionDna->extdate));
             $extractionDna->shorconstime = ($extractionDna->shorconstime == NULL) ? NULL : date('d-m-Y', strtotime($extractionDna->shorconstime));
             $extractionDna->longconstime = ($extractionDna->longconstime == NULL) ? NULL : date('d-m-Y', strtotime($extractionDna->longconstime));

            $this->set(compact('scripts','extractionDna','modulo','lista_extraccion','lista_dilucion','lista_almacenamiento','lista_conservacion','lista_almacenamiento_largo','id'));

            $this->set('_serialize', ['extractionDna']);
        }

        else{
            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index','controller'=>'BankDnaZoo']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Extraction Dna id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

       $bankDna_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->count();



        if($bankDna_count>0 && $this->permiso['edit']){

            $extractionDna = $this->ExtractionDna->find()->where(['ExtractionDna.status !=' => '0','ExtractionDna.bank_dna_id'=>$id])->first();

            if($extractionDna==NULL){

                        return $this->redirect(['action' => 'index',$id]);
            } else {

            $modulo=$this->mod_padre ;
            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data=$this->request->getData();
             try{
                    $data['bank_dna_id']= $id;

                    $data['extdate'] = ($data['fecha_extraccion'] == '' || $data['fecha_extraccion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_extraccion']));

                    $data['shorconstime'] = ($data['fecha_renovacion'] == '' || $data['fecha_renovacion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_renovacion']));

                    $data['longconstime'] = ($data['fecha_renovacion_largo'] == '' || $data['fecha_renovacion_largo'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_renovacion_largo']));



                    if( strlen($data['shorconstime']) ==0 && strlen($data['longconstime'])==0 ){

                        $this->Flash->error(__('Registrar Conservación Corto o Largo plazo.'));
                    }

                    else{
                        $extractionDna = $this->ExtractionDna->patchEntity($extractionDna,$data);

                        if ($this->ExtractionDna->save($extractionDna)) {

                            $list_module = explode('/', $this->request->params['_matchedRoute']);

                            $user_id    = $this->Auth->User('id');
                            $module     = $list_module[(count($list_module)-4)];
                            $action     = $list_module[(count($list_module)-2)].'/'.$list_module[(count($list_module)-1)];
                            $station_id = $extractionDna->id;
                            $recurso_id = '2';

                            $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);


                            $this->Flash->success(__('La Extracción del ADN fue actualizado satisfactoriamente.'));

                            return $this->redirect(['controller' => 'BankDnaZoo', 'action' => 'index']);
                        }
                    }

                } catch (\Exception $e) {

                    $this->Flash->error(__('Hubo inconvenientes al actualizar la Extracción del ADN. Por favor, Otra vez intente.'));
                    return $this->redirect(['controller' => 'BankDnaZoo', 'action' => 'index']);
            }
        }
    }

        $lista_extraccion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 444, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

        $lista_dilucion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 465, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

        $lista_almacenamiento= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 473, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

        $lista_conservacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 477, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

        $lista_almacenamiento_largo= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 473, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

         $extractionDna->extdate = ($extractionDna->extdate == NULL) ? NULL : date('d-m-Y', strtotime($extractionDna->extdate));
         $extractionDna->shorconstime = ($extractionDna->shorconstime == NULL) ? NULL : date('d-m-Y', strtotime($extractionDna->shorconstime));
         $extractionDna->longconstime = ($extractionDna->longconstime == NULL) ? NULL : date('d-m-Y', strtotime($extractionDna->longconstime));

        $this->set(compact('scripts','extractionDna','modulo','lista_extraccion','lista_dilucion','lista_almacenamiento','lista_conservacion','lista_almacenamiento_largo'));

        $this->set('_serialize', ['extractionDna']);

        } else {
                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller' => 'BankDnaZoo']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Extraction Dna id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$child=null)
    {
       $bankDna_count = $this->BankDna->find()->where(['BankDna.status '=>'1','BankDna.id'=>$id,'BankDna.type_resource'=>2])->count();

        if($bankDna_count>0 && $this->permiso['delete']){

            $this->request->is(['post', 'delete']);

            $extracionDnaZoo = $this->ExtractionDna->find()
                                         ->where(['ExtractionDna.status !=' => '0','ExtractionDna.id'=>$child,'ExtractionDna.bank_dna_id'=>$id
                                            ])->first();

            if($extracionDnaZoo==NULL){

                //$this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index',$id]);
            }else{

                $extracionDnaZoo['status'] = 0;

                if ($this->InputDna->save($extracionDnaZoo)) {

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-4)];
                    $action     = $list_module[(count($list_module)-2)].'/'.$list_module[(count($list_module)-1)];
                    $station_id = $extracionDnaZoo->id;
                    $recurso_id = '2';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('La Extracción ADN fue eliminado satisfactoriamente.'));
                } else {
                     $this->Flash->error(__('Hubo inconvenientes al eliminar la Extracción ADN . Por favor, Otra vez intente.'));
                }

               return $this->redirect(['action' => 'index', $extracionDnaZoo->bank_dna_id]);
            }

        }else{

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller' => 'BankDnaZoo']);

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
