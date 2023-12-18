<?php

use Cake\Auth\DefaultPasswordHasher;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = false;

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo isset($theme['title']) ? $theme['title'] : 'AdminLTE 2 | Log in'; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php echo $this->Html->meta('favicon.ico', '/img/favicon.ico', ['type' => 'icon']); ?>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <?php echo $this->Html->css('AdminLTE./bootstrap/css/bootstrap'); ?>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <?php echo $this->Html->css('AdminLTE.AdminLTE.min'); ?>
  <!-- iCheck -->
  <?php echo $this->Html->css('AdminLTE./plugins/iCheck/square/blue'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="<?php echo $this->Url->build('/', true) ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo $this->Url->build('/', true) ?>assets/js/global.js"></script>
    <script src="<?php echo $this->Url->build('/', true) ?>assets/packages/jqueryvalidation/dist/jquery.validate.js"></script>

    <style type="text/css">
      .new_title{
        font-size: 22px;
        font-weight: bold;
        color: white;
      }
      .new_sub{
        font-size: 15px;
        text-align: center;
        color: white;
        padding-bottom: 10px;
      }
      .myErrorClass{
        color: red;
        font-weight: initial;
      }
      #img_fondo{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        opacity: 0.8;
      }
      #fondo{
        background: rgba(28,119,28, 0.7);  
        box-shadow: 8px 12px 9px #111;    
      }
    </style>
</head>
<!--Head Ends background: rgba(255, 255, 255, 0.15);-->
<!--Body-->
<body class="hold-transition login-page">
    <?php echo $this->Html->image('fondo_principal.jpg', ['alt' => 'Imagen de Fondo', 'id' => 'img_fondo']) ?>
    <div class="login-box">
        <div id="fondo" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php echo $this->Html->image('logo_white.png', ['class' => 'img-responsive', 'alt' => 'Imagen de Fondo']) ?>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="login-box-body">
                <p class="login-box-msg new_title">INICIAR SESIÓN</p>
                <p> <?php echo $this->Flash->render('auth'); ?></p>
                <p> <?php echo $this->Flash->render(); ?> </p>
                <div class="new_sub">Ingresa tu usuario y contraseña para acceder a la aplicación web.</div>
            <?php echo $this->Form->create(null, ['id' => "form_login"]); ?>

                <div class="form-group has-feedback">
                    <?php echo $this->Form->text('username', [
                                                    'type'         => 'text',
                                                    'class'        => 'form-control',
                                                    'id'           => 'usuario',
                                                    'placeholder'  => 'Usuario',
                                                    'autocomplete' => 'off',
                                                    'autofocus'
                    ]); ?>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?php echo $this->Form->password('password', [
                                                        'class'        => 'form-control',
                                                        'id'           => 'password',
                                                        'placeholder'  => 'Contraseña',
                                                        'autocomplete' => "off"
                    ]); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="loginbox-submit">
                    <button type="submit" class="btn btn-success btn-block" id="btnLogin">INGRESAR</button>
                </div>
            </div>
            <?php echo $this->Form->end() ?>
          </div>
        </div>
    </div>

    <!-- jQuery 2.1.4 -->
    <?php #echo $this->Html->script('/plugins/jQuery/jQuery-2.1.4.min'); ?>
    <!-- Bootstrap 3.3.5 -->
    <?php echo $this->Html->script('/bootstrap/js/bootstrap'); ?>

</body>
</html>