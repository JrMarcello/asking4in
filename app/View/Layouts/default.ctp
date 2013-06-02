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
        <?php echo $this->element('navbar'); ?>
        <div id="wrap">
            <div id="container" class="container-fluid">
                <div id="content" class="row-fluid">
                    <div id="lateral" class="span2">
                        <?php echo $this->element('sidebar'); ?>
                    </div>
                    <div id="principal" class="span6">
                        <?php echo $this->Session->flash(); ?>
                        &nbsp;
                        <?php echo $this->fetch('content'); ?>
                    </div>
                </div>
            </div>
            <div id="push"></div>
        </div>
        <div class="modal-footer" style="height: 30px">
            <div>
                <br/>
                <br/>
                <center>
                    <span class="muted">
                        © Copyright 2013 - <strong>SIDE Search Group</strong> - Criado usando 
                        <?php echo $this->Html->link('CakePHP ', 'http://cakephp.org', 
                                array('target' => '_blank'))?> 2.3.0
                    </span>
                </center>
            </div>
        </div>
    </body>
</html>
