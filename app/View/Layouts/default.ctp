<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            Ask4in: <?php echo $title_for_layout; ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        echo $this->Html->meta('icon');

        // echo $this->Html->script('fb_home');
        echo $this->Html->script('jquery-1.9.1.min');
        echo $this->Html->script('bootstrap.min');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('bootstrap-responsive.min');
        echo $this->Html->css('estilo');
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        
    </head>
    <body>
        <?php // echo $this->element('facebook-jssdk'); ?>
        <?php echo $this->element('navbar'); ?>
        <div id="wrap">
            <div id="container" class="container-fluid">
                <div id="content" class="row-fluid">
                    <div id="lateral" class="span3">
                        <?php echo $this->element('sidebar'); ?>
                    </div>
                    <div id="principal" class="span9">
                        <?php echo $this->Session->flash(); ?>
                        &nbsp;
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
            <div id="push"></div>
        </div>
        <div id="footer">
            <div class="container">
                &nbsp;
            </div>
        </div>
        <?php # echo $this->element('sql_dump'); ?>
    </body>
    <?php echo $this->Facebook->init(); ?>
</html>
