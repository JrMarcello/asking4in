<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <?php echo $this->Html->link('Asking4in', '/', array('class' => 'brand')); ?>

        <ul class="nav">
            <?php
                if ($this->request->controller == 'perguntas' && $this->request->action == 'add'):
                    $liClass = 'class="active"';
                else:
                    $liClass = '';
                endif;
            ?>
            <li <?php echo $liClass; ?>><?php echo $this->Html->link('Perguntar', array('controller' => 'perguntas', 'action' => 'add')); ?></li>
        </ul>

        <form class="navbar-search">
            <input type="search" class="search-query" placeholder="Pesquisar" />
        </form>

        <p class="navbar-text pull-right btn-fb-login">
        <fb:login-button class="fb-login-button" autologoutlink="true" show-faces="false" width="200" max-rows="1" size="large" />
        </p>
    </div>
</div>