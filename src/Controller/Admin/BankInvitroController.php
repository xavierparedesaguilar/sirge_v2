<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\loadModel;
use App\View\Helper\FunctionsHelper;
use Cake\Datasource\ConnectionManager;
use PDO;
/**
 * BankInvitro Controller
 *
 * @property \App\Model\Table\BankInvitroTable $BankInvitro
 */
class BankInvitroController extends AppController
{

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadComponent('Csrf');
        $this->mod_parent = "Gestión Inventario";
        $this->mod_padre = "Banco In vitro";
        $this->loadModel('Ubigeo');
        $this->loadModel('OptionList');
        $this->loadModel('Passport');
        $this->loadModel('PassportFito');
        $this->loadModel('InputInvitro');
        $this->loadModel('OutputInvitro');
        $this->loadModel('ConservationInvitro');
        $this->loadModel('PropagationInvitro');

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


          $styles  = ['assets/css/dataTables.bootstrap', 'assets/css/select.bootstrap.min'];
          $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                      'assets/js/datatable/dataTables.bootstrap.min',
                      'assets/js/datatable/dataTables.select.min'];

          $bankInvitro = $this->BankInvitro->find()
                                           ->contain('Passport.Specie.Collection')
                                           ->leftJoinWith('Passport.Specie.Collection')
                                           ->where(['BankInvitro.status !=' => '0']);

          $titulo = $this->mod_parent ." - ".$this->mod_padre;
          $titulo_lista =$this->mod_padre;
          $module=$this->module;
          $permiso= $this->permiso;

          $this->set(compact('bankInvitro', 'titulo','styles','scripts','titulo_lista','permiso','module'));

          $this->set('_serialize', ['bankInvitro']);

      } else {

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect($this->Auth->redirectUrl());

      }

    }

    /**
     * View method
     *
     * @param string|null $id Bank Invitro id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->permiso['view']){

              $bankInvitro = $this->BankInvitro->find()->contain('Passport.Specie.Collection')
                                               ->leftJoinWith('Passport.Specie.Collection')
                                               ->where(['BankInvitro.status !=' => '0','BankInvitro.id '=>$id])->first();
        $passport = $this->Passport->find()->where(['id '=>$bankInvitro->passport_id])->first();

              $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

              if($bankInvitro ==NULL){

                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);

              }

                $permiso= $this->permiso;
                $titulo = $this->mod_padre;
                $parent = $this->mod_parent;

                $this->set(compact('bankInvitro','titulo','parent','permiso','validar','passport'));
                $this->set('_serialize', ['bankInvitro']);

          } else {

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

              $bankInvitro = $this->BankInvitro->newEntity();
              $scripts = ['assets/js/fileinput/fileinput.min','assets/packages/jqueryvalidation/dist/jquery.validate'];

              $modulo=$this->mod_padre;

              if ($this->request->is('post')) {

                  $data = $this->request->getData();
                  $data['status'] = '1';
                  $data['bank_availability'] = '1';

                  if($data['tubenumb']!=null && $data['explnumb']!=null)

                      $data['stock']=$data['tubenumb']*$data['explnumb'] ;

                  try{
                      $data['acqdate'] = ($data['fecha_aquisicion'] == '' || $data['fecha_aquisicion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_aquisicion']));

                      $bankInvitro = $this->BankInvitro->patchEntity($bankInvitro, $data);

                      if ($this->BankInvitro->save($bankInvitro)) {

                          /***************** GRABA EL NRO DE LOTE - AUTOGENERADO === ID TABLA *****************/
                          $temp = TableRegistry::get('BankInvitro');
                          $temp_invitro = $temp->get($bankInvitro->id);
                          $temp_invitro->lotnumb = $bankInvitro->id;
                          $temp->save($temp_invitro);

                          $list_module = explode('/', $this->request->params['_matchedRoute']);

                          $user_id    = $this->Auth->User('id');
                          $module     = $list_module[(count($list_module)-2)];
                          $action     = $list_module[(count($list_module)-1)];
                          $station_id = $bankInvitro->id;
                          $recurso_id = '1';

                          $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                          $this->Flash->success('El Banco Invitro fue creado satisfactoriamente', ['params' => ['alert' => 'success']]);
                          return $this->redirect(['action' => 'index']);

                      }

                      $this->Flash->error(__('Hubo inconvenientes al crear el Banco Invitro. Por favor, Otra vez intente.'));

                      } catch (\Exception $e) {

                          $this->Flash->error(__('Hubo inconvenientes al crear el Banco Invitro. Por favor, Otra vez intente.'));
                          return $this->redirect(['action' => 'index']);
                      }
              }

              $tipo_disponibilidad= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 330, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $tipo_conservacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 307, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $conservacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 307, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $temperatura= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 310, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_estado_planta= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 276, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_necrosis= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 282, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_defolacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 287, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_enraizamiento= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 292, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_clorosis= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 297, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_fenolizacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 302, 'status' => 1, 'OR' => [['resource_id' => 4]]  ]);

              $lista_almacenamiento= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 333, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_propagacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 337, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_conservacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 344, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $lista_tamanio_tubo= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 313, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

               $lista_estado_fitosanitario= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 316, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

              $this->set(compact('bankInvitro','modulo','scripts','tipo_disponibilidad','tipo_conservacion','conservacion','temperatura','lista_estado_planta','lista_necrosis','lista_defolacion','lista_enraizamiento','lista_clorosis','lista_fenolizacion','lista_almacenamiento','lista_propagacion','lista_conservacion','lista_tamanio_tubo','lista_estado_fitosanitario'));

              $this->set('_serialize', ['bankInvitro']);

           } else {
                  $this->Flash->error(__('Operación denegada.'));
                  return $this->redirect(['action' => 'index']);
          }


    }

    /**
     * Edit method
     *
     * @param string|null $id Bank Invitro id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $bankInvitro = $this->BankInvitro->find()->where(['BankInvitro.status !=' => '0','BankInvitro.id '=>$id])->first();

        $passport = $this->Passport->find()->where(['id '=>$bankInvitro->passport_id])->first();
        $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if( $this->permiso['edit'] /*&& $validar*/ ){



            if($bankInvitro!=NULL){

                 $modulo=$this->mod_padre;
                 $scripts = ['assets/js/fileinput/fileinput.min','assets/packages/jqueryvalidation/dist/jquery.validate'];

                 $passport = $this->BankInvitro->Passport->find()->contain('Specie.Collection')->where(['Passport.status' => '1', 'Passport.resource_id' => 1, 'Passport.id' => $bankInvitro->passport_id])->first();

                if ($this->request->is(['patch', 'post', 'put'])) {

                    $data = $this->request->getData();

                    if($data['tubenumb']!=null && $data['explnumb']!=null)
                        $data['stock']=$data['tubenumb']*$data['explnumb'] ;

                    $data['acqdate'] = ($data['fecha_aquisicion'] == '' || $data['fecha_aquisicion'] == NULL) ? NULL : date('Y-m-d', strtotime($data['fecha_aquisicion']));

                    try{

                        $bankInvitro = $this->BankInvitro->patchEntity($bankInvitro, $data);

                        if ($this->BankInvitro->save($bankInvitro)) {

                          $list_module = explode('/', $this->request->params['_matchedRoute']);

                          $user_id    = $this->Auth->User('id');
                          $module     = $list_module[(count($list_module)-3)];
                          $action     = $list_module[(count($list_module)-2)];
                          $station_id = $bankInvitro->id;
                          $recurso_id = '1';

                          $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);
                          $this->Flash->success(__('El Banco Invitro fue actualizado satisfactoriamente.'));

                          return $this->redirect(['action' => 'index']);
                        }
                        $this->Flash->error(__('Hubo inconvenientes al actualizar el Banco Invitro. Por favor, Otra vez intente.'));

                       } catch (\Exception $e) {

                                $this->Flash->error(__('Hubo inconvenientes al actualizar el Banco Invitro. Por favor, Otra vez intente.'));
                                return $this->redirect(['action' => 'index']);
                       }
                }

                $tipo_disponibilidad= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 330, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $tipo_conservacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 307, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $conservacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 307, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $temperatura= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 310, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_estado_planta= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 276, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_necrosis= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 282, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_defolacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 287, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_enraizamiento= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 292, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_clorosis= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 297, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_fenolizacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 302, 'status' => 1, 'OR' => [['resource_id' => 4]]  ]);

                $lista_almacenamiento= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 333, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_propagacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 337, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_conservacion= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 344, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $lista_tamanio_tubo= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 313, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                 $lista_estado_fitosanitario= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' => 316, 'status' => 1, 'OR' => [['resource_id' => 4]] ]);

                $titulo = $this->mod_padre;
                $parent = $this->mod_parent;

                $bankInvitro->acqdate = ($bankInvitro->acqdate == NULL) ? NULL : date('d-m-Y', strtotime($bankInvitro->acqdate));

                $this->set(compact('scripts','bankInvitro','titulo','parent','passport','modulo','tipo_disponibilidad','tipo_conservacion','conservacion','temperatura','lista_estado_planta','lista_necrosis','lista_defolacion','lista_enraizamiento','lista_clorosis','lista_fenolizacion','lista_almacenamiento','lista_propagacion','lista_conservacion','lista_tamanio_tubo','lista_estado_fitosanitario'));

                $this->set('_serialize', ['bankInvitro']);

              }else{

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
     * @param string|null $id Bank Invitro id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $bankInvitro = $this->BankInvitro->find()->where(['BankInvitro.status !=' => '0','BankInvitro.id '=>$id])->first();
        $passport = $this->Passport->find()->where(['id '=>$bankInvitro->passport_id])->first();
        $validar=$this->permiso['role_id']==1?true:$this->permiso['station_id']==$passport['station_current_id'];

        if($this->permiso['delete'] /*&& $validar*/ ){

            $this->request->is(['post', 'delete']);



            if($bankInvitro!=NULL){

                $bankInvitro['modified'] = date('Y-m-d H:i:s');
                $bankInvitro['status'] = 0;

                if ($this->BankInvitro->save($bankInvitro)) {

                    $inputInvitro = TableRegistry::get("InputInvitro");
                    $query = $inputInvitro->query();
                    $query->update()
                          ->set(['modified' => date('Y-m-d H:i:s'),'status'=>0])
                          ->where(['bank_invitro_id' => $id])
                          ->execute();

                    $outputInvitro = TableRegistry::get("OutputInvitro");
                    $query = $outputInvitro->query();
                    $query->update()
                          ->set(['modified' => date('Y-m-d H:i:s'),'status'=>0])
                          ->where(['bank_invitro_id' => $id])
                          ->execute();


                    $conservationInvitro = TableRegistry::get("ConservationInvitro");
                    $query = $conservationInvitro->query();
                    $query->update()
                          ->set(['modified' => date('Y-m-d H:i:s'),'status'=>0])
                          ->where(['bank_invitro_id' => $id])
                          ->execute();


                    $propagationInvitro = TableRegistry::get("PropagationInvitro");
                    $query = $propagationInvitro->query();
                    $query->update()
                          ->set(['modified' => date('Y-m-d H:i:s'),'status'=>0])
                          ->where(['bank_invitro_id' => $id])
                          ->execute();

                    $list_module = explode('/', $this->request->params['_matchedRoute']);

                    $user_id    = $this->Auth->User('id');
                    $module     = $list_module[(count($list_module)-3)];
                    $action     = $list_module[(count($list_module)-2)];
                    $station_id = $bankInvitro->id;
                    $recurso_id = '1';

                    $this->Functions->saveLogWeb($module, $station_id, $action, $user_id, $recurso_id);

                    $this->Flash->success('El Banco Invitro fue eliminado satisfactoriamente', ['params' => ['alert' => 'success']]);

                }else {

                    $this->Flash->success('Hubo inconvenientes al eliminar el BANCO INVITRO seleccionado . Por favor, Otra vez intente.',['params' => ['alert' => 'error']]);
                }

                return $this->redirect(['action' => 'index']);
            }else{

                 $this->Flash->error(__('Operación denegada.'));
                return $this->redirect(['action' => 'index']);
            }

      } else {

        $this->Flash->error(__('Operación denegada.'));
        return $this->redirect(['action' => 'index']);
      }
  }
    public function exportartabla() {

        if ($this->request->is('post')) {					
			$conn = ConnectionManager::get('default');
			$condicion=" AND Passport.station_current_id=".$this->Auth->User('station_id');
			
			// Validar si tiene acceso a Ver todas las estaciones experimentales ***************************************************************************			
			if( $this->Auth->user('role_id') == 1 ){
				$condicion = "";
			}else {
				$sqlAcceso ="SELECT estado FROM permiso_estacion AS p WHERE p.idusuario =".$this->Auth->user('id');
				$stmtAcceso = $conn->prepare($sqlAcceso);
				$stmtAcceso->execute();
				
				if( $stmtAcceso->rowCount() > 0){
					$rowAcceso = $stmtAcceso->fetch();
					
					if($rowAcceso[0] == 1){
						$condicion=" ";
					}
				}
			}	 
			///*********************************	
			
			$sql="SELECT
					p.accenumb AS 'Codigo PER',
					p.othenumb AS 'Codigo Accesion',
					c.colname AS 'Coleccion',
					UPPER(CONCAT(s.genus,' ',s.species)) AS 'Nombre Cientifico',
					UPPER(s.cropname) AS 'Nombre Comun',
					b.acqdate AS 'Fecha Adquisicion',
					(SELECT name FROM option_list WHERE id=b.availability) AS 'Disponibilidad del lote de le Accesion',
					b.remarks AS 'Anotaciones',
					(SELECT name FROM option_list WHERE id=b.storoom) AS 'Cuarto de Conservacion',
					(SELECT name FROM option_list WHERE id=b.temp) AS 'Temperatura',
					b.shelving AS 'Estanteria',
					b.levelshelv AS 'Nivel de estanteria',
					b.rack AS 'Gradilla',
					b.duplinstname AS 'Duplicado de Seguridad',
					b.dupnumb AS 'Numero de Duplicados',
					(SELECT name FROM option_list WHERE id=b.plastate) AS 'Estado de la Planta',
					(SELECT name FROM option_list WHERE id=b.necrosis) AS 'Necrosis de Yema y Talla',
					(SELECT name FROM option_list WHERE id=b.defoliation) AS 'Defoliacion',
					(SELECT name FROM option_list WHERE id=b.rooting) AS 'Enraizamiento',
					(SELECT name FROM option_list WHERE id=b.chlorosis) AS 'Clorosis',
					(SELECT name FROM option_list WHERE id=b.phenolization) AS 'Fenolizacion',
					(SELECT name FROM option_list WHERE id=b.storage) AS 'Tipo de almacenamiento',
					(SELECT name FROM option_list WHERE id=b.propagation) AS 'Propagacion',
					b.protime AS 'Tiempo Maximo en el Medio',
					(SELECT name FROM option_list WHERE id=b.conservation) AS 'Conservacion',
					b.tubenumb AS 'Numeros de Tubos',
					b.explnumb AS 'Numeros de Explantes',
					b.tubesize AS 'Tamaño Tubo',
					(SELECT name FROM option_list WHERE id=b.fitostate) AS 'Estado Fitosanitario de la Planta',
					b.pathogen AS 'Fitopatogenos'
					FROM
					bank_invitro b
					INNER JOIN passport p ON p.id=b.passport_id
					LEFT JOIN specie s ON s.id=p.specie_id
					INNER JOIN collection c ON c.id=s.collection_id
					WHERE p.status!=0".$condicion;
						
	
			$stmtData = $conn->prepare($sql);
			$stmtData->execute();
			
			if( $stmtData->rowCount() >= 1){
				
				$libros = $stmtData->fetchAll(PDO::FETCH_ASSOC);
			 
				$filename = "BancoInvitro_".date('Ymd H:i:s').".xlsx"; 

				/************************************ CREACION DEL EXCEL ***********************************/
				$objPHPExcel = new \PHPExcel();
				$objPHPExcel->setActiveSheetIndex(0);
				
				// Creación de las letras del abecedario
				for($i=65; $i<=90; $i++) {
					$letra[] = chr($i);
				}
				for($i=65; $i<=90; $i++) {
					$letra[] = 'A'.chr($i);
				}
				for($i=65; $i<=90; $i++) {
					$letra[] = 'B'.chr($i);
				}
				for($i=65; $i<=90; $i++) {
					$letra[] = 'C'.chr($i);
				}
				
				############################################# css para los titulos ######################################
				$estiloTitle = array(
						  'font' => array(
									'name'     => 'Arial Narrow',
									'bold'     => true,
									'italic'   => false,
									'strike'   => false,
									'size'     => 10,
									'color' => array(
										'rgb' => '000000'
									)
							),
							'borders' => array(
										'allborders' => array(
										  'style' => \PHPExcel_Style_Border::BORDER_THIN
										)
									),
							'alignment' =>  array(
							  'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							  'vertical'   => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
							  'rotation'   => 0,
							  'wrap'       => TRUE
							)
				);
				############################################# /css  para los titulos  #########################################
				
				/************** INICIO GENERACION DE LOS TITULOS *****************/
				$header =  array_keys($libros[0]); // array_keys($resultado[0]);

				$t = 1;

				for($i=0; $i<count($header); $i++){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra[$t-1].'1', $header[$i]);
					$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($letra[$t-1])->setAutoSize(TRUE); 
					$t++;
				}
	 
				$objPHPExcel->getActiveSheet()->getStyle("A1:AD1")->applyFromArray($estiloTitle);
				/*$objPHPExcel->getActiveSheet()
									->getStyle('A1:L1')
									->getFill()
									->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
									->getStartColor()
									->setRGB('D9E1F2');*/
			 				
			  /************************* INICIO IMPRESION DEL CONTENIDO ***************************/
				$celda = 2;
				for($i=0; $i < count($libros); $i++){

					$content = array_values($libros[$i]);

					for($j = 0; $j<count($content); $j++){
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra[$j].($celda), $content[$j]);					
					}

					$celda ++;
				}
					
				/************** FIN   *****************/
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				
				header('Content-Disposition: attachment;filename='.$filename .' ');
				header('Cache-Control: max-age=0');
				$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				$objWriter->save('php://output');

				exit;

			}
		}
  	
		/************** FIN   *****************/
		$handle = fopen("no_data.txt", "w");
		fwrite($handle, "Consulta sin resultados .....");
		fclose($handle);

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename('no_data.txt'));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize('no_data.txt'));
		readfile('no_data.txt');
		 
		
		exit;
	}


}

