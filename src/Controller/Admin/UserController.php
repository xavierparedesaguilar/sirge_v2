<?php
namespace App\Controller\Admin;

//use App\Controller\AppController;
use App\Controller\Admin\AppController;
use App\View\Helper\FunctionsHelper;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

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
        $this->loadComponent('Csrf');
        $this->loadModel('ModuleUser');
        $this->loadModel('ModuleRole');
        $this->loadModel('Station');
        //$this->Functions = new FunctionsHelper(new \Cake\View\View());
        $this->mod_padre = "Gestión de seguridad";

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => $this->name])->first();
        if(!empty($this->module))
          $this->permiso=$this->Functions->validarModulo($this->module->id);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        if($this->permiso['index']){

                $user = $this->User->find()->contain(['Role', 'Station'])->where(['User.status !=' => '0'])->order(['User.id'=>'DESC']);

                $mod_padre = $this->mod_padre;
                $titulo = "Usuarios";
                $permiso= $this->permiso;

                $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
                $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                            'assets/js/datatable/dataTables.bootstrap.min',
                            'assets/js/datatable/dataTables.select.min',
                            'assets/packages/jqueryvalidation/dist/jquery.validate'];

                $this->set(compact('user', 'titulo','mod_padre', 'styles', 'scripts','permiso'));
                $this->set('_serialize', ['user']);

        } else {

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect($this->Auth->redirectUrl());

       }
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
        $user_count = $this->User->find()->where(['User.status !=' => '0','User.id '=>$id])->count();

        if($user_count>0 && $this->permiso['view']) {

            $user = $this->User->get($id, [
                'contain' => ['Role', 'Module']
            ]);

            $titulo = $this->mod_padre;
            $permiso= $this->permiso;
            $this->set(compact('user', 'titulo','permiso'));
            $this->set('_serialize', ['user']);


        }else{

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        if($this->permiso['add']){

            $user = $this->User->newEntity();
            if ($this->request->is('post')) {
				
                try {

                    $data = $this->request->getData();
                    $nom_ = explode(' ', $data['names']);
                    $ape_ = explode(' ', $data['surnames']);
                    $username = $this->Functions->letterAccent($nom_[0], 'lower') . "." . $this->Functions->letterAccent($ape_[0], 'lower');

                    $count_user = $this->User->find()->where(['username' => $username])->count();
					
                    if($count_user > 0){

                        $data['username'] = $username.$count_user;

                    } else {

                        $data['username'] = $username;
                    }

                    $data['token'] = $this->Functions->generate_token($data['username'], $data['password']);
                    $data['status'] = '1';
					

                    $user = $this->User->patchEntity($user, $data);

                    if ($this->User->save($user)) {

                        $usuario_id = $user->id;
						//print_r($this->request->$data['Permiso']."hola");
					//exit();
                        if ((isset( $this->request->data['permissions']))) {

                            $permisos = $this->request->data['permissions'];
                            $this->permisosEach($permisos, $usuario_id);
                        }
                        else{

                            $this->Flash->error(__('Debe seleccionar al menos un Módulo y una Función.'));
                            return $this->redirect(['action' => 'edit','controller'=>'User']);
                        }

                        $list_module = explode('/', $this->request->params['_matchedRoute']);

                        $user_id    = $this->Auth->User('id');
                        $module     = $list_module[(count($list_module)-2)];
                        $action     = $list_module[(count($list_module)-1)];
                        $station_id = $user->id;
                        $recurso_id = '4';

                        $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                        $this->Flash->success(__('Usuario creado satisfactoriamente.'));
						
						/******************************************************************************************/
						$conn = ConnectionManager::get('default');
					
						if($data['Permiso'] == "0"){
							$perm = 0;
						}
						else{
							$perm = 1;
						}
						
						$stmt = $conn->prepare("INSERT INTO permiso_estacion (idusuario, estado) VALUES (".$usuario_id.", ".$perm.")");
						$stmt->execute();
						/******************************************************************************************/
						
                        return $this->redirect(['action' => 'index']);
                    }

                    $this->Flash->error(__('Hubo inconvenientes al crear usuario. Por favor, Otra vez intente.'));

                } catch (\Exception $e) {

                    $this->Flash->error(__('Complete los campos requeridos. Por favor, Otra vez intente.'));
                    return $this->redirect(['action' => 'index']);
                }
            }

            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

            $roles = $this->User->Role->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => '1']);
            $countrys = $this->User->Country->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => '1']);
            $mod_padre = $this->mod_padre;
            $titulo = "Usuarios";

            $station           = $this->Station->find('list', ['keyField' => 'id', 'valueField' => 'eea'])->where(['status' => 1, 'availability' => 1]);

            $modulos = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL, 'resource_id' => 4])->toArray();


            foreach ($modulos as $key => $modulo) {
                $modulos[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
            }

            /*RECURSO 1*/
            $modulos_1 = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL, 'resource_id' => 1])->toArray();
            foreach ($modulos_1 as $key => $modulo) {
                $modulos_1[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
            }

            //print_r(json_encode($modulos_1));
            /*RECURSO 2*/
            $modulos_2 = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL, 'resource_id' => 2])->toArray();
            foreach ($modulos_2 as $key => $modulo) {
                $modulos_2[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
            }

            //print_r(json_encode($modulos_2));
            /*RECURSO 2*/
            $modulos_3 = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL, 'resource_id' => 3])->toArray();
            foreach ($modulos_3 as $key => $modulo) {
                $modulos_3[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
            }
            //print_r(json_encode($modulos_3)); exit();
            $this->set(compact('user', 'roles', 'modulos',  'modulos_1', 'modulos_2', 'modulos_3', 'titulo','countrys','mod_padre', 'scripts','station'));

            $this->set('_serialize', ['roles', 'modulos']);


        } else {

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
        }
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
        $user_count = $this->User->find()->where(['User.status !=' => '0','User.id '=>$id])->count();
		//print_r($user_count);
		//exit();

        if($user_count==NULL && $this->permiso['edit']){

            $this->Flash->error(__('Operación denegada.'));
            return $this->redirect(['action' => 'index']);

        } else {

            $user = $this->User->get($id, [
                'contain' => ['Module']
            ]);

            if ($this->request->is(['patch', 'post', 'put'])) {


                $data = $this->request->getData();
                $nom_ = explode(' ', trim($data['names']));
                $ape_ = explode(' ', trim($data['surnames']));
                $data['username'] = $this->Functions->letterAccent($nom_[0], 'lower') . "." . $this->Functions->letterAccent($ape_[0], 'lower');
                // $data['token'] = $this->Functions->generate_token($data['username'], $data['password']);

                if($user->username != $data['username']){

                    $count_user = $this->User->find()->where(['username' => $data['username'] ])->count();

                    if($count_user > 0){

                        $data['username'] = $data['username'].$count_user;
                    }
                }

                $user = $this->User->patchEntity($user, $data);

                if ($this->User->save($user)) {

                    /**** Se elimina todos los permisos para luego registrar nuevamente *****/
                    $this->deletePermisos($id);


                    if ((isset( $this->request->data['permissions']))) {


                        $permisos = $this->request->data['permissions'];

                        $this->permisosEach($permisos, $id);
                    }
                    else{

                        $this->Flash->error(__('Debe seleccionar al menos un Módulo y una Función.'));
                        return $this->redirect(['action' => 'edit','controller'=>'User','id'=>$id]);
                    }

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = $list_module[(count($list_module)-2)];
                    $station_id = $user->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('Usuario actualizado satisfactoriamente.'));
					
					/******************************************************************************************/
						$conn = ConnectionManager::get('default');
						if(empty($data['Permiso']) || $data['Permiso'] == "0"){
							$perm = 0;
						}
						else{
							$perm = 1;
						}
						$sql="SELECT estado FROM permiso_estacion WHERE idusuario=".$id;
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						
						if( $stmt->rowCount() > 0){
							$sqlres="UPDATE permiso_estacion SET estado=".$perm." WHERE idusuario=".$id;
						}else {
							$sqlres="INSERT INTO permiso_estacion (idusuario, estado) VALUES (".$id.", ".$perm.")"; 
						}
						$stmt = $conn->prepare($sqlres);
						$stmt->execute(); 
						 
					/******************************************************************************************/
                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Hubo inconvenientes al actualizar el usuario. Por favor, Otra vez intente.'));
            }

            $scripts = ['assets/packages/jqueryvalidation/dist/jquery.validate'];

            $roles = $this->User->Role->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => '1']);
            $countrys = $this->User->Country->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status' => '1']);

            $titulo = $this->mod_padre;

            $modulo_user = $this->ModuleUser->find()->where(['user_id' => $id]);

            $station           = $this->Station->find('list', ['keyField' => 'id', 'valueField' => 'eea'])->where(['status' => 1, 'availability' => 1]);

            $temp_u = [];
            foreach ($modulo_user as $permiso) {
                $temp_u[$permiso->module_id] = $permiso->permissions;
            }

            $modulo_user = $temp_u;

            /* tabla de modulos generales */
            $modulos = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL, 'resource_id' => 4])->toArray();
            foreach ($modulos as $key => $modulo) {
                $modulos[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
                if (array_key_exists($modulo->id, $modulo_user)) {
                    $modulos[$key]->modulopermiso = $modulo_user[$modulo->id];
                }
                if (count($modulos[$key]->modulerole) > 0) {
                    foreach ($modulos[$key]->modulerole as $keyp => $per) {
                        if (array_key_exists($per->id, $modulo_user)) {
                            $modulos[$key]->modulerole[$keyp]->modulopermiso = $modulo_user[$per->id];
                        }
                    }
                }
            }

            /* tabla de modulos primer recurso */
            $modulos_1 = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL, 'resource_id' => 1])->toArray();
            foreach ($modulos_1 as $key => $modulo) {
                $modulos_1[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
                if (array_key_exists($modulo->id, $modulo_user)) {
                    $modulos_1[$key]->modulopermiso = $modulo_user[$modulo->id];
                }
                if (count($modulos_1[$key]->modulerole) > 0) {
                    foreach ($modulos_1[$key]->modulerole as $keyp => $per) {
                        if (array_key_exists($per->id, $modulo_user)) {
                            $modulos_1[$key]->modulerole[$keyp]->modulopermiso = $modulo_user[$per->id];
                        }
                    }
                }
            }

            /* tabla de modulos segundo recurso */
            $modulos_2 = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL, 'resource_id' => 2])->toArray();
            foreach ($modulos_2 as $key => $modulo) {
                $modulos_2[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
                if (array_key_exists($modulo->id, $modulo_user)) {
                    $modulos_2[$key]->modulopermiso = $modulo_user[$modulo->id];
                }
                if (count($modulos_2[$key]->modulerole) > 0) {
                    foreach ($modulos_2[$key]->modulerole as $keyp => $per) {
                        if (array_key_exists($per->id, $modulo_user)) {
                            $modulos_2[$key]->modulerole[$keyp]->modulopermiso = $modulo_user[$per->id];
                        }
                    }
                }
            }

            /* tabla de modulos tercer recurso */
            $modulos_3 = $this->User->Module->find()->where(['status' => 1, 'parent_id IS ' => NULL, 'resource_id' => 3])->toArray();
            foreach ($modulos_3 as $key => $modulo) {
                $modulos_3[$key]->modulerole = $this->User->Module->find()->where(['status' => 1, 'parent_id' => $modulo->id])->toArray();
                if (array_key_exists($modulo->id, $modulo_user)) {
                    $modulos_3[$key]->modulopermiso = $modulo_user[$modulo->id];
                }
                if (count($modulos_3[$key]->modulerole) > 0) {
                    foreach ($modulos_3[$key]->modulerole as $keyp => $per) {
                        if (array_key_exists($per->id, $modulo_user)) {
                            $modulos_3[$key]->modulerole[$keyp]->modulopermiso = $modulo_user[$per->id];
                        }
                    }
                }
            }

            $this->set(compact('user', 'modulos', 'modulos_1', 'modulos_2', 'modulos_3', 'roles', 'titulo', 'scripts','station'));
            $this->set('_serialize', ['user']);
        }
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
        $user_count = $this->User->find()->where(['User.status '=>'1','User.id'=>$id])->count();

        if($user_count>0 && $this->permiso['delete']){

            $this->request->is(['post', 'delete']);

            $user = $this->User->find()->where(['User.status !=' => '0','User.id'=>$id])->first();

            if($user==NULL){

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index',$id]);

            }else{
                $user->status = '0';

                if ($this->User->save($user)) {

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = $list_module[(count($list_module)-2)];
                    $station_id = $user->id;
                    $recurso_id = '4';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success(__('Usuario eliminado satisfactoriamente'));

                } else {

                    $this->Flash->error(__('Hubo inconvenientes al eliminar el usuario. Por favor, Otra vez intente.'));
                }

            return $this->redirect(['action' => 'index']);
            }
        }else{
                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);
        }

    }

    /******** Para autocompletar la lista de roles -- add user ********/
    public function getmodulo($id = null)
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $permisos_rol = $this->ModuleRole->find('all')->where(['role_id' => $id])->toArray();

            echo(json_encode($permisos_rol));
        }
    }

    /*************** Recorre todo el arreglo de permisos para insertarlo por rol que se asigno al usuario **************/
    private function  permisosEach($permisos_, $id_)
    {
        //print_r(json_encode($permisos_)) ; exit();
        $i = 0;
        $mod_user = [];
        foreach ($permisos_ as $key => $val) {

            $mod_user[$i]['user_id'] = $id_;
            $mod_user[$i]['module_id'] = $key;
            $mod_user[$i]['permissions'] = implode(",", $val);
            $i++;
        }

        foreach ($mod_user as $modu) {
            $articlesTable = TableRegistry::get('ModuleUser');
            $article = $articlesTable->newEntity();
            $etable = $this->ModuleUser->patchEntity($article, $modu);
            $articlesTable->save($etable);
        }
    }

    /**************** Se eliminan todos los permisos ****************/
    private function deletePermisos($user_id)
    {
        $entities = $this->ModuleUser->find()->where(['user_id' => $user_id]);
        foreach ($entities as $entity) {
            $this->ModuleUser->delete($entity);
        }
    }


    //*******************************+ CAMBIAR LA CLAVE DE LOS USUARIOS ***************************//
    public function changePass($id = null)
    {
        $user = $this->User->get($id);

        if ($this->request->is(['post', 'put'])) {

            $data = $this->request->data;

            $data['token'] = $this->Functions->generate_token($user->username, $data['password']);

            $this->User->patchEntity($user, $data);

            if ($this->User->save($user)) {

                $this->Flash->success('La Contraseña se cambio satisfactoriamente.');
                return $this->redirect(['action' => 'index']);

            } else {

                $this->Flash->error('Hubo inconvenientes al cambiar la contraseña. Por favor, Intentelo otra vez.');
            }

        } else {

            if ($this->request->is('ajax')) {

                $titulo = $user->username;
                $this->set(compact('titulo', 'user'));

                $this->render('/Admin/User/password');

            } else {

                return $this->redirect('/gestion-seguridad');
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
