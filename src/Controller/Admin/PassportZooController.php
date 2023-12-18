<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

use Cake\Datasource\ConnectionManager;
use PDO;
/**
 * PassportZoo Controller
 *
 * @property \App\Model\Table\PassportZooTable $PassportZoo
 */
class PassportZooController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->loadModel('Passport');
        $this->loadModel('OptionList');
        $this->loadModel('Country');
        $this->loadModel('Station');
        $this->loadModel('Ubigeo');
        $this->loadModel('Specie');
        $this->loadModel('Collection');
        $this->loadModel('ConfigTable');
        $this->loadModel('TempPassportZoo');
        $this->modulo = "Datos de Pasaporte";
        $this->servidor=false;

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
        // $this->paginate = [
        //     // 'limit' => 10,
        //     'contain' => ['Passport']
        // ];
        if($this->permiso['index']){

            $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
            $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                        'assets/js/datatable/dataTables.bootstrap.min',
                        'assets/js/datatable/dataTables.select.min'];

            $passportZoo = $this->PassportZoo->find()->contain('Passport')->where(['Passport.status !=' => '0']);


            // $passportZoo = $this->paginate($query);

            $modulo = $this->modulo;
            $permiso= $this->permiso;

            $this->set(compact('passportZoo', 'modulo','styles','scripts','permiso'));
            $this->set('_serialize', ['passportZoo']);
        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect($this->Auth->redirectUrl());

        }
    }

    /**
     * View method
     *
     * @param string|null $id Passport Zoo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        if($this->permiso['view']){

            $passportZoo = $this->PassportZoo->find()->contain('Passport.Ubigeo')->where(['PassportZoo.id '=>$id])->first();
            $passport = $this->Passport->find()->where(['id '=>$passportZoo->passport_id])->first();
			$lista_promisoria  = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id' => $passportZoo->passport->promissory ])->first();

            $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

            if($passportZoo ==NULL){

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller'=>'PassportZoo']);

            }else{

                $modulo = $this->modulo;
                $permiso= $this->permiso;

                $this->set(compact('passportZoo', 'modulo','permiso','validar','lista_promisoria'));
                $this->set('_serialize', ['passportZoo']);
            }
        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect($this->Auth->redirectUrl());

        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        if($this->permiso['add']){

            $passportZoo = $this->PassportZoo->newEntity();
            $passport    = $this->Passport->newEntity();
            //$scripts = ['assets/js/fileinput/fileinput.min','assets/packages/jqueryvalidation/dist/jquery.validate'];

            if ($this->request->is('post')) {

                try {

                    $dataSource = \Cake\Datasource\ConnectionManager::get('default');

                    $dataSource->begin();

                    $data =  $this->request->getData();

                    /**** Grabamos el model Pasaporte ***/
					
					$accname['accname'] = $this->Passport->find()->where(['accname' => $data['passport']['accname'] ])->toArray();
					
					if($accname['accname'] !=null){
						
					$data['passport']['accenumb'] = 'PER2'.str_pad($passportZoo->passzoogenetico, 6, "0", STR_PAD_LEFT);
					$query_1 = false;
					}
					else {
					
                    $data['passport']['accenumb'] = 'PER2'.str_pad($passportZoo->passzoogenetico, 6, "0", STR_PAD_LEFT);
                    $data['passport']['station_origin_id'] = $data['passportZoo']['eeaproc'];
                    $data['passport']['station_current_id'] = $data['passportZoo']['eea'];
                    $data['passport']['resource_id'] = '2';
                    $data['passport']['status'] = '1';
					
                    $passport = $this->Passport->patchEntity($passport, $data['passport']);
                    $query_1 = $this->Passport->save($passport);
					}

                    /******* Grabamos el modelo detalle Pasaporte fitogenetico *******/
                    $data['passportZoo']['passport_id'] = $passport['id'];
                    $data['passportZoo']['acqdate'] = ($data['fecha_ingreso'] == '' || $data['fecha_ingreso'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_ingreso']));
                    $data['passportZoo']['colldate'] = ($data['fecha_recoleccion'] == '' || $data['fecha_recoleccion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_recoleccion']));

                    $data['passportZoo']['datebirth'] = ($data['fecha_nacimiento'] == '' || $data['fecha_nacimiento'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_nacimiento']));
                    $data['passportZoo']['dateofdec'] = ($data['fecha_deceso'] == '' || $data['fecha_deceso'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_deceso']));

                    if(isset($passport['specie_id'])){

                        $especie_result = $this->Specie->find()->where([ 'id' => $passport['specie_id'] ])->first();

                        $data['passportZoo']['colname'] = $especie_result->collection_id;
                        $data['passportZoo']['genus'] = $especie_result->genus;
                        $data['passportZoo']['species'] = $especie_result->species;
                        $data['passportZoo']['husbname'] = $especie_result->cropname;
                    }

                    /****  Carga de Imagenes  ***/
                    $dir_subida = WWW_ROOT.'pass_zoogenetico'.DS;

                    /********* Imagen 1 *********/
                    if(!empty($data['imagen_1'])){

                        $data['imagen_1']['name'] = $data['passport']['accenumb'].'_1.jpg';
                        $fichero_subido_1 = $dir_subida . basename($data['imagen_1']['name']);
                        if(move_uploaded_file($data['imagen_1']['tmp_name'], $fichero_subido_1))
                            $data['passportZoo']['accimag1'] = 'pass_zoogenetico/'.$data['passport']['accenumb'].'_1.jpg';
                    }

                    /********* Imagen 2 *********/
                    if(!empty($data['imagen_2'])){

                        $data['imagen_2']['name'] = $data['passport']['accenumb'].'_2.jpg';
                        $fichero_subido_2 = $dir_subida . basename($data['imagen_2']['name']);
                        if(move_uploaded_file($data['imagen_2']['tmp_name'], $fichero_subido_2))
                            $data['passportZoo']['accimag2'] = 'pass_zoogenetico/'.$data['passport']['accenumb'].'_2.jpg';
                    }

                    /******** Imagen 3 ********/
                    if(!empty($data['imagen_3'])){

                        $data['imagen_3']['name'] = $data['passport']['accenumb'].'_3.jpg';
                        $fichero_subido_3 = $dir_subida . basename($data['imagen_3']['name']);
                        if(move_uploaded_file($data['imagen_3']['tmp_name'], $fichero_subido_3))
                            $data['passportZoo']['accimag3'] = 'pass_zoogenetico/'.$data['passport']['accenumb'].'_3.jpg';
                    }

                    /********* Imagen 4 *********/
                    if(!empty($data['imagen_4'])){

                        $data['imagen_4']['name'] = $data['passport']['accenumb'].'_4.jpg';
                        $fichero_subido_4 = $dir_subida . basename($data['imagen_4']['name']);
                        if(move_uploaded_file($data['imagen_4']['tmp_name'], $fichero_subido_4))
                            $data['passportZoo']['accimag4'] = 'pass_zoogenetico/'.$data['passport']['accenumb'].'_4.jpg';
                    }

                    if(!$this->servidor){

                      if($data['imagen_1']['error'] != 4){

                        $dir_nuevo_img='..\..\inia_web\modulos\es\img\catalogo'.DS.$data['imagen_1']['name'] ;
                        copy($fichero_subido_1 , $dir_nuevo_img);
                      }

                      if($data['imagen_2']['error'] != 4){
                        $dir_nuevo_img='..\..\inia_web\modulos\en\img\catalogo'.DS.$data['imagen_2']['name'] ;
                        copy($fichero_subido_2 , $dir_nuevo_img);
                      }

                      if($data['imagen_3']['error'] != 4){
                        $dir_nuevo_img='..\..\inia_web\modulos\es\img\catalogo'.DS.$data['imagen_3']['name'] ;
                        copy($fichero_subido_3 , $dir_nuevo_img);
                      }

                      if($data['imagen_4']['error'] != 4){
                        $dir_nuevo_img='..\..\inia_web\modulos\en\img\catalogo'.DS.$data['imagen_4']['name'] ;
                        copy($fichero_subido_4 , $dir_nuevo_img);
                      }
                    }

                    if($this->servidor){

                      if($data['imagen_1']['error'] != 4){
                         $dir_ingles_img= '../../../public_html/modulos/en/img/catalogo'.DS.$data['imagen_1']['name'] ;
                         $dir_spanish_img='../../../public_html/modulos/es/img/catalogo'.DS.$data['imagen_1']['name'] ;
                         copy($fichero_subido_1 ,$dir_ingles_img);
                         copy($fichero_subido_1 , $dir_spanish_img);
                      }

                      if($data['imagen_2']['error'] != 4){
                         $dir_ingles_img= '../../../public_html/modulos/en/img/catalogo'.DS.$data['imagen_2']['name'] ;
                         $dir_spanish_img='../../../public_html/modulos/es/img/catalogo'.DS.$data['imagen_2']['name'] ;
                         copy($fichero_subido_2 ,$dir_ingles_img);
                         copy($fichero_subido_2 , $dir_spanish_img);
                      }

                      if($data['imagen_3']['error'] != 4){
                         $dir_ingles_img= '../../../public_html/modulos/en/img/catalogo'.DS.$data['imagen_3']['name'] ;
                         $dir_spanish_img='../../../public_html/modulos/es/img/catalogo'.DS.$data['imagen_3']['name'] ;
                         copy($fichero_subido_3 ,$dir_ingles_img);
                         copy($fichero_subido_3 , $dir_spanish_img);
                      }

                      if($data['imagen_4']['error'] != 4){
                         $dir_ingles_img= '../../../public_html/modulos/en/img/catalogo'.DS.$data['imagen_4']['name'] ;
                         $dir_spanish_img='../../../public_html/modulos/es/img/catalogo'.DS.$data['imagen_4']['name'] ;
                         copy($fichero_subido_4 ,$dir_ingles_img);
                         copy($fichero_subido_4 , $dir_spanish_img);
                      }
                    }

                    $passportZoo = $this->PassportZoo->patchEntity($passportZoo, $data['passportZoo']);
					if($passport['id'] !=null){
                    $query_2 = $this->PassportZoo->save($passportZoo);
					}

                    if ($query_1 && $query_2) {

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-2)];
                        $action     = $list_module[(count($list_module)-1)];
                        $station_id = $query_2->id;
                        $recurso_id = '2';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $dataSource->commit();
                        $this->Flash->success(__('Pasaporte Zoogenético creado satisfactoriamente.'));
                        return $this->redirect(['action' => 'index']);

                    } else {
						if(!$query_1){
                        $this->Flash->error(__('Hubo inconvenientes al crear el Pasaporte Zoogenetico. Nombre de la Accesión esta siendo utilizado.'));
                        return $this->redirect(['action' => 'add']);
						}
						else {
                        $dataSource->rollback();
                        $this->Flash->error(__('Hubo inconvenientes al crear el Pasaporte Zoogenetico. Por favor, Otra vez intente.'));
                        return $this->redirect(['action' => 'index']);
						}
                    }

                } catch (\Exception $e) {

                    $this->Flash->error(__('Debe completar todos los campos requeridos. Por favor, Otra vez intente.'));
                    return $this->redirect(['action' => 'add']);
                }
            }

            $scripts = ['assets/js/fileinput/fileinput.min','assets/js/fileinput/fileinput.min','assets/packages/jqueryvalidation/dist/jquery.validate'];

            $tipo_recursos     = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['child_id' => 3, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
            $tipo_conservacion = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 4, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
            $station           = $this->Station->find('list', ['keyField' => 'id', 'valueField' => 'eea'])->where(['status' => 1, 'availability' => 1]);
            $disp_accesion     = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 26, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
            $colecciones       = $this->Collection->find()->where(['status' => 1, 'availability' => 1, 'resource_id' => 2])->order(['colname' => 'ASC']);

            $departamento      = $this->Ubigeo->find()->where(['cod_pro' => 0]);
            $paises            = $this->Country->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1]);

            $coordenadas       = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 11, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
            $georref           = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 16, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
            $fuentes           = $this->OptionList->find()->where(['parent_id' => 44, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);

            $cond_biologicas   = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 722, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]]])->order(['name']);

            $sis_multilateral  = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 29, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
            $adn               = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 41, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);

            $passpor_validation = $this->ConfigTable->find()->where(['resource_id' => 2, 'table_name' => 'passport', 'status' => 1])->first();
            $passzoo_validation = $this->ConfigTable->find()->where(['resource_id' => 2, 'table_name' => 'passport_zoo', 'status' => 1])->first();

             $cadena='';

            if($passpor_validation!=NULL)
                     $cadena.=$passpor_validation->validation;

            if($passpor_validation!=NULL && $passzoo_validation!=NULL)
               $cadena.=',';

            if($passzoo_validation!=NULL)
               $cadena.=$passzoo_validation->validation;

            $lista=explode(',', $cadena);

            $lista_promisoria   = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 699, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);

            $modulo = $this->modulo;

            $this->set(compact('passportZoo', 'passport', 'modulo', 'scripts', 'tipo_recursos', 'tipo_conservacion', 'station', 'disp_accesion',
                               'colecciones', 'departamento', 'paises', 'coordenadas', 'georref', 'fuentes', 'cond_biologicas', 'sis_multilateral',
                               'adn', 'passpor_validation', 'passzoo_validation', 'lista_promisoria','lista'));
            $this->set('_serialize', ['passportZoo']);
        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect($this->Auth->redirectUrl());

        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Passport Zoo id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $passportZoo = $this->PassportZoo->find()->where(['PassportZoo.id '=>$id])->first();

        $passport = $this->Passport->find()->where(['id '=>$passportZoo->passport_id])->first();
        $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if($this->permiso['edit'] /*&& $validar*/){



            if ($passportZoo != NULL) {

                $passport = $this->Passport->get($passportZoo->passport_id, [
                'contain' => []
                ]);

                $scripts = ['assets/js/fileinput/fileinput.min','assets/packages/jqueryvalidation/dist/jquery.validate'];

                if($passport['status'] == 1){

                    if ($this->request->is(['patch', 'post', 'put'])) {

                        $dataSource = \Cake\Datasource\ConnectionManager::get('default');

                        $dataSource->begin();

                        $data =  $this->request->getData();

                        /**** Grabamos el model Pasaporte ***/
						
						$accname['accname'] = $this->Passport->find()->where(['accname' => $data['passport']['accname'] ])->toArray();
						
						/*if($accname['accname'] !=null){
							
							if($accname['accname'][0]['accenumb']==$passport['accenumb']){
								$data['passport']['station_origin_id'] = $data['passportZoo']['eeaproc'];
								$data['passport']['station_current_id'] = $data['passportZoo']['eea'];
								$passport = $this->Passport->patchEntity($passport, $data['passport']);
								$query_1 = $this->Passport->save($passport);
							}
							else
							{
							$query_1 = false;	
							}
						}
						else {
                        $data['passport']['station_origin_id'] = $data['passportZoo']['eeaproc'];
                        $data['passport']['station_current_id'] = $data['passportZoo']['eea'];
						
                        $passport = $this->Passport->patchEntity($passport, $data['passport']);
                        $query_1 = $this->Passport->save($passport);
						}*/
						
						$data['passport']['station_origin_id'] = $data['passportZoo']['eeaproc'];
                        $data['passport']['station_current_id'] = $data['passportZoo']['eea'];
						
                        $passport = $this->Passport->patchEntity($passport, $data['passport']);
                        $query_1 = $this->Passport->save($passport);

                        /******* Grabamos el modelo detalle Pasaporte fitogenetico *******/
                        $data['passportZoo']['acqdate'] = ($data['fecha_ingreso'] == '' || $data['fecha_ingreso'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_ingreso']));
                        $data['passportZoo']['colldate'] = ($data['fecha_recoleccion'] == '' || $data['fecha_recoleccion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_recoleccion']));

                        $data['passportZoo']['datebirth'] = ($data['fecha_nacimiento'] == '' || $data['fecha_nacimiento'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_nacimiento']));
                        $data['passportZoo']['dateofdec'] = ($data['fecha_deceso'] == '' || $data['fecha_deceso'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_deceso']));

                        if(!empty($passport['specie_id']) && $passport['specie_id'] == NULL){

                            $especie_result = $this->Specie->find()->where([ 'id' => $passport['specie_id'] ])->first();

                            $data['passportZoo']['colname'] = $especie_result->collection_id;
                            $data['passportZoo']['genus'] = $especie_result->genus;
                            $data['passportZoo']['species'] = $especie_result->species;
                            $data['passportZoo']['husbname'] = $especie_result->cropname;
                        }

                        /****  Carga de Imagenes  ***/
                        $dir_subida = WWW_ROOT.'pass_zoogenetico'.DS;

                        /********* Imagen 1 *********/
                        if(!empty($data['imagen_1'])){

                            $data['imagen_1']['name'] = $passport['accenumb'].'_1.jpg';
                            $fichero_subido_1 = $dir_subida . basename($data['imagen_1']['name']);
                            if(move_uploaded_file($data['imagen_1']['tmp_name'], $fichero_subido_1))
                                $data['passportZoo']['accimag1'] = 'pass_zoogenetico/'.$passport['accenumb'].'_1.jpg';
                        }

                        /********* Imagen 2 *********/
                        if(!empty($data['imagen_2'])){

                            $data['imagen_2']['name'] = $passport['accenumb'].'_2.jpg';
                            $fichero_subido_2 = $dir_subida . basename($data['imagen_2']['name']);
                            if(move_uploaded_file($data['imagen_2']['tmp_name'], $fichero_subido_2))
                                $data['passportZoo']['accimag2'] = 'pass_zoogenetico/'.$passport['accenumb'].'_2.jpg';
                        }

                        /******** Imagen 3 ********/
                        if(!empty($data['imagen_3'])){

                            $data['imagen_3']['name'] = $passport['accenumb'].'_3.jpg';
                            $fichero_subido_3 = $dir_subida . basename($data['imagen_3']['name']);
                            if(move_uploaded_file($data['imagen_3']['tmp_name'], $fichero_subido_3))
                                $data['passportZoo']['accimag3'] = 'pass_zoogenetico/'.$passport['accenumb'].'_3.jpg';
                        }

                        /********* Imagen 4 *********/
                        if(!empty($data['imagen_4'])){

                            $data['imagen_4']['name'] = $passport['accenumb'].'_4.jpg';
                            $fichero_subido_4 = $dir_subida . basename($data['imagen_4']['name']);
                            if(move_uploaded_file($data['imagen_4']['tmp_name'], $fichero_subido_4))
                                $data['passportZoo']['accimag4'] = 'pass_zoogenetico/'.$passport['accenumb'].'_4.jpg';
                        }

                        if(!$this->servidor){
                        //Localmente
                          if($data['imagen_1']['error'] != 4){
                            $dir_nuevo_img='..\..\inia_web\modulos\es\img\catalogo'.DS.$data['imagen_1']['name'] ;
                            copy($fichero_subido_1 , $dir_nuevo_img);
                          }

                          if($data['imagen_2']['error'] != 4){
                            $dir_nuevo_img='..\..\inia_web\modulos\en\img\catalogo'.DS.$data['imagen_2']['name'] ;
                            copy($fichero_subido_2 , $dir_nuevo_img);
                          }

                          if($data['imagen_3']['error'] != 4){
                            $dir_nuevo_img='..\..\inia_web\modulos\es\img\catalogo'.DS.$data['imagen_3']['name'] ;
                            copy($fichero_subido_3 , $dir_nuevo_img);
                          }

                          if($data['imagen_4']['error'] != 4){
                            $dir_nuevo_img='..\..\inia_web\modulos\en\img\catalogo'.DS.$data['imagen_4']['name'] ;
                            copy($fichero_subido_4 , $dir_nuevo_img);
                          }
                        }

                        if($this->servidor){
                        //Servidor
                          if($data['imagen_1']['error'] != 4){
                             $dir_ingles_img= '../../../public_html/modulos/en/img/catalogo'.DS.$data['imagen_1']['name'] ;
                             $dir_spanish_img='../../../public_html/modulos/es/img/catalogo'.DS.$data['imagen_1']['name'] ;
                             copy($fichero_subido_1 ,$dir_ingles_img);
                             copy($fichero_subido_1 , $dir_spanish_img);
                          }

                          if($data['imagen_2']['error'] != 4){
                             $dir_ingles_img= '../../../public_html/modulos/en/img/catalogo'.DS.$data['imagen_2']['name'] ;
                             $dir_spanish_img='../../../public_html/modulos/es/img/catalogo'.DS.$data['imagen_2']['name'] ;
                             copy($fichero_subido_2 ,$dir_ingles_img);
                             copy($fichero_subido_2 , $dir_spanish_img);
                          }

                          if($data['imagen_3']['error'] != 4){
                             $dir_ingles_img= '../../../public_html/modulos/en/img/catalogo'.DS.$data['imagen_3']['name'] ;
                             $dir_spanish_img='../../../public_html/modulos/es/img/catalogo'.DS.$data['imagen_3']['name'] ;
                             copy($fichero_subido_3 ,$dir_ingles_img);
                             copy($fichero_subido_3 , $dir_spanish_img);
                          }

                          if($data['imagen_4']['error'] != 4){
                             $dir_ingles_img= '../../../public_html/modulos/en/img/catalogo'.DS.$data['imagen_4']['name'] ;
                             $dir_spanish_img='../../../public_html/modulos/es/img/catalogo'.DS.$data['imagen_4']['name'] ;
                             copy($fichero_subido_4 ,$dir_ingles_img);
                             copy($fichero_subido_4 , $dir_spanish_img);
                          }
                        }

                        $passportZoo = $this->PassportZoo->patchEntity($passportZoo, $data['passportZoo']);
						if($passport['id'] !=null){
                        $query_2 = $this->PassportZoo->save($passportZoo);
						}

                        if ($query_1 && $query_2) {

                            $list_module = explode('/', $this->request->params['_matchedRoute']);

                            $user_id    = $this->Auth->User('id');
                            $module     = $list_module[(count($list_module)-3)];
                            $action     = $list_module[(count($list_module)-2)];
                            $station_id = $query_2->id;
                            $recurso_id = '2';

                            $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                            $dataSource->commit();
                            $this->Flash->success(__('Pasaporte Zoogenético actualizado satisfactoriamente.'));
                            return $this->redirect(['action' => 'index']);

                        } else {
							if(!$query_1){
							$this->Flash->error(__('Hubo inconvenientes al crear el Pasaporte Zoogenetico. Nombre de la Accesión esta siendo utilizado.'));
							return $this->redirect(['action' => 'index']);
							}
							else {
                            $dataSource->rollback();
                            $this->Flash->error(__('Hubo inconvenientes al actualizar el Pasaporte Zoogenetico. Por favor, Otra vez intente.'));
                            return $this->redirect(['action' => 'index']);
							}
                        }
                    }

                    $tipo_recursos = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['child_id' => 3, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
                    $colecciones = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])
                                        ->where(['status' => 1, 'availability' => 1, 'resource_id' => 2])->order(['colname' => 'ASC']);

                    if($passport->specie_id == NULL || $passport->specie_id == ''){

                        $especies = [];
                        $especie_lista = [];

                    } else {

                    $especies = $this->Specie->find()->where(['id' => $passport->specie_id])->first();
                    $especie_lista = $this->Specie->find('list', ['keyField' => 'id',
                                                                  'valueField' => function ($row) {
                                                                        return mb_strtoupper($row['genus'],'UTF-8') . ' | ' . mb_strtoupper($row['species'],'UTF-8');
                                                                    }])
                                          ->where(['collection_id'=>$especies->collection_id, 'status' => 1]);
                    }

                    $tipo_conservacion = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 4, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
                    $station           = $this->Station->find('list', ['keyField' => 'id', 'valueField' => 'eea'])->where(['status' => 1, 'availability' => 1]);
                    $disp_accesion     = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 26, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);

                    $paises       = $this->Country->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1]);
                    $coordenadas  = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 11, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
                    $georref      = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 16, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
                    $departamento = $this->Ubigeo->find()->where(['cod_pro' => 0]);

                    /************ VALIDAMOS LA EXISTENCIA DEL UBIGEO *************/
                    if($passport->ubigeo_id == NULL || $passport->ubigeo_id == ''){

                        $ubigeo_descrip = "";
                        $provincia_id   = "";
                        $provincias     = [];
                        $distritos      = [];

                    } else {

                        $ubigeo_descrip = $this->Ubigeo->find()->where(['id' => $passport->ubigeo_id])->first();
                        $provincia_id   = $this->Ubigeo->find()->where(['cod_dep'=>$ubigeo_descrip->cod_dep, 'cod_pro'=>$ubigeo_descrip->cod_pro, 'cod_dis'=>0])->first();
                        $provincias     = $this->Ubigeo->find('list', ['keyField' => 'id', 'valueField' => 'nombre'])->where(['cod_dep' => $ubigeo_descrip->cod_dep, 'cod_pro !=' => 0, 'cod_dis' => 0]);
                        $distritos      = $this->Ubigeo->find('list', ['keyField' => 'id', 'valueField' => 'nombre'])->where(['cod_dep' => $ubigeo_descrip->cod_dep, 'cod_pro' => $ubigeo_descrip->cod_pro, 'cod_dis !=' => 0]);

                    }

                    $fuentes          = $this->OptionList->find()->where(['parent_id' => 44, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
                    $fuente_detalle   = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['child_id' => $passportZoo->collsrc, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]]]);

                    $cond_biologicas  = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 722, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]]]);

                    $sis_multilateral = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 29, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);
                    $adn              = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 41, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);

                    $passpor_validation = $this->ConfigTable->find()->where(['resource_id' => 2, 'table_name' => 'passport', 'status' => 1])->first();
                    $passzoo_validation = $this->ConfigTable->find()->where(['resource_id' => 2, 'table_name' => 'passport_zoo', 'status' => 1])->first();

                       $cadena='';

                      if($passpor_validation!=NULL)
                               $cadena.=$passpor_validation->validation;

                      if($passpor_validation!=NULL && $passzoo_validation!=NULL)
                         $cadena.=',';

                      if($passzoo_validation!=NULL)
                         $cadena.=$passzoo_validation->validation;

                      $lista=explode(',', $cadena);

                    $lista_promisoria   = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 699, 'status' => 1, 'OR' => [['resource_id' => 2], ['resource_id' => 4]] ]);

                    $modulo = $this->modulo;

                    /***** Modificando el formato de fechas *******/
                    $passportZoo->acqdate   = ($passportZoo->acqdate == NULL) ? NULL : date('d-m-Y', strtotime($passportZoo->acqdate));
                    $passportZoo->colldate  = ($passportZoo->colldate == NULL) ? NULL : date('d-m-Y', strtotime($passportZoo->colldate));
                    $passportZoo->datebirth = ($passportZoo->datebirth == NULL) ? NULL : date('d-m-Y', strtotime($passportZoo->datebirth));
                    $passportZoo->dateofdec = ($passportZoo->dateofdec == NULL) ? NULL : date('d-m-Y', strtotime($passportZoo->dateofdec));

                    $this->set(compact('passportZoo', 'passport', 'scripts', 'modulo', 'tipo_recursos', 'colecciones', 'especies', 'especie_lista', 'station',
                                       'tipo_conservacion', 'disp_accesion', 'paises', 'coordenadas', 'georref', 'departamento', 'ubigeo_descrip', 'provincia_id',
                                       'provincias', 'distritos', 'sis_multilateral', 'adn', 'fuentes', 'fuente_detalle',
                                       'cond_biologicas', 'passpor_validation', 'passzoo_validation', 'lista_promisoria','lista'));

                    $this->set('_serialize', ['passportZoo']);

                } else {
                     $this->Flash->error(__('Operación denegada.'));

                    return $this->redirect(['action' => 'index']);
                }
            }else{

                 $this->Flash->error(__('Operación denegada.'));
                    return $this->redirect(['action' => 'index']);
            }
        }else{

                 $this->Flash->error(__('Operación denegada.'));
                    return $this->redirect(['action' => 'index']);
        }

    }

    /**
     * Delete method
     *
     * @param string|null $id Passport Zoo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $passportZoo = $this->PassportZoo->find()->where(['PassportZoo.id '=>$id])->first();
        $passport = $this->Passport->find()->where(['id '=>$passportZoo->passport_id])->first();
        $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if($this->permiso['delete'] /*&& $validar*/){



            if ($passportZoo != NULL) {

                $this->request->is(['post', 'delete']);

                $passportZoo = $this->PassportZoo->get($id);

                if($passportZoo->validacion > 0 ){

                    $this->Flash->error(__('Imposible eliminar el registro. Hay registros asociados al pasaporte.'));
                    return $this->redirect(['action' => 'index','controller' => 'PassportZoo']);

                } else {

                    $passportZoo['modified'] = date('Y-m-d H:i:s');

                    $passport = $this->Passport->get($passportZoo->passport_id);
                    $passport['status'] = 0;

                    if ($this->Passport->save($passport) && $this->PassportZoo->save($passportZoo)) {

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-3)];
                        $action     = $list_module[(count($list_module)-2)];
                        $station_id = $passportZoo->id;
                        $recurso_id = '2';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Pasaporte Zoogenético eliminado satisfactoriamente.'));

                    } else {

                        $this->Flash->error(__('Hubo inconvenientes al eliminar el Pasaporte Zoogenético. Por favor, Otra vez intente.'));
                    }

                    return $this->redirect(['action' => 'index']);
                }

            }else{

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index','controller' => 'PassportZoo']);
            }
        }else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /********* Action para la descarga de archivo de plantilla **********/
    public function export()
    {
        if($this->permiso['export']){

            $filePath = WWW_ROOT .'pass_plantillas'. DS . 'pass_zoogenetico.xlsx';

            $this->response->file($filePath , array('download'=> true));

            return $this->response;
        }else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /********* Action para la carga de archivos de passaporte **********/
    public function import()
    {
        if($this->permiso['import']){

            $passportZoo = $this->PassportZoo->newEntity();
            $passport = $this->Passport->newEntity();

            if ($this->request->is('post'))
            {
                $data =  $this->request->getData();

                $especie_id = $data['passport']['specie_id'];

                $especies = $this->Specie->find()->where(['id' => $especie_id])->first();
                $collections = $this->Collection->find()->where(['id' => $especies->collection_id])->first();

                /****  Carga de archivo  ***/
                $dir_subida = WWW_ROOT.'pass_zoogenetico'.DS;
                $fichero_subido = $dir_subida . basename($data['file_carga']['name']);
                $file_input = $data['file_carga']['name'];  // SE CARGA EL NOMBRE DEL ARCHIVO CARGADO

                if(move_uploaded_file($data['file_carga']['tmp_name'], $fichero_subido))
                {
                    $inputFileName = $fichero_subido;

                    try
                    {
                        $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
                        $objReader     = \PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel   = $objReader->load($inputFileName);

                        //  Get worksheet dimensions
                        $sheet         = $objPHPExcel->getSheet(0);
                        $highestRow    = $sheet->getHighestRow();

                        if($highestRow > 2){

                          $highestColumn = $sheet->getHighestColumn();
                          $total_column  = \PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());

                          //************************* NOMBRES DE LAS CABECERAS ***************************//
                          $header_excel = array('COD. FAO','NOMBRE DE LA ACCESIÓN','OTRO CÓDIGO ACCESIÓN','ESTACIÓN EXPERIMENTAL',
                                                'ESTACIÓN EXPERIMENTAL DE PROCEDENCIA','PAÍS ORIGEN','DEPARTAMENTO','PROVINCIA','DISTRITO',
                                                'LOCALIDAD','PROMISORIA','SUBTIPO DE RECURSO','CÓDIGO DE COLECTA','AUTOR ESPECIE','SUBTAXON',
                                                'SUBTAXON AUTOR','TIPO DE RAZA','TIPO CONSERVACIÓN','FECHA INGRESO','DISPONIBILIDAD',
                                                'REFERENCIA','LATITUD','LONGITUD','ELEVACIÓN','TIPO COORDENADAS','MÉTODO DE GEOREFERENCIACIÓN',
                                                'CÓDIGO DEL INSTITUTO DE COLECTA','NOMBRE COLECTOR','DIRECCIÓN COLECTOR','MISIÓN DE COLECTA','NOMBRE LOCAL',
                                                'FECHA DE RECOLECCIÓN','CONDICIÓN BIOLÓGICA (DETALLE)','FUENTE','FUENTE DETALLE','GRUPO ÉTNICO',
                                                'FECHA DE NACIMIENTO','FECHA DECESO','TIPO DE MUESTRA','TIPO MUESTREO','PARTE ÚTILES DEL ANIMAL',
                                                'USO DEL ANIMAL','PATÓGENO','ÁREA','HUMEDAD AMBIENTE','TEMPERATURA AMBIENTE','PRESIÓN ATMOSFÉRICA',
                                                'PRECIPITATIÓN','ANCESTRO MATERNO','ANCESTRO PATERNO','DATOS ANCESTRALES','CRIADOR (PROPIETARIO)',
                                                'DIRECCIÓN DEL CRIADOR','CÓDIGO DEL DONANTE','NOMBRE DEL DONANTE','DIRECCIÓN DEL DONANTE',
                                                'SISTEMA MULTILATERAL','PATENTE','CÓDIGO INSTITUTO DE MEJORAMIENTO',
                                                'NOMBRE INSTITUTO DE MEJORAMIENTO','NOMBRE DEL LUGAR - DUPLICADOS DE SEGURIDAD',
                                                'UBICACIÓN - DUPLICADOS DE SEGURIDAD','BANCO ADN','ANOTACIONES');

                          if($total_column == 64)
                          {
                              $cont = 0;
                              for ($row = 2; $row < 3; $row++){

                                  $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                                  for ($i=0; $i < $total_column; $i++) {

                                      if($header_excel[$i] == trim($rowData[0][$i])){
                                          $cont++;
                                      }
                                  }
                              }

                              /************************ SE VERIFICA LOS NOMBRES DE LAS CABECERAS ***********************/
                              if($cont == $total_column){

                                  $conn = ConnectionManager::get('default');

                                  $uid = $this->Auth->User('id');

                                  /******** SE ELIMINA LOS REGISTROS ANTERIORES ********/
                                  $sql_1 = $conn->prepare(" DELETE FROM temp_passport_zoo WHERE resource_id = 2 AND user_id = ? ");
                                  $sql_1->bindValue(1, $uid, PDO::PARAM_STR);
                                  $sql_1->execute();

                                  for ($row = 3; $row <= $highestRow; $row++)
                                  {
                                      //  Read a row of data into an array
                                      $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                                      $temp = TableRegistry::get('TempPassportZoo');
                                      $temp_passport = $temp->newEntity();

                                      $temp_passport->coleccion         = $collections->colname;
                                      $temp_passport->nombre_especie    = $especies->species;
                                      $temp_passport->nombre_comun      = $especies->cropname;
                                      $temp_passport->genero_especie    = $especies->genus;
                                      $temp_passport->instcode          = $rowData[0][0];
                                      $temp_passport->accname           = $rowData[0][1];
                                      $temp_passport->othenumb          = $rowData[0][2];
                                      $temp_passport->station_current_id= $rowData[0][3];
                                      $temp_passport->station_origin_id = $rowData[0][4];
                                      $temp_passport->pais              = $rowData[0][5];
                                      $temp_passport->departamento      = $rowData[0][6];
                                      $temp_passport->provincia         = $rowData[0][7];
                                      $temp_passport->distrito          = $rowData[0][8];
                                      $temp_passport->localidad         = $rowData[0][9];
                                      $temp_passport->promissory        = $rowData[0][10];
                                      $temp_passport->subtype           = $rowData[0][11];
                                      $temp_passport->collnumb          = $rowData[0][12];
                                      $temp_passport->spauthor          = $rowData[0][13];
                                      $temp_passport->subtaxa           = $rowData[0][14];
                                      $temp_passport->subtauthor        = $rowData[0][15];
                                      $temp_passport->racetype          = $rowData[0][16];
                                      $temp_passport->storage           = $rowData[0][17];

                                      if($rowData[0][18] == '' || $rowData[0][18] == NULL){

                                          $temp_passport->acqdate = $rowData[0][18];

                                      } else {
                                          // utilizo la función y obtengo el timestamp
                                          $timestamp_1 = \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][18]);
                                          $fecha_php_1 = gmdate("Y-m-d",$timestamp_1);
                                          $temp_passport->acqdate = $fecha_php_1;
                                      }

                                      $temp_passport->availability      = $rowData[0][19];
                                      $temp_passport->collsite          = $rowData[0][20];
                                      $temp_passport->latitude          = $rowData[0][21];
                                      $temp_passport->longitude         = $rowData[0][22];
                                      $temp_passport->elevation         = $rowData[0][23];
                                      $temp_passport->coorddatum        = $rowData[0][24];
                                      $temp_passport->georefmeth        = $rowData[0][25];
                                      $temp_passport->collcode          = $rowData[0][26];
                                      $temp_passport->collname          = $rowData[0][27];
                                      $temp_passport->colladdress       = $rowData[0][28];
                                      $temp_passport->collmissind       = $rowData[0][29];
                                      $temp_passport->localname         = $rowData[0][30];

                                      if($rowData[0][31] == '' || $rowData[0][31] == NULL){

                                          $temp_passport->colldate = $rowData[0][31];

                                      } else {
                                          // utilizo la función y obtengo el timestamp
                                          $timestamp_2 = \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][31]);
                                          $fecha_php_2 = gmdate("Y-m-d",$timestamp_2);
                                          $temp_passport->colldate = $fecha_php_2;
                                      }

                                      $temp_passport->sampstat          = $rowData[0][32];
                                      $temp_passport->collsrc           = $rowData[0][33];
                                      $temp_passport->collsrcdet        = $rowData[0][34];
                                      $temp_passport->groupethnic       = $rowData[0][35];

                                      if($rowData[0][36] == '' || $rowData[0][36] == NULL){

                                          $temp_passport->datebirth = $rowData[0][36];

                                      } else {
                                          // utilizo la función y obtengo el timestamp
                                          $timestamp_3 = \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][36]);
                                          $fecha_php_3 = gmdate("Y-m-d",$timestamp_3);
                                          $temp_passport->datebirth = $fecha_php_3;
                                      }

                                      if($rowData[0][37] == '' || $rowData[0][37] == NULL){

                                          $temp_passport->dateofdec = $rowData[0][37];

                                      } else {
                                          // utilizo la función y obtengo el timestamp
                                          $timestamp_4 = \PHPExcel_Shared_Date::ExcelToPHP($rowData[0][37]);
                                          $fecha_php_4 = gmdate("Y-m-d",$timestamp_4);
                                          $temp_passport->dateofdec = $fecha_php_4;
                                      }

                                      $temp_passport->samptype          = $rowData[0][38];
                                      $temp_passport->sampling          = $rowData[0][39];
                                      $temp_passport->anuspart          = $rowData[0][40];
                                      $temp_passport->uso               = $rowData[0][41];
                                      $temp_passport->pathogen          = $rowData[0][42];
                                      $temp_passport->poparea           = $rowData[0][43];
                                      $temp_passport->humidity          = $rowData[0][44];
                                      $temp_passport->temp              = $rowData[0][45];
                                      $temp_passport->presure           = $rowData[0][46];
                                      $temp_passport->precipitation     = $rowData[0][47];
                                      $temp_passport->mancest           = $rowData[0][48];
                                      $temp_passport->pancest           = $rowData[0][49];
                                      $temp_passport->ancest            = $rowData[0][50];
                                      $temp_passport->owname            = $rowData[0][51];
                                      $temp_passport->owaddress         = $rowData[0][52];
                                      $temp_passport->donorcore         = $rowData[0][53];
                                      $temp_passport->donorname         = $rowData[0][54];
                                      $temp_passport->donaddress        = $rowData[0][55];
                                      $temp_passport->mlsstat           = $rowData[0][56];
                                      $temp_passport->patent            = $rowData[0][57];
                                      $temp_passport->bredcode          = $rowData[0][58];
                                      $temp_passport->bredname          = $rowData[0][59];
                                      $temp_passport->duplinstname      = $rowData[0][60];
                                      $temp_passport->duplsite          = $rowData[0][61];
                                      $temp_passport->bdna              = $rowData[0][62];
                                      $temp_passport->remarks           = $rowData[0][63];
                                      $temp_passport->resource_id       = '2';
                                      $temp_passport->user_id           = $uid;
                                      $temp->save($temp_passport);
                                  }

                                  /*************** SE VALIDA Y EJECUTA STORE **************/
                                  $tabla_1 = $this->ConfigTable->find()->where(['table_name' => 'passport', 'resource_id' => 2, 'status' => 1])->count();
                                  $tabla_2 = $this->ConfigTable->find()->where(['table_name' => 'passport_zoo', 'resource_id' => 2, 'status' => 1])->count();

                                  $total_result = $tabla_1 + $tabla_2;

                                  if($total_result == 2){

                                      $sql = $conn->prepare(" SELECT CONCAT(TRIM(BOTH ',' FROM REPLACE(REPLACE(a.validation,'specie_id',''),',,',',')),',',(
                                                                                              SELECT b.validation
                                                                                                FROM config_table AS b WHERE b.resource_id = 2
                                                                                                 AND b.table_name = 'passport_zoo' AND b.status = 1)) AS valor
                                                                FROM config_table AS a WHERE a.resource_id = 2 AND a.table_name = 'passport' AND a.status = 1");
                                  } else {

                                      if($tabla_1 == 1){

                                          $sql = $conn->prepare(" SELECT TRIM(BOTH ',' FROM REPLACE(REPLACE(a.validation, 'specie_id',''),',,',',')) AS valor
                                                                    FROM config_table AS a WHERE a.resource_id = 2 AND a.table_name = 'passport' AND a.status = 1");
                                      }

                                      if($tabla_2 == 1){

                                          $sql = $conn->prepare(" SELECT b.validation AS valor
                                                                    FROM config_table AS b WHERE b.resource_id = 2 AND b.table_name = 'passport_zoo' AND b.status = 1");
                                      }
                                  }

                                  $sql->execute();
                                  $result = $sql->fetch('assoc');

                                  $data_array = explode(',', $result['valor']);
                                  $total_data = count($data_array);

                                  $stmt = $conn->prepare(' CALL usp_valida_import_passport(1, 2, ?, ?, ?, ?) ');
                                  $stmt->bindValue(1, $especie_id, PDO::PARAM_STR);
                                  $stmt->bindValue(2, $especies->collection_id, PDO::PARAM_STR);
                                  $stmt->bindValue(3, $total_data, PDO::PARAM_STR);
                                  $stmt->bindValue(4, $uid, PDO::PARAM_STR);
                                  $stmt->execute();

                                  $temp_passport_zoo = $this->TempPassportZoo->find('all')->where(['user_id' => $uid, 'resource_id' => 2])->toArray();

                                  $this->set(compact('file_input', 'especies', 'collections', 'total_data', 'passportZoo', 'passport', 'temp_passport_zoo', 'header_excel'));
                                  $this->Flash->success(__('Validación de campos Recurso Zoogenético realizado satisfactoriamente.'));
                                  unlink($inputFileName);

                              } else {

                                  unlink($inputFileName);
                                  $this->Flash->error(__('Los nombres de las cabeceras del archivo no corresponde al formato. Por favor, otra vez intente.'));
                                  return $this->redirect(['action' => 'import']);
                              }

                          } else {

                              unlink($inputFileName);
                              $this->Flash->error(__('El total de columnas es distinta a la plantilla (64). Por favor, Otra vez intente.'));
                              return $this->redirect(['action' => 'import']);
                          }

                        } else {

                            unlink($inputFileName);
                            $this->Flash->error(__('El archivo no contiene registros. Por favor, Otra vez intente.'));
                            return $this->redirect(['action' => 'import']);
                        }

                    } catch(Exception $e) {

                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    }


                } else {

                    unlink($inputFileName);
                    $this->Flash->error(__('Hubo inconvenientes al cargar el archivo. Por favor, Otra vez intente.'));
                    return $this->redirect(['action' => 'import']);
                }
            }

            $modulo = $this->modulo;

            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

            $colecciones = $this->Collection->find('list',['keyField' => 'id', 'valueField' => 'colname'])->where(['status' => 1, 'availability' => 1, 'resource_id' => 2])->order(['colname' => 'ASC']);

            $this->set(compact('modulo', 'passportZoo', 'colecciones', 'scripts'));
            $this->set('_serialize', ['passportZoo']);

        }else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /************ se graba en la base de datos los registros validos del excel ************/
    public function uploadfile()
    {
        if ($this->request->is('post')) {

            $data =  $this->request->getData();

            $conn = ConnectionManager::get('default');

            $uid = $this->Auth->User('id');

            $stmt = $conn->prepare(' CALL usp_valida_import_passport(2, 2, ?, ?, ?, ?) ');
            $stmt->bindValue(1, $data['especie_id'], PDO::PARAM_STR);
            $stmt->bindValue(2, $data['colection_id'], PDO::PARAM_STR);
            $stmt->bindValue(3, $data['total_data'], PDO::PARAM_STR);
            $stmt->bindValue(4, $uid, PDO::PARAM_STR);
            $stmt->execute();

            $this->Flash->success(__('Importación de Pasaporte Zoogenético realizado satisfactoriamente.'));
            return $this->redirect(['action' => 'index']);
        }
    }


    public function exportartabla() {

        if ($this->request->is('post')) {					
			$conn = ConnectionManager::get('default');
			$condicion=" AND Passport.station_current_id=".$this->Auth->User('station_id');
			
			// Validar si tiene acceso a Ver todas las estaciones experimentales ***************************************************************************			
			if( $this->Auth->user('role_id') == 1 ){
				$condicion = "";
			}else {
				$sqlAcceso ="SELECT estado FROM permiso_estacion AS p WHERE p.idusuario =".$this->Auth->user('id');
				$stmtAcceso = $conn->prepare($sqlAcceso);
				$stmtAcceso->execute();
				
				if( $stmtAcceso->rowCount() > 0){
					$rowAcceso = $stmtAcceso->fetch();
					
					if($rowAcceso[0] == 1){
						$condicion=" ";
					}
				}
			}	 
			///*********************************	
			
			$sql="SELECT 
				PassportFito.id AS 'N',
				Passport.instcode AS 'CODIGO FAO / WIEWS',
				Passport.accenumb AS 'CODIGO DE ACCESION',
				Passport.accname AS 'NOMBRE DE LA ACCESION',
				Passport.othenumb AS 'OTRO CODIGO ACCESION',
				Collection.colname AS 'COLECCION',
				CONCAT(Specie.genus,' ',Specie.species) AS 'NOMBRE CIENTIFICO',
				Specie.cropname AS 'NOMBRE COMUN',
				PassportFito.collnumb AS 'CODIGO COLECTA',
				(SELECT name FROM option_list where id=PassportFito.subtype) AS 'SUBTIPO DE RECURSO',
				(SELECT name FROM option_list where id=PassportFito.storage) AS 'TIPO CONSERVACION',
				PassportFito.acqdate AS 'FECHA INTRODUCCION',
				(SELECT eea FROM station where id=Passport.station_current_id) AS 'ESTACION EXPERIMENTAL',
				(SELECT eea FROM station where id=Passport.station_origin_id) AS 'ESTACION EXPERIMENTAL DE PROCEDENCIA',
				PassportFito.spauthor AS 'AUTORIA DE LA ESPECIE',
				PassportFito.subtaxa AS 'SUBTAXONES',
				PassportFito.subtauthor AS 'TUTORIA DE LOS SUBTAXONES',
				(SELECT name FROM option_list where id=PassportFito.availability) AS 'DISPONIBILIDAD DEL LOTE DE LA ACCESION',
				(SELECT name FROM option_list where id=Passport.promissory) AS 'PROMISORIA',
				(SELECT name FROM country WHERE id=Passport.country_id) AS 'PAIS ORIGEN',
				(SELECT nombre FROM ubigeo WHERE 
					cod_dep=(SELECT cod_dep FROM ubigeo WHERE id=Passport.ubigeo_id)
					and cod_pro=0 and cod_dis=0
				) AS 'DEPARTAMENTO',
				(SELECT nombre FROM ubigeo WHERE 
					cod_dep=(SELECT cod_dep FROM ubigeo WHERE id=Passport.ubigeo_id)
					and cod_pro=(SELECT cod_pro FROM ubigeo WHERE id=Passport.ubigeo_id)
					and cod_dis=0
				) AS 'PROVINCIA',
				(SELECT nombre FROM ubigeo WHERE id=Passport.ubigeo_id) AS 'DISTRITO',
				Passport.localidad AS 'LOCALIDAD',
				PassportFito.collsite AS 'UBICACION DEL SITIO',
				PassportFito.latitude AS 'LATITUD',
				PassportFito.longitude AS 'LONGITUD',
				PassportFito.elevation AS 'ELEVACION',
				(SELECT name FROM option_list WHERE id=PassportFito.coorddatum) AS 'TIPO COORDENADAS',
				(SELECT name FROM option_list WHERE id=PassportFito.georefmeth) AS 'METODO DE GEOREFERENCIACION',
				'  *' AS 'INCERTIDUMBRE DE COORDENADAS',
				PassportFito.collcode AS 'CODIGO DEL INSTITUTO DE COLECTA',
				PassportFito.collname AS 'NOMBRE DEL COLECTOR',
				'  *' AS 'DIRECCION DEL COLECTOR',
				PassportFito.collmissind AS 'MISION DE COLECTA',
				PassportFito.colldate AS 'FECHA DE RECOLECCION',
				PassportFito.localname AS 'NOMBRE LOCAL DEL MATERIAL',
				(SELECT name FROM option_list WHERE id=PassportFito.collsrc) AS 'FUENTE',
				(SELECT name FROM option_list WHERE id=PassportFito.collsrcdet) AS 'FUENTE DETALLE',
				(SELECT name FROM option_list WHERE id=PassportFito.sampstat) AS 'CONDICION BIOLOGICA (DETALLE)',
				PassportFito.groupethnic AS 'GRUPO ETNICO',
				(SELECT name FROM option_list WHERE id=PassportFito.samptype) AS 'TIPO DE MUESTRA',
				'  *' AS 'NUMERO DE PLANTAS MUESTREADAS',
				PassportFito.sampling AS 'TIPO DE MUESTREO',
				'  *' AS 'PARTE UTIL DE LA PLANTA',
				(SELECT name FROM option_list WHERE id=PassportFito.uso) AS 'USO DE LA PLANTA',
				'  *' AS 'AREA DE LA COLECTA (m2)',
				'  *' AS 'PATOGENO',
				'  *' AS 'CODIGO DE ACCESION DEL DONANTE',
				PassportFito.donorcore AS 'CODIGO DEL DONANTE',
				PassportFito.donorname AS 'NOMBRE DEL DONANTE',
				PassportFito.donaddress AS 'DIRECCION DEL DONANTE',
				PassportFito.humidity AS 'HUMEDAD AMBIENTE (%)',
				PassportFito.temp AS 'TEMPERATURA AMBIENTE (C°)',
				PassportFito.presure AS 'PRESION ATMOSFERICA (mmHg)',
				PassportFito.precipitation AS 'PRECIPITACION (mm)',
				'  *' AS 'TEXTURA DEL SUELO',
				'  *' AS 'PEDREGOCIDAD DEL SUELO',
				'  *' AS 'COLOR DEL SUELO',
				'  *' AS 'PH DEL SUELO',
				'  *' AS 'RELIEVE DEL SUELO',
				PassportFito.mancest AS 'ANCESTRO MATERNO',
				PassportFito.pancest AS 'ANCESTRO PATERNO',
				PassportFito.ancest AS 'DATOS ANCESTRALES',
				(SELECT name FROM option_list WHERE id=PassportFito.mlsstat) AS 'SISTEMA MULTILATERAL(mls)',
				PassportFito.patent AS 'NOMBRE DEL PATENTE',
				'  *' AS 'CODIGO DEL INSTITUTO DE MEJORAMIENTO',
				'  *' AS 'NOMBRE DEL INSTITUTO DE MEJORAMIENTO',
				PassportFito.duplinstname AS 'NOMBRE DEL LUGAR - DUPLICADOS DE SEGURIDAD',
				PassportFito.duplsite AS 'DIRECCION - DUPLICADOS DE SEGURIDAD',
				PassportFito.remarks AS 'ANOTACIONES'
			FROM 
				passport_zoo PassportFito 
			INNER JOIN 
				passport Passport ON Passport.id = (PassportFito.passport_id)
			LEFT JOIN
				specie Specie ON Specie.id=Passport.specie_id
			LEFT JOIN
				collection Collection ON Collection.id=Specie.collection_id
			WHERE
				Passport.status != 0".$condicion;
	
			$stmtData = $conn->prepare($sql);
			$stmtData->execute();
			
			if( $stmtData->rowCount() >= 1){
				
				$libros = $stmtData->fetchAll(PDO::FETCH_ASSOC);
			 
				$filename = "pasaporte_zoogenetico_".date('Ymd H:i:s').".xlsx"; 

				/************************************ CREACION DEL EXCEL ***********************************/
				$objPHPExcel = new \PHPExcel();
				$objPHPExcel->setActiveSheetIndex(0);
				
				// Creación de las letras del abecedario
				for($i=65; $i<=90; $i++) {
					$letra[] = chr($i);
				}
				for($i=65; $i<=90; $i++) {
					$letra[] = 'A'.chr($i);
				}
				for($i=65; $i<=90; $i++) {
					$letra[] = 'B'.chr($i);
				}
				for($i=65; $i<=90; $i++) {
					$letra[] = 'C'.chr($i);
				}
				
				############################################# css para los titulos ######################################
				$estiloTitle = array(
						  'font' => array(
									'name'     => 'Arial Narrow',
									'bold'     => true,
									'italic'   => false,
									'strike'   => false,
									'size'     => 10,
									'color' => array(
										'rgb' => '000000'
									)
							),
							'borders' => array(
										'allborders' => array(
										  'style' => \PHPExcel_Style_Border::BORDER_THIN
										)
									),
							'alignment' =>  array(
							  'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							  'vertical'   => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
							  'rotation'   => 0,
							  'wrap'       => TRUE
							)
				);
				############################################# /css  para los titulos  #########################################
				
				/************** INICIO GENERACION DE LOS TITULOS *****************/
				$header =  array_keys($libros[0]); // array_keys($resultado[0]);

				$t = 1;

				for($i=0; $i<count($header); $i++){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra[$t-1].'1', $header[$i]);
					$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($letra[$t-1])->setAutoSize(TRUE); 
					$t++;
				}
	 
				$objPHPExcel->getActiveSheet()->getStyle("A1:BS1")->applyFromArray($estiloTitle);
				$objPHPExcel->getActiveSheet()
									->getStyle('A1:L1')
									->getFill()
									->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()
									->setRGB('D9E1F2');
			 
				$objPHPExcel->getActiveSheet()
										->getStyle('M1:N1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('E2EFDA');
				
				$objPHPExcel->getActiveSheet()
										->getStyle('O1:S1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('FDE9D9');
				
				$objPHPExcel->getActiveSheet()
										->getStyle('T1:Y1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('FFF2CC');
				
				$objPHPExcel->getActiveSheet()
										->getStyle('Z1:AE1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('E2EFDA');
				
				$objPHPExcel->getActiveSheet()
										->getStyle('AF1:AO1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('DDEBF7');
				
				$objPHPExcel->getActiveSheet()
										->getStyle('AP1:AV1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('E2EFDA');
				
				$objPHPExcel->getActiveSheet()
										->getStyle('AW1:AZ1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('FFF2CC');
				
				$objPHPExcel->getActiveSheet()
										->getStyle('BA1:BD1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('D9E1F2');
				
				$objPHPExcel->getActiveSheet()
										->getStyle('BE1:BI1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('FFF2CC');		
				
				$objPHPExcel->getActiveSheet()
										->getStyle('BJ1:BL1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('F2F2F2');	
				
				$objPHPExcel->getActiveSheet()
										->getStyle('BM1:BN1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('DCE6F1');	
				
				$objPHPExcel->getActiveSheet()
										->getStyle('BO1:BR1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('E7E7FF');	
				
				$objPHPExcel->getActiveSheet()
										->getStyle('BS1')
										->getFill()
										->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
										->getStartColor()
										->setRGB('F2F2F2');	
										
			  /************************* INICIO IMPRESION DEL CONTENIDO ***************************/
				$celda = 2;
				for($i=0; $i < count($libros); $i++){

					$content = array_values($libros[$i]);

					for($j = 0; $j<count($content); $j++){
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra[$j].($celda), $content[$j]);					
					}

					$celda ++;
				}
					
				/************** FIN   *****************/
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				
				header('Content-Disposition: attachment;filename='.$filename .' ');
				header('Cache-Control: max-age=0');
				$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save('php://output');

				exit;

			}
		}
  	
		/************** FIN   *****************/
		$handle = fopen("no_data.txt", "w");
		fwrite($handle, "Consulta sin resultados .....");
		fclose($handle);

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename('no_data.txt'));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize('no_data.txt'));
		readfile('no_data.txt');
		 
		
		exit;
	}
}
