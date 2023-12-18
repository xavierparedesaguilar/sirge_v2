<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    $seguridad = "usuarios";

    // $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/login', ['controller' => 'Acceso', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Acceso', 'action' => 'logout']);
    $routes->connect('/modulo-1', ['controller' => 'Portada', 'action' => 'view']);
    $routes->connect('/', ['controller' => 'Portada', 'action' => 'index']);
    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    // $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /* here router module Gestion Seguridad */
    $routes->connect($seguridad, ['controller' => 'User', 'action' => 'index']);
    $routes->connect($seguridad . '/crear', ['controller' => 'User', 'action' => 'add']);
    $routes->connect($seguridad . '/editar/:id', ['controller' => 'User', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($seguridad . '/ver/:id', ['controller' => 'User', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($seguridad . '/eliminar/:id', ['controller' => 'User', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($seguridad . '/getmodulo/:id', ['controller' => 'User', 'action' => 'getmodulo'], ['pass' => ['id']]);

    /************************************************ INICIO DE JQUERY VALIDATION URL **************************/
    $routes->connect('/ajax/verificaremail', ['controller' => 'Ajax', 'action' => 'emailverify']);
    $routes->connect('/ajax/verificadescriptor', ['controller' => 'Ajax', 'action' => 'descriptorverify']);
    $routes->connect('/ajax/verificadescriptorstate', ['controller' => 'Ajax', 'action' => 'descriptorstateverify']);
    $routes->connect('/ajax/verificadescriptorcode', ['controller' => 'Ajax', 'action' => 'descriptorcodeverify']);
    $routes->connect('/ajax/verificarcodfao', ['controller' => 'Ajax', 'action' => 'codigofaoverify']);
    $routes->connect('/ajax/verificarmailclient', ['controller' => 'Ajax', 'action' => 'emailclientverify']);

    $routes->connect('/ajax/validapassport', ['controller' => 'Ajax', 'action' => 'validapassport']);
    $routes->connect('/ajax/validapassportfito', ['controller' => 'Ajax', 'action' => 'validapassportfito']);
    /*************************************************** FIN DE JQUERY VALIDATION URL **************************/

    //********************************************** INICIO DE CARGA DE DATATABLES **********************************************//
    $routes->connect('/ajax/datatablefito', ['controller' => 'Ajax', 'action' => 'datatablepassportfito']);

    $routes->fallbacks(DashedRoute::class);
});



/*Routes Here Api Rest */
Router::prefix('api', function ($routes) {
    $routes->connect('/login', ['controller' => 'User', 'action' => 'login']);
    $routes->connect('/user/me', ['controller' => 'User', 'action' => 'view']);

    // Bank Dna
    $routes->resources('BankDna');
    $routes->resources('ExtractionDna');
    $routes->resources('InputDna');
    $routes->resources('OutputDna');

    // Data to be stored in the Mobile Local Database
    $routes->resources('Station');
    $routes->resources('Collection');
    $routes->resources('Specie');

    $routes->resources('Country');
    $routes->resources('Ubigeo');

    $routes->resources('OptionList');

    $routes->resources('User');
    $routes->resources('ModuleUser');
    $routes->resources('ConfigTable');

    // Caracterization
    $routes->resources('Genotypic');
    $routes->resources('DetailAdaptrnum');
    $routes->resources('DetailPrimernum');
    $routes->resources('Descriptor');
    $routes->resources('DescriptorState');
    $routes->resources('DescriptorValue');
    $routes->resources('Physical');
});

Router::prefix('api/fito', function ($routes) {
    // Passport
    $routes->resources('Passport');

    // Bank In Vitro
    $routes->resources('BankInvitro');
    $routes->resources('PropagationInvitro');
    $routes->resources('ConservationInvitro');
    $routes->resources('InputInvitro');
    $routes->resources('OutputInvitro');

    // Bank Field
    $routes->resources('BankField');
    $routes->resources('OutputField');
    $routes->resources('InputField');
    $routes->resources('EvaluationField');

    // Bank Seed
    $routes->resources('BankSeed');
    $routes->resources('InputSeed');
    $routes->resources('OutputSeed');

});
Router::prefix('api/zoo', function ($routes) {
    // Passport
    $routes->resources('Passport');
});
Router::prefix('api/micro', function ($routes) {
    // Passport
    $routes->resources('Passport');

    // Bank Micro
    $routes->resources('BankMicro');
    $routes->resources('LongTermConservationMicro');
    $routes->resources('InputMicro');
    $routes->resources('OutputMicro');
    $routes->resources('ShortTermConservationMicro');
    $routes->resources('PurityMicro');
});
/*End Routes Api Rest */





/*Routes here Web*/
Router::prefix('admin', function ($routes) {
    /* Universal config URL */
    $seguridad     = "/usuarios/";
    $admin         = "/utilitarios";
    $fitogenetico  = "/fitogenetico";
    $microorganismo= "/microorganismo";
    $zoogenetico   = "/zoogenetico";

    $bancoinvitro   = "/fitogenetico/gestion-inventario/banco-in-vitro/";
    $bancosemilla   = "/fitogenetico/gestion-inventario/banco-semilla/";
    $bancocampo     = "/fitogenetico/gestion-inventario/banco-campo/";
    $bancoadn       = "/fitogenetico/gestion-inventario/banco-adn/";
    $zoo_bancoadn   = "/zoogenetico/gestion-inventario/banco-adn/";
    $micro_bancoadn = "/microorganismo/gestion-inventario/banco-adn/";
    $bancomicro     = "/microorganismo/gestion-inventario/banco-microorganismo/";

    $fito_genotipica = "/fitogenetico/caracterizacion/Genotipica/";
    $fito_fenotipica = "/fitogenetico/caracterizacion/Fenotipica/";
    $fito_descriptor = "/fitogenetico/caracterizacion/Fenotipica/";
    $fito_state      = "/fitogenetico/caracterizacion/Fenotipica/";
    $fisicoquimica   = "/fitogenetico/caracterizacion/Fisicoquimica/";

    $gestion_mapas_fito = "/fitogenetico/gestion-mapas/";

    $zoo_genotipica = "/zoogenetico/caracterizacion/Genotipica/";
    $zoo_fenotipica = "/zoogenetico/caracterizacion/Fenotipica/";
    $zoo_descriptor = "/zoogenetico/caracterizacion/Fenotipica/";
    $zoo_state      = "/zoogenetico/caracterizacion/Fenotipica/";

    $gestion_mapas_zoo = "/zoogenetico/gestion-mapas/";

    $micro_genotipica = "/microorganismo/caracterizacion/Genotipica/";
    $micro_fenotipica = "/microorganismo/caracterizacion/Fenotipica/";
    $micro_descriptor = "/microorganismo/caracterizacion/Fenotipica/";
    $micro_state      = "/microorganismo/caracterizacion/Fenotipica/";

    $gestion_mapas_micro = "/microorganismo/gestion-mapas/";

    $micro_bioquimica      = "/microorganismo/caracterizacion/Bioquimica/";
    $bioquimica_descriptor = "/microorganismo/caracterizacion/Bioquimica/";
    $bioquimica_state      = "/microorganismo/caracterizacion/Bioquimica/";

    $insitu = "/conservacion-in-situ/";

    $reporte_forestal   = "/fitogenetico/Reporte-FitoGenetico/";
    $reporte_zogenetico = "/zoogenetico/Reporte-ZooGenetico/";
    $reporte_micro      = "/microorganismo/Reporte-Microorganismo";

    $publicacion = "/publicacion-catalogo-virtual/Publicaciones/";
    $catalogos   = "/publicacion-catalogo-virtual/catalogos/";
    $clientes    = "/publicacion-catalogo-virtual/suscripcion-clientes/";

    $ordenes = '/gestion-ordenes-linea/';

    $gestion_pagos = "/gestion-pagos/";

    $routes->connect('/login', ['controller'   => 'Acceso', 'action' => 'login']);
    $routes->connect('/logout', ['controller'  => 'Acceso', 'action' => 'logout']);
    $routes->connect('/modulo-1', ['controller'=> 'Portada', 'action' => 'view']);
    $routes->connect('/', ['controller'        => 'Portada', 'action' => 'index']);

    $routes->connect($admin , ['controller' => 'Administracion', 'action' => 'index']);

    //** Reporte Fitogenético **//

    $routes->connect($reporte_forestal , ['controller' => 'reporteForestal', 'action' => 'index']);
    $routes->connect($reporte_forestal .'exportar/:id', ['controller' => 'reporteForestal', 'action' => 'export'], ['pass' => ['id']]);

    //** Reporte Zoogenético **//

    $routes->connect($reporte_zogenetico , ['controller' => 'reporteZoo', 'action' => 'index']);
    $routes->connect($reporte_zogenetico .'exportar/:id', ['controller' => 'reporteZoo', 'action' => 'export'], ['pass' => ['id']]);


    //** Reporte Microgenético **//

    $routes->connect($reporte_micro , ['controller' => 'reporteMicro', 'action' => 'index']);
    $routes->connect($reporte_micro .'exportar/:id', ['controller' => 'reporteMicro', 'action' => 'export'], ['pass' => ['id']]);



    /* Administración - Lista */
    $routes->connect($admin . '/lista', ['controller' => 'Lista', 'action' => 'index']);
    $routes->connect($admin . '/lista/crear', ['controller' => 'Lista', 'action' => 'crear']);
    $routes->connect($admin . '/lista/editar/:id', ['controller' => 'Lista', 'action' => 'editar', ['pass' => ['id'], 'id' => '[0-9]+']]);
    $routes->connect($admin . '/lista/exportar', ['controller' => 'Lista', 'action' => 'exportartablalista']);

    $routes->connect($admin . '/lista/informacion/:id', ['controller' => 'Lista', 'action' => 'lista', ['pass' => ['id'] ]]);
    $routes->connect($admin . '/lista/informacion/:id/crear', ['controller' => 'Lista', 'action' => 'listacrear', ['pass' => ['id'], 'id' => '[0-9]+']]);
    $routes->connect($admin . '/lista/informacion/:id/editar/:child', ['controller' => 'Lista', 'action' => 'listaeditar', ['pass' => ['id', 'child'], 'id' => '[0-9]+']]);
    $routes->connect($admin . '/lista/informacion/:id/eliminar/:child', ['controller' => 'Lista', 'action' => 'listaeliminar', ['pass' => ['id', 'child'], 'id' => '[0-9]+']]);
    $routes->connect($admin . '/lista/informacion/:id/exportar', ['controller' => 'Lista', 'action' => 'exportartablainfo', ['pass' => ['id'], 'id' => '[0-9]+']]);

    $routes->connect($admin . '/lista/informacion/:id/categoria/:child', ['controller' => 'Lista', 'action' => 'listacategoria', ['pass' => ['id', 'child']]]);
    $routes->connect($admin . '/lista/informacion/:id/categoria/:child/crear', ['controller' => 'Lista', 'action' => 'listacategoriacrear', ['pass' => ['id', 'child']]]);
    $routes->connect($admin . '/lista/informacion/:id/categoria/:child/editar/:idcat', ['controller' => 'Lista', 'action' => 'listacategoriaeditar', ['pass' => ['id', 'child', 'idcat']]]);
    $routes->connect($admin . '/lista/informacion/:id/categoria/:child/eliminar/:idcat', ['controller' => 'Lista', 'action' => 'listacategoriaeliminar', ['pass' => ['id', 'child', 'idcat']]]);
    $routes->connect($admin . '/lista/informacion/:id/categoria/:child/exportar', ['controller' => 'Lista', 'action' => 'exportartablacategoria', ['pass' => ['id', 'child']]]);

    /***********  BANCO FITOGENETICO INVITRO ************/
    $routes->connect($bancoinvitro . '', ['controller' => 'BankInvitro', 'action' => 'index']);
    $routes->connect($bancoinvitro . 'crear', ['controller' => 'BankInvitro', 'action' => 'add']);
    $routes->connect($bancoinvitro . 'ver/:id', ['controller' => 'BankInvitro', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($bancoinvitro . 'editar/:id', ['controller' => 'BankInvitro', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($bancoinvitro . 'eliminar/:id', ['controller' => 'BankInvitro', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($bancoinvitro . 'exportar', ['controller' => 'BankInvitro', 'action' => 'exportartabla']);

        /***********  BANCO FITOGENETICO INVITRO - DETALLE CONSERVACION ************/
        $routes->connect($bancoinvitro . '/:id/conservacion', ['controller' => 'ConservationInvitro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancoinvitro . '/:id/conservacion/crear', ['controller' => 'ConservationInvitro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancoinvitro . '/:id/conservacion/ver/:child', ['controller' => 'ConservationInvitro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/conservacion/editar/:child', ['controller' => 'ConservationInvitro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/conservacion/eliminar/:child', ['controller' => 'ConservationInvitro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/conservacion/exportar', ['controller' => 'ConservationInvitro', 'action' => 'exportartabla'], ['pass' => ['id']]);

        /***********  BANCO FITOGENETICO INVITRO - DETALLE ENTRADA DE MATERIAL ************/
        $routes->connect($bancoinvitro . '/:id/entrada', ['controller' => 'InputInvitro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancoinvitro . '/:id/entrada/crear', ['controller' => 'InputInvitro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancoinvitro . '/:id/entrada/ver/:child', ['controller' => 'InputInvitro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/entrada/editar/:child', ['controller' => 'InputInvitro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/entrada/eliminar/:child', ['controller' => 'InputInvitro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/entrada/exportar', ['controller' => 'InputInvitro', 'action' => 'exportartabla'], ['pass' => ['id']]);

        /***********  BANCO FITOGENETICO INVITRO - DETALLE SALIDA DE MATERIAL ************/
        $routes->connect($bancoinvitro . '/:id/salida', ['controller' => 'OutputInvitro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancoinvitro . '/:id/salida/crear', ['controller' => 'OutputInvitro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancoinvitro . '/:id/salida/ver/:child', ['controller' => 'OutputInvitro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/salida/editar/:child', ['controller' => 'OutputInvitro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/salida/eliminar/:child', ['controller' => 'OutputInvitro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/salida/exportar', ['controller' => 'OutputInvitro', 'action' => 'exportartabla'], ['pass' => ['id']]);

        /***********  BANCO FITOGENETICO INVITRO - DETALLE PROPAGACION ************/
        $routes->connect($bancoinvitro . '/:id/propagacion', ['controller' => 'PropagationInvitro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancoinvitro . '/:id/propagacion/crear', ['controller' => 'PropagationInvitro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancoinvitro . '/:id/propagacion/ver/:child', ['controller' => 'PropagationInvitro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/propagacion/editar/:child', ['controller' => 'PropagationInvitro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/propagacion/eliminar/:child', ['controller' => 'PropagationInvitro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoinvitro . '/:id/propagacion/exportar', ['controller' => 'PropagationInvitro', 'action' => 'exportartabla'], ['pass' => ['id']]);

    /***********  BANCO FITOGENETICO SEMILLA ************/
    $routes->connect($bancosemilla . '', ['controller' => 'BankSeed', 'action' => 'index']);
    $routes->connect($bancosemilla . 'crear', ['controller' => 'BankSeed', 'action' => 'add']);
    $routes->connect($bancosemilla . 'ver/:id', ['controller' => 'BankSeed', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($bancosemilla . 'editar/:id', ['controller' => 'BankSeed', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($bancosemilla . 'eliminar/:id', ['controller' => 'BankSeed', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($bancosemilla . 'exportar', ['controller' => 'BankSeed', 'action' => 'exportartabla']);

        /***********  BANCO FITOGENETICO SEMILLA - DETALLE ENTRADA DE MATERIAL ************/
        $routes->connect($bancosemilla . '/:id/entrada', ['controller' => 'InputSeed', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancosemilla . '/:id/entrada/crear', ['controller' => 'InputSeed', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancosemilla . '/:id/entrada/ver/:child', ['controller' => 'InputSeed', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancosemilla . '/:id/entrada/editar/:child', ['controller' => 'InputSeed', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancosemilla . '/:id/entrada/eliminar/:child', ['controller' => 'InputSeed', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancosemilla . '/:id/entrada/exportar', ['controller' => 'InputSeed', 'action' => 'exportartabla'], ['pass' => ['id']]);

         /***********  BANCO FITOGENETICO SEMILLA - DETALLE SALIDA DE MATERIAL ************/
        $routes->connect($bancosemilla . '/:id/salida', ['controller' => 'OutputSeed', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancosemilla . '/:id/salida/crear', ['controller' => 'OutputSeed', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancosemilla . '/:id/salida/ver/:child', ['controller' => 'OutputSeed', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancosemilla . '/:id/salida/editar/:child', ['controller' => 'OutputSeed', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancosemilla . '/:id/salida/eliminar/:child', ['controller' => 'OutputSeed', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancosemilla . '/:id/salida/exportar', ['controller' => 'OutputSeed', 'action' => 'exportartabla'], ['pass' => ['id']]);

    /***********  BANCO FITOGENETICO CAMPO ************/
    $routes->connect($bancocampo . '', ['controller' => 'BankField', 'action' => 'index']);
    $routes->connect($bancocampo . 'crear', ['controller' => 'BankField', 'action' => 'add']);
    $routes->connect($bancocampo . 'ver/:id', ['controller' => 'BankField', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($bancocampo . 'editar/:id', ['controller' => 'BankField', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($bancocampo . 'eliminar/:id', ['controller' => 'BankField', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($bancocampo . 'exportar', ['controller' => 'BankField', 'action' => 'exportartabla']);

                /***********  BANCO FITOGENETICO CAMPO - DETALLE ENTRADA DE MATERIAL ************/
        $routes->connect($bancocampo . '/:id/entrada', ['controller' => 'InputField', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancocampo . '/:id/entrada/crear', ['controller' => 'InputField', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancocampo . '/:id/entrada/ver/:child', ['controller' => 'InputField', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/entrada/editar/:child', ['controller' => 'InputField', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/entrada/eliminar/:child', ['controller' => 'InputField', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/entrada/exportar', ['controller' => 'InputField', 'action' => 'exportartabla'], ['pass' => ['id']]);

         /***********  BANCO FITOGENETICO CAMPO - DETALLE SALIDA DE MATERIAL ************/
        $routes->connect($bancocampo . '/:id/salida', ['controller' => 'OutputField', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancocampo . '/:id/salida/crear', ['controller' => 'OutputField', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancocampo . '/:id/salida/ver/:child', ['controller' => 'OutputField', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/salida/editar/:child', ['controller' => 'OutputField', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/salida/eliminar/:child', ['controller' => 'OutputField', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/salida/exportar', ['controller' => 'OutputField', 'action' => 'exportartabla'], ['pass' => ['id']]);

         /***********  BANCO FITOGENETICO CAMPO - EVALUACION ************/
        $routes->connect($bancocampo . '/:id/evaluacion', ['controller' => 'EvaluationField', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancocampo . '/:id/evaluacion/crear', ['controller' => 'EvaluationField', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancocampo . '/:id/evaluacion/ver/:child', ['controller' => 'EvaluationField', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/evaluacion/editar/:child', ['controller' => 'EvaluationField', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/evaluacion/eliminar/:child', ['controller' => 'EvaluationField', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancocampo . '/:id/evaluacion/exportar', ['controller' => 'EvaluationField', 'action' => 'exportartabla'], ['pass' => ['id']]);

    /***********  BANCO FITOGENETICO ADN ************/
    $routes->connect($bancoadn . '', ['controller' => 'BankDna', 'action' => 'index']);
    $routes->connect($bancoadn . 'crear', ['controller' => 'BankDna', 'action' => 'add']);
    $routes->connect($bancoadn . 'ver/:id', ['controller' => 'BankDna', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($bancoadn . 'editar/:id', ['controller' => 'BankDna', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($bancoadn . 'eliminar/:id', ['controller' => 'BankDna', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($bancoadn . 'exportar', ['controller' => 'BankDna', 'action' => 'exportartabla']);

            /***********  BANCO FITOGENETICO ADN - EXTRACCION ************/
        $routes->connect($bancoadn . '/:id/extraccion', ['controller' => 'ExtractionDna', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancoadn . '/:id/extraccion/crear', ['controller' => 'ExtractionDna', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancoadn . '/:id/extraccion/ver/:child', ['controller' => 'ExtractionDna', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoadn . '/:id/extraccion/editar', ['controller' => 'ExtractionDna', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($bancoadn . '/:id/extraccion/eliminar/:child', ['controller' => ' ExtractionDna', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoadn . '/:id/extraccion/exportar', ['controller' => 'ExtractionDna', 'action' => 'exportartabla'], ['pass' => ['id']]);

        /***********  BANCO FITOGENETICO ADN - DETALLE ENTRADA DE MATERIAL ************/
        $routes->connect($bancoadn . '/:id/entrada', ['controller' => 'InputDna', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancoadn . '/:id/entrada/crear', ['controller' => 'InputDna', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancoadn . '/:id/entrada/ver/:child', ['controller' => 'InputDna', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoadn . '/:id/entrada/editar/:child', ['controller' => 'InputDna', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoadn . '/:id/entrada/eliminar/:child', ['controller' => 'InputDna', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoadn . '/:id/entrada/exportar', ['controller' => 'InputDna', 'action' => 'exportartabla'], ['pass' => ['id']]);

         /*********** BANCO FITOGENETICO ADN - DETALLE SALIDA DE MATERIAL ************/
        $routes->connect($bancoadn . '/:id/salida', ['controller' => 'OutputDna', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancoadn . '/:id/salida/crear', ['controller' => 'OutputDna', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancoadn . '/:id/salida/ver/:child', ['controller' => 'OutputDna', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoadn . '/:id/salida/editar/:child', ['controller' => 'OutputDna', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoadn . '/:id/salida/eliminar/:child', ['controller' => 'OutputDna', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancoadn . '/:id/salida/exportar', ['controller' => 'OutputDna', 'action' => 'exportartabla'], ['pass' => ['id']]);

        /***********  BANCO ZOOGENETICO ADN ************/
    $routes->connect($zoo_bancoadn . '', ['controller' => 'BankDnaZoo', 'action' => 'index']);
    $routes->connect($zoo_bancoadn . 'crear', ['controller' => 'BankDnaZoo', 'action' => 'add']);
    $routes->connect($zoo_bancoadn . 'ver/:id', ['controller' => 'BankDnaZoo', 'action' => 'view'], ['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect($zoo_bancoadn . 'editar/:id', ['controller' => 'BankDnaZoo', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($zoo_bancoadn . 'eliminar/:id', ['controller' => 'BankDnaZoo', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($zoo_bancoadn . 'exportar', ['controller' => 'BankDnaZoo', 'action' => 'exportartabla']);

        /***********  BANCO ZOOGENETICO ADN - EXTRACCION ************/
        $routes->connect($zoo_bancoadn . '/:id/extraccion', ['controller' => 'ExtractionDnaZoo', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($zoo_bancoadn . '/:id/extraccion/crear', ['controller' => 'ExtractionDnaZoo', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($zoo_bancoadn . '/:id/extraccion/ver/:child', ['controller' => 'ExtractionDnaZoo', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($zoo_bancoadn . '/:id/extraccion/editar', ['controller' => 'ExtractionDnaZoo', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($zoo_bancoadn . '/:id/extraccion/eliminar/:child', ['controller' => ' ExtractionDnaZoo', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($zoo_bancoadn . '/:id/extraccion/exportar', ['controller' => 'ExtractionDnaZoo', 'action' => 'exportartabla'], ['pass' => ['id']]);

        /***********  BANCO ZOOGENETICO ADN - DETALLE ENTRADA DE MATERIAL ************/
        $routes->connect($zoo_bancoadn . '/:id/entrada', ['controller' => 'InputDnaZoo', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($zoo_bancoadn . '/:id/entrada/crear', ['controller' => 'InputDnaZoo', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($zoo_bancoadn . '/:id/entrada/ver/:child', ['controller' => 'InputDnaZoo', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($zoo_bancoadn . '/:id/entrada/editar/:child', ['controller' => 'InputDnaZoo', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($zoo_bancoadn . '/:id/entrada/eliminar/:child', ['controller' => 'InputDnaZoo', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($zoo_bancoadn . '/:id/entrada/exportar', ['controller' => 'InputDnaZoo', 'action' => 'exportartabla'], ['pass' => ['id']]);

         /*********** BANCO ZOOGENETICO ADN - DETALLE SALIDA DE MATERIAL ************/
        $routes->connect($zoo_bancoadn . '/:id/salida', ['controller' => 'OutputDnaZoo', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($zoo_bancoadn . '/:id/salida/crear', ['controller' => 'OutputDnaZoo', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($zoo_bancoadn . '/:id/salida/ver/:child', ['controller' => 'OutputDnaZoo', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($zoo_bancoadn . '/:id/salida/editar/:child', ['controller' => 'OutputDnaZoo', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($zoo_bancoadn . '/:id/salida/eliminar/:child', ['controller' => 'OutputDnaZoo', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($zoo_bancoadn . '/:id/salida/exportar', ['controller' => 'OutputDnaZoo', 'action' => 'exportartabla'], ['pass' => ['id']]);

    /***********************  BANCO MICROORGANISMO ADN ****************************/
    $routes->connect($micro_bancoadn . '', ['controller' => 'BankDnaMicro', 'action' => 'index']);
    $routes->connect($micro_bancoadn . 'crear', ['controller' => 'BankDnaMicro', 'action' => 'add']);
    $routes->connect($micro_bancoadn . 'ver/:id', ['controller' => 'BankDnaMicro', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($micro_bancoadn . 'editar/:id', ['controller' => 'BankDnaMicro', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($micro_bancoadn . 'eliminar/:id', ['controller' => 'BankDnaMicro', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($micro_bancoadn . 'exportar', ['controller' => 'BankDnaMicro', 'action' => 'exportartabla']);

        /***********  BANCO MICROORGANISMO ADN - EXTRACCION ************/
        $routes->connect($micro_bancoadn . '/:id/extraccion', ['controller' => 'ExtractionDnaMicro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($micro_bancoadn . '/:id/extraccion/crear', ['controller' => 'ExtractionDnaMicro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($micro_bancoadn . '/:id/extraccion/ver/:child', ['controller' => 'ExtractionDnaMicro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($micro_bancoadn . '/:id/extraccion/editar', ['controller' => 'ExtractionDnaMicro', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($micro_bancoadn . '/:id/extraccion/eliminar/:child', ['controller' => ' ExtractionDnaMicro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($micro_bancoadn . '/:id/extraccion/exportar', ['controller' => 'ExtractionDnaMicro', 'action' => 'exportartabla'], ['pass' => ['id']]);

        /***********  BANCO MICROORGANISMO ADN - DETALLE ENTRADA DE MATERIAL ************/
        $routes->connect($micro_bancoadn . '/:id/entrada', ['controller' => 'InputDnaMicro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($micro_bancoadn . '/:id/entrada/crear', ['controller' => 'InputDnaMicro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($micro_bancoadn . '/:id/entrada/ver/:child', ['controller' => 'InputDnaMicro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($micro_bancoadn . '/:id/entrada/editar/:child', ['controller' => 'InputDnaMicro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($micro_bancoadn . '/:id/entrada/eliminar/:child', ['controller' => 'InputDnaMicro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($micro_bancoadn . '/:id/entrada/exportar', ['controller' => 'InputDnaMicro', 'action' => 'exportartabla'], ['pass' => ['id']]);

         /*********** BANCO MICROORGANISMO ADN - DETALLE SALIDA DE MATERIAL ************/
        $routes->connect($micro_bancoadn . '/:id/salida', ['controller' => 'OutputDnaMicro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($micro_bancoadn . '/:id/salida/crear', ['controller' => 'OutputDnaMicro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($micro_bancoadn . '/:id/salida/ver/:child', ['controller' => 'OutputDnaMicro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($micro_bancoadn . '/:id/salida/editar/:child', ['controller' => 'OutputDnaMicro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($micro_bancoadn . '/:id/salida/eliminar/:child', ['controller' => 'OutputDnaMicro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($micro_bancoadn . '/:id/salida/exportar', ['controller' => 'OutputDnaMicro', 'action' => 'exportartabla'], ['pass' => ['id']]);

    /***********  BANCO MICROORGANISMO-MICROORGANISMO  ************/
    $routes->connect($bancomicro . '', ['controller' => 'BankMicro', 'action' => 'index']);
    $routes->connect($bancomicro . 'crear', ['controller' => 'BankMicro', 'action' => 'add']);
    $routes->connect($bancomicro . 'ver/:id', ['controller' => 'BankMicro', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($bancomicro . 'editar/:id', ['controller' => 'BankMicro', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($bancomicro . 'eliminar/:id', ['controller' => 'BankMicro', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($bancomicro . 'exportar', ['controller' => 'BankMicro', 'action' => 'exportartabla']);

            /***********  BANCO MICROORGANISMO-MICROORGANISMO  - DETALLE ENTRADA DE MATERIAL ************/
        $routes->connect($bancomicro . '/:id/entrada', ['controller' => 'InputMicro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/entrada/crear', ['controller' => 'InputMicro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/entrada/ver/:child', ['controller' => 'InputMicro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/entrada/editar/:child', ['controller' => 'InputMicro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/entrada/eliminar/:child', ['controller' => 'InputMicro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/entrada/exportar', ['controller' => 'InputMicro', 'action' => 'exportartabla'], ['pass' => ['id']]);

         /*********** BANCO MICROORGANISMO-MICROORGANISMO  - DETALLE SALIDA DE MATERIAL ************/
        $routes->connect($bancomicro . '/:id/salida', ['controller' => 'OutputMicro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/salida/crear', ['controller' => 'OutputMicro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/salida/ver/:child', ['controller' => 'OutputMicro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/salida/editar/:child', ['controller' => 'OutputMicro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/salida/eliminar/:child', ['controller' => 'OutputMicro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/salida/exportar', ['controller' => 'OutputMicro', 'action' => 'exportartabla'], ['pass' => ['id']]);

        /*********** BANCO MICROORGANISMO-MICROORGANISMO  - DETALLE PRUEBA PUREZA ************/
        $routes->connect($bancomicro . '/:id/pureza', ['controller' => 'PurityMicro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/pureza/crear', ['controller' => 'PurityMicro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/pureza/ver/:child', ['controller' => 'PurityMicro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/pureza/editar/:child', ['controller' => 'PurityMicro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/pureza/eliminar/:child', ['controller' => 'PurityMicro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/pureza/exportar', ['controller' => 'PurityMicro', 'action' => 'exportartabla'], ['pass' => ['id']]);

          /*********** BANCO MICROORGANISMO-MICROORGANISMO  - DETALLE CONSERVACIÓN A CORTO PLAZO ************/
        $routes->connect($bancomicro . '/:id/cortoPlazo', ['controller' => 'ShortTermConservationMicro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/cortoPlazo/crear', ['controller' => 'ShortTermConservationMicro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/cortoPlazo/ver/:child', ['controller' => 'ShortTermConservationMicro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/cortoPlazo/editar/:child', ['controller' => 'ShortTermConservationMicro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/cortoPlazo/eliminar/:child', ['controller' => 'ShortTermConservationMicro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/cortoPlazo/exportar', ['controller' => 'ShortTermConservationMicro', 'action' => 'exportartabla'], ['pass' => ['id']]);

           /*********** BANCO MICROORGANISMO-MICROORGANISMO  - DETALLE CONSERVACIÓN A CORTO PLAZO ************/
        $routes->connect($bancomicro . '/:id/largoPlazo', ['controller' => 'LongTermConservationMicro', 'action' => 'index'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/largoPlazo/crear', ['controller' => 'LongTermConservationMicro', 'action' => 'add'], ['pass' => ['id']]);
        $routes->connect($bancomicro . '/:id/largoPlazo/ver/:child', ['controller' => 'LongTermConservationMicro', 'action' => 'view'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/largoPlazo/editar/:child', ['controller' => 'LongTermConservationMicro', 'action' => 'edit'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/largoPlazo/eliminar/:child', ['controller' => 'LongTermConservationMicro', 'action' => 'delete'], ['pass' => ['id', 'child']]);
        $routes->connect($bancomicro . '/:id/largoPlazo/exportar', ['controller' => 'LongTermConservationMicro', 'action' => 'exportartabla'], ['pass' => ['id']]);


    /* Administración de la base de datos */
    /* Validaciones */
    $routes->connect($admin . '/validacion', ['controller' => 'ConfigTable', 'action' => 'index']);
    $routes->connect($admin . '/validacion/pasaporte-fitogenetico', ['controller' => 'ConfigTableFitogenetico', 'action' => 'index']);
    $routes->connect($admin . '/validacion/pasaporte-zoogenetico', ['controller' => 'ConfigTableZoogenetico', 'action' => 'index']);
    $routes->connect($admin . '/validacion/pasaporte-microorganismo', ['controller' => 'ConfigTableMicroorganismo', 'action' => 'index']);
    /* Administración - Estación experimental */
    $routes->connect($admin . '/estacion-experimental', ['controller' => 'Station', 'action' => 'index']);
    $routes->connect($admin . '/estacion-experimental/crear', ['controller' => 'Station', 'action' => 'add']);
    $routes->connect($admin . '/estacion-experimental/ver/:id', ['controller' => 'Station', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($admin . '/estacion-experimental/editar/:id', ['controller' => 'Station', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($admin . '/estacion-experimental/eliminar/:id', ['controller' => 'Station', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($admin . '/estacion-experimental/exportar', ['controller' => 'Station', 'action' => 'exportartabla']);

    /* Administración - Coleccion */
    $routes->connect($admin . '/coleccion', ['controller' => 'Collection', 'action' => 'index']);
    $routes->connect($admin . '/coleccion/crear', ['controller' => 'Collection', 'action' => 'add']);
    $routes->connect($admin . '/coleccion/ver/:id', ['controller' => 'Collection', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($admin . '/coleccion/editar/:id', ['controller' => 'Collection', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($admin . '/coleccion/eliminar/:id', ['controller' => 'Collection', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($admin . '/coleccion/exportar', ['controller' => 'Collection', 'action' => 'exportartabla']);

    /* Administración - Especie */
    $routes->connect($admin . '/especie', ['controller' => 'Specie', 'action' => 'index']);
    $routes->connect($admin . '/especie/crear', ['controller' => 'Specie', 'action' => 'add']);
    $routes->connect($admin . '/especie/ver/:id', ['controller' => 'Specie', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($admin . '/especie/editar/:id', ['controller' => 'Specie', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($admin . '/especie/eliminar/:id', ['controller' => 'Specie', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($admin . '/especie/exportar', ['controller' => 'Specie', 'action' => 'exportartabla']);

    /****************** INICIO Modulo Fitogenetico ***********************/
        /*********************** MODULO PASAPORTE ***********************/
        $routes->connect($fitogenetico . '/datos-pasaporte', ['controller' => 'PassportFito', 'action' => 'index']);
        $routes->connect($fitogenetico . '/datos-pasaporte/crear', ['controller' => 'PassportFito', 'action' => 'add']);
        $routes->connect($fitogenetico . '/datos-pasaporte/ver/:id', ['controller' => 'PassportFito', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($fitogenetico . '/datos-pasaporte/editar/:id', ['controller' => 'PassportFito', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($fitogenetico . '/datos-pasaporte/eliminar/:id', ['controller' => 'PassportFito', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($fitogenetico . '/datos-pasaporte/importar', ['controller' => 'PassportFito', 'action' => 'import']);
        $routes->connect($fitogenetico . '/datos-pasaporte/exportar', ['controller' => 'PassportFito', 'action' => 'export']);
        $routes->connect($fitogenetico . '/datos-pasaporte/cargar', ['controller' => 'PassportFito', 'action' => 'uploadfile']);
        $routes->connect($fitogenetico . '/datos-pasaporte/exportacion', ['controller' => 'PassportFito', 'action' => 'exportartabla']);

        /*********************** MODULO GENOTIPICA ***********************/
        $routes->connect($fito_genotipica, ['controller' => 'CaractGenotypicFito', 'action' => 'index']);
        $routes->connect($fito_genotipica . 'crear', ['controller' => 'CaractGenotypicFito', 'action' => 'add']);
        $routes->connect($fito_genotipica . 'ver/:id', ['controller' => 'CaractGenotypicFito', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($fito_genotipica . 'editar/:id', ['controller' => 'CaractGenotypicFito', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($fito_genotipica . 'eliminar/:id', ['controller' => 'CaractGenotypicFito', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($fito_genotipica . 'descargar-accenumb/:id', ['controller' => 'CaractGenotypicFito', 'action' => 'exportaraccenumb'], ['pass' => ['id']]);
        $routes->connect($fito_genotipica . 'descargar-datamatrix/:id', ['controller' => 'CaractGenotypicFito', 'action' => 'exportardatamatrix'], ['pass' => ['id']]);
        $routes->connect($fito_genotipica . 'exportar', ['controller' => 'CaractGenotypicFito', 'action' => 'exportartabla']);

        /*********************** MODULO FENOTIPICA ***********************/
        $routes->connect($fito_fenotipica, ['controller' => 'FenotipicaFito', 'action' => 'index']);
        $routes->connect($fito_fenotipica . 'resultados/:idx/:idy', ['controller' => 'FenotipicaFito', 'action' => 'buscar'], ['pass' => ['idx','idy']]);
        $routes->connect($fito_fenotipica . 'importar', ['controller' => 'FenotipicaFito', 'action' => 'importar']);
        $routes->connect($fito_fenotipica . 'cargar', ['controller' => 'FenotipicaFito', 'action' => 'uploadfile']);
        $routes->connect($fito_fenotipica . 'importar-caracterizacion', ['controller' => 'FenotipicaFito', 'action' => 'importarCaracterizacion']);
        $routes->connect($fito_fenotipica . 'exportar-caracterizacion', ['controller' => 'FenotipicaFito', 'action' => 'exportarCaracterizacion']);
        $routes->connect($fito_fenotipica . 'cargar-caracterizacion', ['controller' => 'FenotipicaFito', 'action' => 'cargarCaracterizacion']);
        $routes->connect($fito_fenotipica . 'exportar-descriptores', ['controller' => 'FenotipicaFito', 'action' => 'exportardescriptores']);
        $routes->connect($fito_fenotipica . 'exportar-estados', ['controller' => 'FenotipicaFito', 'action' => 'exportarestados']);

        /******************* MODULO FENOTIPICA DESCRIPTOR ***********************/
        $routes->connect($fito_descriptor . ':id/descriptor' , ['controller' => 'DescriptorFito', 'action' => 'index'],['pass' => ['id']]);
        $routes->connect($fito_descriptor . ':idx/:idy/caracterizacion' , ['controller' => 'DescriptorFito', 'action' => 'caracterizacion'],['pass' => ['idx', 'idy']]);
        $routes->connect($fito_descriptor . ':idx/:idy/caracterizacion/ordenar' , ['controller' => 'DescriptorFito', 'action' => 'ordenar'],['pass' => ['idx', 'idy']]);
        $routes->connect($fito_descriptor . ':idx/descriptor/crear', ['controller' => 'DescriptorFito', 'action' => 'add'], ['pass' => ['idx']]);
        $routes->connect($fito_descriptor . ':idx/descriptor/ver/:id', ['controller' => 'DescriptorFito', 'action' => 'view'], ['pass' => ['idx', 'id']]);
        $routes->connect($fito_descriptor . ':idx/descriptor/editar/:id', ['controller' => 'DescriptorFito', 'action' => 'edit'], ['pass' => ['idx', 'id']]);
        $routes->connect($fito_descriptor . ':idx/descriptor/eliminar/:id', ['controller' => 'DescriptorFito', 'action' => 'delete'], ['pass' => [ 'idx' ,'id']]);
        $routes->connect($fito_descriptor . ':idx/descriptor/exportar', ['controller' => 'DescriptorFito', 'action' => 'exportartabla'], ['pass' => ['idx']]);

        /******************* MODULO FENOTIPICA DESCRIPTOR STATE ***********************/
        $routes->connect($fito_state . ':idy/descriptor/:idx/estado' , ['controller' => 'DescriptorStateFito', 'action' => 'index'],['pass' => ['idy', 'idx']]);
        $routes->connect($fito_state . ':idy/descriptor/:idx/estado/crear', ['controller' => 'DescriptorStateFito', 'action' => 'add'], ['pass' => ['idy', 'idx']]);
        $routes->connect($fito_state . ':idy/descriptor/:idx/estado/ver/:id', ['controller' => 'DescriptorStateFito', 'action' => 'view'], ['pass' => ['idy', 'idx', 'id']]);
        $routes->connect($fito_state . ':idy/descriptor/:idx/estado/editar/:id', ['controller' => 'DescriptorStateFito', 'action' => 'edit'], ['pass' => ['idy', 'idx', 'id']]);
        $routes->connect($fito_state . ':idy/descriptor/:idx/estado/eliminar/:id', ['controller' => 'DescriptorStateFito', 'action' => 'delete'], ['pass' => ['idy', 'idx' ,'id']]);
        $routes->connect($fito_state . ':idy/descriptor/:idx/estado/exportar', ['controller' => 'DescriptorStateFito', 'action' => 'exportartabla'], ['pass' => ['idy', 'idx']]);

        /*********************** MODULO FISICOQUIMICA ***********************/
        $routes->connect($fisicoquimica , ['controller' => 'CaractPhysicalChemistry', 'action' => 'index']);
        $routes->connect($fisicoquimica . '/crear', ['controller' => 'CaractPhysicalChemistry', 'action' => 'add']);
        $routes->connect($fisicoquimica . '/ver/:id', ['controller' => 'CaractPhysicalChemistry', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($fisicoquimica . '/editar/:id', ['controller' => 'CaractPhysicalChemistry', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($fisicoquimica . '/eliminar/:id', ['controller' => 'CaractPhysicalChemistry', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($fisicoquimica . 'descargar-samplelist/:id', ['controller' => 'CaractPhysicalChemistry', 'action' => 'exportarsamplelist'], ['pass' => ['id']]);
        $routes->connect($fisicoquimica . 'descargar-traitlist/:id', ['controller' => 'CaractPhysicalChemistry', 'action' => 'exportartraitlist'], ['pass' => ['id']]);
        $routes->connect($fisicoquimica . 'descargar-datamatrix/:id', ['controller' => 'CaractPhysicalChemistry', 'action' => 'exportardatamatrix'], ['pass' => ['id']]);
        $routes->connect($fisicoquimica . '/exportar', ['controller' => 'CaractPhysicalChemistry', 'action' => 'exportartabla']);

        /********************************  GESTION DE MAPAS  ****************************/
        $routes->connect($gestion_mapas_fito , ['controller' => 'GestionMapasFito', 'action' => 'index']);
        $routes->connect($gestion_mapas_fito . 'resultados/:id', ['controller' => 'GestionMapasFito', 'action' => 'buscar'],['pass' => ['id']]);
        $routes->connect($gestion_mapas_fito . 'mapas', ['controller' => 'GestionMapasFito', 'action' => 'ver']);
        $routes->connect($gestion_mapas_fito . 'descargar', ['controller' => 'GestionMapasFito', 'action' => 'importarImagen']);

    /****************** FIN Modulo Fitogenetico ***********************/


    /****************** INICIO Modulo zoogenetico ***********************/
        /*********************** MODULO PASAPORTE ***********************/
        $routes->connect($zoogenetico . '/datos-pasaporte', ['controller' => 'PassportZoo', 'action' => 'index']);
        $routes->connect($zoogenetico . '/datos-pasaporte/crear', ['controller' => 'PassportZoo', 'action' => 'add']);
        $routes->connect($zoogenetico . '/datos-pasaporte/ver/:id', ['controller' => 'PassportZoo', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($zoogenetico . '/datos-pasaporte/editar/:id', ['controller' => 'PassportZoo', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($zoogenetico . '/datos-pasaporte/eliminar/:id', ['controller' => 'PassportZoo', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($zoogenetico . '/datos-pasaporte/importar', ['controller' => 'PassportZoo', 'action' => 'import']);
        $routes->connect($zoogenetico . '/datos-pasaporte/exportar', ['controller' => 'PassportZoo', 'action' => 'export']);
        $routes->connect($zoogenetico . '/datos-pasaporte/cargar', ['controller' => 'PassportZoo', 'action' => 'uploadfile']);
        $routes->connect($zoogenetico . '/datos-pasaporte/exportacion', ['controller' => 'PassportZoo', 'action' => 'exportartabla']);

        /*********************** MODULO GENOTIPICA ***********************/
        $routes->connect($zoo_genotipica, ['controller' => 'CaractGenotypicZoo', 'action' => 'index']);
        $routes->connect($zoo_genotipica . 'crear', ['controller' => 'CaractGenotypicZoo', 'action' => 'add']);
        $routes->connect($zoo_genotipica . 'ver/:id', ['controller' => 'CaractGenotypicZoo', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($zoo_genotipica . 'editar/:id', ['controller' => 'CaractGenotypicZoo', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($zoo_genotipica . 'eliminar/:id', ['controller' => 'CaractGenotypicZoo', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($zoo_genotipica . 'descargar-accenumb/:id', ['controller' => 'CaractGenotypicZoo', 'action' => 'exportaraccenumb'], ['pass' => ['id']]);
        $routes->connect($zoo_genotipica . 'descargar-datamatrix/:id', ['controller' => 'CaractGenotypicZoo', 'action' => 'exportardatamatrix'], ['pass' => ['id']]);
        $routes->connect($zoo_genotipica . 'exportar', ['controller' => 'CaractGenotypicZoo', 'action' => 'exportartabla']);

        /*********************** MODULO FENOTIPICA ***********************/
        $routes->connect($zoo_fenotipica, ['controller' => 'FenotipicaZoo', 'action' => 'index']);
        $routes->connect($zoo_fenotipica . 'resultados/:idx/:idy', ['controller' => 'FenotipicaZoo', 'action' => 'buscar'], ['pass' => ['idx','idy']]);
        $routes->connect($zoo_fenotipica . 'importar', ['controller' => 'FenotipicaZoo', 'action' => 'importar']);
        $routes->connect($zoo_fenotipica . 'cargar', ['controller' => 'FenotipicaZoo', 'action' => 'uploadfile']);
        $routes->connect($zoo_fenotipica . 'importar-caracterizacion', ['controller' => 'FenotipicaZoo', 'action' => 'importarCaracterizacion']);
        $routes->connect($zoo_fenotipica . 'exportar-caracterizacion', ['controller' => 'FenotipicaZoo', 'action' => 'exportarCaracterizacion']);
        $routes->connect($zoo_fenotipica . 'cargar-caracterizacion', ['controller' => 'FenotipicaZoo', 'action' => 'cargarCaracterizacion']);
        $routes->connect($zoo_fenotipica . 'exportar-descriptores', ['controller' => 'FenotipicaZoo', 'action' => 'exportardescriptores']);
        $routes->connect($zoo_fenotipica . 'exportar-estados', ['controller' => 'FenotipicaZoo', 'action' => 'exportarestados']);

        /******************* MODULO FENOTIPICA DESCRIPTOR ***********************/
        $routes->connect($zoo_descriptor . ':id/descriptor' , ['controller' => 'DescriptorZoo', 'action' => 'index'],['pass' => ['id']]);
        $routes->connect($zoo_descriptor . ':idx/:idy/caracterizacion' , ['controller' => 'DescriptorZoo', 'action' => 'caracterizacion'],['pass' => ['idx', 'idy']]);
        $routes->connect($zoo_descriptor . ':idx/:idy/caracterizacion/ordenar' , ['controller' => 'DescriptorZoo', 'action' => 'ordenar'],['pass' => ['idx', 'idy']]);
        $routes->connect($zoo_descriptor . ':idx/descriptor/crear', ['controller' => 'DescriptorZoo', 'action' => 'add'], ['pass' => ['idx']]);
        $routes->connect($zoo_descriptor . ':idx/descriptor/ver/:id', ['controller' => 'DescriptorZoo', 'action' => 'view'], ['pass' => ['idx', 'id']]);
        $routes->connect($zoo_descriptor . ':idx/descriptor/editar/:id', ['controller' => 'DescriptorZoo', 'action' => 'edit'], ['pass' => ['idx', 'id']]);
        $routes->connect($zoo_descriptor . ':idx/descriptor/eliminar/:id', ['controller' => 'DescriptorZoo', 'action' => 'delete'], ['pass' => [ 'idx' ,'id']]);
        $routes->connect($zoo_descriptor . ':idx/descriptor/exportar', ['controller' => 'DescriptorZoo', 'action' => 'exportartabla'], ['pass' => ['idx']]);

        /******************* MODULO FENOTIPICA DESCRIPTOR STATE ***********************/
        $routes->connect($zoo_state . ':idy/descriptor/:idx/estado' , ['controller' => 'DescriptorStateZoo', 'action' => 'index'],['pass' => ['idy', 'idx']]);
        $routes->connect($zoo_state . ':idy/descriptor/:idx/estado/crear', ['controller' => 'DescriptorStateZoo', 'action' => 'add'], ['pass' => ['idy', 'idx']]);
        $routes->connect($zoo_state . ':idy/descriptor/:idx/estado/ver/:id', ['controller' => 'DescriptorStateZoo', 'action' => 'view'], ['pass' => ['idy', 'idx', 'id']]);
        $routes->connect($zoo_state . ':idy/descriptor/:idx/estado/editar/:id', ['controller' => 'DescriptorStateZoo', 'action' => 'edit'], ['pass' => ['idy', 'idx', 'id']]);
        $routes->connect($zoo_state . ':idy/descriptor/:idx/estado/eliminar/:id', ['controller' => 'DescriptorStateZoo', 'action' => 'delete'], ['pass' => ['idy', 'idx' ,'id']]);
        $routes->connect($zoo_state . ':idy/descriptor/:idx/estado/exportar', ['controller' => 'DescriptorStateZoo', 'action' => 'exportartabla'], ['pass' => ['idy', 'idx']]);

        /********************************  GESTION DE MAPAS  ****************************/
        $routes->connect($gestion_mapas_zoo , ['controller' => 'GestionMapasZoo', 'action' => 'index']);
        $routes->connect($gestion_mapas_zoo . 'resultados/:id', ['controller' => 'GestionMapasZoo', 'action' => 'buscar'],['pass' => ['id']]);
        $routes->connect($gestion_mapas_zoo . 'mapas', ['controller' => 'GestionMapasZoo', 'action' => 'ver']);
        $routes->connect($gestion_mapas_zoo . 'descargar', ['controller' => 'GestionMapasZoo', 'action' => 'importarImagen']);

    /****************** FIN Modulo Fitogenetico ***********************/

    /****************** INICIO MODULO MICROGENETICO ***********************/
        /*********************** MODULO PASAPORTE ***********************/
        $routes->connect($microorganismo . '/datos-pasaporte', ['controller' => 'PassportMicro', 'action' => 'index']);
        $routes->connect($microorganismo . '/datos-pasaporte/crear', ['controller' => 'PassportMicro', 'action' => 'add']);
        $routes->connect($microorganismo . '/datos-pasaporte/ver/:id', ['controller' => 'PassportMicro', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($microorganismo . '/datos-pasaporte/editar/:id', ['controller' => 'PassportMicro', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($microorganismo . '/datos-pasaporte/eliminar/:id', ['controller' => 'PassportMicro', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($microorganismo . '/datos-pasaporte/importar', ['controller' => 'PassportMicro', 'action' => 'import']);
        $routes->connect($microorganismo . '/datos-pasaporte/exportar', ['controller' => 'PassportMicro', 'action' => 'export']);
        $routes->connect($microorganismo . '/datos-pasaporte/cargar', ['controller' => 'PassportMicro', 'action' => 'uploadfile']);
        $routes->connect($microorganismo . '/datos-pasaporte/exportacion', ['controller' => 'PassportMicro', 'action' => 'exportartabla']);

        /*********************** MODULO GENOTIPICA ***********************/
        $routes->connect($micro_genotipica, ['controller' => 'CaractGenotypicMicro', 'action' => 'index']);
        $routes->connect($micro_genotipica . 'crear', ['controller' => 'CaractGenotypicMicro', 'action' => 'add']);
        $routes->connect($micro_genotipica . 'ver/:id', ['controller' => 'CaractGenotypicMicro', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($micro_genotipica . 'editar/:id', ['controller' => 'CaractGenotypicMicro', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($micro_genotipica . 'eliminar/:id', ['controller' => 'CaractGenotypicMicro', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($micro_genotipica . 'descargar-accenumb/:id', ['controller' => 'CaractGenotypicMicro', 'action' => 'exportaraccenumb'], ['pass' => ['id']]);
        $routes->connect($micro_genotipica . 'descargar-datamatrix/:id', ['controller' => 'CaractGenotypicMicro', 'action' => 'exportardatamatrix'], ['pass' => ['id']]);
        $routes->connect($micro_genotipica . 'exportar', ['controller' => 'CaractGenotypicMicro', 'action' => 'exportartabla']);

        /*********************** MODULO FENOTIPICA ***********************/
        $routes->connect($micro_fenotipica, ['controller' => 'FenotipicaMicro', 'action' => 'index']);
        $routes->connect($micro_fenotipica . 'resultados/:idx/:idy', ['controller' => 'FenotipicaMicro', 'action' => 'buscar'], ['pass' => ['idx','idy']]);
        $routes->connect($micro_fenotipica . 'importar', ['controller' => 'FenotipicaMicro', 'action' => 'importar']);
        $routes->connect($micro_fenotipica . 'cargar', ['controller' => 'FenotipicaMicro', 'action' => 'uploadfile']);
        $routes->connect($micro_fenotipica . 'importar-caracterizacion', ['controller' => 'FenotipicaMicro', 'action' => 'importarCaracterizacion']);
        $routes->connect($micro_fenotipica . 'exportar-caracterizacion', ['controller' => 'FenotipicaMicro', 'action' => 'exportarCaracterizacion']);
        $routes->connect($micro_fenotipica . 'cargar-caracterizacion', ['controller' => 'FenotipicaMicro', 'action' => 'cargarCaracterizacion']);
        $routes->connect($micro_fenotipica . 'exportar-descriptores', ['controller' => 'FenotipicaMicro', 'action' => 'exportardescriptores']);
        $routes->connect($micro_fenotipica . 'exportar-estados', ['controller' => 'FenotipicaMicro', 'action' => 'exportarestados']);

        /******************* MODULO FENOTIPICA DESCRIPTOR ***********************/
        $routes->connect($micro_descriptor . ':id/descriptor' , ['controller' => 'DescriptorMicro', 'action' => 'index'],['pass' => ['id']]);
        $routes->connect($micro_descriptor . ':idx/:idy/caracterizacion' , ['controller' => 'DescriptorMicro', 'action' => 'caracterizacion'],['pass' => ['idx', 'idy']]);
        $routes->connect($micro_descriptor . ':idx/:idy/caracterizacion/ordenar' , ['controller' => 'DescriptorMicro', 'action' => 'ordenar'],['pass' => ['idx', 'idy']]);
        $routes->connect($micro_descriptor . ':idx/descriptor/crear', ['controller' => 'DescriptorMicro', 'action' => 'add'], ['pass' => ['idx']]);
        $routes->connect($micro_descriptor . ':idx/descriptor/ver/:id', ['controller' => 'DescriptorMicro', 'action' => 'view'], ['pass' => ['idx', 'id']]);
        $routes->connect($micro_descriptor . ':idx/descriptor/editar/:id', ['controller' => 'DescriptorMicro', 'action' => 'edit'], ['pass' => ['idx', 'id']]);
        $routes->connect($micro_descriptor . ':idx/descriptor/eliminar/:id', ['controller' => 'DescriptorMicro', 'action' => 'delete'], ['pass' => [ 'idx' ,'id']]);
        $routes->connect($micro_descriptor . ':idx/descriptor/exportar', ['controller' => 'DescriptorMicro', 'action' => 'exportartabla'], ['pass' => ['idx']]);

        /******************* MODULO FENOTIPICA DESCRIPTOR STATE ***********************/
        $routes->connect($micro_state . ':idy/descriptor/:idx/estado' , ['controller' => 'DescriptorStateMicro', 'action' => 'index'],['pass' => ['idy', 'idx']]);
        $routes->connect($micro_state . ':idy/descriptor/:idx/estado/crear', ['controller' => 'DescriptorStateMicro', 'action' => 'add'], ['pass' => ['idy', 'idx']]);
        $routes->connect($micro_state . ':idy/descriptor/:idx/estado/ver/:id', ['controller' => 'DescriptorStateMicro', 'action' => 'view'], ['pass' => ['idy', 'idx', 'id']]);
        $routes->connect($micro_state . ':idy/descriptor/:idx/estado/editar/:id', ['controller' => 'DescriptorStateMicro', 'action' => 'edit'], ['pass' => ['idy', 'idx', 'id']]);
        $routes->connect($micro_state . ':idy/descriptor/:idx/estado/eliminar/:id', ['controller' => 'DescriptorStateMicro', 'action' => 'delete'], ['pass' => ['idy', 'idx' ,'id']]);
        $routes->connect($micro_state . ':idy/descriptor/:idx/estado/exportar', ['controller' => 'DescriptorStateMicro', 'action' => 'exportartabla'], ['pass' => ['idy', 'idx']]);

        /*********************** MODULO BIOQUIMICA ***********************/
        $routes->connect($micro_bioquimica, ['controller' => 'BioquimicaMicro', 'action' => 'index']);
        $routes->connect($micro_bioquimica . 'resultados/:idx/:idy', ['controller' => 'BioquimicaMicro', 'action' => 'buscar'], ['pass' => ['idx','idy']]);
        $routes->connect($micro_bioquimica . 'importar', ['controller' => 'BioquimicaMicro', 'action' => 'importar']);
        $routes->connect($micro_bioquimica . 'cargar', ['controller' => 'BioquimicaMicro', 'action' => 'cargar']);
        $routes->connect($micro_bioquimica . 'importar-caracterizacion', ['controller' => 'BioquimicaMicro', 'action' => 'importarCaracterizacion']);
        $routes->connect($micro_bioquimica . 'exportar-caracterizacion', ['controller' => 'BioquimicaMicro', 'action' => 'exportarCaracterizacion']);
        $routes->connect($micro_bioquimica . 'cargar-caracterizacion', ['controller' => 'BioquimicaMicro', 'action' => 'cargarCaracterizacion']);
        $routes->connect($micro_bioquimica . 'exportar-descriptores', ['controller' => 'BioquimicaMicro', 'action' => 'exportardescriptores']);
        $routes->connect($micro_bioquimica . 'exportar-estados', ['controller' => 'BioquimicaMicro', 'action' => 'exportarestados']);

        /******************* MODULO FENOTIPICA DESCRIPTOR ***********************/
        $routes->connect($bioquimica_descriptor . ':id/descriptor' , ['controller' => 'DescriptorBioquimica', 'action' => 'index'],['pass' => ['id']]);
        $routes->connect($bioquimica_descriptor . ':idx/:idy/caracterizacion' , ['controller' => 'DescriptorBioquimica', 'action' => 'caracterizacion'],['pass' => ['idx', 'idy']]);
        $routes->connect($bioquimica_descriptor . ':idx/:idy/caracterizacion/ordenar' , ['controller' => 'DescriptorBioquimica', 'action' => 'ordenar'],['pass' => ['idx', 'idy']]);
        $routes->connect($bioquimica_descriptor . ':idx/descriptor/crear', ['controller' => 'DescriptorBioquimica', 'action' => 'add'], ['pass' => ['idx']]);
        $routes->connect($bioquimica_descriptor . ':idx/descriptor/ver/:id', ['controller' => 'DescriptorBioquimica', 'action' => 'view'], ['pass' => ['idx', 'id']]);
        $routes->connect($bioquimica_descriptor . ':idx/descriptor/editar/:id', ['controller' => 'DescriptorBioquimica', 'action' => 'edit'], ['pass' => ['idx', 'id']]);
        $routes->connect($bioquimica_descriptor . ':idx/descriptor/eliminar/:id', ['controller' => 'DescriptorBioquimica', 'action' => 'delete'], ['pass' => [ 'idx' ,'id']]);
        $routes->connect($bioquimica_descriptor . ':idx/descriptor/exportar', ['controller' => 'DescriptorBioquimica', 'action' => 'exportartabla'], ['pass' => ['idx']]);

        /******************* MODULO FENOTIPICA DESCRIPTOR STATE ***********************/
        $routes->connect($bioquimica_state . ':idy/descriptor/:idx/estado' , ['controller' => 'DescriptorStateBioquimica', 'action' => 'index'],['pass' => ['idy', 'idx']]);
        $routes->connect($bioquimica_state . ':idy/descriptor/:idx/estado/crear', ['controller' => 'DescriptorStateBioquimica', 'action' => 'add'], ['pass' => ['idy', 'idx']]);
        $routes->connect($bioquimica_state . ':idy/descriptor/:idx/estado/ver/:id', ['controller' => 'DescriptorStateBioquimica', 'action' => 'view'], ['pass' => ['idy', 'idx', 'id']]);
        $routes->connect($bioquimica_state . ':idy/descriptor/:idx/estado/editar/:id', ['controller' => 'DescriptorStateBioquimica', 'action' => 'edit'], ['pass' => ['idy', 'idx', 'id']]);
        $routes->connect($bioquimica_state . ':idy/descriptor/:idx/estado/eliminar/:id', ['controller' => 'DescriptorStateBioquimica', 'action' => 'delete'], ['pass' => ['idy', 'idx' ,'id']]);
        $routes->connect($bioquimica_state . ':idy/descriptor/:idx/estado/exportar', ['controller' => 'DescriptorStateBioquimica', 'action' => 'exportartabla'], ['pass' => ['idy', 'idx']]);

        /********************************  GESTION DE MAPAS  ****************************/
        $routes->connect($gestion_mapas_micro , ['controller' => 'GestionMapasMicro', 'action' => 'index']);
        $routes->connect($gestion_mapas_micro . 'mapas', ['controller' => 'GestionMapasMicro', 'action' => 'ver']);
        $routes->connect($gestion_mapas_micro . 'resultados/:id', ['controller' => 'GestionMapasMicro', 'action' => 'buscar'],['pass' => ['id']]);
        $routes->connect($gestion_mapas_micro . 'descargar', ['controller' => 'GestionMapasMicro', 'action' => 'importarImagen']);

    /****************** FIN MODULO MICROGENETICO ***********************/

    /************************************* INICIO MODULO INSITU **************************************/
    $routes->connect($insitu, ['controller' => 'Insitu', 'action' => 'index']);
    $routes->connect($insitu . 'crear', ['controller' => 'Insitu', 'action' => 'add']);
    $routes->connect($insitu . 'ver/:id', ['controller' => 'Insitu', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($insitu . 'editar/:id', ['controller' => 'Insitu', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($insitu . 'eliminar/:id', ['controller' => 'Insitu', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($insitu . 'exportar', ['controller' => 'Insitu', 'action' => 'exportartabla']);

    /************************************* FIN MODULO INSITU **************************************/

        /******************* MODULO PRACTICA AGRICOLAS ***********************/
        $routes->connect($insitu . ':idx/practicas-agricolas' , ['controller' => 'InsituFarmerActivity', 'action' => 'index'],['pass' => ['idx']]);
        $routes->connect($insitu . ':idx/practicas-agricolas/crear', ['controller' => 'InsituFarmerActivity', 'action' => 'add'], ['pass' => ['idx']]);
        $routes->connect($insitu . ':idx/practicas-agricolas/ver/:id', ['controller' => 'InsituFarmerActivity', 'action' => 'view'], ['pass' => ['idx', 'id']]);
        $routes->connect($insitu . ':idx/practicas-agricolas/editar/:id', ['controller' => 'InsituFarmerActivity', 'action' => 'edit'], ['pass' => ['idx', 'id']]);
        $routes->connect($insitu . ':idx/practicas-agricolas/eliminar/:id', ['controller' => 'InsituFarmerActivity', 'action' => 'delete'], ['pass' => [ 'idx' ,'id']]);
        $routes->connect($insitu . ':idx/practicas-agricolas/exportar', ['controller' => 'InsituFarmerActivity', 'action' => 'exportartabla'], ['pass' => ['idx']]);

        /******************* MODULO AMENAZAS REPORTADAS ***********************/
        $routes->connect($insitu . ':idx/amenazas-reportadas' , ['controller' => 'InsituThreat', 'action' => 'index'],['pass' => ['idx']]);
        $routes->connect($insitu . ':idx/amenazas-reportadas/crear', ['controller' => 'InsituThreat', 'action' => 'add'], ['pass' => ['idx']]);
        $routes->connect($insitu . ':idx/amenazas-reportadas/ver/:id', ['controller' => 'InsituThreat', 'action' => 'view'], ['pass' => ['idx', 'id']]);
        $routes->connect($insitu . ':idx/amenazas-reportadas/editar/:id', ['controller' => 'InsituThreat', 'action' => 'edit'], ['pass' => ['idx', 'id']]);
        $routes->connect($insitu . ':idx/amenazas-reportadas/eliminar/:id', ['controller' => 'InsituThreat', 'action' => 'delete'], ['pass' => [ 'idx' ,'id']]);
        $routes->connect($insitu . ':idx/amenazas-reportadas/exportar', ['controller' => 'InsituThreat', 'action' => 'exportartabla'], ['pass' => ['idx']]);

        /******************* MODULO PLAGAS PATOGENOS ***********************/
        $routes->connect($insitu . ':idx/plagas-patogenos' , ['controller' => 'InsituPlage', 'action' => 'index'],['pass' => ['idx']]);
        $routes->connect($insitu . ':idx/plagas-patogenos/crear', ['controller' => 'InsituPlage', 'action' => 'add'], ['pass' => ['idx']]);
        $routes->connect($insitu . ':idx/plagas-patogenos/ver/:id', ['controller' => 'InsituPlage', 'action' => 'view'], ['pass' => ['idx', 'id']]);
        $routes->connect($insitu . ':idx/plagas-patogenos/editar/:id', ['controller' => 'InsituPlage', 'action' => 'edit'], ['pass' => ['idx', 'id']]);
        $routes->connect($insitu . ':idx/plagas-patogenos/eliminar/:id', ['controller' => 'InsituPlage', 'action' => 'delete'], ['pass' => [ 'idx' ,'id']]);
        $routes->connect($insitu . ':idx/plagas-patogenos/exportar', ['controller' => 'InsituPlage', 'action' => 'exportartabla'], ['pass' => ['idx']]);

        /******************* MODULO ACCESIONES ***********************/
        $routes->connect($insitu . ':idx/accesiones' , ['controller' => 'InsituAccesion', 'action' => 'index'],['pass' => ['idx']]);
        $routes->connect($insitu . ':idx/accesiones/crear', ['controller' => 'InsituAccesion', 'action' => 'add'], ['pass' => ['idx']]);
        $routes->connect($insitu . ':idx/accesiones/ver/:id', ['controller' => 'InsituAccesion', 'action' => 'view'], ['pass' => ['idx', 'id']]);
        $routes->connect($insitu . ':idx/accesiones/editar/:id', ['controller' => 'InsituAccesion', 'action' => 'edit'], ['pass' => ['idx', 'id']]);
        $routes->connect($insitu . ':idx/accesiones/eliminar/:id', ['controller' => 'InsituAccesion', 'action' => 'delete'], ['pass' => [ 'idx' ,'id']]);
        $routes->connect($insitu . ':idx/accesiones/exportar', ['controller' => 'InsituAccesion', 'action' => 'exportartabla'], ['pass' => ['idx']]);

    //*************************************** INICIO MODULO DE PUBLICACIONES Y CATALOGOS ********************************************//
        //********************************* INICIO MANTENIMIENTO PUBLICACIONES ***************************************//
        $routes->connect($publicacion, ['controller' => 'Publication', 'action' => 'index']);
        $routes->connect($publicacion . 'crear', ['controller' => 'Publication', 'action' => 'add']);
        $routes->connect($publicacion . 'ver/:id', ['controller' => 'Publication', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($publicacion . 'editar/:id', ['controller' => 'Publication', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($publicacion . 'eliminar/:id', ['controller' => 'Publication', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($publicacion . 'exportar', ['controller' => 'Publication', 'action' => 'exportartabla']);
        //********************************* FIN MANTENIMIENTO PUBLICACIONES ***************************************//

        //********************************* INICIO MANTENIMIENTO CATALOGOS ***************************************//
        $routes->connect($catalogos, ['controller' => 'CataloguePassport', 'action' => 'index']);
        $routes->connect($catalogos . 'resultados/:id', ['controller' => 'CataloguePassport', 'action' => 'buscarPassport'], ['pass' => ['id']]);
        $routes->connect($catalogos . 'editar', ['controller' => 'CataloguePassport', 'action' => 'addPassport']);

        $routes->connect($catalogos . 'resultados/:idx/:idy/:idz', ['controller' => 'CataloguePassport', 'action' => 'buscarCaracterizacion'], ['pass' => ['idx', 'idy', 'idz']]);
        $routes->connect($catalogos . 'editar_caract', ['controller' => 'CataloguePassport', 'action' => 'addCaracterizacion']);
        //********************************* FIN MANTENIMIENTO CATALOGOS ***************************************//

        //********************************* INICIO MANTENIMIENTO CLIENTES ***************************************//
        $routes->connect($clientes, ['controller' => 'Clients', 'action' => 'index']);
        $routes->connect($clientes . 'ver/:id', ['controller' => 'Clients', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect($clientes . 'editar/:id', ['controller' => 'Clients', 'action' => 'edit'], ['pass' => ['id']]);
        $routes->connect($clientes . 'eliminar/:id', ['controller' => 'Clients', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect($clientes . 'exportar', ['controller' => 'Clients', 'action' => 'exportartabla']);
        $routes->connect($clientes . 'cambiarclave/:id', ['controller' => 'Clients', 'action' => 'changePass'], ['pass' => ['id']]);
        //********************************* FIN MANTENIMIENTO PUBLICACIONES ***************************************//
    //*************************************** FIN MODULO DE PUBLICACIONES Y CATALOGOS ********************************************//

    //*************************************** INICIO MODULO DE ORDENES EN LINEA ********************************************//
    $routes->connect($ordenes, ['controller' => 'Orders', 'action' => 'index']);
    $routes->connect($ordenes . 'ver/:id', ['controller' => 'Orders', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($ordenes . 'editar/:id', ['controller' => 'Orders', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($ordenes . 'eliminar/:id', ['controller' => 'Orders', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($ordenes . 'eliminarDetalle/:id', ['controller' => 'Orders', 'action' => 'deleteDetalle'], ['pass' => ['id']]);
    $routes->connect($ordenes . 'exportar', ['controller' => 'Orders', 'action' => 'exportartabla']);
    //*************************************** FIN MODULO DE ORDENES EN LINEA ********************************************//

    //*************************************** INICIO MODULO DE ORDENES EN LINEA ********************************************//
    $routes->connect($gestion_pagos, ['controller' => 'Payments', 'action' => 'index']);
    $routes->connect($gestion_pagos . 'ver/:id', ['controller' => 'Payments', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($gestion_pagos . 'editar/:id', ['controller' => 'Payments', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($gestion_pagos . 'eliminar/:id', ['controller' => 'Payments', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($gestion_pagos . 'exportar', ['controller' => 'Payments', 'action' => 'exportartabla']);
    //*************************************** FIN MODULO DE ORDENES EN LINEA ********************************************//

    /* here router module Gestion Seguridad */
    $routes->connect($seguridad, ['controller' => 'User', 'action' => 'index']);
    $routes->connect($seguridad . 'crear', ['controller' => 'User', 'action' => 'add']);
    $routes->connect($seguridad . 'ver/:id', ['controller' => 'User', 'action' => 'view'], ['pass' => ['id']]);
    $routes->connect($seguridad . 'editar/:id', ['controller' => 'User', 'action' => 'edit'], ['pass' => ['id']]);
    $routes->connect($seguridad . 'eliminar/:id', ['controller' => 'User', 'action' => 'delete'], ['pass' => ['id']]);
    $routes->connect($seguridad . 'getmodulo/:id', ['controller' => 'User', 'action' => 'getmodulo'], ['pass' => ['id']]);
    $routes->connect($seguridad . 'cambiarclave/:id', ['controller' => 'User', 'action' => 'changePass'], ['pass' => ['id']]);
    $routes->connect($seguridad . 'exportar', ['controller' => 'User', 'action' => 'exportartabla']);

    //publicacion-catalogo-virtual
    $routes->connect('/publicacion-catalogo-virtual', ['controller' => 'GestionPublicacionCatalogo', 'action' => 'index']);

});

Router::prefix('admin/fitogenetico', function ($routes) {
    // $routes->connect('/loginx', ['controller' => 'Acceso', 'action' => 'login']);
    $inventario = "/gestion-inventario";
    $caracterizacion = "/caracterizacion";
    $reportes = "/reportes";

    $routes->connect('/', ['controller' => 'Portada', 'action' => 'index']);
    /*Here Routes Inventary*/
    $routes->connect($inventario, ['controller' => 'AdministracionBancos', 'action' => 'index']);

    $routes->connect($caracterizacion, ['controller' => 'Caracterizacion', 'action' => 'index']);

    //$routes->connect($reportes, ['controller' => 'reportes', 'action' => 'index']);

});

Router::prefix('admin/zoogenetico', function ($routes) {
    // $routes->connect('/loginx', ['controller' => 'Acceso', 'action' => 'login']);
    $inventario = "/gestion-inventario";
    $caracterizacion = "/caracterizacion";
    $reportes = "/reportes";

    $routes->connect('/', ['controller' => 'Portada', 'action' => 'index']);
    /*Here Routes Inventary*/
    $routes->connect($inventario, ['controller' => 'AdministracionBancos', 'action' => 'index']);

    $routes->connect($caracterizacion, ['controller' => 'Caracterizacion', 'action' => 'index']);

    $routes->connect($reportes, ['controller' => 'reportes', 'action' => 'index']);
});
Router::prefix('admin/microorganismo', function ($routes) {
    // $routes->connect('/loginx', ['controller' => 'Acceso', 'action' => 'login']);
    $inventario = "/gestion-inventario";
    $caracterizacion = "/caracterizacion";
    $reportes = "/reportes";

    $routes->connect('/', ['controller' => 'Portada', 'action' => 'index']);
    /*Here Routes Inventary*/
    $routes->connect($inventario, ['controller' => 'AdministracionBancos', 'action' => 'index']);

    $routes->connect($caracterizacion, ['controller' => 'Caracterizacion', 'action' => 'index']);

    $routes->connect($reportes, ['controller' => 'reportes', 'action' => 'index']);
});

Plugin::routes();
