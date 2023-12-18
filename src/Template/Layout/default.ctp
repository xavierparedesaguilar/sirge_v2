<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->element('Layout/head') ?>
</head>
<body>
    <!-- Loading Container -->
    <div class="loading-container">
        <div class="loader"></div>
    </div>
    <!--  /Loading Container -->
    <?php echo $this->element('Layout/navbar') ?>
    <!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <?php echo $this->element('Layout/sidebar'); ?>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <?php echo $this->Flash->render() ?>
                <?php echo $this->fetch('content') ?>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
        <!-- Main Container -->
    </div>
    <?php echo $this->element('Layout/footer') ?>
</body>
</html>