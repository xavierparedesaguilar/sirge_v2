<?php
namespace App\Controller\Admin\Microorganismo;
use App\View\Helper\FunctionsHelper;
use Cake\Controller\Controller;
use Cake\Controller\loadComponent;
use Cake\Event\Event;

use Cake\Core\Configure;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->Functions = new FunctionsHelper(new \Cake\View\View());
        $this->loadComponent('RequestHandler');
        $this->module_info = $this->request->params;
        //$this->loadComponent('Auth');
    }
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        $this->viewBuilder()->theme('AdminLTE');
        $this->set('theme', Configure::read('Theme'));
    }

    public function beforeFilter(Event $event)
    {
        if ($this->request->is('ajax')) {
            $this->Auth->allow();
            return;
        }

        $loguser = $this->request->session()->read('Auth.User');
        //print_r("hola mundo");
        //print_r(json_encode($this->request->session(),JSON_PRETTY_PRINT));die();
        if (count($loguser)>0){

            //echo "hola mundo";die();
            parent::beforeFilter($event);
            $this->set('current_user', $loguser);
            if (count($loguser)>0) {
                // aqui se deben validar los permisos de los usuarios
                //$this->Auth->allow();
            }
        }else{
            $this->redirect("/admin/login");
        }


    }

    public function isAuthorized($user)
    {
        if (isset($user['rol_id']) && $user['rol_id'] == 1) {
            return true;
        }
        return false;
    }
}