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
class ReporteForestalController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
        $this->mod_parent = "";
        $this->mod_padre = "Módulo de Reportes Fitogénetico";
        $this->loadModel('BankField');
        $this->loadModel('OptionList');
        $this->loadModel('Collection');
        $this->loadModel('Specie');

        $this->tipo_recurso=1;

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
                $lista_opciones=array(578,595,604);
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

        if($tipoReporte==579){

            $sql="SELECT stacion,SUM(total) total FROM
                          (SELECT stacion , COUNT(*) total FROM
                          (SELECT DISTINCT sta.eea stacion ,pass.othenumb acesion
                              FROM passport as pass
                              INNER JOIN station as sta on pass.station_current_id=sta.id
                              INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                              WHERE pass.resource_id=? AND pass.othenumb<>'' AND  sta.status=1 and pass.status=1) TABLA
                          GROUP BY stacion) TABLA2
                          GROUP BY stacion
                          ORDER BY stacion " ;
						  
            $parametro=true;

        }

        if($tipoReporte==580){

            $sql="SELECT nombre,SUM(total) total FROM
                          (SELECT nombre , COUNT(*) total FROM
                          (SELECT DISTINCT pais.name nombre,pass.othenumb acesion
                               FROM passport AS pass
                               INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                               INNER JOIN country as pais on pass.country_id=pais.id
                               WHERE pass.resource_id=? AND pais.status=1 and pass.status=1  AND pass.othenumb<>'') TABLA
                          GROUP BY nombre) TABLA2
                          GROUP BY nombre
                          ORDER BY nombre" ;

            $parametro=true;

        }

        if($tipoReporte==581){

            $sql="SELECT nombre,SUM(total) total FROM
                          (SELECT nombre , COUNT(*) total FROM
                          (SELECT DISTINCT dep.nombre nombre,pass.othenumb acesion
                                 FROM passport pass
                                 INNER JOIN  passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN  ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN  ubigeo dep  ON dist.cod_dep=dep.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=? AND pass.status=1 AND dist.status=1 AND dep.status=1 AND pass.othenumb<>'') TABLA
                          GROUP BY nombre) TABLA2
                          GROUP BY nombre
                          ORDER BY nombre " ;
            $parametro=true;

        }

        if($tipoReporte==582){

            $sql="SELECT descripcion,SUM(total) total FROM
                          (SELECT descripcion , COUNT(*) total FROM
                          (SELECT DISTINCT CONCAT_WS(' - ',dep.nombre, prov.nombre) as descripcion,pass.othenumb acesion
                                 FROM passport pass
                                 INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo prov  ON dist.cod_pro=prov.cod_pro AND dist.cod_dep=prov.cod_dep AND prov.cod_dis=0
                                 INNER JOIN ubigeo dep  ON dep.cod_dep=dist.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=? AND pass.status=1 AND dist.status=1 AND prov.status=1 AND pass.othenumb<>'') TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion " ;
            $parametro=true;

        }

        if($tipoReporte==583){

            $sql="SELECT descripcion,SUM(total) total FROM
                          (SELECT descripcion , COUNT(*) total FROM
                          (SELECT DISTINCT CONCAT_WS(' - ',dep.nombre,prov.nombre ,dist.nombre)  descripcion,pass.othenumb acesion
                                  FROM passport pass
                                 INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo prov  ON dist.cod_pro=prov.cod_pro AND dist.cod_dep=prov.cod_dep AND prov.cod_dis=0
                                 INNER JOIN ubigeo dep  ON dep.cod_dep=dist.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=? AND pass.status=1 AND dist.status=1 AND prov.status=1 AND pass.othenumb<>'') TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion " ;
            $parametro=true;

        }

        if($tipoReporte==584){

            $sql="  SELECT 'In vitro', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,pass.othenumb descripcion
                          FROM passport pass
                          INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                            WHERE   pass.id IN ( SELECT passport_id FROM bank_invitro WHERE status=1 )
                          AND status=1 AND pass.resource_id=$this->tipo_recurso  AND pass.othenumb<>'')
                              TABLA

                    UNION ALL

                   SELECT 'Semillas', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,pass.othenumb descripcion
                          FROM passport pass
                            INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                            WHERE   pass.id IN ( SELECT passport_id FROM bank_seed WHERE status=1 )
                          AND status=1 AND pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'')
                              TABLA

                    UNION ALL

                  SELECT 'ADN', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,pass.othenumb descripcion
                          FROM passport pass
                            INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                            WHERE pass.id IN ( SELECT passport_id FROM bank_dna WHERE status=1 AND type_resource=$this->tipo_recurso )
                          AND status=1 AND pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'')
                              TABLA

                    UNION ALL

                  SELECT 'Campo', COUNT(DISTINCT descripcion) total  FROM
                      (SELECT  pass.id ,pass.othenumb descripcion
                      FROM passport pass
                        INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                        WHERE   pass.id IN ( SELECT passport_id FROM bank_field WHERE status=1 )
                      AND status=1 AND pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'')
                          TABLA" ;

            $parametro=false;

        }

        if($tipoReporte==585){

            $sql="SELECT descripcion,SUM(total) total FROM(
                          SELECT descripcion , COUNT(*) total FROM
                          ( SELECT DISTINCT coleccion.colname descripcion ,pass.othenumb acesion
                                    FROM passport pass
                                    INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                    INNER JOIN specie especie ON especie.id=pass.specie_id
                                    INNER JOIN collection coleccion ON coleccion.id=especie.collection_id
                                    WHERE pass.resource_id=? AND pass.othenumb<>'' AND especie.status=1 AND coleccion.status=1 AND pass.status=1)TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion" ;

            $parametro=true;

        }

        if($tipoReporte==586){

            $sql="SELECT descripcion,SUM(total) total FROM(
                          SELECT descripcion , COUNT(*) total FROM
                          ( SELECT DISTINCT especie.species descripcion ,pass.othenumb acesion
                                    FROM passport pass
                                    INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                    INNER JOIN specie especie ON especie.id=pass.specie_id
                                    WHERE pass.resource_id=? AND pass.othenumb<>'' AND especie.status=1 AND pass.status=1)TABLA
                          GROUP BY acesion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion" ;

            $parametro=true;

        }

        if($tipoReporte==588){

            $sql="SELECT descripcion,species,SUM(total) total  FROM(
                  SELECT id,descripcion ,species, COUNT(*) total FROM
                  (SELECT DISTINCT col.id,col.colname descripcion,especie.species ,pass.othenumb acesion FROM characterization_detail det
                           INNER JOIN passport pass ON det.passport_id=pass.id
                           INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                           INNER JOIN specie as especie on pass.specie_id=especie.id
                           INNER JOIN collection as col on especie.collection_id=col.id
                  WHERE pass.resource_id=$this->tipo_recurso AND  pass.status=1 AND especie.status=1
                          AND col.status=1 AND col.resource_id=$this->tipo_recurso AND det.status=1 AND pass.othenumb<>'')TABLA
                  GROUP BY descripcion,species) TABLA2
                  GROUP BY descripcion,species
                  ORDER BY descripcion ASC" ;

            $parametro=false;

        }

        if($tipoReporte==589){

            $sql="SELECT descripcion,species,SUM(total) total ,CONCAT(ROUND(total*100/f_cant_col_specie(id,1),2) ,'%') porcentaje FROM(
                  SELECT id,descripcion ,species, COUNT(*) total FROM
                  (SELECT DISTINCT col.id,col.colname descripcion,especie.species ,pass.othenumb acesion FROM characterization_detail det
                           INNER JOIN passport pass ON det.passport_id=pass.id
                           INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                           INNER JOIN specie as especie on pass.specie_id=especie.id
                           INNER JOIN collection as col on especie.collection_id=col.id
                  WHERE pass.resource_id=$this->tipo_recurso AND  pass.status=1 AND especie.status=1
                          AND col.status=1 AND col.resource_id=$this->tipo_recurso AND det.status=1 AND pass.othenumb<>'')TABLA
                  GROUP BY descripcion,species) TABLA2
                  GROUP BY descripcion,species
                  ORDER BY descripcion ASC" ;

            $parametro=false;

        }

        if($tipoReporte==593){

            $sql="SELECT descripcion,species,SUM(total) total FROM(
                          SELECT descripcion , species,COUNT(*) total FROM
                          ( SELECT DISTINCT coleccion.colname descripcion,especie.species ,pass.othenumb acesion
                                    FROM passport pass
                                    INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                    INNER JOIN specie especie ON especie.id=pass.specie_id
                                    INNER JOIN collection coleccion ON coleccion.id=especie.collection_id
                                    WHERE pass.resource_id=? AND pass.othenumb<>'' AND especie.status=1 AND coleccion.status=1
                                    AND pass.status=1 AND pass.promissory=700)TABLA
                          GROUP BY descripcion,species) TABLA2
                          GROUP BY descripcion,species
                          ORDER BY descripcion" ;

            $parametro=true;
			/*debug($this->tipo_recurso);
			exit();*/

        }

        if($tipoReporte==594){

            $sql="SELECT descripcion,SUM(total) total FROM(
                  SELECT descripcion , COUNT(*) total FROM
                  (SELECT DISTINCT if(pass.country_id=173, 'Nacional','Internacional') descripcion,pass.othenumb acesion FROM passport pass
                              INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                              WHERE pass.resource_id=? AND pass.status=1 AND pass.othenumb<>'')TABLA
                  GROUP BY descripcion) TABLA2
                  GROUP BY descripcion
                  ORDER BY descripcion " ;

            $parametro=true;

        }

        //**Lista de Colecciones **//

        if($tipoReporte==596){

            $sql="SELECT stacion,SUM(total) total FROM
                          (SELECT stacion , COUNT(*) total FROM
                          (SELECT DISTINCT sta.eea stacion ,col.colname
                              FROM passport as pass
                              INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                              INNER JOIN station as sta on pass.station_origin_id=sta.id
                              INNER JOIN specie as especie on pass.specie_id=especie.id
                              INNER JOIN collection as col on especie.collection_id=col.id
                              WHERE pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'' AND  sta.status=1
                                AND pass.status=1 AND especie.status=1 AND col.status=1 AND col.resource_id=$this->tipo_recurso) TABLA
                          GROUP BY stacion) TABLA2
                          GROUP BY stacion
                          ORDER BY stacion " ;
            $parametro=false;

        }

        if($tipoReporte==597){

            $sql="SELECT nombre,SUM(total) total FROM
                          (SELECT nombre , COUNT(*) total FROM
                          (SELECT DISTINCT pais.name nombre,col.colname
                               FROM passport AS pass
                               INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                               INNER JOIN country as pais on pass.country_id=pais.id
                 INNER JOIN specie as especie on pass.specie_id=especie.id
                               INNER JOIN collection as col on especie.collection_id=col.id
                               WHERE pass.resource_id=$this->tipo_recurso AND pais.status=1 and pass.status=1  AND pass.othenumb<>''
                                AND especie.status=1 AND col.status=1 AND col.resource_id=$this->tipo_recurso) TABLA
                          GROUP BY nombre) TABLA2
                          GROUP BY nombre
                          ORDER BY nombre " ;
            $parametro=false;

        }

        if($tipoReporte==598){

            $sql="SELECT nombre,SUM(total) total FROM
                          (SELECT nombre , COUNT(*) total FROM
                          (SELECT DISTINCT dep.nombre nombre,col.colname
                                 FROM passport pass
                                 INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN  ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo dep  ON dist.cod_dep=dep.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 INNER JOIN specie as especie on pass.specie_id=especie.id
                                 INNER JOIN collection as col on especie.collection_id=col.id
                                 WHERE pass.resource_id=$this->tipo_recurso AND pass.status=1 AND dist.status=1 AND dep.status=1
                                 AND pass.othenumb<>'' AND especie.status=1 AND col.status=1 AND col.resource_id=$this->tipo_recurso) TABLA
                          GROUP BY nombre) TABLA2
                          GROUP BY nombre
                          ORDER BY nombre" ;
            $parametro=false;

        }

        if($tipoReporte==599){

            $sql="SELECT descripcion,SUM(total) total FROM
                          (SELECT descripcion , COUNT(*) total FROM
                          (SELECT DISTINCT CONCAT_WS(' - ',dep.nombre, prov.nombre) as descripcion,col.colname
                                 FROM passport pass
                                 INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN specie as especie on pass.specie_id=especie.id
                                 INNER JOIN collection as col on especie.collection_id=col.id
                                 INNER JOIN ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo prov  ON dist.cod_pro=prov.cod_pro AND dist.cod_dep=prov.cod_dep AND prov.cod_dis=0
                                 INNER JOIN ubigeo dep  ON dep.cod_dep=dist.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=$this->tipo_recurso AND pass.status=1 AND dist.status=1 AND prov.status=1
                                 AND pass.othenumb<>'' AND especie.status=1 AND col.status=1 AND col.resource_id=$this->tipo_recurso) TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion " ;
            $parametro=false;

        }

        if($tipoReporte==600){

            $sql="SELECT descripcion,SUM(total) total FROM
                          (SELECT descripcion , COUNT(*) total FROM
                          (SELECT DISTINCT CONCAT_WS(' - ',dep.nombre,prov.nombre ,dist.nombre)  descripcion,col.colname
                                  FROM passport pass
                                 INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN specie as especie on pass.specie_id=especie.id
                                 INNER JOIN collection as col on especie.collection_id=col.id
                                 INNER JOIN ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo prov  ON dist.cod_pro=prov.cod_pro AND dist.cod_dep=prov.cod_dep AND prov.cod_dis=0
                                 INNER JOIN ubigeo dep  ON dep.cod_dep=dist.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=$this->tipo_recurso AND pass.status=1 AND dist.status=1 AND prov.status=1
                                 AND pass.othenumb<>'' AND especie.status=1 AND col.status=1 AND col.resource_id=$this->tipo_recurso) TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion  " ;
            $parametro=false;

        }

        if($tipoReporte==601){

            $sql="  SELECT 'In vitro', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,col.colname descripcion
                          FROM passport pass
                    INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                    INNER JOIN specie ON specie.id=pass.specie_id
                                INNER JOIN collection col ON col.id=specie.collection_id
                            WHERE   pass.id IN ( SELECT passport_id FROM bank_invitro WHERE status=1 )
                          AND pass.status=1 AND pass.resource_id=$this->tipo_recurso   AND pass.othenumb<>''
                          AND specie.status=1 AND col.status=1)
                              TABLA

                    UNION ALL

                   SELECT 'Semillas', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,col.colname descripcion
                          FROM passport pass
                    INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                    INNER JOIN specie ON specie.id=pass.specie_id
                                INNER JOIN collection col ON col.id=specie.collection_id
                            WHERE   pass.id IN ( SELECT passport_id FROM bank_seed WHERE status=1 )
                          AND pass.status=1 AND pass.resource_id=$this->tipo_recurso  AND pass.othenumb<>''
                          AND specie.status=1 AND col.status=1)
                              TABLA

                    UNION ALL

                  SELECT 'ADN', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,col.colname descripcion
                          FROM passport pass
                  INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                  INNER JOIN specie ON specie.id=pass.specie_id
                                INNER JOIN collection col ON col.id=specie.collection_id
                            WHERE pass.id IN ( SELECT passport_id FROM bank_dna WHERE status=1 AND type_resource=1 )
                          AND pass.status=1 AND pass.resource_id=$this->tipo_recurso  AND pass.othenumb<>''
                          AND specie.status=1 AND col.status=1)
                              TABLA

                    UNION ALL

                  SELECT 'Campo', COUNT(DISTINCT descripcion) total  FROM
                      (SELECT  pass.id ,col.colname descripcion
                          FROM passport pass
                  INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                  INNER JOIN specie ON specie.id=pass.specie_id
                                INNER JOIN collection col ON col.id=specie.collection_id
                        WHERE   pass.id IN ( SELECT passport_id FROM bank_field WHERE status=1 )
                      AND pass.status=1 AND pass.resource_id=$this->tipo_recurso  AND pass.othenumb<>''
                      AND specie.status=1 AND col.status=1)
                          TABLA" ;

            $parametro=false;

        }

         if($tipoReporte==603){

            $sql="SELECT descripcion,SUM(total) total FROM(
                          SELECT descripcion , COUNT(*) total FROM
                          ( SELECT DISTINCT coleccion.colname descripcion ,pass.othenumb acesion
                                    FROM passport pass
                                    INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                    INNER JOIN specie especie ON especie.id=pass.specie_id
                                    INNER JOIN collection coleccion ON coleccion.id=especie.collection_id
                                    WHERE pass.resource_id=? AND pass.othenumb<>'' AND especie.status=1 AND coleccion.status=1 AND pass.status=1)TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion " ;
            $parametro=true;

        }
        //** Lista de Especies**//

        if($tipoReporte==605){

            $sql="SELECT stacion,SUM(total) total FROM
                          (SELECT stacion , COUNT(*) total FROM
                          (SELECT DISTINCT sta.eea stacion ,especie.species
                              FROM passport as pass
                              INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                              INNER JOIN station as sta on pass.station_origin_id=sta.id
                              INNER JOIN specie as especie on pass.specie_id=especie.id
                              WHERE pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'' AND  sta.status=1
                                AND pass.status=1 AND especie.status=1 ) TABLA
                          GROUP BY stacion) TABLA2
                          GROUP BY stacion
                          ORDER BY stacion " ;
            $parametro=false;

        }

        if($tipoReporte==606){

            $sql="SELECT nombre,SUM(total) total FROM
                          (SELECT nombre , COUNT(*) total FROM
                          (SELECT DISTINCT pais.name nombre,especie.species
                               FROM passport AS pass
                               INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                               INNER JOIN country as pais on pass.country_id=pais.id
                               INNER JOIN specie as especie on pass.specie_id=especie.id
                               WHERE pass.resource_id=$this->tipo_recurso AND pais.status=1 and pass.status=1  AND pass.othenumb<>''
                                AND especie.status=1 ) TABLA
                          GROUP BY nombre) TABLA2
                          GROUP BY nombre
                          ORDER BY nombre " ;
            $parametro=false;

        }

        if($tipoReporte==607){

            $sql="SELECT nombre,SUM(total) total FROM
                          (SELECT nombre , COUNT(*) total FROM
                          (SELECT DISTINCT dep.nombre nombre,especie.species
                                 FROM passport pass
                                 INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN  ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo dep  ON dist.cod_dep=dep.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 INNER JOIN specie as especie on pass.specie_id=especie.id
                                 WHERE pass.resource_id=$this->tipo_recurso AND pass.status=1 AND dist.status=1 AND dep.status=1
                                 AND pass.othenumb<>'' AND especie.status=1 ) TABLA
                          GROUP BY nombre) TABLA2
                          GROUP BY nombre
                          ORDER BY nombre" ;
            $parametro=false;

        }

        if($tipoReporte==608){

            $sql="SELECT descripcion,SUM(total) total FROM
                          (SELECT descripcion , COUNT(*) total FROM
                          (SELECT DISTINCT CONCAT_WS(' - ',dep.nombre, prov.nombre) as descripcion,especie.species
                                 FROM passport pass
                                 INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN specie as especie on pass.specie_id=especie.id
                                 INNER JOIN ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo prov  ON dist.cod_pro=prov.cod_pro AND dist.cod_dep=prov.cod_dep AND prov.cod_dis=0
                                 INNER JOIN ubigeo dep  ON dep.cod_dep=dist.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=$this->tipo_recurso AND pass.status=1 AND dist.status=1 AND prov.status=1
                                 AND pass.othenumb<>'' AND especie.status=1) TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion " ;
            $parametro=false;

        }

        if($tipoReporte==609){

            $sql="SELECT descripcion,SUM(total) total FROM
                          (SELECT descripcion , COUNT(*) total FROM
                          (SELECT DISTINCT CONCAT_WS(' - ',dep.nombre,prov.nombre ,dist.nombre)  descripcion,especie.species
                                  FROM passport pass
                                 INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                 INNER JOIN specie as especie on pass.specie_id=especie.id
                                 INNER JOIN ubigeo dist ON pass.ubigeo_id=dist.id
                                 INNER JOIN ubigeo prov  ON dist.cod_pro=prov.cod_pro AND dist.cod_dep=prov.cod_dep AND prov.cod_dis=0
                                 INNER JOIN ubigeo dep  ON dep.cod_dep=dist.cod_dep AND dep.cod_pro=0 AND dep.cod_dis=0
                                 WHERE pass.resource_id=$this->tipo_recurso AND pass.status=1 AND dist.status=1 AND prov.status=1
                                 AND pass.othenumb<>'' AND especie.status=1) TABLA
                          GROUP BY descripcion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion  " ;
            $parametro=false;

        }

        if($tipoReporte==610){

            $sql=" SELECT 'In vitro', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,specie.species descripcion
                          FROM passport pass INNER JOIN specie ON specie.id=pass.specie_id
                          INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                            WHERE   pass.id IN ( SELECT passport_id FROM bank_invitro WHERE status=1 )
                          AND pass.status=1 AND pass.resource_id=$this->tipo_recurso  AND pass.othenumb<>'' AND specie.status=1)
                              TABLA

                    UNION ALL

                   SELECT 'Semillas', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,specie.species descripcion
                          FROM passport pass INNER JOIN specie ON specie.id=pass.specie_id
                          INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                            WHERE   pass.id IN ( SELECT passport_id FROM bank_seed WHERE status=1 )
                          AND pass.status=1 AND pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'' AND specie.status=1)
                              TABLA

                    UNION ALL

                  SELECT 'ADN', COUNT(DISTINCT descripcion) total  FROM
                          (SELECT  pass.id ,specie.species descripcion
                          FROM passport pass INNER JOIN specie ON specie.id=pass.specie_id
                          INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                            WHERE pass.id IN ( SELECT passport_id FROM bank_dna WHERE status=1 AND type_resource=1 )
                          AND pass.status=1 AND pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'' AND specie.status=1)
                              TABLA

                    UNION ALL

                  SELECT 'Campo', COUNT(DISTINCT descripcion) total  FROM
                      (SELECT  pass.id ,specie.species descripcion
                          FROM passport pass INNER JOIN specie ON specie.id=pass.specie_id
                          INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                        WHERE   pass.id IN ( SELECT passport_id FROM bank_field WHERE status=1 )
                      AND pass.status=1 AND pass.resource_id=$this->tipo_recurso AND pass.othenumb<>'' AND specie.status=1)
                          TABLA" ;

            $parametro=false;

        }

        if($tipoReporte==612){

            $sql="SELECT descripcion,SUM(total) total FROM(
                          SELECT descripcion , COUNT(*) total FROM
                          ( SELECT DISTINCT CONCAT_WS(' - ',especie.genus, especie.species) descripcion ,pass.othenumb acesion
                                    FROM passport pass
                                    INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                                    INNER JOIN specie especie ON especie.id=pass.specie_id
                                    WHERE pass.resource_id=? AND pass.othenumb<>'' AND especie.status=1 AND pass.status=1)TABLA
                          GROUP BY acesion) TABLA2
                          GROUP BY descripcion
                          ORDER BY descripcion" ;

            $parametro=true;

        }

        if($tipoReporte==613){

            $sql="SELECT colname,nombre,SUM(total) total FROM
                          (SELECT nombre ,colname, COUNT(*) total FROM
                          (SELECT DISTINCT especie.species nombre,col.colname
                               FROM passport AS pass
                               INNER JOIN passport_fito fito ON fito.passport_id=pass.id AND fito.availability=27
                               INNER JOIN specie as especie on pass.specie_id=especie.id
                               INNER JOIN collection as col on especie.collection_id=col.id
                               WHERE pass.resource_id=$this->tipo_recurso AND  pass.status=1  AND pass.othenumb<>''
                                AND especie.status=1 AND col.status=1 AND col.resource_id=$this->tipo_recurso) TABLA
                          GROUP BY nombre,colname) TABLA2
                          GROUP BY nombre,colname
                          ORDER BY colname   " ;

            $parametro=false;

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

        if($tipoReporte==579){

             $lista_columns=array('ITEM','ESTACIÓN EXPERIMENTAL AGRARIA','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==580){

             $lista_columns=array('ITEM','PAÍS','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==581){

             $lista_columns=array('ITEM','DEPARTAMENTOS','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==582){

             $lista_columns=array('ITEM','PROVINCIA','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==583){

             $lista_columns=array('ITEM','DISTRITOS','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==584){

             $lista_columns=array('ITEM','TIPO DE CONSERVACIÓN','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==585){

             $lista_columns=array('ITEM','COLECCIÓN','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==586){

             $lista_columns=array('ITEM','ESPECIE','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==588){

             $lista_columns=array('ITEM','COLECCIÓN','ESPECIE','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==589){

             $lista_columns=array('ITEM','COLECCIÓN','ESPECIE','CANTIDAD ACCESIONES','PORCENTAJE DE ACCESIONES');

        }

        if($tipoReporte==593){

             $lista_columns=array('ITEM','COLECCIÓN','ESPECIE','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==594){

             $lista_columns=array('ITEM','DISTRIBUCIÓN','CANTIDAD ACCESIONES');

        }

        //** Lista de Colecciones **//

        if($tipoReporte==596){

             $lista_columns=array('ITEM','ESTACIÓN EXPERIMENTAL AGRARIA','CANTIDAD COLLECIONES');

        }

        if($tipoReporte==597){

             $lista_columns=array('ITEM','PAÍS','CANTIDAD COLLECIONES');

        }

        if($tipoReporte==598){

             $lista_columns=array('ITEM','DEPARTAMENTOS','CANTIDAD COLLECIONES');

        }

        if($tipoReporte==599){

              $lista_columns=array('ITEM','PROVINCIA','CANTIDAD COLLECIONES');

        }

        if($tipoReporte==600){

             $lista_columns=array('ITEM','DISTRITOS','CANTIDAD COLLECIONES');

        }

        if($tipoReporte==601){

             $lista_columns=array('ITEM','TIPO DE CONSERVACIÓN','CANTIDAD COLLECIONES');

        }

        if($tipoReporte==603){

            $lista_columns=array('ITEM','COLECCIÓN','CANTIDAD ACCESIONES');

        }


        //** Lista de Especies **/

        if($tipoReporte==605){

             $lista_columns=array('ITEM','ESTACIÓN EXPERIMENTAL AGRARIA','CANTIDAD ESPECIES');

        }

        if($tipoReporte==606){

             $lista_columns=array('ITEM','PAÍS','CANTIDAD ESPECIES');

        }

        if($tipoReporte==607){

             $lista_columns=array('ITEM','DEPARTAMENTOS','CANTIDAD ESPECIES');

        }

        if($tipoReporte==608){

              $lista_columns=array('ITEM','PROVINCIA','CANTIDAD ESPECIES');

        }

        if($tipoReporte==609){

             $lista_columns=array('ITEM','DISTRITOS','CANTIDAD ESPECIES');

        }

        if($tipoReporte==610){

             $lista_columns=array('ITEM','TIPO DE CONSERVACIÓN','CANTIDAD ESPECIES');

        }

        if($tipoReporte==612){

             $lista_columns=array('ITEM','ESPECIE','CANTIDAD ACCESIONES');

        }

        if($tipoReporte==613){

             $lista_columns=array('ITEM','COLECCIÓN','ESPECIE','CANTIDAD ESPECIES');

        }  else{

            // $lista_columns=array('ITEM','ESTACIÓN EXPERIMENTAL AGRARIA','CANTIDAD ACCESIONES');
        }

        return $lista_columns;
    }

    public function getTituloReporte($tipoReporte = null)
    {

        $tituloReporte=null;

        //** Lista de Accesiones **/

        if($tipoReporte==579){

             $tituloReporte='ESTACIÓN EXPERIMENTAL - ACCESIONES';
        }

        if($tipoReporte==580){

             $tituloReporte='PAÍS - ACCESIONES';
        }

        if($tipoReporte==581){

             $tituloReporte='DEPARTAMENTO - ACCESIONES';
        }

        if($tipoReporte==582){

             $tituloReporte='PROVINCIA - ACCESIONES';
        }

        if($tipoReporte==583){

             $tituloReporte='DISTRITOS - ACCESIONES';
        }

        if($tipoReporte==584){

             $tituloReporte='TIPO DE CONSERVACIÓN - ACCESIONES';
        }

        if($tipoReporte==585){

             $tituloReporte='COLECCIÓN - ACCESIONES';
        }

        if($tipoReporte==586){

             $tituloReporte='ESPECIE - ACCESIONES';
        }

        if($tipoReporte==588){

             $tituloReporte='CARACTERIZADAS POR COLECCIÓN Y ESPECIE - ACCESIONES';
        }

        if($tipoReporte==589){

             $tituloReporte='NÚMERO Y PORCENTAJE DE ACCESIONES CARACTERIZADAS MORFOLÓGICAMENTE - ACCESIONES';
        }

        if($tipoReporte==593){

             $tituloReporte='LISTA Y NÚMERO DE ACCESIONES PROMISORIAS (COLECCIÓN Y ESPECIES) - ACCESIONES';
        }

        if($tipoReporte==594){

             $tituloReporte='LISTA DE DISTRIBUCIÓN DE ACCESIONES(NACIONAL/INTERNACIONAL) - ACCESIONES';
        }

        //** Lista de Colección **//

        if($tipoReporte==596){

              $tituloReporte='ESTACIÓN EXPERIMENTAL - COLECCIÓN';
        }

        if($tipoReporte==597){

             $tituloReporte='PAÍS - COLECCIÓN';
        }

        if($tipoReporte==598){

             $tituloReporte='DEPARTAMENTO - COLECCIÓN';
        }

        if($tipoReporte==599){

             $tituloReporte='PROVINCIA - COLECCIÓN';
        }

        if($tipoReporte==600){

             $tituloReporte='DISTRITOS - COLECCIÓN';
        }

        if($tipoReporte==601){

            $tituloReporte='TIPO DE CONSERVACIÓN - COLECCIÓN';
        }

        if($tipoReporte==603){

            $tituloReporte='COLECCIÓN - COLECCIÓN';
        }

        //** Lista de Especies **//

        if($tipoReporte==605){

              $tituloReporte='ESTACIÓN EXPERIMENTAL - ESPECIES';
        }

        if($tipoReporte==606){

             $tituloReporte='PAÍS - ESPECIES';
        }

        if($tipoReporte==607){

             $tituloReporte='DEPARTAMENTO - ESPECIES';
        }

        if($tipoReporte==608){

             $tituloReporte='PROVINCIA - ESPECIES';
        }

        if($tipoReporte==609){

             $tituloReporte='DISTRITOS - ESPECIES';
        }

        if($tipoReporte==610){

             $tituloReporte='TIPO DE CONSERVACIÓN - ESPECIES';
        }

        if($tipoReporte==612){

             $tituloReporte='ESPECIE - ESPECIES';
        }


        if($tipoReporte==613){

             $tituloReporte='NÚMERO DE ESPECIES POR COLECCIÓN - ESPECIES';
        }


        return $tituloReporte;
    }


    public function export($id=null){

        $tipoReporte=$this->request->params['id'];

        if(isset($tipoReporte) && $this->permiso['export']){

            //** Lista de Accesiones **/

            if($tipoReporte==579){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==580){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==581){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==582){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==583){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==584){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==585){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==586){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==588){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==589){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==593){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==594){

                $this->exportarExcel($tipoReporte,0,0);

            }

            //** Lista de Colecciones **//

            if($tipoReporte==596){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==597){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==598){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==599){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==600){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==601){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==603){

                $this->exportarExcel($tipoReporte,0,0);

            }

            //** Lista de Especies **//

            if($tipoReporte==605){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==606){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==607){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==608){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==609){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==610){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==612){

                $this->exportarExcel($tipoReporte,0,0);

            }

            if($tipoReporte==613){

                $this->exportarExcel($tipoReporte,0,0);

            }

        } else{

              $this->Flash->error(__('Operación denegada.'));
              return $this->redirect(['action' => 'index']);
        }

    }



    public function exportarExcel($tipoReporte = null,$letraInicio=0,$inicioFila=0)
    {
        $data_rows= $this->getDataReporte($tipoReporte);

        if(count($data_rows)>0) {

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
