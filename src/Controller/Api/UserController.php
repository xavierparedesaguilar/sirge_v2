<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Controller\loadComponent;
use Cake\Datasource\loadModel;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
class UserController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('User');
        $this->loadModel('ModuleRole');
        $this->loadModel('ModuleUser');
    }
    //listar
    public function login()
    {
        if ($this->request->is('post')) {
            $data_x = $this->request->getData();
            if (isset($data_x['username']) && isset($data_x['password'])) {
                $data_x['password'] = md5('ab513c75f48d82bcd30aa48e478d2e6e'.$data_x['password']);
                $user = $this->User->find()->where([ $data_x ])->first();
                if (count($user)>0) {
                    //$modules = $this->ModuleRole->find()->where(["role_id" => $user->role_id]);
                    $modules = $this->ModuleUser->find()->where(["user_id" => $user->id]);
                    $user["modules"] = $modules;
                    $user["created"] = $user->created->format("Y-m-d H:i:s");
                    $user["modified"] = $user->modified->format("Y-m-d H:i:s");
                    $this->response->statusCode(200);
                    $this->response->body(json_encode($user));
                    return $this->response;
                } else {
                    return $this->Functions->api_error($this->response,'Usuario o contraseña incorrectos',[]);
                }
            }else{
                return $this->Functions->api_error($this->response,'Usuario o contraseña incorrectos',[]);
            }
        }

    }

    public function index()
    {

        $update = $this->request->getQuery('update');
        $params = [];
        $users = $this->User->find('all');
        if (isset($update)) {
           $users = $users->where(['modified >=' => $update]);
        }
        $users = $users->toArray();
        // $count_users = count($users);
        // for ($i=0; $i < $count_users-1; $i++) {
        //     $users[$i]['created'] = $users[$i]->created->format("Y-m-d H:i:s");
        // }
        foreach ($users as $key => $user) {
            $modules = $this->ModuleUser->find()->where(["user_id" => $user->id]);
            $users[$key]->modules = $modules;
            $users[$key]->created = $user->created->format("Y-m-d H:i:s");
            $users[$key]->modified = $user->modified->format("Y-m-d H:i:s");
        }
        // $mi_array = [
        //         ['value' => 1],['value' =>2]
        // ];
        // foreach ($mi_array as $key => $value) {
        //     $mi_array[$key]['value'] = 123654;
        // }
        $this->response->body(json_encode($users));
    }

    public function view()
    {
        $token = $this->request->getHeader('token');
        $token = $token[0];

        $user = $this->User->find()->where(['token' => $token ])->first();
        if (count($user)>0) {

            $modules = $this->ModuleUser->find()->where(["user_id" => $user->id]);
            $user["modules"] = $modules;
            $user["created"] = $user->created->format("Y-m-d H:i:s");
            $user["modified"] = $user->modified->format("Y-m-d H:i:s");
            $this->response->statusCode(200);
            $this->response->body(json_encode($user));
            return $this->response;
        } else {
            $data['message'] = 'Error en el usuario';
            $data['cause'] = 'Error en el usuario';
        }

        $this->response->statusCode(400);
        $this->response->body(json_encode($data));
        return $this->response;
    }
}