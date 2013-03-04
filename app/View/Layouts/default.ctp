<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            Asking4in: <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->script('fb_home');
        echo $this->Html->script('jquery-1.9.1.min');
        echo $this->Html->script('bootstrap.min');
        

        echo $this->Html->css('estilo');
        echo $this->Html->css('bootstrap.min');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <?php echo $this->element('facebook-jssdk'); ?>
        <div id="container" class="container">
            <div id="header" class="row-fluid">
                <span class="logo">Asking4in</span>
                <div id="btn-fblogin">
                    <fb:login-button class="fb-login-button" autologoutlink="true" show-faces="false" width="200" max-rows="1" size="large" />
                </div>
            </div>
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
            <div id="footer" class="row-fluid">
                <div class="span8">
                    &nbsp;
                </div>
            </div>
        </div>
        <?php # echo $this->element('sql_dump'); ?>
    </body>
</html>
