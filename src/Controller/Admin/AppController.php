<?php
namespace App\Controller\Admin;
use App\View\Helper\FunctionsHelper;
use Cake\Controller\Controller;
use Cake\Controller\loadComponent;
use Cake\Event\Event;

use Cake\Core\Configure;

use CakeEventEvent;

class AppController extends Controller
{
    public function initialize()
    {
        //inicio
        parent::initialize();
        // $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
        $this->Functions = new FunctionsHelper(new \Cake\View\View());
        $this->loadComponent('RequestHandler');
        $this->module_info = $this->request->params;
        $this->loadComponent('Flash');
        $this->loadModel('User');
        $this->loadModel('Module');
        //$this->loadComponent('Csrf');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'passwordHasher' => [
                        'className' => 'Legacy',
                    ],
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                    'userModel' => 'User'
                ]
            ],
            'loginAction' => [
                'controller' => 'Acceso',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => 'Portada',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Acceso',
                'action' => 'login'
            ],
            'authError' => false,
            'unauthorizedRedirect' => $this->referer(),
        ]);
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) && in_array($this->response->type(), ['application/json', 'application/xml']))
        {
			
            $this->set('_serialize', true);
        }
			//debug($this);
			//exit;
        $this->viewBuilder()->theme('AdminLTE');
        $this->set('theme', Configure::read('Theme'));
    }

    public function beforeFilter(Event $event)
    {
        // parent::beforeFilter($event);
        // $this->Security->requireSecure();

        if ($this->request->is('ajax')) {
            $this->Auth->allow();
            return;
        }

        if ($this->request->url=='modulo-1') {
            $this->Auth->logout();
            $this->Auth->allow();
            return;

        }else{
            parent::beforeFilter($event);
            $this->set('current_user', $this->Auth->user());
            if (count($this->Auth->user())>0) {
                if ($this->module_info['controller']=='Portada') {
                    $this->Auth->allow('index');
                }else{
                    $this->Auth->allow();
                    // $current_controller = $this->module_info['controller'];
                    // $current_action = $this->module_info['action'];
                    // $user_id = $this->Auth->user()['id'];
                    // $user = $this->User->find()->where(['id' => $user_id ])->contain(['Module'])->toArray();
                    // $modules_ = $user[0]->module;
                    // //print_r(json_encode($modules_,JSON_PRETTY_PRINT));
                    // $entry_module = true;
                    // foreach ( $modules_ as $key => $value_) {

                    //     //print_r(json_encode($value_->controller,JSON_PRETTY_PRINT));
                    //     //print_r(json_encode($value_,JSON_PRETTY_PRINT));
                    //     if ($value_->controller === $current_controller) {
                    //         //print_r(json_encode($this->Functions->textMetodo($value_->_joinData->permissions,$value_->_joinData->module_id),JSON_PRETTY_PRINT));
                    //         $action_ = $this->Functions->textMetodo($value_->_joinData->permissions,$value_->_joinData->module_id);
                    //         //print_r(json_encode($value_->_joinData->module_id,JSON_PRETTY_PRINT));

                    //         $this->Auth->allow($action_);
                    //         $entry_module = false;
                    //     }
                    // }
                    // if ($entry_module) {
                    //     return $this->redirect($this->referer());
                    // }
                    //die();
                    // aqui se deben validar los permisos de los usuarios
                    //$user -> find()->where resource =4 and controlador "here" and user_id
                }
            }
        }
    }

    // public function forceSSL()
    // {
    //     return $this->redirect('https://' . env('SERVER_NAME') . $this->request->here);
    // }

    public function isAuthorized($user)
    {
        if (isset($user['rol_id']) && $user['rol_id'] == 1) {
            return true;
        }
        return false;
    }

}