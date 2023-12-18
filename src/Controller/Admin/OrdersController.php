<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\ORM\TableRegistry;

use Cake\Mailer\MailerAwareTrait;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[] paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->modulo = "Ordenes en Línea";
        $this->detalle = "Detalle del Pedido";
        $this->loadModel('OrdersDetail');
        $this->loadModel('Clients');
        $this->loadModel('OptionList');

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => $this->name])->first();
        if(!empty( $this->module ))
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

            $modulo = $this->modulo;
            $permiso = $this->permiso;

            $orders = $this->Orders->find()->contain(['Clients.Country'])->where(['Orders.status' => '1'])->order([' Orders.nro_order' => 'DESC']);

            $this->set(compact('orders', 'modulo', 'styles', 'scripts','permiso'));
            $this->set('_serialize', ['orders']);

        } else{

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        // $order = $this->Orders->get($id, [
        //     'contain' => ['Clients.Country', 'Payments']
        // ]);
        if($this->permiso['index']){

            $order = $this->Orders->find()->contain('Clients.Country', 'Payments')->where(['Orders.id'=>$id,'Orders.status'=>'1'])->first();
            if ($order==NULL) {
                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);

            }
            $modulo = $this->modulo;
            $detalle = $this->detalle;
            $permiso = $this->permiso;

            $lista_detalle = $this->OrdersDetail->find()->contain(['Passport','Specie.Collection','Orders'])->where(['OrdersDetail.status' >= '1', 'OrdersDetail.order_id' => $order->id]);

            $this->set(compact('order','modulo', 'detalle', 'lista_detalle','permiso'));
            $this->set('_serialize', ['order']);

        }else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
        }

    }


    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    use MailerAwareTrait;

    public function edit($id = null)
    {
        // $order = $this->Orders->get($id, [
        //     'contain' => []
        // ]);
        if($this->permiso['edit']){

            $order = $this->Orders->find()->where(['Orders.id'=>$id,'Orders.status'=>'1'])->first();
            // $client = $this->Clients->get($order->id, [
            //     'contain' => ['Country']
            // ]);

            if ($order!=NULL) {

                $client = $this->Clients->find()->contain('Country')->where(['Clients.id'=>$order->client_id,'Clients.status'=>'1'])->first();


                $detalle_orden = $this->OrdersDetail->find()->contain(['Passport','Specie.Collection','Orders'])->where(['OrdersDetail.status' => '1', 'OrdersDetail.order_id' => $order->id]);

                if ($this->request->is(['patch', 'post', 'put'])) {

                    $data = $this->request->getData();

                    $order = $this->Orders->patchEntity($order, $data);

                    if ($this->Orders->save($order)) {

                        $value = $this->OptionList->find()->where(['id' => $order->state])->first();

                        if($value['name'] == 'CONFIRMADO'){

                            $detalle = $this->OrdersDetail->find()->contain(['Passport','Specie.Collection','Orders'])->where(['OrdersDetail.status' => '1', 'OrdersDetail.order_id' => $order->id]);
                            $this->getMailer('Orders')->send('confirmacion', [$client,$detalle, $order]);

                        } else if($value['name'] == 'CANCELADO'){

                            $this->getMailer('Orders')->send('cancelacion', [$client,$order]);
                        }

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-3)];
                        $action     = $list_module[(count($list_module)-2)];
                        $station_id = $client->id;
                        $recurso_id = '4';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('La Orden fue actualizada satisfactoriamente.'));

                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al actualizar la Orden. Por favor, Otra vez intente.'));
                }

                $modulo = $this->modulo;
                $detalle = $this->detalle;

                $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

                $estados = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 707, 'status' => 1, 'resource_id' => 4, 'name not in' => ['ELIMINADO', 'CREADO'] ]);

                $this->set(compact('order', 'client', 'country', 'modulo', 'detalle', 'scripts', 'estados', 'detalle_orden'));
                $this->set('_serialize', ['order']);

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
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        if($this->permiso['delete']){

            $order = $this->Orders->find()->where(['Orders.id'=>$id,'Orders.status'=>'1'])->first();
            if ($order==NULL) {
                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);
            }


            $this->request->is(['post', 'delete']);



            $order['status'] = '0';
            $order['state']  = '712';

            if ($this->Orders->save($order)) {

                $list_module = explode('/', $this->request->params['_matchedRoute']);

                $user_id    = $this->Auth->User('id');
                $module     = $list_module[(count($list_module)-3)];
                $action     = $list_module[(count($list_module)-2)];
                $station_id = $order->id;
                $recurso_id = '4';

                $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                $detalle = $this->OrdersDetail->find()->where(['status' => '1', 'order_id' => $order->id])->all();

                foreach ($detalle as $key => $value) {

                    $temp = TableRegistry::get('OrdersDetail');
                    $temp_detalle = $temp->get($value->id);
                    $temp_detalle->status = '0';
                    $temp->save($temp_detalle);

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = 'eliminarDetalle';
                    $station_id = $temp_detalle->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);
                }

                $this->Flash->success(__('La Orden fue eliminado satisfactoriamente.'));

            } else {

                $this->Flash->error(__('Hubo inconvenientes al eliminar la Orden. Por favor, Otra vez intente.'));
            }

            return $this->redirect(['action' => 'index']);

        } else {

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function deleteDetalle($id = null)
    {
        $this->request->is(['post', 'delete']);

        $order_detalle = $this->OrdersDetail->get($id);

        $order_detalle['status'] = '0';

        if ($this->OrdersDetail->save($order_detalle)) {

            $list_module = explode('/', $this->request->params['_matchedRoute']);

            $user_id    = $this->Auth->User('id');
            $module     = $list_module[(count($list_module)-3)];
            $action     = $list_module[(count($list_module)-2)];
            $station_id = $order_detalle->id;
            $recurso_id = '4';

            $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

            $this->Flash->success(__('Detalle de la Orden fue eliminado satisfactoriamente.'));

        } else {

            $this->Flash->error(__('Hubo inconvenientes al eliminar el Detalle de la Orden. Por favor, Otra vez intente.'));
        }

        return $this->redirect(['action' => 'edit', 'id' => $order_detalle->order_id]);
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
