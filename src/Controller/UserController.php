<?php
namespace App\Controller;

use App\Controller\AppController;
use App\View\Helper\FunctionsHelper;



/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 */
class UserController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ModuleRole');
        $this->Functions = new FunctionsHelper(new \Cake\View\View());
        $this->mod_padre = "Gestión de seguridad";
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $user = $this->User->find()->contain('Role')->where(['User.status !=' => '0']);
        $titulo = $this->mod_padre;

        $this->set(compact('user', 'titulo'));
        $this->set('_serialize', ['user']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->User->get($id, [
            'contain' => ['Role', 'Module']
        ]);

        $titulo = $this->mod_padre;
        $this->set(compact('user', 'titulo'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$errorsX = [];
        $scripts = ['assets/js/select2/select2'];
        $user = $this->User->newEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $nom_ = explode(' ', $data['names']);
            $ape_ = explode(' ', $data['surnames']);
            $data['username'] = $this->Functions->letterAccent($nom_[0], 'lower') . "." . $this->Functions->letterAccent($ape_[0], 'lower');
            $data['token'] = $this->Functions->generate_token($data['username'], $data['password']);
            $data['status'] = '1';

            $user = $this->User->patchEntity($user, $data);

            if ($this->User->save($user)) {

                $this->Flash->result('Usuario creado satisfactoriamente', ['params' => ['alert' => 'success']]);
                return $this->redirect(['action' => 'index']);
            }
            // if($user->errors()){
            //     //echo "<pre>";
            //     $errorsX = $user->errors();
            //     // print_r($user->errors());
            //     // die();
            //     $error_msg = [];
            //     foreach( $user->errors() as $errors){
            //         if(is_array($errors)){
            //             foreach($errors as $error){
            //                 $error_msg[]    =   $error;
            //             }
            //         }else{
            //             $error_msg[]    =   $errors;
            //         }
            //     }

            //     if(!empty($error_msg)){
            //         $this->Flash->error(
            //             __("Errores:".implode("\n \r", $error_msg))
            //         );
            //         $this->Flash->result("Revise los siguientes campos".implode("\n \r", $error_msg));
            //     }
            // }
            // //print_r($user);
            $this->Flash->result('Hubo inconvenientes al crear usuario. Por favor, Otra vez intente.', ['params' => ['alert' => 'error']]);
        }

        $roles = $this->User->Role->find('all');
        $countrys = $this->User->Country->find('all');
        $titulo = $this->mod_padre;

        $modulos = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL])->toArray();
        foreach ($modulos as $key => $modulo) {
            $modulos[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
        }

        $this->set(compact('user', 'roles', 'modulos', 'titulo','countrys', 'scripts'));
        $this->set('_serialize', ['user', 'modulos']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->User->get($id, [
            'contain' => ['Module']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->getData());

            if ($this->User->save($user)) {

                $this->Flash->result('Usuario actualizado satisfactoriamente', ['params' => ['alert' => 'success']]);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->result('Hubo inconvenientes al actualizar el usuario. Por favor, Otra vez intente.', ['params' => ['alert' => 'error']]);
        }
        $roles = $this->User->Role->find('all');
        $titulo = $this->mod_padre;
        $module = $this->User->Module->find('list', ['limit' => 200]);
        $this->set(compact('user', 'role', 'module', 'roles', 'titulo'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->User->get($id);

        $user->status = '2';

        if ($this->User->save($user)) {

            $this->Flash->result('Usuario eliminado satisfactoriamente', ['params' => ['alert' => 'success']]);

        } else {

            $this->Flash->result('Hubo inconvenientes al eliminar el usuario. Por favor, Otra vez intente.', ['params' => ['alert' => 'error']]);
        }

        return $this->redirect(['action' => 'index']);
    }

    /******** Para autocompletar la lista de roles -- add user ********/
    public function getmodulo($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $permisos_rol = $this->ModuleRole->find('all')->where(['role_id' => $id])->toArray();
            echo(json_encode($permisos_rol, JSON_PRETTY_PRINT));
        }
    }


}
