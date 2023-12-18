<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\loadModel;
/**
 * Publication Controller
 *
 * @property \App\Model\Table\PublicationTable $Publication
 *
 * @method \App\Model\Entity\Publication[] paginate($object = null, array $settings = [])
 */
class PublicationController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->modulo = "Publicaciones";
        $this->loadModel('Country');
        $this->loadModel('OptionList');
        $this->loadModel('Collection');

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => $this->name])->first();
        if(!empty( $this->module ))
          $this->permiso=$this->Functions->validarModulo($this->module->id);

        $this->servidor=false;

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


            $publication = $this->Publication->find()->contain('Country')->where(['Publication.status' => '1']);
            if($publication ==NULL){
                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);

            }

            $mod_modulo = $this->modulo;
            $permiso= $this->permiso;

            $this->set(compact('publication', 'mod_modulo', 'styles', 'scripts','permiso'));
            $this->set('_serialize', ['publication']);

        } else {

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect($this->Auth->redirectUrl());

        }
    }

    /**
     * View method
     *
     * @param string|null $id Publication id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        if($this->permiso['view']){

            // $publication = $this->Publication->get($id, [
            //     'contain' => ['Country']
            // ]);

            $publication = $this->Publication->find()->contain('Country')->where(['Publication.id'=>$id,'Publication.status' => '1'])->first();

            if($publication ==NULL){

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);

              }

            $mod_modulo = $this->modulo;
            $permiso= $this->permiso;

            $this->set(compact('publication', 'mod_modulo','permiso'));
            $this->set('_serialize', ['publication']);

        }else {

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

            $publication = $this->Publication->newEntity();

            if ($this->request->is('post')) {

                $data = $this->request->getData();

                $data['fec_edit']     = date('Y');
                $data['month_edit']   = date('m');
                $data['availability'] = '1';
                $data['status']       = '1';

                /****  Carga de Archivos  ***/
                $dir_subida = WWW_ROOT.'publicacion'.DS;

                /********* ARCHIVO 1 *********/
                $data['file_1']['name'] = 'publicacion_1_'.$publication->numeral.'.jpg';
                $fichero_subido_1 = $dir_subida . basename($data['file_1']['name']);

                if(move_uploaded_file($data['file_1']['tmp_name'], $fichero_subido_1))
                    $data['principal_image'] = 'publicacion/publicacion_1_'.$publication->numeral.'.jpg';

                /********* ARCHIVO 2 *********/
                // $data['file_3']['name'] = 'publicacion_2_'.$publication->numeral.'.jpg';
                // $fichero_subido_3 = $dir_subida . basename($data['file_3']['name']);

                // if(move_uploaded_file($data['file_3']['tmp_name'], $fichero_subido_3))
                //     $data['second_image'] = 'publicacion/publicacion_2_'.$publication->numeral.'.jpg';

                /********* ARCHIVO 3 *********/
                $data['file_2']['name'] =  'publicacion_3_'.$publication->numeral.'.pdf';
                $fichero_subido_2 = $dir_subida . basename($data['file_2']['name']);
                if(move_uploaded_file($data['file_2']['tmp_name'], $fichero_subido_2))
                    $data['documents'] = 'publicacion/'.'publicacion_3_'.$publication->numeral.'.pdf';

                if(!$this->servidor){
                  //Localmente
                  $dir_nuevo_img='../../inia_web/modulos/es/img/publicacion'.DS.$data['file_1']['name'] ;
                  copy($fichero_subido_1 , $dir_nuevo_img);

                  $dir_nuevo_img='../../inia_web/modulos/en/img/publicacion'.DS.$data['file_1']['name'] ;
                  copy($fichero_subido_1 , $dir_nuevo_img);

                  // $dir_nuevo_img_2='../../inia_web/modulos/es/img/publicacion'.DS.$data['file_3']['name'] ;
                  // copy($fichero_subido_3 , $dir_nuevo_img_2);

                  // $dir_nuevo_img_2='../../inia_web/modulos/en/img/publicacion'.DS.$data['file_3']['name'] ;
                  // copy($fichero_subido_3 , $dir_nuevo_img_2);

                  $dir_nuevo_pdf='../../inia_web/modulos/es/docs/publicacion'.DS.$data['file_2']['name'] ;
                  copy($fichero_subido_2 , $dir_nuevo_pdf);

                  $dir_nuevo_pdf='../../inia_web/modulos/en/docs/publicacion'.DS.$data['file_2']['name'] ;
                  copy($fichero_subido_2 , $dir_nuevo_pdf);
                }

                if($this->servidor){
                    //Servidor
                    $dir_ingles_img= '../../../public_html/modulos/en/img/publicacion'.DS.$data['file_1']['name'] ;
                    $dir_spanish_img='../../../public_html/modulos/es/img/publicacion'.DS.$data['file_1']['name'] ;
                    copy($fichero_subido_1 ,$dir_ingles_img);
                    copy($fichero_subido_1 , $dir_spanish_img);

                    // $dir_ingles_img_2= '../../../public_html/modulos/en/img/publicacion'.DS.$data['file_3']['name'] ;
                    // $dir_spanish_img_2='../../../public_html/modulos/es/img/publicacion'.DS.$data['file_3']['name'] ;
                    // copy($fichero_subido_3 ,$dir_ingles_img_2);
                    // copy($fichero_subido_3 , $dir_spanish_img_2);

                    $dir_ingles_pdf= '../../../public_html/modulos/en/docs/publicacion'.DS.$data['file_2']['name'] ;
                    $dir_spanish_pdf='../../../public_html/modulos/es/docs/publicacion'.DS.$data['file_2']['name'] ;
                    copy($fichero_subido_2 ,$dir_ingles_pdf);
                    copy($fichero_subido_2 , $dir_spanish_pdf);
                }

                $publication = $this->Publication->patchEntity($publication, $data);

                if ($this->Publication->save($publication)) {

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-2)];
                    $action     = $list_module[(count($list_module)-1)];
                    $station_id = $publication->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('Publicación creado satisfactoriamente.'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Hubo inconvenientes al crear la Publicación. Por favor, otra vez intente.'));
            }

            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

            $mod_modulo = $this->modulo;

            $paises           = $this->Country->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => '1']);
            $tipo_public      = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 688, 'resource_id' => 4]);
            $categoria_public = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 695, 'resource_id' => 4]);
            $colecciones      = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['availability' => 1, 'status' => 1])->order(['colname' => 'ASC']);

            $this->set(compact('publication', 'paises', 'mod_modulo', 'scripts', 'tipo_public', 'categoria_public', 'colecciones'));
            $this->set('_serialize', ['publication']);

        } else {
                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Publication id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // $publication = $this->Publication->get($id, [
        //     'contain' => []
        // ]);

        if($this->permiso['edit']){

            $publication = $this->Publication->find()->where(['Publication.id'=>$id,'Publication.status'=>'1'])->first();

            if($publication!=NULL){

                if ($this->request->is(['patch', 'post', 'put'])) {

                    $data = $this->request->getData();

                    /****  Carga de Archivos  ***/
                    $dir_subida = WWW_ROOT.'publicacion'.DS;

                    /********* ARCHIVO 1 *********/
                    if(!empty($data['file_1']))
                    {
                      $list_image_1 = explode('/', $publication['principal_image']);

                      $data['file_1']['name'] = $list_image_1[1];
                      $fichero_subido_1 = $dir_subida . basename($data['file_1']['name']);

                      if(move_uploaded_file($data['file_1']['tmp_name'], $fichero_subido_1))
                          $data['principal_image'] = 'publicacion/'.$list_image_1[1];
                    }

                    /********* ARCHIVO 2 *********/
                    // if(!empty($data['file_3']))
                    // {
                    //   $list_image_2 = explode('/', $publication['second_image']);

                    //   $data['file_3']['name'] = $list_image_2[1];
                    //   $fichero_subido_3 = $dir_subida . basename($data['file_3']['name']);

                    //   if(move_uploaded_file($data['file_3']['tmp_name'], $fichero_subido_3))
                    //       $data['second_image'] = 'publicacion/'.$list_image_2[1];
                    // }

                    /********* ARCHIVO 3 *********/
                    if(!empty($data['file_2']))
                    {
                      $list_document = explode('/', $publication['documents']);

                      $data['file_2']['name'] =  $list_document[1];
                      $fichero_subido_2 = $dir_subida . basename($data['file_2']['name']);
                      if(move_uploaded_file($data['file_2']['tmp_name'], $fichero_subido_2))
                          $data['documents'] = 'publicacion/'.$list_document[1];
                    }

                    if(!$this->servidor){
                        //Localmente

                        if($data['file_1']['error'] != 4){

                          $dir_nuevo_img='../../inia_web/modulos/es/img/publicacion'.DS.$data['file_1']['name'] ;
                          copy($fichero_subido_1 , $dir_nuevo_img);

                          $dir_nuevo_img='../../inia_web/modulos/en/img/publicacion'.DS.$data['file_1']['name'] ;
                          copy($fichero_subido_1 , $dir_nuevo_img);
                        }

                        // if($data['file_3']['error'] != 4){

                        //     $dir_nuevo_img_2='../../inia_web/modulos/es/img/publicacion'.DS.$data['file_3']['name'] ;
                        //     copy($fichero_subido_3 , $dir_nuevo_img_2);

                        //     $dir_nuevo_img_2='../../inia_web/modulos/en/img/publicacion'.DS.$data['file_3']['name'] ;
                        //     copy($fichero_subido_3 , $dir_nuevo_img_2);
                        // }

                        if($data['file_2']['error'] != 4){

                          $dir_nuevo_pdf='../../inia_web/modulos/es/docs/publicacion'.DS.$data['file_2']['name'] ;
                          copy($fichero_subido_2 , $dir_nuevo_pdf);

                          $dir_nuevo_pdf='../../inia_web/modulos/en/docs/publicacion'.DS.$data['file_2']['name'] ;
                          copy($fichero_subido_2 , $dir_nuevo_pdf);
                        }
                    }

                    if($this->servidor){
                        //Servidor
                          if($data['file_1']['error'] != 4){

                             $dir_ingles_img= '../../../public_html/modulos/en/img/publicacion'.DS.$data['file_1']['name'] ;
                             $dir_spanish_img='../../../public_html/modulos/es/img/publicacion'.DS.$data['file_1']['name'] ;
                             copy($fichero_subido_1 ,$dir_ingles_img);
                             copy($fichero_subido_1 , $dir_spanish_img);
                          }

                          // if($data['file_3']['error'] != 4){

                          //    $dir_ingles_img_2= '../../../public_html/modulos/en/img/publicacion'.DS.$data['file_3']['name'] ;
                          //    $dir_spanish_img_2='../../../public_html/modulos/es/img/publicacion'.DS.$data['file_3']['name'] ;
                          //    copy($fichero_subido_3 ,$dir_ingles_img_2);
                          //    copy($fichero_subido_3 , $dir_spanish_img_2);
                          // }

                          if($data['file_2']['error'] != 4){

                             $dir_ingles_pdf= '../../../public_html/modulos/en/docs/publicacion'.DS.$data['file_2']['name'] ;
                             $dir_spanish_pdf='../../../public_html/modulos/es/docs/publicacion'.DS.$data['file_2']['name'] ;
                             copy($fichero_subido_2 ,$dir_ingles_pdf);
                             copy($fichero_subido_2 , $dir_spanish_pdf);
                          }
                    }

                    $publication = $this->Publication->patchEntity($publication, $data);

                    if ($this->Publication->save($publication)) {

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-3)];
                        $action     = $list_module[(count($list_module)-2)];
                        $station_id = $publication->id;
                        $recurso_id = '4';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Publicación actualizada satisfactoriamente.'));

                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al actualizar la Publicación. Por favor, otra vez intente.'));
                }

                $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

                $mod_modulo = $this->modulo;

                $paises           = $this->Country->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => '1']);
                $tipo_public      = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 688, 'resource_id' => 4]);
                $categoria_public = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => 1, 'parent_id' => 695, 'resource_id' => 4]);
                $colecciones      = $this->Collection->find('list', ['keyField' => 'id', 'valueField' => 'colname'])->where(['availability' => 1, 'status' => 1])->order(['colname' => 'ASC']);

                $this->set(compact('publication', 'mod_modulo', 'paises', 'tipo_public', 'categoria_public', 'scripts', 'colecciones'));
                $this->set('_serialize', ['publication']);

            } else{

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
            }

        } else{

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Publication id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
         if($this->permiso['delete']){

            $this->request->is(['post', 'delete']);

            $publication = $this->Publication->find()->where(['Publication.id'=>$id,'Publication.status'=>'1'])->first();

            if($publication!=NULL){

                $publication['status'] = '0';

                if ($this->Publication->save($publication)) {

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = $list_module[(count($list_module)-2)];
                    $station_id = $publication->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('Publicación eliminada satisfactoriamente.'));

                } else {

                    $this->Flash->error(__('Hubo inconvenientes al eliminar la Publicación. Por favor, otra vez intente.'));
                }

                return $this->redirect(['action' => 'index']);

            }else {

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);
            }

        }else {

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
