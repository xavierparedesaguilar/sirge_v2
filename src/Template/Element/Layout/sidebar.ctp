<?php ?>
<div class="page-sidebar" id="sidebar">
    <!-- Page Sidebar Header-->
    <div class="sidebar-header-wrapper">
        <input type="text" class="searchinput" readonly />
<!--        <i class="searchicon fa fa-search"></i>-->
<!--        <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>-->
    </div>
    <!-- /Page Sidebar Header -->
    <!-- Sidebar Menu -->
    <ul class="nav sidebar-menu">
        <!--Dashboard-->
        <li>
            <a href="<?php echo $this->Url->build('/', true)?>">
                <i class="menu-icon glyphicon glyphicon-home"></i>
                <span class="menu-text"> Inicio </span>
            </a>
        </li>
        <!--Databoxes-->
        <?php echo $this->cell('Menu');?>
        <?php echo $this->cell('Menu::FunctionName'); ?>
    </ul>
    <!-- /Sidebar Menu -->
</div>