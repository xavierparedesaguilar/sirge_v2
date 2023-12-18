<?php
namespace App\Controller\Api;
use App\View\Helper\FunctionsHelper;
use Cake\Controller\Controller;
use Cake\Event\Event;
class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Functions = new FunctionsHelper(new \Cake\View\View());
    }

    public function beforeFilter(Event $event)
    {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->loadModel('Module');
        $this->autoRender = false;
        //$this->set('_serialize', true);
        //$this->response->type('json');
    }
}