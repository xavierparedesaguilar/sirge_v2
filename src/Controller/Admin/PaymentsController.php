<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

use Cake\Mailer\MailerAwareTrait;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[] paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->modulo = "Gestión de Pagos";
        $this->titulo = "Pagos";
        $this->loadModel('OptionList');
        $this->loadModel('Orders');

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
            $titulo = $this->titulo;
            $permiso = $this->permiso;

            $payments = $this->Payments->find()->contain(['Orders.Clients'])->where(['Payments.status' => '1'])->order(['Orders.nro_order' => 'DESC']);

            $this->set(compact('payments', 'modulo', 'titulo', 'styles', 'scripts','permiso'));
            $this->set('_serialize', ['payments']);

        } else{

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->permiso['view']){

            // $payment = $this->Payments->get($id, [
            //     'contain' => ['Orders.Clients.Country']
            // ]);

            $payment = $this->Payments->find()->contain(['Orders.Clients.Country'])->where(['Payments.id'=>$id,'Payments.status'=>'1'])->first();

            if ($payment==NULL) {
                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);
            }
            $payment['date_payment'] = (!empty($payment['date_payment']))? date('d-m-Y', strtotime($payment['date_payment'])) : '';

            $modulo = $this->modulo;
            $titulo = $this->titulo;
            $permiso = $this->permiso;



            $this->set(compact('payment', 'modulo', 'titulo','permiso'));
            $this->set('_serialize', ['payment']);

        } else{

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    use MailerAwareTrait;

    public function edit($id = null)
    {
        // $payment = $this->Payments->get($id, [
        //     'contain' => []
        // ]);
        if($this->permiso['edit']){

            $payment = $this->Payments->find()->where(['Payments.id'=>$id,'Payments.status'=>'1'])->first();
            $scripts = ['assets/js/fileinput/fileinput.min','assets/packages/jqueryvalidation/dist/jquery.validate'];
            // $orders = $this->Orders->get($payment->id, [
            //     'contain' => ['Clients.Country']
            // ]);
            if ($payment==NULL) {
                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);
            }

            $orders = $this->Orders->find()->contain(['Clients.Country'])->where(['Orders.id'=>$payment->order_id,'Orders.status'=>'1'])->first();
            $payment['date_payment'] = date('d-m-Y', strtotime($payment['date_payment']));

            if ($this->request->is(['patch', 'post', 'put'])) {

                $data = $this->request->getData();
                $data['date_payment'] = date('Y-m-d', strtotime($data['date_payment']));
                $payment = $this->Payments->patchEntity($payment, $data);

                if ($this->Payments->save($payment)) {

                    $value = $this->OptionList->find()->where(['id' => $payment->state])->first();

                    if($value['name'] == 'CONFIRMADO'){
                        $this->getMailer('Payments')->send('confirmacion', [$orders]);
                    }

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = $list_module[(count($list_module)-2)];
                    $station_id = $payment->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('Pago actualizado satisfactoriamente.'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Hubo inconvenientes al actualizar el Pago. Por favor, Otra vez intente.'));
            }

            $modulo = $this->modulo;
            $titulo = $this->titulo;

            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

            $estados = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 713, 'status' => 1, 'resource_id' => 4, 'name !=' => 'ENVIADO']);
            $monedas = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 716, 'status' => 1, 'resource_id' => 4 ]);
            $bancos  = $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 719, 'status' => 1, 'resource_id' => 4 ]);

            $this->set(compact('payment', 'orders', 'modulo', 'titulo', 'estados', 'monedas', 'bancos','scripts'));
            $this->set('_serialize', ['payment']);

        } else{

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
