<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\loadModel;

use Cake\Mailer\MailerAwareTrait;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[] paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->modulo = "Suscripción de Clientes";
        $this->titulo = "Clientes";
        $this->loadModel('OptionList');
        $this->loadModel('ClientUsers');

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => $this->name])->first();
        if(!empty( $this->module ))
          $this->permiso = $this->Functions->validarModulo($this->module->id);
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
                        'assets/js/datatable/dataTables.select.min',
                        'assets/packages/jqueryvalidation/dist/jquery.validate'];

            $modulo = $this->modulo;
            $titulo = $this->titulo;
            $permiso = $this->permiso;

            $clients = $this->Clients->find()->contain(['Country', 'ClientUsers'])->where(['Clients.status' => '1']);

            $this->set(compact('clients', 'modulo', 'titulo', 'styles', 'scripts','permiso'));
            $this->set('_serialize', ['clients']);

        } else {

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect($this->Auth->redirectUrl());

        }
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->permiso['index']){

            // $client = $this->Clients->get($id, [
            //     'contain' => ['Country', 'Orders']
            // ]);

            $client = $this->Clients->find()->contain('Country','Orders')->where(['Clients.id'=>$id,'Clients.status'=>1])->first();
            if($client ==NULL){

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);

            }

            $client['date_nac'] = (!empty($client['date_nac']))? date('d-m-Y', strtotime($client['date_nac'])) : '';

            $modulo = $this->modulo;
            $titulo = $this->titulo;
            $permiso = $this->permiso;



            $this->set(compact('client', 'modulo', 'titulo','permiso'));
            $this->set('_serialize', ['client']);

        }else {

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    use MailerAwareTrait;

    public function edit($id = null)
    {
        // $client = $this->Clients->get($id, [
        //     'contain' => []
        // ]);

        if($this->permiso['edit']){

            $client = $this->Clients->find()->where(['Clients.id'=>$id])->first();

            if($client!=NULL){

                $temp_estado = $client['state'];

                if ($this->request->is(['patch', 'post', 'put'])) {

                    $data = $this->request->getData();

                    $data['name_client'] = trim( mb_strtoupper($data['names'].' '.$data['surnames'], 'UTF-8'));
                    $data['date_nac']    = date('Y-m-d', strtotime($data['date_nac']));

                    if($data['state'] == 705){

                        $temp = TableRegistry::get('ClientUsers');
                        $temp_user = $temp->get($client->id);
                        $temp_user->status = '3';
                        $temp->save($temp_user);

                    } else {

                        if($client->state == 705){

                            $temp = TableRegistry::get('ClientUsers');
                            $temp_user = $temp->get($client->id);
                            $temp_user->status = '1';
                            $temp->save($temp_user);
                        }
                    }

                    $client = $this->Clients->patchEntity($client, $data);

                    if ($this->Clients->save($client)) {

                        if($temp_estado == '703'){

                            $mensaje = $this->OptionList->find()->where(['id' => $client->state])->first();

                            if($mensaje['name'] == 'CONFIRMADO'){

                                $client_user = $this->ClientUsers->find()->where(['client_id' => $client->id, 'status' => 2]);

                                if($client_user->count() > 0){

                                    $model_user = $client_user->first();

                                    $this->getMailer('Clients')->send('bienvenida', [$client, $model_user]);

                                    $temp = TableRegistry::get('ClientUsers');
                                    $temp_user = $temp->get($model_user->id);
                                    $temp_user->status = '1';
                                    $temp->save($temp_user);
                                }
                            }
                        }

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-3)];
                        $action     = $list_module[(count($list_module)-2)];
                        $station_id = $client->id;
                        $recurso_id = '4';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Cliente actualizado satisfactoriamente.'));

                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al actualizar el Cliente. Por favor, Otra vez intente.'));
                }

                $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

                $modulo = $this->modulo;
                $titulo = $this->titulo;

                $estados = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 702, 'status' => 1, 'resource_id' => 4, 'name not in' => ['ELIMINADO', 'ENVIADO'] ]);
                $country = $this->Clients->Country->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => '1']);

                $client['date_nac'] = date('d-m-Y', strtotime($client['date_nac']));

                $this->set(compact('client', 'country', 'modulo', 'titulo', 'scripts', 'estados'));
                $this->set('_serialize', ['client']);

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
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        if($this->permiso['delete']){

            $this->request->is(['post', 'delete']);

            //$client = $this->Clients->get($id);

            $client = $this->Clients->find()->where(['Clients.id'=>$id])->first();

            if($client!=NULL){

                $client['status'] = '0';
                $client['state']  = '706';

                if ($this->Clients->save($client)) {

                    $client_user = $this->ClientUsers->find()->where(['client_id' => $client->id, 'status IN' => [1,2,3] ]);

                    if($client_user->count() > 0){

                        $model_user = $client_user->first();

                        $temp = TableRegistry::get('ClientUsers');
                        $temp_user = $temp->get($model_user->id);
                        $temp_user->status = '0';
                        $temp->save($temp_user);
                    }

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = $list_module[(count($list_module)-2)];
                    $station_id = $client->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('El Cliente fue eliminado satisfactoriamente.'));

                } else {

                    $this->Flash->error(__('Hubo inconvenientes al eliminar el Cliente. Por favor, Otra vez intente.'));
                }

                    return $this->redirect(['action' => 'index']);
            } else{

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);
            }


        } else{

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);
        }
    }

    //*******************************+ CAMBIAR LA CLAVE DE LOS CLIENTES ***************************//
    public function changePass($id = null)
    {
        $user = $this->ClientUsers->get($id);

        if ($this->request->is(['post', 'put'])) {

            $data = $this->request->data;

            $opciones = [ 'cost' => 12 ];

            $data['clave'] = password_hash( $data['password'], PASSWORD_BCRYPT, $opciones);

            $this->ClientUsers->patchEntity($user, $data);

            if ($this->ClientUsers->save($user)) {

                $this->Flash->success('La Contraseña se cambio satisfactoriamente.');
                return $this->redirect(['action' => 'index']);

            } else {

                $this->Flash->error('Hubo inconvenientes al cambiar la contraseña. Por favor, Intentelo otra vez.');
            }

        } else {

            if ($this->request->is('ajax')) {

                $titulo = $user->username;
                $this->set(compact('titulo', 'user'));

                $this->render('/Admin/Clients/password');

            } else {

                return $this->redirect('/publicacion-catalogo-virtual');
            }
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
