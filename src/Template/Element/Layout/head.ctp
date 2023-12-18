<?php echo $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php echo $this->fetch('title') ?> || SIRGE</title>
<?php echo $this->Html->meta('icon') ?>

<!--Basic Styles-->
<link href="<?php echo $this->Url->build('/', true)?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo $this->Url->build('/', true)?>assets/css/font-awesome.min.css" rel="stylesheet" />
<link href="<?php echo $this->Url->build('/', true)?>assets/css/weather-icons.min.css" rel="stylesheet" />

<!--Fonts-->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300"
      rel="stylesheet" type="text/css">

<!--Beyond styles-->
<link href="<?php echo $this->Url->build('/', true)?>assets/css/beyond.min.css" rel="stylesheet" />
<link href="<?php echo $this->Url->build('/', true)?>assets/css/demo.min.css" rel="stylesheet" />
<link href="<?php echo $this->Url->build('/', true)?>assets/css/typicons.min.css" rel="stylesheet" />
<link href="<?php echo $this->Url->build('/', true)?>assets/css/animate.min.css" rel="stylesheet" />
<link href="<?php echo $this->Url->build('/', true)?>assets/css/material-design-iconic-font.min.css" rel="stylesheet">
<link href="<?php echo $this->Url->build('/', true)?>assets/css/skins/teal.min.css" rel="stylesheet">

<script src="<?php echo $this->Url->build('/', true)?>assets/js/skins.min.js"></script>

<?php if(isset($styles) && count($styles)>0): ?>
    <?php foreach($styles as $style):?>
        <link href="<?php echo $this->Url->build('/'.$style.'.css', true)?>" rel="stylesheet">
    <?php endforeach;?>
<?php endif;?>
<link href="<?php echo $this->Url->build('/', true)?>css/styles.css" rel="stylesheet">
<?php #echo $this->Html->css(['styles.css']) ?>

<?php echo $this->fetch('meta') ?>
<?php echo $this->fetch('css') ?>
<script>
    var CK = {
        'base_url' : '<?php echo $this->Url->build('/', true); ?>'
    };
</script>
<script src="<?php echo $this->Url->build('/', true);?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('ready', function () {
        var url     = window.location;
        var origin_ = url.origin+'/'+url.pathname.split('/')[1];
        $('.sidebar-menu a').filter(function () {
            return this.href === origin_;
        }).parent().addClass('active');
    });
</script>