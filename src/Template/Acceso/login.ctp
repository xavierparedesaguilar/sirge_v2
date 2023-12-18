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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta name="description" content="login page"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="<?php echo $this->Url->build('/', true) ?>assets/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="<?php echo $this->Url->build('/', true) ?>assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $this->Url->build('/', true) ?>assets/css/font-awesome.min.css" rel="stylesheet"/>

    <!--Fonts-->
    <link  href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link href="<?php echo $this->Url->build('/', true) ?>assets/css/beyond.min.css" rel="stylesheet"/>
    <link href="<?php echo $this->Url->build('/', true) ?>assets/css/demo.min.css" rel="stylesheet"/>
    <link href="<?php echo $this->Url->build('/', true) ?>assets/css/animate.min.css" rel="stylesheet"/>
    <link href="<?php echo $this->Url->build('/', true) ?>assets/css/material-design-iconic-font.min.css" rel="stylesheet">

    <script src="<?php echo $this->Url->build('/', true) ?>assets/js/skins.min.js"></script>
    <style>
        p.version {
            text-align: center;
            line-height: 40px;
        }

        .login-div img {
            width: 40%;
            height: 100%;
            margin-top: 5px;
            -moz-border-radius: 50px 0 !important;
            -webkit-border-radius: 50px 0 !important;
            border-radius: 50px 0 !important;
        }

        .login-container .loginbox .loginbox-or {
            height: auto !important;
        }
    </style>
    <script src="<?php echo $this->Url->build('/', true) ?>assets/js/jquery.min.js"></script>
</head>
<!--Head Ends-->
<!--Body-->
<body>
<div class="login-container animated fadeInDown">
    <?php echo $this->Flash->render('auth') ?>
    <?php echo $this->Form->create() ?>
    <div class="loginbox bg-whi
        <div class="loginbox-title">Acceso al Sistema</div>
        <div class="loginbox-or">
            <div class="login-div">
                <img src="<?php echo $this->Url->build('/', true) ?>img/logo.jpg" alt="">
            </div>
        </div>
        <div class="loginbox-textbox">
            <?php echo $this->Form->text('username', ['type' => 'text', 'class' => 'form-control', 'id' => 'usuario', 'placeholder' => 'Usuario']); ?>
        </div>
        <div class="loginbox-textbox">
            <?php echo $this->Form->password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña']); ?>
        </div>
        <div class="loginbox-submit">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </div>
    </div>
    <div class="logobox"><p class="version">V.2.0</p></div>
    <?php echo $this->Form->end() ?>
</div>

<!--Basic Scripts-->
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/slimscroll/jquery.slimscroll.min.js"></script>

<!--Beyond Scripts-->
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/beyond.js"></script>
<script src="<?php echo $this->Url->build('/', true) ?>assets/js/toastr/toastr.js"></script>
</body>
</html>