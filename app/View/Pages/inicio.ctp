<?php $this->layout = false; ?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            Ask4in: <?php echo $title_for_layout; ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        echo $this->Html->meta('icon');

        //echo $this->Html->script('jquery-1.9.1.min');
        echo $this->Html->script("http://code.jquery.com/jquery-1.9.1.js");
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
        <?php echo $this->element('facebook'); ?>
        <div class="navbar navbar-static-top">
            <div class="navbar-inner">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <?php echo $this->Html->link('Ask4in', '/', array('class' => 'brand')); ?>

                <div class="nav-collapse collapse">
                    <p class="navbar-text pull-right">
                            <a href="#" class="facebook_login_link">Login</a>
                    </p>
                </div>
            </div>
        </div>
        <div id="wrap">
            <div id="container" class="container-fluid">
                <div id="content" class="row-fluid">
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
    </body>
</html>