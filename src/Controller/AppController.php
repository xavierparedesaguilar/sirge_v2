<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\View\Helper\FunctionsHelper;
use Cake\Controller\Controller;
use Cake\Event\Event;

use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        //inicio
        parent::initialize();
        $this->Functions = new FunctionsHelper(new \Cake\View\View());
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
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
        if ($this->request->url=='modulo-1') {
            $this->Auth->logout();
            $this->Auth->allow();
            return;
        }else{
            //echo "hola mundo";die();
            parent::beforeFilter($event);
            $this->set('current_user', $this->Auth->user());
            if (count($this->Auth->user())>0) {
                // aqui se deben validar los permisos de los usuarios
                 $this->Auth->allow();
            }
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
