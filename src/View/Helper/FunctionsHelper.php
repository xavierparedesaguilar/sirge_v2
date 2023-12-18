<?php
namespace App\View\Helper;

use App\Utility\Pusher\PusherSdkClient;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\Routing\Router;
use Cake\View\Helper;
use Cake\View\View;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Datasource\ConnectionManager;

/**
 * Functions helper
 */
class FunctionsHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

  //********************************* FORMATO DE EXCEL - RESPORTES *******************************//
    public function formato_excel($sql, $header_titles, $title, $name_sheet, $name_document)
    {
        $conn = ConnectionManager::get('default');
        $sql_excel = explode('LIMIT', $sql);
        $stmt_excel = $conn->prepare($sql_excel[0]);
        $stmt_excel->execute();

        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        for($i=65; $i<=90; $i++) {
            $letra[] = chr($i);
        }
        for($i=65; $i<=90; $i++) {
            $letra[] = 'A'.chr($i);
        }

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
                        'color' => array('rgb' => '02bf69')
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

        // ENCABEZADOS DE LA TABLA
        for ($i=0; $i < count($header_titles); $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($letra[$i])->setAutoSize(TRUE);
            $objPHPExcel->getActiveSheet()->setCellValue($letra[$i].'4', $header_titles[$i]);
        }

        $item_excel = 1;
        while($row = $stmt_excel->fetch()) {

            for ($i=0; $i < (count($row)-2); $i++) {

                $celda_final = count($row)-3;

                $objPHPExcel->getActiveSheet(0)->setCellValue($letra[$i].($item_excel+4), $row[$i]);
            }

            $objPHPExcel->getActiveSheet(0)->getStyle('A'.($item_excel+4).':'.$letra[$celda_final].($item_excel+4))->applyFromArray($estiloRows);

            $item_excel++;
        }

        $objPHPExcel->getActiveSheet()->setCellValue('A2', $title);
        $objPHPExcel->setActiveSheetIndex()->mergeCells('A2:'.$letra[$celda_final].'2');

        $objPHPExcel->getActiveSheet(0)->getStyle('A2:'.$letra[$celda_final].'2')->applyFromArray($estiloTitle);
        $objPHPExcel->getActiveSheet(0)->getStyle('A4:'.$letra[$celda_final].'4')->applyFromArray($estiloColumna);

        $objPHPExcel->getActiveSheet()->setTitle($name_sheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename = $name_document.".xlsx";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        $objWriter->save(WWW_ROOT.'reportes/'.$name_document.'.xlsx');

    }

    public function nameUser($first, $lastname)
    {
        return $first . ' ' . $lastname;
        // Logic to create specially formatted link goes here...
    }

    public function parseTime($datetime)
    {
        return $time = Time::createFromFormat(
            'Y-m-d H:i:s',
            $datetime,
            'America/Lima'
        );
    }

    public function letterAccent($text_, $option_ = "upper")
    {
        // $find = ['á', 'é', 'í', 'ó', 'ú', 'ñ'];
        // $repl = ['Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'];
        if ($option_ == "lower") {
            // $repl = ['a', 'e', 'i', 'o', 'u', 'n'];
            return mb_strtolower(Inflector::slug($text_), 'UTF-8');
        }
        return mb_strtoupper(Inflector::slug($text_), 'UTF-8');
    }

    public function Mayu($tex_)
    {
        $mayu = strtr(strtoupper($tex_), "àèìòùáéíóúçñäëïöü", "ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
        return $mayu;
    }

    public function MayuArray($datos)
    {
        $mayu = [];
        foreach ($datos as $key=> $data) {
            $mayu[$key] = strtr(strtoupper($data), "àèìòùáéíóúçñäëïöü", "ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ");
        }
        return $mayu;
    }

    public function Minu($tex_)
    {
        $minu = strtr(mb_strtolower($tex_), "ÀÈÌÒÙÁÉÍÓÚÇÑÄËÏÖÜ", "àèìòùáéíóúçñäëïöü");
        return $minu;
    }

    public function dj($data_)
    {
        debug(json_encode($data_, JSON_PRETTY_PRINT));
    }

    public function darray($data_)
    {
        debug($data_->toArray());
    }

    public function pusherMessage($params)
    {
        $pusherClient = new PusherSdkClient(
            Configure::read('Pusher.appKey'),
            Configure::read('Pusher.appSecret'),
            Configure::read('Pusher.appId')
        );

        return $pusherClient->publish(
            'my-channel',
            'my-event',
            [
                'message' => $params['message'],
                'modulo' => 'Módulo ' . $params['modulo'],
                'user' => 'Sistema-INIA',
                'date' => date('Y-m-d H:i:s'),
                'route' => $params['route']
            ]
        );
    }

    public function getUrlFirst($url_, $index_ = 0)
    {
        $url_ = explode('/', $url_);
        $inline = "";
//        $ds     = count($url_);
//        $inline .= $url_[$i] . ((($ds-2)!=$i)? "/" : "" );
        if ($index_ != 0) {
            for ($i = 0; $i <= $index_; $i++) {
                $inline .= $url_[$i] . "/";
            }
            return $inline;
        }
        return $url_[$index_];
    }



//    public function includView($route_,$var_)
//    {
//        global $var_;
//        $route_ = explode('.', $route_);
//        $inline = "";
//        foreach ($route_ as $key => $rout_) {
//            $inline .= "/" . $rout_;
//        }
//        $include_ =  include APP . 'Template' . $inline . '.ctp';
//        return $include_;
////        include APP . 'Template' . DS . $route_[0] . DS . 'partials' . DS . '.ctp';
////        return ;
//
//    }

    public function readJson($var_, $route_ = 'lista')
    {
        $ruta_json = Router::url('/js/json/' . $route_ . '.json', TRUE);
        $json = json_decode(file_get_contents($ruta_json), TRUE);
        return $json[0][$var_];
    }

//    public function permissionController($array_)
//    {
//        $exp = explode(',', $array_);
//        $temp = [];
//        foreach ($exp as $key => $val) {
//            if ($val == "index") $temp[$key] = "index";
//            if ($val == "crear") $temp[$key] = "crear";
//            if ($val == "editar") $temp[$key] = "editar";
//            if ($val == "importar") $temp[$key] = "importar";
//            if ($val == "exportar") $temp[$key] = "exportar";
//            if ($val == "eliminar") $temp[$key] = "eliminar";
//            if ($val == "detalle") $temp[$key] = "detalle";
//        }
//        $print_ = implode(',', $temp);
//        return $print_;
//    }

    public function informacion()
    {
        return '<span class="span-right">
        <a href="javascript:;" class="btn btn-palegreen btn-circle btn-xs" data-container="body"
           data-titleclass="bordered-darkorange" data-toggle="popover-hover" data-placement="bottom"
           data-title="Leyenda de iconos" data-class="popoverrigth"
           data-original-title="" title=""
           data-content=\'<p><i class="glyphicon glyphicon-fullscreen btnfullscreen"></i> Full Screen</p>
            <p><i class="fa fa-arrows-h btnsidebartoggler"></i> Expandir</p>
            <p><i class="fa fa-cloud-upload btnrefresh"></i> Importar</p>
            <p><i class="fa fa-plus btnplus"></i> Agregar</p>\'>
            <i class="fa fa-info"></i>
        </a>
    </span>';
    }

    public function getDataList($slug='')
    {
        $this->Lista = TableRegistry::get('Lista');
        $id_lista = $this->Lista->find()->select('id')->where(['slug' => $slug])->first();
        $lista = $this->Lista->find()->where(['lista_id' => $id_lista->id])->order(['nombre' => 'ASC']);
        return $lista;
    }

    public function reOrderArray($array='' , $key='')
    {
        $temp_array = [];
        foreach ($array as $key => $value) {
            $temp_array[$value->id] = $value;
        }
        return $temp_array;
    }

    public function generate_token($username='',$password='')
    {
        return md5('ab513c75f48d82bcd30aa48e478d2e6e'.$username.''.$password);
    }

    //********************************** LOG API ************************************//
    public function saveLog($user_id,$module_id,$action,$origin)
    {
        $this->Log = TableRegistry::get('Log');
        $data = [
                    'user_id'   => $user_id,
                    'module_id' => $module_id,
                    'action'    => $action,
                    'origin'    => $origin,
                    'date'      => date('Y-m-d H:i:s'),
                ];
        $log = $this->Log->newEntity();
        $log = $this->Log->patchEntity($log, $data);
        if ($this->Log->save($log)) {
            return TRUE;
        }
        return false;
    }

    //********************************** ADD, UPDATE Y DELETE - LOG WEB ************************************//
    public function saveLogWeb($modulo, $registro_id, $action, $user, $recurso_id)
    {
        $this->modules = TableRegistry::get('Module');

        $list_module = $this->modules->find()->where(['slug' => $modulo, 'resource_id' => $recurso_id]);

        $total = $list_module->count();

        if($total == 1)
        {
            $module = $list_module->first();
            $temp  = TableRegistry::get('log');
            $temp_log = $temp->newEntity();
            $temp_log->user_id     = $user;
            $temp_log->module_id   = $module->id;
            $temp_log->registry_id = $registro_id;
            $temp_log->action      = $action;
            $temp_log->origin      = 'WEB';
            $temp_log->date        = date('Y-m-d H:i:s');

            if ($temp->save($temp_log))
            {
                return true;
            }
        }

        return false;
    }

    public function get_modules_()
    {
        $this->Module = TableRegistry::get('Module');
        $module_info = $this->request->params;
        $search_resource = explode("/", $module_info['prefix']);
        $type_resource = (count($search_resource)>1) ? 1 : 2 ;
        switch ($type_resource) {
            case 2:
                $resource_id = 4;
                break;
            case 1:
                switch ($search_resource[1]) {
                    case 'fitogenetico':
                        $resource_id = 1;
                        break;
                    case 'microorganismo':
                        $resource_id = 3;
                        break;
                    case 'zoogenetico':
                        $resource_id = 2;
                        break;
                }
                break;
        }
        $loguser = $this->request->session()->read('Auth.User');
        if ($resource_id==4) {
            $module = $this->Module->find()->where(['controller' => $module_info['controller'] , 'resource_id' => $resource_id])->first();
            $modules = $this->Module->find()->where(['parent_id'=>$module->id , 'status' =>1]);

        }else{
            $modules = $this->Module->find()->where(['resource_id' => $resource_id , 'parent_id is null']);
        }

        $temp_modules_user = [];
        $show_modules = [];

        if(isset($loguser)){

            foreach ($loguser['modulos'] as $key => $user_module) {
                $temp_modules_user[$user_module->module_id] = $user_module;
            }

            foreach ($modules as $key => $modul_) {
                if (isset($temp_modules_user[$modul_->id])) {
                    $show_modules[] = $modul_;
                }
            }
        }

        return $show_modules;
    }

    public function get_modules_inventary()
    {
        $this->Module = TableRegistry::get('Module');
        $module_info = $this->request->params;
        $search_resource = explode("/", $module_info['prefix']);
        switch ($search_resource[1]) {
            case 'fitogenetico':
                $resource_id = 1;
                break;
            case 'microorganismo':
                $resource_id = 3;
                break;
            case 'zoogenetico':
                $resource_id = 2;
                break;
        }
        $module = $this->Module->find()->where(['controller' => $module_info['controller'] , 'resource_id' => $resource_id])->first();
        $modules = $this->Module->find()->where(['parent_id'=>$module->id , 'status' =>1]);
        $loguser = $this->request->session()->read('Auth.User');
        $temp_modules_user = [];
        $show_modules = [];

        if(isset($loguser)){

            foreach ($loguser['modulos'] as $key => $user_module) {
                $temp_modules_user[$user_module->module_id] = $user_module;
            }

            foreach ($modules as $key => $modul_) {
                if (isset($temp_modules_user[$modul_->id])) {
                    $show_modules[] = $modul_;
                }
            }
        }

        return $show_modules;
    }

    public function get_modules_caract()
    {
        $this->Module = TableRegistry::get('Module');
        $module_info = $this->request->params;
        $search_resource = explode("/", $module_info['prefix']);
        switch ($search_resource[1]) {
            case 'fitogenetico':
                $resource_id = 1;
                break;
            case 'microorganismo':
                $resource_id = 3;
                break;
            case 'zoogenetico':
                $resource_id = 2;
                break;
        }

        $module  = $this->Module->find()->where(['controller' => $module_info['controller'] , 'resource_id' => $resource_id])->first();
        $modules = $this->Module->find()->where(['parent_id'=>$module->id , 'status' =>1]);
        $loguser = $this->request->session()->read('Auth.User');
        $temp_modules_user = [];
        $show_modules = [];

        if(isset($loguser)){

            foreach ($loguser['modulos'] as $key => $user_module) {
                $temp_modules_user[$user_module->module_id] = $user_module;
            }

            foreach ($modules as $key => $modul_) {
                if (isset($temp_modules_user[$modul_->id])) {
                    $show_modules[] = $modul_;
                }
            }
        }

        return $show_modules;
    }
    public function get_modules_report()
    {
        $this->Module = TableRegistry::get('Module');
        $module_info = $this->request->params;
        $search_resource = explode("/", $module_info['prefix']);
        $resource_id = 1;
        $module = $this->Module->find()->where(['controller' => $module_info['controller'] , 'resource_id' => $resource_id])->first();
        $modules = $this->Module->find()->where(['parent_id'=>$module->id , 'status' =>1]);
        $loguser = $this->request->session()->read('Auth.User');

        $temp_modules_user = [];
        $show_modules = [];

        if(isset($loguser)){

            foreach ($loguser['modulos'] as $key => $user_module) {
                $temp_modules_user[$user_module->module_id] = $user_module;
            }

            foreach ($modules as $key => $modul_) {
                if (isset($temp_modules_user[$modul_->id])) {
                    $show_modules[] = $modul_;
                }
            }
        }

        return $show_modules;
    }

    public function get_modules_public_catal()
    {
        $this->Module = TableRegistry::get('Module');
        $module_info = $this->request->params;
        $search_resource = explode("/", $module_info['prefix']);
        $resource_id = 4;
        $module = $this->Module->find()->where(['controller' => $module_info['controller'] , 'resource_id' => $resource_id])->first();
        $modules = $this->Module->find()->where(['parent_id'=>$module->id , 'status' =>1]);
        $loguser = $this->request->session()->read('Auth.User');
        $temp_modules_user = [];
        $show_modules = [];

        if(isset($loguser)){

            foreach ($loguser['modulos'] as $key => $user_module) {
                $temp_modules_user[$user_module->module_id] = $user_module;
            }

            foreach ($modules as $key => $modul_) {
                if (isset($temp_modules_user[$modul_->id])) {
                    $show_modules[] = $modul_;
                }
            }
        }

        return $show_modules;
    }
    public function generate_nav($value='')
    {
        $route = Router::url( $this->here, true );
        $route = explode('/', $route);
        $replace_ = [
                        'gestion-publicacion-catalogo' => 'Gestión Públicaciones y Cátalogo',
                        'fitogenetico'=>'Recursos Fitogenéticos',
                        'zoogenetico'=>'Recursos Zoogenéticos',
                        'microorganismo'=>'Recursos Microorganismos',
                        'administracion-base-datos'=>'Administración Base Datos',
                        'estacion-experimental'=>'Estación Experimental',
                        'coleccion'=>'Colección',
                        'caracterizacion' => 'Caracterización',
                        'gestion-inventario'=>'Gestión Inventario',
                        'conservacion'=>'Conservación',
                        'propagacion'=>'Propagación',
                        'evaluacion'=>'Evaluación',
                        'extraccion'=>'Extracción',


                    ];

        $temp_route = [];
        foreach ($route as $key => $value) {
            if ($value=='admin') {
                $temp_route[$value] = $value;
            }
            if (isset($temp_route['admin'])) {
                $temp_route[$value] = (isset($replace_[$value])) ? $replace_[$value] : ucwords(str_replace('-', ' ', $value)) ;
            }

        }
        return $temp_route;
    }


    public function validarObligatorio($value=null,$lista=null){

        $result='';

        if(isset($lista) && count($lista)>0 && isset($value))
            $result=in_array($value,$lista)?'<b style="color:#dd4b39;">(*)</b>':'';

        return $result;

    }

    public function validarModulo($module_id=null)
    {
        $lst_modulo=$this->request->session()->read('Auth.User.modulos');
        $obj_usuario=$this->request->session()->read('Auth.User');

        $acciones=array('index'  => false,
                        'add'    => false,
                        'edit'   => false,
                        'import' => false,
                        'export' => false,
                        'delete' => false,
                        'view'   => false,
                        'all'    => true);

        if(!empty($lst_modulo)){

            foreach ($lst_modulo as $key => $value) {

                if($value['module_id']==$module_id){

                    $lst_permiso = explode(',', $value['permissions']);

                    foreach ($lst_permiso as $key1 => $value1) {

                        if($value1 == 1) {  $acciones['index']  = true; $acciones['all'] = false; }
                        if($value1 == 2) {  $acciones['add']    = true; $acciones['all'] = false; }
                        if($value1 == 3) {  $acciones['edit']   = true; $acciones['all'] = false; }
                        if($value1 == 4) {  $acciones['import'] = true; $acciones['all'] = false; }
                        if($value1 == 5) {  $acciones['export'] = true; $acciones['all'] = false; }
                        if($value1 == 6) {  $acciones['delete'] = true; $acciones['all'] = false; }
                        if($value1 == 7) {  $acciones['view']   = true; $acciones['all'] = false; }

                        if ($acciones['index']==false) {

                            $acciones['index']  = false;
                            $acciones['add']    = false;
                            $acciones['edit']   = false;
                            $acciones['import'] = false;
                            $acciones['export'] = false;
                            $acciones['delete'] = false;
                            $acciones['view']   = false;
                        }

                        $acciones['station_id'] = $obj_usuario['station_id'];
                        $acciones['role_id'] = $obj_usuario['role_id'];
                    }
                }
            }

        }

        return $acciones;

    }

    public function textMetodo($array_,$module_id)
    {
        $exp = explode(',', $array_);
        $temp = [];
        foreach ($exp as $key => $val) {
            if ($val == 1){
                $temp[] = "index";
                $result = $this->get_aditional_actions("index",$module_id);
                if ($result['success']) {
                    foreach ($result['data'] as $key => $value) {
                        $temp[] = $value->action_name;
                    }
                }

            }  //index //lsitaindex //categioruaindex // cualquiercosa_index
            //  id_modulo | add | crear
            // id_modulo | lista_crear | crear
            if ($val == 2) {
                $temp[] = "crear";
                $result = $this->get_aditional_actions("crear",$module_id);
                if ($result['success']) {
                    foreach ($result['data'] as $key => $value) {
                        $temp[] = $value->action_name;
                    }
                }
            }
            if ($val == 3) {
               $temp[] = "editar";
                $result = $this->get_aditional_actions("editar",$module_id);
                if ($result['success']) {
                    foreach ($result['data'] as $key => $value) {
                        $temp[] = $value->action_name;
                    }
                }
            }
            if ($val == 4) {
                $temp[] = "importar";
                $result = $this->get_aditional_actions("importar",$module_id);
                if ($result['success']) {
                    foreach ($result['data'] as $key => $value) {
                        $temp[] = $value->action_name;
                    }
                }
            }
            if ($val == 5) {
                $temp[] = "exportar";
                $result = $this->get_aditional_actions("exportar",$module_id);
                if ($result['success']) {
                    foreach ($result['data'] as $key => $value) {
                        $temp[] = $value->action_name;
                    }
                }
            }
            if ($val == 6) {
                $temp[] = "eliminar";
                $result = $this->get_aditional_actions("eliminar",$module_id);
                if ($result['success']) {
                    foreach ($result['data'] as $key => $value) {
                        $temp[] = $value->action_name;
                    }
                }
            }
            if ($val == 7) {
                $temp[] = "detalle";
                $result = $this->get_aditional_actions("detalle",$module_id);
                if ($result['success']) {
                    foreach ($result['data'] as $key => $value) {
                        $temp[] = $value->action_name;
                    }
                }
            }
        }

        return $temp;
    }

    public function get_aditional_actions($parent_action,$module_id)
    {
        $this->ActionModule = TableRegistry::get('ActionModule');
        $temp_actions = $this->ActionModule->find()->where(['action_parent'=> $parent_action, 'module_id' => $module_id])->toArray();
        if (count($temp_actions)>0) {
            $data['success'] = true;
            $data['data'] = $temp_actions;
            return $data;
        }
        $data['success'] = false;
        return $data;
    }
    public function api_error($response,$message,$cause)
    {
        $data['message'] = $message;
        $data['causes'] = $cause;

        $response->statusCode(400);
        $response->body(json_encode($data));
        return $response;
    }
    // Only For API
    public function fooo(){

    }
    // Only For API
    public function saveLogAPI($request,$module_id,$action)
    {
        $token = $this->request->getHeader('token')[0];

        $this->User = TableRegistry::get('User');
        $user = $this->User->find()->where(['token' => $token])->first();
        // echo $user->id;
        $this->saveLog($user->id, $module_id, $action, "ANDROID");
    }

    public function soloNumero($parametro){

       $permitidos = "0123456789";
       $result=true;
       for ($i=0; $i<strlen($parametro); $i++){
          if (strpos($permitidos, substr($parametro,$i,1))==false){

             $result= false;
          }
       }
       return $result;
    }

    public function nombreMes($valor)
    {
        $lista_meses = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SETIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');

        return $lista_meses[($valor-1)];
    }


    public function generarAbecedarioExcel($letraIncio=0,$cantidadColum=0)
    {
        $i=0;
        $letra=chr($letraIncio+65);
        $abecedario=array();
        while($i<$cantidadColum)
        {
            $abecedario[$i]=$letra;
            $i++;
            $letra++;
        }

        return $abecedario;
    }

}
