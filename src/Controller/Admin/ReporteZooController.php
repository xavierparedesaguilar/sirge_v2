<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use PDO;

/**
 * InputField Controller
 *
 * @property \App\Model\Table\InputFieldTable $InputField
 */
class ReporteZooController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->mod_parent = "";
        $this->mod_padre = "Módulo de Reportes Zoogénetico";
        $this->loadModel('BankField');
        $this->loadModel('OptionList');
        $this->tipo_recurso=2;

        $this->loadModel('Module');
        $this->module = $this->Module->find()->where(['controller' => $this->name])->first();
        if(!empty($this->module))
          $this->permiso=$this->Functions->validarModulo($this->module->id);
    }



    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function index()
    {
        if($this->permiso['index']){

            $idReport=0;
            $modulo= $this->mod_padre ;
            $styles  = ['assets/css/dataTables.bootstrap'];
            $scripts = ['assets/js/select2/select2', 'assets/js/datatable/jquery.dataTables.min',
                        'assets/js/datatable/dataTables.bootstrap.min',
                        'assets/js/fileinput/fileinput.min',
                        'assets/packages/jqueryvalidation/dist/jquery.validate'];

            if ($this->request->is('post')) {

                  $data=$this->request->getData();
                  $lista_columns=$this->getColumsReporte($data['tip_repor']);
                  $idReport=$data['opc_repor'];
                  $lista_rows=$this->getDataReporte($data['tip_repor']);
                  $titulo=$this->getTituloReporte($data['tip_repor']);
             }
                $permiso=$this->permiso;
                $lista_opciones=array(614);
                $lista_opcion_reporte= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['id in' => $lista_opciones, 'status' => 1,'resource_id'=>4]);

                $lista_reporte= $this->OptionList->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['parent_id' =>$idReport, 'status' => 1 ]);

                $this->set(compact('modulo','scripts','lista_opcion_reporte','styles','lista_reporte','lista_columns','lista_rows','permiso','titulo','tipoReporte'));

        } else {

                $this->Flash->error(__('Operación denegada.'));
                return $this->redirect($this->Auth->redirectUrl());
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Input Field id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function getDataReporte($tipoReporte = null)
    {

        $conn = ConnectionManager::get('default');
        $sql=null;
        $lista_rows=array();
        $parametro=false;

        /** Lista de Accesiones **/

        if($tipoReporte==615){

            $sql="SELECT stacion,SUM(total) total FROM
                          (SELECT stacion , COUNT(*) total FROM
                          (SELECT DISTINCT sta.eea stacion ,pass.othenumb acesion
                              FROM passport as pass
                              INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                              INNER JOIN station as sta on pass.station_origin_id=sta.id
                              WHERE pass.resource_id=? AND pass.othenumb<>'' AND  sta.status=1 and pass.status=1) TABLA
                          GROUP BY stacion) TABLA2
                          GROUP BY stacion
                          ORDER BY stacion " ;
            $parametro=true;

        }

        if($tipoReporte==616){

            $sql="SELECT nombre,SUM(total) total FROM
                          (SELECT nombre , COUNT(*) total FROM
                          (SELECT DISTINCT pais.name nombre,pass.othenumb acesion
                               FROM passport AS pass
                               INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                               INNER JOIN country as pais on pass.country_id=pais.id
                               WHERE pass.resource_id=? AND pais.status=1 and pass.status=1  AND pass.othenumb<>'') TABLA
                          GROUP BY nombre) TABLA2
                          GROUP BY nombre
                          ORDER BY nombre" ;
            $parametro=true;

        }

        if($tipoReporte==617){

            $sql="SELECT nombre,SUM(total) total FROM
                          (SELECT nombre , COUNT(*) total FROM
                          (SELECT DISTINCT dep.nombre nombre,pass.othenumb acesion
                                 FROM passport pass
                                 INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                                 INNER JOIN  ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo dep  ON dist.cod_dep=dep.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=? AND pass.status=1 AND dist.status=1 AND dep.status=1 AND pass.othenumb<>'') TABLA
                          GROUP BY nombre) TABLA2
                          GROUP BY nombre
                          ORDER BY nombre " ;
            $parametro=true;

        }

        if($tipoReporte==618){

            $sql="SELECT descripcion,SUM(total) total FROM
                          (SELECT descripcion , COUNT(*) total FROM
                          (SELECT DISTINCT CONCAT_WS(' - ',dep.nombre, prov.nombre) as descripcion,pass.othenumb acesion
                                 FROM passport pass
                                 INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                                 INNER JOIN ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo prov  ON dist.cod_pro=prov.cod_pro AND dist.cod_dep=prov.cod_dep AND prov.cod_dis=0
                                 INNER JOIN ubigeo dep  ON dep.cod_dep=dist.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=? AND pass.status=1 AND dist.status=1 AND prov.status=1 AND pass.othenumb<>'') TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion " ;
            $parametro=true;

        }

        if($tipoReporte==619){

            $sql="SELECT descripcion,SUM(total) total FROM
                          (SELECT descripcion , COUNT(*) total FROM
                          (SELECT DISTINCT CONCAT_WS(' - ',dep.nombre,prov.nombre ,dist.nombre)  descripcion,pass.othenumb acesion
                                  FROM passport pass
                                 INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                                 INNER JOIN ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo prov  ON dist.cod_pro=prov.cod_pro AND dist.cod_dep=prov.cod_dep AND prov.cod_dis=0
                                 INNER JOIN ubigeo dep  ON dep.cod_dep=dist.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=? AND pass.status=1 AND dist.status=1 AND prov.status=1 AND pass.othenumb<>'') TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion " ;
            $parametro=true;

        }

        if($tipoReporte==620){

            $sql="
                  SELECT 'ADN', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,pass.othenumb descripcion
                          FROM passport pass
                            INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                            WHERE pass.id IN ( SELECT passport_id FROM bank_dna WHERE status=1 AND type_resource=$this->tipo_recurso )
                          AND status=1 AND pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'')
                              TABLA" ;

            $parametro=false;

        }

        if($tipoReporte==621){

            $sql="SELECT descripcion,SUM(total) total FROM(
                          SELECT descripcion , COUNT(*) total FROM
                          ( SELECT DISTINCT coleccion.colname descripcion ,pass.othenumb acesion
                                    FROM passport pass
                                    INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                                    INNER JOIN specie especie ON especie.id=pass.specie_id
                                    INNER JOIN collection coleccion ON coleccion.id=especie.collection_id
                                    WHERE pass.resource_id=? AND pass.othenumb<>'' AND especie.status=1 AND coleccion.status=1 AND pass.status=1)TABLA
                          GROUP BY acesion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion" ;

            $parametro=true;

        }

        if($tipoReporte==622){

            $sql="SELECT descripcion,SUM(total) total FROM(
                          SELECT descripcion , COUNT(*) total FROM
                          ( SELECT DISTINCT CONCAT_WS(' - ',especie.genus, especie.species) descripcion ,pass.othenumb acesion
                                    FROM passport pass
                                    INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                                    INNER JOIN specie especie ON especie.id=pass.specie_id
                                    WHERE pass.resource_id=? AND pass.othenumb<>'' AND especie.status=1 AND pass.status=1)TABLA
                          GROUP BY acesion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion" ;

            $parametro=true;

        }

        if($tipoReporte==624){

            $sql="SELECT descripcion,species,SUM(total) total  FROM(
                  SELECT id,descripcion ,species, COUNT(*) total FROM
                  (SELECT DISTINCT col.id,col.colname descripcion,especie.species ,pass.othenumb acesion FROM characterization_detail det
                           INNER JOIN passport pass ON det.passport_id=pass.id
                           INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                           INNER JOIN specie as especie on pass.specie_id=especie.id
                           INNER JOIN collection as col on especie.collection_id=col.id
                  WHERE pass.resource_id=$this->tipo_recurso AND  pass.status=1 AND especie.status=1
                          AND col.status=1 AND col.resource_id=$this->tipo_recurso AND det.status=1 AND pass.othenumb<>'')TABLA
                  GROUP BY descripcion,species) TABLA2
                  GROUP BY descripcion,species
                  ORDER BY descripcion ASC" ;

            $parametro=false;

        }

        if($tipoReporte==625){

            $sql="SELECT descripcion,species,SUM(total) total ,CONCAT(ROUND(total*100/f_cant_col_specie(id,2),2) ,'%') porcentaje FROM(
                  SELECT id,descripcion ,species, COUNT(*) total FROM
                  (SELECT DISTINCT col.id,col.colname descripcion,especie.species ,pass.othenumb acesion FROM characterization_detail det
                           INNER JOIN passport pass ON det.passport_id=pass.id
                           INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                           INNER JOIN specie as especie on pass.specie_id=especie.id
                           INNER JOIN collection as col on especie.collection_id=col.id
                  WHERE pass.resource_id=$this->tipo_recurso AND  pass.status=1 AND especie.status=1
                          AND col.status=1 AND col.resource_id=$this->tipo_recurso AND det.status=1 AND pass.othenumb<>'')TABLA
                  GROUP BY descripcion,species) TABLA2
                  GROUP BY descripcion,species
                  ORDER BY descripcion ASC" ;

            $parametro=false;

        }

        if($tipoReporte==627){

            $sql="SELECT descripcion,SUM(total) total FROM(
                  SELECT descripcion , COUNT(*) total FROM
                  (SELECT DISTINCT if(pass.country_id=173, 'Nacional','Internacional') descripcion,pass.othenumb acesion FROM passport pass
                    INNER JOIN passport_zoo zoo ON zoo.passport_id=pass.id AND zoo.availability=27
                              WHERE pass.resource_id=? AND pass.status=1 AND pass.othenumb<>'')TABLA
                  GROUP BY descripcion) TABLA2
                  GROUP BY descripcion
                  ORDER BY descripcion" ;

            $parametro=true;

        }



        if(!empty($sql)){

            $stmt = $conn->prepare($sql);
            if($parametro)
            $stmt->bindValue(1, $this->tipo_recurso, PDO::PARAM_STR);
            $stmt->execute();
            //$lista_resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $lista_rows=$stmt->fetchAll();
        }

        return  $lista_rows;
    }

    public function getColumsReporte($tipoReporte = null)
    {

        $lista_columns=array();

        //** Lista de Accesiones **//

        if($tipoReporte==615){

             $lista_columns=array('ITEM','ESTACIÓN EXPERIMENTAL AGRARIA','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==616){

             $lista_columns=array('ITEM','PAÍS','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==617){

             $lista_columns=array('ITEM','DEPARTAMENTOS','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==618){

             $lista_columns=array('ITEM','PROVINCIA','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==619){

             $lista_columns=array('ITEM','DISTRITOS','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==620){

             $lista_columns=array('ITEM','TIPO DE CONSERVACIÓN','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==621){

             $lista_columns=array('ITEM','COLECCIÓN','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==622){

             $lista_columns=array('ITEM','ESPECIE','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==624){

          $lista_columns=array('ITEM','COLECCIÓN','ESPECIE','CANTIDAD ACCESIONES');

        }

       if($tipoReporte==625){

         $lista_columns=array('ITEM','COLECCIÓN','ESPECIE','CANTIDAD ACCESIONES','PORCENTAJE DE ACCESIONES');

        }

        if($tipoReporte==627){

             $lista_columns=array('ITEM','DISTRIBUCIÓN','CANTIDAD ACCESIONES');

        } else{

            // $lista_columns=array('ITEM','ESTACIÓN EXPERIMENTAL AGRARIA','CANTIDAD ACCESIONES');
        }

        return $lista_columns;
    }

    public function getTituloReporte($tipoReporte = null)
    {

        $tituloReporte=null;

        //** Lista de Accesiones **/

        if($tipoReporte==615){

          $tituloReporte='ESTACIÓN EXPERIMENTAL - ACCESIONES';
        }

        if($tipoReporte==616){

          $tituloReporte='PAÍS - ACCESIONES';
        }

        if($tipoReporte==617){

          $tituloReporte='DEPARTAMENTO - ACCESIONES';
        }

        if($tipoReporte==618){

          $tituloReporte='PROVINCIA - ACCESIONES';
        }

        if($tipoReporte==619){

          $tituloReporte='DISTRITOS - ACCESIONES';
        }

        if($tipoReporte==620){

          $tituloReporte='TIPO DE CONSERVACIÓN - ACCESIONES';
        }

        if($tipoReporte==621){

          $tituloReporte='COLECCIÓN - ACCESIONES';
        }

        if($tipoReporte==622){

          $tituloReporte='ESPECIE - ACCESIONES';
        }

        if($tipoReporte==624){

           $tituloReporte='CARACTERIZADAS POR COLECCIÓN Y ESPECIE - ACCESIONES';
        }

        if($tipoReporte==625){

             $tituloReporte='NÚMERO Y PORCENTAJE DE ACCESIONES CARACTERIZADAS MORFOLÓGICAMENTE - ACCESIONES';
        }

        if($tipoReporte==627){

            $tituloReporte='LISTA DE DISTRIBUCIÓN DE ACCESIONES(NACIONAL/INTERNACIONAL) - ACCESIONES';
        }

        return $tituloReporte;
    }


    public function export($id=null){

        $tipoReporte=$this->request->params['id'];

        if(isset($tipoReporte) && $this->permiso['export']){

            //** Lista de Accesiones **/

            if($tipoReporte==615){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==616){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==617){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==618){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==619){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==620){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==621){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==622){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==623){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==624){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==627){

                $this->exportarExcel($tipoReporte,0,0);

            } else{

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index']);
            }
        }

    }



    public function exportarExcel($tipoReporte = null,$letraInicio=0,$inicioFila=0)
    {
        $data_rows= $this->getDataReporte($tipoReporte);

        if(count($data_rows)>0){

                $letraDefault=65;

                //Inicio Columna 'A' valor minimo adicional cero
                $letra=$letraDefault+$letraInicio;

                //Inicio Fila mínimo 2

                $letraFinal=0;

                $objPHPExcel = new \PHPExcel();



                 $estiloTitle = array(
                                  'font' => array(
                                            'name'     => 'Calibri',
                                            'bold'     => true,
                                            'italic'   => false,
                                            'strike'   => false,
                                            'size'     => 14,
                                            'color' => array(
                                                'rgb' => '000000'
                                            )
                                    ),
                                    'alignment' =>  array(
                                      'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                      'vertical'   => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                      'rotation'   => 0,
                                      'wrap'       => TRUE
                                    )
                        );

                  $estiloColumna = array(
                                  'font' => array(
                                            'name'     => 'Calibri',
                                            'bold'     => true,
                                            'italic'   => false,
                                            'strike'   => false,
                                            'size'     => 11,
                                            'color' => array(
                                                'rgb' => '000000'
                                            )
                                    ),
                                    'borders' => array(
                                        'allborders' => array(
                                          'style' => \PHPExcel_Style_Border::BORDER_THIN
                                        )
                                    ),
                                    'fill' => array(
                                    'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
                                    'color' => array(
                                    'rgb' => '02bf69')
                                    ),
                                    'alignment' =>  array(
                                      'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                      'vertical'   => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                                      'rotation'   => 0,
                                      'wrap'       => TRUE
                                    )
                        );

                  $estiloRows = array(
                                  'font' => array(
                                            'name'     => 'Calibri',
                                            'bold'     => false,
                                            'italic'   => false,
                                            'strike'   => false,
                                            'size'     => 11,
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



                // Titulo del reporte
                $tituloReporte=$this->getTituloReporte($tipoReporte);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr($letra).($inicioFila+1),$tituloReporte);
                $objPHPExcel->getActiveSheet()->getStyle(chr($letra).($inicioFila+1))->applyFromArray($estiloTitle);

                foreach ($this->getColumsReporte($tipoReporte) as $key => $value) {

                        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(chr($key+$letra))->setAutoSize(TRUE);
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr($key+$letra).($inicioFila+3),$value);
                        $objPHPExcel->getActiveSheet()->getStyle(chr($key+$letra).($inicioFila+3))->applyFromArray($estiloColumna);
                }

                foreach ($data_rows as $key => $value) {

                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr($letra).($key+$inicioFila+4),$key+1);
                        $objPHPExcel->getActiveSheet()->getStyle(chr($letra).($key+$inicioFila+4))->applyFromArray($estiloRows);

                        foreach ($value  as $index => $dataRow) {

                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue(chr($index+$letra+1).($key+$inicioFila+4),$dataRow);
                                $objPHPExcel->getActiveSheet()->getStyle(chr($index+$letra+1).($key+$inicioFila+4))->applyFromArray($estiloRows);
                                $letraFinal=$index+$letra+1;
                        }

                }

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells(chr($letra).($inicioFila+1).':'.chr($letraFinal).($inicioFila+1));

                $titulo_tab=explode('-',  $this->getTituloReporte($tipoReporte));
                $titulo_tabs=explode('(',  $titulo_tab[0]);
                $objPHPExcel->getActiveSheet()->setTitle('Lista de Accesiones');
                $objPHPExcel->setActiveSheetIndex(0);

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename='.$titulo_tabs[0].'.xlsx');
                header('Cache-Control: max-age=0');
                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;

        }else{

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index']);
        }


    }

    /**
     * Delete method
     *
     * @param string|null $id Input Field id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        print_r(json_encode($this->request->is(['post', 'delete']))); exit();
        $bankField_count = $this->BankField->find()->where(['bankField.status '=>'1','bankField.id'=>$id])->count();

            if($bankField_count>0 && $this->permiso['delete']){

               $this->request->is(['post', 'delete']);

                $inputField = $this->InputField->find()
                                         ->where(['inputField.status !=' => '0','inputField.id'=>$child,'inputField.bank_field_id'=>$id
                                            ])->first();

                if($inputField==NULL){

                        $this->Flash->error(__('Operación denegada.'));
                        return $this->redirect(['action' => 'index',$id]);

                } else {

                        $inputField['status'] = 0;

                        if ($this->InputField->save($inputField)) {
                            $this->Flash->success(__('La Salida Material fue eliminado satisfactoriamente.'));
                        } else {
                             $this->Flash->error(__('Hubo inconvenientes al eliminar la Salida Material . Por favor, Otra vez intente.'));
                        }

                       return $this->redirect(['action' => 'index', $inputField->bank_field_id]);

                    }

            }  else {

                     $this->Flash->error(__('Operación denegada.'));
                     return $this->redirect(['action' => 'index','controller'=>'BankField']);

            }
    }
}
