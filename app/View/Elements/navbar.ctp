<?php $url = Router::url(array('controller' => 'perguntas', 'action' => 'typeahead')) ?>
<script>
    $(document).ready(function (){
        $('#PerguntaSearch').typeahead({
            source: function (query, process) {
                return $.get('<?php echo $url ?>', { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    });
</script>

<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <?php echo $this->Html->link('Asking4in', '/', array('class' => 'brand')); ?>

        <div class="nav-collapse collapse">
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

            <?php echo $this->Form->create('Pergunta',
                    array('class' => 'form-search navbar-search', 'action' => 'index', 'type' => 'get')); ?>
            <div class="input-append">
                <?php
                echo $this->Form->input('search',
                    array(
                        'type' => 'search',
                        'class' => 'search-query',
                        'div' => false,
                        'label' => false,
                        'placeholder' => 'Pesquisar',
                        'value' => isset($search) ? $search : '',
                        'autocomplete' => 'off',
                        'data-provide' => 'typeahead',
                    )
                );

                echo $this->Form->button('<i class="icon-search"></i>',
                    array('class' => 'btn', 'type' => 'submit'), array('escape' => false));
                ?>
            </div>
            <?php echo $this->Form->end(); ?>

            <p class="navbar-text pull-right">
                <?php if (!$this->Session->check('Auth.User')): ?>
                    <?php echo $this->Facebook->login(array('show-faces' => false, 'perms' => 'email, user_groups', 'redirect' => Router::url(array('controller' => 'usuarios', 'action' => 'login'), true), 'label' => 'Login')); ?>
                <?php else: ?>
                    Logado como <?php echo $this->Session->read('Auth.User.nome'); ?>
                    <?php echo $this->Facebook->logout(array('redirect' => Router::url(array('controller' => 'usuarios', 'action' => 'logout'), true), 'label' => 'Logout')); ?>
                <?php endif; ?>
            </p>
        </div>
    </div>
</div>