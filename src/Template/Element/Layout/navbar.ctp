<?php
$loguser = $this->request->session()->read('Auth.User');
?>
<!-- Navbar -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="<?php echo $this->Url->build('/', true) ?>" class="navbar-brand">
                    <small>
                        <img src="<?php echo $this->Url->build('/', true) ?>assets/img/logo.png" alt=""/>
                    </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->
            <!-- Account Area and Settings -->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">

                        <li>
<!--                            <a class="dropdown-toggle" data-toggle="dropdown" title="Notificaciones" href="javascript:;">-->
<!--                                <i class="icon fa fa-envelope"></i>-->
<!--                                <span class="badge" id="area_bagde">0</span>-->
<!--                            </a>-->
                            <!--Messages Dropdown-->
<!--                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-messages" id="message_push" style="padding-top: 0;">-->
<!--                                <li class="dropdown-footer ">-->
<!--                                    <span>Aun no tienes notificaciones</span>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <img src="--><?php #echo $this->Url->build('/', true) ?><!--assets/img/avatars/divyia.jpg" class="message-avatar" alt="Divyia Austin">-->
<!--                                        <div class="message">-->
<!--                                            <span class="message-sender">Divyia Austin</span>-->
<!--                                            <span class="message-time message-time-moment" data-date-fecha="2017-02-01 12:18:54">2017-02-01 12:18:54</span>-->
<!--                                            <span class="message-subject">Here's the recipe for apple pie</span>-->
<!--                                            <span class="message-body">to identify the sending application when the senders image is shown for the main icon</span>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#">-->
<!--                                        <img src="--><?php #echo $this->Url->build('/', true) ?><!--assets/img/avatars/divyia.jpg" class="message-avatar" alt="Divyia Austin">-->
<!--                                        <div class="message">-->
<!--                                            <span class="message-sender">Divyia Austin2</span>-->
<!--                                            <span class="message-time message-time-moment" data-date-fecha="2017-02-02 12:19:21">2017-02-02 12:19:21</span>-->
<!--                                            <span class="message-subject">asdasd adasd</span>-->
<!--                                            <span class="message-body">fdgdfgdgert erter tert</span>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
                            <!--/Messages Dropdown-->
                        </li>

                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <img src="<?php echo $this->Url->build('/', true) ?>assets/img/avatars/adam-jansen.jpg">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo $loguser['names'] ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="username"><a><?php echo $loguser['names'] ?></a></li>
                                <li class="email"><a><?php echo $loguser['email'] ?></a></li>
                                <!--Avatar Area-->
                                <li>
                                    <div class="avatar-area">
                                        <img src="<?php echo $this->Url->build('/', true) ?>assets/img/avatars/adam-jansen.jpg"
                                             class="avatar">
                                    </div>
                                </li>
                                <li class="dropdown-footer">
                                    <?php echo $this->Html->link('Cerrar sesión', '/admin/logout', ['escape' => false]) ?>
                                </li>
                                <!-- /Account Area -->
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /Account Area and Settings -->
        </div>
    </div>
</div>
<!-- /Navbar -->